<?php

require "classes/bancoDeDados/Cliente.php";

$c = new Cliente();

$cliente = new ClienteModel();

$cliente->codigo = $_POST['codigo'];
$cliente->nome = $_POST['nome'];
$cliente->email = $_POST['email'];
$cliente->contato = $_POST['contato'];
$cliente->endereco = $_POST['endereco'];

$c->editarCliente($cliente);

header('Location: index.php');