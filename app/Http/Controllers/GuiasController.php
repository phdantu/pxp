<?php

namespace App\Http\Controllers;

use App\PaginaGuia;
use App\ListaTrofeu;
use Illuminate\Http\Request;

class GuiasController extends Controller
{
    public function show($guiaId){
        return view('guia',[
             'guiaTrofeus' => ListaTrofeu::where('idJogo',$guiaId)->get(),
             'guias' => PaginaGuia::find($guiaId)
        ]);
    }

    public function retornaGuias(){
        return view('guias',[
            'guias' => PaginaGuia::paginate(8)
        ]);
    }
}
