@extends('layouts.app');

@section('title')
    Biography
@stop

@section('header')
    Create
@stop

@section('body')
    <form id="species" action="/species" method="get">

        <div class="row flex-center">
            <h2>Species</h2>
        </div>
        <div class="row flex-center">
            <div class="col-lg-2">
                <label for="genus">Genus name or <a href="/genus/create">create new</a>
                </label>
                <select class="form-control species" id="genus" name="genus_id"  value="{{ old('genus_id') }}">
                    @foreach(\App\Models\Genus::select(['id', 'name'])->get()->toArray() as $genus)
                        <option value="{{$genus['id']}}">{{$genus['name']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-2">
               <label for="species">Species name</label>
               <input type="string" class="form-control species" id="species" name="name" placeholder="Species name" value="{{ old('name') }}">
            </div>
        </div>

        <br>

        <div class="row flex-center">
            <h2>Metrics</h2>
        </div>
        <div class="row flex-center">
            <div class ="form-group col-lg-2">
                <label for="weight">Weight (kg)</label>
                <input type="float" class="form-control" id="weight" name="weight" value="{{ old('weight') }}">
            </div>
            <div class ="form-group col-lg-2">
                <label for="species">Size</label>
                <input type="float" class="form-control" id="size" name="size" value="{{ old('size') }}">
            </div>
        </div>

        <div class="row flex-center">
            <div class ="form-group col-lg-2">
                <label for="species">Lifespan</label>
                <input type="float" class="form-control" id="age" name="age" value="{{ old('age') }}">
            </div>
            <div class ="form-group col-lg-2">
                <label for="species">Encyclopedia</label>
                <input type="url" class="form-control" id="wiki" name="wiki" value="{{ old('wiki') }}">
            </div>
        </div>

        <div class="row flex-center">
            <h2>Habitat</h2>
        </div>
        <div class="row flex-center">
            <div class ="form-group col-lg-5">
                <div class="form-check">
                    @foreach(\App\Models\Biome::select(['id','name'])->get()->toArray() as $biome)
                        <label class="form-check-label">
                            <input name="biomes[]" type="checkbox" class="form-check-input" value="{{$biome['id']}}">
                            {{$biome['name']}}
                        </label>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="flex-center">
            <button type="submit" value="submit" class="btn btn-primary">Submit</button>
        </div>

    </form>
@stop
