CREATE TABLE Usuario (
	IdUsuario INT PRIMARY KEY AUTO_INCREMENT,
    Nome VARCHAR(200) NOT NULL,
    Cpf	VARCHAR(14) NOT NULL,
    Email VARCHAR(200) NOT NULL UNIQUE,
    Cep VARCHAR(8) NOT NULL,
    Endereco VARCHAR(200) NOT NULL,
    Numero VARCHAR(10) NOT NULL,
    Bairro VARCHAR(200) NOT NULL,
    Cidade VARCHAR(50) NOT NULL,
    Estado VARCHAR(2) NOT NULL,
    Telefone VARCHAR(11) NOT NULL,
	Senha VARCHAR(20)    
)