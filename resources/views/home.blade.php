@extends('layouts.main')

@section('title', 'RAV3N')

@section('content')
<div>
    <div class="contenedor-portada" id="portada-home">
        <div class="contenido-portada">
            <h1 class="titulo-principal">RAV3N</h1>
            <p>Indicadores bursátiles</p>
        </div>
    </div>
    <div id="alert-container">
        @if(session('status'))
            <div class="alert alert-success mb-3" id="success-alert">
                {{ session('status') }}
            </div>
            @php
                // Establecer el tiempo de duración del alert en segundos
                $alert_duration = 3;
            @endphp
            <script>
                // Ocultar el alert después del tiempo establecido
                setTimeout(function() {
                    document.getElementById('success-alert').style.display = 'none';
                }, {{ $alert_duration * 1000 }});
            </script>
        @endif
    </div>
    <section class="seccion-quienes-somos">
        <h2>¿Quiénes somos?</h2>
        <div class='posicionamiento-quienes-somos'>
            <div class="foto-quienes-somos">
                <img src="{{ asset('logo-rav3n.svg') }}" alt="Logo de RAV3N">
            </div>
            <div class="contenedor-texto-quienes-somos">
                <p>En <span>RAV3N</span> ofrecemos un conjunto de indicadores técnicos diseñados para ser utilizados en todo tipo de mercados financieros, como criptomonedas, Forex, acciones y varios otros. Nuestros indicadores han sido pensados y simplificados para que cualquier persona pueda adentrarse en el mundo del trading y facilitar parte del camino.</p>
                <p>Brindamos a los traders acceso a información cruda del mercado visualizada de manera que puede ayudar a proporcionar un nivel más profundo de análisis y ayudar a tomar decisiones comerciales oportunas con un mayor grado de racionalidad y confianza. El conjunto de herramientas de RAV3N incluye una variedad de 3 herramientas. Cada una diseñada con precisión para poder enfrentar diferentes situaciones del mercado y poder sacar el máximo provecho de él.</p>
            </div>
        </div>
    </section>
    <section class="seccion-indicadores">
        <h2>Indicadores</h2>
        <div class="division-indicadores">
            <div class="indicadores">
                <ul>
                    <li>
                        <a href="#explicacion-rav3n-a" class="indicador" data-indicador="RAV3N A">RAV3N A</a>
                    </li>
                    <li>
                        <a href="#explicacion-rav3n-b" class="indicador" data-indicador="RAV3N B">RAV3N B</a>
                    </li>
                    <li>
                        <a href="#explicacion-backtesting" class="indicador" data-indicador="Backtesting">Backtesting</a>
                    </li>
                </ul>
            </div>
            <div class="explicacion-indicadores">
                <div id="explicacion-rav3n-a" class="explicacion">
                    <h3>RAV3N A</h3>
                    <p>RAV3N A es un indicador de buy sell que pone buy sell en el gráfico mientras las velas se mueven. Parece que utiliza las EMAs.</p>
                </div>
                <div id="explicacion-rav3n-b" class="explicacion">
                    <h3>RAV3N B</h3>
                    <p>RAV3N B es un indicador de sobrecompra y sobreventa que parece utilizar las EMAs para determinar si el activo está sobrevendido o sobrecomprado.</p>
                </div>
                <div id="explicacion-backtesting" class="explicacion">
                    <h3>Backtesting</h3>
                    <p>Backtesting es un indicador que toma las señales del RAV3N A y del RAV3N B en conjunto o por separado, y realiza un cálculo de cuántas veces acertó y cuánto no acertó.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="seccion-preguntas-frecuentes">
        <h2>Preguntas frecuentes</h2>
        <div class="contenedor-preguntas-frecuentes">
            <?php
            $preguntas_frecuentes = [
                [
                    'pregunta' => '¿Qué es RAV3N?',
                    'respuesta' => '<span>RAV3N</span> es una plataforma que ofrece un conjunto de indicadores técnicos diseñados para ser utilizados en diversos mercados financieros, incluyendo criptomonedas, forex, acciones y más.'
                ],
                [
                    'pregunta' => '¿Cuál es el propósito de RAV3N?',
                    'respuesta' => 'El propósito principal de <span>RAV3N</span> es proporcionar a los traders acceso a información cruda del mercado visualizada de manera que pueda ayudar a proporcionar un nivel más profundo de análisis y ayudar a tomar decisiones comerciales oportunas con un mayor grado de racionalidad y confianza.'
                ],
                [
                    'pregunta' => '¿Qué herramientas ofrece RAV3N?',
                    'respuesta' => '<span>RAV3N</span> ofrece una variedad de herramientas, cada una diseñada con precisión para enfrentar diferentes situaciones del mercado y sacar el máximo provecho de él.'
                ],
                [
                    'pregunta' => '¿Quién puede usar RAV3N?',
                    'respuesta' => '<span>RAV3N</span> está diseñado para ser utilizado por traders de todos los niveles de experiencia, desde principiantes hasta expertos en trading.'
                ],
                [
                    'pregunta' => '¿Qué se necesita?',
                    'respuesta' => 'Para usar los indicadores ofrecidos por <span>RAV3N</span> se necesita una cuenta de tradingview.'
                ],
                [
                    'pregunta' => '¿Qué tipo de análisis proporciona RAV3N?',
                    'respuesta' => '<span>RAV3N</span> proporciona análisis técnico de mercado, incluyendo indicadores personalizados, análisis de tendencias, y herramientas de backtesting para evaluar estrategias comerciales.'
                ],
                [
                    'pregunta' => '¿RAV3N ofrece soporte para diferentes tipos de mercados?',
                    'respuesta' => 'Sí, <span>RAV3N</span> ofrece soporte para una amplia variedad de mercados financieros, incluyendo criptomonedas, Forex, acciones, y más.'
                ],
            ];
            ?>
            @foreach ($preguntas_frecuentes as $index => $pregunta)
                <div class="pregunta">
                    <input type="checkbox" id="pregunta{{ $index + 1 }}" class="ocultar">
                    <label for="pregunta{{ $index + 1 }}" class="boton-acordeon">
                        <img src="{{ asset('flecha-abajo.webp') }}" alt="Flecha Abajo">
                        {{ $pregunta['pregunta'] }}
                    </label>
                    <div class="respuesta">
                        <p>{!! $pregunta['respuesta'] !!}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</div>
@endsection