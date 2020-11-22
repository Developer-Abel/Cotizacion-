@extends('plantilla')

@section('content')
	<div class="container">
		<div class="row py-3" style="background-color: #DDDFEB">
			<div class="col-md-12 mb-3 d-flex justify-content-between">
				<h3 class="color-main">Plan básico <button class="btn btn-sm btn-outline-main">Cambiar plan</button></h3>
				<div>
					<button class="btn btn-second"> <i class="fas fa-file"></i> Nueva Plantilla</button>
					<a href="{{ url('/new_cotizacion') }}" class="btn btn-main" title="Agregar cotización"><i class="fas fa-plus"></i> Nueva cotización</a>
				</div>
			</div>
			<div class="col-md-4 mb-4">
           <div class="card border-left-ter shadow h-100">
             <div class="card-body">
               <div class="row no-gutters align-items-center">
                 <div class="col mr-2">
                   <div class="h5 mb-0 font-weight-bold "><h1><b>{{$terminado}}</b></h1> Cotizaciones</div>
                 </div>
               </div>
             </div>
           </div>
         </div>
         <div class="col-md-4 mb-4">
           <div class="card border-left-second shadow h-100">
             <div class="card-body">
               <div class="row no-gutters align-items-center">
                 <div class="col mr-2">
                   <div class="h5 mb-0 font-weight-bold"><h1><b>{{$borrador}}</b></h1> En borrador</div>
                 </div>
               </div>
             </div>
           </div>
         </div>
         <div class="col-md-4 mb-4">
           <div class="card border-left-main shadow h-100">
             <div class="card-body">
               <div class="row no-gutters align-items-center">
                 <div class="col mr-2">
                   <div class="h5 mb-0 font-weight-bold"><h1><b>{{$restante}}</b></h1> Disponibles</div>
                 </div>
               </div>
             </div>
           </div>
         </div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<br>
				<h2>Mis cotizaciones</h2>
			</div>
			<div class="col-md-12">
				<div class="card shadow mb-4">
					<div class="card-header py-3 text-right">
						<!-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> -->
						<!-- <button type="button" class="btn btn-info" title="Agregar cotización"><i class="fas fa-plus"></i> Nueva cotización</button> -->
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered datatable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>Num. cotización</th>
										<th>Nombre</th>
										<th>Cliente</th>
										<th>Fecha creación</th>
										<th>Fecha vencimiento</th>
										<th>Total</th>
										<th>Status</th>
										<th>Acciones</th>
									</tr>
								</thead>
								<tbody>
									@foreach( $cotizaciones as $i => $C)
										<tr>
											<td>{{$C->id_cotizacion}}</td>
											<td>{{$C->nombre}}</td>
											<td>{{$C->razon_cliente}}</td>
											<td>{{$C->fecha_creacion}}</td>
											<td>{{$C->fecha_vencimiento}}</td>
											<td>{{$C->total}}</td>
											<td>{{$C->status}}</td>
											<td class="d-flex justify-content-between">
												<form method="POST" action="{{ url('/edit_cotizacion') }}">
													@csrf
													<input type="text" name="id_cotizacion" value="{{$C->id_cotizacion}}" hidden="">
													<button type="submit" class="btn bg-gray-300 btn-circle btn-sm mx-2 btn_update_main" title="Editar"><i class="fas fa-pen"></i>
													</button>
												</form>

												<button class="btn bg-gray-300 btn-circle btn-sm" title="Eliminar"><i class="fas fa-trash"></i></button>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
