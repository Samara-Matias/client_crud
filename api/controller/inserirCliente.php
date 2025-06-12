<?php
    require_once '../model/funcoesCliente.php';

    // Recebe os dados enviados pelo cliente via JSON e transforma em array
    $input = json_decode(file_get_contents('php://input'), true);

    // Faz a validação pra garantir que os campos obrigatórios chegaram
    if (
        !isset($input['nome']) || !isset($input['cpf']) ||
        !isset($input['email']) || !isset($input['telefone']) ) {
        responder(400, ['Alguma informação não foi enviada.']);
    }

    // Se passou da validação, tenta inserir no banco
    if ($inserir($input) > 0) {
        responder(201, ['Cliente inserido com sucesso!']);
    }
?>
