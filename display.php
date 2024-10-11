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
          WHERE naprawa.id_naprawa=".$_GET['id'];

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
  $pdf->Cell(59, 5, 'Szczegóły', 0, 1);
  
  $pdf->SetFont('Arial', '', 10);

  $pdf->Cell(130, 5, $row['imie'], 0, 0);
  $pdf->Cell(25, 5, 'Rejestracja: '.$row['rejestracja'], 0, 0);
  $pdf->Cell(34, 5, '', 0, 1);

  $pdf->Cell(130, 5, $row['nazwisko'], 0, 0); // zrobić osobne rowy na Telefon: i {telefon}
  $pdf->Cell(25, 5, 'Model: '.$row['model'], 0, 0);
  $pdf->Cell(34, 5, '', 0, 1);

  $pdf->Cell(130, 5, 'Telefon: '.$row['tel'], 0, 0);
  $pdf->Cell(25, 5, 'Marka: '.$row['marka'], 0, 0); 
  $pdf->Cell(24, 5, '', 0, 1);
  
  $pdf->Cell(130, 5, 'Data: '.$row['data'], 0, 0);
  $pdf->Cell(25, 5, 'Przebieg: '.$row['przebieg'], 0, 0); 
  $pdf->Cell(24, 5, '', 0, 1);

  $pdf->SetFont('Arial', 'B', 15);
  $pdf->Cell(130, 5, '', 0, 0);
  $pdf->Cell(59, 5, '', 0, 0);
  $pdf->SetFont('Arial', 'B', 10);
  $pdf->Cell(189, 10, '', 0, 1);

  $pdf->Cell(50, 10, '', 0, 1);
  
  $pdf->SetFont('Arial', 'B', 10);
  
  $pdf->Cell(10, 6, 'Lp.', 1, 0, 'C');
  $pdf->Cell(133, 6, 'Opis', 1, 0, 'C');
  $pdf->Cell(45, 6, 'Cena', 1, 0, 'C');
  $pdf->Cell(0, 6, '', 0, 1, 'C');

  $query = "SELECT * FROM cena WHERE naprawa = ".$_GET['id'];
  $result = $conn->query($query);
  $i = 1;

  $pdf->SetFont('Arial', '', 10);
  while ($row = $result->fetch_assoc()) {
    $pdf->Cell(10, 6, $i, 1, 0);
    $pdf->Cell(133, 6, $row['opis'], 1, 0);
    $pdf->Cell(45, 6, $row['cena'], 1, 1, 'R');
    $i++;
    $cena+=$row['cena'];
  }

  $pdf->Cell(131, 6, '', 0, 0);
  $pdf->Cell(12, 6, 'Suma', 1, 0);
  $pdf->Cell(45, 6, $cena, 1, 1, 'R');
  
  $pdf->Output();
  $conn->close();

echo $_GET['id'];
// https://youtu.be/n4u8mae859o?si=k502u5ggYIQbqPYB