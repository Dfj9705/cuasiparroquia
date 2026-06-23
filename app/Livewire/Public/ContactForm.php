<?php

namespace App\Livewire\Public;

use App\Models\Contact;
use Livewire\Component;

class ContactForm extends Component
{
    public string $con_name = '';
    public string $con_email = '';
    public ?string $con_phone = null;
    public string $con_subject = '';
    public string $con_message = '';

    protected function rules(): array
    {
        return [
            'con_name' => ['required', 'string', 'max:150'],
            'con_email' => ['required', 'email', 'max:150'],
            'con_phone' => ['nullable', 'string', 'max:30'],
            'con_subject' => ['required', 'string', 'max:180'],
            'con_message' => ['required', 'string', 'max:2000'],
        ];
    }

    public function submit(): void
    {
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