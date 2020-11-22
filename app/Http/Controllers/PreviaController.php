<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Previa;
use App\Cotizacion;
use App\Termino;
use App\Concepto;
use App\Plantilla;
use App\CatalogoPlantilla;
use Barryvdh\DomPDF\Facade as PDF;
use Mpdf\Mpdf;

class PreviaController extends Controller{
   function index (Request $request){
		$cotizacion = Cotizacion::where('id_cotizacion',$request->id_cotizacion)
										->where('deleted', 0)
										->get();
		$conceptos = Concepto::where('id_cotizacion',$request->id_cotizacion)
									->where('deleted', 0)
									->get();
		$terminos = Termino::where('id_cotizacion',$request->id_cotizacion)
									->where('deleted', 0)
									->get();

		$id_plantilla = Cotizacion::select('id_plantilla')
         ->where('id_cotizacion', $request->id_cotizacion)
         ->get();

		$plantilla = Plantilla::where('id_plantilla', $id_plantilla[0]->id_plantilla)
										->where('id_cotizacion', $request->id_cotizacion)
										->first();
		if ($plantilla == null || $plantilla == '') {
			$plantilla = CatalogoPlantilla::where('id_plantilla', $id_plantilla[0]->id_plantilla)->first();
		}
		// dd($plantilla);
		// falta validar si existe la plantilla vinculada a la validacion
		//si no tomar la que selecciono
		$data = [
			'cotizacion' =>$cotizacion,
			'conceptos' =>$conceptos,
			'terminos' =>$terminos,
			'color_primario' =>$plantilla->color_primario,
			'color_tabla' => $plantilla->color_tabla,
			'color_termino' => $plantilla->color_termino,
			'logo' => $plantilla->logo_ruta
		];
		return view('previa',$data);
	}

	function save_color(Request $request){
		$id_plantilla = Cotizacion::select('id_plantilla')
         ->where('id_cotizacion', $request->id_cotizacion)
         ->get();
      $IsExiste =Plantilla::where('id_cotizacion', '=', $request->id_cotizacion)
			->where('id_plantilla', '=', $id_plantilla[0]->id_plantilla)->count();

		$plantilla = new Plantilla;
		$plantilla->id_cotizacion = $request->id_cotizacion;
		$plantilla->id_plantilla = $id_plantilla[0]->id_plantilla;
		$plantilla->color_primario = $request->color_primario;
		$plantilla->color_tabla = $request->color_tabla;
		$plantilla->color_termino = $request->color_termino;
		$plantilla->logo_ruta = 'img/jom.png';
		$plantilla->is_plantilla = 0;

		if ($IsExiste) {
			$actualizar = Plantilla::where('id_cotizacion', $request->id_cotizacion)
				->where('id_plantilla', $id_plantilla[0]->id_plantilla)
				->update([
					'color_primario' => $request->color_primario,
					'color_tabla' => $request->color_tabla,
					'color_termino' => $request->color_termino,
					'logo_ruta' => 'img/jom.png',
					'is_plantilla' => 0
				]);
		}else{
			$plantilla->save();
		}

      $plantilla_all = Plantilla::where('id_cotizacion', $request->id_cotizacion)
      	->where('id_plantilla', $id_plantilla[0]->id_plantilla)
         ->get();
      return $plantilla_all;
	}
	function PDF(Request $request){
		// actualizar
		$actualizar = Cotizacion::where('id_cotizacion', $request->id_cotizacion)
				->update([
					'status' => 'terminado'
				]);
		// select
		$cotizacion = Cotizacion::where('id_cotizacion',$request->id_cotizacion)
										  ->where('deleted', 0)
										  ->get();
		$conceptos = Concepto::where('id_cotizacion',$request->id_cotizacion)
									  ->where('deleted', 0)
									  ->get();
		$terminos = Termino::where('id_cotizacion',$request->id_cotizacion)
									->where('deleted', 0)
									->get();

		$id_plantilla = Cotizacion::select('id_plantilla')
         ->where('id_cotizacion', $request->id_cotizacion)
         ->get();
		$id_plantilla = Cotizacion::select('id_plantilla')
         ->where('id_cotizacion', $request->id_cotizacion)
         ->get();

		$plantilla = Plantilla::where('id_plantilla', $id_plantilla[0]->id_plantilla)
										->where('id_cotizacion', $request->id_cotizacion)
										->first();
		if ($plantilla == null || $plantilla == '') {
			$plantilla = CatalogoPlantilla::where('id_plantilla', $id_plantilla[0]->id_plantilla)->first();
		}
		// falta validar si existe la plantilla vinculada a la validacion
		//si no tomar la que selecciono
		// $color_main = "red";
		// $color_termino = 'orange';
		$data = [
			'cotizacion' =>$cotizacion,
			'conceptos' =>$conceptos,
			'terminos' =>$terminos,
			'color_primario' =>$plantilla->color_primario,
			'color_tabla' => $plantilla->color_tabla,
			'color_termino' => $plantilla->color_termino,
			'logo' => $plantilla->logo_ruta
		];

		// return view('previa',$data);
		$pdf = PDF::loadView('pdf', $data);
		return $pdf->stream();

		// $mpdf = new Mpdf();
  //       // $mpdf->SetTopMargin(5);
		// $html = view('pdf',$data)->render();
  //       $mpdf->SetDisplayMode('fullpage');
  //       $mpdf->WriteHTML($html);
  //       dd($mpdf);
  //       $mpdf->Output("pdf34.pdf","I");
   }
}
