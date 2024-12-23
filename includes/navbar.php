<?php
// Koneksi ke Database
$servername = "localhost";
$username = "root"; // Ganti sesuai username database Anda
$password = ""; // Ganti dengan password database Anda
$database = "terranusa"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

session_start();

// Proses Login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action === 'login') {
        $email = $conn->real_escape_string($_POST['email']);
        $password = $conn->real_escape_string($_POST['password']);

        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                echo json_encode(['status' => 'success', 'message' => 'Login berhasil!', 'username' => $user['username']]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Password salah!']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Email tidak ditemukan!']);
        }
        exit;
    }

    // Proses Register
    if ($action === 'register') {
        $username = $conn->real_escape_string($_POST['username']);
        $email = $conn->real_escape_string($_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $checkEmail = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($checkEmail);

        if ($result->num_rows > 0) {
            echo json_encode(['status' => 'error', 'message' => 'Email sudah terdaftar!']);
        } else {
            $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
            if ($conn->query($sql) === TRUE) {
                echo json_encode(['status' => 'success', 'message' => 'Registrasi berhasil!']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Terjadi kesalahan saat registrasi.']);
            }
        }
        exit;
    }
}

$conn->close();
?>

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
                <li><a href="about.php" class="text-sm hover:text-tertiary relative py-1 after:content-[''] after:absolute after:left-0 after:bottom-0 after:w-0 after:h-0.5 after:bg-tertiary after:transition-all after:duration-300 hover:after:w-full">About</a></li>
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

<!-- Modal Login/Register -->
<div id="authModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 id="modalTitle" class="text-2xl font-bold text-primary">Masuk</h2>
            <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <form id="authForm" onsubmit="handleSubmit(event)" class="space-y-4">
            <!-- Input untuk email dan password -->
            <div id="usernameField" class="hidden">
                <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                <input type="text" id="username" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" id="email" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" id="password" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent">
            </div>
            <button type="submit" class="w-full bg-secondary text-white py-2 px-4 rounded-md hover:bg-opacity-90 transition">
                <span id="submitButtonText">Masuk</span>
            </button>
        </form>

        <!-- Social login -->
        <div class="relative flex items-center justify-center my-4">
            <div class="absolute border-t border-gray-300 w-full"></div>
            <span class="relative bg-white px-2 text-sm text-gray-500">atau lanjutkan dengan</span>
        </div>

        <div class="space-y-3">
            <button onclick="handleGoogleLogin()" class="w-full flex items-center justify-center gap-2 bg-white border border-gray-300 text-gray-700 py-2 px-4 rounded-md hover:bg-gray-50 transition">
                <!-- Google SVG -->
                <svg class="w-5 h-5" viewBox="0 0 24 24">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                    </svg>
                    Lanjutkan dengan Google
            </button>
            <button onclick="handleFacebookLogin()" class="w-full flex items-center justify-center gap-2 bg-[#1877F2] text-white py-2 px-4 rounded-md hover:bg-opacity-90 transition">
                <!-- Facebook SVG -->
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                    Lanjutkan dengan Facebook
            </button>
        </div>
    </div>
</div>
<!-- Spacer div -->
<div id="navbar-spacer" class="hidden"></div>


<script>
        // Navbar Scroll Functionality
        // Navbar Scroll Functionality
let lastScrollTop = 0;
const navbar = document.getElementById('navbar');
const navbarSpacer = document.getElementById('navbar-spacer');
const navbarHeight = navbar.offsetHeight;

// Set height for spacer based on navbar height
navbarSpacer.style.height = `${navbarHeight}px`;

window.addEventListener('scroll', () => {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    
    // When scrolled down
    if (scrollTop > 0) {
        navbar.classList.add('fixed', 'top-0', 'left-0', 'right-0', 'z-50', 'bg-primary/95', 'backdrop-blur-sm');
        navbarSpacer.classList.remove('hidden');
    } else {
        navbar.classList.remove('fixed', 'top-0', 'left-0', 'right-0', 'z-50', 'bg-primary/95', 'backdrop-blur-sm');
        navbarSpacer.classList.add('hidden');
    }
    
    // Hide navbar when scrolling down past navbar height
    if (scrollTop > lastScrollTop && scrollTop > navbarHeight) {
        navbar.classList.add('-translate-y-full');
    } else {
        navbar.classList.remove('-translate-y-full');
    }
    
    lastScrollTop = scrollTop;
});

// Open Modal for Login/Register
function openModal(type) {
    const modal = document.getElementById('authModal');
    const modalTitle = document.getElementById('modalTitle');
    const submitButtonText = document.getElementById('submitButtonText');
    const usernameField = document.getElementById('usernameField');
    
    if (type === 'login') {
        modalTitle.textContent = "Masuk";
        submitButtonText.textContent = "Masuk";
        usernameField.classList.add('hidden'); // Sembunyikan input username pada login
    } else if (type === 'register') {
        modalTitle.textContent = "Daftar";
        submitButtonText.textContent = "Daftar";
        usernameField.classList.remove('hidden'); // Tampilkan input username pada register
    }

    modal.classList.remove('hidden');  // Show the modal
}

// Close Modal
function closeModal() {
    const modal = document.getElementById('authModal');
    modal.classList.add('hidden');  // Hide the modal
}

// Handle Form Submission (Register/Login)
function handleSubmit(event) {
    event.preventDefault();
    
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const username = document.getElementById('username') ? document.getElementById('username').value : null;

    // Simulasi login/register
    if (username) {
        // Register logic
        localStorage.setItem('username', username);
        localStorage.setItem('profilePic', 'default-profile.png');
    } else {
        // Login logic (setelah login berhasil, user dapat langsung melihat profil)
        const storedUsername = localStorage.getItem('username');
        const storedProfilePic = localStorage.getItem('profilePic');
        displayUserInfo(storedUsername, storedProfilePic);
    }
    
    closeModal();
}

// Menampilkan Username dan Gambar Profil di Navbar
function displayUserInfo(username, profilePic) {
    document.getElementById('usernameDisplay').textContent = username;
    document.getElementById('userProfilePic').src = profilePic;

    // Menyembunyikan tombol login dan daftar setelah login berhasil
    document.getElementById('userSection').innerHTML = `
        <div class="flex items-center space-x-4">
            <img id="userProfilePic" src="${profilePic}" alt="Profile" class="h-8 w-8 rounded-full">
            <span id="usernameDisplay" class="text-sm font-semibold text-white">${username}</span>
        </div>
        <a href="logout.php" class="bg-secondary/80 hover:bg-secondary px-4 py-2 rounded text-white">Logout</a>
    `;
}

// Dummy functions for Google and Facebook Login
function handleGoogleLogin() {
    console.log('Google Login');
}

function handleFacebookLogin() {
    console.log('Facebook Login');
}


</script>