@extends('layouts.app');

@section('title')
    Biography
@stop

@section('header')
    Search
@stop

@section('body')
    {{--<form id="species" action="/species/find" method="get">--}}
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row flex-center">
            <h2>Species</h2>
        </div>
        <div class="row flex-center">
            <div class="col-md-3">
                {{ Form::label('genus_id', 'Genus') }}
                {{ Form::select('genus_id', $genusArray, 'Select genus', ['class' => 'form-control', 'onchange' => 'getSpecies(value);']) }}
            </div>
            <div class="col-md-3">
                {{ Form::label('species_id', 'Species') }}
                <select class="form-control species" id="species_id" name="species_id" onchange=speciesButtons(value);>
                    <option value="">Select genus first</option>
                </select>
            </div>
            {{ Form::close() }}
        </div>
        <br>
        <div id="buttons" class="row flex-center"></div>
        <br>
        <div class="row flex-center">
            <div class="col-md-3">
                {{ Form::label('query', 'Search species name') }}
                {{ Form::open(['route'=>['species.query'], 'method'=>'get']) }}
                {{ Form::text('query') }}
                {{ Form::select('query', [], 'Select genus', ['class' => 'form-control', 'onchange' => 'getQueryResults(value);']) }}
                {{ Form::submit('Search', ['class'=>'btn btn-md btn-success']) }}
                {{ Form::close() }}
            </div>
        </div>
        <div class="row flex-center">
            <div class="col-md-6" id="results" name="results">
            </div>
        </div>
    {{--</form>--}}
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
        function getQueryResults(genusID) {
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
        function speciesButtons(speciesID) {
            var btn = $('#buttons');
            btn.empty();
            btn.append(
                '<div class="col-*-8">' +
                '<form action="/species/index/' + speciesID + '">' +
                '<button type="submit" value="Submit" class="btn btn-primary">View</button>' +
                '</form>' +
                '</div>' +
                '<div class="col-*-8">' +
                '<form action="/species/edit/' + speciesID + '">' +
                '<button type="submit" value="Submit" class="btn btn-primary">Edit</button>' +
                '</form>' +
                '</div>'
            );
        }
        function searchSpecies(string) {

        }
    </script>
@stop
