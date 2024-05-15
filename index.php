<?php
    session_start();

    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
        header("Location: success.php");
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $_SESSION['logged_in'] = true;

        header("Location: success.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 h-screen flex justify-center items-center">
    <div class="max-w-md w-full p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-4">Web Scrapping</h2>

        <?php
        if (isset($_GET['error']) && $_GET['error'] == 1) {
            echo '<script>alert("Invalid email or password. Please try again.");</script>';
        }
        ?>

        <form action="./functions/login.php" method="post">
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email:</label>
                <input type="text" id="email" name="email" class="mt-1 p-2 w-full border rounded-md">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password:</label>
                <input type="password" id="password" name="password" class="mt-1 p-2 w-full border rounded-md">
            </div>
            <div class="mt-4">
                <input type="submit" value="Login" class="px-4 py-2 bg-blue-500 text-white rounded-md cursor-pointer">
            </div>

            <div class="mt-1">
                <small>Don't have an account? click <a href="./register.html" style="color:red;">here</a> to register.</small>
            </div>
        </form>
    </div>
</body>
</html>
