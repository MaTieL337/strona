<?php
// Database connection details
require_once('connect.php');

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$limit = 10; // Number of items per page
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$total_pages = 0;

// Build the search query based on the form inputs
$query = "SELECT auto.rejestracja, auto.model, auto.marka, klient.imie, klient.nazwisko, klient.tel, naprawa.id_naprawa, naprawa.data, naprawa.zalecenia , naprawa.przebieg
          FROM auto 
          INNER JOIN klient ON auto.klient = klient.id_klient
          INNER JOIN naprawa ON auto.id_auto = naprawa.auto 
          WHERE 1=1";

// Check if any fields were filled out and add to the query
if (!empty($_GET['rejestracja'])) {
    $rejestracja = $conn->real_escape_string($_GET['rejestracja']);
    $query .= " AND auto.rejestracja LIKE '%$rejestracja%'";
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

// TODO use this COUNT()
$result_count = $conn->query($query);
$total_rows = $result_count->num_rows;
$total_pages = ceil($total_rows / $limit);
$offset = ($page - 1) * $limit;

// Execute the search query
$query .= " ORDER BY naprawa.data DESC, naprawa.id_naprawa DESC LIMIT $limit OFFSET $offset";
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
            <li><a href="wyszukaj-auto.html">Wyszukaj auto</a></li>
            <li><a href="ostatni-tydzien.php">Wyświetl wszystkie samochody z ostatniego tygodnia</a></li>
        </ul>
    </nav>

    <main>
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
                        <th colspan="3">Opcje</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['rejestracja']); ?></td>
                            <td><?php echo htmlspecialchars($row['przebieg'])?></td>
                            <td><?php echo htmlspecialchars($row['marka']); ?></td>
                            <td><?php echo htmlspecialchars($row['model']); ?></td>
                            <td><?php echo htmlspecialchars($row['imie']); ?></td>
                            <td><?php echo htmlspecialchars($row['nazwisko']); ?></td>
                            <td><?php echo htmlspecialchars($row['tel']); ?></td>
                            <td><?php echo htmlspecialchars($row['data']); ?></td>
                            <td><?php echo htmlspecialchars($row['zalecenia']); ?></td>
                            <td> <form action="delete.php" method="post"> <input type="hidden" name="id" value="<?php echo $row['id_naprawa'] ?>"> <button class="usun">Usuń</button> </form> </td>
                            <td> <form action="edytuj-dane.php" method="post"> <input type="hidden" name="id" value="<?php echo $row['id_naprawa'] ?>"> <button class="edytuj">Edytuj</button>  </form> </td>
                            <td> <form action="display.php" target="_blank" method="get"> <input type="hidden" name="id" value="<?php echo $row['id_naprawa'] ?>"> <button class="wyswietl">Wyświetl</button>  </form> </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Brak wyników dla podanych kryteriów.</p>
        <?php endif; ?>

        <?php $conn->close(); ?>
    </main>

    <?php
    echo "<div class='pagination'>";
    if ($page > 1) {
        echo "<a href='" . $_SERVER['PHP_SELF'] . "?page=" . ($page - 1) . "'>Previous</a> ";
    }
    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == $page) {
            echo "<span class='current'>$i</span> ";
        } else {
            echo "<a href='" . $_SERVER['PHP_SELF'] . "?page=$i'>$i</a> ";
        }
    }
    if ($page < $total_pages) {
        echo "<a href='" . $_SERVER['PHP_SELF'] . "?page=" . ($page + 1) . "'>Next</a>";
    }
    echo "</div>";    
    ?>
</body>
</html>
