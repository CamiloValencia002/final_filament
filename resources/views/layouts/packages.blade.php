<!-- resources/views/packages.blade.php -->

<div class="container">
    <div class="content p-4 border rounded bg-white">
        <h2 class="text-center mb-4">Mis Viajes</h2>
        <div class="table-responsive">
            <table class="table table-bordered border-dark">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Conductor</th>
                        <th scope="col">Paquete</th>
                        <th scope="col">Ubicación</th>
                        <th scope="col">Comentario</th>
                        <th scope="col">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Iterar sobre los paquetes -->
                    @foreach($packages as $package)
                        <tr>
                            <td>{{ $package->conductor }}</td>
                            <td>{{ $package->paquete }}</td>
                            <td>{{ $package->ubicacion }}</td>
                            <td>{{ $package->comentario }}</td>
                            <td>{{ $package->estado }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
