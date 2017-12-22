@extends('layouts.app');

@section('title')
    Biography
@stop

@section('header')
    Edit
@stop

@section('body')
    {{ Form::model($species, ['route'=>['species.update', $species->id], 'method'=>'get']) }}
    {{ csrf_field() }}
    <div class="row flex-center">
        <h2>Species</h2>
    </div>
    <div class="row flex-center">
        <div class="col-md-3 species">
            {{ $genus }} {{ $name }}
            {{ Form::hidden('id', $species->id) }}
            {{ Form::hidden('genus_id', $species->genus_id) }}
            {{ Form::hidden('name', $species->name) }}
        </div>
    </div>

    <br>
    <div class="row flex-center">
        <h2>Metrics</h2>
    </div>
    <div class="row flex-center" id="metrics">
        <div class="col-md-2">
            {{ Form::label('weight', 'Weight') }}
            <br>
            {{ Form::number('weight', old('weight', $species->weight), ['step' => '0.01']) }}
        </div>
        <div class="col-md-2">
            {{ Form::label('size', 'Size') }}
            <br>
            {{ Form::number('size', old('size', $species->size), ['step' => '0.01']) }}
        </div>
        <div class="col-md-2">
            {{ Form::label('age', 'Age') }}
            <br>
            {{ Form::number('age') }}
        </div>
        <div class="col-md-2">
            {{ Form::label('wiki', 'Wiki') }}
            <br>
            {{ Form::url('wiki') }}
        </div>
    </div>
    <br>

    <div class="row flex-center">
        <h2>Genetics</h2>
    </div>
    <div class="row flex-center" id="rrna">
        <div class="col-lg-6 col-md-8 col-sm-10 col-xs-10">
            {{ Form::label('rrna', '16S rRNA') }}
            <br>
            <div class="sequence">
                {{ Form::textarea('rrna', '', ['size'=>'110x6', 'class'=>'.sequence']) }}
            </div>
        </div>
    </div>
    <br>
    <div class="row flex-center">
        <h2>Biomes</h2>
    </div>
    <div class="row flex-center">
        <div class ="form-group col-lg-8 col-md-8 col-sm-8 col-xs-8">
            <ul class="form-check list-group flex-row flex-wrap" id="biomes">
                @foreach($species->allBiomes() as $biome)
                    <li class="list-group-item form-check-input col-lg-3 col-md-4 col-sm-4 col-xs-6">
                        {{ Form::checkbox('biomes[]', $biome->id, $species->biomes->contains($biome->id) ? 'checked' : '') }}
                        {{ Form::label('biomes[]', $biome->name) }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <br>
    <div class="row flex-center">
        {{ Form::submit('Submit', ['class'=>'btn btn-success btn-md']) }}
        {{ Form::close() }}

        {{ Form::open(['method'=>'DELETE', 'route'=>['species.delete', $species->id]]) }}
            {{ Form::hidden('id', $species->id) }}
            {{ Form::submit('Delete', ['class'=>'btn btn-danger btn-md']) }}
        {{ Form::close() }}
    </div>

@stop
