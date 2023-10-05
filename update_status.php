<?php
$servername = "localhost";
$username = "vitaman_ph_o";
$password = "8hUi7K8AOA08DCrM";
$dbname = "vitaman_ph_o";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $status = $_POST["status"];
    $comment = $_POST["comment"];

    // Обновление статуса в базе данных
    $updateStatusSQL = "UPDATE leads SET status='$status' WHERE id='$id'";
    if ($conn->query($updateStatusSQL) === TRUE) {
        // Ваш код обработки успешного обновления статуса
        echo "Статус успешно обновлен";
    } else {
        echo "Ошибка при обновлении статуса: " . $conn->error;
    }

    $conn->close();
}
?>
