<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    // Otros métodos del controlador

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'carge_type' => 'required|string',
            'size' => 'nullable|string',
            'weight' => 'required|string',
            'point_initial' => 'required|string',
            'point_finally' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'comment' => 'nullable|string',
        ]);

        // Crear un nuevo paquete con los datos del formulario
        $package = new Package();
        $package->carge_type = $request->carge_type;
        $package->size = $request->size;
        $package->weight = $request->weight;
        $package->point_initial = $request->point_initial;
        $package->point_finally = $request->point_finally;
        $package->description = $request->description;
        $package->price = $request->price;
        $package->comment = $request->comment;
        $package->state = 'LIBRE';

        // Guardar el paquete en la base de datos
        $package->save();

        // Redirigir a una página de confirmación u otra vista
        return redirect()->route('inicioUser')->with('success', '¡Solicitud de paquete enviada correctamente!');
    }
}
