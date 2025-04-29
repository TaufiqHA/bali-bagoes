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
            <form action="{{ route('auth.logout') }}" method="post">
                @csrf
                <button class="px-3 py-2 rounded-xl font-semibold text-white bg-red-500" type="submit">
                    Logout
                </button>
            </form>
        </div>
    </div>
</nav>
<main class="container mx-auto px-4 md:px-8 max-w-6xl pt-24 pb-16">
    <header class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Produk Digital Saya</h1>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Produk 1 -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden card-hover">
            <div class="h-48 overflow-hidden relative">
                <img src="{{ asset('storage/' . $product->pictures) }}" alt="Digital Marketing Mastery" class="w-full h-full object-cover object-top">
                <div class="absolute top-3 right-3 bg-green-500 text-white text-xs px-2 py-1 rounded-full">
                    Baru
                </div>
            </div>
            <div class="p-5">
                <h2 class="text-lg font-semibold text-gray-800 mb-1">{{ $product->name }}</h2>
                <div class="flex items-center text-gray-500 text-sm mb-4">
                    <span>{{ $product->descriptions }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600"></span>
                    <a href="{{ route('download', ['product' => $product->id]) }}" class="bg-primary hover:bg-blue-600 text-white px-4 py-2 !rounded-button whitespace-nowrap flex items-center download-btn">
                        <div class="w-5 h-5 flex items-center justify-center mr-2">
                            <i class="ri-download-line"></i>
                        </div>
                        <span>Unduh</span>
                    </a>
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