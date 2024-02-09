const loginForm = document.getElementById("loginForm");

const modal = document.getElementById("modalLogin");

const modalObj = new bootstrap.Modal(modal);

const tituloModal = document.querySelector(".modal-title");

const corpoModal = document.querySelector(".modal-body p");

const btnOkModal = document.getElementById("btnOkModal");

tituloModal.textContent = "Login de Usuário";

if (!localStorage.getItem('Usuarios')) {

    localStorage.setItem('Usuarios', '[]');

}

var usuarios = JSON.parse(localStorage.getItem('Usuarios'));


function verificarLogin() {

    const nome = document.getElementById("loginUsuario").value;

    const senha = document.getElementById("loginSenha").value;

    var statusLogin = false;

    usuarios.forEach(usuario => {

        if (nome === usuario.nome && senha === usuario.senha) {

            statusLogin = true;

        }
    });

    return statusLogin;

}


loginForm.addEventListener("submit", function(e) {

    e.preventDefault();

    if (verificarLogin()) {

        corpoModal.textContent = "Login realizado com sucesso";

        modal.addEventListener("hidden.bs.modal", function(){

            window.location = "index.html";
    
        });

    } else {
        
        corpoModal.textContent = "Informações de login inválidas";
    }

    modalObj.show();

    
    
});