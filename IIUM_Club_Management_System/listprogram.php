<?php
include("dbconnect.php");

// Retrieve the club name from the query parameter
$clubName = isset($_GET['club']) ? $_GET['club'] : '';

// Query to fetch all programs for the given club
$query = "SELECT * FROM program WHERE ClubID IN (SELECT ClubID FROM club WHERE ClubName = '$clubName')";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Programs</title>
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
        right: 10px;
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
</head>
<body>
    <form class="logout-form" method="post" action="logout.php">
        <button class="logout-button" type="submit">Logout</button>
    </form>
    <div class="container">
        <h2>Programs for <?php echo $clubName; ?></h2>
        <table>
            <tr>
                <th>Program Name</th>
                <th>Program Start Date</th>
                <th>Program End Date</th>
                <th>Venue</th>
                <th>Details</th>
            </tr>
            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td><a href='program.php?program=" . $row['ProgramID'] . "'>" . $row['ProgramName'] . "</a></td>";
                echo "<td>" . $row['StartDate'] . "</td>";
                echo "<td>" . $row['EndDate'] . "</td>";
                echo "<td>" . $row['Venue'] . "</td>";
                echo "<td>" . $row['Details'] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <a href='javascript:history.go(-1)'>Go Back</a>
    </div>
</body>
</html>
