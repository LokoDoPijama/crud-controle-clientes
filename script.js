// Variáveis

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
const formCadastro = document.querySelector("#formCadastro");
const inputCodigo = document.querySelector("#inputCodigo");
const ttbNome = document.querySelector("#ttbNome");
const ttbEmail = document.querySelector("#ttbEmail");
const ttbContato = document.querySelector("#ttbContato");
const ttbEndereco = document.querySelector("#ttbEndereco");
const tooltip = document.querySelector("[data-bs-toggle='tooltip']");
const tooltipObj = new bootstrap.Tooltip(tooltip, {"trigger": "hover"});
const formBusca = document.querySelector("#formBusca");
const btnMaisOpcoes = document.querySelector("#btnMaisOpcoes");
const ulCard = document.querySelector("#ulCard");
const liMaisOpcoes = document.querySelector("#liMaisOpcoes");
const formMaisOpcoes = document.querySelector("#formMaisOpcoes");


// Funções

function mostrarModal(contexto, codigo) {

    if (contexto == 'cadastro') {
        modalTitle.textContent = "Cadastro de Cliente";
        formCadastro.setAttribute("action", "cadastrarCliente.php");
        btnConfirmarModal.innerText = "Cadastrar";
    } else if (contexto == 'editar') {
        
        let jsonCliente = JSON.parse(document.querySelector("#jsonCliente" + codigo).innerText);
        
        modalTitle.textContent = "Editar Registro";
        
        formCadastro.setAttribute("action", "editarCliente.php");

        inputCodigo.setAttribute("value", jsonCliente.codigo);

        ttbNome.setAttribute("value", jsonCliente.nome);

        ttbEmail.setAttribute("value", jsonCliente.email);

        ttbContato.setAttribute("value", jsonCliente.contato);

        ttbEndereco.setAttribute("value", jsonCliente.endereco);

        btnConfirmarModal.innerText = "Confirmar";

    }

    modalObj.show();

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


// Lógica avulsa

if (sessionStorage.getItem("clienteDeletado") == "true") {

    // Verifica se a página não foi recarregada
    if (!window.performance.getEntriesByType("navigation").map((nav) => nav.type).includes("reload")) {
        mostrarAlert();
    }
}


// Eventos

modal.addEventListener("hidden.bs.modal", function(){
    formCadastro.reset();

    modalBody.childNodes.forEach(formElement => {
        if (formElement.nodeName == "INPUT") {
            formElement.removeAttribute("value");
        }
    });
});

formBusca.addEventListener("submit", function(e){

    sessionStorage.setItem("clienteDeletado", "false");
    
    let listaDeInputs = formBusca.querySelectorAll("input");

    listaDeInputs = Array.from(listaDeInputs);

    listaDeInputs = listaDeInputs.map((input) => input.value.trim());
    
    inputsVazios = true;

    listaDeInputs.forEach((input) => {
        if (input !== "") {
            inputsVazios = false;
        }
    });

    if (inputsVazios == true) {
        e.preventDefault();
        location = "index.php";
    }
});

btnMaisOpcoes.addEventListener("click", function() {

    liMaisOpcoes.classList.toggle("d-none");

    ulCard.classList.toggle("border-0");

});

formMaisOpcoes.addEventListener("submit", function(e){

    sessionStorage.setItem("clienteDeletado", "false");
    
    let listaDeInputs = formMaisOpcoes.querySelectorAll("input");

    listaDeInputs = Array.from(listaDeInputs);

    listaDeInputs = listaDeInputs.map((input) => input.value.trim());
    
    inputsVazios = true;

    listaDeInputs.forEach((input) => {
        if (input !== "") {
            inputsVazios = false;
        }
    });

    if (inputsVazios == true) {
        e.preventDefault();
        location = "index.php";
    }
});