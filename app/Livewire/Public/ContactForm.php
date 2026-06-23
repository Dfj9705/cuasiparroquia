<?php

namespace App\Livewire\Public;

use App\Models\Contact;
use Livewire\Component;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class ContactForm extends Component
{
    public string $con_name = '';
    public string $con_email = '';
    public ?string $con_phone = null;
    public string $con_subject = '';
    public string $con_message = '';
    public string $website = '';

    protected function rules(): array
    {
        return [
            'con_name' => ['required', 'string', 'max:150'],
            'con_email' => ['required', 'email', 'max:150'],
            'con_phone' => ['nullable', 'string', 'max:30'],
            'con_subject' => ['required', 'string', 'max:180'],
            'con_message' => ['required', 'string', 'max:2000'],
            'website' => ['nullable', 'max:0'],
        ];
    }

    public function submit(): void
    {
        if (!blank($this->website)) {
            return;
        }
        $key = 'contact-form:' . request()->ip();

        if (RateLimiter::tooManyAttempts($key, 3)) {
            throw ValidationException::withMessages([
                'con_message' => 'Has enviado demasiados mensajes. Intenta nuevamente más tarde.',
            ]);
        }

        RateLimiter::hit($key, 300);
        $data = $this->validate();
        Contact::create([
            ...$data,
            'con_status' => 'pendiente',
        ]);

        $this->reset([
            'con_name',
            'con_email',
            'con_phone',
            'con_subject',
            'con_message',
        ]);

        session()->flash('success', 'Tu mensaje fue enviado correctamente.');
    }

    public function render()
    {
        return view('livewire.public.contact-form');
    }
}