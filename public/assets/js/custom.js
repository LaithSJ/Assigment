$(document).ready(function(){
    // prepare cities list
    let countries = [
        'Amman'
    ];

    // initiate autocomplete
    $("#cities").autocomplete({
        source: countries
    });

    // on click event on search
    $('#search').on('click',function(e){
        // clear hotels table
        $('#hotels').addClass('d-none');
        $('#hotelsBody').html('');
        $('#error').addClass('d-none');
        $('#error').html('');

        // add loader to button
        let loader = '<div class="d-flex justify-content-center"> <div class="spinner-border spinner-border-sm" role="status"> <span class="sr-only">Loading...</span> </div> </div>';
        $('#search').html(loader);
        $('#search').prop('disabled',true);

        // initiate city variable
        let city = ''
        // get city IATA 
        if($('#cities').val() == 'Amman'){
            city = 'AMM';
        }

        // prepare ajax request header
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        setTimeout(function(){ 
            // prepare ajax request body
            $.ajax({
                type: 'GET',
                url: '/availableHotels?fromDate=' + $('#fromData').val() + '&toDate=' + $('#toData').val() + '&city=' + city + '&numberOfAdults=' + $('#numberOfAdults').val(),
                success: function (response) {
                    if(response.status == 'success'){
                        let tableData = '';
                        
    
                        response.data.forEach(function(hotel) {
                            let amenities = '<ul>'; 
                            hotel.amenities.forEach(function(amenity) {
                                amenities += '<li>' + amenity + '</li>';
                            });
                            amenities += '</ul>';
                            tableData += '<tr><td>' + hotel.provider + '</td><td>' + hotel.hotelName + '</td><td>' + hotel.fare + '</td><td>' + amenities + '</td></tr>';
                        });
    
                        $('#hotelsBody').html(tableData);
                        $('#hotels').removeClass('d-none');
                    }else{
                        $('#error').html('<div class="alert alert-danger" role="alert"> ' + response.message + '</div>');
                        $('#error').removeClass('d-none');
                        $('#error').addClass('d-block');
                    }
                    
                    console.log(response);
                },
                error: function (response) {
                    console.log('issue');
                    console.log(response);
                }
            });
            
            $('#search').html('Search');
            $('#search').prop('disabled',false);
        }, 1500);
    });
});