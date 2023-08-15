<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Score;
use App\Models\Club;

class KlasemenController extends Controller
{
    public function index(){
        $clubs = Club::orderBy('point', 'desc')->get();    
        return view('klasemen.index', compact('clubs'));
    }
}
