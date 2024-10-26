<?php
// 1. Параметры для подключения к базе данных SQL Server
$serverName = "localhost"; // Имя сервера SQL
$connectionOptions = array(
    "Database" => "confectionery_orders", // Имя базы данных
    "Uid" => "root", // Имя пользователя базы данных
    "PWD" => "" // Пароль пользователя
);

// 2. Устанавливаем соединение
$conn = sqlsrv_connect($serverName, $connectionOptions);

// 3. Проверка соединения
if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

// 4. Получение данных из формы
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$order_details = $_POST['order_details'];

// 5. SQL-запрос для вставки данных в таблицу
$sql = "INSERT INTO orders (name, phone, email, order_details) VALUES (?, ?, ?, ?)";

// 6. Подготовка и выполнение запроса
$params = array($name, $phone, $email, $order_details);
$stmt = sqlsrv_query($conn, $sql, $params);

// 7. Проверка выполнения запроса
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
} else {
    echo "Заявка успешно отправлена!";
}

// 8. Закрытие соединения
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>
