$(document).ready(function () {
    $('.autocompleteApi').on("input", function (error) {
        var stations = {};
        var input = $(this).val();
        getAutocompleteFromApi(input, stations);
    });

    $('.autocompleteDB').on("input", function (error) {
        var stations = {};
        var input = $(this).val();
        getAutocompleteFromDB(input, stations);
    });

    Materialize.updateTextFields();

    $('.modal').modal();
    $('select').material_select();
    $('.timepicker').pickatime({
        default: 'now', // Set default time: 'now', '1:30AM', '16:30'
        fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
        twelvehour: false, // Use AM/PM or 24-hour format
        donetext: 'OK', // text for done-button
        cleartext: 'Clear', // text for clear-button
        canceltext: 'Cancel', // Text for cancel-button
        autoclose: false, // automatic close timepicker
        ampmclickable: true, // make AM PM clickable

    });

    $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15, // Creates a dropdown of 15 years to control year,
        today: 'Today',
        clear: 'Clear',
        close: 'Ok',
        closeOnSelect: false // Close upon selecting a date,
    });

    $('#select-role').on("change", function () {
        if ($('#select-role option:selected').val() == 3) {
            $('#div-zone').hide();
        } else {
            $('#div-zone').show();
        }
    });

    $('#div-add-stations').hide();
    $('#btn-add-all').hide();
    $('#btn-search').click(function () {
        var startStation = $('#input-startStation').val();
        var endStation = $('#input-endStation').val();
        getStopsFromApi(startStation, endStation);
    })

});

function getAutocompleteFromDB(input, stations) {
    $.ajax({
        url: '/resabike/index/getStations',
        data: {
            'input': input
        },
        dataType:'json',
        type: 'Get',
        success: function(resultJSON) {
            // var result = JSON.parse(resultJSON);
            //
            // $.each(result, function(id, val) {
            //     stations[val.name] = null;
            // })
            //
            // $('input.autocompleteDB').autocomplete({
            //     data: stations,
            //     limit: 5,
            //     minLength: 1
            // });

            console.log(JSON.stringify(resultJSON));
        }
    })
}

function getStopsFromApi(startStation, endStation) {
    $.ajax({
        url: 'https://timetable.search.ch/api/route.en.json?from=' + startStation + '&to=' + endStation,
        type: 'Get',
        dataType: 'json',
        success: function (result) {
            var stops = [];
            for (var i = 0; i < result.connections[0].legs.length; i++) {
                if (result.connections[0].legs[i].type == 'bus' || result.connections[0].legs[i].type == 'post') {
                    var leg = result.connections[0].legs[i];
                    // Arrêt départ
                    if (!existsStop(stops, leg.name)) {
                        stops.push(leg.name);
                    }

                    // Arrêts intermédiaires
                    leg.stops.forEach(function (s) {
                        if (!existsStop(stops, s.name)) {
                            stops.push(s.name);
                        }
                    });

                    // Arrêt de fin
                    if (!existsStop(stops, leg.terminal)) {
                        stops.push(leg.exit.name);
                    }
                }
            }

            var html = '';
            var i = 0;

            stops.forEach(function (s) {
                html += '<tr>' +
                    '<td>' + s + '</td>' +
                    '<td id="td-add-station-' + i + '"><button type="button" class="waves-effect waves-green btn-flat" data-name="' + s + '" data-zone="' + getParameterByName('id') + '" id="btn-add-station-' + i + '">Ajouter</button></td>';

                i++;
            });

            $('#tbody-add-stations').html(html);
            $('#div-add-stations').show();

            $('[id^="btn-add-station-"]').click(function () {
                var $this = this;
                $.ajax({
                    url: '/resabike/zone/addStation',
                    type: 'Get',
                    data: {
                        'name': $(this).data('name'),
                        'zone': $(this).data('zone')
                    }
                }).done(function (res) {
                    var nb = $this.id.replace( /^\D+/g, '');
                    var tdToChange = '#td-add-station-' + nb;
                    $(tdToChange).html(res);
                })
            });

            var stations = stops.join(';');
            $('#btn-add-all').data('stations', stations);
            $('#btn-add-all').data('zone', getParameterByName('id'));
            $('#btn-add-all').show();

            $('#btn-add-all').click(function () {
                var $this = this;
                $.ajax({
                    url: '/resabike/zone/addAllStations',
                    type: 'Get',
                    data: {
                        'stations': $(this).data('stations'),
                        'zone': $(this).data('zone')
                    }
                }).done(function (res) {
                    console.log(res);
                    var messages = JSON.parse(res);
                    console.log(messages);
                    for(var i = 0; i < messages.length; i++) {
                        var tdToChange = '#td-add-station-' + i;
                        $(tdToChange).html(messages[i]);
                    }
                })
            });
        }
    })
}

// Méthode permettant de récupérer un paramètre dans l'URL
function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

function existsStop(stops, name) {
    return stops.indexOf(name) > -1;
}

function getAutocompleteFromApi(input, stations) {
    $.ajax({
        url: "https://timetable.search.ch/api/completion.en.json?nofavorites=0&term=" + input,
        type: 'Get',
        dataType: 'json',
        success: function (result) {

            $.each(result, function (id, val) {
                stations[val.label] = null;
            });

            $('input.autocompleteApi').autocomplete({
                data: stations,
                limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
                onAutocomplete: function (val) {
                    // Callback function when value is autcompleted.
                },
                minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
            });
            console.log(stations);
        }
    })


}

