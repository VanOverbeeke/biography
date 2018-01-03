@extends('layouts.app');

@section('title')
    Biography
@stop

@section('header')
    Species
@stop

@section('body')
    {{ Form::open(['method'=>'get','route'=>['species.index']])}}
    <?php if (!isset($requestParams['sortDir'])) {
        $requestParams['sortDir'] = true;
    };
    ?>
    <?php if (!isset($requestParams['sortBy'])) {
        $requestParams['sortBy'] = 'name';
    };
    ?>
    <div id="controls">
        <div class="row flex-center">
            <div class="col-lg-2">
                <p>Filter by name</p>
            </div>
            <div class="col-lg-2">
                <p>Single biome</p>
            </div>
            <div class="col-lg-2">
                <p>Multi biome</p>
            </div>
            <div class="col-lg-4">
                <p>Sort by</p>
            </div>
        </div>
        <div class="row flex-center">
            <div class="col-lg-2">
                <div class="input-group flex-center">
                    {{ Form::text('query', null, ['class'=>'form-control input-lg rightspaced']) }}  {{ Form::submit('Apply', ['route'=>'species.index', 'class'=>'btn btn-secondary']) }}
                </div>
            </div>
            <div class="col-lg-2 flex-center">
                {{ Form::select('oneBiome', array_prepend(App\Models\Biome::pluck('name','id')->toArray(), 'All', 0), null, [
                        'class'=>'btn btn-success light',
                        'type'=>'button',
                        'id'=>'biomeSelector',
                        'onchange'=>'this.form.submit()'
                ]) }}
            </div>
            <div class="col-lg-2 flex-center">
                {{ Form::select('multiBiome', array_prepend(App\Models\Biome::pluck('name','id')->toArray(), 'All', 0), null, [
                        'class'=>'btn btn-secondary',
                        'type'=>'button',
                        'id'=>'biomeSelector',
                        'onchange'=>'this.form.submit()'
                ]) }}
            </div>
            <div class="col-lg-4 flex-center">
                @foreach([['name','Name'],['genus_id','Genus'],['age','Age'],['size','Size'],['weight','Weight']] as $filter)
                    <a href="{{route('species.index', array_replace($requestParams, ['sortBy'=> $filter[0], 'sortDir'=>($filter[0]===$requestParams['sortBy'])?(!$requestParams['sortDir']):true]))}}"
                       class="<?php if ($requestParams['sortBy'] === $filter[0]) {
                           echo 'btn btn-primary rightspaced';
                       } else {
                           echo 'btn btn-info rightspaced';
                       } ?>"
                       role="button">
                        {{$filter[1]}}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    <br>
    <div class="row flex-center">
        <div class="col-lg-2 col-md-3 col-sm-4 flex-center">
            <p>Age</p>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-4 flex-center">
            <p>Size</p>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-4 flex-center">
            <p>Weight</p>
        </div>
        <div class="col-lg-4 col-md-3 col-sm-4 flex-center">
            <p>Active Filters</p>
        </div>
    </div>
    <div class="row flex-center">
        <div class="col-lg-2 col-md-3 col-sm-4 ">
            {{ Form::number('ageLarger', null, ['class'=>'form-control agecolor', 'placeholder'=>'>=','step' => '0.01']) }}
            {{ Form::number('ageSmaller', null, ['class'=>'form-control agecolor', 'placeholder'=>'<=','step' => '0.01']) }}
            {{ Form::number('ageEqual', null, ['class'=>'form-control agecolor', 'placeholder'=>'=','step' => '0.01']) }}
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 ">
            {{ Form::number('sizeLarger', null, ['class'=>'form-control sizecolor', 'placeholder'=>'>=','step' => '0.01']) }}
            {{ Form::number('sizeSmaller', null, ['class'=>'form-control sizecolor', 'placeholder'=>'<=','step' => '0.01']) }}
            {{ Form::number('sizeEqual', null, ['class'=>'form-control sizecolor', 'placeholder'=>'=','step' => '0.01']) }}
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 ">
            {{ Form::number('weightLarger', null, ['class'=>'form-control weightcolor', 'placeholder'=>'>=','step' => '0.01']) }}
            {{ Form::number('weightSmaller', null, ['class'=>'form-control weightcolor', 'placeholder'=>'<=','step' => '0.01']) }}
            {{ Form::number('weightEqual', null, ['class'=>'form-control weightcolor', 'placeholder'=>'=','step' => '0.01']) }}
        </div>
        <div class="col-lg-4 flex-center">
            <?php $length = 0 ?>
            @foreach (array_keys($requestParams) as $input)
                @if ($input!='sortDir')
                    @if ($requestParams[$input] and $requestParams[$input]!='id')
                        <?php $length = $length + 1 ?>
                        <a type="button"
                           class="btn btn-warning rightspaced"
                           href="{{route('species.index', array_replace($requestParams, [$input=>null]))}}">{{$input}}
                        </a>
                    @endif
                @endif
            @endforeach
            @if ($length > 1)
                <a type='button' class="btn btn-danger rightspaced" href="{{route('species.index')}}">Remove all</a>
            @elseif($length < 1)
                <a>None</a>
            @endif
        </div>
    </div>
    <br>
    <table id="table" class="table flex-center">
        <thead>
        <tr>
            <th> Edit</th>
            <th> Species</th>
            <th> Age (y)</th>
            <th> Max size (m)</th>
            <th> Max weight (kg)</th>
            <th> Biome</th>
            <th> 18S rRNA</th>
            <th> Pictures</th>
        </tr>
        </thead>
        <tbody>
        @foreach($speciesList as $species)
            <tr>
                <td>{{ Form::open(['route' => ['species.edit', $species->id], 'method' => 'get']) }}
                    {{ Form::submit('Edit', ['class'=>'btn btn-success btn-sm']) }}
                    {{ Form::close()}}
                </td>
                <td><a href="{{$species->wiki}}" class="species">{{$species->genus->name}} {{$species->name}}</a></td>
                <td> {{$species->age}} </td>
                <td> {{$species->size}} </td>
                <td> {{$species->weight}} </td>
                <td>
                    @foreach($species->biomes as $biome)
                        {{$biome->name}}{{ ($loop->last) ? '' : ',' }}
                    @endforeach
                </td>
                <td> {{ ($species->rrna) ? 'FASTA' : '' }} </td>
                <td>
                    @foreach ($species->pictures() as $pic)
                        <a href="{{$pic->path}}"><img src="{{$pic->path}}" width="100px" height="100px"></a>
                    @endforeach
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <script>
        function getSpecies(genusID) {
            $.ajax({
                type: "GET",
                url: "/getSpecies",
                data: {'genus_id': genusID},
                success: function (data) {
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

            function getQueryResults(genusID) {
                $.ajax({
                    type: "GET",
                    url: "/getSpecies",
                    data: {'genus_id': genusID},
                    success: function (data) {
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
        }
    </script>
@stop

@section('footer')

@stop
