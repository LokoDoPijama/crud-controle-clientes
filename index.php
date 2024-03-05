<?php 

require "classes/bancoDeDados/Cliente.php";

$c = new Cliente();

$codigo = "";
$nome = "";
$email = "";
$contato = "";
$endereco = "";

if (isset($_GET['codigo'])) {   $codigo = trim($_GET['codigo']);    }

if (isset($_GET['nome'])) {    $nome = trim($_GET['nome']);    }

if (isset($_GET['email'])) {    $email = trim($_GET['email']);    }

if (isset($_GET['contato'])) {    $contato = trim($_GET['contato']);    }

if (isset($_GET['endereco'])) {    $endereco = trim($_GET['endereco']);    }

if ($nome !== "") {
    $clientes = $c->pesquisarPorNome($nome);
} else if ($codigo !== "") {
    $clientes = $c->pesquisarPorCodigo($codigo);
} else if ($endereco !== "") {
    $clientes = $c->pesquisarPorEndereco($endereco);
} else if ($contato !== "") {
    $clientes = $c->pesquisarPorContato($contato);
} else if ($email !== "") {
    $clientes = $c->pesquisarPorEmail($email);
} else {
    $clientes = $c->listarClientes();
}

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
        @import url('https://fonts.googleapis.com/css2?family=Anta&display=swap');
        
        .alert {
            z-index: 1;
            width: 20vw;
            margin-left: 80vw;
        }

        .card {
            width: 90vw;
            margin: auto;
        }

        .lbWidth8 {
            width: 8%;
        }

        .inputRadius2px {
            border-radius: 2px;
        }

        #spanNavbar {
            font-size: 1.7em;
            font-family: 'Anta', 'sans-serif';
        }

        @media screen and (max-width: 727px) {

            .btn-primary span {
                display: none;
            }

            .btn-danger span {
                display: none;
            }
        }

        @media screen and (max-width: 1339px) {

            .lbWidth8 {
                width: auto;
            }

        }

        @media screen and (max-width: 991px) {

            .divBusca {
                padding-left: 0;
            }

            .btnsBusca {
                margin-top: 1em;
            }

        }

    </style>
</head>
<body>

    <nav class="navbar bg-primary fixed-top">
        <div class="container-fluid d-flex justify-content-center">
          <span id="spanNavbar" class="navbar-brand m-0 ms-3 h1 text-white">CONTROLE DE CLIENTES</span>
        </div>
    </nav>

    <nav class="navbar bg-primary">
        <div class="container-fluid d-flex justify-content-center">
          <span id="spanNavbar" class="navbar-brand m-0 h1 text-white">CRUD PROJETO CONTROLE DE CLIENTES</span>
        </div>
    </nav>

    
    <div class="card mt-3">
        <ul id="ulCard" class="list-group list-group-flush border-0">
            <li class="list-group-item" >
                <div class="card-body">
                    <form id="formBusca" action="index.php" method="get">
                        <div class="row">
                            <label id="lbCodigo" class="col-form-label col-lg-1 lbWidth8">Código:</label>
                            <div class="col-lg-2 ps-0">
                                <input class="form-control inputRadius2px" type="text" placeholder="Código"
                                name="codigo" value=<?php echo $nome === "" ? $codigo : "" ?>>
                            </div>
                            <label id="lbNome" class="col-form-label col-lg-1 ms-1 lbWidth8">Nome:</label>
                            <div class="col-lg-2 ps-0">
                                <input class="form-control inputRadius2px" type="text" placeholder="Nome" name="nome" 
                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                data-bs-title="Digitar algo aqui faz a aplicação ignorar o que estiver escrito no campo de código."
                                value=<?= $nome ?>>
                            </div>
                            <div class="col-lg divBusca">
                                <button class="btn btn-secondary ms-1 btnsBusca"><i class="fa fa-magnifying-glass me-1"></i> Buscar</button>
                            </div>
                            <div class="col-lg d-flex justify-content-end">
                                <button id="btnMaisOpcoes" class="btn btn-secondary" type="button"><i class="fa fa-ellipsis-vertical me-1"></i> Mais Opções</button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>
            <li id="liMaisOpcoes" class="list-group-item d-none">
                <div class="card-body">
                    <form id="formMaisOpcoes" action="index.php" method="get">
                        <div class="row">
                            <label id="lbEmail" class="col-form-label col-lg-1 lbWidth8">E-mail:</label>
                            <div class="col-lg-2 ps-0">
                                <input class="form-control inputRadius2px" type="text" placeholder="Email"
                                name="email" value=<?php echo $contato === "" && $endereco === "" ?  $email : ""; ?>>
                            </div>
                            <label id="lbContato" class="col-form-label col-lg-1 ms-1 lbWidth8">Contato:</label>
                            <div class="col-lg-2 ps-0">
                                <input class="form-control inputRadius2px" type="text" placeholder="Contato" name="contato" 
                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                data-bs-title="Digitar algo aqui faz a aplicação ignorar o que estiver escrito nos campos à esquerda."
                                value=<?php echo $endereco === "" ? $contato : "" ?>>
                            </div>
                            <label id="lbEndereco" class="col-form-label col-lg-1 ms-1 lbWidth8">Endereço:</label>
                            <div class="col-lg-2 ps-0">
                                <input class="form-control inputRadius2px" type="text" placeholder="Endereço"
                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                data-bs-title="Digitar algo aqui faz a aplicação ignorar o que estiver escrito nos campos à esquerda."
                                name="endereco" value=<?= $endereco ?>>
                            </div>
                            <div class="col divBusca">
                                <button class="btn btn-secondary ms-1 btnsBusca"><i class="fa fa-magnifying-glass me-1"></i> Buscar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>
        </ul>

        <script> // Este código está aqui para a ação de abrir as opções adicionais ser efetuada mais rapidamente
            const ulCard = document.querySelector("#ulCard");
            const liMaisOpcoes = document.querySelector("#liMaisOpcoes");

            if (location.search.includes("email")) {
                liMaisOpcoes.classList.toggle("d-none");
                ulCard.classList.toggle("border-0");
            }
        </script>

        <div class="card-body">
            <button id="btnCadastrar" class="btn btn-primary" onclick="mostrarModal('cadastro')">Cadastrar Cliente <i class="fa fa-add"></i></button>

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
                                    <button class="btn btn-primary" onclick="mostrarModal('editar', <?= $cliente->codigo; ?> )"><span>Editar </span><i class="fa fa-pencil"></i></button>
                                </div>
                                <div class="d-inline-block">
                                    <a href="deletarCliente.php?codigo=<?= $cliente->codigo ?>"><button class="btn btn-danger"><span>Excluir </span><i class="fa fa-trash"></i></button></a>
                                </div>
                            </td>
                        </tr>

                        <div id="jsonCliente<?= $cliente->codigo; ?>" class="d-none"><?= json_encode($cliente); ?></div>
                    <?php } ?>
                </table>
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
            <form id="formCadastro" action="cadastrarCliente.php" method="post">
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