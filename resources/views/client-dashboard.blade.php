<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Produk Digital Saya</title>
<script src="https://cdn.tailwindcss.com/3.4.16"></script>
<script>tailwind.config={theme:{extend:{colors:{primary:'#3176FF',secondary:''},borderRadius:{'none':'0px','sm':'4px',DEFAULT:'8px','md':'12px','lg':'16px','xl':'20px','2xl':'24px','3xl':'32px','full':'9999px','button':'8px'}}}}</script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
<style>
:where([class^="ri-"])::before { content: "\f3c2"; }
body {
    font-family: 'Poppins', sans-serif;
    background-color: #f9fafb;
}
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
input[type=number] {
    -moz-appearance: textfield;
}
.card-hover {
    transition: all 0.3s ease;
}
.card-hover:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}
.download-btn {
    transition: all 0.2s ease;
}
.download-btn:active {
    transform: scale(0.95);
}
.search-container:focus-within {
    border-color: #3176FF;
    box-shadow: 0 0 0 3px rgba(49, 118, 255, 0.1);
}
</style>
</head>
<body>
<nav class="w-full bg-white shadow-sm py-4 fixed top-0 z-50">
    <div class="container mx-auto px-4 md:px-8 max-w-6xl">
        <div class="flex justify-between items-center">
            <a href="/" class="text-2xl font-['Pacifico'] text-primary">BaliBagoes</a>
        </div>
    </div>
</nav>
<main class="container mx-auto px-4 md:px-8 max-w-6xl pt-24 pb-16">
    <header class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Produk Digital Saya</h1>
        <p class="text-gray-600">Anda memiliki 7 produk digital yang siap diunduh</p>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Produk 1 -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden card-hover">
            <div class="h-48 overflow-hidden relative">
                <img src="https://readdy.ai/api/search-image?query=professional%2520e-book%2520cover%2520about%2520digital%2520marketing%2520strategies%2520with%2520modern%2520design%252C%2520minimalist%2520style%252C%2520blue%2520color%2520scheme%252C%2520abstract%2520geometric%2520elements%252C%2520high%2520quality%2520professional%2520design&width=800&height=450&seq=1&orientation=landscape" alt="Digital Marketing Mastery" class="w-full h-full object-cover object-top">
                <div class="absolute top-3 right-3 bg-green-500 text-white text-xs px-2 py-1 rounded-full">
                    Baru
                </div>
            </div>
            <div class="p-5">
                <h2 class="text-lg font-semibold text-gray-800 mb-1">Digital Marketing Mastery</h2>
                <div class="flex items-center text-gray-500 text-sm mb-4">
                    <div class="w-4 h-4 flex items-center justify-center mr-1">
                        <i class="ri-calendar-line"></i>
                    </div>
                    <span>Dibeli pada 26 April 2025</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">PDF • 15.2 MB</span>
                    <button class="bg-primary hover:bg-blue-600 text-white px-4 py-2 !rounded-button whitespace-nowrap flex items-center download-btn">
                        <div class="w-5 h-5 flex items-center justify-center mr-2">
                            <i class="ri-download-line"></i>
                        </div>
                        <span>Unduh</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Produk 2 -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden card-hover">
            <div class="h-48 overflow-hidden">
                <img src="https://readdy.ai/api/search-image?query=professional%2520software%2520UI%2520dashboard%2520for%2520data%2520analytics%2520with%2520charts%252C%2520graphs%252C%2520clean%2520interface%252C%2520modern%2520design%252C%2520blue%2520color%2520scheme%252C%2520high%2520quality%2520professional%2520design&width=800&height=450&seq=2&orientation=landscape" alt="Data Analytics Pro" class="w-full h-full object-cover object-top">
            </div>
            <div class="p-5">
                <h2 class="text-lg font-semibold text-gray-800 mb-1">Data Analytics Pro</h2>
                <div class="flex items-center text-gray-500 text-sm mb-4">
                    <div class="w-4 h-4 flex items-center justify-center mr-1">
                        <i class="ri-calendar-line"></i>
                    </div>
                    <span>Dibeli pada 24 April 2025</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">ZIP • 245 MB</span>
                    <button class="bg-primary hover:bg-blue-600 text-white px-4 py-2 !rounded-button whitespace-nowrap flex items-center download-btn">
                        <div class="w-5 h-5 flex items-center justify-center mr-2">
                            <i class="ri-download-line"></i>
                        </div>
                        <span>Unduh</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Produk 3 -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden card-hover">
            <div class="h-48 overflow-hidden">
                <img src="https://readdy.ai/api/search-image?query=professional%2520e-book%2520cover%2520about%2520web%2520development%2520and%2520programming%2520with%2520modern%2520design%252C%2520code%2520snippets%252C%2520minimalist%2520style%252C%2520blue%2520color%2520scheme%252C%2520high%2520quality%2520professional%2520design&width=800&height=450&seq=3&orientation=landscape" alt="Web Development Masterclass" class="w-full h-full object-cover object-top">
            </div>
            <div class="p-5">
                <h2 class="text-lg font-semibold text-gray-800 mb-1">Web Development Masterclass</h2>
                <div class="flex items-center text-gray-500 text-sm mb-4">
                    <div class="w-4 h-4 flex items-center justify-center mr-1">
                        <i class="ri-calendar-line"></i>
                    </div>
                    <span>Dibeli pada 20 April 2025</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center text-green-600 text-sm">
                        <div class="w-4 h-4 flex items-center justify-center mr-1">
                            <i class="ri-check-line"></i>
                        </div>
                        <span>Sudah diunduh</span>
                    </div>
                    <button class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 !rounded-button whitespace-nowrap flex items-center download-btn">
                        <div class="w-5 h-5 flex items-center justify-center mr-2">
                            <i class="ri-download-line"></i>
                        </div>
                        <span>Unduh Ulang</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Produk 4 -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden card-hover">
            <div class="h-48 overflow-hidden">
                <img src="https://readdy.ai/api/search-image?query=professional%2520software%2520UI%2520for%2520content%2520management%2520system%2520with%2520modern%2520design%252C%2520clean%2520interface%252C%2520document%2520organization%252C%2520blue%2520color%2520scheme%252C%2520high%2520quality%2520professional%2520design&width=800&height=450&seq=4&orientation=landscape" alt="Content Management Suite" class="w-full h-full object-cover object-top">
            </div>
            <div class="p-5">
                <h2 class="text-lg font-semibold text-gray-800 mb-1">Content Management Suite</h2>
                <div class="flex items-center text-gray-500 text-sm mb-4">
                    <div class="w-4 h-4 flex items-center justify-center mr-1">
                        <i class="ri-calendar-line"></i>
                    </div>
                    <span>Dibeli pada 15 April 2025</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">EXE • 320 MB</span>
                    <button class="bg-primary hover:bg-blue-600 text-white px-4 py-2 !rounded-button whitespace-nowrap flex items-center download-btn">
                        <div class="w-5 h-5 flex items-center justify-center mr-2">
                            <i class="ri-download-line"></i>
                        </div>
                        <span>Unduh</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Produk 5 -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden card-hover">
            <div class="h-48 overflow-hidden">
                <img src="https://readdy.ai/api/search-image?query=professional%2520e-book%2520cover%2520about%2520social%2520media%2520marketing%2520strategies%2520with%2520modern%2520design%252C%2520social%2520media%2520icons%252C%2520engaging%2520visuals%252C%2520blue%2520color%2520scheme%252C%2520high%2520quality%2520professional%2520design&width=800&height=450&seq=5&orientation=landscape" alt="Social Media Marketing Pro" class="w-full h-full object-cover object-top">
            </div>
            <div class="p-5">
                <h2 class="text-lg font-semibold text-gray-800 mb-1">Social Media Marketing Pro</h2>
                <div class="flex items-center text-gray-500 text-sm mb-4">
                    <div class="w-4 h-4 flex items-center justify-center mr-1">
                        <i class="ri-calendar-line"></i>
                    </div>
                    <span>Dibeli pada 10 April 2025</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center text-green-600 text-sm">
                        <div class="w-4 h-4 flex items-center justify-center mr-1">
                            <i class="ri-check-line"></i>
                        </div>
                        <span>Sudah diunduh</span>
                    </div>
                    <button class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 !rounded-button whitespace-nowrap flex items-center download-btn">
                        <div class="w-5 h-5 flex items-center justify-center mr-2">
                            <i class="ri-download-line"></i>
                        </div>
                        <span>Unduh Ulang</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Produk 6 -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden card-hover">
            <div class="h-48 overflow-hidden">
                <img src="https://readdy.ai/api/search-image?query=professional%2520software%2520UI%2520for%2520project%2520management%2520tool%2520with%2520modern%2520design%252C%2520task%2520boards%252C%2520timeline%2520views%252C%2520blue%2520color%2520scheme%252C%2520high%2520quality%2520professional%2520design&width=800&height=450&seq=6&orientation=landscape" alt="Project Management Tool" class="w-full h-full object-cover object-top">
            </div>
            <div class="p-5">
                <h2 class="text-lg font-semibold text-gray-800 mb-1">Project Management Tool</h2>
                <div class="flex items-center text-gray-500 text-sm mb-4">
                    <div class="w-4 h-4 flex items-center justify-center mr-1">
                        <i class="ri-calendar-line"></i>
                    </div>
                    <span>Dibeli pada 5 April 2025</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">ZIP • 180 MB</span>
                    <button class="bg-primary hover:bg-blue-600 text-white px-4 py-2 !rounded-button whitespace-nowrap flex items-center download-btn">
                        <div class="w-5 h-5 flex items-center justify-center mr-2">
                            <i class="ri-download-line"></i>
                        </div>
                        <span>Unduh</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Produk 7 -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden card-hover">
            <div class="h-48 overflow-hidden">
                <img src="https://readdy.ai/api/search-image?query=professional%2520e-book%2520cover%2520about%2520UI%252FUX%2520design%2520principles%2520with%2520modern%2520design%252C%2520wireframes%252C%2520user%2520interface%2520elements%252C%2520blue%2520color%2520scheme%252C%2520high%2520quality%2520professional%2520design&width=800&height=450&seq=7&orientation=landscape" alt="UI/UX Design Essentials" class="w-full h-full object-cover object-top">
            </div>
            <div class="p-5">
                <h2 class="text-lg font-semibold text-gray-800 mb-1">UI/UX Design Essentials</h2>
                <div class="flex items-center text-gray-500 text-sm mb-4">
                    <div class="w-4 h-4 flex items-center justify-center mr-1">
                        <i class="ri-calendar-line"></i>
                    </div>
                    <span>Dibeli pada 1 April 2025</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center text-green-600 text-sm">
                        <div class="w-4 h-4 flex items-center justify-center mr-1">
                            <i class="ri-check-line"></i>
                        </div>
                        <span>Sudah diunduh</span>
                    </div>
                    <button class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 !rounded-button whitespace-nowrap flex items-center download-btn">
                        <div class="w-5 h-5 flex items-center justify-center mr-2">
                            <i class="ri-download-line"></i>
                        </div>
                        <span>Unduh Ulang</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Empty State (Hidden by default) -->
    <div class="hidden flex flex-col items-center justify-center py-16">
        <div class="w-32 h-32 flex items-center justify-center bg-gray-100 rounded-full mb-6">
            <i class="ri-inbox-line ri-3x text-gray-400"></i>
        </div>
        <h3 class="text-xl font-semibold text-gray-800 mb-2">Belum Ada Produk Digital</h3>
        <p class="text-gray-600 text-center max-w-md mb-6">Anda belum memiliki produk digital. Silakan kembali ke halaman produk untuk membeli produk digital.</p>
        <a href="/" class="bg-primary hover:bg-blue-600 text-white px-6 py-2 !rounded-button whitespace-nowrap">
            Lihat Produk
        </a>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const downloadButtons = document.querySelectorAll('.download-btn');
    
    downloadButtons.forEach(button => {
        button.addEventListener('click', function() {
            const isDownloaded = button.classList.contains('bg-gray-100');
            const productName = button.closest('.card-hover').querySelector('h2').textContent;
            
            if (!isDownloaded) {
                // Simulate download process
                button.disabled = true;
                const originalText = button.innerHTML;
                
                button.innerHTML = `
                    <div class="w-5 h-5 flex items-center justify-center mr-2">
                        <i class="ri-loader-4-line animate-spin"></i>
                    </div>
                    <span>Mengunduh...</span>
                `;
                
                setTimeout(() => {
                    button.innerHTML = `
                        <div class="w-5 h-5 flex items-center justify-center mr-2">
                            <i class="ri-check-line"></i>
                        </div>
                        <span>Selesai</span>
                    `;
                    
                    const statusElement = button.closest('.card-hover').querySelector('.flex.items-center.justify-between').firstElementChild;
                    statusElement.innerHTML = `
                        <div class="flex items-center text-green-600 text-sm">
                            <div class="w-4 h-4 flex items-center justify-center mr-1">
                                <i class="ri-check-line"></i>
                            </div>
                            <span>Sudah diunduh</span>
                        </div>
                    `;
                    
                    setTimeout(() => {
                        button.disabled = false;
                        button.classList.remove('bg-primary', 'hover:bg-blue-600', 'text-white');
                        button.classList.add('bg-gray-100', 'hover:bg-gray-200', 'text-gray-700');
                        button.innerHTML = `
                            <div class="w-5 h-5 flex items-center justify-center mr-2">
                                <i class="ri-download-line"></i>
                            </div>
                            <span>Unduh Ulang</span>
                        `;
                        
                        // Show notification
                        alert(`Produk "${productName}" berhasil diunduh!`);
                    }, 1000);
                }, 2000);
            } else {
                // Re-download
                alert(`Mengunduh ulang "${productName}"...`);
            }
        });
    });

    // Search functionality
    const searchInput = document.querySelector('input[type="text"]');
    const productCards = document.querySelectorAll('.card-hover');
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase().trim();
        
        productCards.forEach(card => {
            const productName = card.querySelector('h2').textContent.toLowerCase();
            
            if (productName.includes(searchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
        
        // Check if no results
        const visibleCards = [...productCards].filter(card => card.style.display !== 'none');
        const emptyState = document.querySelector('.hidden.flex.flex-col');
        const gridContainer = document.querySelector('.grid');
        
        if (visibleCards.length === 0 && searchTerm !== '') {
            gridContainer.style.display = 'none';
            emptyState.classList.remove('hidden');
            emptyState.querySelector('h3').textContent = 'Tidak Ada Hasil';
            emptyState.querySelector('p').textContent = `Tidak ada produk yang cocok dengan pencarian "${searchTerm}". Silakan coba kata kunci lain.`;
        } else {
            gridContainer.style.display = 'grid';
            emptyState.classList.add('hidden');
        }
    });
});
</script>
</body>
</html>