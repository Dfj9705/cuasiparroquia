@extends('layouts.public')

@section('title', 'Noticias')
@section('meta_description', 'Noticias y publicaciones institucionales.')

@section('content')

    <x-header-page titlePage="Noticias" />

    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <livewire:post-search />
                </div>
            </div>
        </div>
    </section>

@endsection