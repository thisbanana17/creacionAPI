<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Producto::all(), 200); //200: OK   
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
     // Validar Productos
 $datos = $request->validate([
    'nombre' =>['required', 'string', 'max:100'],
    'descripcion' =>['nullable','string', 'max:255'],
    'precio' =>['required', 'integer', 'min:1000'],
    'stock' =>['required', 'integer','min:1'],
     ]);
     //Guardar Datos
     $producto = Producto::create($datos);
     // Respuesta al Cliente
    return response()->json(['success' => true, 'message' => 'Producto creado'], 201);    //
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
    return response()->json($producto, 200); //200: OK  //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
      // Validar datos de entrada
 $datos = $request->validate([
'nombre' =>['required', 'string','max:100'],
'descripcion' =>['nullable','string', 'max:255'],
'precio' =>['required', 'integer','min:1000'],
'stock' =>['required', 'integer','min:1'],
 ]);
 // Actualizar Producto
 $producto->update($datos);
 // Respuesta al Cliente
 return response()->json(['success' => true,'message' => 'Producto actualizado'], 200);   //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return response()->json(['success' => true,'message' => 'Producto eliminado'], 200);  //
    }
}
