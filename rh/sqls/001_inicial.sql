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
    status_proposta CHAR(60) NOT NULL,

    PRIMARY KEY (id),
    FOREIGN KEY (programador) REFERENCES usuarios (id)
)
ENGINE = InnoDB;


INSERT INTO usuarios (email, senha, programador, telefone, sobre, nome, sobrenome, genero, cidade, uf, criado_dia, idade, empresa, admin) 
VALUES ('rh@admin.com', '$2y$10$/6aH1pW4RKYRFcvKC83JJ.AMSerCItzea57qRHTTLACwRZpkGfs4q', false, '99999-9999', 'Gerente de RH em busca de novos programadores qualificados para trabalhar na nossa empresa', 'Alice', 'Martins Goncalves', 'F', 'Sao Paulo', 'SP', '2023-01-01', 38, 'CodeWave', true),
('boss@admin.com', '$2y$10$/6aH1pW4RKYRFcvKC83JJ.AMSerCItzea57qRHTTLACwRZpkGfs4q', false, '99999-8888', 'Dono de uma empresa de tecnologia que busca codificar a solucao dos seus problemas', 'Lucas', 'Almeida Sousa','M', 'Porto Alegre', 'SC', '2023-01-01', 38, 'CodeWave', false),
('luisa@teste.com', '$2y$10$9kvdlz27Z.nsO9vdl1KSeei5cYiH.HEzUWpJw7loYLb4TBUHKrqwi', 1, '4299999999', 'UHASUIASH', 'Luisa', 'Rodrigues', 'F', 'Guarapuava', 'PR', '2023-06-13', 35, NULL, 0),
('mark@teste.com', '$2y$10$9kvdlz27Z.nsO9vdl1KSeei5cYiH.HEzUWpJw7loYLb4TBUHKrqwi', 1, '4299999999', 'UHASUIASH', 'Mark', 'Otto', 'M', 'Curitiba', 'PR', '2023-06-13', 30, NULL, 0),
('alina@teste.com', '$2y$10$9kvdlz27Z.nsO9vdl1KSeei5cYiH.HEzUWpJw7loYLb4TBUHKrqwi', 1, '4299999999', 'UHASUIASH', 'Alina', 'Souza', 'F', 'Guarapuava', 'PR', '2023-06-13', 29, NULL, 0),
('larry@teste.com', '$2y$10$9kvdlz27Z.nsO9vdl1KSeei5cYiH.HEzUWpJw7loYLb4TBUHKrqwi', 1, '4299999999', 'UHASUIASH', 'Larry', 'Johnson', 'M', 'São Paulo', 'SP', '2023-06-13', 40, NULL, 0),
('john@teste.com', '$2y$10$9kvdlz27Z.nsO9vdl1KSeei5cYiH.HEzUWpJw7loYLb4TBUHKrqwi', 1, '4299999999', 'UHASUIASH', 'John', 'Doe', 'M', 'Cascavel', 'PR', '2023-06-13', 33, NULL, 0);


