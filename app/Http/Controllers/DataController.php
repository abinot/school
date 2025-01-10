<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {

        return view('data', [
            //
        ]);
    }
}
