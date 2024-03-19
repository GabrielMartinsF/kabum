## Requisitos

Para executar este projeto, é necessário ter as seguintes versões instaladas:

- **Node.js**: v20.9.0
- **Apache**: Versão 2.4.58
- **PHP**: Versão 8.0.30

## Banco de Dados

Para configurar o banco de dados, siga estas etapas:

1. Execute o script de criação localizado em `kabum\bd`.
2. Acesse o arquivo `api/src/Models/Database.php` e insira suas credenciais de acesso ao banco de dados.

## Execução do Backend

Para executar o backend, siga estas etapas:

1. Instale as dependências do PHP:

    ```sh
    $ cd api && composer update
    ```

## Execução do Frontend

Para executar o frontend, siga estas etapas:

1. Instale as dependências do Vue.js:

    ```sh
    $ cd app && npm install || yarn
    ```
2. Execute o projeto

    ```sh 
    $ yarn dev
    ```
    
## Postman

Para acessar os endpoints da API, utilize a collection disponível em `kabum\postman`. Lembre-se de seguir as instruções de autenticação JWT:

1. Crie um usuário.
2. Faça login para obter o token de acesso.
3. Insira o token nos cabeçalhos das requisições para autenticação.

## Considerações

Este projeto inclui autenticação JWT. Certifique-se de seguir as etapas de autenticação descritas acima para acessar os endpoints da API.
