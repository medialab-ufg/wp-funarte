# wp-funarte



# Ativar o automatizador de tarefas

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
```

Com o término da instalação dos arquivos, basta executar o comando **gulp** e pronto. Os arquivos **/assets/css/base.scss** e **/assets/js/base.js** estarão sendo observados e automaticamente atualizarão os arquivos **base.min.css** e **base.min.js** , respectivamente, cada vez que forem alterados. Um aviso de confirmação será exibido na tela cada vez que isso acontecer.

É importante lembrar que, a cada novo trabalho a ser feito nesses arquivos, um terminal ou prompt de comando deve ser aberto e o comando gulp deve ser executado na pasta do tema.