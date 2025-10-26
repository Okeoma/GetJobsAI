<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use Illuminate\Http\Request;

class MyInterviewsController extends Controller
{
    public function index(Request $request)
    {
        $interviews = $request->user()->interviews()->latest()->paginate(10)->withQueryString();

        return inertia('MyInterview/Index', ['interviews' => $interviews]);

    }

    public function show(Interview $my_interview)
    {

        return inertia('MyInterview/Show', ['interview' => $my_interview]);
    }
}
