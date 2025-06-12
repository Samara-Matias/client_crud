import { listar, salvar, remover, obter } from "./requisicoes.js";
import { validaCPF } from "./validacao.js";
let btnEditar, btnExcluir = null;

// Espera o carregamento total do DOM
document.addEventListener('DOMContentLoaded', async () => {
    // Carrega os dados iniciais e monta a tabela
    let registros = await listar();
    montarTabela(registros);

    // Referência aos formulários de cadastro e edição
    const cadastroForm = document.querySelector("#cadastro-form");
    const editarForm = document.querySelector("#editar-form");

    // Evento para inserir um novo cliente
    cadastroForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        // Coleta os dados do formulário e armazena-os para serem enviados como JSON
        let cpfCliente = await validaCPF(document.querySelector("#cpfClienteCad").value);
        if(cpfCliente)
            cpfCliente = document.querySelector("#cpfClienteCad").value;
        else
            return alert('CPF inválido. Tente novamente.')


        let cliente = {
            idCliente: document.querySelector('#idClienteCad').value,
            nome: document.querySelector("#nomeClienteCad").value,
            cpf: cpfCliente,
            cnpj: document.querySelector('#cnpjClienteCad').value,
            email: document.querySelector("#emailClienteCad").value,
            telefone: document.querySelector('#telefoneClienteCad').value
        };

        await salvar(cliente); // Salva o novo cliente

        cadastroForm.reset(); // Limpa o formulário
        document.querySelector('#idClienteCad').value = ''; // Limpa o input com o ID 

        let registros = await listar(); // Atualiza a lista
        montarTabela(registros);       // Remonta a tabela
    });

    editarForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        // Coleta os dados do formulário e armazena-os para serem enviados como JSON
        let cpfCliente = await validaCPF(document.querySelector("#cpfClienteEd").value);
        if(cpfCliente) {
            cpfCliente = document.querySelector("#cpfClienteEd").value;
        }
        else {
            return alert('CPF inválido. Tente novamente.');
        }

        let cliente = {
            idCliente: document.querySelector('#idClienteEd').value,
            nome: document.querySelector("#nomeClienteEd").value,   
            cnpj: document.querySelector('#cnpjClienteEd').value,
            email: document.querySelector('#emailClienteEd').value,
            telefone: document.querySelector('#telefoneClienteEd').value
        };

        await salvar(cliente); // Salva as alterações

        editarForm.reset(); // Limpa o formulário
        document.querySelector('#idClienteEd').value = ''; // Limpa o input com o ID 

        let registros = await listar(); // Atualiza a lista
        montarTabela(registros);       // Remonta a tabela
    });
});

document.querySelector('#tbl-clientes tbody').addEventListener('click', async (e) => {
    const botao = e.target;
    const id = botao.dataset.id;
    if (botao.textContent.trim() === 'EDITAR') {
        let cliente = await obter(id);

        document.querySelector('#idClienteEd').value = cliente.idCliente;
        document.querySelector('#nomeClienteEd').value = cliente.nome;
        document.querySelector('#cpfClienteEd').value = cliente.cpf;
        document.querySelector('#cnpjClienteEd').value = cliente.cnpj;
        document.querySelector('#emailClienteEd').value = cliente.email;
        document.querySelector('#telefoneClienteEd').value = cliente.telefone;
    }
    else if (botao.textContent.trim() === 'REMOVER') {
        let cliente = {idCliente: id};
        await remover(cliente);
        let registros = await listar();
        montarTabela(registros);
    }
    else
        ;
});

function montarTabela(registros) {
    const corpoTabela = document.querySelector('#tbl-clientes tbody');

    // Limpa todos os dados da tabela
    while (corpoTabela.firstChild) {
        corpoTabela.removeChild(corpoTabela.firstChild);
    }

    // Para cada registro, cria uma linha nova e adiciona ao corpo da tabela
    registros.forEach(registro => {
        const linha = montaLinha(registro);
        corpoTabela.appendChild(linha);
    });
}

function montaLinha({idCliente, nome, cpf, cnpj, email, telefone}) {
    let tr = document.createElement('tr');

    // Cria células para cada campo de dados e retorna um array com TDs contendo esses dados
    const celulas = [idCliente, nome, cpf, cnpj, email, telefone].map(texto => {
        const td = document.createElement('td');
        td.textContent = texto;
        return td;
    });

    // Cria botões de editar e excluir
    btnEditar = criaBotao('EDITAR', idCliente);
    btnExcluir = criaBotao('REMOVER', idCliente);

    // Coloca os botões em uma célula separada
    const tdAcoes = document.createElement('td');
    tdAcoes.append(btnEditar, btnExcluir);

    // Junta tudo na linha da tabela
    tr.append(...celulas, tdAcoes);

    // Retorna a linha da tabela preenchida
    return tr;
}

function criaBotao(btnTexto, idDado) {
    const botao = document.createElement('button');
    botao.textContent = btnTexto;
    botao.classList.add('btn');
    botao.classList.add('m-2');
    if ( btnTexto === 'EDITAR' ) {
        botao.setAttribute('data-bs-toggle', 'modal');
        botao.setAttribute('data-bs-target', '#editar-modal');
        botao.classList.add('btn-info');
    }
    if ( btnTexto === 'REMOVER' ) {
        botao.classList.add('btn-danger');
    }
    botao.dataset.id = idDado; // armazena o ID como dado do botão
    return botao;
}