<?php


namespace App\Services;

use Illuminate\Support\Facades\Http;

class DogService {

    private string $baseUrl = "https://dogapi.dog/api/v2";

    public function getBreeds() {
        $url = $this->baseUrl . "/breeds"; 
        $response = Http::get($url)->json();
        return $response;
    }


}




?>