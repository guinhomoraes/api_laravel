# 🚀 API Simples com Laravel 12 + Laravel Sanctum

## ✅ Requisitos

- PHP >= 8.1
- Composer
- Banco de dados (MySQL, PostgreSQL, etc.)
- Postman ou Insomnia (opcional para testes)

---

## ⚙️ Passo 1: Instalar Laravel 12

Crie o projeto:

```bash
laravel new api_laravel
```

Configure o arquivo .env com os dados do seu banco:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=api_laravel
DB_USERNAME=root
DB_PASSWORD= senha do banco
```

Execute as migrações iniciais:

```bash
php artisan migrate
```

## 🔐 Passo 2: Instalar Laravel Sanctum ##

Executar o seeguinte comando no terminal:

```bash
php artisan install:api
```

Execute as migrações:

```bash
php artisan migrate
```

## 🛡️ Passo 3: Configurar Sanctum ##

No modelo User, adicione o trait HasApiTokens.

No arquivo config/auth.php, mantenha o guard sanctum como padrão para API (já vem configurado).

## 🌐 Passo 4: Criar rotas de API ##

No arquivo routes/api.php, adicione:

 - Rota de registro (cadastrar usuário)
 - Rota de login (gerar token)
 - Rota de logout (revogar tokens)
 - Rotas protegidas (acesso apenas com token)

## 🧪 Passo 5: Testar a API ##

Registro: Envie um POST para /api/register com nome, email e senha.

Login: Envie um POST para /api/login e receba um token.

Rota protegida: Envie um GET para /api/user usando header Authorization: Bearer {token}.

Logout: Envie um POST para /api/logout para revogar o token.
