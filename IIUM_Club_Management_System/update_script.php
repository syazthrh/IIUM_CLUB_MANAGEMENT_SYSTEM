<?php
include("dbconnect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $studentID = $_POST['StudentID'];
    $name = $_POST['Name'];
    $email = $_POST['Email'];
    $contNum = $_POST['Cont_Num'];
    $kulliyyah = $_POST['Kulliyyah'];
    $committee = $_POST['Committee'];
    $programID = $_POST['ProgramID'];

    // Example: Update student table
    $updateStudentQuery = "UPDATE student SET 
                           Name = '$name', 
                           Email = '$email', 
                           Cont_Num = '$contNum', 
                           Kulliyyah = '$kulliyyah', 
                           Committee = '$committee' 
                           WHERE StudentID = '$studentID'";

    if ($conn->query($updateStudentQuery) === TRUE) {
        $programID = isset($_POST['Program']) ? $_POST['Program'] : '';
        $updateStudentProgramQuery = "INSERT INTO student_program (StudentID, ProgramID) 
                                      VALUES ('$studentID', '$programID')
                                      ON DUPLICATE KEY UPDATE ProgramID = '$programID'";

        if ($conn->query($updateStudentProgramQuery) === TRUE) {
            echo "Data updated successfully";
        } else {
            echo "Error updating student_program table: " . $conn->error;
        }
    } else {
        echo "Error updating student table: " . $conn->error;
    }
} else {
    echo "Invalid request";
}

$conn->close();
?>
