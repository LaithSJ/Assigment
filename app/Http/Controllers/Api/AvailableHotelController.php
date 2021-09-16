<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Utilities\HotelProviders;
use Illuminate\Http\Request;

class AvailableHotelController extends Controller
{
    // initiate hotelProviderClass which it will hold the provider class that will get the hotels results from
    private $hotelProviderClass;

    // the construct function will set the hotel provider, in our case by default it will be "BestHotel"
    function __construct() {
        $hotelProviders             =   new HotelProviders();
        $this->hotelProviderClass   =   $hotelProviders->setHotelProvider();
	}

    // This function will receive the hotel search form that comes from the API request
    public function hotelSearch(Request $request){
        // simple function to check if there is any missing form input
        if($this->isValidForm($request)){
            // send the hotels search data to the provider to get the results from, to do that a hotelSearch method inside the provider class must be called
            $hotelData = $this->hotelProviderClass->hotelSearch($request);

            // check if hotel data is not empty which means that no hotels found
            if(count($hotelData) > 0){
                // return error to the caller
                return response()->json(['status' => 'success', 'message' => 'Hotels has been found','data' => $hotelData]);
            }else{
                // return error to the caller
                return response()->json(['status' => 'error', 'message' => 'No hotels has been found','data' => []]);
            }
        }else{
            // return error to the caller
            return response()->json(['status' => 'error', 'message' => 'One or more form inputs are missing, please make sure to fill the form','data' => []]);
        }
    }

    private function isValidForm($formData){
        if(!isset($formData['city']) || (isset($formData['city']) && $formData['city'] == '') || !isset($formData['fromDate']) || (isset($formData['fromDate']) && $formData['fromDate'] == '') || !isset($formData['toDate']) || (isset($formData['toDate']) && $formData['toDate'] == '') || !isset($formData['numberOfAdults']) || (isset($formData['numberOfAdults']) && $formData['numberOfAdults'] == '')){
            return false;
        }

        return true;
    }
}