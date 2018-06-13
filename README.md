# Instruções 

  O repositorio es com 2 pastas laravel e angular
  comando para inicia o projeto

  para os teste foi usado
  Ubuntu Deck 18.04
  PHP 7.2 + ext mysql, mongobd
  alterar conexão mysql no arquivo .env
  npm ng angular global

  _Comando do test php artisan read-file-data _

  _User test email exemplo@exemplo.com password 123456_

  ```bash
  cd laravel
  composer install
  cp .env.example .env
  php artisan migrate
  php artisan db:seed --class=UsersTableSeeder
  #test de comando para leitura de arquivos 
  php artisan read-file-data
  #test de api via laravel
  ./vendor/bin/phpunit
  php artisan serve

  cd ..
  cd angular
  npm install
  ng serve
  ```
Visualizar o angular APP no localhost:4200

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
