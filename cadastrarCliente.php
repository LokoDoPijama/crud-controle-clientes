<?php

require "classes/bancoDeDados/Cliente.php";

$c = new Cliente();

$cliente = new ClienteModel();

$cliente->nome = $_POST['nome'];
$cliente->email = $_POST['email'];
$cliente->contato = $_POST['contato'];
$cliente->endereco = $_POST['endereco'];

$c->cadastrarCliente($cliente);

?>

<script>

    sessionStorage.setItem("clienteDeletado", "false");

    location = "index.php";

</script>