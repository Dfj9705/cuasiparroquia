<div>
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="send">
        {{-- Honeypot oculto --}}
        <div style="display: none;">
            <input type="text" wire:model="website" tabindex="-1" autocomplete="off">
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" class="form-control" wire:model.blur="con_name">
                @error('con_name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" wire:model.blur="con_email">
                @error('con_email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Teléfono</label>
                <input type="text" class="form-control" wire:model.blur="con_phone">
                @error('con_phone')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Asunto</label>
                <input type="text" class="form-control" wire:model.blur="con_subject">
                @error('con_subject')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-12 mb-3">
                <label class="form-label">Mensaje</label>
                <textarea class="form-control" rows="5" wire:model.blur="con_message"></textarea>
                @error('con_message')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
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