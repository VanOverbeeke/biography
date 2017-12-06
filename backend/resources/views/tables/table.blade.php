@extends('layouts.app');

@section('title')
    Biography
@stop

@section('header')
    Details
@stop

@section('body')

    <div id="tabular">
        <table>
            <thead>
            <tr>
                <th> Species </th>
                <th> Max Age (y) </th>
                <th><a href="{{\App\Http\Controllers\Biography\SpeciesController::show_table('size')}}"> Max size (m) </a></th>
                <th> Max weight (kg) </th>
                <th> Biome </th>
            </tr>
            </thead>
            <tbody>
            @foreach($details as $i)

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