<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('formatedaddress', function($attribute, $value, $parameters) {

        // Conversion de l'adresse en coordonée GPS (longitude latitude) START

        $addressToConvert = $value;
        $convertedAddress = str_replace(" ", "+", $addressToConvert);
        $ch = curl_init(); //curl handler init

        curl_setopt($ch,CURLOPT_URL,"https://api-adresse.data.gouv.fr/search/?q=.$convertedAddress.");
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);// set optional params
        curl_setopt($ch,CURLOPT_HEADER, false);

        $resultAddress=curl_exec($ch);

        $resultAddress=json_decode($resultAddress);// On transforme le JSON en tableau d'objets php

        curl_close($ch);
        return ($resultAddress->features["0"]->properties->postcode < 34000 && $resultAddress->features["0"]->properties->postcode >= 33000);

        });
    }
}
