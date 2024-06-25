@extends('layouts.main')

@section('title', 'Vip')

@section('content')
<div class="contenedor-portada">
    <h1 class="titulo-seccion">Vip</h1>
</div>
<section class="seccion-beneficios">
    <h2>Beneficios</h2>
    <div class="contenedor-beneficios">
        <div class="contenedor-grafico-beneficios">
            <h3>Unite a nuestro VIP y maximiza tus ganancias</h3>
            <img src="{{ asset('grafico.webp') }}" alt="Gráfico mercado búrsatil">
        </div>
        <div class="posicionamiento-caja-beneficios">
            <div class="caja-beneficios">
                <h4>Rav3n A</h4>
            </div>
            <div class="caja-beneficios">
                <h4>Rav3n B</h4>
            </div>
            <div class="caja-beneficios">
                <h4>Backtesting</h4>
            </div>
        </div>
    </div>
</section>
<section class="seccion-como-unirse">
    <h2>¿Cómo unirse a nuestra membresía VIP?</h2>
    <div class="contenedor-pasos">
        <div class="paso">
            <h3>Paso 1: Regístrate en nuestro sitio web</h3>
            <p>Para unirte a nuestra membresía VIP, primero necesitas registrarte en nuestro sitio web. Haz clic en el botón "Registrarse" en la esquina superior derecha de la página y completa el formulario de registro con tu información personal.</p>
        </div>
        <div class="paso">
            <h3>Paso 2: Selecciona tu plan de membresía</h3>
            <p>Una vez que hayas completado el registro, selecciona el plan de membresía VIP que mejor se adapte a tus necesidades. Ofrecemos diferentes planes con beneficios exclusivos para nuestros miembros VIP.</p>
        </div>
        <div class="paso">
            <h3>Paso 3: Realiza el pago</h3>
            <p>Después de tocar el botón de suscribirte en el home de esta sección, serás redirigido a la página de pago. Ahí podrás elegir tu método de pago preferido y completar la transacción de forma segura.</p>
            <p class="precio-sub">Precio:<span id="precio">10.000$</span></p>
        </div>
        <div class="paso">
            <h3>Paso 4: ¡Bienvenido a la comunidad VIP!</h3>
            <p>Felicidades, ahora eres oficialmente parte de nuestra exclusiva comunidad VIP. Obtendrás acceso instantáneo a nuestros indicadores premium, contenido exclusivo y soporte prioritario.</p>
        </div>
    </div>
    <div class="contenedor-botones-suscripcion">
        <a href="#" class="boton-suscripcion">Suscríbete ahora</a>
    </div>
</section>
<section class="seccion-referencias">
    <h2>Referencias</h2>
    <div class="contenedor-referencias">
        <div class="caja-referencia">
            <img src="{{ asset('uruguay.webp') }}" alt="Logo de CryptoMaster">
            <h3 class="titulo-referencia">CryptoMaster</h3>
            <p>¡Increíble servicio! Los indicadores de RAV3N me han ayudado enormemente en mis operaciones. Recibir ayuda y trades en el Discord VIP es un plus que no tiene precio.</p>
            <p>⭐⭐⭐⭐⭐</p>
        </div>
        <div class="caja-referencia">
            <img src="{{ asset('tiburon-nft.webp') }}" alt="Logo de BitcoinGuru">
            <h3 class="titulo-referencia">BitcoinGuru</h3>
            <p>Buen servicio, los indicadores son útiles y fáciles de entender. El Discord VIP proporciona una gran comunidad para discutir estrategias y recibir ayuda.</p>
            <p>⭐⭐⭐⭐</p>
        </div>
        <div class="caja-referencia">
            <img src="{{ asset('messi.webp') }}" alt="Logo de EtherWhale">
            <h3 class="titulo-referencia">EthereumWhale</h3>
            <p>Los indicadores son decentes, aunque a veces me cuesta entender cómo usarlos completamente. El Discord VIP es útil para obtener ayuda cuando la necesito.</p>
            <p>⭐⭐⭐</p>
        </div>
    </div>
</section>
@endsection
