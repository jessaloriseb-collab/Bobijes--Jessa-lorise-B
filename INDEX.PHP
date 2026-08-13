<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="2style.css">
</head>
<body>
    <div class="container">
        <form action="check.php" method="post">
            <h1>LOGIN FORM</h1>

            <div class="input-box">
                <input type="text" placeholder="Username" name="username">
            </div>

            <div class="input-box">
                <input type="password" placeholder="Password" name="password">
                <i class="bx bx-lock-alt"></i>
            </div>

            <div class="remember-forget">
                <label><input type="checkbox"> Remember Me</label>
                <a href="#">Forgot Password?</a>
            </div>

            <div>
                <button>LOGIN</button>

                <div class="register-link">
                    <p>Don't have an account? <a href="#">Register</a></p>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
