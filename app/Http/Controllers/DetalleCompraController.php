<?php

namespace App\Http\Controllers;

use App\Models\DetalleCompra;
use Illuminate\Http\Request;
use App\Models\NotaCompra;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;

class DetalleCompraController extends Controller
{

  /**
 * Store a newly created detalleCompra in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
public function storeDetallecompra(Request $request)
{
    // Set the default timezone to America/La_Paz
    date_default_timezone_set("America/La_Paz");

    // Retrieve the input data from the request
    $idNotaCompra = request('idNotaCompra');
    $idProducto = request('idProducto');
    $cantidad = request('cantidad');
    $costo = request('costo');

    // Create a new detalleCompra instance with the input data
    $detalleCompra=detalleCompra::create([
        'idNotaCompra' => request('idNotaCompra'),
        'idProducto'=> request('idProducto'),
        'cantidad'=> request('cantidad'),
        'costo'=> request('costo'),
        'importe'=> $costo * $cantidad,
    ]);

    // Calculate the total amount of the notaCompra
    $monto=DB::table('detalle_compras')->where('idNotaCompra',$idNotaCompra)->sum('importe');

    // Update the monto field of the notaCompra with the new total amount
    DB::table('nota_compras')->where('id',$idNotaCompra)->update([
        'monto'=>$monto
    ]);

    // Update the stock of the purchased product
    $productoStock = DB::table('productos')->where('id',$idProducto)->value('stock');
    $cantidad=request('cantidad');
    $nuevoStock = $productoStock + $cantidad;
    DB::table('productos')->where('id',$idProducto)->update([
        'stock'=>$nuevoStock
    ]);

    // Redirect to the showDetallecompra route with the idNotaCompra parameter
    return redirect(route('detalleCompras.showDetallecompra', $idNotaCompra));
}

 
/**
 * Display the specified resource.
 *
 * @param int $id The ID of the `NotaCompra` to display the details of.
 * @return \Illuminate\Http\Response
 */
public function showDetallecompra($id)
{
    // Find the `NotaCompra` with the given ID or throw an exception.
    $notaCompra=NotaCompra::findOrFail($id);
    
    // Get all the details of the `NotaCompra` with the given ID.
    $notas=DB::table('detalle_compras')->where('idNotaCompra',$notaCompra->id)->get();
    
    // Get all the available products.
    $productos=DB::table('productos')->get();
    
    // Return the view to display the details of the `NotaCompra`.
    return view('detalleCompra.createDetallecompra',compact('notaCompra'),['productos'=>$productos, 'notas'=>$notas]);
}

    
}
