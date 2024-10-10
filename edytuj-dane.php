<?php
// Database connection details
require_once('connect.php');

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Query for getting main data
$query = "SELECT auto.rejestracja, auto.model, auto.marka, klient.imie, klient.nazwisko, klient.tel, naprawa.id_naprawa, naprawa.data, naprawa.zalecenia , naprawa.przebieg
  FROM auto 
  INNER JOIN klient ON auto.klient = klient.id_klient
  INNER JOIN naprawa ON auto.id_auto = naprawa.auto 
  WHERE naprawa.id_naprawa = " . $_POST['id'];

$result = $conn->query($query);
$row = $result->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edytowanie danych</title>
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
        <h1>Edytuj dane auta</h1>

        <form action="edit.php" method="post">
            <input type="hidden" name="id" value="<?php echo $_POST['id'] ?>"> <!-- Id naprawy -->

            <label for="rejestracja">Numer rejestracyjny:</label>
            <input type="text" id="rejestracja" value="<?php echo $row['rejestracja'] ?>" name="rejestracja">

            <label for="data">Data:</label>
            <input type="date" id="data" value="<?php echo $row['data'] ?>" name="data" >
            
            <label for="przebieg">Przebieg:</label>
            <input type="text" id="przebieg" value="<?php echo $row['przebieg'] ?>" name="przebieg" >
            
            <label for="imie">Imię:</label>
            <input type="text" id="imie" value="<?php echo $row['imie']; ?>" name="imie" >

            <label for="nazwisko">Nazwisko:</label>
            <input type="text" id="nazwisko" value="<?php echo $row['nazwisko']; ?>" name="nazwisko" >

            <label for="telefon">Telefon:</label>
            <input type="text" id="telefon" value="<?php echo $row['tel']; ?>" name="telefon" >

            <label for="marka">Marka:</label>
            <input type="text" id="marka" value="<?php echo $row['marka']; ?>" name="marka" >

            <label for="model">Model:</label>
            <input type="text" id="model" value="<?php echo $row['model']; ?>" name="model" >

            <!-- Sekcja dla napraw -->
            <div id="repair-sections">
                <?php
                    $query = "SELECT id_cena, opis, cena FROM cena WHERE naprawa = " . $_POST['id'];

                    $result = $conn->query($query); 
                    $i=1; 
                ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="repair-section">
                        <div class="form-row">
                            <div>
                                <label for="nazwa-naprawy-<?php echo $i; ?>">Nazwa naprawy:</label>
                                <input type="text" id="nazwa-naprawy-<?php echo $i; ?>" value="<?php echo $row['opis']; ?>" name="nazwa-naprawy[]" >
                            </div>
                            <div class="price-container">
                                <label for="cena-<?php echo $i; ?>">Cena:</label>
                                <input type="number" id="cena-<?php echo $i; ?>" value="<?php echo $row['cena']; ?>" name="cena[]" max="10000" >
                            </div>
                            <button type="button" class="remove-repair-btn" onclick="removeRepairSection(this)"><b>X</b></button>
                        </div>
                    </div>
                    <?php $i++; ?>
                <?php endwhile; ?>
            </div>

            <button type="button" class="add-repair-btn" onclick="addRepairSection()">Dodaj kolejną naprawę</button>

            <label for="zalecenia">Zalecenia:</label>
            <textarea id="zalecenia" name="zalecenia" rows="7"></textarea>

            <button type="submit" id="dane">Zapisz edycje</button>
        </form>
    </main>

    <script>
        let repairCount = 1;

        function addRepairSection() {
            repairCount++;

            const repairSection = document.createElement('div');
            repairSection.className = 'repair-section';

            repairSection.innerHTML = `
                <div class="form-row">
                    <div class repair-container>
                        <label for="nazwa-naprawy-${repairCount}">Nazwa naprawy:</label>
                        <input type="text" id="nazwa-naprawy-${repairCount}" name="nazwa-naprawy[]" >
                    </div>
                    <div class="price-container">
                        <label for="cena-${repairCount}">Cena:</label>
                        <input type="number" id="cena-${repairCount}" name="cena[]" >
                    </div>
                    <button type="button" class="remove-repair-btn" onclick="removeRepairSection(this)"><b>X</b></button>
                </div>
            `;

            document.getElementById('repair-sections').appendChild(repairSection);
        }

        function removeRepairSection(button) {
            const section = button.closest('.repair-section');
            section.remove();
        }
    </script>
</body>
</html>
<?php $conn->close(); ?>