@extends('layouts.app');

@section('title')
    Biography
@stop

@section('header')
    Details
@stop

@section('body')
    <div id="controls">

        <div class="row flex-center">
            <div class="col-lg-3">
                <p>Sort by</p>
            </div>
            <div class="col-lg-3">
                <p>Filter by Species</p>
            </div>
            <div class="col-lg-3">
                <p>Reset Filters</p>
            </div>
        </div>

        <div class="row flex-center">
            <div class="col-lg-3 flex-center">
                @foreach([['id','ID'],['species','Species']] as $col)
                    <a href="{{route('genus.index', [
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
                    {{ (count($name = App\Models\Species::where('id','=',$filterBy)->get(['name'])) > 0 ) ? App\Models\Species::where('id','=',$filterBy)->get(['name'])[0]['name'] : 'All'}}
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item"
                        href="{{route('genus.index', [
                               'sortBy'=>$sortBy,
                               'filterBy'=>'%' ])}}">
                        All
                    </a>
                    @foreach(App\Models\Species::select(['id','name'])->get()->toArray() as $species)
                        <a class="dropdown-item"
                            href="{{route('genus.index', [
                               'sortBy'=>$sortBy,
                               'filterBy'=>$species['id'] ])}}">
                        {{$species['name']}}
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="col-lg-3 flex-center">
                <a href="{{route('genus.index', [
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
            <th> Genus </th>
            <th> Species </th>
        </tr>
        </thead>
        <tbody>
        @foreach($genus as $genu)
            <tr>
                <td><a class="genus">{{$genu->name}}</a></td>
                <td>
                    @foreach ($genu->species as $specie)
                        {{$specie->name}}{{ ($loop->last) ? '' : ',' }}
                    @endforeach
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop

@section('footer')

@stop