<h1 align="center"> Sistema de CRUD em PHP</h1>
<p align="center">

<p align="center">
  <a href="#-sobre">Sobre</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#-funcionalidades">Funcionalidades</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#-Para-Devs">Para Devs</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#-tecnologias">Tecnologias</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#-licença">Licença</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#-autor">Autor</a>
</p>

<p align="center">
  <img alt="License" src="https://img.shields.io/static/v1?label=license&message=MIT&color=49AA26&labelColor=000000">
</p>

<br><br>
## 🛈 Sobre
O Sistema de CRUD em PHP é um projeto que visa desenvolver um aplicativo web capaz de realizar as quatro principais operações em um banco de dados: `Create` (criação de novos registros), `Read` (leitura de registros existentes), `Update` (atualização de registros existentes) e `Delete` (exclusão de registros existentes). Essas operações são realizadas por meio de uma interface amigável, onde o usuário pode inserir, visualizar, editar e excluir dados de forma fácil e intuitiva. O sistema é desenvolvido em PHP, uma das linguagens de programação mais populares para o desenvolvimento web, e utiliza um banco de dados para armazenar as informações.

<br>

## 🔍 Funcionalidades
Este projeto foi criado com o objetivo de ajudar a controlar um cadastro de usuários de forma eficiente e fácil de usar. Com este sistema, você pode armazenar informações como nome, email e setor dos seus usuários, mas se preferir, pode personalizar os campos de acordo com as suas necessidades.

Com o Sistema de CRUD em PHP, você pode facilmente criar novos registros, visualizar informações já cadastradas, atualizar dados existentes e excluir registros antigos. Tudo isso através de uma interface amigável e intuitiva, que torna o gerenciamento de informações mais organizado e produtivo.

A seguir, um exemplo do Sistema de CRUD em PHP em pleno funcionamento. Com esta demonstração, você poderá visualizar as funcionalidades da aplicação e como ela pode ser utilizada para gerenciar um cadastro de usuários de forma simples e intuitiva.


<p align="center">
  <img src="https://github.com/marlonakio/NLW-Habits-Ignite/blob/main/.github/web/web-demo.gif?raw=true" alt="gif da aplicação web" width="100%"/>



## 👨‍💻 Para Devs
### Instalação

Antes de começar, você vai precisar ter instalado em sua máquina as seguintes ferramentas:
[Git](https://git-scm.com) e [Xampp](https://www.apachefriends.org/pt_br/download.html) no computador.
Além disso é bom ter um editor de código-fonte para trabalhar com o código como [VSCode](https://code.visualstudio.com/).

> ⚠ Assim que clonar o repositório, antes de executar o servidor é imprescindível configurar o arquivo .env para poder se conectar ao seu banco de dados.
- Clonar e executar

```bash
# Clone este repositório.
$ git clone https://github.com/marlonakio/Crud-Cadastro-PHP.git

# Acesse a pasta do projeto no terminal.
$ cd .\Crud-Cadastro-PHP\

# Instale as dependências com o composer
$ composer install
```

- Banco de dados
```sql
// Crie um banco de dados com o nome `crudPHP` e execute as seguintes queries para criar as tabelas `users` e `sectors`.

CREATE DATABASE crudPHP;
USE CrudPHP;

CREATE TABLE users (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  id_sectors VARCHAR(255) NOT NULL
);

CREATE TABLE sectors (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  description VARCHAR(255) NOT NULL
);
```

- .env
```env
// Preencha o arquivo env com as informações do seu banco

DRIVER="mysql"
USER="root"
PASSWORD=""
HOST="localhost"
DATABASE="crudPHP"
BASE_URL="http://localhost:8000"
```

- Executar o servidor
```bash
# Execute a aplicação em modo de desenvolvimento.
$ php -S localhost:8000 -t public/


# O servidor inciará na porta 8000 - acesse <http://localhost:8000>
```

### Banco de Dados
Abaixo temos o diagrama de entidade relacionamento do bando de dados criado para que a aplicação funcione.
<p align="center">
  <img src="https://raw.githubusercontent.com/marlonakio/Crud-Cadastro-PHP/7ff2e0326b04377053984f65a10b6fc509bac015/.github/db.svg?raw=true" alt="Exemplo da aplicação web" width="70%"/>

## 🚀 Tecnologias

Esse projeto foi desenvolvido com as seguintes tecnologias:

- HTML e CSS
- PHP
- Bootstrap
- JavaScript
- SQL
- Git e Github
  
[![My Skills](https://skillicons.dev/icons?i=html,css,php,bootstrap,js,mysql,git,github)](https://skillicons.dev)

## 🔒 Licença

Esse projeto está sob a licença MIT.

## 🤵 Autor
<div align="center">
<img src=https://images.weserv.nl/?url=avatars.githubusercontent.com/u/55859290?v=4&h=100&w=100&fit=cover&mask=circle&maxage=7d>
<h1>Marlon Akio Tochiro</h1>
<strong>Student Developer ⓒ 2023</strong>
<br/>
<br/>

<a href="https://www.linkedin.com/in/marlon-akio-ba1763134/" target="_blank">
<img alt="LinkedIn" src="https://img.shields.io/badge/linkedin-%230077B5.svg?style=for-the-badge&logo=linkedin&logoColor=white"/>
</a>

<a href="https://github.com/marlonakio" target="_blank">
<img alt="GitHub" src="https://img.shields.io/badge/github-%23121011.svg?style=for-the-badge&logo=github&logoColor=white"/>
</a>

<a href="mailto:marlon.akto@gmail.com" target="_blank">
<img alt="Gmail" src="https://img.shields.io/badge/Gmail-D14836?style=for-the-badge&logo=gmail&logoColor=white" />
</a>

<a href="https://wa.me/5511977769829?text=Ol%C3%A1%21" target="_blank">
<img alt="WhatsApp" src="https://img.shields.io/badge/WhatsApp-25D366?style=for-the-badge&logo=whatsapp&logoColor=white"/>
</a>


<br/>
<br/>
</div>
