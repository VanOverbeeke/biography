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
        <h2>Picture</h2>
    </div>
    <div class="row flex-center">
        <div class="col-md-3">
            {{ Form::label('path', 'URL') }}
            <br>
            {{ Form::text('path', null, ['placeholder'=>'Enter picture URL here']) }}
        </div>
        <div class="col-md-3">
            {{ Form::label('imageable_type', 'Type') }}
            <br>
            {{ Form::select('imageable_type', ['App\Models\Genus'=>'Genus', 'App\Models\Species'=>'Species'], null, ['class' => 'form-control']) }}
        </div>
        <div class="col-md-3 species">
            {{ Form::label('imageable_id', 'ID') }}
            <br>
            {{ Form::select('imageable_id', [1,2,3,4,5,6,7,8,9,10], null, ['class' => 'form-control']) }}
        </div>
    </div>
    {{ Form::submit('Submit', ['class'=>'btn btn-primary']) }}
    {{ Form::close() }}
@stop
