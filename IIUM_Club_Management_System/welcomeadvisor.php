<?php
include("dbconnect.php");

$advisorID = isset($_GET['id']) ? $_GET['id'] : "your_supervisor_id";

// Query to fetch advisor details
$advisorQuery = "SELECT * FROM advisor WHERE StaffID = '$advisorID'";
$advisorResult = $conn->query($advisorQuery);


// Fetch advisor details
$advisor = $advisorResult->fetch_assoc();

// Query to fetch club details
$clubQuery = "SELECT * FROM club WHERE ClubID = '{$advisor['ClubID']}'";
$clubResult = $conn->query($clubQuery);

if (!$clubResult) {
    die("Error fetching club details: " . $conn->error);
}

$club = $clubResult->fetch_assoc();

// Query to fetch mainboard list linked with student table
$mainboardQuery = "SELECT s.StudentID, s.Name, s.Email, s.Cont_Num, s.Kulliyyah, m.position AS Committee
                   FROM mainboard m
                   JOIN student s ON m.StudentID = s.StudentID
                   WHERE m.ClubID = '{$advisor['ClubID']}'";
$mainboardResult = $conn->query($mainboardQuery);


// Query to fetch program details for the specific club
$programQuery = "SELECT * FROM program WHERE ClubID = '{$advisor['ClubID']}'";
$programResult = $conn->query($programQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Advisor</title>
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
        h2 {
            color: #9146a4;
        }
        p {
            color: #652c7a;
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
        <h2>Welcome, <?php echo $advisor['ClubName']; ?> Advisor!</h2>
        <p>Your Club: <?php echo $club['ClubName']; ?></p>
        <p>Club Details:</p>
        <table>
            <tr>
                <th>Club Name</th>
                <th>Number of Members</th>
                <th>Establishment Date</th>
            </tr>
            <tr>
                <td><?php echo $club['ClubName']; ?></td>
                <td><?php echo $club['NumOfMembers']; ?></td>
                <td><?php echo $club['EstablishmentDate']; ?></td>
            </tr>
        </table>
        <p>Mainboard List:</p>
        <table>
            <tr>
                <th>Student ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Contact Number</th>
                <th>Kulliyyah</th>
                <th>Level of Study</th>
            </tr>
            <?php
            while ($mainboard = $mainboardResult->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$mainboard['StudentID']}</td>";
                echo "<td>{$mainboard['Name']}</td>";
                echo "<td>{$mainboard['Email']}</td>";
                echo "<td>{$mainboard['Cont_Num']}</td>";
                echo "<td>{$mainboard['Kulliyyah']}</td>";
                echo "<td>{$mainboard['Committee']}</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <p>Program List:</p>
        <table>
            <tr>
                <th>Program Name</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Venue</th>
                <th>Details</th>
            </tr>
            <?php
            while ($program = $programResult->fetch_assoc()) {
                echo "<tr>";
                echo "<td><a href='program.php?program=" . $program['ProgramID'] . "'>" . $program['ProgramName'] . "</a></td>";
                echo "<td>{$program['StartDate']}</td>";
                echo "<td>{$program['EndDate']}</td>";
                echo "<td>{$program['Venue']}</td>";
                echo "<td>{$program['Details']}</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <a href='javascript:history.go(-1)'>Go Back</a>
    </div>
</body>
</html>
