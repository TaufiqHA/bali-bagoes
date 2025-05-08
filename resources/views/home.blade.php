<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Produk Digital Premium</title>
        <script src="https://cdn.tailwindcss.com/3.4.16"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: { primary: "#3176FF", secondary: "#FF6B35" },
                        borderRadius: {
                            none: "0px",
                            sm: "4px",
                            DEFAULT: "8px",
                            md: "12px",
                            lg: "16px",
                            xl: "20px",
                            "2xl": "24px",
                            "3xl": "32px",
                            full: "9999px",
                            button: "8px",
                        },
                    },
                },
            };
        </script>
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap"
            rel="stylesheet"
        />
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
            rel="stylesheet"
        />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css"
        />
        <style>
            :where([class^="ri-"])::before {
                content: "\f3c2";
            }
            body {
                font-family: "Poppins", sans-serif;
            }
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }
            input[type="number"] {
                -moz-appearance: textfield;
            }
            .modal {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 50;
            }
            .modal-content {
                background-color: white;
                margin: 5vh auto;
                padding: 2rem;
                border-radius: 8px;
                max-width: 600px;
                position: relative;
            }
            .modal-content::-webkit-scrollbar {
                width: 6px;
            }
            .modal-content::-webkit-scrollbar-track {
                background: #f1f1f1;
                border-radius: 3px;
            }
            .modal-content::-webkit-scrollbar-thumb {
                background: #888;
                border-radius: 3px;
            }
            .modal-content::-webkit-scrollbar-thumb:hover {
                background: #555;
            }
            .close {
                position: sticky;
                top: 0;
                right: 1rem;
                cursor: pointer;
                float: right;
                z-index: 51;
            }
        </style>
    </head>
    <body class="bg-gray-50">
        <nav class="w-full bg-white shadow-sm py-4 fixed top-0 z-50">
            <div class="container mx-auto px-4 md:px-8 max-w-6xl">
                <a href="/" class="text-2xl font-['Pacifico'] text-primary">{{
                    $data["brand"]
                }}</a>
            </div>
        </nav>
        <header
            class="w-full bg-gradient-to-r from-primary to-blue-400 text-white py-20 mt-16"
        >
            <div class="container mx-auto px-4 md:px-8 max-w-6xl">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">
                    {{ $data["heading"] }}
                </h1>
                <p class="text-xl md:text-2xl max-w-2xl">
                    {{ $data["description"] }}
                </p>
            </div>
        </header>
        <main class="container mx-auto px-4 md:px-8 max-w-6xl py-16">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($products as $product)
                <div
                    class="bg-white rounded shadow-lg overflow-hidden transition-transform hover:shadow-xl hover:-translate-y-1"
                >
                    <div class="h-56 overflow-hidden">
                        <img
                            src="{{ asset('storage/' . $product->pictures) }}"
                            class="w-full h-full object-cover object-top"
                        />
                    </div>
                    <div class="p-6">
                        <h2
                            class="text-2xl font-semibold mb-2 product-title cursor-pointer hover:text-primary"
                            data-product="product{{ $product->id }}"
                        >
                            {{ $product->name }}
                        </h2>
                        <div class="flex flex-col justify-between">
                            <div class="flex flex-col">
                                <span class="text-sm text-gray-500 line-through"
                                    >Rp.
                                    {{ number_format($product->price_correct, 0, ',', '.') }}</span
                                >
                                <span class="text-lg font-bold text-primary"
                                    >Rp
                                    {{ number_format($product->price, 0, ',', '.') }}</span
                                >
                            </div>
                            <a
                                href="{{ route('checkout', ['id' => $product->id]) }}"
                                class="bg-primary hover:bg-blue-600 text-white px-5 py-2 !rounded-button whitespace-nowrap flex items-center justify-center mt-5"
                            >
                                <span>Beli Sekarang</span>
                                <div
                                    class="w-5 h-5 flex items-center justify-center ml-2"
                                >
                                    <i class="ri-arrow-right-line"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div id="product{{ $product->id }}Modal" class="modal">
                    <div class="modal-content max-h-[90vh] overflow-y-auto">
                        <span
                            class="close"
                            data-modal="product{{ $product->id}}Modal"
                            >&times;</span
                        >
                        <h2 class="text-2xl font-bold mb-4">
                            {{ $product->name }}
                        </h2>
                        <img
                            src="{{ asset('storage/' . $product->pictures) }}"
                            alt="Digital Marketing Ebook"
                            class="w-full object-cover object-top mb-4 rounded"
                        />
                        <div class="mb-4">
                            {!! $product->descriptions !!}
                        </div>
                        <div class="flex items-center mb-6">
                            <span class="text-gray-400 line-through mr-2"
                                >Rp {{ $product->price_correct }}</span
                            >
                            <span class="text-primary font-bold text-2xl"
                                >Rp {{ $product->price }}</span
                            >
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </main>
        <footer class="bg-gray-800 text-white pt-16 pb-8">
            <div class="max-w-7xl mx-auto px-6">
                <div class="max-w-lg mx-auto text-center">
                    <a
                        href="#"
                        class="text-white text-3xl font-['Pacifico'] mb-4 inline-block"
                        >{{ $data["brand"] }}</a
                    >
                    <p class="text-gray-400 mb-8">
                        {{ $data["description"] }}
                    </p>
                    {{--
                    <div class="flex justify-center space-x-6">
                        <a href="#" class="text-gray-400 hover:text-white">
                            <div
                                class="w-10 h-10 flex items-center justify-center"
                            >
                                <i class="ri-facebook-fill ri-lg"></i>
                            </div>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <div
                                class="w-10 h-10 flex items-center justify-center"
                            >
                                <i class="ri-instagram-fill ri-lg"></i>
                            </div>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <div
                                class="w-10 h-10 flex items-center justify-center"
                            >
                                <i class="ri-twitter-x-fill ri-lg"></i>
                            </div>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <div
                                class="w-10 h-10 flex items-center justify-center"
                            >
                                <i class="ri-linkedin-fill ri-lg"></i>
                            </div>
                        </a>
                    </div>
                    --}}
                    <div class="mt-8 pt-8 border-t border-gray-700">
                        <p class="text-gray-400">
                            Whatsapp : {{ $data['whatsapp'] }}
                        </p>
                    </div>
                </div>
            </div>
        </footer>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                // Modal functionality
                const productTitles = document.querySelectorAll(".product-title");
                const closeButtons = document.querySelectorAll(".close");
                productTitles.forEach((title) => {
                title.addEventListener("click", function () {
                    const productId = this.getAttribute("data-product");
                    const modal = document.getElementById(productId + "Modal");
                    modal.style.display = "block";
                });
                });
                closeButtons.forEach((button) => {
                button.addEventListener("click", function () {
                    const modalId = this.getAttribute("data-modal");
                    const modal = document.getElementById(modalId);
                    modal.style.display = "none";
                });
                });
                window.addEventListener("click", function (event) {
                if (event.target.classList.contains("modal")) {
                    event.target.style.display = "none";
                }
                });
            });
        </script>
    </body>
</html>
