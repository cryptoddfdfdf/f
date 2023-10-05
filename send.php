<?php
$servername = "localhost"; // Имя сервера базы данных
$username = "vitaman_ph_o"; // Ваш логин
$password = "8hUi7K8AOA08DCrM"; // Ваш пароль
$dbname = "vitaman_ph_o"; // Имя базы данных

// Создание соединения с базой данных
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение данных из формы
$email = $_POST['email'];
$username = $_POST['username'];
$tel = $_POST['tel'];
$persons = $_POST['counter'];
$credit = isset($_POST['credit']) ? 1 : 0;
$consent = isset($_POST['consent']) ? 1 : 0;

// SQL-запрос для вставки данных в таблицу
$sql = "INSERT INTO leads (email, username, tel, persons, credit, consent) VALUES ('$email', '$username', '$tel', '$persons', '$credit', '$consent')";

if ($conn->query($sql) === TRUE) {
    echo "Данные успешно сохранены.";
} else {
    echo "Ошибка: " . $sql . "<br>" . $conn->error;
}

// Закрытие соединения с базой данных
$conn->close();
?>
