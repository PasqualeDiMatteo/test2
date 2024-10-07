<?php
require 'vendor/autoload.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test2";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifico la connessione
if ($conn->connect_error) {
    echo "Connessione fallita: " . $conn->connect_error;
    $conn->close();
}

$id_fattura = $_GET['id'];

$sql  = $conn->query("SELECT clienti.*, fatture.*
                            FROM fatture 
                            JOIN clienti ON fatture.cliente_id = clienti.id 
                            WHERE fatture.id = $id_fattura");
$fattura  = $sql->fetch_assoc();

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

//Fattura
$pdf->Cell(0, 10, "Fattura N. " . $fattura['id'], 0, 0, "C");
$pdf->Ln();
//Nome Cliente
$pdf->Cell(40, 10, "Cliente: " . $fattura['nome']);
$pdf->Ln();
//Indirizzo
$pdf->Cell(40, 10, "Indirizzo: " . $fattura['indirizzo']);
$pdf->Ln();
//Partita IVA
$pdf->Cell(100, 10, "Partita IVA: " . $fattura['partita_iva'], 0, 0, 'L');
//Data fattura
$pdf->Cell(0, 10, "Data: " . $fattura['data'], 0, 1, 'R');
$pdf->Ln();
//Riepilogo
$pdf->Cell(0, 10, "Riepilogo", 0, 0, "C");
$pdf->Ln();
//Descrizione
$pdf->Cell(40, 10, "Descrizione: " . $fattura['descrizione']);
$pdf->Ln();
//Quantita'
$pdf->Cell(50, 10, "Quantita': " . $fattura['quantita'], 0, 0, "L");
//Prezzo unitario
$pdf->Cell(50, 10, "Prezzo singolo: " . $fattura['prezzo_unitario'], 0, 0, "C");
//Subtotale
$pdf->Cell(90, 10, "Subtotale: " . $fattura['totale'], 0, 0, "R");
$pdf->Ln();
//Totale senza IVA
$pdf->Cell(0, 10, "Imponibile: " . $fattura['totale'] . "$", 0, 0, "R");
$pdf->Ln();
//IVA(22%)
$pdf->Cell(0, 5, "IVA(22%): " . $fattura['totale'] * 0.22 . "$", 0, 0, "R");
$pdf->Ln();
//Totale
$pdf->Cell(0, 10, "Totale: " . $fattura['totale'] * 1.22 . "$", 0, 0, "R");
$pdf->Output();
