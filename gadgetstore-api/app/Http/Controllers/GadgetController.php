<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gadget;
use App\Http\Resources\Gadgets as GadgetResourceCollection;

class GadgetController extends Controller
{
    public function top($count)
    {
        $criteria = Gadget::select('*')
        ->orderBy('views', 'DESC')
        ->limit($count)
        ->get();
        return new GadgetResourceCollection($criteria);
    }
}