@extends('layouts.public')

@section('title', 'Descargas')
@section('meta_description', 'Documentos y archivos disponibles para descarga.')

@section('content')

    <x-header-page titlePage="Descargas" />

    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <livewire:download-filter />
                </div>
            </div>
        </div>
    </section>

@endsection