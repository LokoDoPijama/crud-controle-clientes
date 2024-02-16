<?php

require 'classes/bancoDeDados/Cliente.php';

$codigo = $_GET['codigo'];

$c = new Cliente();

$c->deletarCliente($codigo);

?>

<script>

    sessionStorage.setItem("clienteDeletado", "true");

    location = "index.php";

</script>