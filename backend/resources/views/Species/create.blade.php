@extends('layouts.app');

@section('title')
    Biography
@stop

@section('header')
    Create
@stop

@section('body')
    {{ Form::model($species, ['route'=>['species.store']]) }}
    {{ csrf_field() }}
    <div class="row flex-center">
        <h2>Species</h2>
    </div>
    <div class="row flex-center">
        <div class="col-md-3 species">
            {{ Form::label('genus_id', 'Genus or ') }}
            <a href="{{url('genus.create')}}">create new</a>
            {{ Form::select('genus_id', $genusArray, $species->genus_id, ['class' => 'form-control', 'onchange' => 'getSpecies(value);']) }}
        </div>
        <div class="col-md-3 species">
            {{ Form::label('name', 'Species') }}
            <br>
            {{ Form::text('name', 'Enter species name', ['class' => 'form-control', 'onfocus' => 'if (this.value=="Enter species name") this.value="";']) }}
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
        <div class="col-lg-8 col-md-9 col-sm-10 col-xs-11">
            {{ Form::label('rrna', '16S rRNA') }}
            <br>
            <div class="sequence">
                {{ Form::textarea('rrna', (old('rrna', $species->rrna) ? $species->rrna : ''), ['size'=>'100x6', 'class'=>'.sequence']) }}
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

    <div class="flex-center">
        <button type="submit" value="submit" class="btn btn-primary">Submit</button>
    </div>
    {{Form::close()}}
@stop
