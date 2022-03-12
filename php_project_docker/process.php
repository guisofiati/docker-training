<?php

// pegar mensagem do POST que foi enviado no form
$message = $_POST["message"];

$files = scandir("./messages");
$num_files = count($files) - 2; // ele cria com . e ..
$fileName = "msg-{$num_files}.txt";

$file = fopen("./messages/{$fileName}", "x");

fwrite($file, $message);

fclose($file);

header("Location: index.php");