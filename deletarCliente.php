<?php

require 'classes/bancoDeDados/Cliente.php';

$codigo = $_GET['codigo'];

$c = new Cliente();

$c->deletarCliente($codigo);

//header('Location: index.php');

?>

<form action="index.php" method="post">
    <input name="clienteDeletado" value=true>
</form>

<script>

const form = document.querySelector("form");

form.submit();

</script>