<?php

namespace App\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('backend.home.index', [
            'title' => trans('main.dashboard')
        ]);
    }
}
