# Projeto de Delivery para Testes de Sistemas

Uma aplicação web simples de delivery desenvolvida em PHP puro, utilizando JSON como sistema de armazenamento de dados. Este projeto foi criado como um ambiente de testes para praticar automação com Selenium e testes de carga com JMeter.

## Funcionalidades

- Cadastro de usuários
- Login e Logout de usuários com gerenciamento de sessão
- Dashboard de boas-vindas para usuários logados
- Cadastro de produtos (nome, preço, detalhes, etc.)
- Listagem de produtos
- Simulação de pedido

## Instalação e Execução (XAMPP)

Siga os passos abaixo para executar o projeto localmente usando o XAMPP.

1.  **Instale o XAMPP**: Baixe e instale o XAMPP do site oficial [Apache Friends](https://www.apachefriends.org/index.html).
2.  **Inicie o Apache**: Abra o painel de controle do XAMPP e inicie o módulo "Apache".
3.  **Clone o Repositório**: Navegue até a pasta `htdocs` dentro do seu diretório de instalação do XAMPP (ex: `C:/xampp/htdocs/`) e clone o repositório:
    ```bash
    git clone https://github.com/GnomoCarek/Teste_de_Sistemas_Delivery.git
    ```
4.  **Acesse o Projeto**: Abra seu navegador e acesse a URL para a página de cadastro para começar:
    [http://localhost/Teste_de_Sistemas_Delivery/cadastro.php](http://localhost/Teste_de_Sistemas_Delivery/cadastro.php)

## Guia de Testes

### Teste Manual

Para garantir que tudo está funcionando, siga o fluxo principal da aplicação:

1.  **Cadastre-se** na página de cadastro.
2.  **Faça login** com as credenciais recém-criadas.
3.  No Dashboard, clique em **"Cadastrar Produto"** e adicione um ou mais itens.
4.  Volte ao Dashboard e clique em **"Ver Produtos"** para ver a lista.
5.  Clique em **"Fazer Pedido"** em um dos produtos para simular um pedido.
6.  Use o link **"Sair"** para fazer logout.
