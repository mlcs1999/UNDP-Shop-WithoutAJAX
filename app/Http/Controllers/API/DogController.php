<?php

namespace App\Http\Controllers\API;

use App\Services\DogService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DogController extends Controller
{
    public function breeds() {
        $dogService = new DogService();

        $dogBreeds = $dogService->getBreeds();

        return $dogBreeds;
    }
}
