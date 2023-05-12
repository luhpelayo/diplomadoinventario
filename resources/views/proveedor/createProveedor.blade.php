@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <h1>Registrar Proveedor</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form method="post" action="{{route('proveedores.storeProveedor')}}" novalidate >

            @csrf

            <h5>Nombre Completo:</h5>
                <input type="text" name="nombre" class="focus border-primary form-control" pattern="[a-zA-Z ]+" required onkeypress="return soloLetras(event)">
            @error('nombre')
                    <p>DEBE INGRESAR BIEN SU NOMBRE</p>
             @enderror




            <h5>Telefono:</h5>
            <input type="number" name="telefono" class="focus border-primary form-control" maxlength="8">
            @error('telefono')
                <p>DEBE INGRESAR BIEN SU TELEFONO 8 DIGITOS</p>
            @enderror

            <h5>Direccion:</h5>
            <input type="text" name="direccion"  class="focus border-primary  form-control" >
            @error('direccion')
                <p>DEBE INGRESAR BIEN SU Direccion</p>
            @enderror

            <h5>Email:</h5>
                <input type="text" name="email" class="focus border-primary form-control" required>
                    @error('email')
                 <p>DEBE INGRESAR BIEN SU EMAIL EJ. example@gmail.com</p>
                @enderror
            
            <br>
            <br>

            <button  class="btn btn-danger btn-sm" type="submit">Registrar</button>

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

// Function to validate the entered email is valid
document.querySelector('form').addEventListener('submit', function(event) {
  var email = document.querySelector('input[name="email"]').value;
  if (!/\S+@\S+\.\S+/.test(email)) {
    event.preventDefault();
    alert('El correo electrónico debe tener un formato válido (ej. example@gmail.com)');
  }
});

// Function to validate that the phone number entered is valid
document.querySelector('input[name="telefono"]').addEventListener('input', function() {
    if (this.value.length > 8) {
      this.value = this.value.slice(0, 8);
    }
  });
</script>
@stop

@section('css')

@stop

@section('js')

@stop
