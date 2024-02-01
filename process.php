<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Получаем номер телефона из параметра запроса
    $phoneNumber = isset($_GET['phone']) ? $_GET['phone'] : '';

    // Функция для определения страны по номеру телефона
    function getCountryByPhoneNumber($phoneNumber) {
        $apiUrl = "https://ipinfo.io/{$phoneNumber}/json";
        $response = file_get_contents($apiUrl);

        if ($response) {
            $data = json_decode($response, true);
            return $data['country'];
        }

        return "Не удалось определить страну";
    }

    // Получаем страну по номеру телефона
    $country = getCountryByPhoneNumber($phoneNumber);

    // Выводим результат
    echo "Страна для номера телефона {$phoneNumber}: {$country}";
} else {
    // Если запрос не GET, перенаправляем на главную страницу
    header("Location: index.html");
    exit();
}
?>
