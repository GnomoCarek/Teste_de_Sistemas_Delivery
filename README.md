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

---

### Testes Automatizados com Selenium

Para criar scripts de teste de interface com Selenium, você precisará interagir com os elementos do formulário. Abaixo estão os principais seletores (`id` e `name`) que você pode usar.

**Página de Cadastro (`cadastro.php`)**
-   Nome Completo: `id="nome"`, `name="nome"`
-   E-mail: `id="email"`, `name="email"`
-   Senha: `id="senha"`, `name="senha"`
-   Data de Nascimento: `id="data_nascimento"`, `name="data_nascimento"`
-   Sexo: `id="sexo"`, `name="sexo"`
-   Botão Cadastrar: `//button[@type='submit']`

**Página de Login (`login.php`)**
-   E-mail: `id="email"`, `name="email"`
-   Senha: `id="senha"`, `name="senha"`
-   Botão Entrar: `//button[@type='submit']`

**Página de Cadastro de Produto (`cadastro_de_produto.php`)**
-   Nome do Produto: `id="nome"`, `name="nome"`
-   Preço de Venda: `id="preco"`, `name="preco"`
-   Desconto: `id="desconto"`, `name="desconto"`
-   Quantidade: `id="quantidade"`, `name="quantidade"`
-   Detalhes: `id="detalhes"`, `name="detalhes"`
-   Botão Salvar: `//button[@type='submit']`

---

### Testes de Carga com JMeter

Para simular o comportamento do usuário e testar a performance, configure os seguintes "Samplers" de Requisição HTTP no seu plano de teste.

**Importante**: Para simular um usuário logado, você precisa adicionar um **Gerenciador de Cookies HTTP** ao seu plano de teste para que a sessão seja mantida entre as requisições.

**1. Cadastro de Usuário**
-   **Servidor/IP**: `localhost`
-   **Método**: `POST`
-   **Caminho**: `/Teste_de_Sistemas_Delivery/cadastro.php`
-   **Parâmetros da Requisição**:
    -   `nome`: (ex: `Teste JMeter`)
    -   `email`: (ex: `jmeter@teste.com` - use a função `${__UUID()}` para gerar emails únicos)
    -   `senha`: (ex: `123456`)
    -   `data_nascimento`: (ex: `2000-01-01`)
    -   `sexo`: `outro`

**2. Login de Usuário**
-   **Servidor/IP**: `localhost`
-   **Método**: `POST`
-   **Caminho**: `/Teste_de_Sistemas_Delivery/login.php`
-   **Parâmetros da Requisição**:
    -   `email`: (o email usado no cadastro)
    -   `senha`: (a senha usada no cadastro)

**3. Cadastro de Produto (Requer Login/Sessão Ativa)**
-   **Servidor/IP**: `localhost`
-   **Método**: `POST`
-   **Caminho**: `/Teste_de_Sistemas_Delivery/cadastro_de_produto.php`
-   **Parâmetros da Requisição**:
    -   `nome`: `Produto JMeter`
    -   `preco`: `99.99`
    -   `desconto`: `10`
    -   `quantidade`: `100`
    -   `detalhes`: `Descrição do produto de teste`
