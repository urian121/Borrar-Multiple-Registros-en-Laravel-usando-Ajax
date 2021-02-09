<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Alumnos;
use Illuminate\Http\Request;

class AlumnosController extends Controller
{


public function listAlumnos(){
    
    $totalAlumnos = Alumnos::all();
    $alumnos = Alumnos::orderBy('id', 'DESC')->get();
    return view('alumnos', compact('alumnos','totalAlumnos'));

}

public function DeleteMultiple(Request $request){
    if($request->ajax()){
        $ids = $request->ids;
        $sql = DB::table("Alumnos")->whereIn('id',explode(",",$ids))->delete();

        $total = Alumnos::all()->count(); //Consulto la Cantidad nuevamente

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
