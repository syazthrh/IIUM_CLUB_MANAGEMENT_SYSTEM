<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Details</title>
    <style>
        body {
            background-color: #d8a2d8;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .container {
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 5px;
            max-width: 1000px;
            margin: 50px auto;
            text-align: center;
        }

        h2 {
            color: #9146a4;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #b57edc;
            color: #fff;
        }

        button {
            background-color: #b57edc;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }

        button:hover {
            background-color: #9146a4;
        }

        a {
            text-decoration: none;
            color: #9146a4;
            font-weight: bold;
            margin-top: 10px;
            display: inline-block;
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
        <?php
        include("dbconnect.php");

        // Retrieve the program ID from the query parameter
        $programID = isset($_GET['program']) ? $_GET['program'] : '';

        // Query to fetch program details
        $queryProgram = "SELECT * FROM student_program WHERE ProgramID = '$programID'";
        $resultProgram = $conn->query($queryProgram);
        $rowProgram = $resultProgram->fetch_assoc();

        // Query to fetch list of students who joined the program from student_program table
        $queryStudents = "SELECT s.StudentID, s.Name, s.Email, s.Cont_Num, s.Kulliyyah, s.Committee
                        FROM student s
                        JOIN student_program sp ON s.StudentID = sp.StudentID
                        WHERE sp.ProgramID = '$programID'";
        $resultStudents = $conn->query($queryStudents);
        ?>

        <h2>List of Students</h2>

        <!-- Table to display list of students who joined the program -->
        <table>
    <tr>
        <th>Student ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Contact Number</th>
        <th>Kulliyyah</th>
        <th>Position</th>
        <th>Action</th> <!-- New column for the "Delete" button -->
    </tr>
    <?php
    while ($rowStudent = $resultStudents->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $rowStudent['StudentID'] . "</td>";
        echo "<td>" . $rowStudent['Name'] . "</td>";
        echo "<td>" . $rowStudent['Email'] . "</td>";
        echo "<td>" . $rowStudent['Cont_Num'] . "</td>";
        echo "<td>" . $rowStudent['Kulliyyah'] . "</td>";
        echo "<td>" . $rowStudent['Committee'] . "</td>";
        // Add the "Delete" button
        echo "<td><button onclick=\"deleteStudent('".$rowStudent['StudentID']."')\">Delete</button></td>";
        echo "</tr>";
    }
    ?>
</table>

<!-- Update List and Go Back buttons -->
<button onclick="window.location.href='updatelist.php?program=<?php echo $programID; ?>'">Update List</button>
<a href='javascript:history.go(-1)'>Go Back</a>

<script>
    function deleteStudent(studentID) {
        if (confirm("Are you sure you want to delete this student from the program?")) {
            // AJAX request to delete the student
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "program.php?program=<?php echo $programID; ?>&delete_student=" + studentID, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Reload the page after deletion
                    location.reload();
                }
            };
            xhr.send();
        }
    }
</script>

<?php
// Check if a student needs to be deleted
if (isset($_GET['delete_student'])) {
    $studentIDToDelete = $_GET['delete_student'];

    // Perform the deletion from student_program table
    $queryDelete = "DELETE FROM student_program WHERE ProgramID = '$programID' AND StudentID = '$studentIDToDelete'";
    $resultDelete = $conn->query($queryDelete);

    if ($resultDelete) {
        echo "<script>alert('Student deleted successfully.');</script>";
    } else {
        echo "<script>alert('Error deleting student: " . $conn->error . "');</script>";
    }
}
?>
</html>
