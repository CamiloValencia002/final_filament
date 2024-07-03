<!-- Contenido específico del dashboard -->
<div class="container mt-5 mb-5">
    <div class="card mx-auto shadow">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Nueva Solicitud de Transporte</h2>
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
                            <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                        </div>
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
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Precio</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="price" name="price" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <button type="submit" class="btn btn-success btn-lg w-100">Enviar Solicitud</button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</div>