<?php
session_start();

header('Content-Type: application/json');

try {
    $authType = $_POST['authType'] ?? '';
    
    // Proses login/register sesuai dengan authType
    if ($authType === 'login') {
        // Proses login
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        
        // Lakukan validasi dan autentikasi
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['profile_image'] = $user['profile_image'];
            header("Location: index.php");
        } else {
            $_SESSION['error'] = "Invalid credentials";
            header("Location: index.php");
        }
    }
        
        if (/* login berhasil */) {
            $_SESSION['user_id'] = $userId;
            $_SESSION['username'] = $username;
            $_SESSION['profile_image'] = $profileImage;
            
            echo json_encode([
                'success' => true,
                'username' => $username,
                'profileImage' => $profileImage
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid email or password'
            ]);
        }
    } 
    elseif ($authType === 'register') {
        // Proses register
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        
        // Lakukan validasi dan registrasi
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);
        
        if ($stmt->execute()) {
            $_SESSION['user_id'] = $stmt->insert_id;
            $_SESSION['username'] = $username;
            header("Location: index.php");
        } else {
            $_SESSION['error'] = "Registration failed";
            header("Location: index.php");
        }
        
        if (/* registrasi berhasil */) {
            $_SESSION['user_id'] = $newUserId;
            $_SESSION['username'] = $username;
            $_SESSION['profile_image'] = 'default-profile.png';
            
            echo json_encode([
                'success' => true,
                'username' => $username,
                'profileImage' => 'default-profile.png'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Registration failed'
            ]);
        }
    }
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'An error occurred'
    ]);
}