@extends('layouts.app');

@section('title')
    Biography
@stop

@section('header')
    Search
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
        function printSpecies(speciesID) {
            var btn = $('#buttons');
            btn.empty();
            btn.append(
                '<br><br><br><br>'
            );
            btn.append(
                '<div class="col-md-1">' +
                '<form action="/species/index/' + speciesID + '">' +
                '<button type="submit" value="Submit" class="btn btn-primary">View</button>' +
                '</div></form>'
            );
            btn.append(
                '<div class="col-md-1">' +
                '<form action="/species/edit/' + speciesID + '">' +
                '<button type="submit" value="Submit" class="btn btn-primary">Edit</button>' +
                '</div>'
            );
        }
    </script>

    <form id="species" action="/species/find" method="get">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row flex-center">
            <h2>Species</h2>
        </div>
        <div class="row flex-center">
            <div class="col-md-3">
                <label for="genus">Genus name</label>
                {{--<select class="form-control species" id="genus-id" name="genus_id" onchange=getSpecies(value);>--}}
                    {{--<option value="None">Select genus</option>--}}
                    {{--@foreach(\App\Models\Genus::select(['id', 'name'])->get()->toArray() as $genus)--}}
                        {{--<option value="{{$genus['id']}}">{{$genus['name']}}</option>--}}
                    {{--@endforeach--}}
                {{--</select>--}}
                {{ Form::label('genus_id', 'Genus') }}
                {{ Form::select('genus_id', $genusArray, 'Select genus', ['class' => 'form-control', 'onchange' => 'getSpecies(value);']) }}
            </div>
{{--            <div class="row flex-center">
                <div class="col-md-3 species">
                    {{ Form::label('species_id', 'Select species') }}
                    {{ Form::select('species_id', [], '', ['class' => 'form-control', 'onchange' => 'printSpecies(value);']) }}
                </div>
            </div>--}}

            <div class="col-md-3">
                <label for="species">Species name</label>
                <select class="form-control species" id="species_id" name="species_id" onchange=printSpecies(value);>
                    <option value="">Select genus first</option>
                </select>
            </div>
        </div>
        <div class="row flex-center" id="buttons">
        </div>
    </form>
@stop
