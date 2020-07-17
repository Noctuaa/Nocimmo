<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;

class RealEstate extends Model
{
    public $fillable = ['name', 'category', 'address', 'price', 'bedroom', 'bathroom', 'wc', 'area', 'description', 'slug', 'equipment_id', 'thumbnail', 'images'];
    public $formats = [
        'thumbnail' => [253,161],
        'thumbnail_mini' => [102,68]
    ];


    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function equipment()
    {
        return $this->belongsToMany('App\Equipment');
    }
        
    /**
     * boot
     * Delete image folder if publication is deleted
     * @return Boolean
     */
    public static function boot(){
        parent::boot();
        static::deleted(function($instance){
            $instance->detachImage();
            return true;
        });
    }

    public function detachImage()
    {
        Storage::disk('public')->deleteDirectory('/images/realEstates/'. $this->id);
    }
    
    
    /**
     * Check if there is images, if true then we getting the images else return false.
     *
     * @param  string $url
     * @param  array $array
     * @return void
     */
    public function getImages(String $url, Array $array)
    {
        $exists = Storage::disk('public')->exists($url);
        if($exists){
            $image = $array;
            return $image;
        }else{
            return false;
        }
    }
    
    /**
     * Check if the thumbnail exists and return them.
     *
     * @return array
     */
    public function getThumbnailAttribute(){
        $url = 'images/realEstates/'. $this->id .'/Thumbnail/thumbnail_' . $this->id .'.jpg';
        $thumbnail = array( 0 => $url);
        return $this->getImages($url, $thumbnail);
    }

    /**
     * Check if the images exists and return them.
     *
     * @return array
     */
    public function getImagesAttribute(){
        $url = '/images/realEstates/'. $this->id . '/Large';
        $images = Storage::disk('public')->allFiles($url);
        return $this->getImages($url, $images);
    }
    
    /**
     * setSlugAttribute with the name
     *
     * @return void
     */
    public function setSlugAttribute()
    {
        $this->attributes['slug'] = Str::slug($this->name);
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
    
    /**
     * Save the thumbnail of the property in public path
     *,
     * @param  object $thumbnail
     * @return void
     */
    public function setThumbnailAttribute($thumbnail)
    {
        
        if(is_object($thumbnail) && $thumbnail->isValid()){
            self::saved(function($instance) use ($thumbnail){
                $url = "/images/realEstates/{$instance->id}/Thumbnail";
                $this->folderExist($url);
                foreach ($instance->formats as $format => $dimensions) {
                    ImageManagerStatic::make($thumbnail)->fit($dimensions[0],$dimensions[1])->save(public_path() . "/images/realEstates/{$instance->id}/Thumbnail/" . $format . "_{$instance->id}.jpg");
                }
            });
        }
    }
   
    /**
     * Save the images of the property in public path.
     *
     * @param  array $images
     * @return void
     */
    public function setImagesAttribute($images)
    {
        if(is_array($images)){
            self::saved(function($instance) use ($images){               
                $url = "/images/realEstates/{$instance->id}/Large";
                $this->folderExist($url);
                foreach ($images as $image) {
                    $filename = date('U') . uniqid();
                    ImageManagerStatic::make($image)->fit(918,507)->save(public_path() . "/images/realEstates/{$instance->id}/Large/{$filename}.jpg");
                }
            });
        }
    }
   

    /**
    * Get equipments of real Estate in the database
    *
    * @param  array $equipment_id
    * @return array
    */
   /*public function getEquipmentIdAttribute()
   {
        return $this->equipment->pluck('id');
   }*/


   /**
    * Save equipments of real Estate in the database
    *
    * @param  array $equipment_id
    * @return array
    */
   public function setEquipmentIdAttribute($value)
    {
        self::saved(function($instance) use ($value){
            return $instance->equipment()->sync($value);
        });
    }
}
