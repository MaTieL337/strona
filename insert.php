<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection details
    require_once('connect.php');
    
    // Create connection
    $conn = new mysqli($host, $username, $password, $database);
    
    // Check connection
    if ($conn->connect_error) {
        die("Błąd serwera: " . $conn->connect_error);
    }

    // Get data from form inputs
    // Klient
    $imie = $conn->real_escape_string($_POST['imie']);
    $nazwisko = $conn->real_escape_string($_POST['nazwisko']);
    $telefon = $conn->real_escape_string($_POST['telefon']);
    // Auto
    $rejestracja = $conn->real_escape_string($_POST['rejestracja']);
    $model = $conn->real_escape_string($_POST['model']);
    $marka = $conn->real_escape_string($_POST['marka']);
    // Naprawa
    $przebieg = $conn->real_escape_string($_POST['przebieg']);
    $data = $conn->real_escape_string($_POST['data']);
    $zalecenia = $conn->real_escape_string($_POST['zalecenia']);
    
    // Check if client exists
    $id_klient = null;
    $sql_check_klient = "SELECT * FROM klient WHERE imie = '$imie' AND nazwisko = '$nazwisko' AND tel = '$telefon'";
    $result = $conn->query($sql_check_klient);
    
    if (!$result) {
        die("Błąd zapytania: " . $conn->error);
    }

    if ($result->num_rows > 0) { // If exists, get the ID
        $row = $result->fetch_assoc();
        $id_klient = $row['id_klient'];
    } else { // If not, insert new client
        $sql_klient = "INSERT INTO klient (imie, nazwisko, tel) VALUES ('$imie', '$nazwisko', '$telefon')";

        if (!$conn->query($sql_klient)) {
            die("Błąd zapytania: " . $conn->error);
        }

        $id_klient = $conn->insert_id; // Get the last inserted client ID
    }
    
    // Check if car exists
    $id_auto = null;
    $sql_check_auto = "SELECT * FROM auto WHERE rejestracja = '$rejestracja' AND model = '$model' AND marka = '$marka' AND klient = '$id_klient'";
    $result = $conn->query($sql_check_auto);

    if (!$result) {
        die("Błąd zapytania: " . $conn->error);
    }

    if ($result->num_rows > 0) { // If exists, get the ID
        $row = $result->fetch_assoc();
        $id_auto = $row['id_auto'];
    } else { // If not, insert new car
        $sql_auto = "INSERT INTO auto (rejestracja, model, marka, klient) VALUES ('$rejestracja', '$model', '$marka', '$id_klient')";

        if (!$conn->query($sql_auto)) {
            die("Błąd zapytania: " . $conn->error);
        }

        $id_auto = $conn->insert_id; // Get the last inserted car ID
    }
    
    $sql_naprawa = "INSERT INTO naprawa (auto, zalecenia, data, przebieg) VALUES ('$id_auto', '$zalecenia', '$data', '$przebieg')";

    if (!$conn->query($sql_naprawa)) {
        die("Błąd zapytania: " . $conn->error);
    }

    $id_naprawa = $conn->insert_id; // Get the last inserted repair ID

    $repair_names = $_POST['nazwa-naprawy'];
    $repair_prices = $_POST['cena'];
    
    foreach ($repair_names as $index => $repair_name) {
        $cena = $repair_prices[$index];
        
        // Insert into 'cena' table
        $sql_cena = "INSERT INTO cena (naprawa, cena, opis) VALUES ('$id_naprawa', '$cena', '$repair_name')";
        $conn->query($sql_cena);
    }

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
            <h1>Dane wprowadzone</h1>
            <p>Wybierz jedną z opcji w menu, aby przejść dalej.</p>
        </div>
    
    </body>
    </html>
    ';
    
    $conn->close();
} else {
    header('Location: wprowadz-dane.html');
}