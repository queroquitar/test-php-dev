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
