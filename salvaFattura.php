<?php
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

$cliente = $_POST['cliente'];
$descrizione = $_POST['descrizione'];
$quantita = $_POST['quantita'];
$prezzo_unitario = $_POST['prezzo_unitario'];
$totale = $quantita * $prezzo_unitario;
$data = date('Y-m-d');

$statement = $conn->prepare("INSERT INTO fatture (cliente_id, data, descrizione, quantita, prezzo_unitario, totale) VALUES (?,?,?,?,?,?)");

if ($statement) {
    // Inserimento della fattura
    $statement->bind_param(
        "issidd",
        $cliente,
        $data,
        $descrizione,
        $quantita,
        $prezzo_unitario,
        $totale
    );
    $statement->execute();
    echo "Fattura salvata con successo!";
    echo "<br><a href='index.php'>Torna alla lista delle fatture</a>";
}
