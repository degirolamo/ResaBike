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

    // Materialize.updateTextFields();

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
    });

    $('#btn-searchTime').click(function(){
        var from = $('#idfrom').val();
        var to = $('#idto').val();
        var date = $('#iddate').val();
        var time = $('#idtime').val();
        var newDate = myDateFormatter(date);
        var mail = $('#idMail').val();
        var phone = $('#idPhone').val();
        var nbBikes = $('#nbrvelo').val();
        getHourFromApi(from, to, newDate, time, mail, phone, nbBikes)
    });

});

function myDateFormatter(dateToConvert) {
    console.log(dateToConvert);
    var d = new Date(dateToConvert);
    var day = d.getDate();
    var month = d.getMonth() + 1;
    var year = d.getFullYear();
    if (day < 10) {
        day = "0" + day;
    }
    if (month < 10) {
        month = "0" + month;
    }
    var date = month + "/" + day + "/" + year;
    return date;
};

function getAutocompleteFromDB(input) {
    $.ajax({
        url: '/resabike/index/getStations',
        data: {
            'input': input
        },
        type: 'Get',
        success: function (resultJSON) {
            var result = JSON.parse(resultJSON);

            $.each(result, function (id, val) {
                result[val.nom] = null;
            });

            console.log(result);

            $('input.autocompleteDB').autocomplete({
                data: result,
                limit: 5,
                minLength: 1,
            });
        }
    })
}




function getHourFromApi(from, to, date, hour, mail, phone, nbBikes) {
    from = 'Sierre, poste/gare';
    to = 'Vissoie, poste';
    date = '11/23/2017';
    hour = '14:30';
    mail = 'kev.carneiro@gmail.com';
    phone = '+41 79/580/236';
    $nbBikes = 2;
    $.ajax({
        url: "https://timetable.search.ch/api/route.en.json?from=" + from + "&to=" + to + "&date=" + date + "&time=" + hour,
        type: 'Get',
        dataType: 'json',
        success: function (result) {
            var book = [];
            for (var i = 0; i < result.connections.length; i++) {
                var lines = [];
                for (var j = 0; j < result.connections[i].legs.length; j++) {
                    var leg = result.connections[i].legs[j];
                    if (leg.type == "bus" || leg.type == "post") {
                        lines.push(leg.line);
                        var from = result.connections[i].legs[0].name;
                        var to = leg.exit.name;
                        var departure = result.connections[i].legs[0].departure;
                        var arrival = leg.exit.arrival;
                    }

                    var legDetails = {
                        from: from,
                        to: to,
                        departure: departure,
                        arrival: arrival
                    }
                }

                book.push(legDetails);
            }

            fillTab(book, mail, nbBikes, phone);
        }
    })
}

function fillTab(trips, mail, nbBikes, phone) {
    var result = "";
    for(var i = 0 ; i <trips.length ; i++){
        result +=   '<tr>' +
            '<td>'+trips[i].from+'</td>'+
            '<td>'+trips[i].to+'</td>'+
            '<td>'+trips[i].departure+'</td>'+
            '<td>'+trips[i].arrival+'</td>'+
            '<td>'+'<button type="button" id="btn-book-'+i+'">Reserver</button>'+'</td>'+
            '</tr>'
    }
    $('#tabHeur').html(result);

    $('[id^="btn-book-"]').click(function () {
        var id = this.id.substring(this.id.length -1, this.id.length);
        console.log(id);
        html = '' +
            '<form id="formReserv" method="post" action="/resabike/index/confirmReserv">' +
            '<input type="text" name="from" value="' + trips[id].from + '">' +
            '<input type="text" name="to" value="' + trips[id].to + '">' +
            '<input type="text" name="departure" value="' + trips[id].departure + '">' +
            '<input type="text" name="arrival" value="' + trips[id].arrival + '">' +
            '<input type="text" name="mail" value="' + mail + '">' +
            '<input type="text" name="phone" value="' + phone + '">' +
            '<input type="text" name="nbBikes" value="' + nbBikes + '">' +
            '<button type="submit" name="submit" id="btnReserv">Réserver</button>' +
            '</form>';

        $('#hiddenForm').hide();
        $('#hiddenForm').html(html);
        $('#btnReserv').click();
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
                    '<td id="td-add-station-' + i + '"><button type="button" class="waves-effect waves-green btn" data-name="' + s + '" data-zone="' + getParameterByName('id') + '" id="btn-add-station-' + i + '">Ajouter</button></td>';

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
                    var nb = $this.id.replace(/^\D+/g, '');
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
                    for (var i = 0; i < messages.length; i++) {
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
                minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
            });
            console.log(stations);
        }
    })


}

