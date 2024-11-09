<?php
// Функція для завантаження логіну та паролю з текстового файлу
function get_credentials_from_file($filename) {
    // Читаємо вміст файлу
    $file_contents = file_get_contents($filename);
    // Розбиваємо вміст файлу за допомогою двокрапки
    list($login, $password) = explode(":", trim($file_contents));
    return ['login' => $login, 'password' => $password];
}

// Отримуємо правильні логін і пароль з файлу
$credentials = get_credentials_from_file('credentials.txt');
$correct_login = $credentials['login'];
$correct_password = $credentials['password'];

// Перевірка, чи була надіслана форма
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Отримуємо логін та пароль з форми
    $login = $_POST['login'];
    $password = $_POST['password'];
    
    // Перевірка, чи введені дані співпадають з правильними
    if ($login == $correct_login && $password == $correct_password) {
        $message = "<div class='message success'>Ви залогінені!</div>";
    } else {
        $message = "<div class='message error'>Невірний логін або пароль.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма логіну</title>
    <style>
        body {
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            box-sizing: border-box;
        }

        .container {
            background-color: white;
            border-radius: 6px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 410px;
        }

        h1 {
            text-align: center;
            color: #000;
        }

        label {
            font-size: 14px;
            color: #333;
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .message {
            padding: 10px;
            margin-top: 20px;
            border-radius: 5px;
            text-align: center;
        }

        .message.success {
            background-color: #d4edda;
            color: #155724;
        }

        .message.error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Вхід в систему</h1>

        <form method="POST">
            <label for="login">Логін:</label>
            <input type="text" id="login" name="login" required><br><br>
            
            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" required><br><br>
            
            <input type="submit" value="Увійти">

             <!-- Якщо є повідомлення, виводимо його над формою -->
             <?php if (isset($message)) { echo $message; } ?>
        </form>
        
    </div>
</body>
</html>
