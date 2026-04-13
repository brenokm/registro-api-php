--Sistema de Cadastro com PHP + Fetch:

Aplicação simples de cadastro de usuários utilizando PHP (PDO) no backend e JavaScript (Fetch API) no frontend, com comunicação via JSON e interface dinâmica sem recarregamento de página.

--Tecnologias utilizadas:

->PHP (PDO)
->MySQL
->JavaScript (Fetch API)
->HTML5
->CSS3


--Funcionalidades

->Cadastro de usuário
->Validação de senha e confirmação
->Comunicação assíncrona
->Exibição de mensagens dinâmicas (sem reload)
->Hash seguro de senha com password_hash
->Inserção no banco de dados com prepared statements

--Segurança:

->Uso de prepared statements (PDO) → proteção contra SQL Injection
->Senhas armazenadas com hash seguro (password_hash)
->Validação básica de dados no backend


--Observações

->Projeto focado em aprendizado de integração front/back
->Estrutura simples, ideal para evolução futura (login, autenticação, etc.)
->Pode ser expandido para arquitetura MVC ou API REST completa
