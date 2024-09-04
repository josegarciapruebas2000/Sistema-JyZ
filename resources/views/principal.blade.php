@extends('base')

@section('title', 'Dashboard')

@section('content')
    <div class="container mx-auto p-6 bg-gray-50 rounded-lg shadow-lg mt-10">
        <!-- Bienvenida -->
        <section class="mb-12 text-center">
            <h1 class="text-4xl font-extrabold mb-4" style="color: #A69177;">Bienvenidos a JyZ Fotografía</h1>
            <p class="text-xl text-gray-700 leading-relaxed">
                Transformamos tus recuerdos en piezas únicas y duraderas. Con más de 30 años de experiencia en el mercado, nos dedicamos a capturar los momentos más especiales de tu vida en fotografías y vídeo.
            </p>
        </section>

        <!-- Servicios -->
        <section class="mb-12">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-semibold mb-4" style="color: #A69177;">Nuestros Servicios</h2>
            </div>
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                <div class="p-6 bg-white rounded-lg shadow-lg transition transform hover:scale-105">
                    <h3 class="font-semibold text-xl mb-2">Fotografía y vídeo para eventos</h3>
                    <p class="text-gray-600">Cubrimos todo tipo de eventos, desde bodas, XV años y bautizos hasta graduaciones y sesiones fotográficas especiales.</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow-lg transition transform hover:scale-105">
                    <h3 class="font-semibold text-xl mb-2">Reparación y restauración de fotografías</h3>
                    <p class="text-gray-600">Restauramos fotografías antiguas y dañadas para que puedas volver a disfrutar de tus recuerdos.</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow-lg transition transform hover:scale-105">
                    <h3 class="font-semibold text-xl mb-2">Cuadros personalizados</h3>
                    <p class="text-gray-600">Creamos cuadros personalizados para cualquier evento, ofreciendo opciones de alta calidad.</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow-lg transition transform hover:scale-105">
                    <h3 class="font-semibold text-xl mb-2">Ampliaciones y montajes personalizados</h3>
                    <p class="text-gray-600">Ofrecemos ampliaciones de fotografías y montajes personalizados para darle un toque especial a tus espacios.</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow-lg transition transform hover:scale-105">
                    <h3 class="font-semibold text-xl mb-2">Paquetes personalizados para cada evento</h3>
                    <p class="text-gray-600">Ofrecemos diferentes paquetes que se ajustan a tus necesidades para que tengas la mejor experiencia en tu evento.</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow-lg transition transform hover:scale-105">
                    <h3 class="font-semibold text-xl mb-2">Paquetes de fotografía de bebés</h3>
                    <p class="text-gray-600">Capturamos los primeros momentos de la vida de tu pequeño con paquetes de fotografía de bebés.</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow-lg transition transform hover:scale-105">
                    <h3 class="font-semibold text-xl mb-2">Servicio de envío a domicilio</h3>
                    <p class="text-gray-600">Ofrecemos servicio de envío a domicilio de tus fotografías, cuadros y vídeos.</p>
                </div>
            </div>
        </section>

        <!-- Paquetes -->
        <section class="mb-12 text-center">
            <h2 class="text-3xl font-semibold mb-4" style="color: #A69177;">Paquetes Disponibles</h2>
            <p class="text-xl text-gray-700 leading-relaxed mb-6">
                Descubre nuestras ofertas exclusivas y elige el paquete perfecto para inmortalizar tus momentos más especiales. Desde eventos memorables hasta sesiones personalizadas, tenemos opciones que se adaptan a cada ocasión.
            </p>
            <a href="/paquetes" class="py-3 px-6 mt-4 inline-block bg-[#A69177] text-white font-bold rounded-full shadow-lg hover:bg-[#8d6c5a] transition transform hover:scale-105">Ver Paquetes</a>
        </section>

        <!-- Contacto -->
        <section class="mb-12 text-center">
            <h2 class="text-3xl font-semibold mb-4" style="color: #A69177;">Contáctanos</h2>
            <p class="text-xl text-gray-700 leading-relaxed mb-6">
                En JyZ Fotografía, nos dedicamos a ofrecer calidad en cada detalle. Contáctanos hoy mismo para descubrir cómo podemos capturar y eternizar tus momentos más especiales con nuestro servicio personalizado y profesional.
            </p>
            <div class="flex justify-center space-x-4 mt-4">
                <a href="https://www.facebook.com/JyZfotografia/?locale=es_LA" target="_blank" class="py-3 px-6 bg-[#1F2937] text-white font-bold rounded-full shadow-lg hover:bg-gray-800 transition transform hover:scale-105">Facebook</a>
                <a href="https://api.whatsapp.com/send/?phone=5219221647818&text=Hola%2C+vengo+de+tu+sitio+web.+Me+interesa+obtener+m%C3%A1s+informaci%C3%B3n+sobre+tus+productos+y+servicios.+%C2%BFPodr%C3%ADas+ayudarme%3F%0A%0A&type=phone_number&app_absent=0" target="_blank" class="py-3 px-6 bg-[#1F2937] text-white font-bold rounded-full shadow-lg hover:bg-gray-800 transition transform hover:scale-105">WhatsApp</a>
            </div>
        </section>

        <!-- Sobre Nosotros -->
        <section class="mb-12 text-center">
            <h2 class="text-3xl font-semibold mb-4" style="color: #A69177;">Sobre Nosotros</h2>
            <p class="text-xl text-gray-700 leading-relaxed mb-6">
                En JyZ Fotografía, llevamos más de 30 años transformando tus recuerdos en piezas únicas y duraderas. Somos un equipo dedicado a capturar los momentos más especiales de tu vida a través de la magia de la fotografía y el vídeo.
            </p>
            <p class="text-xl text-gray-700 leading-relaxed mb-6">
                Nos enorgullece especializarnos en una amplia gama de servicios, desde la cobertura de eventos significativos como bodas, XV años y bautizos, hasta la restauración de fotografías antiguas y la creación de cuadros personalizados. Nuestro compromiso es brindarte una experiencia única y memorable en cada ocasión.
            </p>
            <p class="text-xl text-gray-700 leading-relaxed">
                Con un enfoque creativo y profesional, buscamos capturar la autenticidad de cada momento, garantizando que tus recuerdos perduren para siempre.
            </p>
        </section>
    </div>
@endsection
