<?php
session_start();

if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // username & password manual
    if ($user == "admin" && $pass == "123") {
        $_SESSION['login'] = true;

        header("Location: admin.php");
        exit;
    } else {
        echo "<script>alert('Username atau Password salah!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #880e4f; height: 100vh; display: flex; align-items: center; justify-content: center; }
        .login-card { background: white; border-radius: 20px; overflow: hidden; display: flex; width: 800px; height: 450px; }
        .login-left { background: #ad1457; color: white; flex: 1; padding: 40px; display: flex; flex-direction: column; justify-content: center; align-items: center; }
        .login-right { flex: 1.5; padding: 50px; }
        .btn-magenta { background: #d81b60; color: white; border-radius: 50px; }
    </style>
</head>
<body>
    <div class="login-card shadow-lg">
        <div class="login-left">
            <h2>HELLO!</h2>
            <p>Admin Maessar Bayan</p>
        </div>
        <div class="login-right">
            <div class="text-center mb-4">
                <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" width="70">
                <h4 class="mt-2 fw-bold">LOGIN</h4>
            </div>
           <form method="POST">
               <input type="text" name="username" class="form-control mb-3" placeholder="Username">
               <input type="password" name="password" class="form-control mb-3" placeholder="Password">
               <button type="submit" name="login" class="btn btn-magenta w-100">LOG IN</button>
             </form>
        </div>
    </div>
</body>
</html>