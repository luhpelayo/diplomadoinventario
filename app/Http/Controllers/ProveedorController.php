<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexProveedor()
    {
        // Get all providers from the database
        $proveedores=Proveedor::all();
        // Render the view indexProveedor and pass the variable $proveedores
        return view('proveedor.indexProveedor',compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createProveedor()
    {
        // Renderizar la vista createProveedor para mostrar el formulario de creación de proveedores
        return view('proveedor.createProveedor');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeProveedor(Request $request)
    {
        // Set time zone
        date_default_timezone_set("America/La_Paz");
    
        // Validate the received data
        $validatedData = $request->validate([
            'nombre' => 'required',
            'telefono' => 'required|digits:8',
            'email' => 'required|email',
        ]);
    
        // Create a new supplier with validated data
        $proveedor = Proveedor::create([
            'nombre' => $validatedData['nombre'],
            'telefono' => $validatedData['telefono'],
            'direccion' => $request->input('direccion'),
            'email' => $validatedData['email'],
        ]);
    
        // Redirect user to view indexProveedor
        return redirect()->route('proveedores.indexProveedor');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function showProveedor(Proveedor $proveedore)
    {
        // Render the view showProveedor and pass the variable $proveedore
        return view('proveedor.showProveedor',compact ('proveedore'));
    }


}
