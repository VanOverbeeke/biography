@extends('layouts.app');

@section('title')
    Biography
@stop

@section('header')
    Data entry accepted
@stop

@section('body')
    Data was successfully added to the database!
    <br><br>
    @if (is_array($name))
        @foreach($name as $i)
            <p>{{$i->name}}</p>
        @endforeach
    @elseif (is_string($name))
        <p>Value: {{ $name }}</p>
    @endif
@stop

@section('footer')

@stop