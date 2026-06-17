<?php

namespace App\Livewire;

use App\Models\Contact;
use Livewire\Component;
use Illuminate\Support\Facades\RateLimiter;

class ContactForm extends Component
{
    public string $con_name = '';
    public string $con_email = '';
    public string $con_phone = '';
    public string $con_subject = '';
    public string $con_message = '';

    // Honeypot anti-spam
    public string $website = '';

    protected function rules(): array
    {
        return [
            'con_name' => ['required', 'string', 'min:3', 'max:150'],
            'con_email' => ['required', 'email', 'max:150'],
            'con_phone' => ['nullable', 'string', 'max:50'],
            'con_subject' => ['required', 'string', 'min:3', 'max:200'],
            'con_message' => ['required', 'string', 'min:10', 'max:2000'],
            'website' => ['nullable', 'max:0'],
        ];
    }

    protected array $messages = [
        'con_name.required' => 'El nombre es obligatorio.',
        'con_name.min' => 'El nombre debe tener al menos 3 caracteres.',
        'con_email.required' => 'El correo electrónico es obligatorio.',
        'con_email.email' => 'Ingrese un correo electrónico válido.',
        'con_subject.required' => 'El asunto es obligatorio.',
        'con_message.required' => 'El mensaje es obligatorio.',
        'con_message.min' => 'El mensaje debe tener al menos 10 caracteres.',
        'website.max' => 'No se pudo enviar el mensaje.',
    ];

    public function send(): void
    {

        $key = 'contact-form:' . request()->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);

            $this->addError(
                'rate_limit',
                'Demasiados intentos. Intente nuevamente en ' . ceil($seconds / 60) . ' minuto(s).'
            );

            return;
        }

        RateLimiter::hit($key, 300);
        $this->validate();

        Contact::create([
            'con_name' => $this->con_name,
            'con_email' => $this->con_email,
            'con_phone' => $this->con_phone,
            'con_subject' => $this->con_subject,
            'con_message' => $this->con_message,
            'con_status' => 'pendiente',
        ]);

        $this->reset([
            'con_name',
            'con_email',
            'con_phone',
            'con_subject',
            'con_message',
            'website',
        ]);

        session()->flash('success', 'Su mensaje fue enviado correctamente.');
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
