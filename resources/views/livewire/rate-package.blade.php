<div>
    <div class="container mt-5">
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Calificar Paquete</h5>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="submitRating">
                    <div class="form-group mb-4">
                        <label class="form-label">Calificación:</label>
                        <div class="star-rating">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="bi {{ $i <= $rating ? 'bi-star-fill' : 'bi-star' }} fs-2 text-warning" 
                                   wire:click="setRating({{ $i }})" style="cursor: pointer;"></i>
                            @endfor
                        </div>
                        @error('rating') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label for="comment" class="form-label">Comentario:</label>
                        <textarea class="form-control" id="comment" wire:model.defer="comment" rows="4" placeholder="Escribe tu comentario aquí..."></textarea>
                        @error('comment') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-send-fill me-2"></i>Enviar Calificación
                    </button>
                </form>
            </div>
        </div>
    </div>

    <style>
        .star-rating {
            display: inline-flex;
            gap: 0.25rem;
        }
        .star-rating i {
            transition: all 0.2s ease;
        }
        .star-rating i:hover {
            transform: scale(1.1);
        }
    </style>
</div>