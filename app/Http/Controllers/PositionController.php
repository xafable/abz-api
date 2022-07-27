<?php

namespace App\Http\Controllers;

use App\Http\Resources\PositionCollection;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    function index(){
        $resourceCollection = new PositionCollection(Position::all());

        return  $resourceCollection;
    }
}
