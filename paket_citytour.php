<?php
$basePrice = 300000; // Harga dasar per orang
$waNumber = "6281234567890"; // Nomor WhatsApp admin (ganti sesuai kebutuhan)
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TerraNusa - City Tour Yogyakarta</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#245B4F',
                        'secondary': '#6A9C89',
                        'tertiary': '#C4DAD2',
                        'background': '#E9EFEC',
                    }
                }
            }
        }
    </script>
    <style>
        .container-custom {
            width: 85%;
            max-width: 1400px;
            margin: 0 auto;
            padding-left: 2rem;
            padding-right: 2rem;
        }
    </style>
</head>
<body class="bg-background">
    <!-- Navbar -->
    <nav class="fixed w-full bg-primary/95 backdrop-blur-md z-50">
        <!-- Same navbar as before -->
    </nav>

    <!-- Main Content -->
    <main class="pt-32">
        <div class="container-custom">
            <!-- Breadcrumb -->
            <div class="mb-6">
                <div class="flex items-center space-x-2 text-sm text-gray-600">
                    <a href="index.html" class="hover:text-primary">Beranda</a>
                    <span>/</span>
                    <a href="paket-travel.html" class="hover:text-primary">Paket Travel</a>
                    <span>/</span>
                    <span class="text-primary">City Tour Yogyakarta</span>
                </div>
            </div>

            <!-- Package Header -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Image Gallery -->
                <div class="space-y-4">
                    <div class="aspect-video rounded-lg overflow-hidden">
                        <img src="Gambar/Malioboro.jpg" alt="Malioboro" class="w-full h-full object-cover">
                    </div>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="aspect-video rounded-lg overflow-hidden">
                            <img src="Gambar/Keraton.jpg" alt="Keraton Yogyakarta" class="w-full h-full object-cover">
                        </div>
                        <div class="aspect-video rounded-lg overflow-hidden">
                            <img src="Gambar/TamanSari.jpg" alt="Taman Sari" class="w-full h-full object-cover">
                        </div>
                        <div class="aspect-video rounded-lg overflow-hidden">
                            <img src="Gambar/Beringharjo.jpg" alt="Pasar Beringharjo" class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>

                <!-- Package Summary -->
                <div class="bg-white rounded-lg p-6 shadow-lg">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <span class="inline-block px-3 py-1 bg-primary/10 text-primary rounded-full text-sm mb-2">One Day Trip</span>
                            <h1 class="text-3xl font-bold text-primary">City Tour Yogyakarta</h1>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-600">Mulai dari</p>
                            <p class="text-3xl font-bold text-secondary">Rp 300.000</p>
                            <p class="text-sm text-gray-600">per orang</p>
                        </div>
                    </div>

                    <!-- Quick Info -->
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="bg-background rounded-lg p-4">
                            <p class="text-sm text-gray-600">Durasi</p>
                            <p class="font-semibold">8 Jam (09.00 - 17.00)</p>
                        </div>
                        <div class="bg-background rounded-lg p-4">
                            <p class="text-sm text-gray-600">Meeting Point</p>
                            <p class="font-semibold">Hotel/Bandara/Stasiun</p>
                        </div>
                        <div class="bg-background rounded-lg p-4">
                            <p class="text-sm text-gray-600">Makan</p>
                            <p class="font-semibold">1x Makan Siang Gudeg</p>
                        </div>
                        <div class="bg-background rounded-lg p-4">
                            <p class="text-sm text-gray-600">Transportasi</p>
                            <p class="font-semibold">Mobil AC</p>
                        </div>
                    </div>

                    <!-- Booking Form -->
                    <form id="bookingForm" onsubmit="submitForm(event)">
    <div class="space-y-4">
        <div>
            <label class="block text-gray-700 mb-2">Tanggal Tour</label>
            <input type="date" id="tourDate" name="tourDate" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary" required>
        </div>
        <div>
            <label class="block text-gray-700 mb-2">Jumlah Peserta</label>
            <div class="flex items-center border border-gray-300 rounded-lg">
                <button type="button" onclick="decrementCount()" class="p-3 text-primary hover:bg-gray-100 rounded-l-lg">-</button>
                <input type="number" id="participant-count" name="participantCount" value="1" min="1" class="w-full p-3 text-center border-x border-gray-300 focus:outline-none" onchange="updatePrice()" readonly>
                <button type="button" onclick="incrementCount()" class="p-3 text-primary hover:bg-gray-100 rounded-r-lg">+</button>
            </div>
        </div>
        <div>
            <label class="block text-gray-700 mb-2">Nomor WhatsApp</label>
            <input type="tel" id="customerPhone" name="customerPhone" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary" required placeholder="Contoh: 08123456789">
        </div>
        <div class="bg-tertiary/20 p-4 rounded-lg">
            <div class="flex justify-between items-center text-lg font-semibold">
                <span>Total Pembayaran:</span>
                <span id="totalPrice" class="text-primary">Rp 300.000</span>
            </div>
        </div>
        <button type="submit" class="w-full bg-secondary hover:bg-secondary/90 text-white py-3 rounded-lg transition-colors duration-300 flex items-center justify-center gap-2">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
            </svg>
            Pesan via WhatsApp
        </button>
    </div>
</form>
                </div>
            </div>

            <!-- Tabs Navigation -->
            <div class="mb-8">
                <div class="flex space-x-4 border-b border-gray-200">
                    <button onclick="switchTab('overview')" class="px-4 py-2 text-primary border-b-2 border-primary">Overview</button>
                    <button onclick="switchTab('itinerary')" class="px-4 py-2 text-gray-600 hover:text-primary">Itinerary</button>
                    <button onclick="switchTab('facility')" class="px-4 py-2 text-gray-600 hover:text-primary">Fasilitas</button>
                </div>
            </div>

            <!-- Tab Content -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <!-- Overview Tab -->
                    <div id="overview" class="bg-white rounded-lg p-6 shadow-lg mb-8">
                        <h2 class="text-2xl font-bold text-primary mb-4">Deskripsi Paket</h2>
                        <p class="text-gray-600 mb-4">
                            Jelajahi pesona kota Yogyakarta dalam satu hari yang menakjubkan! Paket city tour ini mengajak Anda mengunjungi landmark-landmark ikonik kota Yogyakarta, dari kemegahan Keraton hingga hiruk-pikuk Malioboro yang legendaris.
                        </p>
                        <p class="text-gray-600">
                            Nikmati pengalaman berbelanja di Pasar Beringharjo yang bersejarah, menjelajahi keindahan arsitektur Taman Sari, dan mencicipi kuliner khas Yogyakarta yang lezat. Tour ini cocok untuk wisatawan yang ingin mengenal lebih dekat sejarah dan budaya kota Yogyakarta.
                        </p>
                    </div>

                    <!-- Itinerary Tab (Hidden by default) -->
                    <div id="itinerary" class="hidden bg-white rounded-lg p-6 shadow-lg mb-8">
                        <h2 class="text-2xl font-bold text-primary mb-6">Jadwal Perjalanan</h2>
                        <div class="space-y-6">
                            <div class="flex gap-4">
                                <div class="w-20 text-secondary font-bold">09:00</div>
                                <div>
                                    <h3 class="font-bold text-primary">Penjemputan</h3>
                                    <p class="text-gray-600">Penjemputan di hotel area Yogyakarta</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <div class="w-20 text-secondary font-bold">09:30</div>
                                <div>
                                    <h3 class="font-bold text-primary">Keraton Yogyakarta</h3>
                                    <p class="text-gray-600">Mengunjungi istana Sultan dan melihat koleksi pusaka kerajaan</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <div class="w-20 text-secondary font-bold">11:30</div>
                                <div>
                                    <h3 class="font-bold text-primary">Taman Sari</h3>
                                    <p class="text-gray-600">Menjelajahi istana air dan taman kerajaan</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <div class="w-20 text-secondary font-bold">13:00</div>
                                <div>
                                    <h3 class="font-bold text-primary">Makan Siang</h3>
                                    <p class="text-gray-600">Menikmati hidangan gudeg khas Yogyakarta</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <div class="w-20 text-secondary font-bold">14:00</div>
                                <div>
                                    <h3 class="font-bold text-primary">Pasar Beringharjo</h3>
                                    <p class="text-gray-600">Berbelanja batik dan oleh-oleh khas Yogyakarta</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <div class="w-20 text-secondary font-bold">15:30</div>
                                <div>
                                    <h3 class="font-bold text-primary">Malioboro</h3>
                                    <p class="text-gray-600">Jalan-jalan dan berbelanja di Malioboro</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <div class="w-20 text-secondary font-bold">17:00</div>
                                <div>
                                    <h3 class="font-bold text-primary">Kembali</h3>
                                    <p class="text-gray-600">Perjalanan pulang ke hotel</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Facility Tab (Hidden by default) -->
                    <div id="facility" class="hidden bg-white rounded-lg p-6 shadow-lg mb-8">
                        <h2 class="text-2xl font-bold text-primary mb-6">Fasilitas Tour</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <h3 class="font-bold text-primary mb-4">Termasuk</h3>
                                <ul class="space-y-2">
                                    <li class="flex items-center gap-2">
                                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Transportasi AC PP
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Makan siang gudeg
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Guide lokal berpengalaman
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Tiket masuk wisata
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Air mineral
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="font-bold text-primary mb-4">Tidak Termasuk</h3>
                <ul class="space-y-2">
                    <li class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Pengeluaran pribadi
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Biaya parkir foto
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Pemandu foto
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Asuransi perjalanan
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

                <!-- Sidebar Content -->
                <div class="lg:col-span-1">
                    <!-- Similar Packages -->
                    <div class="bg-white rounded-lg p-6 shadow-lg mb-8">
                        <h3 class="text-xl font-bold text-primary mb-4">Paket Lainnya</h3>
                        <div class="space-y-4">
                            <a href="pantai-selatan-detail.html" class="block p-4 border border-gray-200 rounded-lg hover:border-primary transition-colors">
                                <div class="aspect-video rounded-lg overflow-hidden mb-3">
                                    <img src="Gambar/Tritis.jpg" alt="Paket Pantai" class="w-full h-full object-cover">
                                </div>
                                <h4 class="font-bold text-primary">Paket Pantai Selatan</h4>
                                <p class="text-sm text-gray-600">Mulai dari Rp 350.000</p>
                            </a>
                            <a href="merapi-detail.html" class="block p-4 border border-gray-200 rounded-lg hover:border-primary transition-colors">
                                <div class="aspect-video rounded-lg overflow-hidden mb-3">
                                    <img src="Gambar/Merapi.jpg" alt="Merapi Tour" class="w-full h-full object-cover">
                                </div>
                                <h4 class="font-bold text-primary">Merapi Adventure</h4>
                                <p class="text-sm text-gray-600">Mulai dari Rp 450.000</p>
                            </a>
                        </div>
                    </div>

                    <!-- Need Help -->
                    <div class="bg-white rounded-lg p-6 shadow-lg">
                        <h3 class="text-xl font-bold text-primary mb-4">Butuh Bantuan?</h3>
                        <div class="space-y-4">
                            <a href="https://wa.me/1234567890" class="flex items-center gap-2 text-gray-600 hover:text-primary">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                +62 123 4567 890
                            </a>
                            <a href="mailto:info@terranusa.com" class="flex items-center gap-2 text-gray-600 hover:text-primary">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                info@terranusa.com
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-primary text-white py-8 mt-16">
        <!-- Footer content same as main page -->
    </footer>

    <!-- Scripts -->
    <script>
        function switchTab(tabId) {
            // Hide all tabs
            document.getElementById('overview').classList.add('hidden');
            document.getElementById('itinerary').classList.add('hidden');
            document.getElementById('facility').classList.add('hidden');
            
            // Show selected tab
            document.getElementById(tabId).classList.remove('hidden');
            
            // Update tab buttons
            const buttons = document.querySelectorAll('[onclick^="switchTab"]');
            buttons.forEach(button => {
                button.classList.remove('text-primary', 'border-b-2', 'border-primary');
                button.classList.add('text-gray-600');
            });
            
            // Highlight active tab
            event.target.classList.remove('text-gray-600');
            event.target.classList.add('text-primary', 'border-b-2', 'border-primary');
        }

        const basePrice = <?php echo $basePrice; ?>;
        const waNumber = "<?php echo $waNumber; ?>";

        function formatPrice(price) {
            return new Intl.NumberFormat('id-ID', { 
                style: 'currency', 
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0 
            }).format(price);
        }

        function updatePrice() {
            const count = parseInt(document.getElementById('participant-count').value);
            const totalPrice = basePrice * count;
            document.getElementById('totalPrice').textContent = formatPrice(totalPrice);
        }

        function incrementCount() {
            const input = document.getElementById('participant-count');
            const currentValue = parseInt(input.value);
            input.value = currentValue + 1;
            updatePrice();
        }

        function decrementCount() {
            const input = document.getElementById('participant-count');
            const currentValue = parseInt(input.value);
            if (currentValue > 1) {
                input.value = currentValue - 1;
                updatePrice();
            }
        }

        function submitForm(event) {
            event.preventDefault();
            
            const name = document.getElementById('customerName').value;
            const phone = document.getElementById('customerPhone').value;
            const date = document.getElementById('tourDate').value;
            const count = document.getElementById('participant-count').value;
            const total = basePrice * parseInt(count);

            // Format pesan WhatsApp
            const message = `Halo, saya ingin memesan City Tour Yogyakarta dengan detail:
            
Nama: ${name}
No. HP: ${phone}
Tanggal: ${date}
Jumlah Peserta: ${count} orang
Total Pembayaran: ${formatPrice(total)}

Mohon dibantu proses pemesanannya. Terima kasih!`;

            // Encode pesan untuk URL WhatsApp
            const encodedMessage = encodeURIComponent(message);
            
            // Redirect ke WhatsApp
            window.open(`https://wa.me/${waNumber}?text=${encodedMessage}`, '_blank');
        }

        // Initialize price on page load
        document.addEventListener('DOMContentLoaded', updatePrice);
    </script>
</body>
</html>