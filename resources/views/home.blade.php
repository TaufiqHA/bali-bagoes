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
                <!-- Produk 1 -->
                <div
                    class="bg-white rounded shadow-lg overflow-hidden transition-transform hover:shadow-xl hover:-translate-y-1"
                >
                    <div class="h-56 overflow-hidden">
                        <img
                            src="https://readdy.ai/api/search-image?query=professional%20e-book%20cover%20about%20digital%20marketing%20strategies%20with%20modern%20design%2C%20minimalist%20style%2C%20blue%20color%20scheme%2C%20abstract%20geometric%20elements%2C%20high%20quality%20professional%20design&width=800&height=450&seq=1&orientation=landscape"
                            alt="Digital Marketing Mastery"
                            class="w-full h-full object-cover object-top"
                        />
                    </div>
                    <div class="p-6">
                        <h2 class="text-2xl font-semibold mb-2">
                            Digital Marketing Mastery
                        </h2>
                        <p class="text-gray-600 mb-4">
                            Panduan lengkap untuk menguasai strategi pemasaran
                            digital terbaru. Cocok untuk pemula hingga
                            profesional yang ingin meningkatkan keahlian mereka.
                        </p>
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-bold text-primary"
                                >Rp 299.000</span
                            >
                            <a
                                href="{{ route('checkout') }}"
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
                <!-- Produk 2 -->
                <div
                    class="bg-white rounded shadow-lg overflow-hidden transition-transform hover:shadow-xl hover:-translate-y-1"
                >
                    <div class="h-56 overflow-hidden">
                        <img
                            src="https://readdy.ai/api/search-image?query=professional%20software%20UI%20dashboard%20for%20data%20analytics%20with%20charts%2C%20graphs%2C%20clean%20interface%2C%20modern%20design%2C%20blue%20color%20scheme%2C%20high%20quality%20professional%20design&width=800&height=450&seq=2&orientation=landscape"
                            alt="Data Analytics Pro"
                            class="w-full h-full object-cover object-top"
                        />
                    </div>
                    <div class="p-6">
                        <h2 class="text-2xl font-semibold mb-2">
                            Data Analytics Pro
                        </h2>
                        <p class="text-gray-600 mb-4">
                            Software analisis data lengkap dengan dashboard
                            interaktif dan laporan otomatis. Ideal untuk bisnis
                            yang ingin mengoptimalkan keputusan berbasis data.
                        </p>
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-bold text-primary"
                                >Rp 599.000</span
                            >
                            <a
                                href="checkout.html?product=Data%20Analytics%20Pro&price=599000"
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
                <!-- Produk 3 -->
                <div
                    class="bg-white rounded shadow-lg overflow-hidden transition-transform hover:shadow-xl hover:-translate-y-1"
                >
                    <div class="h-56 overflow-hidden">
                        <img
                            src="https://readdy.ai/api/search-image?query=professional%20e-book%20cover%20about%20web%20development%20and%20programming%20with%20modern%20design%2C%20code%20snippets%2C%20minimalist%20style%2C%20blue%20color%20scheme%2C%20high%20quality%20professional%20design&width=800&height=450&seq=3&orientation=landscape"
                            alt="Web Development Masterclass"
                            class="w-full h-full object-cover object-top"
                        />
                    </div>
                    <div class="p-6">
                        <h2 class="text-2xl font-semibold mb-2">
                            Web Development Masterclass
                        </h2>
                        <p class="text-gray-600 mb-4">
                            Panduan komprehensif untuk menjadi developer web
                            profesional. Mencakup HTML, CSS, JavaScript, React,
                            dan Node.js dengan contoh proyek nyata.
                        </p>
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-bold text-primary"
                                >Rp 449.000</span
                            >
                            <a
                                href="checkout.html?product=Web%20Development%20Masterclass&price=449000"
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
                <!-- Produk 4 -->
                <div
                    class="bg-white rounded shadow-lg overflow-hidden transition-transform hover:shadow-xl hover:-translate-y-1"
                >
                    <div class="h-56 overflow-hidden">
                        <img
                            src="https://readdy.ai/api/search-image?query=professional%20software%20UI%20for%20content%20management%20system%20with%20modern%20design%2C%20clean%20interface%2C%20document%20organization%2C%20blue%20color%20scheme%2C%20high%20quality%20professional%20design&width=800&height=450&seq=4&orientation=landscape"
                            alt="Content Management Suite"
                            class="w-full h-full object-cover object-top"
                        />
                    </div>
                    <div class="p-6">
                        <h2 class="text-2xl font-semibold mb-2">
                            Content Management Suite
                        </h2>
                        <p class="text-gray-600 mb-4">
                            Software all-in-one untuk mengelola konten digital
                            dengan fitur SEO, penjadwalan, dan analitik.
                            Sempurna untuk content creator dan tim marketing.
                        </p>
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-bold text-primary"
                                >Rp 499.000</span
                            >
                            <a
                                href="{{ route('checkout') }}"
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
                <!-- Produk 5 -->
                <div
                    class="bg-white rounded shadow-lg overflow-hidden transition-transform hover:shadow-xl hover:-translate-y-1"
                >
                    <div class="h-56 overflow-hidden">
                        <img
                            src="https://readdy.ai/api/search-image?query=professional%20e-book%20cover%20about%20social%20media%20marketing%20strategies%20with%20modern%20design%2C%20social%20media%20icons%2C%20engaging%20visuals%2C%20blue%20color%20scheme%2C%20high%20quality%20professional%20design&width=800&height=450&seq=5&orientation=landscape"
                            alt="Social Media Marketing Pro"
                            class="w-full h-full object-cover object-top"
                        />
                    </div>
                    <div class="p-6">
                        <h2 class="text-2xl font-semibold mb-2">
                            Social Media Marketing Pro
                        </h2>
                        <p class="text-gray-600 mb-4">
                            Panduan lengkap untuk membangun presence yang kuat
                            di social media. Termasuk strategi content dan
                            engagement untuk berbagai platform.
                        </p>
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-bold text-primary"
                                >Rp 349.000</span
                            >
                            <a
                                href="checkout.html?product=Social%20Media%20Marketing%20Pro&price=349000"
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
                <!-- Produk 6 -->
                <div
                    class="bg-white rounded shadow-lg overflow-hidden transition-transform hover:shadow-xl hover:-translate-y-1"
                >
                    <div class="h-56 overflow-hidden">
                        <img
                            src="https://readdy.ai/api/search-image?query=professional%20software%20UI%20for%20project%20management%20tool%20with%20modern%20design%2C%20task%20boards%2C%20timeline%20views%2C%20blue%20color%20scheme%2C%20high%20quality%20professional%20design&width=800&height=450&seq=6&orientation=landscape"
                            alt="Project Management Tool"
                            class="w-full h-full object-cover object-top"
                        />
                    </div>
                    <div class="p-6">
                        <h2 class="text-2xl font-semibold mb-2">
                            Project Management Tool
                        </h2>
                        <p class="text-gray-600 mb-4">
                            Software manajemen proyek yang powerful dengan fitur
                            kolaborasi tim, tracking progress, dan reporting.
                            Ideal untuk tim remote dan hybrid.
                        </p>
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-bold text-primary"
                                >Rp 799.000</span
                            >
                            <a
                                href="checkout.html?product=Project%20Management%20Tool&price=799000"
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
                <!-- Produk 7 -->
                <div
                    class="bg-white rounded shadow-lg overflow-hidden transition-transform hover:shadow-xl hover:-translate-y-1"
                >
                    <div class="h-56 overflow-hidden">
                        <img
                            src="https://readdy.ai/api/search-image?query=professional%20e-book%20cover%20about%20UI%2FUX%20design%20principles%20with%20modern%20design%2C%20wireframes%2C%20user%20interface%20elements%2C%20blue%20color%20scheme%2C%20high%20quality%20professional%20design&width=800&height=450&seq=7&orientation=landscape"
                            alt="UI/UX Design Essentials"
                            class="w-full h-full object-cover object-top"
                        />
                    </div>
                    <div class="p-6">
                        <h2 class="text-2xl font-semibold mb-2">
                            UI/UX Design Essentials
                        </h2>
                        <p class="text-gray-600 mb-4">
                            Panduan komprehensif tentang desain UI/UX modern.
                            Mencakup prinsip desain, user research, dan
                            prototyping dengan tools terkini.
                        </p>
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-bold text-primary"
                                >Rp 399.000</span
                            >
                            <a
                                href="checkout.html?product=UI/UX%20Design%20Essentials&price=399000"
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
                <!-- Produk 8 -->
                <div
                    class="bg-white rounded shadow-lg overflow-hidden transition-transform hover:shadow-xl hover:-translate-y-1"
                >
                    <div class="h-56 overflow-hidden">
                        <img
                            src="https://readdy.ai/api/search-image?query=professional%20software%20UI%20for%20email%20marketing%20automation%20with%20modern%20design%2C%20email%20templates%2C%20campaign%20analytics%2C%20blue%20color%20scheme%2C%20high%20quality%20professional%20design&width=800&height=450&seq=8&orientation=landscape"
                            alt="Email Marketing Suite"
                            class="w-full h-full object-cover object-top"
                        />
                    </div>
                    <div class="p-6">
                        <h2 class="text-2xl font-semibold mb-2">
                            Email Marketing Suite
                        </h2>
                        <p class="text-gray-600 mb-4">
                            Platform email marketing dengan fitur automasi,
                            segmentasi, dan analitik. Termasuk template premium
                            dan integration dengan CRM populer.
                        </p>
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-bold text-primary"
                                >Rp 649.000</span
                            >
                            <a
                                href="checkout.html?product=Email%20Marketing%20Suite&price=649000"
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
                <!-- Produk 9 -->
                <div
                    class="bg-white rounded shadow-lg overflow-hidden transition-transform hover:shadow-xl hover:-translate-y-1"
                >
                    <div class="h-56 overflow-hidden">
                        <img
                            src="https://readdy.ai/api/search-image?query=professional%20e-book%20cover%20about%20business%20analytics%20and%20data%20visualization%20with%20modern%20design%2C%20charts%2C%20dashboards%2C%20blue%20color%20scheme%2C%20high%20quality%20professional%20design&width=800&height=450&seq=9&orientation=landscape"
                            alt="Business Analytics Mastery"
                            class="w-full h-full object-cover object-top"
                        />
                    </div>
                    <div class="p-6">
                        <h2 class="text-2xl font-semibold mb-2">
                            Business Analytics Mastery
                        </h2>
                        <p class="text-gray-600 mb-4">
                            Panduan lengkap untuk menganalisis data bisnis dan
                            membuat keputusan berbasis data. Termasuk template
                            Excel dan Google Data Studio.
                        </p>
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-bold text-primary"
                                >Rp 549.000</span
                            >
                            <a
                                href="checkout.html?product=Business%20Analytics%20Mastery&price=549000"
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
            </div>
        </main>
    </body>
</html>
