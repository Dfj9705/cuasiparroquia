@props([
    'titlePage' => '',
    'titleBreadcrumb' => '',
    'url1Breadcrumb' => '',
    'url2Breadcrumb' => '',
])

<style>
    .bg-header {
        background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('storage/' . $site_header_image) }}');
        background-repeat: no-repeat;
        background-size: cover;

           background-position: center;
    }
</style>

<section class="section-py first-section-pt help-center-header position-relative overflow-hidden py-5 bg-header"
    style="min-height: 40vh">
    <h4 class="text-center text-white display-1 fw-bold pt-5">{{ $titlePage }}</h4>
</section>