# Challenge
- Criar uma app command line, em Laravel, que leia os arquivos passados e adicione os valores em uma base mongodb
- Criar uma api usando Laravel, conectando mongodb e mysql e implementar o CRUD de usuário.
- Implementar login de usuário e usar jwtwebtoken (livre pra alterar o schema passado ou adicionar 
tabelas auxiliares se achar necessário). 
- Criar endpoints para consumir os dados importados na tarefa de command line 
- Criar endpoints para CRUD dessesdados na api.
- Implementar uma camada web que consuma essa api. 

## User Schema
    email: 
      - type: string 
      - required: true
      - minlength: 5
    password: 
      - type: string 
      - required: true
      - minlength: 6

# Extras 
- Tests 
- Docker 


# Entrega

Realizando o desafio para aprovação na vaga de desenvolvedor júnior.

### Funcionalidades

* Login utilizando web token.
* Gerenciamento de débitos (CRUD).

Parte dos usuários se encontra em mysql e a parte de débitos em mongodb.

### Configuração

* Clone o repositório para a pasta do seu servidor;
* Execute o comando composer install;
* Renomear o arquivo .env.example para .env
* Adicionar no arquivo .env a configuração para a conexão no mongodb.
* Executar o comando php artisan migrate.
* Executar os testes.


  Exemplo:
  
    DB_DSN=mongodb://localhost:27017
 
    https://docs.mongodb.com/manual/reference/connection-string/

### Documentação

A documentação da api pode ser encontrada em http://url-do-app/apidoc


### Testes

O comando para executar o teste é <b>"./vendor/bin/phpunit"</b>

Obs. É necessário resetar com o comando php artisan migrate:fresh antes de executar os testes.

### Comentários

* Realizei um teste muito parecido para uma empresa Just Digital. Vocês podem encontrar o resultado aqui, foi feito sem a utilização de frameworks e utilizando o mesmo conceito - https://github.com/RonaldoRodrigues/justcms
* Poderia implementar a camada web e possivel de diversas formas, com ajax ou algum framework javascript mas nesse teste não executarei essa parte para vocês já analisarem o código.
* Caso for necessario, executarei essa última parte.
* Eu poderia utilizar laradocker http://laradock.io/ para subir uma imagem docker mas como não tenho tanta experiência, preferi não anexar no projeto.


Abraços!