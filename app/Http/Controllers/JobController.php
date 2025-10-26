<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class JobController extends Controller
{
    public function index()
    {
        $response = Http::withHeaders([
            'x-rapidapi-host' => 'active-jobs-db.p.rapidapi.com',
            'x-rapidapi-key' => '77841b1fcbmshf3a8cc85a36f595p10070bjsna4b6b19eb10a',
        ])->get('https://active-jobs-db.p.rapidapi.com/active-ats-7d', [
            'description_type' => 'text',
        ]);

        $data = $response->json();

        dd($data);

        return inertia('Job/Index', ['jobs' => $data]);

    }
}
