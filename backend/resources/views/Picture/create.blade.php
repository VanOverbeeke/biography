@extends('layouts.app');

@section('title')
    Biography
@stop

@section('header')
    Create
@stop

@section('body')
    {{ Form::model($picture, ['route'=>['picture.store']]) }}
    {{ csrf_field() }}
    <div class="row flex-center">
        <h2>Picture URL</h2>
        <div class="col-md-3">
            {{ Form::text('path', null, ['placeholder'=>'Enter picture URL here', 'class'=>'form-control']) }}
        </div>
    </div>
    <br>
    <div class="row flex-center">
        <h2>for</h2>
        <div class="col-md-3">
            <select class="form-control species" name="imageable">
                @foreach (\App\Models\Genus::dropdown() as $genus_id=>$genus_name)
                    <optgroup label="{{$genus_name}}">
                    <option value="App\Models\Genus|{{$genus_id}}">{{$genus_name}} (genus)</option>
                    @foreach(\App\Models\Species::where('genus_id', $genus_id)->dropdown() as $species_id=>$species_name)
                        <option style="margin-left:23px;" value="App\Models\Species|{{$species_id}}" >{{$species_name}}</option>
                    @endforeach
                @endforeach
            </select>
        </div>
    </div>
    <br>
    {{ Form::submit('Submit', ['class'=>'btn btn-primary']) }}
    {{ Form::close() }}

@stop
