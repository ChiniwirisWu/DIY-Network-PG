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
  (1,"Robert Downey Jr","12345"),
  (2,"Robert De niro","robert123"),
  (3,"Victoria Secret","bagsandshi");



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
  codigo INT(20) PRIMARY KEY AUTO_INCREMENT,
  alias VARCHAR(30) NOT NULL UNIQUE
);

INSERT INTO material (codigo, alias) VALUES
  (1,"Pegamento blanco"),
  (2,"Pintura al frio"),
  (3,"Papel de cocina"),
  (4,"Bombillos led"),
  (5,"Tierra"),
  (6,"Planta"),
  (7,"Pinceles");

/*
materiales = "239013, 283941, 390424" (lista de codigo de materiales separada por el delimitador ",")
instrucciones " lorem ipsumlorem ipsumlorem ipsumlorem ipsum&ipsumlorem ipsum" (lista de parrafos separado por el delimitador "&")
*/
CREATE TABLE publicacion(
  codigo INT(20) PRIMARY KEY AUTO_INCREMENT,
  fk_autor INT(20) NOT NULL,
  materiales VARCHAR(500) NOT NULL,
  titulo VARCHAR(30) NOT NULL,
  introduccion VARCHAR(2000) NOT NULL,
  instrucciones VARCHAR(2000) NOT NULL,
  fecha_publicacion TIMESTAMP NOT NULL,
  FOREIGN KEY (fk_autor) REFERENCES usuario (codigo) ON DELETE CASCADE
);

INSERT INTO publicacion (codigo, fk_autor, titulo, introduccion, instrucciones, materiales, fecha_publicacion) VALUES
  (1, 1, "Jardín Vertical", "Construye un jardín vertical usando paletas de madera recicladas. Ideal para espacios pequeños, este proyecto permite cultivar plantas y hierbas aromáticas en la pared, mejorando el ambiente y aportando un toque natural a tu hogar.", "Consigue una paleta de madera & Lija la superficie para evitar astillas & Pinta o barniza la paleta si lo deseas & Coloca macetas pequeñas en los espacios de la paleta & Rellena las macetas con tierra y plantas & Fija la paleta a la pared con tornillos.", "3949204854&3948493845&9485746251", CURRENT_TIMESTAMP),
  (2, 2, "Lámpara LED DIY", "Crea una lámpara moderna utilizando luces LED, tubos de cobre y una base de madera. Este proyecto es fácil de personalizar y proporciona una iluminación cálida y acogedora, ideal para cualquier habitación de tu hogar. Además, es una excelente manera de reciclar materiales.", "Reúne tubos de cobre y una base de madera & Corta los tubos a la longitud deseada & Conecta los tubos para formar la estructura de la lámpara & Instala las luces LED en el interior & Conecta el cableado a un interruptor & Asegura todo en la base y enciende.", "9485746251&4853204854&3948392945", CURRENT_TIMESTAMP),
  (3,3,"Estante Flotante","Diseña un estante flotante minimalista que no solo es funcional, sino que también añade un toque decorativo a cualquier habitación. Este proyecto es ideal para organizar libros, plantas o decoraciones sin ocupar espacio en el suelo, manteniendo un ambiente ordenado y moderno.","Consigue una tabla de madera y soportes ocultos & Mide y corta la tabla a la longitud deseada & Lija los bordes para un acabado suave & Marca los puntos de fijación en la pared & Fija los soportes a la pared & Coloca la tabla sobre los soportes y asegúrate de que esté nivelada.", "9485930402&4853204854&9498587575", CURRENT_TIMESTAMP);



/*la tabla favorito es para las publicaciones que le gustan al usuario*/
CREATE TABLE favorito(
  fk_publicacion INT(20) NOT NULL,
  fk_usuario INT(20) NOT NULL,
  FOREIGN KEY (fk_publicacion) REFERENCES publicacion (codigo) ON DELETE CASCADE,
  FOREIGN KEY (fk_usuario) REFERENCES usuario (codigo) ON DELETE CASCADE
);

INSERT INTO favorito (fk_publicacion, fk_usuario) VALUES 
  (1,2),
  (1,3),
  (2,3),
  (3,1),
  (3,2);

/*la tabla guardado es para las publicaciones que guarda el usuario*/
CREATE TABLE guardado(
  fk_publicacion INT(20) NOT NULL,
  fk_usuario INT(20) NOT NULL,
  fecha_agregacion DATE NOT NULL,
  FOREIGN KEY (fk_publicacion) REFERENCES publicacion (codigo) ON DELETE CASCADE,
  FOREIGN KEY (fk_usuario) REFERENCES usuario (codigo) ON DELETE CASCADE
);

INSERT INTO guardado (fk_publicacion, fk_usuario, fecha_agregacion) VALUES
  (1,2, NOW()),
  (1,1, NOW()),
  (3,1, NOW());

