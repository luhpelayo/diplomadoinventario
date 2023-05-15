<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

/**
* This class updates the model and view of category
*/

class CategoriaController extends Controller
{
    /**
     * Return the saved category to the view
     */
    public function index()
    {
         $categorias = Categoria::all();
         return view('categoria.index',compact('categorias'));
    }

    /**
     * Show the form for creating a new category
     */
    public function create()
    {
        return view('categoria.create');
    }

    /**
     * Save the data of a new category and return to category view
     * @param    $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        date_default_timezone_set("America/La_Paz");
        $categorias=categoria::create([
            'nombre'=>request('nombre'),
        ]);
        activity()->useLog('Categoria')->log('Registrar')->subject();
        $lastActivity=Activity::all()->last();
        $lastActivity->subject_id=Categoria::all()->last()->id;
        $lastActivity->save();
        return redirect()->route('categorias.index');
    }

    /**
     * Display the specified category.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        return view('categoria.show',compact ('categoria'));//
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoria $categoria)
    {
        return view('categoria.edit',compact('categoria'));//
    }

    /**
     * Update the specified category in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoria $categoria)
    {
        date_default_timezone_set("America/La_Paz");
        $categoria->nombre=$request->nombre;
        $categoria->save();

        activity()->useLog('Categoria')->log('Editar')->subject();
        $lastActivity=Activity::all()->last();
        $lastActivity->subject_id= $categoria->id;
        $lastActivity->save();

        return redirect()->route('categorias.index');//
    }

    /**
     * Remove the specified category from database.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        return redirect()->route('categorias.index');
    }
}
