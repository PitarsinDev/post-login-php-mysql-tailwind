<?php
session_start();
include('db_connect.php');

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $post_text = mysqli_real_escape_string($conn, $_POST['post_text']);
    $username = $_SESSION['username'];
    $image_url = $_POST['image_url'];

    $sql = "INSERT INTO posts (username, post_text, image_url) VALUES ('$username', '$post_text', '$image_url')";
    $conn->query($sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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

        <div class='flex justify-center p-10'>
            <form method="post" action="" class='bg-indigo-600 text-white p-2 rounded-md shadow-md'>
                <div class='flex gap-2'>
                    <label for="post_text">Post :</label>
                    <textarea name="post_text" required class='rounded-md pl-2'></textarea>
                </div>
                <br>
                <div class='flex gap-2'>
                    <label for="image_url">Image URL :</label>
                    <input type="text" name="image_url" required class='rounded-md pl-2'>
                </div>

                <input type="submit" value="Post" class='bg-white text-indigo-600 px-5 rounded-md shadow-md'>
            </form>
        </div>
        <?php
        $sql = "SELECT * FROM posts";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            echo "<div class='flex justify-center'>";
            echo "<div class='bg-zinc-50 p-2 rounded-md shadow-md'>";
            echo "<p class='text-indigo-600 text-xs'>" . $row['username'] . "</p>";
            echo "<p>" . $row['post_text'] . "</p>";
            echo "<img class='w-40 rounded-md' src='" . $row['image_url'] . "'>";
            echo "</div>";
            echo "</div>";
        }
        ?>
    
</body>
</html>