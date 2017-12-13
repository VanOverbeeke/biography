@extends('layouts.app');

@section('title')
    Biography
@stop

@section('header')
    Find
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
    </script>

    <form id="species" action="/species/find" method="get">
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
                <select class="form-control species" id="species_id" name="species_id">
                    <option value="">Select genus first</option>
                </select>
            </div>
        </div>
        <div class="row flex-center">
            <button type="submit" value="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@stop
