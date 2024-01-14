<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student Information</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5ebff; /* Lilac background color */
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            padding: 30px;
            border-radius: 10px;
            max-width: 400px;
            width: 100%;
            text-align: center;
            box-sizing: border-box;
        }

        h2 {
            color: #652c7a; /* Dark Lilac heading color */
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }

        label {
            margin-bottom: 10px;
            color: #652c7a; /* Dark Lilac label color */
            font-weight: bold;
            text-align: left;
            width: 100%;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            color: #333; /* Text color */
        }

        button {
            background-color: #9146a4; /* Lilac button color */
            color: #fff; /* Button text color */
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #652c7a; /* Dark Lilac button color on hover */
        }

        a {
            text-decoration: none;
            color: #652c7a; /* Dark Lilac link color */
            font-weight: bold;
            margin-top: 15px;
            display: inline-block;
            font-size: 14px;
        }

        a:hover {
            color: #4a225e; /* Darker Lilac link color on hover */
        }
    </style>
</head>
<body>
<div class="container">
        <h2>Update Student Information</h2>
        <form id="updateForm">
            <!-- Your form elements -->
            <label for="StudentID">Student ID:</label>
            <input type="text" id="StudentID" required>
            
            <label for="Name">Full Name:</label>
            <input type="text" id="Name" required>
            
            <label for="Email">Email:</label>
            <input type="email" id="Email" required>
            
            <label for="Cont_Num">Contact Number:</label>
            <input type="text" id="Cont_Num" required>
            
            <label for="Kulliyyah">Kulliyyah:</label>
            <input type="text" id="Kulliyyah" required>
            
            <label for="Committee">Committee Position:</label>
            <input type="text" id="Committee" required>
            
            <!-- The program ID is obtained from the query parameter -->
            <input type="hidden" id="ProgramID" value="<?php echo isset($_GET['program']) ? $_GET['program'] : ''; ?>">
            
            <!-- Additional hidden fields if needed -->
            <!-- <input type="hidden" id="ClubID" value="<?php // echo $clubID; ?>"> -->

            <button type="button" onclick="submitForm()">Submit</button>
        </form>
        <a href="javascript:history.go(-1)">Go Back</a>

        <div id="successMessage" style="color: green; margin-top: 15px; display: none;">
            Data updated successfully!
        </div>
    </div>
    </div>

    <script>
    function submitForm() {
        // Get values from form
        var studentID = document.getElementById('StudentID').value;
        var name = document.getElementById('Name').value;
        var email = document.getElementById('Email').value;
        var contNum = document.getElementById('Cont_Num').value;
        var kulliyyah = document.getElementById('Kulliyyah').value;
        var committee = document.getElementById('Committee').value;
        var programID = document.getElementById('ProgramID').value;

        // Validate and process the data as needed
        console.log("StudentID:", studentID);
        console.log("Name:", name);
        console.log("Email:", email);
        console.log("Cont_Num:", contNum);
        console.log("Kulliyyah:", kulliyyah);
        console.log("Committee:", committee);
        console.log("ProgramID:", programID);

        // AJAX request to update tables
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    // Handle the response if needed
                    console.log(xhr.responseText);
                    // Optionally redirect based on the response
                    // window.location.href = 'your_redirect_page.php';
                } else {
                    console.error("Error: " + xhr.status);
                }
            }
        };

        var url = '<?php echo $_SERVER["PHP_SELF"]; ?>'; // Same page
        var params = 'action=update&StudentID=' + studentID + '&Name=' + name + '&Email=' + email +
                      '&Cont_Num=' + contNum + '&Kulliyyah=' + kulliyyah + '&Committee=' + committee +
                      '&ProgramID=' + programID;

        xhr.open('POST', url, true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(params);

        showSuccessMessage();
        }

        function showSuccessMessage() {
            // Display the success message
            var successMessage = document.getElementById('successMessage');
            successMessage.style.display = 'block';
    }
</script>
</body>
</html>

<?php
include("dbconnect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'update') {
    // Retrieve form data
    $studentID = $_POST['StudentID'];
    $name = $_POST['Name'];
    $email = $_POST['Email'];
    $contNum = $_POST['Cont_Num'];
    $kulliyyah = $_POST['Kulliyyah'];
    $committee = $_POST['Committee'];
    $programID = $_POST['ProgramID'];

    try {
        // Start a transaction
        $conn->begin_transaction();

        // Check if the student exists in the student table
        $checkStudentQuery = "SELECT * FROM student WHERE StudentID = '$studentID'";
        $result = $conn->query($checkStudentQuery);

        if ($result->num_rows == 0) {
            // If the student doesn't exist, insert a new row
            // Also, fetch ProgramName from the program table based on ProgramID
            $insertStudentQuery = "INSERT INTO student (StudentID, Name, Email, Cont_Num, Kulliyyah, Committee, ProgramName) 
                                   SELECT '$studentID', '$name', '$email', '$contNum', '$kulliyyah', '$committee', program.ProgramName
                                   FROM program
                                   WHERE program.ProgramID = '$programID'";

            if ($conn->query($insertStudentQuery) === FALSE) {
                throw new Exception("Error inserting new row in student table: " . $conn->error);
            }
        } else {
            // If the student exists, update the existing row
            $updateStudentQuery = "UPDATE student s
                       JOIN student_program sp ON s.StudentID = sp.StudentID
                       JOIN program p ON sp.ProgramID = p.ProgramID
                       SET 
                       s.Name = '$name', 
                       s.Email = '$email', 
                       s.Cont_Num = '$contNum', 
                       s.Kulliyyah = '$kulliyyah', 
                       s.Committee = '$committee',
                       s.ProgramName = p.ProgramName
                       WHERE s.StudentID = '$studentID'";



            if ($conn->query($updateStudentQuery) === FALSE) {
                throw new Exception("Error updating existing row in student table: " . $conn->error);
            }
        }

        // Example: Insert/update student_program table
        // Also, fetch ClubID from the program and student_program tables based on ProgramID
        $updateStudentProgramQuery = "INSERT INTO student_program (StudentID, ProgramID, ClubID) 
                                      SELECT '$studentID', '$programID', program.ClubID
                                      FROM program
                                      WHERE program.ProgramID = '$programID'
                                      ON DUPLICATE KEY UPDATE ClubID = program.ClubID";

        if ($conn->query($updateStudentProgramQuery) === FALSE) {
            throw new Exception("Error updating student_program table: " . $conn->error);
        }

        // Commit the transaction if everything is successful
        $conn->commit();

        echo "Data updated successfully";
    } catch (Exception $e) {
        // Roll back the transaction if an error occurred
        $conn->rollback();

        echo "Transaction failed: " . $e->getMessage();
    }
}   

$conn->close();
?>
