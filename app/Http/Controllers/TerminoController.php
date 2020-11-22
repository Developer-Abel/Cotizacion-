<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Termino;
use App\Cotizacion;
use App\Http\Requests\validationTerminoTab;
use App\Http\Requests\validationTermino;

class TerminoController extends Controller{

	function index (Request $request){
		$terminos = Termino::where('id_cotizacion',$request->id_cotizacion)
									->where('deleted', 0)
									->orderBy("id_termino")
									->get();
		// $sub_general = Termino::where('deleted', 0)->get()->sum('subtotal');
		// $iva = (float)$sub_general * 0.16;
		// $total = (float)$sub_general + (float)$iva;

		// $sub_general = floor(($sub_general*100))/100;
		// $iva = floor(($iva*100))/100;
		// $total = floor(($total*100))/100;
		$data = [
			'terminos' =>$terminos
		];
		// $isExiste =Cotizacion::where('id_cotizacion', '=', $request->id_cotizacion)->count();
		// if ($isExiste) {
		// 	$actualizar = Cotizacion::where('id_cotizacion', $request->id_cotizacion)
		// 		->update([
		// 			'subtotal' => $sub_general,
		// 			'iva' => $iva,
		// 			'total' => $total,
		// 		]);
		// }
		return $data;
	}

   function insert(Request $request, validationTermino $validar){
		$validated = $validar->validated();

		$data = ['response' =>'fail'];
		$id_cotizacion = $request->id_cotizacion;
		$isExiste =Cotizacion::where('id_cotizacion', '=', $id_cotizacion)->count();

		if ($isExiste && $id_cotizacion != 0) {
			$termino = new Termino;
			$termino->termino = $request->termino;
			$termino->id_cotizacion = $id_cotizacion;
			$isSave = $termino->save();
			if ($isSave) {
				// $conceptos = Concepto::where('deleted', 0)->orderByDesc("id_concepto")->get();
				$data = [
		   		'response' => 'success','id_cotizacion' =>$id_cotizacion
		   	];
			}else{
				$data = [
		   		'response' => 'no se guardo la cotizacion'
		   	];
			}

		}else{
			$data = [
	   		'response' => 'no existe la cotización'
	   	];
		}
		return json_encode($data);
	}

	function update(Request $request,validationTerminoTab $validar){
		$validated = $validar->validated();
		$IsExiste =Termino::where('id_termino', '=', $request->id_termino)->count();
		$data = ['response' =>'fail'];
		if ($IsExiste) {
			$actualizar = Termino::where('id_termino', $request->id_termino)
			->update([
				'termino' => $request->termino,
			]);
			$data = ['response' =>'success','id_cotizacion'=>$request->id_cotizacion];
		}
		return json_encode($data);
	}
	function delete(Request $request){
		$IsExiste =Termino::where('id_termino', '=', $request->id_termino)->count();
		$data = ['response' =>'fail'];
		if ($IsExiste) {
			$actualizar = Termino::where('id_termino', $request->id_termino)
			->update([
				'deleted' => 1,
				'id_cotizacion' => $request->id_cotizacion,
			]);
			$data = ['response' =>'success'];
		}
		return json_encode($data);
	}
}
