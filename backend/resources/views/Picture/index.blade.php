@extends('layouts.app');

@section('title')
    Biography
@stop

@section('header')
    Pictures
@stop

@section('body')

     <br>
     <div class="row flex-center">
         <div class="col-lg-10">
             <div class="card-deck">
                 @foreach($pictureList as $picture)
                     <div class="card mt-4" style="width: 18rem;">
                         <a href="{{$picture->path}}"><img class="card-img-top" src="{{$picture->path}}" alt="Image not found"></a>
                         <div class="card-block">
                             <h5 class="card-title">{{ $picture['imageable_type'] }}: <br><br> {{ \App\Models\Genus::whereId($picture->imageable['genus_id'])->get()->first()['name'] }} {{ $picture->imageable['name'] }}</h5>
                             <p class="card-text"> Picture ID: {{$picture->id}} </p>
                             {{ Form::open(['method'=>'delete', 'route'=>['picture.destroy', $picture->id]]) }}
                             {{ Form::hidden('id', $picture->id) }}
                             {{ Form::submit('Delete', ['class'=>'btn btn-danger btn-lg']) }}
                             {{ Form::close() }}
                         </div>
                     </div>
                 @endforeach
             </div>
         </div>
     </div>
@stop

@section('footer')

@stop
