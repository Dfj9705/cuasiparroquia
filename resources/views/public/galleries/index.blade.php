{{-- resources/views/public/galleries/index.blade.php --}}
@extends('layouts.public')

@section('title', 'Galería')
@section('meta_description', 'Galerías de imágenes institucionales.')

@section('content')

    <x-header-page titlePage="Galería" titleBreadcrumb="Galería" />

    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <livewire:gallery-viewer />
                </div>
            </div>
        </div>
    </section>

@endsection