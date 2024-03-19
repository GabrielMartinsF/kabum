### Requisitos

```sh
# Node
Node.js v20.9.0.

# Apache
Apache Version 2.4.58

# PHP
PHP Version 8.0.30

```

### Banco

```sh

# Script para criação em -> kabum\bd

# Acesse o arquivo em -> api/src/Models/Database.php e insira sua credenciais


```

### Execução Backend

```sh

# Install Dependencies - PHP

$ cd api && composer update

```

### Execução Frontend:

```sh

# Install Dependencies - Vue

$ cd app && npm install || yarn

$ yarn dev

```

### Postman:

```sh

Collection em kabum\postman

```

### Considerações:

O projeto possui autenticação JWT, para ter acesso aos endpoints crie um usuario, faça login, pegue o token que retornará e insira nos cabeçalhos das requisições
