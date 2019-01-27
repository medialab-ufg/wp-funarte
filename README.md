# wp-funarte

## Instalando o Ambiente

### Dependências:
Instale as seguintes dependências:

* apache
* mysql
* git

#### Instalando o composer

```
php -r "copy ('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
php -r "unlink('composer-setup.php');"
mv composer.phar /usr/local/bin/composer
```

#### Instalando o wp-cli
```
curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
chmod +x wp-cli.phar
sudo mv wp-cli.phar /usr/local/bin/wp
```


### Clone do repositório

Fazer um clone do repositório para a raiz do diretório público do apache. Execute o comando a seguir:

```
git clone https://github.com/medialab-ufg/wp-funarte.git
```

Acesse o diretório onde se localiza o repositório que foi feito o clone e crie os arquivos de configurações baseados nos arquivos de exemplos presentes no repositório:
```
  cp wp-config-sample.php wp-config.php
  cp .htaccess-sample .htaccess
```
no arquivo **wp-config.php** deve ser alterado as configurações para acesso a base de dados, certifique-se de que tenha configurado previa e corretamente um banco de dados para uso na aplicação:
```
define('DB_NAME'      ,'[<database-name>]');
define('DB_USER'      ,'[<username>]');
define('DB_PASSWORD'  ,'[<password>]');
define('DB_HOST'      ,'[<localhost>]');
```

Ainda no arquivo **wp-config.php** verifique os valores para `WP_SITEURL`, `WP_HOME` e `WP_CONTENT_URL`, e coloque o endereço do seu ambiente. Por exemplo:

```
define('WP_SITEURL', 'http://localhost/funarte/wp');
define('WP_HOME', 'http://localhost/funarte' );

define('WP_CONTENT_DIR', dirname( __FILE__ ) . '/wp-content' );
define('WP_CONTENT_URL', 'http://localhost/funarte/wp-content' );
```

Não é preciso alterar o valor de `WP_CONTENT_DIR`.

Edite o arquivo `.htaccess` e verifique os valores para `RewriteBase` e para a última `RewriteRule`. Se seu ambiente roda na raíz do servidor, não é preciso fazer alteração. Se está em uma subpasta, ela deve ser adicionada. Por exemplo, se o ambiente roda em `localhost/funarte`, coloque:

```
...
RewriteBase /funarte/
...
RewriteRule . /funarte/index.php [L]
...
```

Acesse o diretório onde se localiza o repositório que foi feito o clone. E execute o comando para instalar os repositórios do projeto.

```
composer install
```

Agora você está com todas as bibliotecas e classes necessárias para o funcionamento do site.



# Outras informações:

## Compilando **sass** e **javascript**
#### Ativar o automatizador de tarefas

Primeiramente devemos instalar o **gulp**. No link abaixo há um passo a passo de como realizar essa tarefa:
```
https://gulpjs.com/docs/en/getting-started/quick-start
```

Com o **gulp** devidamente instalado, agora devemos abrir um terminal no linux/mac ou o prompt de comando no windows e nos dirigir à pasta do tema:
```
[caminho da pasta do wordpress]/wp-content/themes/funarte
```

Certifique-se de que o tema possui os arquivos **gulpfile.js** e **package.json**. Em seguida, execute o comando abaixo e aguarde.
```
npm install
gulp
```

Com o término da instalação dos arquivos, basta executar o comando **gulp** e pronto. Os arquivos **/assets/css/base.scss** e **/assets/js/base.js** estarão sendo observados e automaticamente atualizarão os arquivos **base.min.css** e **base.min.js** , respectivamente, cada vez que forem alterados. Um aviso de confirmação será exibido na tela cada vez que isso acontecer.

É importante lembrar que, a cada novo trabalho a ser feito nesses arquivos, um terminal ou prompt de comando deve ser aberto e o comando gulp deve ser executado na pasta do tema.
