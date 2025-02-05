<?php
// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "skillquest";

// Создаем соединение с базой данных
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Проверка, если форма была отправлена
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Запрос на проверку пользователя
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Пользователь найден
        $row = $result->fetch_assoc();

        // Проверка пароля
        if (password_verify($password, $row['password'])) {
            echo "Добро пожаловать, " . $row['username'] . "!";
            // Здесь можно начать сессию или перенаправить на личную страницу
        } else {
            echo "Неверный пароль!";
        }
    } else {
        echo "Пользователь не найден!";
    }

    // Закрыть соединение
    $conn->close();
}
?>
