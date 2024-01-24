<?php
session_start();
include('db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION['username'] = $username;
        header("Location: home.php");
    } else {
        $error = "Invalid username or password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    <style>
        *{
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body>  
        <div class='flex justify-center'>
            <div class='p-10'>
                <h1 class='text-indigo-600 text-2xl'>Insta</h1>
                <div class='bg-indigo-600 w-5 h-1 rounded-full'></div>
            </div>
        </div>

        <div class='flex justify-center'>
            <form method="post" action="">
                <div>
                    <div class='flex justify-center'>
                        <label for="username" class='text-indigo-600'>Username</label>
                    </div>
                    <div class='flex justify-center'>
                        <input type="text" name="username" required class='border border-indigo-600 rounded-md pl-2 text-zinc-600'>
                    </div>
                </div>
                <br>
                <div>
                    <div class='flex justify-center'>
                        <label for="password" class='text-indigo-600'>Password</label>
                    </div>
                    <div class='flex justify-center'>
                        <input type="password" name="password" required class='border border-indigo-600 rounded-md pl-2 text-zinc-600'>
                    </div>
                </div>

                <div class='flex justify-center p-5'>
                <input type="submit" value="Login" class='bg-indigo-600 text-white px-5 rounded-md'>
                </div>
            </form>
        </div>
    
</body>
</html>