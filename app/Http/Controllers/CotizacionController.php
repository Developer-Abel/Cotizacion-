<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Cotizacion;
use App\Http\Requests\validationCotizacion;
// use Illuminate\Support\Facades\PDF;
use Barryvdh\DomPDF\Facade as PDF;

class CotizacionController extends Controller{
   public function __construct()
    {
        $this->middleware('auth');
    }

   function index(){
    	$cotizaciones = Cotizacion::where('deleted', 0)->orderBy('id_cotizacion', 'DESC')->get();
      $borrador = Cotizacion::where('deleted', 0)
                                  ->where('status', 'borrador')
                                  ->count();
      $terminado = Cotizacion::where('deleted', 0)
                                  ->where('status', 'terminado')
                                  ->count();
      $restante = 600 - ($borrador + $terminado);
    	$data = [
         'cotizaciones' =>$cotizaciones,
         'borrador' => $borrador,
         'terminado' => $terminado,
         'restante' => $restante,
      ];
      // dd($data);
   	return view('home',$data);
   }

   function cotizacion(Request $request){
   	$id_cotizacion = 0;
   	$data = [
   		'id_cotizacion' => $id_cotizacion
   	];
   	return view('new_cotizacion',$data);
   }
   function Edit_cotizacion(Request $request){
    $cotizacion = Cotizacion::where('id_cotizacion', $request->id_cotizacion)
               ->first();
    $data = [
      'id_cotizacion' => $cotizacion->id_cotizacion,
      'id_plantilla' => $cotizacion->id_plantilla,
      'nom_cotizacion' => $cotizacion->nombre,
      'razon_social' => $cotizacion->razon_cliente,
      'rfc' => $cotizacion->rfc_cliente,
      'fecha_ven' => $cotizacion->fecha_vencimiento
    ];
               // return $data;
    return view('new_cotizacion',$data);
   }

   function insert_update(Request $request, validationCotizacion $validar){
   	$validated = $validar->validated();

   	$data = ['response' => 'fail'];
   	$id_cotizacion = $request->id_cotizacion;

   	$cotizacion = new Cotizacion;
		$cotizacion->nombre = $request->nom_cotizacion;
		$cotizacion->razon_cliente = $request->razon_cliente;
		$cotizacion->rfc_cliente = $request->rfc_cliente;
		$cotizacion->no_cotizacion = 000;
		$cotizacion->fecha_creacion = '2020-10-18';
		$cotizacion->fecha_vencimiento = $request->fecha_ven;
		$cotizacion->status = 'borrador';
		$cotizacion->id_plantilla = $request->id_plantilla;
		$cotizacion->total = '0';
		$cotizacion->deleted = 0;


   	$IsExiste =Cotizacion::where('id_cotizacion', '=', $id_cotizacion)->count();

   	if (!$IsExiste && $id_cotizacion == 0) {//insertar
         $cotizacion->save();
   		$data = [
	   		'response' => 'success','id_cotizacion' =>$cotizacion->id_cotizacion
	   	];
   	}elseif ($IsExiste) {//actualizar
			$actualizar = Cotizacion::where('id_cotizacion', $id_cotizacion)
				->update([
					'nombre' => $request->nom_cotizacion,
					'razon_cliente' => $request->razon_cliente,
					'rfc_cliente' => $request->rfc_cliente,
					'fecha_vencimiento' => $request->fecha_ven,
					'id_plantilla' =>$request->id_plantilla
				]);
   		$data = [
	   		'response' => 'success','id_cotizacion' =>$id_cotizacion, 'request'=>$actualizar
	   	];
   	}else{//fallo
   		$data = [
	   		'response' => 'success','request' =>'Fallo al insertar registro'
	   	];
   	}
   	return json_encode($data);
   }

   function PDF(){
    $pdf = PDF::loadView('pdf');
    return $pdf->stream();
   }

   // function index_cotizacion(Request $request){
   // 	$cotizacion = Cotizacion::where('id_cotizacion', 1)
   //             ->get();
   //    return $cotizacion;
   // }
}
