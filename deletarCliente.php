<?php

require 'classes/bancoDeDados/Cliente.php';

$codigo = $_GET['codigo'];

$c = new Cliente();

$c->deletarCliente($codigo);

?>

<script>

    sessionStorage.setItem("clienteDeletado", "true");

    var urlQuery = <?= json_encode($_GET) ?>; // Criando um objeto JSON a partir das variáveis no GET

    if (Object.keys(urlQuery).length > 1) { // Verificando se a quantidade de chaves/valores do objeto JSON é maior que 1

        // location = "index.php" + query da url sem a variável código
        location = "index.php" + location.search.replace("codigo=" + urlQuery['codigo'] + "&", "");

    } else {
        location = "index.php";
    }

</script>