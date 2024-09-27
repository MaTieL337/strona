<?php
if (!isset($_POST['id'])) {
  header('Location: index.php');
}

// Database connection details
require_once('connect.php');

// Create connection
$conn = new mysqli($host, $username, $password, $database);


echo '<!DOCTYPE html>
    <html lang="pl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Baza Samochodów</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
    
        <nav>
            <ul>
                <li><a href="wprowadz-dane.html">Wprowadź dane auta</a></li>
                <li><a href="wyszukaj-auto.html">Wyszukaj auto</a></li>
                <li><a href="ostatni-tydzien.php">Wyświetl wszystkie samochody z ostatniego tygodnia</a></li>
            </ul>
        </nav>
    
        <div class="content">
            <h1>Dane Usunięte</h1>
            <p>Wybierz jedną z opcji w menu, aby przejść dalej.</p>
        </div>
    
    </body>
    </html>
    ';

$conn->close();
