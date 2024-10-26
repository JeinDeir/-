<?php
$serverName = "DESKTOP-9N1TE4G\SQLEXPRESS"; 
$connectionOptions = array(
    "Database" => "OrdersDB",
    "Uid" => "имя_пользователя",
    "PWD" => "пароль"
);

// Установка соединения
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $orderDetails = $_POST['order'];

    $query = "INSERT INTO Orders (Name, Phone, Email, OrderDetails) VALUES (?, ?, ?, ?)";
    $params = array($name, $phone, $email, $orderDetails);
    $stmt = sqlsrv_query($conn, $query, $params);

    if ($stmt) {
        echo "Заказ успешно отправлен!";
    } else {
        echo "Ошибка: " . print_r(sqlsrv_errors(), true);
    }

    sqlsrv_free_stmt($stmt);
}
sqlsrv_close($conn);
?>
