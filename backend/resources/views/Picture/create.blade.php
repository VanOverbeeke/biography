@extends('layouts.app');

@section('title')
    Biography
@stop

@section('header')
    Create
@stop

@section('body')
    <form id="picture" action="/picture/create" method="post">
        {{ Form::model($picture, ['route'=>['picture.create',$picture->id]]) }}
        {{ csrf_field() }}
        <div class="row flex-center">
            <h2>Picture</h2>
        </div>
        <div class="row flex-center">
            <div class="col-md-3">
                {{ Form::label('path', 'URL') }}
                <br>
                {{ Form::text('path', 'Enter picture URL here') }}
            </div>
            <div class="col-md-3">
                {{ Form::label('imageable_type', 'Type') }}
                <br>
                {{ Form::select('imageable_type', ['Genus'=>'App\Models\Genus', 'Species'=>'App\Models\Species'], null, ['class' => 'form-control']) }}
            </div>
            <div class="col-md-3 species">
                {{ Form::label('imageable_id', 'ID') }}
                <br>
                {{ Form::number('imageable_id', 1) }}
            </div>
        </div>

        <div class="flex-center">
            <button type="submit" value="submit" class="btn btn-primary">Submit</button>
        </div>

    </form>
@stop
