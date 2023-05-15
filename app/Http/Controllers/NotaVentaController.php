<?php

namespace App\Http\Controllers;

use App\Models\NotaVenta;
use App\Models\DetalleVenta;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;

/**
* This class updates the model and view of sale note
*/

class NotaVentaController extends Controller
{
    /**
     * Return the saved category to the view
     */
    public function index()
    {
        $notaVentas=NotaVenta::all();
        return view('notaVenta.index', compact('notaVentas'));//
    }

    /**
     * Show the form for creating a new sale note.
     */

   

    public function create()
    {
        $clientes = DB::table('clientes')->get();
        $productos = DB::table('productos')->get();
        return view('notaVenta.create',['clientes'=> $clientes,'productos' => $productos]);//
    }
 
    /**
     * * Save the data of a new sale note and return to sale note view
     *
     * @param    $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        date_default_timezone_set("America/La_Paz");
        $notaVenta=NotaVenta::create([
            'nroCliente'=>request('nroCliente'),
            'importe'=>0,
            'fecha' => date('Y/m/d'),
            'hora' => date('H:i')
        ]);

        activity()->useLog('NotaVenta')->log('Nuevo')->subject();
        $lastActivity = Activity::all()->last();
        $lastActivity->subject_id = NotaVenta::all()->last()->id;
        $lastActivity->save();
        return redirect()->route('detalleVentas.show',$notaVenta);
    }

    /**
     * Display the specified sale note.
     *
     * @param  \App\Models\notaVenta  $salenote
     * @return \Illuminate\Http\Response
     */
    
     public function show(notaVenta $notaVenta)
    {
        $detalleVenta= DB::table('detalle_ventas')->where('notaVenta_id',$notaVenta->id)->get();
        return view('notaVenta.show',compact ('detalleVenta'));
      
    }

    /**
     * Show the form for editing the specified sale note.
     *
     * @param  \App\Models\notaVenta  $notaVenta
     * @return \Illuminate\Http\Response
     */
    public function edit(notaVenta $notaVenta)
    {
        $clientes = DB::table('clientes')->get();
        return view('notaVenta.edit',compact('notaVenta'),['clientes'=>$clientes]);//
    }

    /**
     * Update the specified sale note in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\notaVenta  $notaVenta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, notaVenta $notaVenta)
    {
        date_default_timezone_set("America/La_Paz");
        $notaVenta->nroCliente=$request->nroCliente;
        $notaVenta->importe=$request->importe;
        $notaVenta->save();

        activity()->useLog('NotaVenta')->log('Editar')->subject();
        $lastActivity = Activity::all()->last();
        $lastActivity->subject_id = $notaVenta->id;
        $lastActivity->save();
        return redirect()->route('notaVentas.index');//
    }

     /**
     * Remove the specified sale note from database.
     *
     * @param  \App\Models\notaVenta  $notaVenta
     * @return \Illuminate\Http\Response
     */
    public function destroy(notaVenta $notaVenta)
    {
        $notaVenta->delete();
        activity()->useLog('NotaVenta')->log('Eliminar')->subject();
        $lastActivity = Activity::all()->last();
        $lastActivity->subject_id = $notaVenta->id;
        $lastActivity->save();
        return redirect()->route('notaVentas.index');//
    }
}
