<!-- Contenido específico del dashboard -->
<div class="container mt-5 mb-5">
    <div class="card mx-auto">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Solicitud</h2>
            <form action="{{ route('procesar.formulario') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="mb-3">
                            <label for="carge_type" class="form-label">Tipo de Carga</label>
                            <input type="text" class="form-control" id="carge_type" name="carge_type" required>
                        </div>
                        <div class="mb-3">
                            <label for="size" class="form-label">Tamaño</label>
                            <input type="text" class="form-control" id="size" name="size">
                        </div>
                        <div class="mb-3">
                            <label for="weight" class="form-label">Peso</label>
                            <input type="text" class="form-control" id="weight" name="weight" required>
                        </div>

                        <div class="mb-3">
                            <label for="comment" class="form-label">Comentario</label>
                            <input type="text" class="form-control" id="comment" name="comment">
                        </div>
                       {{--  <div class="mb-3">
                            <label for="image" class="form-label">Imagen del paquete</label>
                            <input type="file" class="form-control" id="image" name="image" required>
                        </div> --}}
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="mb-3">
                            <label for="point_initial" class="form-label">Punto Inicial</label>
                            <input type="text" class="form-control" id="point_initial" name="point_initial" required>
                        </div>
                        <div class="mb-3">
                            <label for="point_finally" class="form-label">Punto Final</label>
                            <input type="text" class="form-control" id="point_finally" name="point_finally" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Descripción</label>
                            <input type="text" class="form-control" id="description" name="description">
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Precio</label>
                            <input type="text" class="form-control" id="price" name="price" required>
                        </div>
                        
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-12">
                        <button type="submit" class="btn btn-success w-100">Hacer solicitud</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
