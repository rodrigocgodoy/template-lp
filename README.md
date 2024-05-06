# Template para Desenvolvimento de Landing Pages

Este é um template de projeto desenvolvido para facilitar a criação de landing pages destinadas a lançamentos de produtos ou serviços. Utiliza uma combinação eficiente de Gulp e PHP para automatizar tarefas e agilizar o processo de desenvolvimento.

## Funcionalidades

- **Gulp**: O Gulp é uma ferramenta de automação de tarefas que ajuda a otimizar o fluxo de trabalho de desenvolvimento. Neste projeto, o Gulp é utilizado para tarefas como compilação de SASS, minificação de CSS e JavaScript, otimização de imagens, entre outras.

- **PHP**: O PHP é uma linguagem de script amplamente utilizada para o desenvolvimento web. Neste projeto, o PHP é empregado para a criação de componentes reutilizáveis, como cabeçalhos, rodapés e formulários de contato.

- **SASS**: SASS é uma extensão da linguagem CSS que adiciona características como variáveis, aninhamento e mixins. Isso permite uma estilização mais eficiente e organizada das páginas.

- **HTML**: O HTML é a linguagem de marcação padrão para a criação de páginas web. As landing pages neste projeto são construídas utilizando HTML semântico e acessível.

## Como Usar

1. Clone este repositório para o seu ambiente de desenvolvimento local.
2. Certifique-se de ter o Node.js e o Gulp instalados globalmente em sua máquina.
3. Execute `npm install` para instalar as dependências do projeto.
4. Utilize os arquivos na pasta `dev` para desenvolver sua landing page.
5. Atualize a váriavel `projectProxy` para o destino do seu projeto no servidor local da sua máquina.
5. Execute `gulp` no terminal para iniciar o servidor de desenvolvimento e observar as mudanças nos arquivos.
6. Após concluir o desenvolvimento, execute `gulp build` para gerar os arquivos otimizados na pasta `build`.

## Estrutura do Projeto

```
├── dev/                  # Arquivos de desenvolvimento
│   ├── scss/             # Arquivos SCSS
│   ├── js/               # Arquivos JavaScript
│   ├── assets/           # Imagens
│   └── index.php         # Página inicial
├── dist/                 # Arquivos otimizados para rodar no servidor da sua máquina
├── build/                # Arquivos otimizados para produção
├── node_modules/         # Dependências do Node.js
├── gulpfile.js           # Configuração do Gulp
├── package.json          # Dependências do projeto
└── README.md             # Este arquivo
```

## Contribuição

Contribuições são bem-vindas! Sinta-se à vontade para abrir issues ou enviar pull requests para melhorar este projeto.

## Licença

Este projeto é licenciado sob a [MIT License](LICENSE).

---

Este template de projeto oferece uma base sólida e flexível para o desenvolvimento de landing pages para lançamentos de produtos ou serviços. Ao utilizar ferramentas como Gulp e PHP, você pode agilizar o processo de desenvolvimento e criar páginas web altamente eficazes e visualmente atraentes.
