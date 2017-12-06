@extends('layouts.app');

@section('title')
    Biography
@stop

@section('header')
    Details
@stop

@section('body')
    <div id="controls">
        {{ Form::button('Sort by weight', ['class'=>'btn', 'href'=>"/details/weight"]) }}
    </div>
    <div id="tabular">
        <table>
            <thead>
            <tr>
                <th> Species </th>
                <th><a href="/details/age"> Max Age (y) </a></th>
                <th><a href="/details/size"> Max size (m) </a></th>
                <th><a href="/details/weight"> Max weight (kg) </a></th>
                <th> Biome </th>
            </tr>
            </thead>
            <tbody>
            @foreach($species->sortBy($sortBy) as $i)
                <tr>
                    <div class="table species">
                        <td><a href="{{$i->wiki}}" class="species">{{$i->genus->name}} {{$i->name}}</a></td>
                    </div>
                    <div class="table">
                        <td> {{$i->age}} </td>
                        <td> {{$i->size}} </td>
                        <td> {{$i->weight}} </td>
                        <td>
                            @foreach ($i->biomes as $j)
                                {{$j->name}}{{ ($loop->last) ? '' : ',' }}
                            @endforeach
                        </td>
                    </div>
                </tr>

            @endforeach
            </tbody>
        </table>
    </div>
@stop

@section('footer')

@stop