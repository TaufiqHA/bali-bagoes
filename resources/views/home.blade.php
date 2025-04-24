<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Digital Marketplace</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: { primary: "#3176FF", secondary: "" },
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
      href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <style>
      :where([class^="ri-"])::before {
        content: "\f3c2";
      }
      body {
        background-color: #f8fafc;
      }
      .modal {
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease;
      }
      .modal.active {
        opacity: 1;
        visibility: visible;
      }
      input:focus,
      button:focus {
        outline: none;
      }
    </style>
  </head>
  <body class="text-gray-800 min-h-screen">
    <!-- Navbar -->
    <nav class="fixed top-0 left-0 right-0 bg-white shadow-sm z-50">
      <div
        class="container mx-auto px-4 py-4 flex items-center justify-between"
      >
        <a href="#" class="font-['Pacifico'] text-2xl text-primary"
          >BaliBagoes</a
        >
        <button
          id="login-button"
          class="hidden bg-primary text-white px-6 py-2 !rounded-button font-medium hover:bg-primary/90 transition-colors whitespace-nowrap"
        >
          Login
        </button>
      </div>
    </nav>
    <!-- Hero Section -->
    <section
      class="pt-24 pb-16 bg-gradient-to-br from-primary to-primary/70 text-white"
    >
      <div class="container mx-auto px-4 pt-10">
        <div class="max-w-3xl mx-auto text-center">
          <h1 class="text-4xl md:text-5xl font-bold mb-4">
            Temukan Produk Digital Terbaik untuk Kebutuhan Anda
          </h1>
          <p class="text-lg md:text-xl text-white/80 mb-8">
            Koleksi lengkap eBook, software, dan sumber daya digital premium
            untuk meningkatkan produktivitas dan pengetahuan Anda
          </p>
        </div>
      </div>
    </section>
    <!-- Products Section -->
    <section class="py-16">
      <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold mb-2 text-center">Produk Unggulan</h2>
        <p class="text-gray-600 mb-12 text-center max-w-2xl mx-auto">
          Pilihan produk digital berkualitas tinggi yang telah diseleksi khusus
          untuk memenuhi kebutuhan Anda
        </p>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          <!-- Product 1 -->
          <div
            class="bg-white rounded shadow-md overflow-hidden hover:shadow-lg transition-shadow"
            data-product-id="1"
            data-product-name="Panduan Lengkap Digital Marketing"
            data-product-price="250.000"
            data-product-description="eBook komprehensif tentang strategi digital marketing terbaru"
          >
            <div class="h-48 overflow-hidden">
              <img
                src="https://readdy.ai/api/search-image?query=professional%20ebook%20cover%20about%20digital%20marketing%2C%20minimalist%20design%2C%20blue%20and%20white%20color%20scheme%2C%20clean%20layout%2C%20professional%20looking%2C%20business%20concept&width=600&height=400&seq=1&orientation=landscape"
                alt="Panduan Digital Marketing"
                class="w-full h-full object-cover object-top"
              />
            </div>
            <div class="p-6">
              <h3 class="text-xl font-semibold mb-2">
                Panduan Lengkap Digital Marketing
              </h3>
              <p class="text-gray-600 mb-4">
                eBook komprehensif yang mencakup strategi digital marketing
                terbaru untuk bisnis Anda. Termasuk SEO, media sosial, dan email
                marketing.
              </p>
              <div class="flex justify-between items-center">
                <span class="text-primary font-bold">Rp 250.000</span>
                <button
                  class="checkout-btn bg-primary text-white px-4 py-2 !rounded-button font-medium hover:bg-primary/90 transition-colors whitespace-nowrap"
                >
                  Checkout
                </button>
              </div>
            </div>
          </div>
          <!-- Product 2 -->
          <div
            class="bg-white rounded shadow-md overflow-hidden hover:shadow-lg transition-shadow"
            data-product-id="2"
            data-product-name="Software Analisis Data Premium"
            data-product-price="750.000"
            data-product-description="Software analisis data dengan fitur visualisasi dan machine learning"
          >
            <div class="h-48 overflow-hidden">
              <img
                src="https://readdy.ai/api/search-image?query=data%20analysis%20software%20dashboard%20interface%2C%20clean%20modern%20UI%20design%2C%20data%20visualization%20charts%20and%20graphs%2C%20professional%20looking%2C%20blue%20color%20scheme&width=600&height=400&seq=2&orientation=landscape"
                alt="Software Analisis Data"
                class="w-full h-full object-cover object-top"
              />
            </div>
            <div class="p-6">
              <h3 class="text-xl font-semibold mb-2">
                Software Analisis Data Premium
              </h3>
              <p class="text-gray-600 mb-4">
                Software analisis data canggih dengan fitur visualisasi
                interaktif dan kemampuan machine learning untuk mengolah data
                bisnis Anda.
              </p>
              <div class="flex justify-between items-center">
                <span class="text-primary font-bold">Rp 750.000</span>
                <button
                  class="checkout-btn bg-primary text-white px-4 py-2 !rounded-button font-medium hover:bg-primary/90 transition-colors whitespace-nowrap"
                >
                  Checkout
                </button>
              </div>
            </div>
          </div>
          <!-- Product 3 -->
          <div
            class="bg-white rounded shadow-md overflow-hidden hover:shadow-lg transition-shadow"
            data-product-id="3"
            data-product-name="Kursus Fotografi Digital"
            data-product-price="350.000"
            data-product-description="Kursus video lengkap tentang fotografi digital untuk pemula hingga mahir"
          >
            <div class="h-48 overflow-hidden">
              <img
                src="https://readdy.ai/api/search-image?query=digital%20photography%20course%2C%20professional%20camera%20equipment%2C%20photography%20tutorial%2C%20clean%20modern%20look%2C%20person%20taking%20photos%2C%20educational%20content&width=600&height=400&seq=3&orientation=landscape"
                alt="Kursus Fotografi"
                class="w-full h-full object-cover object-top"
              />
            </div>
            <div class="p-6">
              <h3 class="text-xl font-semibold mb-2">
                Kursus Fotografi Digital
              </h3>
              <p class="text-gray-600 mb-4">
                Kursus video komprehensif yang mengajarkan teknik fotografi
                digital dari dasar hingga tingkat profesional dengan latihan
                praktis.
              </p>
              <div class="flex justify-between items-center">
                <span class="text-primary font-bold">Rp 350.000</span>
                <button
                  class="checkout-btn bg-primary text-white px-4 py-2 !rounded-button font-medium hover:bg-primary/90 transition-colors whitespace-nowrap"
                >
                  Checkout
                </button>
              </div>
            </div>
          </div>
          <!-- Product 4 -->
          <div
            class="bg-white rounded shadow-md overflow-hidden hover:shadow-lg transition-shadow"
            data-product-id="4"
            data-product-name="Template Website Premium"
            data-product-price="420.000"
            data-product-description="Koleksi template website responsif untuk berbagai jenis bisnis"
          >
            <div class="h-48 overflow-hidden">
              <img
                src="https://readdy.ai/api/search-image?query=premium%20website%20templates%20collection%2C%20responsive%20web%20design%2C%20modern%20UI%20layouts%2C%20professional%20looking%2C%20multiple%20device%20screens%20showing%20website%20templates&width=600&height=400&seq=4&orientation=landscape"
                alt="Template Website"
                class="w-full h-full object-cover object-top"
              />
            </div>
            <div class="p-6">
              <h3 class="text-xl font-semibold mb-2">
                Template Website Premium
              </h3>
              <p class="text-gray-600 mb-4">
                Koleksi 50+ template website responsif dan modern untuk berbagai
                jenis bisnis, lengkap dengan dokumentasi dan dukungan.
              </p>
              <div class="flex justify-between items-center">
                <span class="text-primary font-bold">Rp 420.000</span>
                <button
                  class="checkout-btn bg-primary text-white px-4 py-2 !rounded-button font-medium hover:bg-primary/90 transition-colors whitespace-nowrap"
                >
                  Checkout
                </button>
              </div>
            </div>
          </div>
          <!-- Product 5 -->
          <div
            class="bg-white rounded shadow-md overflow-hidden hover:shadow-lg transition-shadow"
            data-product-id="5"
            data-product-name="eBook Pengembangan Aplikasi Mobile"
            data-product-price="280.000"
            data-product-description="Panduan lengkap untuk membangun aplikasi mobile dari konsep hingga publikasi"
          >
            <div class="h-48 overflow-hidden">
              <img
                src="https://readdy.ai/api/search-image?query=mobile%20app%20development%20ebook%20cover%2C%20smartphone%20with%20code%20interface%2C%20professional%20looking%2C%20clean%20modern%20design%2C%20programming%20concept&width=600&height=400&seq=5&orientation=landscape"
                alt="eBook Pengembangan Aplikasi"
                class="w-full h-full object-cover object-top"
              />
            </div>
            <div class="p-6">
              <h3 class="text-xl font-semibold mb-2">
                eBook Pengembangan Aplikasi Mobile
              </h3>
              <p class="text-gray-600 mb-4">
                Panduan praktis untuk membangun aplikasi mobile dari konsep
                hingga publikasi di app store, dengan contoh kode dan studi
                kasus.
              </p>
              <div class="flex justify-between items-center">
                <span class="text-primary font-bold">Rp 280.000</span>
                <button
                  class="checkout-btn bg-primary text-white px-4 py-2 !rounded-button font-medium hover:bg-primary/90 transition-colors whitespace-nowrap"
                >
                  Checkout
                </button>
              </div>
            </div>
          </div>
          <!-- Product 6 -->
          <div
            class="bg-white rounded shadow-md overflow-hidden hover:shadow-lg transition-shadow"
            data-product-id="6"
            data-product-name="Plugin Editing Video Premium"
            data-product-price="520.000"
            data-product-description="Kumpulan plugin untuk software editing video profesional"
          >
            <div class="h-48 overflow-hidden">
              <img
                src="https://readdy.ai/api/search-image?query=video%20editing%20plugins%2C%20professional%20video%20effects%2C%20timeline%20interface%2C%20color%20grading%20tools%2C%20modern%20software%20UI%2C%20video%20production&width=600&height=400&seq=6&orientation=landscape"
                alt="Plugin Editing Video"
                class="w-full h-full object-cover object-top"
              />
            </div>
            <div class="p-6">
              <h3 class="text-xl font-semibold mb-2">
                Plugin Editing Video Premium
              </h3>
              <p class="text-gray-600 mb-4">
                Kumpulan plugin profesional untuk software editing video dengan
                efek transisi, color grading, dan motion graphics.
              </p>
              <div class="flex justify-between items-center">
                <span class="text-primary font-bold">Rp 520.000</span>
                <button
                  class="checkout-btn bg-primary text-white px-4 py-2 !rounded-button font-medium hover:bg-primary/90 transition-colors whitespace-nowrap"
                >
                  Checkout
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Login Modal -->
    <div
      id="login-modal"
      class="modal fixed inset-0 z-50 flex items-center justify-center p-4"
    >
      <div class="absolute inset-0 bg-black/50"></div>
      <div class="bg-white rounded-lg shadow-xl w-full max-w-md relative z-10">
        <div class="p-6">
          <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-bold">Login</h3>
            <button
              id="close-login-modal"
              class="w-8 h-8 flex items-center justify-center text-gray-500 hover:text-gray-700"
            >
              <i class="ri-close-line ri-lg"></i>
            </button>
          </div>
          <form class="space-y-4">
            <div>
              <label class="block text-sm text-gray-600 mb-1"
                >Email / Username</label
              >
              <input
                type="text"
                class="w-full px-4 py-2 border border-gray-300 rounded focus:border-primary"
                placeholder="Masukkan email atau username"
              />
            </div>
            <div>
              <label class="block text-sm text-gray-600 mb-1">Password</label>
              <input
                type="password"
                class="w-full px-4 py-2 border border-gray-300 rounded focus:border-primary"
                placeholder="Masukkan password"
              />
            </div>
            <div class="flex justify-between items-center text-sm">
              <label class="flex items-center">
                <input type="checkbox" class="mr-2" />
                Ingat saya
              </label>
              <a href="#" class="text-primary hover:text-primary/80"
                >Lupa Password?</a
              >
            </div>
            <button
              type="submit"
              class="w-full bg-primary text-white py-3 !rounded-button font-medium hover:bg-primary/90 transition-colors"
            >
              Masuk
            </button>
          </form>
        </div>
      </div>
    </div>
    <!-- Checkout Modal -->
    <div
      id="checkout-modal"
      class="modal fixed inset-0 z-50 flex items-center justify-center p-4"
    >
      <div class="absolute inset-0 bg-black/50" id="modal-overlay"></div>
      <div
        class="bg-white rounded-lg shadow-xl w-full max-w-md relative z-10 overflow-hidden"
      >
        <div class="p-6">
          <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold">Checkout</h3>
            <button
              id="close-modal"
              class="w-8 h-8 flex items-center justify-center text-gray-500 hover:text-gray-700"
            >
              <i class="ri-close-line ri-lg"></i>
            </button>
          </div>
          <div class="flex gap-4 mb-6">
            <div class="w-20 h-20 rounded overflow-hidden flex-shrink-0">
              <img
                id="modal-product-image"
                src=""
                alt="Product"
                class="w-full h-full object-cover object-top"
              />
            </div>
            <div>
              <h4
                id="modal-product-name"
                class="text-lg font-semibold mb-1"
              ></h4>
              <p
                id="modal-product-description"
                class="text-sm text-gray-600 mb-2"
              ></p>
              <div
                id="modal-product-price"
                class="text-primary font-bold"
              ></div>
            </div>
          </div>
          <div class="border-t border-gray-200 pt-4">
            <h4 class="font-medium mb-3">Informasi Pembayaran</h4>
            <div class="space-y-4 mb-6">
              <div>
                <label class="block text-sm text-gray-600 mb-1"
                  >Nama Lengkap</label
                >
                <input
                  type="text"
                  id="onlyLettersInput"
                  class="w-full px-4 py-2 border border-gray-300 rounded focus:border-primary"
                  placeholder="Masukkan nama lengkap"
                />
                <script>
                  document
                    .getElementById("onlyLettersInput")
                    .addEventListener("input", function (e) {
                      this.value = this.value.replace(/[^a-zA-Z]/g, ""); // hanya huruf
                    });
                </script>
              </div>
              <div>
                <label class="block text-sm text-gray-600 mb-1">Email</label>
                <input
                  type="email"
                  class="w-full px-4 py-2 border border-gray-300 rounded focus:border-primary"
                  placeholder="email@example.com"
                />
              </div>
              <div>
                <label class="block text-sm text-gray-600 mb-1"
                  >Metode Pembayaran</label
                >
                <div class="flex gap-3 mb-2">
                  <div class="flex items-center">
                    <input
                      type="radio"
                      id="payment-transfer"
                      name="payment"
                      class="hidden"
                      checked
                    />
                    <label
                      for="payment-transfer"
                      class="flex items-center cursor-pointer"
                    >
                      <span
                        class="w-5 h-5 inline-block mr-2 rounded-full border border-gray-300 flex-shrink-0 relative"
                      >
                        <span
                          class="absolute inset-0 m-1 rounded-full bg-primary transform scale-0 transition-transform duration-200 payment-radio-dot"
                        ></span>
                      </span>
                      Transfer Bank
                    </label>
                  </div>
                  <div class="flex items-center">
                    <input
                      type="radio"
                      id="payment-ewallet"
                      name="payment"
                      class="hidden"
                    />
                    <label
                      for="payment-ewallet"
                      class="flex items-center cursor-pointer"
                    >
                      <span
                        class="w-5 h-5 inline-block mr-2 rounded-full border border-gray-300 flex-shrink-0 relative"
                      >
                        <span
                          class="absolute inset-0 m-1 rounded-full bg-primary transform scale-0 transition-transform duration-200 payment-radio-dot"
                        ></span>
                      </span>
                      E-Wallet
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <button
              class="w-full bg-primary text-white py-3 !rounded-button font-medium hover:bg-primary/90 transition-colors whitespace-nowrap"
            >
              Konfirmasi Pembayaran
            </button>
          </div>
        </div>
      </div>
    </div>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const modal = document.getElementById("checkout-modal");
        const loginModal = document.getElementById("login-modal");
        const modalOverlay = document.getElementById("modal-overlay");
        const closeModalBtn = document.getElementById("close-modal");
        const loginButton = document.getElementById("login-button");
        const closeLoginModalBtn = document.getElementById("close-login-modal");
        // Login Modal
        loginButton.addEventListener("click", () => {
          loginModal.classList.add("active");
          document.body.style.overflow = "hidden";
        });
        closeLoginModalBtn.addEventListener("click", () => {
          loginModal.classList.remove("active");
          document.body.style.overflow = "";
        });
        // Close login modal when clicking outside
        loginModal.addEventListener("click", (e) => {
          if (e.target === loginModal) {
            loginModal.classList.remove("active");
            document.body.style.overflow = "";
          }
        });
        // Prevent closing when clicking inside login modal content
        loginModal
          .querySelector(".modal > div:last-child")
          .addEventListener("click", (e) => {
            e.stopPropagation();
          });
        const checkoutBtns = document.querySelectorAll(".checkout-btn");
        const modalProductName = document.getElementById("modal-product-name");
        const modalProductDescription = document.getElementById(
          "modal-product-description"
        );
        const modalProductPrice = document.getElementById(
          "modal-product-price"
        );
        const modalProductImage = document.getElementById(
          "modal-product-image"
        );
        // Radio button custom styling
        const radioInputs = document.querySelectorAll('input[type="radio"]');
        radioInputs.forEach((input) => {
          input.addEventListener("change", function () {
            document.querySelectorAll(".payment-radio-dot").forEach((dot) => {
              dot.style.transform = "scale(0)";
            });
            if (this.checked) {
              const dot =
                this.nextElementSibling.querySelector(".payment-radio-dot");
              dot.style.transform = "scale(1)";
            }
          });
          // Set initial state
          if (input.checked) {
            const dot =
              input.nextElementSibling.querySelector(".payment-radio-dot");
            dot.style.transform = "scale(1)";
          }
        });
        // Open modal with product details
        checkoutBtns.forEach((btn) => {
          btn.addEventListener("click", function () {
            const productCard = this.closest("[data-product-id]");
            const productId = productCard.dataset.productId;
            const productName = productCard.dataset.productName;
            const productPrice = productCard.dataset.productPrice;
            const productDescription = productCard.dataset.productDescription;
            const productImage = productCard.querySelector("img").src;
            modalProductName.textContent = productName;
            modalProductDescription.textContent = productDescription;
            modalProductPrice.textContent = `Rp ${productPrice}`;
            modalProductImage.src = productImage;
            modal.classList.add("active");
            document.body.style.overflow = "hidden";
          });
        });
        // Close modal
        const closeModal = () => {
          modal.classList.remove("active");
          document.body.style.overflow = "";
        };
        closeModalBtn.addEventListener("click", closeModal);
        modalOverlay.addEventListener("click", closeModal);
        // Prevent closing when clicking inside modal content
        modal
          .querySelector(".modal > div:last-child")
          .addEventListener("click", function (e) {
            e.stopPropagation();
          });
      });
    </script>
  </body>
</html>
