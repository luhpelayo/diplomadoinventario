@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <h1>Editar Proveedor</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form method="post" action="{{route('proveedores.updateProveedor',$proveedore)}}" novalidate >

            @csrf
            @method('PUT')

            <h5>Nombre Completo:</h5>
            <input type="text" name="nombre" value="{{$proveedore->nombre}}"  class="focus border-primary form-control" pattern="[a-zA-Z ]+" required onkeypress="return soloLetras(event)">
            @error('nombre')
            <p>DEBE INGRESAR BIEN SU NOMBRE</p>
            @enderror

            <h5>Telefono:</h5>
            <input type="number" name="telefono" value="{{$proveedore->telefono}}"  class="focus border-primary  form-control" >


            @error('telefono')
                <p>DEBE INGRESAR BIEN SU TELEFONO</p>
            @enderror
            
            <h5>Direccion:</h5>
            <input type="text" name="direccion" value="{{$proveedore->direccion}}" class="focus border-primary  form-control" >


            @error('direccion')
                <p>DEBE INGRESAR BIEN SU DIRECCION</p>
            @enderror 

            <h5>Email:</h5>
            <input type="text" name="email" value="{{$proveedore->email}}" class="focus border-primary  form-control" >


            @error('email')
                <p>DEBE INGRESAR BIEN SU EMAIL</p>
            @enderror
            
            <br>
            <br>

            <button  class="btn btn-danger btn-sm" type="submit">Guardar</button>
            <a href="{{route('proveedores.indexProveedor')}}"class="btn btn-warning text-white btn-sm">Volver</a>
        </form>

    </div>
</div>

<script>
// Function to validate that name contains only letters is valid       
function soloLetras(e){
    // Get the event and the character entered
    e = e || window.event;
    var charCode = e.which || e.keyCode;
    var charStr = String.fromCharCode(charCode);

    // Validate that the character is a letter or a white space
    if (/^[a-zA-Z\s]*$/.test(charStr)) {
        return true;
    } else {
        e.preventDefault();
        return false;
    }
}


// Function to validate that the phone number entered is valid
document.querySelector('input[name="telefono"]').addEventListener('input', function() {
    if (this.value.length > 8) {
      this.value = this.value.slice(0, 8);
    }
  });
</script>
@stop