<?php
include("dbconnect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $id = $_POST["id"];
    $password = $_POST["password"];

    // Check mainboard credentials
    $mainboardQuery = "SELECT * FROM mainboard WHERE StudentID='$id' AND Password='$password'";
    $mainboardResult = $conn->query($mainboardQuery);

    if ($mainboardResult->num_rows > 0) {
        header("Location: welcomestudent.php?id=$id");  // Pass ID to the next page
        exit();
    }

    // Check advisor credentials
    $advisorQuery = "SELECT * FROM advisor WHERE StaffID='$id' AND Password='$password'";
    $advisorResult = $conn->query($advisorQuery);

    if ($advisorResult->num_rows > 0) {
        header("Location: welcomeadvisor.php?id=$id");  // Pass ID to the next page
        exit();
    }

    // Check admin credentials
    $adminQuery = "SELECT * FROM admin WHERE StaffID='$id' AND Password='$password'";
    $adminResult = $conn->query($adminQuery);

    if ($adminResult->num_rows > 0) {
        header("Location: welcomeadmin.php?id=$id");  // Pass ID to the next page
        exit();
    }

    // Invalid login
    echo "<script>alert('Invalid login credentials');</script>";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            background-color: #d8a2d8;
        }
        .container {
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 5px;
            max-width: 400px;
            margin: 50px auto;
            text-align: center;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }
        button {
            background-color: #b57edc;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #9146a4;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form method="post" action="">
            <input type="text" name="id" placeholder="Student ID or Staff ID" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
