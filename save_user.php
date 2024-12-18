<?php
// Database connection variables
$host = 'localhost';
$port = 3307; // Change this to the correct port 
$db = 'medical';
$user = 'root';
$pass = ''; // No password for root in XAMPP

// Create a connection
$conn = new mysqli($host, $user, $pass, $db, $port);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is sent via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $email = $_POST['email'];
    $password = $_POST['password']; 

    // Insert data into the database
    $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password); // Bind the plain password

    if ($stmt->execute()) {
        // Redirect to home.html
        header("Location: home.html");
        exit(); // Ensure no further code is executed after redirection
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the connection
    $stmt->close();
}
$conn->close();
?>
