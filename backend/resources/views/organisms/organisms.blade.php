@extends('layouts.app');

@section('title')
    Biography
@stop

@section('header')
    Organisms
@stop

@section('body')

    <a href="https://en.wikipedia.org/wiki/{{$o}}">
        {{$o}}</a>
@stop

@section('footer')

@stop