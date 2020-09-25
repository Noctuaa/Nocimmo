<?php

namespace App\Http\Controllers;


use App\RealEstate;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\RealEstateRequest;
use App\Http\Requests\FilterEstateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mockery\Undefined;

class RealEstateController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['category', 'show', 'searchFilter']]);
    }
    
    /**
     * Display listing of the category
     *
     * @param  string $type
     * @return JsonResponse
     */
    public function category(string $category = "", Request $request)
    {
        $title = $category;
        
        if($category === 'ventes' || $category === 'locations'){
            $category = (trans($category, [], 'en'));
            $realEstate = RealEstate::where('category', $category)->orderBy('id', 'DESC')->paginate(6);
            return $this->SendResponse($request, $realEstate, $title);
        }else{
            abort(404);
        }
    }

    
    /**
     * searchFilter
     *
     * @param  String $category
     * @param  FilterEstateRequest $request
     * @return JsonResponse
     */
    public function searchFilter(string $category = "",FilterEstateRequest $request)
    {
      
        $title = $category;
        $category = trans($category, [], 'en');
        $realEstate = RealEstate::where('category', $category)->where(function ($query) use ($request) {
            if($request->bedroom) {
                $query->where('bedroom', '>=', $request->bedroom);
            };
            if($request->bathroom) {
                $query->where('bathroom', '>=', $request->bathroom);
            };
            if($request->area) {
                $query->where('area', '>=', $request->area);
            };
            if($request->min_price) {
                $query->where('price', '>=', $request->min_price);
            };
            if($request->max_price) {
                $query->where('price', '<=', $request->max_price);
            };
        })->orderBy('id', 'DESC')->paginate(6);;

        return $this->SendResponse($request, $realEstate, $title);
    }
    
    /**
     * SendResponse for searchFilter
     *
     * @param  Request $request
     * @param  Object $realEstate
     * @param  String $title
     * @return JsonResponse
     */
    private function SendResponse($request, $realEstate, $title)
    {
        if($request->ajax()){
            return response()->json([
                'pagination' => [
                    'total' => $realEstate->total(),
                    'per_page' => $realEstate->perPage(),
                    'current_page' => $realEstate->currentPage(),
                    'last_page' => $realEstate->lastPage(),
                    'from' => $realEstate->firstItem(),
                    'to' => $realEstate->lastItem(),
                ],
                'items' => $realEstate->items(),
            ]);
        }

        return view('immo.category', compact('realEstate', 'title'));
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $realEstates = RealEstate::orderBy('id', 'DESC')->get();
        $realEstates->load('user');
        return view('immo.index', compact('realEstates'));
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('immo.create');
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param   RealEstateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RealEstateRequest $request)
    {
        $data = $request->all();
        $data['name'] = Str::ucfirst($data['name']);
        RealEstate::create($data);
        return redirect(action('RealEstateController@index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show(string $category = null ,string $realEstate)
    {
        $realEstate = RealEstate::where('slug', $realEstate)->firstOrFail();
        
        if($category === 'ventes' || $category === 'locations'){
            /*$equipment = RealEstate::join('equipment_real_estate', 'real_estates.id', '=', 'equipment_real_estate.real_estate_id')
            ->join('equipments', 'equipments.id','=', 'equipment_real_estate.equipment_id')
            ->where('real_estates.id', $realEstate->id)->selectRaw('equipments.id, equipments.*')->pluck('id');*/
            $equipment =  DB::table('equipment_real_estate')->where('real_estate_id', $realEstate->id)->pluck('equipment_id')->toArray();
            return view('immo.show', compact('realEstate', 'equipment'));
        }else{
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit(string $realEstate)
    {   
        $realEstate = RealEstate::where('slug', $realEstate)->firstOrFail();   
        /*$equipment = RealEstate::join('equipment_real_estate', 'real_estates.id', '=', 'equipment_real_estate.real_estate_id')
        ->where('real_estates.id', $realEstate->id)->get('equipment_id');*/

        $equipment =  DB::table('equipment_real_estate')->where('real_estate_id', $realEstate->id)->pluck('equipment_id')->toArray();
        return view('immo.edit', compact('realEstate', 'equipment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  RealEstateRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(int $id, Request $request): RedirectResponse
    {
        $data = $request->all();
        $data['name'] = Str::ucfirst($data['name']);
        RealEstate::find($id)->update($data); 
        return redirect(action('RealEstateController@index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id): RedirectResponse
    {
        $realEstate = RealEstate::FindOrFail($id);
        $realEstate->delete();
        return redirect(action('RealEstateController@index'));
    }

    
    /**
     * Delete an image of real Estate
     *
     * @param  int $id
     * @param  string $image
     * @param  string $ext
     * @return \Illuminate\Http\Response
     */
    public function deleteImage(int $id = null, string $image, string $ext): JsonResponse
    {
        Storage::disk('public')->delete('/images/realEstates/' . $id . '/Large/' . $image . '.' . $ext);

        return response()->json([
            'message' => trans("Image_delete"),
        ]);
    }
}
