<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <title>Client SOAP - Conversione Metri / Pollici</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    
</head>

<body class="container mt-5">

    <h2 class="mb-4">Conversione Metri ↔ Pollici (SOAP)</h2>

    <form method="POST" action="" class="form-inline">
        <div class="form-group mb-2 mr-2">
            <input type="number" step="any" name="valore" class="form-control" placeholder="Inserisci valore" required>
        </div>

        <div class="form-group mb-2 mr-2">
            <select name="operazione" class="form-control" required>
                <option value="metriToPollici">Metri → Pollici</option>
                <option value="polliciToMetri">Pollici → Metri</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mb-2">Converti</button>
    </form>

    <?php
// ===== CLIENT SOAP =====

$wsdl_url = "http://127.0.0.1/WSDL/test.wsdl";

if (isset($_POST['valore'], $_POST['operazione'])) {

    try {
        $valore = $_POST['valore'];
        $operazione = $_POST['operazione'];

        $client = new SoapClient($wsdl_url);

        if ($operazione === "metriToPollici") {
            $risultato = $client->metriToPollici($valore);
            echo "<div class='alert alert-success mt-4'>
                    <strong>$valore</strong> metri = <strong>$risultato</strong> pollici
                </div>";
        }

        if ($operazione === "polliciToMetri") {
            $risultato = $client->polliciToMetri($valore);
            echo "<div class='alert alert-success mt-4'>
                    <strong>$valore</strong> pollici = <strong>$risultato</strong> metri
                </div>";
        }

    } catch (SoapFault $e) {
        echo "<div class='alert alert-danger mt-4'>
                Errore SOAP: {$e->getMessage()}
            </div>";
    }
}
?>

</body>

</html>