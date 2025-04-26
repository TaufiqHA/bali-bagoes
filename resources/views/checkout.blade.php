<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Checkout - BaliBagoes</title>
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
        <main class="container mx-auto px-4 md:px-8 max-w-4xl py-16 mt-16">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <div class="flex items-center mb-8">
                    <div
                        class="w-8 h-8 flex items-center justify-center bg-primary text-white rounded-full mr-3"
                    >
                        1
                    </div>
                    <h2 class="text-2xl font-semibold">Detail Pesanan</h2>
                </div>
                <div class="bg-gray-50 rounded-lg p-6 mb-8">
                    <div class="flex items-start">
                        <div
                            class="product-image w-24 h-24 rounded overflow-hidden mr-4"
                        >
                            <img
                                id="productImage"
                                src=""
                                alt=""
                                class="w-full h-full object-cover object-top"
                            />
                        </div>
                        <div class="flex-1">
                            <h3
                                id="productName"
                                class="text-xl font-semibold mb-2"
                            ></h3>
                            <p
                                id="productDescription"
                                class="text-gray-600 text-sm mb-3"
                            >
                                Panduan lengkap untuk memulai bisnis kuliner
                                khas Bali. Termasuk 50+ resep autentik, tips
                                pengelolaan bisnis, dan strategi pemasaran
                                digital.
                            </p>
                            <p
                                id="productPrice"
                                class="text-primary text-xl font-bold"
                            ></p>
                        </div>
                    </div>
                </div>
                <div class="mb-12">
                    <div class="flex items-center mb-8">
                        <div
                            class="w-8 h-8 flex items-center justify-center bg-primary text-white rounded-full mr-3"
                        >
                            2
                        </div>
                        <h2 class="text-2xl font-semibold">
                            Informasi Pembeli
                        </h2>
                    </div>
                    <form id="checkoutForm" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-2"
                                    >Nama Lengkap</label
                                >
                                <input
                                    type="text"
                                    required
                                    class="w-full px-4 py-3 rounded border-gray-200 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                    placeholder="Masukkan nama lengkap"
                                />
                            </div>
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-2"
                                    >Email</label
                                >
                                <input
                                    type="email"
                                    required
                                    class="w-full px-4 py-3 rounded border-gray-200 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                    placeholder="Masukkan email"
                                />
                            </div>
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-2"
                                    >Nomor WhatsApp</label
                                >
                                <input
                                    type="tel"
                                    required
                                    class="w-full px-4 py-3 rounded border-gray-200 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                    placeholder="Contoh: 08123456789"
                                />
                            </div>
                        </div>
                    </form>
                </div>
                <div class="mb-12">
                    <div class="flex items-center mb-8">
                        <div
                            class="w-8 h-8 flex items-center justify-center bg-primary text-white rounded-full mr-3"
                        >
                            3
                        </div>
                        <h2 class="text-2xl font-semibold">
                            Metode Pembayaran
                        </h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <button
                            class="payment-method flex items-center justify-center p-4 border-2 border-gray-200 rounded-lg hover:border-primary focus:border-primary focus:outline-none transition-colors"
                        >
                            <div
                                class="w-6 h-6 flex items-center justify-center mr-2"
                            >
                                <i class="ri-bank-card-fill text-2xl"></i>
                            </div>
                            <span>Bank Transfer</span>
                        </button>
                        <button
                            class="payment-method flex items-center justify-center p-4 border-2 border-gray-200 rounded-lg hover:border-primary focus:border-primary focus:outline-none transition-colors"
                        >
                            <div
                                class="w-6 h-6 flex items-center justify-center mr-2"
                            >
                                <i class="ri-alipay-fill text-2xl"></i>
                            </div>
                            <span>QRIS</span>
                        </button>
                        <button
                            class="payment-method flex items-center justify-center p-4 border-2 border-gray-200 rounded-lg hover:border-primary focus:border-primary focus:outline-none transition-colors"
                        >
                            <div
                                class="w-6 h-6 flex items-center justify-center mr-2"
                            >
                                <i class="ri-wallet-3-fill text-2xl"></i>
                            </div>
                            <span>E-Wallet</span>
                        </button>
                    </div>
                </div>
                <div class="border-t pt-8">
                    <div class="flex justify-between items-center mb-6">
                        <span class="text-gray-600">Total Pembayaran</span>
                        <span
                            id="totalPrice"
                            class="text-2xl font-bold text-primary"
                        ></span>
                    </div>
                    <button
                        id="payButton"
                        class="w-full bg-primary hover:bg-blue-600 text-white py-4 !rounded-button text-lg font-semibold flex items-center justify-center whitespace-nowrap"
                    >
                        <span>Bayar Sekarang</span>
                        <div
                            class="w-5 h-5 flex items-center justify-center ml-2"
                        >
                            <i class="ri-arrow-right-line"></i>
                        </div>
                    </button>
                </div>
            </div>
        </main>
        <div
            id="successModal"
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50"
        >
            <div class="bg-white rounded-lg p-8 max-w-md w-full mx-4">
                <div
                    class="w-16 h-16 mx-auto mb-4 rounded-full bg-green-100 flex items-center justify-center"
                >
                    <i class="ri-check-line text-3xl text-green-500"></i>
                </div>
                <h3 class="text-2xl font-semibold text-center mb-2">
                    Pembayaran Berhasil!
                </h3>
                <p class="text-gray-600 text-center mb-6">
                    Terima kasih atas pembelian Anda. Produk digital akan
                    dikirim ke email Anda dalam waktu 24 jam.
                </p>
                <button
                    onclick="window.location.href='/'"
                    class="w-full bg-primary hover:bg-blue-600 text-white py-3 !rounded-button whitespace-nowrap"
                >
                    Kembali ke Beranda
                </button>
            </div>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const urlParams = new URLSearchParams(window.location.search);
                const productName = urlParams.get("product");
                const productPrice = parseInt(urlParams.get("price"));
                if (productName && productPrice) {
                    document.getElementById("productName").textContent =
                        productName;
                    document.getElementById("productPrice").textContent =
                        new Intl.NumberFormat("id-ID", {
                            style: "currency",
                            currency: "IDR",
                        }).format(productPrice);
                    document.getElementById("totalPrice").textContent =
                        new Intl.NumberFormat("id-ID", {
                            style: "currency",
                            currency: "IDR",
                        }).format(productPrice);
                    const productImage =
                        document.getElementById("productImage");
                    productImage.src = `https://readdy.ai/api/search-image?query=professional%2520product%2520thumbnail%2520for%2520digital%2520product%252C%2520modern%2520design%252C%2520minimalist%2520style%252C%2520blue%2520color%2520scheme&width=400&height=400&seq=${Math.floor(
                        Math.random() * 1000
                    )}&orientation=squarish`;
                    productImage.alt = productName;
                }
                const paymentMethods =
                    document.querySelectorAll(".payment-method");
                paymentMethods.forEach((method) => {
                    method.addEventListener("click", () => {
                        paymentMethods.forEach((m) =>
                            m.classList.remove("border-primary")
                        );
                        method.classList.add("border-primary");
                    });
                });
                document
                    .getElementById("payButton")
                    .addEventListener("click", function (e) {
                        e.preventDefault();
                        const form = document.getElementById("checkoutForm");
                        if (form.checkValidity()) {
                            document
                                .getElementById("successModal")
                                .classList.remove("hidden");
                        } else {
                            form.reportValidity();
                        }
                    });
            });
        </script>
    </body>
</html>
