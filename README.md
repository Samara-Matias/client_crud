# Client CRUD - Gerenciador de clientes

---

- Esse simples gerenciador de clientes foi feito para completar um teste proposto para uma vaga de desenvolverdor(a).
- Nesse documento será descrito como rodas essa aplicação localmente em sua máquina para que você possa testar.

# CRUD de Clientes com PHP (Procedural) + MySQL + AJAJ

Esta aplicação web permite o **gerenciamento de clientes** (Cadastro, Listagem, Edição e Exclusão) utilizando:

- PHP
- MySQL
- Padrão de arquitetura simples baseado em **MVC**
- Frontend com HTML5 + JavaScript
- Interface feita com Bootstrap 5


## Funcionalidades

* Cadastrar novos clientes
* Editar informações dos clientes existentes
* Remover clientes cadastrados
* Lista de clientes cadastrados

## Estrutura do Projeto

```

client-crud/
│
├── api/
│   ├── model/
│   │   └── funcoesCliente.php
│   │   └── funcoesCliente.php
│   └── controller/
│       ├── listarCliente.php
│       ├── inserirCliente.php
│       ├── alterarCliente.php
│       ├── removerCliente.php
│       └── obterCliente.php
│
├── app/
│   ├── clientes/
│     ├── index.html
│     ├── principal.js
│     ├── requisicoes.js
│     ├── validacao.js
│   ├── utils.js
├── config.php
├── index.html
├── .gitignore
├── instruçoes.php

````

---

## Como rodar a aplicação localmente com XAMPP

### O que é necessário ter instalado no seu computador

- [XAMPP instalado](https://www.apachefriends.org/pt_br/index.html)
- Navegador de sua preferência (Chrome, Firefox, etc.)

### Configurando o gerenciador

1. **Clone ou copie este repositório para o diretório do XAMPP:**

   No Windows:
   ```bash
   C:\xampp\htdocs\
    ```

2. **Inicie o XAMPP** e ative os módulos:

   * Apache
   * MySQL

3. **Crie o banco de dados:**

   * Acesse: http://localhost/phpmyadmin ou clique no botão **admin** presente ao lado do botão para iniciar o MySQL ndo XAMPP.

   * Vá até a aba **SQL** e copie e cole o código presente dentro do arquivo **instruçoesSql.sql** ou importe diretamente o arquivo **instruçoesSql.sql**;

4. **Configurando a aplicação para comunicação com o banco de dados**
   
   * Com a pasta do projeto aberto, encontre o arquivo **config.template.php**

   * Renomeie esse arquivo para **config.php**

   * Abra esse arquivo no bloco de notas e preencha o arquivo com as credenciais do seu banco de dados. Como é localhost é possível preencher da seguinte maneira:

      ```php

         <?php

            define('DB_HOST', 'localhost');
            define('DB_USERNAME', 'root');
            define('DB_PASSWORD', '');
            define('DB_NAME', 'processo_seletivo');
            // No XAMPP normalmente funciona preenchendo deste modo. Esse arquivo pode ser preenchido de acordo com o local em que você está hospedando o sistema
         ?>
      ```

5. **Acesse o sistema no navegador:**

   ```
   http://localhost/crud-clientes/
   ```
    * Pronto, agora você pode usar o gerenciador de clientes :D.
---

#### Feito por Samara Matias dos Anjos ✨