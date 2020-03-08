# Teste Backend Send4

## Inicializando
Antes de qualquer coisa, será necessário instalar as dependências do projeto com o composer:

`composer install`

O Docker foi utilizado para o ambiente de desenvolvimento. Para inicializa-lo utilize o docker-compose através do seguinte comando:

`docker-compose up -d --build`

Será necessário copiar o arquivo `.env.example` renomeando o nome para`.env`; o mesmo já estará com as configurações padrões para ambiente de desenvolvimento. (Banco de Dados, Conta de email [para ativação do serviço SMTP]).

Dar permissão na pasta 'storage' do Laravel (Utilizar usuário root).

`sudo chmod -R 755 storage/`

Após isso, será necessário executar as migrations do Laravel para criar a estrutura inicial do banco de dados através do seguinte comando:

`docker-compose exec apis php artisan migrate`

O passport foi utilizado para cuidar da autenticação da aplicação, então precisamos inicializa-lo:

`docker-compose exec apis php artisan passport:install --force`

Após isso já deve ser possível acessar a aplicação em [http://localhost](http://localhost).

## Testes

Para executar os testes, utilize o PHPunit disponível na pasta vendor do projeto:

`./vendor/bin/phpunit`


## Rotas

A API dispôe das rotas de **User (Registrar, Login, Logout e Informação do Usuário Logado)** e de **Produtos/Favoritos (Listar Produtos, Favoritar/Remover Favorito e Lista de Favoritos)**.

> Para acessar as rotas de Logout, Informação de usuário e as Rotas de Produtos/Favoritos você precisa gerar o Bearer Token, cadastrando um usuário ou fazendo o login de um usuário já existente, essas 2 rotas retornam um token para acessar as rotas protegidas.

> Utilize o Header "X-Requested-With: XMLHttpRequest" em todas as rotas

## Rotas: User

###### *Registrar Usuário*
> **[POST] /api/register**

    body
	{
    	name: string,
    	email: string /valid mail
    	password: string (min: 8)
    	password_confirmation: string (min: 8)
    }

###### *Login Usuário*
> **[POST] /api/login**

    body
	{
    	email: string
    	password: string
    }

###### *Logout Usuário*
> **[GET] /api/logout**

###### *Dados do Usuário*
> **[GET] /api/user**

## Rotas: Produtos/Favoritos

###### *Listar todos os Produtos*
> **[GET] /api/products**

###### *Favoritar/Desfavoritar Produto [Ação Toggle]*
> **[POST] /api/products/favorite/{id_produto_shopify}**

###### *Listar Favoritos (Do usuário/token Logado)*
> **[GET] /api/favorites**



