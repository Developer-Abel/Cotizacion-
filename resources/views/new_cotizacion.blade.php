@extends('plantilla')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-3">
			<a href="#" class="btn btn-step btn-circle" style="background-color: #F8A100" id="step_1" onclick="siguiente(1)">1</a>
			Información general
		</div>
		<div class="col-md-2 text-center">
			<a href="#" class="btn btn-step btn-circle" id="step_2" onclick="siguiente(2)">2</a>
			Conceptos
		</div>
		<div class="col-md-3 text-right">
			<a href="#" class="btn btn-step btn-circle" id="step_3" onclick="siguiente(3)">3</a>
			Términos y condiciones
		</div>
		<div class="col-md-3 text-center">
			<a href="#" class="btn btn-step btn-circle" id="step_4" onclick="siguiente(4)">4</a>
			Selecion de colores
		</div>
		<div class="col-md-1">
			<a href="{{ url('/') }}" class="btn btn-outline-danger">Salir</a>
		</div>
	</div>
	<br>
</div>
<section id="section_cotizacion" >
	<div class="container" style="background-color: #6C648B">
		<div class="row">
			<div class="col-md-12 text-center mb-3">
				<br>
				<h3 style="color:white">Elije una plantilla</h3>
			</div>
		</div>
		<div class="row">
			<div class="owl-carousel owl-theme" id="carousel">
			    <div class="item">
			    	<div class="col-md-10 plantilla" >
	              <div class="p plantilla_1 card shadow mb-4" id="plantilla_1" onclick="plantilla(1);">
	                <div class="py-3 rojo" id="select_p_1" >
	                  <h6 class="m-0 font-weight-bold">Plantilla 1</h6>
	                </div>
	                <!-- <div class="card-body"> -->
	                	<img src="https://img.freepik.com/vector-gratis/diseno-simple-plantilla-vector-factura_1017-12656.jpg?size=338&ext=jpg" alt="" width="100%">
	                <!--   <div class="chart-pie pt-2">
	                  </div>-->
	               <!-- </div> -->
	              </div>
	            </div>
	         </div>
	         <div class="item">
			    	<div class="col-md-10 plantilla">
			    		{{-- style="border: 4px solid orange" --}}
	              <div class="p plantilla_2 card shadow mb-4" id="plantilla_2" onclick="plantilla(2);">
	                <div class="card-header py-3">
	                  <h6 class="m-0 font-weight-bold">Plantilla 2</h6>
	                </div>
	                <!-- <div class="card-body">
	                  <div class="chart-pie pt-2">
	                  </div>
	                </div> -->
	                <img src="https://img.freepik.com/vector-gratis/diseno-simple-plantilla-vector-factura_1017-12656.jpg?size=338&ext=jpg" alt="" width="100%">
	              </div>
	            </div>
	         </div>
	         <div class="item">
			    	<div class="col-md-10 plantilla">
	              <div class="p plantilla_3 card shadow mb-4" id="plantilla_3" onclick="plantilla(3);">
	                <div class="card-header py-3">
	                  <h6 class="m-0 font-weight-bold">Plantilla 3</h6>
	                </div>
	                <!-- <div class="card-body">
	                  <div class="chart-pie pt-2">
	                  </div>
	                </div> -->
	                <img src="https://img.freepik.com/vector-gratis/diseno-simple-plantilla-vector-factura_1017-12656.jpg?size=338&ext=jpg" alt="" width="100%">
	              </div>
	            </div>
	         </div>
	         <div class="item">
			    	<div class="col-md-10 plantilla">
	              <div class="p plantilla_4 card shadow mb-4" id="plantilla_4" onclick="plantilla(4);">
	                <div class="card-header py-3">
	                  <h6 class="m-0 font-weight-bold">Plantilla 4</h6>
	                </div>
	                <!-- <div class="card-body">
	                  <div class="chart-pie pt-2">
	                  </div>
	                </div> -->
	                <img src="https://img.freepik.com/vector-gratis/diseno-simple-plantilla-vector-factura_1017-12656.jpg?size=338&ext=jpg" alt="" width="100%">
	              </div>
	            </div>
	         </div>
			</div>
		</div>
	</div>
	<hr>
	<div class="container">
		<div class="row" id="form_cotizacion">
			<div class="col-md-6 offset-3">
				<form class="" method="POST" action="javascript:void(0)">
					<div class="form-group">
						<small class="text-center errores" id="err_id_plantilla"></small>
						<label for="" hidden="">is_cotizacion <input type="text" name="id_cotizacion" id="id_cotizacion" value="{{{isset($id_cotizacion) ? $id_cotizacion : 0}}}"></label>
						<label for="" hidden="">id_plantilla <input type="text" name="id_plantilla" id="id_plantilla" value="{{{isset($id_plantilla) ? $id_plantilla : 0}}}"></label>
					</div>
				  <div class="form-group">
				    <label>Nombre de la cotización</label>
				    <input type="text" class="form-control" name="nom_cotizacion" value="{{{isset($nom_cotizacion) ? $nom_cotizacion : ''}}}" id="nom_cotizacion">
				    <small id="err_nom_cotizacion" class="errores"></small>
				  </div>
				  <div class="form-group">
				    <label>Nombre del cliente o razón social</label>
				    <input type="text" class="form-control" name="razon_social_cliente" value="{{{isset($razon_social) ? $razon_social : ''}}}" id="razon_social_cliente">
				  </div>
				  <div class="form-group">
				    <label>RFC del cliente</label>
				    <input type="text" class="form-control" name="rfc_cliente" value="{{{isset($rfc) ? $rfc : ''}}}" id="rfc_cliente">
				  </div>
				  <div class="form-group">
				    <label>Fecha de vencimiento</label>
				    <input type="date" class="form-control" name="fecha_ven" value="{{{isset($fecha_ven) ? $fecha_ven : ''}}}" id="fecha_ven">
				    <small id="err_fecha_ven" class="errores"></small>
				  </div>
				  <div class="row mt-3">
						<div class="col-md-12 text-right">
							<!-- <br> -->
							<!-- <button type="button" class="btn btn-danger">
								<span class="icon text-white-50"><i class="fas">X</i></span>
							</button> -->


							<button type="button" class="btn btn-main" id="btn_cotizacion_concepto">
								<span class="icon text-white-50"><i class="fas fa-arrow-right"></i></span>
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>

<!-- conceptos -->
<section id="section_concepto">
	<div class="container">
		<div class="row card bg-light text-black shadow">
			<div class="col-md-12">
				<div class="table">
					<table class="table">
					  <thead>
					    <tr>
					      <th scope="col">#</th>
					      <th scope="col">Concepto</th>
					      <th scope="col">Cantidad</th>
					      <th scope="col">Precio unitario</th>
					      <th scope="col">Subtotal</th>
					      <th></th>
					    </tr>
					    <tr onclick="TrAgregarC()" onkeyup="calc_sub('input_cantidad','input_precioU','subtotal');">
					      <td colspan="2">
					      	<input type="text" value="" class="form-control inputs_concepto" id="input_concepto" name="input_concepto" placeholder="Agregar concepto">
					      	<small class="text-center errores" id="err_input_concepto"></small>
					      </td>
					      <td>
					      	<input type="text" value="" class="form-control inputs_concepto" id="input_cantidad" name="input_cantidad" onkeyup="val_int()" placeholder="Agregar cantidad">
					      	<small class="text-center errores" id="err_input_cantidad"></small>
					      </td>
					      <td>
					      	<input type="text" value="" class="form-control inputs_concepto" id="input_precioU" name="input_precioU" onkeyup="val_int2();" placeholder="Agregar precio">
					      	<small class="text-center errores" id="err_input_precioU"></small>
					      </td>
					      <td><input type="text" value="0" id="subtotal" class="input_concepto_sub form-control" disabled></td>
					      <td><button type="button" class="btn btn-second" id="btn_concepto_new">Agregar</button></td>
				    	</tr>
					  </thead>
					  <tbody id="tab_concepto">

					  </tbody>
					</table>
						{{-- <input type="text" class="form-control" placeholder="+ AGREGAR CONCEPTO" id="input_concepto" onkeypress="pulsar(event)"> --}}
				</div>
			</div>
		</div>
		<hr>
		<div class="row" id="calculo_concepto">
				<div class="col-md-4 offset-6 text-right bg-gray-300 py-1" >Subtotal</div>
				<div class="col-md-2 text-left bg-gray-300 py-1">$ <span id="sub_general">0</span></div>
				<div class="col-md-4 offset-6 text-right bg-gray-300 py-1">IVA 16%</div>
				<div class="col-md-2 text-left bg-gray-300 py-1">$ <span id="iva">-</span></div>
				<div class="col-md-4 offset-6 text-right bg-gray-300 py-1" style="color:#F8A100"> <strong>Total</strong> </div>
				<div class="col-md-2 text-left bg-gray-300 py-1" style="color:#F8A100">$ <strong id="total">0</strong> </div>
			<!-- </div> -->
		</div>
		<div class="row mt-3">
			<div class="col-md-12 text-right d-flex justify-content-between">
				<!-- <br> -->
				<button type="button" class="btn btn-second" onclick="siguiente(1)" id="show_cotizacion">
					<span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
				</button>
				<button type="button" class="btn btn-main" id="btn_concepto_termino"><!--onclick="siguiente(3)"-->
					<span class="icon text-white-50"><i class="fas fa-arrow-right"></i></span>
				</button>
			</div>
		</div>
	</div>
</section>
<!-- terminos -->
<section id="section_termino">
	<div class="container">
		<div class="row card bg-light text-black shadow">
			<div class="col-md-12">
				<div class="table">
					<table class="table">
					  <thead>
					    <tr>
					      <th scope="col">#</th>
					      <th scope="col">Término o condición</th>
					      <th></th>
					    </tr>
					    <tr onclick="TrAgregarT()" onkeyup="calc_sub('input_cantidad','input_precioU','subtotal');">
					      <td colspan="2">
					      	<textarea name="" id="input_termino" cols="30" rows="2" class="form-control " placeholder="Agregar termino o condición"></textarea>
					      	<small class="text-center errores" id="err_termino"></small>
					      </td>
					      <td class="text-center"><button type="button" class="btn btn-second" id="btn_termino_new">Agregar</button></td>
				    	</tr>
					  </thead>
					  <tbody id="tab_termino">
					  </tbody>
					</table>
				</div>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-12 text-right d-flex justify-content-between">
				<button type="button" class="btn btn-second" onclick="siguiente(2)">
					<span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
				</button>
				<button type="button" class="btn btn-main" onclick="" id="btn_termino_previa">
					<span class="icon text-white-50"><i class="fas fa-arrow-right"></i></span>
				</button>
			</div>
		</div>
	</div>
</section>
<!-- Vista previa -->
<section id="section_vista_previa">
	<div class="container">
		<div class="row">
			<div class="col-md-5">
				<div class="card mb-4 py-3 box-colores" >
					<h4 class="text-center">Elije tus colores</h4>
                <div class="card-body">
                  <div class="row">
                  	<div class="col-md-12">
                  		<label for=""><input type="color" name="color1" class="form-control input_color" >Color primario</label>
                  	</div>
                  	<div class="col-md-12">
                  		<label for=""><input type="color" name="color2" class="form-control input_color" >Color tabla</label>
                  	</div>
                  	<div class="col-md-12">
                  		<label for=""><input type="color" name="color3" class="form-control input_color" >Color términos</label>
                  	</div>
                  	<div class="col-md-12 text-right">
                  		<button class="btn btn-main btn-sm btn-block" id="guardar_color">Guardar colores</button>
                  	</div>
                  </div>
                  <hr>
                  <div class="row">
                  	<div class="col-md-12 text-center">
                  		<h4>Agrega tu logo</h4>
                  	</div>
                  	<div class="col-md-6 offset-3 text-center">
                  		<img src="{{asset('img/jom.png')}}" width="80%" alt="">
                  	</div>
                  	<div class="col-md-12 d-flex justify-content-between mt-3">
                  		<div class="col-md-6 text-center">
                  			<button type="button" class="btn btn-ter btn-sm">Quitar</button>
                  		</div>
                  		<div class="col-md-6 text-center">
                  			<button type="button" class="btn btn-main btn-sm" id="previa">Guardar</button>
                  		</div>
                  	</div>
                  </div>
                </div>
              </div>
			</div>
			<div class="col-md-7">
				<div class="card shadow mb-4">
					<div class="card-header py-3">
						<h6 class="m-0 font-weight-bold text-primary">Vista previa PDF</h6>
					</div>
					<div class="card-body" id="card_body">
						{{-- <div class="row">
							<div class="col-md-12 d-flex justify-content-between">
								<div class="col-md-3">
									<img src="https://www.utp.ac.pa/documentos/2015/imagen/logo_utp_2_300.png" alt="" width="80%">
								</div>
								<div class="col-md-9 text-right">
									<span class="size_14">Cotización 7 <br></span>
									<span class="size_18">Diseño de identidad corporativa</span>
								</div>
							</div>
							<div class="col-md 12 d-flex justify-content-between mt-3">
								<div class="col-md-4">
									<p class="size_14">Dirigido a: <br>gala solutions sa cv <br>19 de Agosto del 2020</p>
								</div>
								<div class="col-md-8 text-right">
									<span class="size_18 color1" style="color: #6C648B"><b>$1,740.00 MXN</b><br></span>
									<span class="size_14">Mil setecientos cuarenta pesos 00/100</span>
								</div>
							</div>
							<div class="col-md-12">
								<table class="table table-sm table-striped" id="tabla_previa">
									<thead>
										<tr class="size_14" id="head_tabla">
											<th scope="col">Concepto</th>
											<th scope="col">Precio unitario</th>
											<th scope="col">Cantidad</th>
											<th scope="col">Total</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Sistema de socios para el manejo de empledos en el hospital del imss</td>
											<td>$1,500.00</td>
											<td class="text-center">1</td>
											<td>$1,500.00</td>
										</tr>
										<tr>
											<td>Interfaz ventas</td>
											<td>$500.00</td>
											<td class="text-center">1</td>
											<td>$500.00</td>
										</tr>
										<tr>
											<td>Diseño base de datos</td>
											<td>$750.00</td>
											<td class="text-center">1</td>
											<td>$750.00</td>
										</tr>
										<tr>
											<td>Sistema de socios para el manejo de empledos en el hospital del imss</td>
											<td>$1,500.00</td>
											<td class="text-center">1</td>
											<td>$1,500.00</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="col-md-7 d-flex justify-content-between size_12">
								<div class="col-md-6" style="border: 1px solid grey;">
									Ésta cotización es válida hasta el día 29 de Agosto del 2020
								</div>
								<div class="col-md-6" style="border: 1px solid grey;">
									Favor de responder con su autorización al correo abel93lk@gmail.com.
								</div>
							</div>
							<div class="col-md-5 text-right size_12 sub_previa color_subtotal">
								<div class="d-flex justify-content-between">
									<div class="col-md-4 text-right">
										Subtotal
									</div>
									<div class="col-md-8 text-right">
										$1,500.00
									</div>
								</div>
								<div class="d-flex justify-content-between">
									<div class="col-md-4 text-right">
										IVA 16%
									</div>
									<div class="col-md-8 text-right">
										$240.00
									</div>
								</div>
								<div class="d-flex justify-content-between size_18" style="border-top: 1px solid grey">
									<div class="col-md-4 text-right">
										Total
									</div>
									<div class="col-md-8 text-right">
										$1,740.00
									</div>
								</div>
							</div>
							<hr>
							<div class="col-md-12 text-center terminos_prev mt-4" >
								<span class="size_14">terminos y condiciones</span>
								<ul class="size_12 text-left">
									<li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde repudiandae voluptatem repellendus fugit, ea necessitatibus saepe incidunt e.</li>
									<li>Lorem ipsum dolor sit amet,tio illo quo.</li>
								</ul>
							</div>
						</div> --}}
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12 text-right d-flex justify-content-between">
			<!-- <br> -->
			<button type="button" class="btn btn-second" onclick="siguiente(3)">
				<span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
			</button>
			{{-- <a href="{{ url('/pdf') }}" class="btn btn-main">
				<span class="icon text-white size_20">Finalizar</span>
			</a> --}}
			<div>
				<form method="POST" action="{{ url('/pdf') }}" target="_blank">
					@csrf
					<input type="text" value="" id="id_cotizacion_fin" name="id_cotizacion" hidden="">
					<button type="submit" class="btn btn-main">
						<span class="icon text-white size_20">Finalizar y ver Cotización</span>
					</button>
				</form>
			</div>
		</div>
	</div>
</section>
@endsection
