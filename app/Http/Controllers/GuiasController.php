<?php

namespace App\Http\Controllers;

use App\PaginaGuia;
use Illuminate\Http\Request;

class GuiasController extends Controller
{
    public function show($id){
        $guia = PaginaGuia::find($id);
        dd($guia);
        return view('$guia');
    }
}
