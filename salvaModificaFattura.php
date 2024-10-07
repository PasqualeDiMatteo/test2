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
$id_fattura = $_POST['id_fattura'];

$statement = $conn->prepare("UPDATE fatture SET cliente_id = ?, data = ?, descrizione = ?, quantita = ?, prezzo_unitario = ?, totale = ? WHERE id = ?");

if ($statement) {
    $statement->bind_param(
        "issiddi",
        $cliente,
        $data,
        $descrizione,
        $quantita,
        $prezzo_unitario,
        $totale,
        $id_fattura
    );
    $statement->execute();
    echo "Fattura modificata con successo!";
    echo "<br><a href='index.php'>Torna alla lista delle fatture</a>";
}
