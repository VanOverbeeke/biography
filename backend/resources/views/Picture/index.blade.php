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
            <th> Delete </th>
            <th> Edit </th>
            <th> Picture</th>
            <th> Type</th>
            <th> ID</th>
            <th> Name </th>
        </tr>
        </thead>
        <tbody>
        @foreach($pictureList as $picture)
            <tr>
                <td><a href="/picture/{{$picture->id}}">{{$picture->id}}</a></td>
                <td>
                    {{ Form::open(['method'=>'delete', 'route'=>['picture.destroy', $picture->id]]) }}
                    {{ Form::hidden('id', $picture->id) }}
                    {{ Form::submit('Delete', ['class'=>'btn btn-danger btn-sm']) }}
                    {{ Form::close() }}
                </td>
                <td>
                    {{ Form::open(['route' => ['picture.edit', $picture->id], 'method' => 'get']) }}
                    {{ Form::submit('Edit', ['class'=>'btn btn-success btn-sm']) }}
                    {{ Form::close()}}
                </td>
                <td><a href="{{$picture->path}}"><img src="{{$picture->path}}" width="300px" height="300px"></a></td>
                <td>{{ $picture['imageable_type'] }}</td>
                <td>{{ $picture['imageable_id'] }}</td>
                <td>{{ $picture['imageable_type']::findOrFail($picture['imageable_id'])->name }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop

@section('footer')

@stop
