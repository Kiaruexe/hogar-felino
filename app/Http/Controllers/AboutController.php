<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function about()
    {
        $motivos = [
            [
                'icon'  => 'fas fa-heart',
                'title' => 'Dar un hogar lleno de amor',
                'text'  => 'Ofrecerás cariño y compañía a un gato que lo necesita, y recibirás su lealtad incondicional.'
            ],
            [
                'icon'  => 'fas fa-leaf',
                'title' => 'Beneficios para la salud',
                'text'  => 'La compañía de un gato reduce el estrés, baja la presión arterial y mejora el estado de ánimo.'
            ],
            [
                'icon'  => 'fas fa-money-bill-wave',
                'title' => 'Ahorro responsable',
                'text'  => 'Adoptar es más económico que comprar. Además, evitas apoyar criaderos poco éticos.'
            ],
            [
                'icon'  => 'fas fa-users',
                'title' => 'Fomentar la adopción consciente',
                'text'  => 'Dar visibilidad al problema del abandono y animar a otros a tomar decisiones responsables.'
            ],
            [
                'icon'  => 'fas fa-paw',
                'title' => 'Contribuir a la protección animal',
                'text'  => 'Al adoptar, ayudas a reducir la sobrepoblación de gatos y apoyas la labor de refugios y protectoras.'
            ],
            [
                'icon'  => 'fas fa-smile',
                'title' => 'Un compañero para toda la vida',
                'text'  => 'Los gatos son animales cariñosos y leales que te brindarán amor y compañía durante muchos años.'
            ],
            [
                'icon'  => 'fas fa-globe',
                'title' => 'Un mundo mejor para los gatos',
                'text'  => 'Al adoptar, contribuyes a un futuro donde todos los gatos tengan un hogar y una vida digna.'
            ],
            [
                'icon'  => 'fas fa-thumbs-up',
                'title' => 'Un acto de amor y responsabilidad',
                'text'  => 'Adoptar es un compromiso que demuestra tu amor por los animales y tu deseo de hacer el bien.'
            ],
            [
                'icon'  => 'fas fa-clock',
                'title' => 'Un amigo para siempre',
                'text'  => 'Los gatos son compañeros leales que te brindarán amor y compañía durante muchos años.'
            ]
        ];

        return view('about', compact('motivos'));
    }
}
