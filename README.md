# API ToDo - Backend

 API desenvolvida em Laravel 12 para o projeto de uma ToDo list.

# Tecnologias utilizadas
  PHP 8.4+

  Laravel 12

  MySQL

  JWT Token (Autenticação API)

  Composer 2

  Pint Strict Preset

# Pré-requisitos
  PHP 8.4 ou superior

  Laravel 12

  Composer 2 instalado

  MySQL rodando na máquina

  JWT Token

# Instale as dependências PHP:
  composer install

# Configure o ambiente:
  Copie o arquivo .env.example para .env:
    cp .env.example .env
  Abra o arquivo .env e configure o banco de dados:

  env
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=todo_db
  DB_USERNAME=todo_user
  DB_PASSWORD=todo@123

# Gerar chave da aplicação
  php artisan key:generate

# Gerar o JWT_SECRET
  php artisan jwt:secret

# Rodar as migrations
  php artisan migrate

# Subir o servidor local

  php artisan serve
