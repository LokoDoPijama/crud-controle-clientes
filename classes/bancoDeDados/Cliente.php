<?php

require "Conexao.php";
require "model/ClienteModel.php";

class Cliente {

    private $conexao;

    public function __construct() {

        $con = new Conexao();

        $this->conexao = $con->getConexao();

    }

    private function mapear($q) {

        $clientes = [];

        foreach ($q as $cliente) {

            $clienteModel = new ClienteModel();

            $clienteModel->codigo = $cliente['id'];
            $clienteModel->nome = $cliente['nome'];
            $clienteModel->contato = $cliente['contato'];
            $clienteModel->email = $cliente['email'];
            $clienteModel->endereco = $cliente['endereco'];

            $clientes[] = $clienteModel;

        }

        return $clientes;
        
    }

    public function listarClientes() {

        $sql = "select * from clientes limit 1000";

        $q = $this->conexao->prepare($sql);

        $q->execute();

        $clientes = $this->mapear($q);

        return $clientes;

    }

    public function pesquisarPorCodigo($codigo) {

        $sql = "select * from clientes where id = :codigo";

        $q = $this->conexao->prepare($sql);

        $q->bindParam(":codigo", $codigo);

        $q->execute();

        $clientes = $this->mapear($q);

        return $clientes;

    }

    public function pesquisarPorNome($nome) {

        $sql = "select * from clientes where nome like :nome";

        $q = $this->conexao->prepare($sql);

        $nome = "%" . $nome . "%";

        $q->bindParam(":nome", $nome);

        $q->execute();

        $clientes = $this->mapear($q);

        return $clientes;

    }

    

    public function cadastrarCliente($cliente) {

        $sql = "insert into clientes (nome, email, contato, endereco)
        values (:nome, :email, :contato, :endereco)";

        $q = $this->conexao->prepare($sql);

        $q->bindParam(":nome", $cliente->nome);
        $q->bindParam(":email", $cliente->email);
        $q->bindParam(":contato", $cliente->contato);
        $q->bindParam(":endereco", $cliente->endereco);

        $q->execute();

    }

    public function editarCliente($cliente) {

        $sql = "update clientes set nome = :nome, email = :email,
        contato = :contato, endereco = :endereco where id = :codigo";

        $q = $this->conexao->prepare($sql);

        $q->bindParam(":codigo", $cliente->codigo);
        $q->bindParam(":nome", $cliente->nome);
        $q->bindParam(":email", $cliente->email);
        $q->bindParam(":contato", $cliente->contato);
        $q->bindParam(":endereco", $cliente->endereco);

        $q->execute();

    }

    public function deletarCliente($codigo) {

        $sql = "delete from clientes where id = :codigo";

        $q = $this->conexao->prepare($sql);

        $q->bindParam("codigo", $codigo);

        $q->execute();

    }

}