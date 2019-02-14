<?php

namespace App\Http\Controllers;

use App\departament;
use Illuminate\Http\Request;

class departamentController extends Controller
{
    public function departament(){
    $departament = departament::all();
    return view('place.departament', compact('departament'));
    }
}
