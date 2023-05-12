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

        /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function editProveedor(Proveedor $proveedore)
    {
        // Render the view editProveedor and pass the variable $proveedore
        return view('proveedor.editProveedor',compact('proveedore'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function updateProveedor(Request $request, Proveedor $proveedore)
    {
        // Set time zone
        date_default_timezone_set("America/La_Paz");

        // Validate the received data
                $validatedData = $request->validate([
                    'nombre' => 'required',
                    'telefono' => 'required|digits:8',
                    'email' => 'required|email',
                ]);
            
        // Update the supplier's data with the values ​​received in the form
        $proveedore->nombre=$request->nombre;
        $proveedore->telefono=$request->telefono;
        $proveedore->direccion=$request->direccion;
        $proveedore->email=$request->email;
        $proveedore->save();
        // Redirect user to view indexProveedor
        return redirect()->route('proveedores.indexProveedor');
    }


}
