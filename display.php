<?php
  require('./fpdf/fpdf.php');
  require_once('connect.php');
    
  // Create connection
  $conn = new mysqli($host, $username, $password, $database);
  $cena = 0;
  
  // Check connection
  if ($conn->connect_error) {
    die("Błąd serwera: " . $conn->connect_error);
  }

  $query = "SELECT auto.rejestracja, auto.model, auto.marka, klient.imie, klient.nazwisko, klient.tel, naprawa.id_naprawa, naprawa.data, naprawa.zalecenia , naprawa.przebieg
          FROM auto 
          INNER JOIN klient ON auto.klient = klient.id_klient
          INNER JOIN naprawa ON auto.id_auto = naprawa.auto 
          WHERE naprawa.id_naprawa=1";

  $result = $conn->query($query);
  $row = $result->fetch_assoc();

  // Create pdf
  $pdf = new FPDF('P', 'mm', 'A4');
  
  // Add page
  $pdf->AddPage();

  // Heading
  $pdf->SetFont('Arial', 'B', 16);

  $pdf->Cell(71, 10, '', 0, 0);
  $pdf->Cell(59, 10, 'Rozliczenie', 0, 0);
  $pdf->Cell(59, 10, '', 0, 1);

  // Left bar
  $pdf->SetFont('Arial', 'B', 21);

  $pdf->Cell(71, 5, 'Klient', 0, 0);
  $pdf->Cell(59, 5, '', 0, 0);
  $pdf->Cell(59, 5, 'Details', 0, 1);
  
  $pdf->SetFont('Arial', '', 10);

  $pdf->Cell(130, 5, $row['imie']." ".$row['nazwisko'], 0, 0);
  $pdf->Cell(25, 5, 'Rejestracja:', 0, 0);
  $pdf->Cell(34, 5, $row['rejestracja'], 0, 1);

  $pdf->Cell(130, 5, 'Telefon: '.$row['tel'], 0, 0); // zrobić osobne rowy na Telefon: i {telefon}
  $pdf->Cell(25, 5, 'Data naprawy:', 0, 0);
  $pdf->Cell(34, 5, $row['data'], 0, 1);

  // $pdf->Cell(130, 5, '', 0, 0);
  // $pdf->Cell(25, 5, 'Invoice No:', 0, 0); 
  // $pdf->Cell(24, 5, 'ORD01', 0, 1);

  $pdf->SetFont('Arial', 'B', 15);
  $pdf->Cell(130, 5, 'Bill To:', 0, 0);
  $pdf->Cell(59, 5, '', 0, 0);
  $pdf->SetFont('Arial', 'B', 10);
  $pdf->Cell(189, 10, '', 0, 1);

  $pdf->Cell(50, 10, '', 0, 1);
  
  $pdf->SetFont('Arial', 'B', 10);
  
  $pdf->Cell(10, 6, 'Sl', 1, 0, 'C');
  $pdf->Cell(80, 6, 'Opis', 1, 0, 'C');
  $pdf->Cell(23, 6, 'Quantity', 1, 0, 'C');
  $pdf->Cell(30, 6, 'Cena', 1, 0, 'C');
  $pdf->Cell(20, 6, 'Total', 1, 0, 'C');
  $pdf->Cell(25, 6, 'Total', 1, 1, 'C');


  $pdf->SetFont('Arial', '', 10);
  for ($i = 0; $i <= 10; $i++) {
    $pdf->Cell(10, 6, '1', 1, 0);
    $pdf->Cell(80, 6, 'Product 1', 1, 0);
    $pdf->Cell(23, 6, '1', 1, 0, 'R');
    $pdf->Cell(30, 6, '15000.00', 1, 0, 'R');
    $pdf->Cell(20, 6, '100.00', 1, 0, 'R');
    $pdf->Cell(25, 6, '15100.00', 1, 1, 'R');
  }

  $pdf->Cell(118, 6, '', 0, 0);
  $pdf->Cell(25, 6, 'Suma', 0, 0);
  $pdf->Cell(45, 6, '15100.00', 1, 1, 'R');
  
  $pdf->Output();
  $conn->close();

echo $_GET['id'];
// https://youtu.be/n4u8mae859o?si=k502u5ggYIQbqPYB