@extends('layouts.app');

@section('title')
    Biography
@stop

@section('header')
    Biography
@stop

@section('body')
    <h1>Genus</h1>
    <a href="{{route('genus.index')}}">Index</a>
    <a href="{{route('genus.create')}}">New</a>

    <br><br><br><br>

    <h1>Species</h1>
    <a href="{{route('species.index')}}">Index</a>
    <a href="{{route('species.create')}}">New</a>

    <br><br><br><br>

    <h1>Pictures</h1>
    <a href="{{route('picture.index')}}">Index</a>
    <a href="{{route('picture.create')}}">New</a>
@stop
