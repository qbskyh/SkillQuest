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

    // Используем подготовленный запрос для предотвращения SQL инъекций
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    // Выполняем запрос
    if ($stmt->execute()) {
        echo "Регистрация прошла успешно!";
    } else {
        echo "Ошибка: " . $stmt->error;
    }

    // Закрытие запроса и соединения
    $stmt->close();
    $conn->close();
    if (password_verify($password, $row['password'])) {
        // Пароль верен
    } else {
        // Неверный пароль
    }
    session_start();
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    <form action="register.php" method="POST">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
    <!-- Остальные поля формы -->
</form>
session_start();
if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die("Ошибка CSRF. Попробуйте снова.");
}
<form action="register.php" method="POST">
    <!-- Ваши поля для регистрации -->
    <div class="g-recaptcha" data-sitekey="ВАШ_КЛЮЧ"></div>
    <button type="submit">Зарегистрироваться</button>
</form>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
$recaptcha_secret = 'ВАШ_СЕКРЕТНЫЙ_КЛЮЧ';
$recaptcha_response = $_POST['g-recaptcha-response'];
$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptcha_secret&response=$recaptcha_response");
$response_keys = json_decode($response, true);

if(intval($response_keys["success"]) !== 1) {
    echo "Пожалуйста, пройдите проверку reCAPTCHA.";
} else {
    echo "Успешно пройдено!";
}
        
}
?>
