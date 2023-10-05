<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список лидов</title>
    <link rel="stylesheet" href="styles.css"> <!-- Подключаем файл стилей CSS -->
</head>
<body>
<?php
$servername = "localhost";
$username = "vitaman_ph_o";
$password = "8hUi7K8AOA08DCrM";
$dbname = "vitaman_ph_o";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM leads";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>
    <tr>
        <th>ID</th>
        <th>Email</th>
        <th>Username</th>
        <th>Phone</th>
        <th>Persons</th>
        <th>Credit</th>
        <th>Consent</th>
        <th>Timestamp</th>
        <th>Status</th>
        <th>Comment</th>
        <th>Actions</th>
    </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>".$row["id"]."</td>
        <td>".$row["email"]."</td>
        <td>".$row["username"]."</td>
        <td>".$row["tel"]."</td>
        <td>".$row["persons"]."</td>
        <td>".$row["credit"]."</td>
        <td>".$row["consent"]."</td>
        <td>".$row["timestamp"]."</td>
        <td>".$row["status"]."</td>
        <td>".$row["comment"]."</td>
        <td>
            <div>
                <button onclick='makeCall(".$row["id"].")'>Дозвон</button>
                <button onclick='noAnswer(".$row["id"].")'>Не дозвон</button>
            </div>
            <div>
                <input type='text' id='comment_".$row["id"]."' placeholder='Комментарий'>
                <label for='comment_".$row["id"]."'>Комментарий</label>
                <button onclick='addComment(".$row["id"].")'>Добавить комментарий</button>
                <div id='comment_display_".$row["id"]."'>".$row["comment"]."</div>
            </div>
        </td>
        </tr>";
    }

    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>

    <style>
        /* Стили для таблицы лидов */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Стили для кнопок "Дозвон" и "Не дозвон" */
        button {
            padding: 5px 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

    </style>
    <script>
        function makeCall(id) {
            const comment = document.getElementById("comment_" + id).value;
            sendCallData(id, "Дозвон", comment);
        }

        function noAnswer(id) {
            const comment = document.getElementById("comment_" + id).value;
            sendCallData(id, "Не дозвон", comment);
        }

        async function sendCallData(id, status, comment) {
            const formData = new FormData();
            formData.append('id', id);
            formData.append('status', status);
            formData.append('comment', comment);

            try {
                const response = await fetch("update_status.php", {
                    method: "POST",
                    body: formData,
                });

                if (!response.ok) {
                    throw new Error("Произошла ошибка при обновлении статуса");
                }

                // Обработка успешного обновления статуса, если необходимо
            } catch (error) {
                console.error(error);
                // Обработка ошибок, если необходимо
            }
        }

        function addComment(id) {
            const commentInput = document.getElementById("comment_" + id);
            const commentDisplay = document.getElementById("comment_display_" + id);
            const comment = commentInput.value;

            // Отправка комментария на сервер
            sendCommentData(id, comment);

            // Отображение комментария в таблице
            commentDisplay.textContent = comment;

            // Очищаем поле ввода комментария
            commentInput.value = '';
        }

        async function sendCommentData(id, comment) {
            const formData = new FormData();
            formData.append('id', id);
            formData.append('comment', comment);

            try {
                const response = await fetch("update_comment.php", {
                    method: "POST",
                    body: formData,
                });

                if (!response.ok) {
                    throw new Error("Произошла ошибка при обновлении комментария");
                }

                // Обработка успешного обновления комментария, если необходимо
            } catch (error) {
                console.error(error);
                // Обработка ошибок, если необходимо
            }
        }
    </script>
</body>
</html>
