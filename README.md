1 composer install

2- copie o araquivo .env.example e renomei para .env

3- no terminal execute `php artisan key:generate `

3- cria uma base de dados chamada laravel

4- no arquivo env configure o banco

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

5- no terminal execute `php artisan migrate`

6- no terminal execute `php artisan db:seed` 

7- cofigura no arquivo .env com os dados de smtp

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"

EMAIL=     #email que vai receber os contatos

8- no terminal execute `php artisan serve` 

9- entra na pasta spa  `cd spa`

10- no terminal execute `npm i`

11- npm run serve

Pronto provavelmente o servidor abrirar em http://localhost:8080/


Para realizar os testes unitarios 
1 - no terminal execute `php artisan test` 


Observacao: no arquivo agenda/spa/axios.js  configura o dominio do servidor

axios.defaults.baseURL = 'http://localhost:8000/api/'   # COLOCA O DOMINIO DO SERVIDOR PHP
 