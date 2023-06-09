<?php

namespace App\Http\Controllers;

use App\Models\NotaCompra;
use App\Models\detalleCompra;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;
use App\Models\Proveedor;

class NotaCompraController extends Controller
{
/**
 * Display a listing of NotaCompra records.
 *
 * @return \Illuminate\Http\Response
 */
public function indexNotacompra()
{
    // Retrieve all NotaCompra records from the database
    $notaCompras=NotaCompra::all();
    
    // Pass the records to the view for display in a table
    return view('notaCompra.indexNotacompra', compact('notaCompras'));
}


/**
 * Displays the form to create a new nota de compra.
 *
 * @return \Illuminate\Http\Response
 */
public function createNotacompra()
{
    // Get providers, users, and products from the database.
    $proveedors = DB::table('proveedors')->get();
    $users = DB::table('users')->get();
    $productos = DB::table('productos')->get();

    // Display the view with the form, passing the obtained data as parameters.
    return view('notaCompra.createNotacompra', [
        'proveedors' => $proveedors,
        'users' => $users,
        'productos' => $productos,
    ]);
}

/**
 * Store a newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
public function storeNotacompra(Request $request)
{
    // Set the time zone
    date_default_timezone_set("America/La_Paz");
    
    // Create a new purchase note in the database
    $notaCompra = NotaCompra::create([
        'nroProveedor' => request('nroProveedor'),
        'nroUsuario' => request('nroUsuario'),
        'monto' => 0, // The amount is set to 0 by default
        'fecha' => Carbon::now()->format('Y-m-d'), // Set the current date in the format 'Y-m-d'
        'hora' => Carbon::now()->format('H:i:s'), // Set the current time in the format 'H:i:s'
    ]);
    
    // Record activity in the activity log
    activity()->useLog('NotaCompra')->log('Nuevo')->subject();
    
    // Update the ID of the last activity record with the ID of the last created purchase note
    $lastActivity = Activity::all()->last();
    $lastActivity->subject_id = NotaCompra::all()->last()->id;
    $lastActivity->save();
    
    // Redirect user to newly created purchase details view
    return redirect(route('detalleCompras.showDetallecompra', $notaCompra));
}

/**
 * Display the specified resource.
 *
 * @param  \App\Models\NotaCompra  $notaCompra
 * @return \Illuminate\Http\Response
 */
public function showNotacompra(NotaCompra $notaCompra)
{
	 // Render the view showNotacompra and pass the variable $notaCompra
    return view('notaCompra.showNotacompra',compact ('notaCompra'));
}

/**
 * Show the form for editing the specified resource.
 *
 * @param  \App\Models\NotaCompra  $notaCompra
 * @return \Illuminate\Http\Response
 */
public function editNotacompra(NotaCompra $notaCompra)
{
    // Retrieve related models
    $proveedor = Proveedor::find($notaCompra->nroProveedor);
    $user = User::find($notaCompra->nroUsuario);

    // Get list of products from the database
    $productos = DB::table('productos')->get();
    
    // Get list of all providers and users from the database
    $proveedors = DB::table('proveedors')->get();
    $users = DB::table('users')->get();
    
    // Pass data to the view for rendering
    return view('notaCompra.editNotacompra',compact('notaCompra'),[
        'proveedor_nombre' => $proveedor->nombre,
        'user_nombre' => $user->nombre,
        'productos' => $productos, 
        'proveedors' => $proveedors, 'users' => $users
    ]);
}

/**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  \App\Models\NotaCompra  $notaCompra
 * @return \Illuminate\Http\Response
 */
public function updateNotacompra(Request $request, NotaCompra $notaCompra)
{
    // Set timezone
    date_default_timezone_set("America/La_Paz");

    // Update properties of the NotaCompra object with values from the request
    $notaCompra->nroProveedor=$request->nroProveedor;
    $notaCompra->nroUsuario=$request->nroUsuario;
    $notaCompra->monto=$request->monto;

    // Save changes to the database
    $notaCompra->save();

    // Log the activity
    activity()->useLog('NotaCompra')->log('Editar')->subject();
    $lastActivity = Activity::all()->last();
    $lastActivity->subject_id = $notaCompra->id;
    $lastActivity->save();

    // Redirect the user to the index page for NotaCompra
    return redirect()->route('notaCompras.indexNotacompra');
} 

/**
 * Remove the specified resource from storage.
 *
 * @param  \App\Models\NotaCompra  $notaCompra
 * @return \Illuminate\Http\Response
 */
public function destroyNotacompra(NotaCompra $notaCompra)
{
    date_default_timezone_set("America/La_Paz");

    // Call the deleteDetalle method to delete related details
    $notaCompra->deleteDetalle($notaCompra);

    // Delete the main notaCompra record
    $notaCompra->delete();

    // Log the activity
    activity()->useLog('NotaCompra')->log('Eliminar')->subject();
    $lastActivity = Activity::all()->last();
    $lastActivity->subject_id = $notaCompra->id;
    $lastActivity->save();

    // Redirect to the indexNotacompra route
    return redirect()->route('notaCompras.indexNotacompra');
}

}
