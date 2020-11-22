
<head>
   <link href="{{public_path('bootstrap/css/sb-admin-2.css')}}" rel="stylesheet">
</head>
<style type="text/css">
   @page {
            margin: 0px;
            /*margin-left: 0.6em;*/
        }
   html {
     margin: 0px;
   }
   .row{
      margin: 0px !important;
      padding: 0px !important;
   }
   .sin_borde {
     border: 1px solid white !important;
     /*padding: 0px !important;*/
     margin: 0px !important;
   }
   .top{
      vertical-align:top !important;
   }
   .color-blanco{
      color: white !important;
   }
   .fecha_vencimiento{
      /*border: grey !important;*/
      color: #8F919C;
      background-color: #F2F2F2;
   }
   .bg-main{
      background-color: {{$color_primario}};
      color: white;
   }
   .borde-main{
      border:1px solid {{$color_primario}};
   }
   .borde-main-top{
      border-top: 1px solid {{$color_primario}};
      border-bottom:1px solid grey;
      border-right:1px solid {{$color_primario}};
      border-left :1px solid {{$color_primario}};
   }
   .bg-termino{
      background-color: {{$color_termino}};
      color: white !important;
   }
   .borde-termino{
      border: 1px solid {{$color_termino}} !important;
   }
   .size{
      font-size: 1.5em;
   }
   .baner{
      background-image: url("{{public_path('img/banner.JPG')}}");
      width: 100%;
      text-align: center;
   }
</style>
<div class="row">
   {{-- <img src="{{public_path('img/banner.JPG')}}" alt="" width="100%"> --}}
   <p style="color: transparent;">lorem</p>

</div>
<div class="container mt-3">
   @foreach( $cotizacion as $i => $C)
      <table class="table sin_borde">
        <thead class="sin_borde">
          <tr class="sin_borde">
            <th class="sin_borde py-0">
               <img src="{{public_path('img/jom.png')}}" width="150px" alt="">
            </th>
            <td class="sin_borde top text-right">
               <p>Cotización 7 <br> <b>{{$C->nombre}}</b></p>
            </td>
          </tr>
        </thead>
        <tbody class="sin_borde">
          <tr class="sin_borde">
            <td class="sin_borde">
               <p class="size_14">Dirigido a: <br><b>{{$C->razon_cliente}}</b><br>19 de Agosto del 2020</p>
            </td>
            <td class="sin_borde text-right">
               <span class="size_18 color1" style="color: {{{isset($color_primario) ? $color_primario : '#9e9a9a'}}}"><b class="size">$ {{$C->total}}</b><br></span>
               <span class="size_14">Mil setecientos cuarenta pesos 00/100</span>
            </td>
          </tr>
        </tbody>
      </table>

      {{-- tabla --}}
      <table class="table table-sm table-striped mt-3">
         <thead>
            <tr class="color-blanco" id="head_tabla" style="background-color: {{{isset($color_tabla) ? $color_tabla : '#9e9a9a'}}}">
               <th class="">Concepto</th>
               <th class="text-center">Precio unitario</th>
               <th class="text-center">Cantidad</th>
               <th class="text-center">Total</th>
            </tr>
         </thead>
         <tbody>
            @foreach( $conceptos as $i => $C)
            <tr>
               <td>{{$C->concepto}}</td>
               <td class="text-center">$ {{$C->precio_u}}</td>
               <td class="text-center"> {{$C->cantidad}}</td>
               <td class="text-center">$ {{$C->subtotal}}</td>
            </tr>
            @endforeach
         </tbody>
      </table>
      {{-- fecha vencimiento total y subtotal --}}
      <table class="table table-sm mt-3 sin_borde" width="600">
      @foreach( $cotizacion as $i => $C)
         <thead class="sin_borde">
            <tr class="sin_borde">
               <th class="sin_borde" ></th>
               <th class="sin_borde" ></th>
               <th class="sin_borde" ></th>
               <th class="sin_borde" ></th>
            </tr>
         </thead>
         <tbody class="sin_borde">
            <tr class="sin_borde">
               <td rowspan='3' class="fecha_vencimiento" width="358px">Ésta cotización es válida hasta el día 29 de Agosto del 2020</td>
               {{-- <td rowspan='2' class="sin_borde">Favor de responder con su autorización al correo abel93lk@gmail.com.</td> --}}
               <td class="sin_borde" width="1px"></td>
               <td class="sin_borde" width="1px"></td>
               <td class="borde-main bg-main" width="120px">Subtotal</td>
               <td class="borde-main bg-main text-right" width="120px">$ {{$C->subtotal}}</td>
            </tr>
            <tr class="borde-main">
               <td class="sin_borde"></td>
               <td class="sin_borde"></td>
               <td class="borde-main-top bg-main">IVA 16%</td>
               <td class="borde-main-top bg-main text-right">$ {{$C->iva}}</td>
            </tr>
            <tr class="borde-main">
               <td class="sin_borde"></td>
               <td class="sin_borde"></td>
               <td class="borde-main bg-main size">Total</td>
               <td class="borde-main bg-main size text-right">$ {{$C->total}}</td>
            </tr>
         </tbody>
      @endforeach
      </table>
      {{-- terminos y condiciones --}}
      <table class="table table-sm mt-3 bg-termino">
            <thead>
               <tr class="borde-termino">
                  <td class="borde-termino"></td>
               </tr>
            </thead>
            <tbody>
               <tr class="borde-termino">
                     <td class="borde-termino text-center">Términos y condiciones</td>
                  </tr>
               @foreach( $terminos as $T)
                  <tr class="borde-termino">
                     <td class="borde-termino">
                        <ul class="borde-termino">
                           <li class="borde-termino">{{$T->termino}}</li>
                        </ul>
                     </td>
                  </tr>
                @endforeach
            </tbody>
      </table>
   @endforeach
</div>

