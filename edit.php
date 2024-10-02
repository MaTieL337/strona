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
  $id_naprawa = $_POST['id'];
  $przebieg = $conn->real_escape_string($_POST['przebieg']);
  $data = $conn->real_escape_string($_POST['data']);
  $zalecenia = $conn->real_escape_string($_POST['zalecenia']);

  // Update for klient 
  $query = "UPDATE klient SET imie = '$imie', nazwisko = '$nazwisko', tel = '$telefon' WHERE id_klient = (SELECT klient FROM auto WHERE id_auto = (SELECT auto FROM naprawa WHERE id_naprawa = '$id_naprawa'))";
  $conn->query($query); 

  // Update for auto
  $query = "UPDATE auto SET rejestracja = '$rejestracja', model = '$model', marka = '$marka' WHERE id_auto = (SELECT auto FROM naprawa WHERE id_naprawa = '$id_naprawa')";
  $conn->query($query);

  // Update for naprawa 
  $query = "UPDATE naprawa SET przebieg = '$przebieg', data = '$data', zalecenia = '$zalecenia' WHERE id_naprawa = '$id_naprawa'";
  $conn->query($query);

  // Update for cena
  // Remove all
  $query = "DELETE FROM cena WHERE naprawa = '$id_naprawa'";
  $conn->query($query);

  // Add all again
  // ? Works ?
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
            <h1>Dane zaktualizowane</h1>
            <p>Wybierz jedną z opcji w menu, aby przejść dalej.</p>
        </div>
    
    </body>
    </html>
    ';

  $conn->close();
} else {
  header('Location: wprowadz-dane.html');
}