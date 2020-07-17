<?php

namespace App;

use Illuminate\Support\Str;
use App\Notifications\PasswordReset;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Intervention\Image\ImageManagerStatic;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'slug', 'avatar', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    

    public function realEstate() // Un utilisateur peut: - avoir ajouter plusieurs propriété
    {
        return $this->hasMany('App\RealEstate');
    }

        /**
     * boot
     * Delete image folder if publication is deleted
     * @return Boolean
     */
    public static function boot(){
        parent::boot();
        static::deleted(function($instance){
            $instance->deleteAvatar();
            return true;
        });
    }

    /**
     * Check if folder exist
     * 
     * @param string $url
     * @return void
     */
    public function folderExist(String $url)
    {
        if(!Storage::exists($url)){
            Storage::makeDirectory($url);
        }
    }

    public function deleteAvatar(){
        $this->attributes['avatar'] = false;
        Storage::delete("/images/avatars/avatar_{$this->id}.jpeg");
    }

    public function getAvatarAttribute($avatar)
    {
        if($avatar){
            return "/images/avatars/avatar_{$this->id}.jpeg";
        }else{
            return $this->attributes['avatar'] = false;
        }
    }

    public function setAvatarAttribute($avatar)
    {   
        if(is_object($avatar) && $avatar->isValid()){
            ImageManagerStatic::make($avatar)->fit(150,150)->save(public_path() . "/images/avatars/avatar_{$this->id}.jpeg");
            $this->attributes['avatar'] = true;
        }
    }


    /**
     * Send the password reset notification.
     *
     * @param string $token
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordReset($token));
    }

}
