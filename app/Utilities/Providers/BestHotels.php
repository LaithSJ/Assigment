<?php

namespace App\Utilities\Providers;

// this class is used to fetch the available hotels from BestHotel provider
Class BestHotels{
    public function hotelSearch($requestData){
        // prepare BestHotel request data
        $searchData = $this->prepareSearchData($requestData);

        // assuming that we hit curl request to BestHotel provider and assuming that we received the results from it as JSON
        $hotels = $this->callApi($searchData);

        // prepare the main availableHotel api response and return it to caller
        return $this->prepareFinalResults($hotels);
    } 

    // this function will be used to prepare the hotel provider api request data
    private function prepareSearchData($requestData){
        return [
            'city'              =>  $requestData['city'],
            'fromDate'          =>  $requestData['fromDate'],
            'toDate'            =>  $requestData['toDate'],
            'numberOfAdults'    =>  $requestData['numberOfAdults']
        ];
    }

    // call provider api
    private function callApi($searchData){
        // convert the data from php array format to JSON formate
        $data = json_encode($searchData);
        
        // prepare url
        $ch = curl_init('provider api url');

        // prepare request method
        curl_setopt($ch, CURLOPT_POST, true);

        // prepare configuration
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);

        $header = [
            'Content-Type:application/json'
        ];

        // prepare curl setups
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        
        // execute the API
        $result = curl_exec($ch);

        // close request
        curl_close($ch);

        // assuming that the api returned hotels results and it got decoded
        return json_decode($this->sampleResults(),true);
    }

    // this function is just a mockup 
    private function sampleResults(){
        return '[{ "hotel":"Hotel #1", "hotelRate" : "1", "hotelFare" :"50", "roomAmenities" : "Smart Tv,Wifi,Air Condition" }, { "hotel" : "Hotel #2", "hotelRate" : "2", "hotelFare"  : "60", "roomAmenities" :   "Smart Tv,Wifi,Air Condition,Bet House" }, { "hotel"  : "Hotel #3", "hotelRate" : "3", "hotelFare" : "80", "roomAmenities" : "Smart Tv,Air Condition" }, { "hotel" :"Hotel #4", "hotelRate" : "4", "hotelFare" : "55", "roomAmenities" : "Tv,Wifi,Air Condition" }, { "hotel" : "Hotel #5", "hotelRate" :"5", "hotelFare" : "120", "roomAmenities" : "Smart Tv,Wifi,Air Condition,Master Bed" } ]';
    }

    // this function will be used to build the final api response that will return to caller
    private function prepareFinalResults($hotelResults){
        // initiate $finalResult array
        $finalResult = [];

        // loop into $hotelResults
        foreach($hotelResults as $hotel){
            array_push($finalResult,[
                'provider'  =>  'BestHotels',
                'hotelName' =>  $hotel['hotel'],
                'fare'      =>  $hotel['hotelFare'],
                'amenities' =>  explode(',',$hotel['roomAmenities'])
            ]);
        }

        // sort the hotels array based on the fare ( lowest to highest )
        $fareValues = array_column($finalResult, 'fare');

        // resort the array
        array_multisort($fareValues, SORT_ASC, $finalResult);
        
        // return the built array
        return $finalResult;
    }
}