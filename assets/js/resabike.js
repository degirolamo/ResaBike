$(document).ready(function() {
    $('.autocompleteApi').on("input",function (error) {
        var stations = {};
        var input = $(this).val();
        getDataFromApi(input, stations);
    })

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

    })

    $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15, // Creates a dropdown of 15 years to control year,
        today: 'Today',
        clear: 'Clear',
        close: 'Ok',
        closeOnSelect: false // Close upon selecting a date,
    });

    $('#select-role').on("change", function() {
        if($('#select-role option:selected').val() == 3) {
            $('#div-zone').hide();
        } else {
            $('#div-zone').show();
        }
    })

});

function getDataFromApi(input, stations) {
    $.ajax({
    	url: "https://timetable.search.ch/api/completion.en.json?nofavorites=0&term="+input,
    	type: 'Get',
    	dataType: 'json',
    	success: function(result){

            $.each(result, function( id, val ) {
                stations[val.label] = null;
            });

            $('input.autocompleteApi').autocomplete({
                data: stations,
                limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
                onAutocomplete: function(val) {
                    // Callback function when value is autcompleted.
                },
                minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
            });
    		console.log(stations);
    	}
    })
    

}

