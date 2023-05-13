@extends('adminlte::page')

@section('title', 'notaCompras')

@section('content_header')
    <h1>Editar Nota de Compra</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form method="post" action="{{route('notaCompras.updateNotacompra',$notaCompra)}}" novalidate >

            @csrf
            @method('PUT')
            
            <h5>Proveedor:</h5>
<select name="nroProveedor" id="nroProveedor" class="form-control" onchange="habilitar()">
    <option value="">Seleccione un Proveedor</option>
    @foreach ($proveedors as $proveedor)
        <option value="{{ $proveedor->id }}" @if($proveedor->id == $notaCompra->nroProveedor) selected @endif>
            {{ $proveedor->nombre }}
        </option>
    @endforeach
</select>


            @error('nroProveedor')
            <p>DEBE INGRESAR EL PROVEEDOR</p>
            @enderror

            <h5>Usuario:</h5>
            <select name="nroUsuario" id="nroUsuario" class="form-control" onchange="habilitar()">
    <option value="">Seleccione un Usuario</option>
    @foreach ($users as $user)
        <option value="{{ $user->id }}" @if($user->id == $notaCompra->nroUsuario) selected @endif>
            {{ $user->name }}
        </option>
    @endforeach
</select>
            @error('nroUsuario')
            <p>DEBE INGRESAR EL USUARIO</p>
            @enderror

            <h5>Monto:</h5>
            <input type="text"  name="monto" value="{{$notaCompra->monto}}" class="focus border-primary  form-control" onchange="validarMonto(this)">

            @error('monto')
            <p>DEBE INGRESAR BIEN EL MONTO</p>
            @enderror

            <h5>FechaHora:</h5>
            <input type="text"  name="FechaHora" value="{{$notaCompra->updated_at}}" class="focus border-primary  form-control" >

            @error('FechaHora')
            <p>DEBE INGRESAR BIEN fechahora</p>
            @enderror

            <br>
            <br>

            <button  class="btn btn-danger btn-sm" type="submit">Guardar</button>
            <a href="{{route('notaCompras.indexNotacompra')}}"class="btn btn-warning text-white btn-sm">Volver</a>
        </form> 

    </div>
</div>

<script>
// Function to validate that the entered price is valid
function validarMonto(input) {
        const regex = /^\d+(\.\d+)?$/; // Regular expression to allow numbers with decimal point
        const valor = input.value;

        if (!regex.test(valor)) {
            alert('Ingrese un precio válido numero con punto decimal. Ej. 99.50');
            input.value = 99.99; // Clear the field in case of invalid value
        }
    }
</script>
@stop