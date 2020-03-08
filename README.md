# Teste Convenia

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
