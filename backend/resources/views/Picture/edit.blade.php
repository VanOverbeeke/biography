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
    <div class="row flex-center">
        <h2>Editing picture:</h2>
    </div>
    <br>
    <div class="row flex-center species">
        <div class="col-lg-4">
            {{ Form::label('imageable_type', 'Type') }}
            <br>
            {{Form::select('imageable_type', ['App\Models\Genus'=>'Genus', 'App\Models\Species'=>'Species'], $picture->imageable_type, ['class' => 'form-control', 'onchange'=>''])}}
        </div>
        <div class="col-lg-4">
            {{ Form::label('imageable_id', 'ID') }}
            <br>
            {{ Form::select('imageable_id', \App\Models\Genus::dropdown(), $picture->imageable_id, ['class' => 'form-control']) }}
        </div>
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
            {{ Form::close()}}
            @if(count($errors)>0))
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="col-md-1">
            {{ Form::open(['method'=>'DELETE', 'route'=>['picture.destroy', $picture->id]]) }}
            {{ Form::hidden('id', $picture->id) }}
            {{ Form::submit('Delete', ['class'=>'btn btn-danger btn-md']) }}
            {{ Form::close() }}
        </div>
    </div>

@stop
