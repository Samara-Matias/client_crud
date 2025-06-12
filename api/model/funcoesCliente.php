<?php
    require_once 'funcoesUtil.php';

    // Conecta ao banco de dados usando PDO
    $pdo = getConexao();

    /**
     * Lista todos os clientes no banco de dados.
     *
     * @return array Lista de clientes.
     */
    $listar = function () use ($pdo): array {
        $linhas = [];

        try {
            $sql = "SELECT 
                        id_cliente AS idCliente,
                        nome, 
                        cpf, 
                        cnpj, 
                        email,
                        telefone 
                    FROM cliente";

            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $linhas = $stmt->fetchAll(); // Retorna um array de registros
        } catch (PDOException $erro) {
            responder(400, ["Erro ao obter registros. {$erro->getMessage()}"]);
        }

        return $linhas;
    };

    /**
     * Insere um novo cliente no banco de dados.
     *
     * @param array $input Dados do cliente.
     * @return int ID do cliente inserido.
     */
    $inserir = function(array $input) use ($pdo): int {
        try {
            $sql = "INSERT INTO cliente (nome, cpf, cnpj, email, telefone)
                    VALUES (:CNome, :CCpf, :CCnpj, :CEmail, :CTelefone)";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':CNome', $input['nome']);
            $stmt->bindParam(':CCpf', $input['cpf']);
            $stmt->bindParam(':CCnpj', $input['cnpj']);
            $stmt->bindParam(':CEmail', $input['email']);
            $stmt->bindParam(':CTelefone', $input['telefone']);

            $stmt->execute();

            return intval($pdo->lastInsertId());
        } catch (PDOException $erro) {
            if ($erro->getCode() === '23000') {
                responder(409, ["CPF já cadastrado. {$erro->getMessage()}"]);
            }
            responder(400, ["Erro ao inserir registro. {$erro->getMessage()}"]);
        }

        return 0;
    };

    /**
     * Retorna os dados de um único cliente pelo ID.
     *
     * @param int $id ID do cliente.
     * @return array Dados do cliente.
     */
    $obter = function(int $id) use ($pdo): array {
        $linha = [];

        try {
            $sql = "SELECT 
                        id_cliente AS idCliente,
                        nome, 
                        cpf, 
                        cnpj, 
                        email,
                        telefone 
                    FROM cliente 
                    WHERE id_cliente = ?";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $linha = $stmt->fetch(); // Retorna um único registro
        } catch (PDOException $erro) {
            responder(400, ["Erro ao obter registro. {$erro->getMessage()}"]);
        }

        return $linha;
    };

    /**
     * Atualiza os dados de um cliente.
     *
     * @param array $input Dados do cliente com o ID incluso.
     * @return int Quantidade de linhas afetadas.
     */
    $alterar = function(array $input) use ($pdo): int {
        try {
            $sql = "UPDATE cliente 
                    SET nome = :CNome, 
                        cnpj = :CCnpj, 
                        email = :CEmail,
                        telefone = :CTelefone
                    WHERE id_cliente = :ID";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':CNome', $input['nome']);
            $stmt->bindParam(':CCnpj', $input['cnpj']);
            $stmt->bindParam(':CEmail', $input['email']);
            $stmt->bindParam(':CTelefone', $input['telefone']);
            $stmt->bindParam(':ID', $input['idCliente']);
            $stmt->execute();

            return $stmt->rowCount(); // Retorna número de linhas alteradas
        } catch (PDOException $erro) {
            if ($erro->getCode() === '23000') {
                responder(409, ["Registro já existente. {$erro->getMessage()}"]);
            }
            responder(400, ["Erro ao alterar o registro. {$erro->getMessage()}"]);
        }

        return 0;
    };

    /**
     * Remove um cliente do banco de dados.
     *
     * @param int $id ID do cliente.
     * @return int Quantidade de linhas afetadas.
     */
    $remover = function(int $id) use ($pdo): int {
        try {
            $sql = "DELETE FROM cliente WHERE id_cliente = :ID";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':ID', $id);
            $stmt->execute();

            return $stmt->rowCount();
        } catch (PDOException $erro) {
            responder(400, ["Erro ao remover registro. {$erro->getMessage()}"]);
        }

        return 0;
    };
?>
