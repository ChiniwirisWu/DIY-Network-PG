DROP DATABASE diynetwork;

CREATE DATABASE diynetwork;

USE diynetwork;

/*
Longitudes de FK
codigos INT 20
alias VARCHAR 30
*/

CREATE TABLE usuario(
  codigo INT(20) PRIMARY KEY AUTO_INCREMENT,
  alias VARCHAR(30) NOT NULL UNIQUE,
  clave VARCHAR(100) NOT NULL
);

INSERT INTO usuario (codigo, alias, clave) VALUES 
  (1,"admin","$2y$10$EXBOpfSoMyQZBdr50FyGGOCPXWSjGdpWCrOU71lTVXOQ3E30x076q"),
  (2,"user","$2y$10$EXBOpfSoMyQZBdr50FyGGOCPXWSjGdpWCrOU71lTVXOQ3E30x076q"),
  (3,"worker","$2y$10$EXBOpfSoMyQZBdr50FyGGOCPXWSjGdpWCrOU71lTVXOQ3E30x076q");



CREATE TABLE seguidor(
  fk_seguidor INT(20) NOT NULL,
  fk_usuario INT(20) NOT NULL,
  PRIMARY KEY(fk_seguidor, fk_usuario),
  FOREIGN KEY (fk_seguidor) REFERENCES usuario (codigo) ON DELETE CASCADE, 
  FOREIGN KEY (fk_usuario) REFERENCES usuario (codigo) ON DELETE CASCADE
);

INSERT INTO seguidor(fk_seguidor, fk_usuario) VALUES
  (1, 2),
  (3, 2),
  (2, 3),
  (2, 1);



CREATE TABLE material(
  alias VARCHAR(30) PRIMARY KEY
);

INSERT INTO material (alias) VALUES
  ("Pegamento blanco"),
  ("Pintura al frio"),
  ("Papel de cocina"),
  ("Bombillos led"),
  ("Tierra"),
  ("Planta"),
  ("Pinceles");

/*
materiales = "239013, 283941, 390424" (lista de codigo de materiales separada por el delimitador ",")
instrucciones " lorem ipsumlorem ipsumlorem ipsumlorem ipsum&ipsumlorem ipsum" (lista de parrafos separado por el delimitador "&")
*/
CREATE TABLE publicacion(
  codigo INT(20) PRIMARY KEY AUTO_INCREMENT,
  fk_autor INT(20) NOT NULL,
  materiales VARCHAR(5000) NOT NULL,
  titulo VARCHAR(2000) NOT NULL,
  imagenes VARCHAR(5000) NOT NULL,
  portada VARCHAR(2000) NOT NULL,
  instrucciones VARCHAR(10000) NOT NULL,
  fecha_publicacion TIMESTAMP NOT NULL,
  FOREIGN KEY (fk_autor) REFERENCES usuario (codigo) ON DELETE CASCADE
);

INSERT INTO publicacion (codigo, fk_autor, titulo, instrucciones, materiales, fecha_publicacion, imagenes, portada) VALUES
  (3,3,"Estante Flotante","Consigue una tabla de madera y soportes ocultos & Mide y corta la tabla a la longitud deseada & Lija los bordes para un acabado suave & Marca los puntos de fijación en la pared & Fija los soportes a la pared & Coloca la tabla sobre los soportes y asegúrate de que esté nivelada.", "Tierra,Planta&Pinceles", CURRENT_TIMESTAMP, "https://i.etsystatic.com/9018194/r/il/490710/5040623246/il_570xN.5040623246_8wle.jpg", "https://i.etsystatic.com/9018194/r/il/490710/5040623246/il_570xN.5040623246_8wle.jpg");



/*la tabla favorito es para las publicaciones que le gustan al usuario*/
CREATE TABLE voto(
  fk_publicacion INT(20) NOT NULL,
  fk_usuario INT(20) NOT NULL,
  puntuacion FLOAT(20) NOT NULL,
  FOREIGN KEY (fk_publicacion) REFERENCES publicacion (codigo) ON DELETE CASCADE,
  FOREIGN KEY (fk_usuario) REFERENCES usuario (codigo) ON DELETE CASCADE
);


/*la tabla guardado es para las publicaciones que guarda el usuario*/
CREATE TABLE guardado(
  fk_publicacion INT(20) NOT NULL,
  fk_usuario INT(20) NOT NULL,
  fecha_agregacion DATE NOT NULL,
  FOREIGN KEY (fk_publicacion) REFERENCES publicacion (codigo) ON DELETE CASCADE,
  FOREIGN KEY (fk_usuario) REFERENCES usuario (codigo) ON DELETE CASCADE
);


