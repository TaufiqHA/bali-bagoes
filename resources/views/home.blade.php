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
        </style>
    </head>
    <body class="bg-gray-50">
        <nav class="w-full bg-white shadow-sm py-4 fixed top-0 z-50">
            <div class="container mx-auto px-4 md:px-8 max-w-6xl">
                <a href="/" class="text-2xl font-['Pacifico'] text-primary"
                    >BaliBagoes</a
                >
            </div>
        </nav>
        <header
            class="w-full bg-gradient-to-r from-primary to-blue-400 text-white py-20 mt-16"
        >
            <div class="container mx-auto px-4 md:px-8 max-w-6xl">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">
                    Tingkatkan Keterampilan Anda dengan Produk Digital Premium
                </h1>
                <p class="text-xl md:text-2xl max-w-2xl">
                    Koleksi ebook dan software terbaik untuk membantu Anda
                    berkembang dalam karir dan bisnis digital.
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
                        <h2 class="text-2xl font-semibold mb-2">
                            {{ $product->name }}
                        </h2>
                        <p class="text-gray-600 mb-4">
                            {{ $product->descriptions }}
                        </p>
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-bold text-primary"
                                >Rp {{ number_format($product->price, 0, ',', '.') }}</span
                            >
                            <a
                                href="{{ route('checkout', ['id' => $product->id]) }}"
                                class="bg-primary hover:bg-blue-600 text-white px-5 py-2 !rounded-button whitespace-nowrap flex items-center"
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
                @endforeach
            </div>
        </main>
    </body>
</html>
