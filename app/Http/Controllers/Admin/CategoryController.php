<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;

use App\Http\Controllers\Controller;

use App\Category;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
       //se muestra toda la lista de etiquetas 
        $categories = Category::orderBy('id', 'DESC')->paginate();
        // dd($categories);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //muestra el formulario
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryStoreRequest $request)
    {
 
        //$category = Category::create($request->all());
        //return redirect()->route('categories.edit', $category->id)
        //->with('info', 'Categoría creada con éxito');

        $category = Category::create($request->all());
        return redirect()->route('categories.edit', $category->id)
            ->with('info', 'Categoría creada con éxito');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //ver en detalle una etiqueta
        $category = Category::find($id);

        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //permite editar una etiqueta 
        $category = Category::find($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdateRequest $request, $id)
    {
        //actualiza la vista de los datos modificados 
        $category = Category::find($id);

        $category->fill($request->all())->save();

        return redirect()->route('categories.edit', $category->id)
        ->with('info', 'Categoría modificada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Eliminamos un registro 
        $category = Category::find($id)->delete();
        
        return back()->with('info', 'Categoría eliminada correctamente');

    }
}
