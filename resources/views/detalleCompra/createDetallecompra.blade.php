@extends('adminlte::page')

@section('title', 'Compra')

@section('content_header')
    <h1>Detalle de Compra</h1>
@stop

@section('content')

<div class="container " style="background-color: white">
    <div class="row justify-content-center border rounded-top">
        <div class="col">
            <div class="row row justify-content-center m-2">
                <h2 class="font-weight-bold">DETALLE COMPRA</h2>
            </div>
             
            <form method="post" action="{{route('detalleCompras.storeDetallecompra')}}" novalidate onsubmit="return validarFormulario()">
    @csrf  
    <div class="row row justify-content-center"> 
        <div class="col-1">
            <input type="hidden"  name="idNotaCompra" value=" {{$notaCompra->id}}" class="focus border-primary  form-control" >
        </div>        
        {{-- SELECT PRODUCT --}}
        <div class="col-4">
            <h5>Producto:</h5>
            <select name="idProducto" id="idProducto" class="form-control" onchange="habilitar()" >
                <option value="">Seleccione un producto</option>
                @foreach ($productos as $producto)
                    <option value="{{$producto->id}}">
                        {{$producto->nombre}}
                    </option>
                @endforeach
            </select>
            @error('idProducto')
                <p>DEBE INGRESAR BIEN EL PRODUCTO</p>
            @enderror
        </div>
        {{-- ENTER PRICE --}}
        <div class="col-1">
    <h5>Bs:</h5>
    <input type="text" value="99.50" name="costo" class="focus border-primary form-control" onchange="validarPrecio(this)" >

    @error('costo')
    <p>DEBE INGRESAR EL PRECIO </p>
    @enderror
</div>
        {{-- ENTER QUANTITY --}}
        <div class="col-2">
            <h5>Cantidad:</h5>
                <input type="number" value="1" name="cantidad" class="focus border-primary form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" max="1000" onchange="checkMaxValue(this)">

                    @error('cantidad')
                     <p>DEBE INGRESAR LA CANTIDAD</p>
                    @enderror
        </div>

        {{-- ADD BUTTON --}}
        <div class="col-3 align-items-center">
            <h5>Carrito</h5>
            <button  class="btn btn-primary btn-sm" type="submit">Añadir</button>
        </div>
    </div>  
</form>
  
            <div class="row row justify-content-center m-2">
                <h3>DETALLE</h3>
            </div>

            <div class="row">
                <table class="table table-striped">
                    <thead>
                        <tr>
                          <th scope="col">Producto</th>
                          <th scope="col">Cantidad</th>
                          <th scope="col">Importe</th>
                          <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach ($notas as $nota)
                            <tr>
                                <td>{{DB::table('productos')->where('id',$nota->idProducto)->value('nombre')}}</td>
                                <td>{{$nota->cantidad}}</td>
                                <td>{{$nota->costo}}</td>
                                <td>
                                    

                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="2" class="font-weight-bold">MONTO TOTAL</td>
                            <td class="font-weight-bold">{{$notaCompra->monto}}</td>
                        </tr>
                    </tbody> 
                </table> 
            </div>

             <div class="row justify-content-end">
                <form action="{{route('notaCompras.destroyNotacompra', $notaCompra)}}" method="post">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger btn-sm m-2" onclick="return confirm('¿ESTA SEGURO DE BORRAR?')" 
                    value="Borrar">Eliminar Compra</button> 
                    <a class="btn btn-success btn-sm m-2" href="{{route('notaCompras.indexNotacompra')}}">Guardar cambios</a> 
                  </form>
            </div> 
            
        </div>
    </div>       
</div>

<script>
// Function to validate the form before submitting it
function validarFormulario() {
    var idProducto = document.getElementById("idProducto").value;
    if (idProducto == "") {
        alert("Debe seleccionar un producto");
        return false; // stops form submission
    }
    return true; // submit the form normally
}

// Function to validate that the entered price is valid
function validarPrecio(input) {
        const regex = /^\d+(\.\d+)?$/; // Regular expression to allow numbers with decimal point
        const valor = input.value;

        if (!regex.test(valor)) {
            alert('Ingrese un precio válido numero con punto decimal. Ej. 99.50');
            input.value = 99.99; // Clear the field in case of invalid value
        }
    }

// Function to validate that the amount entered does not exceed the maximum allowed
function checkMaxValue(input) {
    if (input.value > 1000) {
      alert('La cantidad máxima permitida es 1000');
      input.value = 1000;
    }
  }    
</script>
@stop

@section('css')

@stop

@section('js')

@stop



