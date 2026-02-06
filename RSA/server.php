<?php
function mcdIterativo($a, $b) {
    $a = abs($a);
    $b = abs($b);
    while ($b != 0) {
        $t = $b;
        $b = $a % $b;
        $a = $t;
    }
    return $a;
}

$p = 61;
$q = 53;

$n = $p * $q;
$phi = ($p - 1) * ($q - 1);

$e = 3;
while (mcdIterativo($e, $phi) != 1) { $e++; }

$d = 1;
while (($e * $d) % $phi != 1) { $d++; }

file_put_contents("chiave_pubblica.json", json_encode(["e"=>$e,"n"=>$n]));
file_put_contents("chiave_privata.json", json_encode(["d"=>$d,"n"=>$n]));

$valori = explode(" ", $_POST["cifrato"]);

$testo = "";
foreach ($valori as $c) {
    $c = (int)$c;
    $m = 1;
    for ($i = 0; $i < $d; $i++) {
        $m = ($m * $c) % $n;
    }
    $testo .= chr($m);
}

echo "<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8'>
<title>RSA - Messaggio Decifrato</title>
</head>
<body>
<h2>Risultato RSA</h2>
<p><strong>Messaggio cifrato ricevuto:</strong> {$_POST['cifrato']}</p>
<p><strong>Messaggio decifrato:</strong> {$testo}</p>
<br>
<a href='index.html'>Torna al client</a>
</body>
</html>";
?>
