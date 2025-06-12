// Importa a função de requisição genérica (GET, POST, PUT, etc.)
import { requisicao } from "../utils.js";

/**
 * Lista todos os clientes cadastrados.
 * @returns Lista de clientes (em formato JSON).
 */
export async function listar() {
    try {
        let resposta = await requisicao('GET', '../../api/controller/listarCliente.php');
        return await resposta.json();
    } catch (erro) {
        alert(erro); // Exibe erro na tela
    }
}

/**
 * Salva um cliente no banco de dados.
 * - Se for um novo (sem ID), envia para inserção.
 * - Se já tiver ID, envia para atualização.
 * @param cliente array com os dados do cliente.
 * @returns Resposta JSON do servidor.
 */
export async function salvar(cliente) {
    try {
        let resposta = null;

        // Se o ID não for maior que zero, é novo (insere); senão, atualiza
        if (!(cliente.idCliente > 0)) {
            resposta = await requisicao('POST', '../../api/controller/inserirCliente.php', cliente);
        } else {
            resposta = await requisicao('PUT', '../../api/controller/alterarCliente.php', cliente);
        }

        return await resposta.json();
    } catch (erro) {
        alert(erro);
    }
}

/**
 * Obtém os dados de um cliente pelo ID.
 * @param {number} id Identificador do cliente.
 * @returns Dados do cliente.
 */
export async function obter(id) {
    try {
        let resposta = await requisicao('GET', '../../api/controller/obterCliente.php?idCliente=' + id);
        return await resposta.json();
    } catch (erro) {
        alert(erro);
    }
}

/**
 * Remove um cliente do banco de dados.
 * @param cliente ID do cliente a ser excluído.
 */
export async function remover(cliente) {
    try {
        await requisicao('DELETE', '../../api/controller/removerCliente.php', cliente);
    } catch (erro) {
        alert(erro);
    }
}
