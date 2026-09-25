<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'database.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    if (!empty($username) && !empty($password)) {
        // Query database (handles both upper/lowercase column names)
        $query = "SELECT id, firstname, lastname FROM students WHERE Username = ? AND Password = ?";
        
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            $query = "SELECT id, firstname, lastname FROM students WHERE username = ? AND password = ?";
            $stmt = $conn->prepare($query);
        }

        if ($stmt) {
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $user = $result->fetch_assoc();
                
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['firstname'] . ' ' . $user['lastname'];

                header('Location: index.php');
                exit();
            } else {
                $error = "Invalid Username or Password!";
            }
            $stmt->close();
        } else {
            $error = "Database query error: " . $conn->error;
        }
    } else {
        $error = "Please fill in all fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Student Management</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Custom Stylesheet with Cache Busting -->
    <link rel="stylesheet" href="style.css?v=<?= time(); ?>">
</head>
<body class="login-body">

    <div class="login-wrapper">
        <div class="login-card">
            <h2 class="text-center mb-4">Student Login</h2>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger text-center py-2 mb-3" role="alert">
                    <?= htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <form action="login.php" method="POST">
                <div class="mb-3">
                    <label class="form-label" for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Enter Username" required>
                </div>

                <div class="mb-4">
                    <label class="form-label" for="password">Password</label>
                    <div class="password-input-group">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password" required>
                        <button type="button" class="password-toggle-btn" id="togglePassword" aria-label="Toggle password visibility">
                            <i class="bi bi-eye-slash" id="toggleIcon"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2">Login</button>
            </form>
        </div>
    </div>

    <!-- Password visibility toggle script -->
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        const toggleIcon = document.querySelector('#toggleIcon');

        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            
            toggleIcon.classList.toggle('bi-eye');
            toggleIcon.classList.toggle('bi-eye-slash');
        });
    </script>
</body>
</html>