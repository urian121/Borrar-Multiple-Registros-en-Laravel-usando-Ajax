<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Alumnos;
use Illuminate\Http\Request;

class AlumnosController extends Controller
{



public function listAlumnos(){
    
    $totalAlumnos = Alumnos::all();
    $alumnos = Alumnos::orderBy('id', 'DESC')->paginate(8);
    return view('alumnos', compact('alumnos','totalAlumnos'));

}

public function DeleteMultiple(Request $request){

    //Pregunto si la peticion request viene por Ajax
    if($request->ajax()){
        $ids = $request->ids;

        $sql = DB::table("Alumnos")->whereIn('id',explode(",",$ids))->delete(); 
        //el explode es para quitar la coma entre cada id ejemplo 2, 5,8,5,

        $total = Alumnos::all()->count(); //Consulto la nueva Cantidad de Registros

        /* return response()->json([
                'msjtotal'=> 'Alumnos Borrados ('.$ids.')  Correctamente.'
        ]); */

        return response()->json([
            'msjtotal' =>'<span> Total de Alumnos </span> <strong> ('. $total .')</strong>',
            'mensaje'=>"Alumnos Borrados  ('. $total.' + ' .$ids .' + '. $sql.') Correctamente."
            ]); 

        }
}



}
