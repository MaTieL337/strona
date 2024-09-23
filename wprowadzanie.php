<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gowna";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from form inputs
    $rejstracja = $conn->real_escape_string($_POST['rejestracja']);
    $przebieg = $conn->real_escape_string($_POST['przebieg']);
    $data = $conn->real_escape_string($_POST['data']);
    $imie = $conn->real_escape_string($_POST['imie']);
    $nazwisko = $conn->real_escape_string($_POST['nazwisko']);
    $telefon = $conn->real_escape_string($_POST['telefon']);
    $marka = $conn->real_escape_string($_POST['marka']);
    $model = $conn->real_escape_string($_POST['model']);
    $zalecenia = $conn->real_escape_string($_POST['zalecenia']);
    
    // Insert client data into 'klient' table
    $sql_klient = "INSERT INTO klient (imie, nazwisko, tel) VALUES ('$imie', '$nazwisko', '$telefon')";
    
    if ($conn->query($sql_klient) === TRUE) {
        $id_klient = $conn->insert_id; // Get the last inserted client ID

        // Insert car data into 'auto' table
        $sql_auto = "INSERT INTO auto (rejstracja, model, marka, id_klient) VALUES ('$rejstracja', '$model', '$marka', '$id_klient')";
        
        if ($conn->query($sql_auto) === TRUE) {
            $id_auto = $conn->insert_id; // Get the last inserted car ID
            
            // Insert repair data into 'naprawa' table
            $sql_naprawa = "INSERT INTO naprawa (id_auto, zalecenia, data, przebieg) VALUES ('$id_auto', '$zalecenia', '$data', '$przebieg')";
            
            if ($conn->query($sql_naprawa) === TRUE) {
                $id_naprawa = $conn->insert_id; // Get the last inserted repair ID
                
                // Insert repair costs (multiple repairs)
                $repair_names = $_POST['nazwa-naprawy'];
                $repair_prices = $_POST['cena'];
                
                foreach ($repair_names as $index => $repair_name) {
                    $cena = $repair_prices[$index];
                    
                    // Insert into 'cena' table
                    $sql_cena = "INSERT INTO cena (cena, naprawa) VALUES ('$cena', '$repair_name')";
                    
                    if ($conn->query($sql_cena) === TRUE) {
                        $id_cena = $conn->insert_id; // Get the last inserted price ID
                        
                        // Link repair and price in 'naprawa_cena' table
                        $sql_naprawa_cena = "INSERT INTO naprawa_cena (id_naprawa, id_cena) VALUES ('$id_naprawa', '$id_cena')";
                        $conn->query($sql_naprawa_cena);
                    }
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
                            <li><a href="wyszukajauto.html">Wyszukaj auto</a></li>
                            <li><a href="#">Wyświetl wszystkie samochody z ostatniego tygodnia</a></li>
                        </ul>
                    </nav>
                
                    <div class="content">
                        <h1>Dane wprowadzone</h1>
                        <p>Wybierz jedną z opcji w menu, aby przejść dalej.</p>
                    </div>
                
                </body>
                </html>
                ';
            } else {
                echo "Error inserting repair data: " . $conn->error;
            }
        } else {
            echo "Error inserting car data: " . $conn->error;
        }
    } else {
        echo "Error inserting client data: " . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
