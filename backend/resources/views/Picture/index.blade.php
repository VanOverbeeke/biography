@extends('layouts.app');

@section('title')
    Biography
@stop

@section('header')
    Pictures
@stop

@section('body')
     <table id="table" class="table flex-center">
        <thead>
        <tr>
            <th> ID</th>
            <th> URL</th>
            <th> For Type</th>
            <th> For ID</th>
        </tr>
        </thead>
        <tbody>
        @foreach($pictureList as $picture)
            <tr>
                <td>{{ $picture['id'] }}</td>
                <td><a href="{{$picture->url}}" class="picture">URL</a></td>

                <td>{{ $picture['imageable_type'] }}</td>
                <td>{{ $picture['imageable_id'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop

@section('footer')

@stop
