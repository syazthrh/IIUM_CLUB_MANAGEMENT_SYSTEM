<?php
include("dbconnect.php");

// Retrieve student ID from the URL
$studentID = isset($_GET['id']) ? $_GET['id'] : "your_student_id";

// Query to fetch the list of clubs for the student
$query = "SELECT c.ClubName, c.NumOfMembers, c.EstablishmentDate, c.AdvisorName
          FROM club c
          JOIN mainboard m ON c.ClubID = m.ClubID
          WHERE m.StudentID = '$studentID'";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Student</title>
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
            max-width: 800px;
            margin: 50px auto;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #b57edc;
            color: #fff;
        }
        a {
            text-decoration: none;
            color: #9146a4;
            font-weight: bold;
        }
        a:hover {
            color: #652c7a;
        }

        form.logout-form {
            position: fixed;
            top: 10px;
            right : 10px;
        }

        button.logout-button {
            background-color: #b57edc;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button.logout-button:hover {
            background-color: #9146a4;
        }
</style>

    </style>
</head>
<body>

    <form class="logout-form" method="post" action="logout.php">
        <button class="logout-button" type="submit">Logout</button>
    </form>
        <div class="container">
        <h2>Your Clubs</h2>
        <table>
            <tr>
                <th>Club Name</th>
                <th>Number of Members</th>
                <th>Establishment Date</th>
                <th>Advisor Name</th>
            </tr>
            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td><a href='listprogram.php?club=" . $row['ClubName'] . "&id=$studentID'>" . $row['ClubName'] . "</a></td>";
                echo "<td>" . $row['NumOfMembers'] . "</td>";
                echo "<td>" . $row['EstablishmentDate'] . "</td>";
                echo "<td>" . $row['AdvisorName'] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <a href='javascript:history.go(-1)'>Go Back</a>
    </div>
</body>
</html>
