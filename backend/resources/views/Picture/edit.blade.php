@extends('layouts.app');

@section('title')
    Biography
@stop

@section('header')
    Edit
@stop

@section('body')
    {{ Form::model($picture, ['route'=>['picture.update', $picture->id], 'method'=>'put']) }}
    {{--{{ csrf_field() }}--}}
    {{ Form::hidden('id', $picture->id) }}
    {{ Form::hidden('imageable_id', $picture->imageable_id) }}
    {{ Form::hidden('imageable_type', $picture->imageable_type) }}

    <div class="row flex-center">
        <h2>Editing picture:</h2>
    </div>
    <br>
    <div class="row flex-center species">
        <h2>{{$picture->imageable_type}} with ID {{$picture->imageable_id}}</h2>
    </div>
    <div class="row flex-center" id="metrics">
        <div class="col-md-4">
            {{ Form::label('path', 'URL') }}
            <br>
            {{ Form::text('path', old('path', $picture->path), ['style'=>'width:100%']) }}
        </div>
    </div>

    <div class="row flex-center">
        <div class="col-md-1">
            {{ Form::submit('Submit', ['class'=>'btn btn-success btn-md']) }}
            {{ Form::close() }}
        </div>
        <div class="col-md-1">
            {{ Form::open(['method'=>'DELETE', 'route'=>['picture.destroy', $picture->id]]) }}
            {{ Form::hidden('id', $picture->id) }}
            {{ Form::submit('Delete', ['class'=>'btn btn-danger btn-md']) }}
            {{ Form::close() }}
        </div>
    </div>

@stop
