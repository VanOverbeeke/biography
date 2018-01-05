@extends('layouts.app');

@section('title')
    Biography
@stop

@section('header')
    Create
@stop

@section('body')
    {{ Form::model($genus, ['route'=>['genus.store']]) }}
    {{ csrf_field() }}
    <div class="row flex-center">
        <div class="col-lg-3 col-md-5 col-sm-8 col-xs-10">
            <h2>Genus</h2>
            <br>
            {{ Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'Genus name']) }}
        </div>
    </div>
    <br>
    {{ Form::submit('Submit', ['class'=>'btn btn-primary']) }}
    {{ Form::close() }}
@stop

@section('footer')

@stop