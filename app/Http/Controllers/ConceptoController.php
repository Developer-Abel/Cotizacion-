<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Concepto;
use App\Cotizacion;
use App\Http\Requests\validationConcepto;
use App\Http\Requests\validationTabConcepto;

class ConceptoController extends Controller{
	// function truncar($numero, $digitos){
	// 	$truncar = 10**$digitos;
	// 	return intval($numero * $truncar) / $truncar;
	// }

	function index (Request $request){
		// $conceptos = Concepto::where('deleted', 0 AND 'id_cotizacion',14)->orderBy("id_concepto")->get();
		$conceptos = Concepto::where('id_cotizacion',$request->id_cotizacion)
									 ->where('deleted', 0)
									 ->orderBy("id_concepto")
									 ->get();
		$sub_general = Concepto::where('id_cotizacion',$request->id_cotizacion)
									  ->where('deleted', 0)
									  ->get()->sum('subtotal');
		$iva = (float)$sub_general * 0.16;
		$total = (float)$sub_general + (float)$iva;

		$sub_general = floor(($sub_general*100))/100;
		$iva = floor(($iva*100))/100;
		$total = floor(($total*100))/100;
		$data = [
			'conceptos' =>$conceptos,
			'sub_general' =>$sub_general,
			'iva' =>$iva,
			'total' =>$total
		];
		$isExiste =Cotizacion::where('id_cotizacion', '=', $request->id_cotizacion)->count();
		if ($isExiste) {
			$actualizar = Cotizacion::where('id_cotizacion', $request->id_cotizacion)
				->update([
					'subtotal' => $sub_general,
					'iva' => $iva,
					'total' => $total,
				]);
		}
		return $data;
	}

	function insert(Request $request, validationConcepto $validar){
		$validated = $validar->validated();

		$data = ['response' =>'fail'];
		$id_cotizacion = $request->id_cotizacion;
		$subtotal = (int)$request->input_cantidad * (float)$request->input_precioU;

		$isExiste =Cotizacion::where('id_cotizacion', '=', $id_cotizacion)->count();

		if ($isExiste && $id_cotizacion != 0) {
			$concepto = new Concepto;
			$concepto->concepto = $request->input_concepto;
			$concepto->id_cotizacion = $id_cotizacion;
			$concepto->cantidad = $request->input_cantidad;
			$concepto->precio_u = $request->input_precioU;
			$concepto->subtotal = $subtotal;
			$isSave = $concepto->save();
			if ($isSave) {
				// $conceptos = Concepto::where('deleted', 0)->orderByDesc("id_concepto")->get();
				$data = [
		   		'response' => 'success','id_cotizacion' =>$id_cotizacion
		   	];
			}else{
				$data = [
		   		'response' => 'no se guardo el concepto'
		   	];
			}

		}else{
			$data = [
	   		'response' => 'no existe la cotización'
	   	];
		}
		return json_encode($data);
	}

	function update(Request $request, validationTabConcepto $validar){
		$validated = $validar->validated();
		$IsExiste =Concepto::where('id_concepto', '=', $request->id_concepto)->count();
		$data = ['response' =>'fail'];
		if ($IsExiste) {
			$subtotal = (int) $request->cantidad * (float)$request->precio_u;
			$actualizar = Concepto::where('id_concepto', $request->id_concepto)
			->update([
				'concepto' => $request->concepto,
				'cantidad' => $request->cantidad,
				'precio_u' => $request->precio_u,
				'subtotal' => $subtotal,
			]);
			$data = ['response' =>'success','id_cotizacion'=>$request->id_cotizacion];
		}
		return json_encode($data);
	}
	function delete(Request $request){
		$IsExiste =Concepto::where('id_concepto', '=', $request->id_concepto)->count();
		$data = ['response' =>'fail'];
		if ($IsExiste) {
			$actualizar = Concepto::where('id_concepto', $request->id_concepto)
			->update([
				'deleted' => 1,
				'id_cotizacion' => $request->id_cotizacion,
			]);
			$data = ['response' =>'success'];
		}
		return json_encode($data);
	}

}
