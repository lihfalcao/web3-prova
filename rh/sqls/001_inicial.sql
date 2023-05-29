CREATE DATABASE rh COLLATE 'utf8_unicode_ci';

CREATE TABLE usuarios (
    id INT NOT NULL AUTO_INCREMENT ,
    email VARCHAR(255) NOT NULL ,
    senha CHAR(60) NOT NULL ,
    tipo CHAR(60) NOT NULL ,
    telefone CHAR(60) NULL ,
    sobre VARCHAR(255) NULL ,
    nome CHAR(60) NULL ,
    cidade CHAR(60) NULL ,
    uf CHAR(60) NULL ,
    criado_dia DATE NULL ,
    idade INT NULL ,
    foto CHAR(60) NULL ,
    empresa INT NULL,
    disponivel CHAR(60) NULL,

    PRIMARY KEY (id)
)
ENGINE = InnoDB;

CREATE TABLE vagas (
    id INT NOT NULL AUTO_INCREMENT ,
    cargo CHAR(60) NOT NULL ,
    framework CHAR(60) NOT NULL ,
    salario INT NOT NULL ,
    tipo CHAR(60) NOT NULL ,
    data_convite  DATE NOT NULL ,
    quem_convidou INT NOT NULL ,
    programador INT NOT NULL ,
    resposta BOOLEAN NULL ,
    status_proposta CHAR(60) NOT NULL ,

    PRIMARY KEY (id),
    FOREIGN KEY (programador) REFERENCES usuarios (id),
    FOREIGN KEY (quem_convidou) REFERENCES usuarios (id)
)
ENGINE = InnoDB;
