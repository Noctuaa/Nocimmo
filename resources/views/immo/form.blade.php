<form method="POST" enctype="multipart/form-data"
    action="{{ action("RealEstateController@$action", $action === "update" ? $realEstate : '') }}">
    @csrf
    <div class="form-group row">
        <div class="col">
            <div class="card-gray-dark shadow mb-4">
                <div class="card-header py-2 text-light">
                    Titre
                </div>
                <div class="card-body">
                    <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name"
                        value="{{ $action == 'store' ? old('name') : $realEstate->name}}"
                        placeholder="{{ __('Saisissez le titre') }}" autofocus>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="slug" id="slug">
    <div class="form-group row">
        <div class="col-sm-12 col-md-9">
            <div class="card-gray-dark shadow mb-4">
                <div class="card-header py-2 text-light">
                    Description
                </div>
                <div class="card-body">
                    <textarea rows="11" cols="33" name="description" id="description" placeholder="Description"
                        class="form-control @error('description') is-invalid @enderror">{{ $action == 'store' ? old('description') : $realEstate->description}}</textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-3">
            <div class="card-gray-dark shadow mb-4">
                <div class="card-header py-2 text-light">
                    Catégories
                </div>
                <div class="card-body">
                    <div class="custom-control custom-switch">
                        <input class="custom-control-input @error('category') is-invalid @enderror" type="radio" id="sales"
                            name="category" value="sales" @if ($action=='store' ? old('category') : $realEstate->category === "sales")
                        checked
                        @endif>
                        <label class="custom-control-label" for="sales">Vente</label>
                    </div>
                    <div class="custom-control custom-switch">
                        <input class="custom-control-input @error('category') is-invalid @enderror" type="radio" id="rentals"
                            name="category" value="rentals" @if ($action=='store' ? old('category') : $realEstate->category ===
                        "rentals")
                        checked
                        @endif>
                        <label class="custom-control-label" for="rentals">Location</label>
                        @error('category')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-gray-dark shadow mb-4">
                <div class="card-header py-2 text-light">
                    Vignette
                </div>
                <div class="card-body">
                    <image-upload :multiple="{{'false'}}" name="thumbnail"
                        message="@error('thumbnail') {{$message}} @enderror"
                        error="@error('thumbnail') is-invalid @enderror" @if($action==="update" ) :edit="{{'true'}}"
                        :image="{{json_encode($realEstate->thumbnail)}}" @endif>
                    </image-upload>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-12">
            <div class="card-gray-dark shadow mb-4">
                <div class="card-header py-2 text-light">
                    Images
                </div>
                <div class="card-body">
                    <image-upload :multiple="{{'true'}}" name="images" message="@error('images') {{$message}} @enderror"
                        error="@error('images') is-invalid @enderror" @if($action==="update" )
                        realestate="{{$realEstate->id}}" :edit="{{'true'}}"
                        :image="{{json_encode($realEstate->images)}}" @endif>
                    </image-upload>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-12">
            <div class="card-gray-dark shadow mb-4">
                <div class="card-header py-2 text-light">
                    Détails de la propriété
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6 col-sm-12">
                            <label for="address">Adresse :</label>
                            <input name="address" id="address" type="text" class="form-control @error('address') is-invalid @enderror"
                                value="{{ $action == 'store' ? old('address') : $realEstate->address }}">
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-3 col-sm-6 mt-sm-3 mt-md-0">
                            <label for="area">Superficie (m2) :</label>
                            <input min="0" type="number" id="area" name="area"
                                class="form-control @error('area') is-invalid @enderror"
                                value="{{ $action == 'store' ? old('area') : $realEstate->area}}">
                            @error('area')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-3 col-sm-6 mt-sm-3 mt-md-0">
                            <label for="price">Prix :</label>
                            <input min="0" type="number" id="price" name="price"
                                class="form-control @error('price') is-invalid @enderror"
                                value="{{ $action == 'store' ? old('price') : $realEstate->price}}">
                            @error('price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-3 col-sm-6 mt-sm-3">
                            <label for="bedroom">Chambre :</label>
                            <input min="0" type="number" id="bedroom" name="bedroom"
                                class="form-control @error('bedroom') is-invalid @enderror"
                                value="{{ $action == 'store' ? old('bedroom') : $realEstate->bedroom}}">
                            @error('bedroom')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-3 col-sm-6 mt-sm-3">
                            <label for="bathroom">Salle de bain :</label>
                            <input min="0" type="number" id="bathroom" name="bathroom"
                                class="form-control @error('bathroom') is-invalid @enderror"
                                value="{{$action == 'store' ? old('bathroom') : $realEstate->bathroom }}">
                            @error('bathroom')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-3 col-sm-6 mt-sm-3">
                            <label for="wc">Wc :</label>
                            <input min="0" type="number" id="wc" name="wc"
                                class="form-control @error('wc') is-invalid @enderror"
                                value="{{$action == 'store' ? old('wc') : $realEstate->wc}}">
                            @error('wc')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-12">
            <div class="card-gray-dark shadow mb-4">
                <div class="card-header py-2 text-light">
                    Equipements
                </div>
                <div class="card-body">
                    <div class="row mb-4 @error('equipment') is-invalid @enderror">
                        @foreach (App\Equipment::pluck('name', 'id') as $key => $value)
                        <div class="col-md-4 col-sm-6 form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" name="equipment_id[]" class="custom-control-input"
                                    id="customSwitch{{$key}}" value="{{$key}}"
                                    @if($action == 'store' && is_array(old('equipment_id')) && in_array($key, old('equipment_id'))) checked @endif
                                    @if($action == 'update')
                                        @if(in_array($key, $equipment)) checked @endif
                                    @endif>
                                <label class="custom-control-label" for="customSwitch{{$key}}">{{$value}}</label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @error('equipment')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row justify-content-center">
        <button type="submit" class="btn bg-gradient-primary">
            {{ __('Publier') }}
        </button>
    </div>
</form>
