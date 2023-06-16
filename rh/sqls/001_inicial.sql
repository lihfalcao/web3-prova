CREATE DATABASE rh COLLATE 'utf8_unicode_ci';

CREATE TABLE usuarios (
    id INT NOT NULL AUTO_INCREMENT ,
    email VARCHAR(255) NOT NULL ,
    senha CHAR(60) NOT NULL ,
    programador BOOLEAN NOT NULL DEFAULT 0,
    telefone CHAR(60) NULL ,
    sobre TEXT NULL ,
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
    salario CHAR(60) NOT NULL ,
    tipo CHAR(60) NOT NULL ,
    data_convite  DATE NOT NULL ,
    programador INT NOT NULL ,
    status_proposta CHAR(60) NOT NULL,

    PRIMARY KEY (id),
    FOREIGN KEY (programador) REFERENCES usuarios (id)
)
ENGINE = InnoDB;


INSERT INTO usuarios (email, senha, programador, telefone, sobre, nome, sobrenome, genero, cidade, uf, criado_dia, idade, empresa, admin) 
VALUES ('rh@admin.com', '$2y$10$/6aH1pW4RKYRFcvKC83JJ.AMSerCItzea57qRHTTLACwRZpkGfs4q', false, '11999999999', 'Gerente de RH em busca de novos programadores qualificados para trabalhar na nossa empresa', 'Alice', 'Martins', 'F', 'Sao Paulo', 'SP', '2023-01-01', 38, 'CodeWave', true),
('boss@admin.com', '$2y$10$/6aH1pW4RKYRFcvKC83JJ.AMSerCItzea57qRHTTLACwRZpkGfs4q', false, '47999998888', 'Dono de uma empresa de tecnologia que busca codificar a solucao dos seus problemas', 'Lucas', 'Almeida','M', 'Porto Alegre', 'SC', '2023-01-01', 38, 'CodeWave', false),
('luisa@teste.com', '$2y$10$9kvdlz27Z.nsO9vdl1KSeei5cYiH.HEzUWpJw7loYLb4TBUHKrqwi', true, '4299999999', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eu lacus eu neque pretium malesuada in sed ipsum. Integer eget risus blandit, elementum elit sit amet, dignissim velit. Duis nunc urna, vestibulum ac arcu at, lobortis suscipit nisi. Nam feugiat felis id eros fermentum, et consectetur lorem viverra. Mauris feugiat massa eget purus aliquam aliquet. Duis imperdiet at ligula quis pulvinar. Pellentesque eu posuere nulla. Mauris et massa justo. Praesent placerat facilisis eros. Integer ipsum risus, malesuada at tortor nec, vehicula suscipit nunc. Etiam in blandit velit, et aliquam ante. Sed vel mi nulla.<br/>Donec luctus malesuada viverra. Mauris facilisis molestie pretium. Integer luctus dapibus metus, auctor venenatis erat consequat nec. Nulla at ex sed ante finibus dictum eu a lectus. Vivamus porta non velit ut elementum. Duis porttitor felis et ipsum iaculis, eu vestibulum neque ullamcorper. Morbi pellentesque lectus metus, at iaculis mi lacinia sit amet. Ut accumsan diam nisi, vel rhoncus tortor pharetra vitae. Aliquam et turpis lacinia, iaculis ante vel, fringilla dolor. Vivamus euismod tempor pharetra. Nunc orci sapien, vehicula quis lacus eget, convallis euismod odio.', 'Luisa', 'Rodrigues', 'F', 'Guarapuava', 'PR', '2023-06-13', 35, NULL, false),
('mark@teste.com', '$2y$10$9kvdlz27Z.nsO9vdl1KSeei5cYiH.HEzUWpJw7loYLb4TBUHKrqwi', true, '4199999999', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eu lacus eu neque pretium malesuada in sed ipsum. Integer eget risus blandit, elementum elit sit amet, dignissim velit. Duis nunc urna, vestibulum ac arcu at, lobortis suscipit nisi. Nam feugiat felis id eros fermentum, et consectetur lorem viverra. Mauris feugiat massa eget purus aliquam aliquet. Duis imperdiet at ligula quis pulvinar. Pellentesque eu posuere nulla. Mauris et massa justo. Praesent placerat facilisis eros. Integer ipsum risus, malesuada at tortor nec, vehicula suscipit nunc. Etiam in blandit velit, et aliquam ante. Sed vel mi nulla.<br/>Donec luctus malesuada viverra. Mauris facilisis molestie pretium. Integer luctus dapibus metus, auctor venenatis erat consequat nec. Nulla at ex sed ante finibus dictum eu a lectus. Vivamus porta non velit ut elementum. Duis porttitor felis et ipsum iaculis, eu vestibulum neque ullamcorper. Morbi pellentesque lectus metus, at iaculis mi lacinia sit amet. Ut accumsan diam nisi, vel rhoncus tortor pharetra vitae. Aliquam et turpis lacinia, iaculis ante vel, fringilla dolor. Vivamus euismod tempor pharetra. Nunc orci sapien, vehicula quis lacus eget, convallis euismod odio.', 'Mark', 'Otto', 'M', 'Curitiba', 'PR', '2023-06-13', 30, NULL, false),
('alina@teste.com', '$2y$10$9kvdlz27Z.nsO9vdl1KSeei5cYiH.HEzUWpJw7loYLb4TBUHKrqwi', true, '4299999999', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eu lacus eu neque pretium malesuada in sed ipsum. Integer eget risus blandit, elementum elit sit amet, dignissim velit. Duis nunc urna, vestibulum ac arcu at, lobortis suscipit nisi. Nam feugiat felis id eros fermentum, et consectetur lorem viverra. Mauris feugiat massa eget purus aliquam aliquet. Duis imperdiet at ligula quis pulvinar. Pellentesque eu posuere nulla. Mauris et massa justo. Praesent placerat facilisis eros. Integer ipsum risus, malesuada at tortor nec, vehicula suscipit nunc. Etiam in blandit velit, et aliquam ante. Sed vel mi nulla.<br/>Donec luctus malesuada viverra. Mauris facilisis molestie pretium. Integer luctus dapibus metus, auctor venenatis erat consequat nec. Nulla at ex sed ante finibus dictum eu a lectus. Vivamus porta non velit ut elementum. Duis porttitor felis et ipsum iaculis, eu vestibulum neque ullamcorper. Morbi pellentesque lectus metus, at iaculis mi lacinia sit amet. Ut accumsan diam nisi, vel rhoncus tortor pharetra vitae. Aliquam et turpis lacinia, iaculis ante vel, fringilla dolor. Vivamus euismod tempor pharetra. Nunc orci sapien, vehicula quis lacus eget, convallis euismod odio.', 'Alina', 'Souza', 'F', 'Guarapuava', 'PR', '2023-06-13', 29, NULL, false),
('larry@teste.com', '$2y$10$9kvdlz27Z.nsO9vdl1KSeei5cYiH.HEzUWpJw7loYLb4TBUHKrqwi', true, '1199999999', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eu lacus eu neque pretium malesuada in sed ipsum. Integer eget risus blandit, elementum elit sit amet, dignissim velit. Duis nunc urna, vestibulum ac arcu at, lobortis suscipit nisi. Nam feugiat felis id eros fermentum, et consectetur lorem viverra. Mauris feugiat massa eget purus aliquam aliquet. Duis imperdiet at ligula quis pulvinar. Pellentesque eu posuere nulla. Mauris et massa justo. Praesent placerat facilisis eros. Integer ipsum risus, malesuada at tortor nec, vehicula suscipit nunc. Etiam in blandit velit, et aliquam ante. Sed vel mi nulla.<br/>Donec luctus malesuada viverra. Mauris facilisis molestie pretium. Integer luctus dapibus metus, auctor venenatis erat consequat nec. Nulla at ex sed ante finibus dictum eu a lectus. Vivamus porta non velit ut elementum. Duis porttitor felis et ipsum iaculis, eu vestibulum neque ullamcorper. Morbi pellentesque lectus metus, at iaculis mi lacinia sit amet. Ut accumsan diam nisi, vel rhoncus tortor pharetra vitae. Aliquam et turpis lacinia, iaculis ante vel, fringilla dolor. Vivamus euismod tempor pharetra. Nunc orci sapien, vehicula quis lacus eget, convallis euismod odio.', 'Larry', 'Johnson', 'M', 'São Paulo', 'SP', '2023-06-13', 40, NULL, false),
('john@teste.com', '$2y$10$9kvdlz27Z.nsO9vdl1KSeei5cYiH.HEzUWpJw7loYLb4TBUHKrqwi', true, '4599999999', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eu lacus eu neque pretium malesuada in sed ipsum. Integer eget risus blandit, elementum elit sit amet, dignissim velit. Duis nunc urna, vestibulum ac arcu at, lobortis suscipit nisi. Nam feugiat felis id eros fermentum, et consectetur lorem viverra. Mauris feugiat massa eget purus aliquam aliquet. Duis imperdiet at ligula quis pulvinar. Pellentesque eu posuere nulla. Mauris et massa justo. Praesent placerat facilisis eros. Integer ipsum risus, malesuada at tortor nec, vehicula suscipit nunc. Etiam in blandit velit, et aliquam ante. Sed vel mi nulla.<br/>Donec luctus malesuada viverra. Mauris facilisis molestie pretium. Integer luctus dapibus metus, auctor venenatis erat consequat nec. Nulla at ex sed ante finibus dictum eu a lectus. Vivamus porta non velit ut elementum. Duis porttitor felis et ipsum iaculis, eu vestibulum neque ullamcorper. Morbi pellentesque lectus metus, at iaculis mi lacinia sit amet. Ut accumsan diam nisi, vel rhoncus tortor pharetra vitae. Aliquam et turpis lacinia, iaculis ante vel, fringilla dolor. Vivamus euismod tempor pharetra. Nunc orci sapien, vehicula quis lacus eget, convallis euismod odio.', 'John', 'Doe', 'M', 'Cascavel', 'PR', '2023-06-13', 33, NULL, false);




