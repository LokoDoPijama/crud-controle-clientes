const btnCadastrar = document.querySelector("#btnCadastrar");
const table = document.querySelector("table");
const myAlert = document.querySelector(".alert");
var alertDone = true;
var clienteDeletado = document.querySelector("#clienteDeletado");
const modal = document.querySelector("#modalForm");
const modalTitle = document.querySelector(".modal-title");
const modalBody = document.querySelector(".modal-body");
const modalObj = new bootstrap.Modal(modal);
const btnConfirmarModal = document.querySelector("#btnConfirmarModal");
const form = document.querySelector("form");
const inputCodigo = document.querySelector("#inputCodigo");
const ttbNome = document.querySelector("#ttbNome");
const ttbEmail = document.querySelector("#ttbEmail");
const ttbContato = document.querySelector("#ttbContato");
const ttbEndereco = document.querySelector("#ttbEndereco");


if (sessionStorage.getItem("clienteDeletado") == "true") {

    // Verifica se a página não foi recarregada
    if (!window.performance.getEntriesByType("navigation").map((nav) => nav.type).includes("reload")) {
        mostrarAlert();
    }
}

function mostrarModal(contexto, codigo) {

    if (contexto == 'cadastro') {
        modalTitle.textContent = "Cadastro de Cliente";
        btnConfirmarModal.innerText = "Cadastrar";
        form.setAttribute("action", "cadastrarCliente.php");

        modalBody.childNodes.forEach(formElement => {
            if (formElement.nodeName == "INPUT") {
                formElement.removeAttribute("value");
            }
        });

    } else if (contexto == 'editar') {

        let jsonCliente = JSON.parse(document.querySelector("#jsonCliente" + codigo).innerText);
        
        modalTitle.textContent = "Editar Registro";

        form.setAttribute("action", "editarCliente.php");

        inputCodigo.setAttribute("value", jsonCliente.codigo);

        ttbNome.setAttribute("value", jsonCliente.nome);

        ttbEmail.setAttribute("value", jsonCliente.email);

        ttbContato.setAttribute("value", jsonCliente.contato);

        ttbEndereco.setAttribute("value", jsonCliente.endereco);

        btnConfirmarModal.innerText = "Confirmar";

    }

    modalObj.show();

}

function editarCliente(id) {

    console.log(id);

}


function mostrarAlert() {

    const disposableAlert = myAlert.cloneNode(true);

    document.body.insertBefore(disposableAlert, document.querySelector(".container"));

    const alertObj = new bootstrap.Alert(disposableAlert);

    disposableAlert.classList.remove("d-none");

    setTimeout(function(){

        alertObj.close();

    }, 2000);

}