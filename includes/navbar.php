<header id="navbar" class="bg-primary text-white transition-transform duration-300 ease-in-out">
    <div class="w-[85%] max-w-[1400px] mx-auto px-8 py-4 flex justify-between items-center">
        <div class="h-10">
            <a href="index.php" class="block">
                <img src="Gambar\LogoTerraNusa.png" alt="TerraNusa Logo" class="h-12 w-auto">
            </a>
        </div>
        <nav>
            <ul class="flex space-x-6">
                <li><a href="index.php" class="text-sm hover:text-tertiary relative py-1 after:content-[''] after:absolute after:left-0 after:bottom-0 after:w-0 after:h-0.5 after:bg-tertiary after:transition-all after:duration-300 hover:after:w-full">Beranda</a></li>
                <li><a href="destinasi.php" class="text-sm hover:text-tertiary relative py-1 after:content-[''] after:absolute after:left-0 after:bottom-0 after:w-0 after:h-0.5 after:bg-tertiary after:transition-all after:duration-300 hover:after:w-full">Destinasi</a></li>
                <li><a href="paket_travel.php" class="text-sm hover:text-tertiary relative py-1 after:content-[''] after:absolute after:left-0 after:bottom-0 after:w-0 after:h-0.5 after:bg-tertiary after:transition-all after:duration-300 hover:after:w-full">Paket Travel</a></li>
                <li><a href="profile.php" class="text-sm hover:text-tertiary relative py-1 after:content-[''] after:absolute after:left-0 after:bottom-0 after:w-0 after:h-0.5 after:bg-tertiary after:transition-all after:duration-300 hover:after:w-full">Profile</a></li>
            </ul>
        </nav>
        <div class="flex space-x-2" id="userSection">
            <!-- Bagian login/register jika belum login -->
            <?php if (!isset($_SESSION['user_id'])): ?>
                <button onclick="openModal('login')" class="bg-secondary/80 hover:bg-secondary px-4 py-2 rounded text-white">Masuk</button>
                <button onclick="openModal('register')" class="bg-tertiary/90 hover:bg-tertiary px-4 py-2 rounded text-primary">Daftar</button>
            <?php else: ?>
                <!-- Bagian untuk username dan gambar profil -->
                <div class="flex items-center space-x-4">
                    <img id="userProfilePic" src="default-profile.png" alt="Profile" class="h-8 w-8 rounded-full">
                    <span id="usernameDisplay" class="text-sm font-semibold text-white"></span>
                </div>
                <a href="logout.php" class="bg-secondary/80 hover:bg-secondary px-4 py-2 rounded text-white">Logout</a>
            <?php endif; ?>
        </div>
    </div>
</header>

<!-- Login/Register Modal -->
<div id="authModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-lg shadow-xl w-full max-w-md mx-4 p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 id="modalTitle" class="text-2xl font-bold text-primary">Masuk</h2>
            <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <form id="authForm" action="auth_handler.php" method="POST" class="space-y-4">
            <input type="hidden" id="authType" name="authType" value="login">
            
            <div id="usernameField" class="hidden">
                <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                <input type="text" name="username" id="username" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" id="email" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" id="password" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent">
            </div>
            <button type="submit" class="w-full bg-secondary text-white py-2 px-4 rounded-md hover:bg-opacity-90 transition">
                <span id="submitButtonText">Masuk</span>
            </button>
        </form>

        <!-- Link untuk admin di pojok kanan bawah -->
        <div class="mt-4 text-right">
            <a href="../../admin/login.php" class="text-xs text-gray-500 hover:text-secondary">admin</a>
        </div>
    </div>
</div>

<!-- Spacer div -->
<div id="navbar-spacer" class="hidden"></div>

<script>
// Navbar Scroll Functionality
let lastScrollTop = 0;
const navbar = document.getElementById('navbar');
const navbarSpacer = document.getElementById('navbar-spacer');
const navbarHeight = navbar.offsetHeight;

// Set height for spacer based on navbar height
navbarSpacer.style.height = `${navbarHeight}px`;

window.addEventListener('scroll', () => {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    
    if (scrollTop > 0) {
        navbar.classList.add('fixed', 'top-0', 'left-0', 'right-0', 'z-50', 'bg-primary/95', 'backdrop-blur-sm');
        navbarSpacer.classList.remove('hidden');
    } else {
        navbar.classList.remove('fixed', 'top-0', 'left-0', 'right-0', 'z-50', 'bg-primary/95', 'backdrop-blur-sm');
        navbarSpacer.classList.add('hidden');
    }
    
    if (scrollTop > lastScrollTop && scrollTop > navbarHeight) {
        navbar.classList.add('-translate-y-full');
    } else {
        navbar.classList.remove('-translate-y-full');
    }
    
    lastScrollTop = scrollTop;
});

// Auth Modal Functions
function openModal(type) {
    const modal = document.getElementById('authModal');
    const modalTitle = document.getElementById('modalTitle');
    const submitButtonText = document.getElementById('submitButtonText');
    const usernameField = document.getElementById('usernameField');
    const authTypeInput = document.getElementById('authType');
    
    authTypeInput.value = type;
    
    if (type === 'login') {
        modalTitle.textContent = "Masuk";
        submitButtonText.textContent = "Masuk";
        usernameField.classList.add('hidden');
    } else if (type === 'register') {
        modalTitle.textContent = "Daftar";
        submitButtonText.textContent = "Daftar";
        usernameField.classList.remove('hidden');
    }

    modal.classList.remove('hidden');
}

function closeModal() {
    const modal = document.getElementById('authModal');
    modal.classList.add('hidden');
}

// Update UI after successful login/register
function updateUIAfterAuth(username, profilePic = 'default-profile.png') {
    const userSection = document.getElementById('userSection');
    
    userSection.innerHTML = `
        <div class="flex items-center space-x-4">
            <img src="${profilePic}" alt="Profile" class="h-8 w-8 rounded-full">
            <span class="text-sm font-semibold text-white">${username}</span>
        </div>
        <a href="logout.php" class="bg-secondary/80 hover:bg-secondary px-4 py-2 rounded text-white">Logout</a>
    `;
    
    closeModal();
}

// Handle form submission
document.getElementById('authForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    fetch('auth/auth_handler.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert(data.message); // Atau gunakan notifikasi yang lebih menarik
            if (formData.get('authType') === 'register') {
                // Update UI setelah register berhasil
                updateUserSection(formData.get('username'), 'default-profile.png');
            } else {
                // Reload halaman setelah login berhasil
                window.location.reload();
            }
            closeModal();
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan, silakan coba lagi');
    });
});

function updateUserSection(username, profileImage) {
    const userSection = document.getElementById('userSection');
    userSection.innerHTML = `
        <div class="flex items-center space-x-4">
            <a href="../update_profile.php" class="flex items-center space-x-2">
                <img src="${profileImage}" alt="Profile" class="h-8 w-8 rounded-full">
                <span class="text-sm font-semibold text-white">${username}</span>
            </a>
            <a href="auth/logout.php" class="bg-secondary/80 hover:bg-secondary px-4 py-2 rounded text-white">Logout</a>
        </div>
    `;
}

// Function untuk membuka modal dengan tipe yang sesuai
function openModal(type) {
    const modal = document.getElementById('authModal');
    const modalTitle = document.getElementById('modalTitle');
    const submitButtonText = document.getElementById('submitButtonText');
    const usernameField = document.getElementById('usernameField');
    const authTypeInput = document.getElementById('authType');
    
    modal.style.display = 'block';
    
    if (type === 'login') {
        modalTitle.textContent = "Masuk";
        submitButtonText.textContent = "Masuk";
        usernameField.style.display = 'none';
        authTypeInput.value = 'login';
    } else {
        modalTitle.textContent = "Daftar";
        submitButtonText.textContent = "Daftar";
        usernameField.style.display = 'block';
        authTypeInput.value = 'register';
    }
}

// Function untuk menutup modal
function closeModal() {
    const modal = document.getElementById('authModal');
    modal.style.display = 'none';
}
</script>