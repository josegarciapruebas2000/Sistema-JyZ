<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- CSRF Token -->
    <title>Login</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alkatra&display=swap" />
    <link href="https://fonts.googleapis.com/css2?family=PT+Serif&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Elsie:wght@900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        @font-face {
            font-family: "JYZ";
            src: url("/font/Higuen Serif.otf") format("opentype");
        }

        .font-jyz {
            font-family: "JYZ", serif;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .animate-slideIn {
            animation: slideIn 0.5s ease-out forwards;
        }

        .animate-fadeIn {
            animation: fadeIn 1s ease-out forwards;
        }

        #logo {
            filter: drop-shadow(10px 20px 10px rgba(0, 0, 0, 0.353));
            border-radius: 80px;
        }

        input[type="password"]::-ms-reveal,
        input[type="password"]::-ms-clear {
            display: none;
        }

        .welcome-text,
        .center-text,
        .bottom-text {
            position: absolute;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            text-align: center;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
        }

        .welcome-text {
            top: 10%;
            font-family: Alkatra;
        }

        .center-text {
            top: 55%;
            font-size: 3em;
            font-family: 'JYZ', serif;
        }

        .bottom-text {
            bottom: 15%;
            color: #F2D0A7;
            font-family: 'Dancing Script', cursive;
            font-size: 1rem;
        }

        .image-container {
            position: relative;
            width: 100%;
            height: 100%;
            border-radius: 10px;
            overflow: hidden;
        }

        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: brightness(50%);
        }

        .footer-buttons {
            position: absolute;
            bottom: 10px;
            right: 10px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .footer-buttons button,
        .footer-buttons a {
            font-size: 0.75rem;
            padding: 0.5rem 1rem;
        }

        @media (max-width: 768px) {
            .welcome-text {
                font-size: 1.25rem;
            }

            .center-text {
                font-size: 1.5rem;
            }

            .bottom-text {
                font-size: 0.875rem;
            }

            .footer-buttons {
                bottom: 5px;
                right: 5px;
                flex-direction: row;
                gap: 5px;
            }

            .footer-buttons button,
            .footer-buttons a {
                font-size: 0.625rem;
                padding: 0.25rem 0.5rem;
            }
        }
    </style>
</head>

<body
    class="bg-gradient-to-r from-[#404040] via-[#262626] to-[#59554D] flex items-center justify-center min-h-screen p-4">
    
    <div
        class="bg-[#262626] p-4 sm:p-8 rounded-lg shadow-2xl w-full max-w-4xl animate-slideIn flex flex-col md:flex-row">
        <div
            class="w-full md:w-1/2 p-8 bg-[#59554D] rounded-t-lg md:rounded-tl-lg md:rounded-bl-lg md:rounded-t-none hidden md:block">
            <div class="image-container h-64 md:h-full">
                <img src="{{ asset('img/b.jpg') }}" alt="Imagen Lateral" class="shadow-lg">
                <div class="welcome-text">
                    <h2 class="text-2xl md:text-3xl">ADMINISTRADOR</h2>
                </div>
                <div class="center-text">
                    <h2 class="text-3xl md:text-4xl font-bold mt-2">JyZ FOTOGRAFÍA</h2>
                </div>
                <div class="bottom-text">
                    <p>Captura tus momentos perfectos</p>
                </div>
                <div class="footer-buttons">
                    <a href="https://www.facebook.com/JyZfotografia/?locale=es_LA" target="_blank"
                        class="inline-block bg-gradient-to-r from-[#A69177] to-[#F2D0A7] hover:from-[#F2D0A7] hover:to-[#A69177] text-[#262626] font-bold py-1 px-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F2D0A7] transition duration-500 transform hover:scale-105 flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M22.675 0h-21.35c-0.733 0-1.325 0.592-1.325 1.325v21.351c0 0.733 0.592 1.324 1.325 1.324h11.495v-9.294h-3.123v-3.622h3.123v-2.672c0-3.097 1.894-4.788 4.659-4.788 1.325 0 2.463 0.099 2.794 0.143v3.24l-1.917 0.001c-1.504 0-1.795 0.715-1.795 1.763v2.313h3.587l-0.467 3.622 h-3.12v9.294h6.116c0.733 0 1.325-0.591 1.325-1.324v-21.351c0-0.733-0.592-1.325-1.325-1.325z" />
                        </svg>
                        Facebook
                    </a>
                    <a href="https://jyzfotografia.000webhostapp.com/index.html" target="_blank"
                        class="inline-block bg-gradient-to-r from-[#A69177] to-[#F2D0A7] hover:from-[#F2D0A7] hover:to-[#A69177] text-[#262626] font-bold py-1 px-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F2D0A7] transition duration-500 transform hover:scale-105 flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm1 17.93v-1.484h-2v1.484c-4.078-0.464-7.291-3.677-7.755-7.755h1.484v-2h-1.484c0.464-4.078 3.677-7.291 7.755-7.755v1.484h2v-1.484c4.078 0.464 7.291 3.677 7.755 7.755h-1.484v2h1.484c-0.464 4.078-3.677 7.291-7.755 7.755zm-1-10.93v-3h2v3h3v2h-3v3h-2v-3h-3v-2h3z" />
                        </svg>
                        Visitar web
                    </a>
                </div>
            </div>
        </div>
        <div
            class="w-full md:w-1/2 p-8 bg-[#262626] rounded-b-lg md:rounded-r-lg md:rounded-b-none flex flex-col justify-center">
            <div class="flex justify-center mb-6">
                <img src="{{ asset('/img/logo-mov.gif') }}" alt="Logo" width="150" id="logo">
            </div>
            <form action="{{ route('entrarAdmin') }}" method="POST">
                @csrf <!-- CSRF Token for security -->
                <div class="mb-5">
                    <label for="telefono" class="block text-[#F2D0A7] text-sm font-semibold mb-2">Teléfono</label>
                    <input type="text" id="telefono" name="telefono"
                        class="shadow-md appearance-none border border-[#59554D] rounded-lg w-full py-3 px-4 text-[#A69177] leading-tight focus:outline-none focus:ring-2 focus:ring-[#F2D0A7] focus:border-transparent transition duration-500"
                        required placeholder="Ingrese 10 dígitos" oninput="formatPhoneNumber()">
                </div>
                <div class="mb-5">
                    <label for="password" class="block text-[#F2D0A7] text-sm font-semibold mb-2">Contraseña</label>
                    <div class="flex items-center">
                        <div class="grid grid-cols-4 gap-2 flex-grow">
                            <input type="password" inputmode="numeric" maxlength="1" pattern="\d*"
                                class="password-input shadow-md appearance-none border border-[#59554D] rounded-lg py-3 px-4 text-[#A69177] text-center leading-tight focus:outline-none focus:ring-2 focus:ring-[#F2D0A7] focus:border-transparent transition duration-500"
                                required>
                            <input type="password" inputmode="numeric" maxlength="1" pattern="\d*"
                                class="password-input shadow-md appearance-none border border-[#59554D] rounded-lg py-3 px-4 text-[#A69177] text-center leading-tight focus:outline-none focus:ring-2 focus:ring-[#F2D0A7] focus:border-transparent transition duration-500"
                                required>
                            <input type="password" inputmode="numeric" maxlength="1" pattern="\d*"
                                class="password-input shadow-md appearance-none border border-[#59554D] rounded-lg py-3 px-4 text-[#A69177] text-center leading-tight focus:outline-none focus:ring-2 focus:ring-[#F2D0A7] focus:border-transparent transition duration-500"
                                required>
                            <input type="password" inputmode="numeric" maxlength="1" pattern="\d*"
                                class="password-input shadow-md appearance-none border border-[#59554D] rounded-lg py-3 px-4 text-[#A69177] text-center leading-tight focus:outline-none focus:ring-2 focus:ring-[#F2D0A7] focus:border-transparent transition duration-500"
                                required>
                        </div>
                        <button type="button" onclick="togglePasswordVisibility()"
                            class="ml-4 text-[#A69177] focus:outline-none transition duration-500 transform hover:scale-110">
                            <svg id="togglePasswordIcon" class="w-6 h-6 transition-transform duration-500 ease-in-out"
                                fill="currentColor" viewBox="0 0 576 512" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z">
                                </path>
                            </svg>
                        </button>
                    </div>
                    <input type="hidden" id="password" name="password">
                </div>
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-gradient-to-r from-[#A69177] to-[#F2D0A7] hover:from-[#F2D0A7] hover:to-[#A69177] text-[#262626] font-bold py-3 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F2D0A7] transition duration-500 transform hover:scale-105">
                        Entrar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@12"></script>
    <script>
        function formatPhoneNumber() {
            const input = document.getElementById('telefono');
            let numbers = input.value.replace(/\D/g, '');
            let char = {
                0: '(',
                3: ') ',
                6: '-'
            };
            numbers = numbers.substring(0, 10);
            let formatted = '';
            for (let i = 0; i < numbers.length; i++) {
                formatted += (char[i] || '') + numbers[i];
            }
            input.value = formatted;
        }

        document.querySelectorAll('.password-input').forEach((input, idx, inputs) => {
            input.addEventListener('input', () => {
                const fullPassword = Array.from(inputs).map(i => i.value).join('');
                document.getElementById('password').value = fullPassword;

                if (input.value.length === input.maxLength) {
                    if (idx < inputs.length - 1) {
                        inputs[idx + 1].focus();
                    }
                }
            });
        });

        function togglePasswordVisibility() {
            const passwordInputs = document.querySelectorAll('.password-input');
            const toggleIcon = document.getElementById('togglePasswordIcon');
            passwordInputs.forEach(input => {
                if (input.type === 'password') {
                    input.type = 'text';
                    toggleIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M38.8 5.1C28.4-3.1 13.3-1.2 5.1 9.2S-1.2 34.7 9.2 42.9l592 464c10.4 8.2 25.5 6.3 33.7-4.1s6.3-25.5-4.1-33.7L525.6 386.7c39.6-40.6 66.4-86.1 79.9-118.4c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C465.5 68.8 400.8 32 320 32c-68.2 0-125 26.3-169.3 60.8L38.8 5.1zm151 118.3C226 97.7 269.5 80 320 80c65.2 0 118.8 29.6 159.9 67.7C518.4 183.5 545 226 558.6 256c-12.6 28-36.6 66.8-70.9 100.9l-53.8-42.2c9.1-17.6 14.2-37.5 14.2-58.7c0-70.7-57.3-128-128-128c-32.2 0-61.7 11.9-84.2 31.5l-46.1-36.1zM394.9 284.2l-81.5-63.9c4.2-8.5 6.6-18.2 6.6-28.3c0-5.5-.7-10.9-2-16c.7 0 1.3 0 2 0c44.2 0 80 35.8 80 80c0 9.9-1.8 19.4-5.1 28.2zm9.4 130.3C378.8 425.4 350.7 432 320 432c-65.2 0-118.8-29.6-159.9-67.7C121.6 328.5 95 286 81.4 256c8.3-18.4 21.5-41.5 39.4-64.8L83.1 161.5C60.3 191.2 44 220.8 34.5 243.7c-3.3 7.9-3.3 16.7 0 24.6c14.9 35.7 46.2 87.7 93 131.1C174.5 443.2 239.2 480 320 480c47.8 0 89.9-12.9 126.2-32.5l-41.9-33zM192 256c0 70.7 57.3 128 128 128c13.3 0 26.1-2 38.2-5.8L302 334c-23.5-5.4-43.1-21.2-53.7-42.3l-56.1-44.2c-.2 2.8-.3 5.6-.3 8.5z"></path>
                `;
                    toggleIcon.classList.add('rotate-180');
                } else {
                    input.type = 'password';
                    toggleIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z"></path>
                `;
                    toggleIcon.classList.remove('rotate-180');
                }
            });
        }

        // Mostrar mensajes de éxito y error desde la sesión
        window.addEventListener('DOMContentLoaded', () => {
            const successMessage = "{{ session('success') }}";
            const errorMessage = "{{ $errors->first('message') }}";

            if (successMessage) {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: successMessage,
                });
            }

            if (errorMessage) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorMessage,
                });
            }
        });
    </script>


</body>

</html>
