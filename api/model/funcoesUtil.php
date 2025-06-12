<?php
    declare(strict_types=1);

    // Requerindo as constantes globais com as informações do bando de dados
    require_once '../../config.php';

    /**
     * Envia uma resposta JSON para o cliente e encerra a execução do script.
     *
     * @param int $codStatus Código HTTP da resposta (ex: 200, 404, 500)
     * @param $dados Dados que serão convertidos em JSON e enviados na resposta
     */
    function responder(int $codStatus, $dados = null): void {
        header('Content-Type: application/json; charset=utf-8');

        // Define o código de status HTTP da resposta
        http_response_code($codStatus);

        // Envia os dados como JSON e encerra o script
        die(json_encode($dados, JSON_UNESCAPED_UNICODE));
    }

    /**
     * Cria e retorna uma conexão PDO com o banco de dados MySQL.
     *
     * @return PDO Conexão ativa com o banco de dados
     */
    function getConexao():PDO {
        // Dados de conexão
        $host = DB_HOST;
        $db = DB_NAME;
        $usu = DB_USERNAME;
        $senha = DB_PASSWORD;
        $charset = 'utf8';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

        // Opções da conexão PDO
        $opcoes = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,       // Lança exceções em erros
            PDO::ATTR_PERSISTENT => true,                      // Conexão persistente para não abrir sempre uma conexão
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC   // Retorna arrays associativos por padrão
        ];

        try {
            // Cria e retorna o objeto PDO
            $pdo = new PDO($dsn, $usu, $senha, $opcoes);
        }
        catch (PDOException $erro) {
            // Em caso de erro na conexão, responde com erro 500 e mensagem
            responder(500, ["Erro ao conectar com o Banco de Dados: " . $erro->getMessage()]);
        }
        return $pdo;
    }
?>