<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

### Instale as Dependencias com:

```
composer install
```

### Crie Seu Banco de Dados:

* Crie o Arquivo .env na raiz do projeto
* Copie os valores da .env.example e coloque no arquivo .env
* e coloque o nome do banco que criou na váriavel do env chamada:
* DB_DATABASE
* e suas credencias do seu banco de dados nas váriaveis:
* DB_USERNAME=seuusuario
* DB_PASSWORD=suasenha

* Após configurar rode os seguintes comandos:
``` 
php artisan migrate 

php artisan db:seed

```
Vai subir as tabelas, e fazer o seed.

### Configure o SMTP do Email:

* Entre no Site do MailTrap:

* <a href="https://mailtrap.io/">MailTrap</a>

* Clique em Sign up for free:

![image](https://user-images.githubusercontent.com/54550561/226718288-dc86ff8e-17f9-498b-a7a5-99784122771c.png)

Escolha como quer se Cadastrar

![image](https://user-images.githubusercontent.com/54550561/226718143-7d8cdca7-9214-4cf8-8c90-9c1d7d33ea5a.png)

Clique em Email Testing:

![image](https://user-images.githubusercontent.com/54550561/226718915-509a26ab-d237-48e5-aa15-6b633bffc3a6.png)

Clique em Add Inbox:

![image](https://user-images.githubusercontent.com/54550561/226719152-a47faecd-dbab-49e4-b092-2c494d8682f8.png)

Escolhe o nome do inbox e clique em salvar:

![image](https://user-images.githubusercontent.com/54550561/226719230-5d690197-f56c-4774-a6a7-5816db6916c9.png)

Com o inbox salvo, clique na engrenagem:

![image](https://user-images.githubusercontent.com/54550561/226719521-f5cb0407-8806-48e1-94c6-d8a86fc8dd44.png)

Vai abrir essa tela:

![image](https://user-images.githubusercontent.com/54550561/226719654-7c55733d-dd80-44b1-bb72-5f0fc98c29ad.png)

Clique no select abaixo de Integrations:

![image](https://user-images.githubusercontent.com/54550561/226719892-b541baba-b9f6-4d5a-8026-18ffba29ef5b.png)

e Escolha a Opção: Laravel 7+:

![image](https://user-images.githubusercontent.com/54550561/226720140-cb0d5358-2a12-48b3-8652-30d207617870.png)

Copie todos esses Valores que estão abaixo:
![image](https://user-images.githubusercontent.com/54550561/226720306-5d6976f5-7e3a-4930-9c8a-483ef16999d9.png)

Deve Ficar Desse Jeito:

```
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=2fa213214a58171
MAIL_PASSWORD=104e1241209096
MAIL_ENCRYPTION=tls

```

Após Copiar Substitue eles no .env:

![image](https://user-images.githubusercontent.com/54550561/226720822-5891e361-befd-49ac-b2f7-8ec84f0dcf37.png)

E ao cadastrar uma despesa, você receberá o Email dentro do MailTrap:

![image](https://user-images.githubusercontent.com/54550561/226721338-35fdf277-250b-4bfe-bba2-6bae6adb7521.png)

![image](https://user-images.githubusercontent.com/54550561/226721721-84d623d7-8857-4a5a-80e4-9293c0270f2c.png)

Após isso já pode rodar o seguinte comando:

``` 
php artisan serve
```

Para iniciar o Servidor

e abra outra janela do terminal/cmd e rode o comando:

``` 
php artisan queue:work
```

para rodar os testes:

``` 
php artisan test
```

Para observar as notificações recebidas, e disparar o email.


Agora vamos criar o usuário:

Com as Endpoints fornecidos, faça a Requisição no Endpoint Register:

![image](https://user-images.githubusercontent.com/54550561/226723866-1cff185b-b667-4c94-aa4f-6210cad31b77.png)

Retornou o Usuário que foi Salvo, e vamos fazer o seguinte agora, copiar o token que ele gerou:

![image](https://user-images.githubusercontent.com/54550561/226724155-7ae63a76-c405-4414-989c-423f97c0dc57.png)

Após copiarmos o token que foi gerado,

ele deverá estar assim: 

```
96|iY3Mmx2DSS8Ly5qIuvJqD07zZmYkLs612wiQh3T7
```

Iremos no Endpoint: Criar Despesa

![image](https://user-images.githubusercontent.com/54550561/226724888-63d18c74-275d-4d0a-bf01-41f07ff44cbb.png)

Vamos adicionar o token que copiamos anteriormente.

Clique em auth do lado de JSON,
Clique em BearerToken

![image](https://user-images.githubusercontent.com/54550561/226725174-dec0e18c-8e47-4527-8ab1-8adaeea50370.png)

e cole o token que copiamos anteriormente em token:

![image](https://user-images.githubusercontent.com/54550561/226725498-3f3d5280-5a5a-483d-a700-dfa79e4086d5.png)

Após fazer isso já podemos clique em Send para cadastrar a Despesa:

![image](https://user-images.githubusercontent.com/54550561/226725847-b3bd24e1-5a4d-41ad-b0e5-0fe59f56d6ac.png)

e já cadastrou a despesa.

e para todos os outros endpoints de Despesa, temos que adicionar o token:

![image](https://user-images.githubusercontent.com/54550561/226726142-d1e05318-1dc8-4f92-8120-75a8b033e36b.png)

e Após cadastrar a nossa despesa, ele já aparece no Endpoint Get Despesas:

![image](https://user-images.githubusercontent.com/54550561/226726421-c4614554-077f-46dc-b19e-eee491cf458f.png)


### Endpoints estão no repositório, tanto pro insomnia, quanto pro postman.
