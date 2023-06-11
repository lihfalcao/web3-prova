CREATE DATABASE rh COLLATE 'utf8_unicode_ci';

CREATE TABLE usuarios (
    id INT NOT NULL AUTO_INCREMENT ,
    email VARCHAR(255) NOT NULL ,
    senha CHAR(60) NOT NULL ,
    programador BOOLEAN NOT NULL DEFAULT 0,
    telefone CHAR(60) NULL ,
    sobre VARCHAR(255) NULL ,
    nome CHAR(60) NULL ,
    sobrenome CHAR(60) NULL ,
    genero CHAR(60) NULL ,
    cidade CHAR(60) NULL ,
    uf CHAR(60) NULL ,
    criado_dia DATE NULL ,
    idade INT NULL ,
    empresa CHAR(60) NULL,
    admin BOOLEAN NOT NULL DEFAULT 0,

    PRIMARY KEY (id)
)
ENGINE = InnoDB;

CREATE TABLE vagas (
    id INT NOT NULL AUTO_INCREMENT ,
    cargo CHAR(60) NOT NULL ,
    framework CHAR(60) NOT NULL ,
    salario DECIMAL NOT NULL ,
    tipo CHAR(60) NOT NULL ,
    data_convite  DATE NOT NULL ,
    programador INT NOT NULL ,
    resposta BOOLEAN NULL ,
    status_proposta BOOLEAN NULL ,

    PRIMARY KEY (id),
    FOREIGN KEY (programador) REFERENCES usuarios (id)
)
ENGINE = InnoDB;


INSERT INTO usuarios (email, senha, programador, telefone, sobre, nome, sobrenome, genero, cidade, uf, criado_dia, idade, empresa, admin) 
VALUES ('rh@admin.com', '$2y$10$/6aH1pW4RKYRFcvKC83JJ.AMSerCItzea57qRHTTLACwRZpkGfs4q', false, '99999-9999', 'Gerente de RH em busca de novos programadores qualificados para trabalhar na nossa empresa', 'Alice', 'Martins Goncalves', 'F', 'Sao Paulo', 'SP', '2023-01-01', 38, 'CodeWave', true),
('boss@admin.com', '$2y$10$/6aH1pW4RKYRFcvKC83JJ.AMSerCItzea57qRHTTLACwRZpkGfs4q', false, '99999-8888', 'Dono de uma empresa de tecnologia que busca codificar a solucao dos seus problemas', 'Lucas', 'Almeida Sousa','M', 'Porto Alegre', 'SC', '2023-01-01', 38, 'CodeWave', false);
