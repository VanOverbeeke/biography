@extends('layouts.app');

@section('title')
    Biography
@stop

@section('header')
    Edit
@stop

@section('body')
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
        function getBiomes(speciesID) {
            $.ajax({
                type: "GET",
                url: "/getBiomes",
                data: {'species_id':speciesID},
                success: function(data) {
                    var biomes = $('#biomes');
                    biomes.empty();

                    $.each(data, function (index, element) {
                        biomes.append(
                            '<li class="list-group-item col-sm-3">' +
                                '<input ' +
                                    'name="biomes[]" ' +
                                    'type="checkbox" ' +
                                    'class="form-check-input" ' +
                                    'value="' + element["id"] + '" ' +
                                    element["checked"] +
                                '>' +
                                    element["name"] +
                                '</input>' +
                            '</li>');
                    });
                }
            });
            $.ajax({
                type: "GET",
                url: "/getMetrics",
                data: {'species_id':speciesID},
                success: function(data) {
                    var metrics = $('#metrics');
                    metrics.empty();

                    $.each(data, function (index, element) {
                        metrics.append(
                            '<div class="form-group col-md-2">' +
                                '<label for="' + element["name"] + '">' +
                                    element["label"] +
                                '</label>' +
                                '<input ' +
                                    'type="' +element["type"] + '" ' +
                                    'class="form-control" ' +
                                    'id="' + element["name"] + '" ' +
                                    'name="' + element["name"] + '" ' +
                                    'value="' + element['old'] + '"' +
                                '>' +
                            '</div>'
                        );
                    });
                }
            });
        }
    </script>

    <form id="species" action="/species/update" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row flex-center">
            <h2>Species</h2>
        </div>
        <div class="row flex-center">
            <div class="col-md-3">
                <label for="genus">Genus name</label>
                <select class="form-control species" id="genus-id" name="genus_id" onchange=getSpecies(value);>
                    <option value="None">Select genus</option>
                    @foreach(\App\Models\Genus::select(['id', 'name'])->get()->toArray() as $genus)
                        <option value="{{$genus['id']}}">{{$genus['name']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="species">Species name</label>
                <select class="form-control species" id="species_id" name="species_id" onchange=getBiomes(value);>
                    <option value="">Select genus first</option>
                </select>
            </div>
        </div>
        <br>
        <div class="row flex-center">
            <h2>Metrics</h2>
        </div>
        <div class="row flex-center" id="metrics">
        </div>

        <div class="row flex-center">
            <h2>Biomes</h2>
        </div>
        <div class="row flex-center">
            <div class ="form-group col-lg-6">
                <ul class="form-check list-group flex-row flex-wrap" id="biomes">
                </ul>
            </div>
        </div>
        <br>
        <div class="row flex-center">
            <button type="submit" value="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@stop
