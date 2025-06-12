// Exportando a função 'requisicao' que será usada para fazer requisições HTTP assíncronas
export async function requisicao (metodo, uri, dados = null) {
    // Cria um objeto de opções para configurar a requisição
    const opcoes = {
        method: metodo, // Método HTTP (GET, POST, PUT, DELETE, ...)
        headers: {
            'Content-Type': 'application/json; charset=UTF-8' // Define que os dados enviados são JSON
        },
        // Se houver dados, converte-os para JSON e adiciona no corpo da requisição
        body: (dados) ? JSON.stringify(dados) : null
    };

    // Faz a requisição com 'fetch' e aguarda a resposta
    let resposta = await fetch(uri, opcoes);

    // Verifica se a resposta contém erros
    await verificaErros(resposta);

    // Retorna a resposta
    return resposta;
}

// Função para verificar se houve erro na resposta da requisição
async function verificaErros(resp) {
    // Se a resposta foi bem-sucedida (ok/200), sai da função
    if (resp.ok) {
        return;
    }

    // Caso contrário, verifica o código de status e lança um erro correspondente
    switch (resp.status) {
        case 400: throw new Error('Erro de domínio (400).');
        case 404: throw new Error('Recurso não encontrado (404).');
        case 405: throw new Error('Método não permitido (405).');
        case 409: throw new Error('Conflito de dados. O CPF já está cadastrado (409)');
        case 500: throw new Error('Erro interno do servidor (500)');
        default : throw new Error('Erro desconhecido.');
    }
}