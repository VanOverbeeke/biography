@extends('layouts.app');

@section('title')
    Biography
@stop

@section('header')
    Edit
@stop

@section('body')
    <script type="text/javascript" src="/js/Species/getSpeciesAndBiomes.js"></script>
    {{ csrf_field() }}
    <form id="species" action="/species/update" method="post">
        <div class="row flex-center">
            <h2>Species</h2>
        </div>
        <div class="row flex-center">
            <div class="col-md-3">
                <label for="genus_id">Genus name</label>
                {{ Form::select('genus_id', $genus_array, $genus_id, ['class' => 'form-control', 'onchange' => 'getSpecies(value)']) }}
            </div>
            <div class="col-md-3">
                <label for="species">Species name</label>
                <select class="form-control species" id="species_id" name="species_id" onchange=getBiomes(value);>
                    <option value="{{$species_id}}">{{$species_name}}</option>
                </select>
            </div>
        </div>
        <br>
        <div class="row flex-center">
            <h2>Metrics</h2>
        </div>
        <div class="row flex-center" id="metrics">
        </div>

        <div class="row flex-center">
            <h2>Biomes</h2>
        </div>
        <div class="row flex-center">
            <div class ="form-group col-lg-6">
                <ul class="form-check list-group flex-row flex-wrap" id="biomes">
                </ul>
            </div>
        </div>
        <br>
        <div class="row flex-center">
            <button type="submit" value="submit" class="btn btn-primary">Submit</button>
            <a href="{{route('species.delete', [
                'species_id'=>$species_id
                     ])}}"
                class="btn btn-warning btn-md"
                role="button"
                disabled="true">
                Delete
            </a>
        </div>
    </form>
@stop
