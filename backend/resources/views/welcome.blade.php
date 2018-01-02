@extends('layouts.app');

@section('title')
    Biography
@stop

@section('header')
    Biography
@stop

@section('body')
    <h1>Genus</h1>
    <a href="/genus/index">Index</a>
    <a href="/genus/create">New</a>

    <br><br><br><br>

    <h1>Species</h1>
    <a href="/species/index">Index</a>
    <a href="/species/create">New</a>

    <br><br><br><br>

    <h1>Pictures</h1>
    <a href="/picture/index">Index</a>
    <a href="/picture/create">New</a>
@stop
