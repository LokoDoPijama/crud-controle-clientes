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
const tooltipArray = document.querySelectorAll("[data-bs-toggle='tooltip']");
const tooltipObjArray = [...tooltipArray].map(tooltip => new bootstrap.Tooltip(tooltip, {"trigger": "hover"}));
const formBusca = document.querySelector("#formBusca");
const divMaisOpcoes = document.querySelector("#divMaisOpcoes");
const btnMaisOpcoes = document.querySelector("#btnMaisOpcoes");
const formMaisOpcoes = document.querySelector("#formMaisOpcoes");
const btnsBusca  = document.querySelectorAll(".btnsBusca");
const mqMax991px = window.matchMedia("screen and (max-width: 991px)");
const mqMax420px = window.matchMedia("screen and (max-width: 420px)");

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

    setTimeout(() => {

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

if (document.body.clientWidth <= 991) {

    btnsBusca.forEach(btn => {
        btn.classList.remove("ms-1");
    });
}

if (document.body.clientWidth <= 420) {

    divMaisOpcoes.classList.toggle("justify-content-end");
    divMaisOpcoes.classList.toggle("justify-content-start");
    divMaisOpcoes.classList.toggle("ps-0");
    divMaisOpcoes.classList.toggle("mt-3");

}


// Eventos

modal.addEventListener("hidden.bs.modal", () => {
    formCadastro.reset();

    modalBody.childNodes.forEach(formElement => {
        if (formElement.nodeName == "INPUT") {
            formElement.removeAttribute("value");
        }
    });

    ttbContato.classList.remove("border-danger");

    ttbContato.classList.replace("mb-1", "mb-3");

    document.querySelector("#msgErro").remove();

});

formCadastro.addEventListener("submit", e => {

    if (!/^\d+$/.test(ttbContato.value) || ttbContato.value.length > 16) {

        e.preventDefault();

        ttbContato.classList.add("border-danger");

        ttbContato.classList.replace("mb-3", "mb-1");

        if (document.querySelector("#msgErro")) {

            let msg = document.querySelector("#msgErro");

            msg.innerHTML = "<i class='fa fa-circle-info'></i> Digite apenas números";

            if (ttbContato.value.length > 16) {
                msg.innerHTML = "<i class='fa fa-circle-info'></i> Insira no máximo 16 dígitos";
            }

            return;
        }

        let msg = document.createElement("p");

        msg.id = "msgErro";

        msg.innerHTML = "<i class='fa fa-circle-info'></i> Digite apenas números";

        if (ttbContato.value.length > 16) {
            msg.innerHTML = "<i class='fa fa-circle-info'></i> Insira no máximo 16 dígitos";
        }

        msg.style = "font-size: 0.85em;";

        msg.classList.add("text-danger");

        ttbContato.parentNode.insertBefore(msg, ttbContato.nextSibling);

    }
});

ttbContato.addEventListener("change", () => {

    ttbContato.classList.remove("border-danger");

});

formBusca.addEventListener("submit", e => {

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

btnMaisOpcoes.addEventListener("click", () =>  {

    liMaisOpcoes.classList.toggle("d-none");

    ulCard.classList.toggle("border-0");

});

formMaisOpcoes.addEventListener("submit", e => {

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

mqMax991px.addEventListener("change", () =>  {

    btnsBusca.forEach(btn => {
        btn.classList.toggle("ms-1");
    });
});

mqMax420px.addEventListener("change", () =>  {

    divMaisOpcoes.classList.toggle("justify-content-end");
    divMaisOpcoes.classList.toggle("justify-content-start");
    divMaisOpcoes.classList.toggle("ps-0");
    divMaisOpcoes.classList.toggle("mt-3");

});