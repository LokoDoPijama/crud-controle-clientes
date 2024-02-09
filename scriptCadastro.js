const cadastroForm = document.getElementById("cadastroForm");

const tituloModal = document.querySelector(".modal-title");

const modal = document.getElementById("modalCadastro");

const modalObj = new bootstrap.Modal(modal)

const corpoModal = document.querySelector(".modal-body p");

const btnOkModal = document.getElementById("btnOkModal");

tituloModal.textContent = "Cadastro de Usuário";

if (!localStorage.getItem('Usuarios')) {

    localStorage.setItem('Usuarios', '[]');

}

var usuarios = JSON.parse(localStorage.getItem('Usuarios'));


function verificarCadastro() {

    const nome = document.getElementById("cadastroUsuario").value;

    const senha = document.getElementById("cadastroSenha").value;

    var statusCadastro = true;

    usuarios.forEach(usuario => {

        if (nome == usuario.nome) {

            corpoModal.textContent = "Usuário já cadastrado em nosso sistema";

            statusCadastro = false;
        }

    });

    if (nome === "" || senha === "") {

        corpoModal.textContent = "Por favor preencher todos os campos";

        statusCadastro = false;
    }

    return statusCadastro;

}


cadastroForm.addEventListener("submit", function(e) {

    e.preventDefault();

    if (!verificarCadastro()) {

        modalObj.show();

        return;

    }

    const nome = document.getElementById("cadastroUsuario").value;
    const senha = document.getElementById("cadastroSenha").value;

    corpoModal.textContent = "Usuário cadastrado com sucesso";

    const usuario = {
        nome: nome,
        senha: senha
    };
    
    usuarios.push(usuario);

    localStorage.setItem('Usuarios', JSON.stringify(usuarios));

    modalObj.show();

    modal.addEventListener("hidden.bs.modal", function(){

        window.location = "login.html";

    });

});