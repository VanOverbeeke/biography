@extends('layouts.app');

@section('title')
    Biography
@stop

@section('header')
    Biography
@stop

@section('body')
    <h1>Genus</h1>
    <a href="/genus/index">Browse</a>
    <a href="/genus/create">New</a>

    <br><br><br><br>

    <h1>Species</h1>
    <a href="/species/index">Browse</a>
    <a href="/species/create">New</a>
    <a href="/species/edit">Edit</a>
@stop
