-- Cria o banco de dados chamado 'processo_seletivo' se ele ainda não existir.
CREATE DATABASE IF NOT EXISTS processo_seletivo DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci;

USE processo_seletivo;

-- Apaga a tabela 'cliente' caso ela já exista, para garantir que não haja conflito ao tentar executar o script.
DROP TABLE IF EXISTS cliente;

-- Criação da tabela 'cliente' e os campos em que os dados serão armazenados
CREATE TABLE cliente (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cpf CHAR(11) NOT NULL,
    cnpj CHAR(14) DEFAULT '',
    email VARCHAR(150) NOT NULL,
    telefone CHAR(11),
    UNIQUE INDEX unq_cliente__cpf(cpf)
)ENGINE = INNODB;