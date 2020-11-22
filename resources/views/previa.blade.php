<div class="row">
	@foreach( $cotizacion as $i => $C)
		<div class="col-md-12 d-flex justify-content-between"> <!-- d-flex justify-content-between -->
			<div class="col-md-3">
				<img src="{{asset($logo)}}" alt="" width="100%">
			</div>
			<div class="col-md-9 text-right">
				<span class="size_14">Cotización 7 <br></span>
				<span class="size_18"><b>{{$C->nombre}}</b></span>
			</div>
		</div>
		<div class="col-md 12 d-flex justify-content-between mt-3">
			<div class="col-md-4">
				<p class="size_14">Dirigido a: <br><b>{{$C->razon_cliente}}</b><br>19 de Agosto del 2020</p>
			</div>
			<div class="col-md-8 text-right">
				<span class="size_18 color1" style="color: {{{isset($color_primario) ? $color_primario : '#9e9a9a'}}}"><b>$ {{$C->total}}</b><br></span>
				<span class="size_14">Mil setecientos cuarenta pesos 00/100</span>
			</div>
		</div>
	@endforeach
	<div class="col-md-12">
		<table class="table table-sm table-striped" id="tabla_previa">
			<thead>
				<tr class="size_14" id="head_tabla" style="background-color: {{{isset($color_tabla) ? $color_tabla : '#9e9a9a'}}}">
					<th scope="col">Concepto</th>
					<th scope="col">Precio unitario</th>
					<th scope="col">Cantidad</th>
					<th scope="col">Total</th>
				</tr>
			</thead>
			<tbody>
				@foreach( $conceptos as $i => $C)
				<tr>
					<td>{{$C->concepto}}</td>
					<td>{{$C->precio_u}}</td>
					<td class="text-center">{{$C->cantidad}}</td>
					<td>{{$C->subtotal}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<div class="col-md-7 d-flex justify-content-between size_12">
		<div class="col-md-12" style="color: #8F919C; background-color: #F2F2F2">
			Ésta cotización es válida hasta el día 29 de Agosto del 2020
		</div>
		{{-- <div class="col-md-6" style="border: 1px solid grey;">
			Favor de responder con su autorización al correo abel93lk@gmail.com.
		</div> --}}
	</div>
	{{-- sub_previa --}}
	<div class="col-md-5 text-right size_12 sub_previa color_subtotal" style="background-color: {{{isset($color_primario) ? $color_primario : '#9e9a9a'}}}">
		@foreach( $cotizacion as $i => $C)
			<div class="d-flex justify-content-between">
				<div class="col-md-4 text-right">
					Subtotal
				</div>
				<div class="col-md-8 text-right">
					$ {{$C->subtotal}}
				</div>
			</div>
			<div class="d-flex justify-content-between">
				<div class="col-md-4 text-right">
					IVA 16%
				</div>
				<div class="col-md-8 text-right">
					$ {{$C->iva}}
				</div>
			</div>
			<div class="d-flex justify-content-between size_18" style="border-top: 1px solid grey">
				<div class="col-md-4 text-right">
					Total
				</div>
				<div class="col-md-8 text-right">
					$ {{$C->total}}
				</div>
			</div>
		@endforeach
	</div>
	<hr>
	<div class="col-md-12 text-center terminos_prev mt-4 mb-5" style="background-color: {{{isset($color_termino) ? $color_termino : '#9e9a9a'}}}">
		<span class="size_14">terminos y condiciones</span>
		<ul class="size_12 text-left">
			@foreach( $terminos as $T)
				<li>{{$T->termino}}</li>
			@endforeach
		</ul>
	</div>
</div>