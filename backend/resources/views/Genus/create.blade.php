@extends('layouts.app');

@section('title')
    Biography
@stop

@section('header')
    Create
@stop

@section('body')
    <form id="form" action="/genus" method="get">
        <div class="row flex-center">
            <div class="col-lg-3 col-md-5 col-sm-8 col-xs-10">
                <h2>Genus</h2>
                <br>
                <input type="string" class="form-control" id="name" placeholder="Genus name">
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@stop

@section('footer')

@stop