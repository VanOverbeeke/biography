@extends('layouts.app');

@section('title')
    Biography
@stop

@section('header')
    Details
@stop

@section('body')
    @foreach($organisms as $o)
        <p>Check out the <a href="https://en.wikipedia.org/wiki/{{$o}}">
            {{$o}}</a></p>
    @endforeach
@stop

@section('footer')

@stop