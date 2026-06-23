<div>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="submit">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Nombre</label>
                <input type="text" wire:model.defer="con_name" class="form-control">
                @error('con_name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Correo</label>
                <input type="email" wire:model.defer="con_email" class="form-control">
                @error('con_email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Teléfono</label>
                <input type="text" wire:model.defer="con_phone" class="form-control">
                @error('con_phone') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Asunto</label>
                <input type="text" wire:model.defer="con_subject" class="form-control">
                @error('con_subject') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-12">
                <label class="form-label">Mensaje</label>
                <textarea rows="5" wire:model.defer="con_message" class="form-control"></textarea>
                @error('con_message') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                    <span wire:loading.remove>Enviar mensaje</span>
                    <span wire:loading>Enviando...</span>
                </button>
            </div>
        </div>
    </form>
</div>