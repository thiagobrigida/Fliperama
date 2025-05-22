CREATE DATABASE IF NOT EXISTS fliperama;
USE fliperama;

CREATE TABLE Cliente (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    data_nascimento DATE,
    telefone VARCHAR(15)
);

CREATE TABLE Jogo (
    id_jogo INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    categoria VARCHAR(50),
    faixa_etaria INT
);

CREATE TABLE Maquina (
    id_maquina INT AUTO_INCREMENT PRIMARY KEY,
    numero_serie VARCHAR(50),
    id_jogo INT,
    estado VARCHAR(20),
    FOREIGN KEY (id_jogo) REFERENCES Jogo(id_jogo)
);

-- Tabela de Funcionários
CREATE TABLE Funcionario (
    id_funcionario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    turno VARCHAR(20),
    cargo VARCHAR(50)
);

CREATE TABLE SessaoJogo (
    id_sessao INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT,
    id_maquina INT,
    id_funcionario INT, -- novo campo
    data_hora_inicio DATETIME,
    data_hora_fim DATETIME,
    FOREIGN KEY (id_cliente) REFERENCES Cliente(id_cliente),
    FOREIGN KEY (id_maquina) REFERENCES Maquina(id_maquina),
    FOREIGN KEY (id_funcionario) REFERENCES Funcionario(id_funcionario)
);
