<?php

namespace App\Utilities;

use App\Utilities\AbstractClasses\AbstractHotelProviders;
use App\Utilities\Providers\CrazyHotels;
use App\Utilities\Providers\BestHotels;

class HotelProviders extends AbstractHotelProviders
{

   public function setHotelProvider($provider = 'BestHotel')
   {
       switch ($provider) {
            case 'BestHotel':
                $hotelProvider = new BestHotels();
            break;
            case 'CrazyHotels':
                $hotelProvider = new CrazyHotels();
            break;
       }

       // return the picked hotel provider object
       return $hotelProvider;
   }
}