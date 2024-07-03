<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">Calificar Paquete</div>
        <div class="card-body">
            <form wire:submit.prevent="submitRating">
                <div class="form-group">
                    <label for="rating">Calificación (1-5):</label>
                    <input type="number" class="form-control" id="rating" wire:model="rating" min="1" max="5" required>
                    @error('rating') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group mt-3">
                    <label for="comment">Comentario:</label>
                    <textarea class="form-control" id="comment" wire:model="comment"></textarea>
                    @error('comment') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="btn btn-primary mt-3">Enviar Calificación</button>
            </form>
        </div>
    </div>
</div>