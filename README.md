# Instalação
- Clone o repósitorio
- Execute "composer install"
- Configure o arquivo .env com os acessos ao banco mySql
- Adicione a variável API_HOST no .env com o valor do HOST da API (ex: http://127.0.0.1:8888/api/)
- Execute as migrations "php artisan migrate:refresh"
- Suba um servidor para camada web "php artisan serve"
- Suba um servidor para API com a mesma porta que configuramos no .env "php artisan serve --port 8888"
- Navegue em http://127.0.0.1:8000

# Command Line (Processador de arquivos XML)
- Execute "php artisan import:xml <filePath>" (Ex: php artisan import:xml /Users/Usuario/Desktop/arquivo.xml) 

# Doc API
- https://documenter.getpostman.com/view/1134303/test-php-dev/RW8Dn7m1
