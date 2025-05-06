@extends('layout')

@section('title', 'Sobre Nosotros — Motivos para Adoptar')

@section('css')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
          crossorigin="anonymous"
          referrerpolicy="no-referrer" />

    <style>
        .about-hero {
            position: relative;
            overflow: hidden;
            color: black;             
            padding: 6rem 0;
            text-shadow: none;
            }
        .display-4 {
            font-weight: bold;   
        }
    .about-hero::before {
        content: "";
        position: absolute;
        inset: 0;                   
        background: url('/images/about-banner.jpeg') center/cover no-repeat;
        filter: blur(4px);           
        transform: scale(1.05);      
        z-index: -1;
    }

    .motive-icon {
        font-size: 2.5rem;
        color: #83c5be;
        margin-bottom: 1rem;
    }
    </style>
@endsection

@section('content')
    <section class="about-hero text-center">    
        <div class="container">
            <h1 class="display-4">¿Por qué adoptar un gato?</h1>
            <p class="lead">Descubre los motivos que convierten la adopción en una experiencia única.</p>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row gy-4">
                @foreach($motivos as $motivo)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm text-center border-0 p-4">
                            <i class="{{ $motivo['icon'] }} motive-icon"></i>
                            <h3>{{ $motivo['title'] }}</h3>
                            <p>{{ $motivo['text'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    
    <section class="text-center py-5 bg-light"> 
        <div class="container">
            <h2>¿Listo para adoptar?</h2>
            <p class="mb-4">Visita nuestro listado de gatos y encuentra a tu nuevo compañero hoy.</p>
            <a href="{{ route('gatos.index') }}" class="btn btn-primary btn-lg">Ver Gatos en Adopción</a>
        </div>
    </section>
@endsection

@section('scripts')
@endsection
