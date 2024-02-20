<?php 

require "classes/bancoDeDados/Cliente.php";

$c = new Cliente();

$clientes = $c->listarClientes();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Clientes</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <style>
        @import url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css");
        
        .alert {
            z-index: 1;
            width: 20vw;
            margin-left: 80vw;
        }

        /*th, td, span {
            font-size: 1.5vmax;
        }

        td button {
            height: 5vmax;
        }*/
    </style>
</head>
<body>

    <nav class="navbar bg-primary fixed-top">
        <div class="container-fluid d-flex justify-content-center">
          <span class="navbar-brand m-0 h1 text-white">CRUD PROJETO CONTROLE DE CLIENTES</span>
        </div>
    </nav>

    <nav class="navbar bg-primary">
        <div class="container-fluid d-flex justify-content-center">
          <span class="navbar-brand m-0 h1 text-white">CRUD PROJETO CONTROLE DE CLIENTES</span>
        </div>
    </nav>

    <div class="container mt-3">
        <div class="card">
            <div class="card-body">
                <button id="btnCadastrar" class="btn btn-success" onclick="mostrarModal('cadastro')">Cadastrar Cliente <i class="fa fa-add"></i></button>

                <div class="table-responsive">

                    <table class="table table-bordered table-striped table-hover text-center mt-3">

                        <tr>
                            <th>Código</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Contato</th>
                            <th>Endereço</th>
                            <th>Ações</th>
                        </tr>

                        <?php foreach ($clientes as $cliente) { ?>

                            <tr>
                                <td><?= $cliente->codigo ?></td>
                                <td><?= $cliente->nome ?></td>
                                <td><?= $cliente->email ?></td>
                                <td><?= $cliente->contato ?></td>
                                <td><?= $cliente->endereco ?></td>
                                <td>
                                    <div class="d-inline-block">
                                        <button class="btn btn-success" onclick="mostrarModal('editar', <?= $cliente->codigo; ?> )"><span>Editar <i class="fa fa-pencil"></i></span></button>
                                    </div>
                                    <div class="d-inline-block">
                                        <a href="deletarCliente.php?codigo=<?= $cliente->codigo ?>"><button class="btn btn-danger"><span>Excluir <i class="fa fa-trash"></i></span></button></a>
                                    </div>
                                </td>
                            </tr>

                            <div id="jsonCliente<?= $cliente->codigo; ?>" class="d-none"><?= json_encode($cliente); ?></div>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div hidden id="clienteDeletado"><?php if (isset($_POST['clienteDeletado'])) echo $_POST['clienteDeletado']; ?></div>

    <div class="alert alert-danger show fade d-none text-center fixed-bottom p-3 mb-0" role="alert">
        Você excluiu um cadastro <i class="fa fa-trash"></i>
    </div>

    <div class="modal fade" id="modalForm" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Título default</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="cadastrarCliente.php" method="post">
                <div class="modal-body">

                    <input id="inputCodigo" type="hidden" name="codigo">

                    <label class="form-label">Nome Completo</label>
                    <input id="ttbNome" class="form-control mb-3" type="text" placeholder="Nome Completo" name="nome">

                    <label class="form-label">E-mail</label>
                    <input id="ttbEmail" class="form-control mb-3" type="text" placeholder="E-mail" name="email">

                    <label class="form-label">Contato</label>
                    <input id="ttbContato" class="form-control mb-3" type="text" placeholder="Contato" name="contato">

                    <label class="form-label">Endereço</label>
                    <input id="ttbEndereco" class="form-control mb-3" type="text" placeholder="Endereço" name="endereco">
                
                </div>
                <div class="modal-footer">
                    <button id="btnCancelarModal" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button id="btnConfirmarModal" type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </form>
          </div>
        </div>
    </div>


    <script src="script.js"></script>
</body>
</html>