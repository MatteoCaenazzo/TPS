<?php

$chiave = json_decode(file_get_contents("chiave_privata.json"), true);

$d = $chiave["d"];
$n = $chiave["n"];

$c = $_POST["cifrato"];

$m = 1;
for ($i = 0; $i < $d; $i++) {
    $m = ($m * $c) % $n;
}

echo "Messaggio decifrato: " . $m

?>
