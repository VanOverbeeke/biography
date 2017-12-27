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
            <div class="col-lg-4">
                <p>Sort by</p>
            </div>
            <div class="col-lg-2">
                <p>Filter by Biome</p>
            </div>
            <div class="col-lg-3">
                <p>Reset Filters</p>
            </div>
        </div>
        <div class="row flex-center">
            <div class="col-lg-4 flex-center">
                @foreach([['id','ID'],['genus_id','Genus'],['age','Age'],['size','Size'],['weight','Weight']] as $col)
                    <a href="{{route('species.index', [
                           'species_id' => $queryParams['species_id'],
                           'genus_id' => $queryParams['genus_id'],
                           'sortBy' => $col[0],
                           'filterByBiomes' => $queryParams['filterByBiomes']
                           ])}}"
                       class="<?php if($queryParams['sortBy']===$col[0]) { echo 'btn btn-primary btn-md'; } else { echo 'btn btn-info btn-md'; } ?>"
                       role="button">
                    {{$col[1]}}
                    </a>
                @endforeach
            </div>
            <div class="col-lg-2 flex-center">
                {{ Form::open(['method'=>'get','route'=>['species.index']])}}
                {{ Form::hidden('species_id', $queryParams['species_id'] ) }}
                {{ Form::hidden('genus_id', $queryParams['genus_id'] ) }}
                {{ Form::hidden('sortBy', $queryParams['sortBy'] ) }}
                {{ Form::select('filterByBiomes', array_prepend(App\Models\Biome::pluck('name','id')->toArray(), 'All', 0), null, [
                        'class'=>'btn btn-success dropdown-toggle form-control ',
                        'type'=>"button",
                        'id'=>'biomeSelector',
                        'onchange'=>'this.form.submit()'
                ]) }}
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
            <th> Edit </th>
            <th> Species </th>
            <th> Age (y) </th>
            <th> Max size (m) </th>
            <th> Max weight (kg) </th>
            <th> Biome </th>
            <th> 18S rRNA </th>
        </tr>
        </thead>
        <tbody>
        @foreach($species as $specie)
            <tr>
                <td>{{ Form::open(['route' => ['species.edit', $specie->id], 'method' => 'get']) }}
                    {{ Form::submit('Edit', ['class'=>'btn btn-success']) }}
                    {{ Form::close()}}
                </td>
                <td><a href="{{$specie->wiki}}" class="species">{{$specie->genus->name}} {{$specie->name}}</a></td>
                <td> {{$specie->age}} </td>
                <td> {{$specie->size}} </td>
                <td> {{$specie->weight}} </td>
                <td>
                    @foreach ($specie->biomes as $j)
                        {{$j->name}}{{ ($loop->last) ? '' : ',' }}
                    @endforeach
                </td>
                <td> {{ $specie->rrna }} </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <script>
        function getSpecies(genusID) {
            $.ajax({
                type: "GET",
                url: "/getSpecies",
                data: {'genus_id':genusID},
                success: function(data) {
                    var species = $('#species_id');
                    species.empty();

                    species.append("<option value='None'>Select species</option>");
                    $.each(data, function (index, element) {
                        species.append(
                            '<option value="' + element.id + '">' +
                            element.name +
                            '</option>');
                    });
                }
            });
        }
    </script>
@stop

@section('footer')

@stop
