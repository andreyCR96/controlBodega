<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Producto;


class ProductoController extends Controller
{
    public function __construct()
    {
        //Desbloquear cuando este el login
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth()->user()->role == 1) {
            $productos = Producto::all();
            return view('producto.producto', array(
                'productos' => $productos
            ));
        } else {
            abort('404');
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth()->user()->role == 1) {
            return view('producto.productoForm');
        } else {
            abort('404');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth()->user()->role == 1) {
            $validatedData = $this->validate($request, [
                'codigo' => 'required',
                'nombre' => 'required',
                'unidad' => 'required',
                'ubicacion' => 'required',
                'descripcion' => 'required',
                'id_lote'   => 'required',
            ]);

            $existProducto = Producto::where('codigo', $request->input('codigo'))->first();
            if ($existProducto) {
                return redirect()->action('ProductoController@create')->with('status', 'El código de producto ya se encuentra registrado');
            } else {
                $newProducto = new Producto();
                $newProducto->codigo = $request->input('codigo');
                $newProducto->nombre = $request->input('nombre');
                $newProducto->unidad = $request->input('unidad');
                $newProducto->ubicacion = $request->input('ubicacion');
                $newProducto->descripcion = $request->input('descripcion');
                $newProducto->id_lote = $request->input('id_lote');
                $newProducto->save();
                return redirect()->action('ProductoController@index')->with('status', 'Producto registrado correctamente');
            }
        } else {
            abort('404');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth()->user()->role == 1) {
            $producto = Producto::where('id_Producto', $id)->first();
            return view('producto.productoForm', array(
                'producto' => $producto
            ));
        } else {
            abort('404');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth()->user()->role == 1) {
            $validatedData = $this->validate($request, [
                'codigo' => 'required',
                'nombre' => 'required',
                'unidad' => 'required',
                'ubicacion' => 'required',
                'descripcion' => 'required',
                'id_lote'   => 'required',
            ]);

            $editProducto = Producto::find($id);
            $editProducto->codigo = $request->input('codigo');
            $editProducto->nombre = $request->input('nombre');
            $editProducto->unidad = $request->input('unidad');
            $editProducto->ubicacion = $request->input('ubicacion');
            $editProducto->descripcion = $request->input('descripcion');
            $editProducto->id_lote = $request->input('id_lote');
            $editProducto->save();
            return redirect()->action('ProductoController@index')->with('status', 'Producto actualiado correctamente');
        } else {
            abort('404');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth()->user()->role == 1) {
            $producto = Producto::where('id_Producto', $id)->first();
            $producto->delete();
            return redirect()->action('ProductoController@index')->with('status', 'Producto eliminado correctamente');
        } else {
            abort('404');
        }
    }
}
