@extends('layouts.app');

@section('title')
    Biography
@stop

@section('header')
    Data request accepted
@stop

@section('body')

    <p>Data was successfully retrieved from the database. Data type: {{ gettype($name) }}</p>
    <br><br>
    @if (is_array($name))
        @foreach($name as $i)
            <p>{{ $i }}</p>
        @endforeach
    @elseif (is_string($name))
        <p>Value: {{ $name }}</p>
    @elseif (is_object($name))
        <pre>
            <?php
                print_r($name);
            ?>
        </pre>
    @endif
@stop

@section('footer')

@stop