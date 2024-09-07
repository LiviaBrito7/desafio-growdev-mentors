# API de Gestão de Mentores - Laravel 10 com Sanctum

API para gerenciamento de mentores utilizando **Laravel 10** e **Sanctum** para autenticação via tokens.

## Funcionalidades

- CRUD de mentores.
- Autenticação com tokens.
- Validação de campos:
  - **Nome**: editável
  - **Email**: editável
  - **CPF**: não editável, único
  - **ID**: não editável, chave única

## Tecnologias

- Laravel 10
- Laravel Sanctum
- MySQL

## Instalação

1. **Clone o repositório**:

   ```bash
   https://github.com/LiviaBrito7/desafio-growdev-mentors
   ```
   
## Configuração

1. Navegue até o diretório do projeto e instale as dependências:

    ```bash
    cd desafio-growdev-mentors
    composer install
    ```

2. Copie o arquivo de ambiente e configure:

    ```bash
    cp .env.example .env
    ```

3. Gere a chave da aplicação:

    ```bash
    php artisan key:generate
    ```

4. Configure o banco de dados no arquivo `.env`.

5. Execute as migrações para criar as tabelas necessárias:

    ```bash
    php artisan migrate
    ```

6. (Opcional) Execute o seeder para criar um usuário padrão:

    ```bash
    php artisan db:seed --class=UserSeeder
    ```

7. Inicie o servidor de desenvolvimento:

    ```bash
    php artisan serve
    ```

   A API estará disponível em `http://localhost:8000`.

## Uso da API

### Autenticação

Para obter um token de autenticação, faça uma requisição POST para `/api/login`:

- **Endpoint:** `/api/login`
- **Método:** POST
- **Body (JSON):**

    ```json
    {
      "email": "seu-email@example.com",
      "password": "sua-senha"
    }
    ```

- **Resposta:**

    ```json
    {
      "access_token": "seu-token-aqui",
      "token_type": "Bearer"
    }
    ```

   Use o token obtido para autenticar as requisições subsequentes, adicionando o cabeçalho `Authorization: Bearer seu-token-aqui`.

### Endpoints

- **Listar Mentores**

  - **Rota:** `/api/mentors`
  - **Método:** GET
  - **Autenticação:** Necessário Bearer Token.

- **Criar Mentor**

  - **Rota:** `/api/mentors`
  - **Método:** POST
  - **Autenticação:** Necessário Bearer Token.
  - **Body (JSON):**

    ```json
    {
      "name": "Nome do Mentor",
      "email": "email@example.com",
      "cpf": "123.456.789-10"
    }
    ```

- **Atualizar Mentor**

  - **Rota:** `/api/mentors/{id}`
  - **Método:** PUT
  - **Autenticação:** Necessário Bearer Token.
  - **Body (JSON):**

    ```json
    {
      "name": "Nome Atualizado",
      "email": "novoemail@example.com"
    }
    ```

- **Deletar Mentor**

  - **Rota:** `/api/mentors/{id}`
  - **Método:** DELETE
  - **Autenticação:** Necessário Bearer Token.
   
