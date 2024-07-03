<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PackageController extends Controller
{
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
        $package->id_customer = Auth::user()->id;
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

        // Mostrar una alerta SweetAlert de éxito
        Alert::success('¡Solicitud de paquete enviada correctamente!', 'Éxito')
        ->html('<video width="200" height="150" autoplay loop>
                  <source src="' . asset('img/camion.mp4') . '" type="video/mp4">
                  Tu navegador no soporta el elemento de video.
               </video>
               <p>Por favor espera que un conductor tome tu solicitud.</p>')
        ->showConfirmButton('Entendido', '#3085d6');
        // Redirigir a una página de confirmación u otra vista
        return redirect()->route('pedido');
    }
}
