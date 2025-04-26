<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Login - BaliBagoes</title>
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
    <body class="bg-gray-50 min-h-screen flex items-center justify-center">
        <div class="w-full max-w-md mx-auto p-6">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <div class="text-center mb-8">
                    <a
                        href="/"
                        class="text-3xl font-['Pacifico'] text-primary inline-block"
                        >BaliBagoes</a
                    >
                    <h1 class="text-2xl font-semibold mt-4">
                        Masuk ke Akun Anda
                    </h1>
                </div>
                <form id="loginForm" class="space-y-6">
                    <div>
                        <label
                            for="email"
                            class="block text-sm font-medium text-gray-700 mb-2"
                            >Email</label
                        >
                        <div class="relative">
                            <div
                                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                            >
                                <div
                                    class="w-5 h-5 flex items-center justify-center text-gray-400"
                                >
                                    <i class="ri-mail-line"></i>
                                </div>
                            </div>
                            <input
                                type="email"
                                id="email"
                                required
                                class="w-full pl-10 pr-4 py-3 rounded border border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-30 outline-none transition-colors"
                                placeholder="Masukkan alamat email"
                            />
                        </div>
                        <p
                            id="emailError"
                            class="mt-1 text-sm text-red-600 hidden"
                        >
                            Email tidak valid
                        </p>
                    </div>
                    <div>
                        <label
                            for="password"
                            class="block text-sm font-medium text-gray-700 mb-2"
                            >Kata Sandi</label
                        >
                        <div class="relative">
                            <div
                                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                            >
                                <div
                                    class="w-5 h-5 flex items-center justify-center text-gray-400"
                                >
                                    <i class="ri-lock-line"></i>
                                </div>
                            </div>
                            <input
                                type="password"
                                id="password"
                                required
                                class="w-full pl-10 pr-10 py-3 rounded border border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-30 outline-none transition-colors"
                                placeholder="Masukkan kata sandi"
                            />
                            <div
                                class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer"
                                id="togglePassword"
                            >
                                <div
                                    class="w-5 h-5 flex items-center justify-center text-gray-400"
                                >
                                    <i
                                        class="ri-eye-off-line"
                                        id="passwordIcon"
                                    ></i>
                                </div>
                            </div>
                        </div>
                        <p
                            id="passwordError"
                            class="mt-1 text-sm text-red-600 hidden"
                        >
                            Kata sandi minimal 6 karakter
                        </p>
                    </div>
                    <button
                        type="submit"
                        class="w-full bg-primary hover:bg-blue-600 text-white py-3 !rounded-button font-medium transition-colors flex items-center justify-center"
                    >
                        <span>Masuk</span>
                        <div
                            class="w-5 h-5 flex items-center justify-center ml-2"
                        >
                            <i class="ri-arrow-right-line"></i>
                        </div>
                    </button>
                </form>
            </div>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const loginForm = document.getElementById("loginForm");
                const emailInput = document.getElementById("email");
                const passwordInput = document.getElementById("password");
                const emailError = document.getElementById("emailError");
                const passwordError = document.getElementById("passwordError");
                const togglePassword =
                    document.getElementById("togglePassword");
                const passwordIcon = document.getElementById("passwordIcon");
                // Toggle password visibility
                togglePassword.addEventListener("click", function () {
                    const type =
                        passwordInput.getAttribute("type") === "password"
                            ? "text"
                            : "password";
                    passwordInput.setAttribute("type", type);
                    if (type === "text") {
                        passwordIcon.classList.remove("ri-eye-off-line");
                        passwordIcon.classList.add("ri-eye-line");
                    } else {
                        passwordIcon.classList.remove("ri-eye-line");
                        passwordIcon.classList.add("ri-eye-off-line");
                    }
                });

                // Form validation
                loginForm.addEventListener("submit", function (e) {
                    e.preventDefault();
                    let isValid = true;
                    // Email validation
                    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailPattern.test(emailInput.value)) {
                        emailError.classList.remove("hidden");
                        emailInput.classList.add("border-red-500");
                        isValid = false;
                    } else {
                        emailError.classList.add("hidden");
                        emailInput.classList.remove("border-red-500");
                    }
                    // Password validation
                    if (passwordInput.value.length < 6) {
                        passwordError.classList.remove("hidden");
                        passwordInput.classList.add("border-red-500");
                        isValid = false;
                    } else {
                        passwordError.classList.add("hidden");
                        passwordInput.classList.remove("border-red-500");
                    }
                    // If valid, redirect to home page
                    if (isValid) {
                        window.location.href = "/";
                    }
                });
            });
        </script>
    </body>
</html>
