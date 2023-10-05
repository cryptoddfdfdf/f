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
    $comment = $_POST["comment"];

    // Обновление комментария в базе данных
    $updateCommentSQL = "UPDATE leads SET comment='$comment' WHERE id='$id'";
    if ($conn->query($updateCommentSQL) === TRUE) {
        // Ваш код обработки успешного обновления комментария
        echo "Комментарий успешно обновлен";
    } else {
        echo "Ошибка при обновлении комментария: " . $conn->error;
    }

    $conn->close();
}
?>
