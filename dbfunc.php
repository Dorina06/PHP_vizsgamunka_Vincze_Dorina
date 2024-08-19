<?php

include 'dbconfig.php';


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Adatainak kinyerése
    $first_name = $conn->real_escape_string($_POST['first_name']);
    $last_name = $conn->real_escape_string($_POST['last_name']);
    $room_number = $conn->real_escape_string($_POST['room_number']);
    $email = $conn->real_escape_string($_POST['email']);
    $date = $conn->real_escape_string($_POST['date']);
    $clean = isset($_POST['clean']) ? (int)$_POST['clean'] : null;
    $comfort = isset($_POST['comfort']) ? (int)$_POST['comfort'] : null;
    $supply = isset($_POST['service_quality']) ? (int)$_POST['service_quality'] : null;
    $staff = isset($_POST['staff']) ? (int)$_POST['staff'] : null;
    $value = isset($_POST['value']) ? (int)$_POST['value'] : null;
    $response = $conn->real_escape_string($_POST['response']);

    
    $sql = "INSERT INTO responses (first_name, last_name, room_number, email, date, clean, comfort, supply, staff, value, response) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssiiiiis", $first_name, $last_name, $room_number, $email, $date, $clean, $comfort, $supply, $staff, $value, $response);

    if ($stmt->execute()) {
        echo "Köszönjük, hogy kitöltötte az űrlapot!";
    } else {
        echo "Hiba történt: " . $stmt->error;
    }

    
    $stmt->close();
    $conn->close();
} else {
    echo "Kérjük, töltse ki az űrlapot!";
}



?>
