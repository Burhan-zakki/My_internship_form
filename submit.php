<?php 
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "";

// Create a database connection
$conn = new mysqli($hostname, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$applying_for = $_POST['Apply']; // Corrected field name
$status = $_POST['status'];
    
// Upload file
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileInput"]["name"]);
$image_path = $target_file;
if (move_uploaded_file($_FILES["fileInput"]["tmp_name"], $target_file)) {

    // Insert data into the database
    $sql = "INSERT INTO my_form_internship (name, email, phone, address, applying_for, status, resume_file) VALUES ('$name', '$email', '$phone', '$address', '$applying_for', '$status', '$image_path')";

    if ($conn->query($sql) === TRUE) {
        echo "Form submitted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Error uploading file.";
}

// Close the database connection
$conn->close();
?>
