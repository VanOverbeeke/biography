@extends('layouts.app');

@section('title')
    Biography
@stop

@section('header')
    Species
@stop

@section('body')
    <div id="controls">
        <div class="row flex-center">
            <div class="col-lg-3">
                <p>Sort by</p>
            </div>
            <div class="col-lg-3">
                <p>Filter by Biome</p>
            </div>
            <div class="col-lg-3">
                <p>Reset Filters</p>
            </div>
        </div>
        <div class="row flex-center">
            <div class="col-lg-3 flex-center">
                @foreach([['id','ID'],['age','Age'],['size','Size'],['weight','Weight']] as $col)
                    <a href="{{route('species.index', [
                        'sortBy'=>$col[0],
                        'filterBy'=>$filterBy])}}"
                       class="<?php if($sortBy===$col[0]) { echo 'btn btn-primary btn-md'; } else { echo 'btn btn-info btn-md'; } ?>"
                       role="button">
                    {{$col[1]}}
                    </a>
                @endforeach
            </div>
            <div class="col-lg-3 flex-center">
                <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ (count($name = App\Models\Biome::where('id','=',$filterBy)->get(['name'])) > 0 ) ? App\Models\Biome::where('id','=',$filterBy)->get(['name'])[0]['name'] : 'All'}}
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a  class="dropdown-item"
                        href="{{route('species.index', [
                               'sortBy'=>$sortBy,
                               'filterBy'=>'%' ])}}">
                        All
                    </a>
                    @foreach(App\Models\Biome::select(['id','name'])->get()->toArray() as $biome)
                        <a  class="dropdown-item"
                            href="{{route('species.index', [
                               'sortBy'=>$sortBy,
                               'filterBy'=>$biome['id'] ])}}">
                        {{$biome['name']}}
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-3 flex-center">
                <a href="{{route('species.index', [
                     ])}}"
                   class="btn btn-info btn-md"
                   role="button">
                Reset
                </a>
            </div>
        </div>
    </div>
    <br>
    <table id="table" class="table flex-center">
        <thead>
        <tr>
            <th> Species </th>
            <th> Age (y) </th>
            <th> Max size (m) </th>
            <th> Max weight (kg) </th>
            <th> Biome </th>
        </tr>
        </thead>
        <tbody>
        @foreach($species as $specie)
            <tr>
                <td><a href="{{$specie->wiki}}" class="species">{{$specie->genus->name}} {{$specie->name}}</a></td>
                <td> {{$specie->age}} </td>
                <td> {{$specie->size}} </td>
                <td> {{$specie->weight}} </td>
                <td>
                    @foreach ($specie->biomes as $j)
                        {{$j->name}}{{ ($loop->last) ? '' : ',' }}
                    @endforeach
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop

@section('footer')

@stop