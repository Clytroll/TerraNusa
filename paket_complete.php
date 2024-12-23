<?php
$pageTitle = "Complete Yogyakarta Package";
$basePrice = 3500000; // Base price per person

require_once 'includes/header.php';
require_once 'includes/navbar.php';
?>

<main class="pt-32">
    <div class="container-custom">
        <!-- Breadcrumb -->
        <div class="mb-6">
            <div class="flex items-center space-x-2 text-sm text-gray-600">
                <a href="index.html" class="hover:text-primary">Beranda</a>
                <span>/</span>
                <a href="paket-travel.html" class="hover:text-primary">Paket Travel</a>
                <span>/</span>
                <span class="text-primary">Complete Yogyakarta (4D3N)</span>
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
                        <img src="Gambar/Prambanan.jpg" alt="Prambanan" class="w-full h-full object-cover">
                    </div>
                    <div class="aspect-video rounded-lg overflow-hidden">
                        <img src="Gambar/Merapi.jpg" alt="Merapi" class="w-full h-full object-cover">
                    </div>
                    <div class="aspect-video rounded-lg overflow-hidden">
                        <img src="Gambar/Parangtritis.jpg" alt="Parangtritis" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>

            <!-- Package Summary -->
            <div class="bg-white rounded-lg p-6 shadow-lg">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <span class="inline-block px-3 py-1 bg-primary/10 text-primary rounded-full text-sm mb-2">4 Hari 3 Malam</span>
                        <h1 class="text-3xl font-bold text-primary">Complete Yogyakarta</h1>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600">Mulai dari</p>
                        <p class="text-3xl font-bold text-secondary">Rp 3.500.000</p>
                        <p class="text-sm text-gray-600">per orang</p>
                    </div>
                </div>

                <!-- Quick Info -->
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div class="bg-background rounded-lg p-4">
                        <p class="text-sm text-gray-600">Durasi</p>
                        <p class="font-semibold">4 Hari 3 Malam</p>
                    </div>
                    <div class="bg-background rounded-lg p-4">
                        <p class="text-sm text-gray-600">Akomodasi</p>
                        <p class="font-semibold">Hotel Bintang 4</p>
                    </div>
                    <div class="bg-background rounded-lg p-4">
                        <p class="text-sm text-gray-600">Makan</p>
                        <p class="font-semibold">10x Makan</p>
                    </div>
                    <div class="bg-background rounded-lg p-4">
                        <p class="text-sm text-gray-600">Transportasi</p>
                        <p class="font-semibold">Premium AC</p>
                    </div>
                </div>

                <!-- Booking Form -->
                <form id="bookingForm" action="process_order.php" method="POST">
                    <input type="hidden" name="package_id" value="7"> <!-- ID untuk Complete Yogyakarta -->
                    <input type="hidden" name="package_price" value="3500000">
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
                            <label class="block text-gray-700 mb-2">Nomor HP</label>
                            <input type="tel" id="customerPhone" name="customerPhone" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary" required placeholder="Contoh: 08123456789">
                        </div>
                        <div class="bg-tertiary/20 p-4 rounded-lg">
                            <div class="flex justify-between items-center text-lg font-semibold">
                                <span>Total Pembayaran:</span>
                                <span id="totalPrice" class="text-primary">Rp 3.500.000</span>
                                <input type="hidden" name="totalAmount" id="totalAmountInput" value="3500000">
                            </div>
                        </div>
                        <button type="submit" class="w-full bg-secondary hover:bg-secondary/90 text-white py-3 rounded-lg transition-colors duration-300">
                            Lanjutkan ke Pembayaran
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
                        Nikmati pengalaman lengkap menjelajahi Yogyakarta selama 4 hari yang menakjubkan! Paket Complete Yogyakarta ini dirancang khusus untuk memberikan Anda pengalaman terlengkap mengeksplorasi keindahan alam, budaya, dan kuliner Yogyakarta.
                    </p>
                    <p class="text-gray-600 mb-4">
                        Dari kemegahan Candi Prambanan hingga keseruan Lava Tour Merapi, dari keramaian Malioboro hingga keindahan Pantai Parangtritis, semua spot ikonik Yogyakarta akan Anda kunjungi dengan kenyamanan maksimal.
                    </p>
                    <p class="text-gray-600">
                        Paket ini mencakup akomodasi bintang 4, transportasi premium, kuliner terbaik, dan guide profesional yang akan memastikan perjalanan Anda berkesan.
                    </p>
                </div>

                <!-- Itinerary Tab -->
                <div id="itinerary" class="hidden bg-white rounded-lg p-6 shadow-lg mb-8">
                    <h2 class="text-2xl font-bold text-primary mb-6">Jadwal Perjalanan</h2>
                    <div class="space-y-8">
                        <!-- Hari 1 - City Tour -->
                        <div>
                            <h3 class="text-lg font-bold text-secondary mb-4">Hari Pertama - City Tour</h3>
                            <div class="space-y-6">
                                <div class="flex gap-4">
                                    <div class="w-20 text-secondary font-bold">09:00</div>
                                    <div>
                                        <h4 class="font-bold text-primary">Penjemputan</h4>
                                        <p class="text-gray-600">Penjemputan di hotel/bandara/stasiun</p>
                                    </div>
                                </div>
                                <div class="flex gap-4">
                                    <div class="w-20 text-secondary font-bold">10:00</div>
                                    <div>
                                        <h4 class="font-bold text-primary">Keraton Yogyakarta</h4>
                                        <p class="text-gray-600">Mengunjungi istana Sultan dengan guide lokal</p>
                                    </div>
                                </div>
                                <div class="flex gap-4">
                                    <div class="w-20 text-secondary font-bold">12:30</div>
                                    <div>
                                        <h4 class="font-bold text-primary">Makan Siang</h4>
                                        <p class="text-gray-600">Menikmati hidangan Gudeg Jogja</p>
                                    </div>
                                </div>
                                <div class="flex gap-4">
                                    <div class="w-20 text-secondary font-bold">14:00</div>
                                    <div>
                                        <h4 class="font-bold text-primary">Taman Sari</h4>
                                        <p class="text-gray-600">Menjelajahi istana air dan taman kerajaan</p>
                                    </div>
                                </div>
                                <div class="flex gap-4">
                                    <div class="w-20 text-secondary font-bold">16:00</div>
                                    <div>
                                        <h4 class="font-bold text-primary">Malioboro</h4>
                                        <p class="text-gray-600">Shopping dan menikmati suasana kota</p>
                                    </div>
                                </div>
                                <div class="flex gap-4">
                                    <div class="w-20 text-secondary font-bold">19:00</div>
                                    <div>
                                        <h4 class="font-bold text-primary">Check-in Hotel</h4>
                                        <p class="text-gray-600">Check-in dan makan malam</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Hari 2 - Heritage Tour -->
                        <div>
                            <h3 class="text-lg font-bold text-secondary mb-4">Hari Kedua - Heritage Tour</h3>
                            <div class="space-y-6">
                                <div class="flex gap-4">
                                    <div class="w-20 text-secondary font-bold">07:00</div>
                                    <div>
                                        <h4 class="font-bold text-primary">Sarapan</h4>
                                        <p class="text-gray-600">Sarapan di hotel</p>
                                    </div>
                                </div>
                                <div class="flex gap-4">
                                    <div class="w-20 text-secondary font-bold">08:30</div>
                                    <div>
                                        <h4 class="font-bold text-primary">Candi Prambanan</h4>
                                        <p class="text-gray-600">Tour candi dengan pemandu khusus</p>
                                    </div>
                                </div>
                                <div class="flex gap-4">
                                    <div class="w-20 text-secondary font-bold">12:00</div>
                                    <div>
                                        <h4 class="font-bold text-primary">Makan Siang</h4>
                                        <p class="text-gray-600">Makan siang di restoran lokal</p>
                                    </div>
                                </div>
                                <div class="flex gap-4">
                                    <div class="w-20 text-secondary font-bold">14:00</div>
                                    <div>
                                        <h4 class="font-bold text-primary">Ratu Boko</h4>
                                        <p class="text-gray-600">Mengunjungi situs bersejarah Ratu Boko</p>
                                    </div>
                                </div>
                                <div class="flex gap-4">
                                    <div class="w-20 text-secondary font-bold">17:00</div>
                                    <div>
                                        <h4 class="font-bold text-primary">Sunset & Dinner</h4>
                                        <p class="text-gray-600">Menikmati sunset dan makan malam</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Hari 3 - Adventure Day -->
                        <div>
                            <h3 class="text-lg font-bold text-secondary mb-4">Hari Ketiga - Adventure Day</h3>
                            <div class="space-y-6">
                                <div class="flex gap-4">
                                    <div class="w-20 text-secondary font-bold">05:00</div>
                                    <div>
                                        <h4 class="font-bold text-primary">Sunrise Tour</h4>
                                        <p class="text-gray-600">Menikmati sunrise di Punthuk Setumbu</p>
                                    </div>
                                </div>
                                <div class="flex gap-4">
                                    <div class="w-20 text-secondary font-bold">07:30</div>
                                    <div>
                                        <h4 class="font-bold text-primary">Sarapan</h4>
                                        <p class="text-gray-600">Sarapan di hotel</p>
                                    </div>
                                </div>
                                <div class="flex gap-4">
                                    <div class="w-20 text-secondary font-bold">09:00</div>
                                    <div>
                                        <h4 class="font-bold text-primary">Lava Tour Merapi</h4>
                                        <p class="text-gray-600">Petualangan dengan Jeep di kawasan Merapi</p>
                                    </div>
                                </div>
                                <div class="flex gap-4">
                                    <div class="w-20 text-secondary font-bold">12:30</div>
                                    <div>
                                        <h4 class="font-bold text-primary">Makan Siang</h4>
                                        <p class="text-gray-600">Makan siang di restoran lokal</p>
                                    </div>
                                </div>
                                <div class="flex gap-4">
                                    <div class="w-20 text-secondary font-bold">14:00</div>
                                    <div>
                                        <h4 class="font-bold text-primary">Goa Pindul</h4>
                                        <p class="text-gray-600">Cave tubing di Goa Pindul</p>
                                    </div>
                                </div>
                                <div class="flex gap-4">
                                    <div class="w-20 text-secondary font-bold">17:00</div>
                                    <div>
                                        <h4 class="font-bold text-primary">Kembali ke Hotel</h4>
                                        <p class="text-gray-600">Istirahat dan makan malam</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Hari 4 - Beach & Nature -->
                        <div>
                            <h3 class="text-lg font-bold text-secondary mb-4">Hari Keempat - Beach & Nature</h3>
                            <div class="space-y-6">
                                <div class="flex gap-4">
                                    <div class="w-20 text-secondary font-bold">07:00</div>
                                    <div>
                                        <h4 class="font-bold text-primary">Sarapan</h4>
                                        <p class="text-gray-600">Sarapan di hotel</p>
                                    </div>
                                </div>
                                <div class="flex gap-4">
                                    <div class="w-20 text-secondary font-bold">08:30</div>
                                    <div>
                                        <h4 class="font-bold text-primary">Pantai Parangtritis</h4>
                                        <p class="text-gray-600">Menikmati keindahan pantai selatan</p>
                                    </div>
                                </div>
                                <div class="flex gap-4">
                                    <div class="w-20 text-secondary font-bold">11:00</div>
                                    <div>
                                        <h4 class="font-bold text-primary">Gumuk Pasir</h4>
                                        <p class="text-gray-600">Eksplorasi gurun pasir Yogyakarta</p>
                                    </div>
                                </div>
                                <div class="flex gap-4">
                                    <div class="w-20 text-secondary font-bold">13:00</div>
                                    <div>
                                        <h4 class="font-bold text-primary">Makan Siang</h4>
                                        <p class="text-gray-600">Makan siang seafood di Pantai Depok</p>
                                    </div>
                                </div>
                                <div class="flex gap-4">
                                    <div class="w-20 text-secondary font-bold">14:30</div>
                                    <div>
                                        <h4 class="font-bold text-primary">Hutan Pinus</h4>
                                        <p class="text-gray-600">Berfoto di Hutan Pinus Pengger</p>
                                    </div>
                                </div>
                                <div class="flex gap-4">
                                    <div class="w-20 text-secondary font-bold">16:30</div>
                                    <div>
                                        <h4 class="font-bold text-primary">Kembali</h4>
                                        <p class="text-gray-600">Transfer ke hotel/bandara/stasiun</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Facility Tab -->
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
                                    Hotel bintang 4 (3 malam)
                                </li>
                                <li class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Transportasi Premium AC
                                </li>
                                <li class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    10x makan (3x sarapan, 4x makan siang, 3x makan malam)
                                </li>
                                <li class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Guide profesional bersertifikat
                                </li>
                                <li class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Semua tiket masuk wisata
                                </li>
                                <li class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Dokumentasi perjalanan
                                </li>
                                <li class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Souvenir khas Jogja
                                </li>
                                <li class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Air mineral selama tour
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
                                    Tiket pesawat/kereta
                                </li>
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
                                    Tips untuk guide
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
                        <a href="cultural-heritage.php" class="block p-4 border border-gray-200 rounded-lg hover:border-primary transition-colors">
                            <div class="aspect-video rounded-lg overflow-hidden mb-3">
                                <img src="Gambar/Keraton.jpg" alt="Cultural Heritage" class="w-full h-full object-cover">
                            </div>
                            <h4 class="font-bold text-primary">Cultural Heritage</h4>
                            <p class="text-sm text-gray-600">Mulai dari Rp 1.750.000</p>
                        </a>
                        <a href="adventure-package.php" class="block p-4 border border-gray-200 rounded-lg hover:border-primary transition-colors">
                            <div class="aspect-video rounded-lg overflow-hidden mb-3">
                                <img src="Gambar/Merapi.jpg" alt="Adventure Package" class="w-full h-full object-cover">
                            </div>
                            <h4 class="font-bold text-primary">Adventure Package</h4>
                            <p class="text-sm text-gray-600">Mulai dari Rp 2.250.000</p>
                        </a>
                    </div>
                </div>

                <!-- Need Help -->
                <div class="bg-white rounded-lg p-6 shadow-lg">
                    <h3 class="text-xl font-bold text-primary mb-4">Butuh Bantuan?</h3>
                    <div class="space-y-4">
                        <a href="tel:+6281234567890" class="flex items-center gap-2 text-gray-600 hover:text-primary">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            +62 812 3456 7890
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

<?php
require_once 'includes/footer.php';
?>

<!-- Scripts -->
<script>
    const basePrice = <?php echo $basePrice; ?>;

    function formatPrice(price) {
        return new Intl.NumberFormat('id-ID', { 
            style: 'currency', 
            currency: 'IDR',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0 
        }).format(price);
    }

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

    function updatePrice() {
        const count = parseInt(document.getElementById('participant-count').value);
        const totalPrice = basePrice * count;
        document.getElementById('totalPrice').textContent = formatPrice(totalPrice);
        document.getElementById('totalAmountInput').value = totalPrice;
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

    // Initialize price on page load
    document.addEventListener('DOMContentLoaded', updatePrice);

    // Add validation for form submission
    document.getElementById('bookingForm').addEventListener('submit', function(event) {
        event.preventDefault();
        
        const tourDate = document.getElementById('tourDate').value;
        const phone = document.getElementById('customerPhone').value;
        
        if (!tourDate) {
            alert('Silakan pilih tanggal tour');
            return;
        }
        
        if (!phone) {
            alert('Silakan masukkan nomor telepon');
            return;
        }
        
        // Phone number validation (Indonesian format)
        const phoneRegex = /^(\+62|62|0)[0-9]{9,12}$/;
        if (!phoneRegex.test(phone)) {
            alert('Nomor telepon tidak valid. Gunakan format Indonesia (contoh: 081234567890)');
            return;
        }
        
        // If validation passes, submit the form
        this.submit();
    });

    // Date validation - prevent selecting past dates
    const tourDateInput = document.getElementById('tourDate');
    const today = new Date();
    const tomorrow = new Date(today);
    tomorrow.setDate(tomorrow.getDate() + 1);
    
    // Set min date to tomorrow
    tourDateInput.min = tomorrow.toISOString().split('T')[0];
    
    // Set max date to 6 months from now
    const maxDate = new Date(today);
    maxDate.setMonth(maxDate.getMonth() + 6);
    tourDateInput.max = maxDate.toISOString().split('T')[0];
</script>
</body>
</html>