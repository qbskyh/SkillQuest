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
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Хэшируем пароль для безопасности
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Вставка данных в базу данных
    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        echo "Регистрация прошла успешно!";
    } else {
        echo "Ошибка: " . $sql . "<br>" . $conn->error;
    }

    // Закрыть соединение
    $conn->close();
}
?>
