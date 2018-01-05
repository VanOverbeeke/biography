@extends('layouts.app');

@section('title')
    Biography
@stop

@section('header')
    Edit
@stop

@section('body')
    {{ Form::model($genus, ['route'=>['genus.update', $genus->id], 'method'=>'put']) }}
    {{--{{ csrf_field() }}--}}
    {{ Form::hidden('id', $genus->id) }}

    <div class="row flex-center">
        <h2>Editing genus:</h2>
    </div>
    <br>
    <div class="row flex-center species">
        <h2>{{$genus->name}}</h2>
    </div>
    <div class="row flex-center">
        <a>with ID {{$genus->id}}</a>
    </div>
    <br><br>
    <div class="row flex-center" id="name">
        <div class="col-md-4">
            {{ Form::label('name', 'Name') }}
            <br>
            {{ Form::text('name', old('name', $genus->name), ['style'=>'width:100%']) }}
        </div>
    </div>

    <div class="row flex-center">
        <div class="col-md-1">
            {{ Form::submit('Submit', ['class'=>'btn btn-success btn-md']) }}
            {{ Form::close() }}
        </div>
        <div class="col-md-1">
            {{ Form::open(['method'=>'DELETE', 'route'=>['picture.destroy', $genus->id]]) }}
            {{ Form::hidden('id', $genus->id) }}
            {{ Form::submit('Delete', ['class'=>'btn btn-danger btn-md']) }}
            {{ Form::close() }}
        </div>
    </div>

@stop
