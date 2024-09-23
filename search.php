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

// Build the search query based on the form inputs
$query = "SELECT auto.rejstracja, auto.model, auto.marka, klient.imie, klient.nazwisko, klient.tel, naprawa.id_naprawa, naprawa.data, naprawa.zalecenia , naprawa.przebieg
          FROM auto 
          INNER JOIN klient ON auto.id_klient = klient.id_klient
          INNER JOIN naprawa ON auto.id_auto = naprawa.id_auto 
          WHERE 1=1";

// Check if any fields were filled out and add to the query
if (!empty($_GET['rejestracja'])) {
    $rejestracja = $conn->real_escape_string($_GET['rejestracja']);
    $query .= " AND auto.rejstracja LIKE '%$rejestracja%'";
}

if (!empty($_GET['przebieg'])) {
    $rejestracja = $conn->real_escape_string($_GET['przebieg']);
    $query .= " AND naprawa.przebieg LIKE '%$przebieg%'";
}

if (!empty($_GET['numertel'])) {
    $telefon = $conn->real_escape_string($_GET['numertel']);
    $query .= " AND klient.tel LIKE '%$telefon%'";
}

if (!empty($_GET['marka'])) {
    $marka = $conn->real_escape_string($_GET['marka']);
    $query .= " AND auto.marka LIKE '%$marka%'";
}

if (!empty($_GET['model'])) {
    $model = $conn->real_escape_string($_GET['model']);
    $query .= " AND auto.model LIKE '%$model%'";
}

if (!empty($_GET['imie'])) {
    $imie = $conn->real_escape_string($_GET['imie']);
    $query .= " AND klient.imie LIKE '%$imie%'";
}

if (!empty($_GET['nazwisko'])) {
    $nazwisko = $conn->real_escape_string($_GET['nazwisko']);
    $query .= " AND klient.nazwisko LIKE '%$nazwisko%'";
}

if (!empty($_GET['data'])) {
    $data = $conn->real_escape_string($_GET['data']);
    $query .= " AND naprawa.data = '$data'";
}

// Execute the search query
$result = $conn->query($query);

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wyniki wyszukiwania</title>
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

    <div class="container">
        <h1>Wyniki wyszukiwania</h1>

        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Numer rejestracyjny</th>
                        <th>Przebieg</th>
                        <th>Marka</th>
                        <th>Model</th>
                        <th>Imię</th>
                        <th>Nazwisko</th>
                        <th>Telefon</th>
                        <th>Data naprawy</th>
                        <th class="zalecenia">Zalecenia</th>
                        <th     colspan="3" >Opcje</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['rejstracja']); ?></td>
                            <td><?php echo htmlspecialchars($row['przebieg'])?></td>
                            <td><?php echo htmlspecialchars($row['marka']); ?></td>
                            <td><?php echo htmlspecialchars($row['model']); ?></td>
                            <td><?php echo htmlspecialchars($row['imie']); ?></td>
                            <td><?php echo htmlspecialchars($row['nazwisko']); ?></td>
                            <td><?php echo htmlspecialchars($row['tel']); ?></td>
                            <td><?php echo htmlspecialchars($row['data']); ?></td>
                            <td><?php echo htmlspecialchars($row['zalecenia']); ?></td>
                            <td> <a href="usun.php"> <button id="usun">Usuń</button> </a> </td>
                            <td> <a href="edytuj.php"> <button id="edytuj">Edytuj</button>  </a> </td>
                            <td> <a href="wyswietl.php"> <button id="wyswietl">Wyświetl</button>  </a> </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Brak wyników dla podanych kryteriów.</p>
        <?php endif; ?>

        <?php $conn->close(); ?>
    </div>

</body>
</html>
