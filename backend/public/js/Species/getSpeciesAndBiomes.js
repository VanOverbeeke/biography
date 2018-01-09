// $(function () {
//     // $("select#species_id").onload();
//     // $("select#biomes").onload();
//     // $("select#metrics").onload();
//     $("select#species_id").change();
//     $("select#biomes").change();
//     $("select#metrics").change();
// console.log(window.location);
//     getBiomes('<?php echo $species_id; ?>');
// });
//
// function getSpecies(genusID) {
//     $.ajax({
//         type: "GET",
//         url: "/getSpecies",
//         data: {'genus_id':genusID},
//         success: function(data) {
//             var species = $('#species_id');
//             species.empty();
//
//             species.append("<option value='None'>Select species</option>");
//             $.each(data, function (index, element) {
//                 species.append(
//                     '<option value="' + element.id + '">' +
//                     element.name +
//                     '</option>');
//             });
//         }
//     });
// }
//
// function getBiomes(speciesID) {
//     $.ajax({
//         type: "GET",
//         url: "/getBiomes",
//         data: {'species_id': speciesID},
//         success: function (data) {
//             var biomes = $('#biomes');
//             biomes.empty();
//             $.each(data, function (index, element) {
//                 biomes.append(
//                     '<li class="list-group-item form-check-input col-sm-3">' +
//                     '<input ' +
//                     'name="biomes[]" ' +
//                     'type="checkbox" ' +
//                     'class="" ' +
//                     'value="' + element["id"] + '" ' +
//                     element["checked"] +
//                     '>' +
//                     element["name"] +
//                     '</input>' +
//                     '</li>');
//             });
//         }
//     });
// }
//
// function getMetrics(speciesID) {
//     $.ajax({
//         type: "GET",
//         url: "/getMetrics",
//         data: {'species_id':speciesID},
//         success: function(data) {
//             var metrics = $('#metrics');
//             metrics.empty();
//
//             $.each(data, function (index, element) {
//                 metrics.append(
//                     '<div class="form-group col-md-2">' +
//                     '<label for="' + element["name"] + '">' +
//                     element["label"] +
//                     '</label>' +
//                     '<input ' +
//                     'type="' +element["type"] + '" ' +
//                     'class="form-control" ' +
//                     'id="' + element["name"] + '" ' +
//                     'name="' + element["name"] + '" ' +
//                     'value="' + element['old'] + '"' +
//                     '>' +
//                     '</div>'
//                 );
//             });
//         }
//     });
// }