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
            <th> Delete </th>
            <th> ID</th>
            <th> Picture</th>
            <th> Type</th>
            <th> ID</th>
            <th> Name </th>
        </tr>
        </thead>
        <tbody>
        @foreach($pictureList as $picture)
            <tr>
                <td>
                    {{ Form::open(['method'=>'DELETE', 'route'=>['picture.delete', $picture->id]]) }}
                    {{ Form::hidden('id', $picture->id) }}
                    {{ Form::submit('Delete', ['class'=>'btn btn-danger btn-md']) }}
                    {{ Form::close() }}
                </td>
                <td><a href="/pictures/{{ $picture['id'] }}">{{ $picture['id'] }}</a></td>
                <td><a href="{{$picture->path}}"><img src="{{$picture->path}}" width="300px" height="300px"></a></td>
                <td>{{ $picture['imageable_type'] }}</td>
                <td>{{ $picture['imageable_id'] }}</td>
                <td>{{ $picture['imageable_type']::find($picture['imageable_id'])->name }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop

@section('footer')

@stop
