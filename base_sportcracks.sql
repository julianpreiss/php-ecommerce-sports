DROP DATABASE IF EXISTS sportcracks;
CREATE DATABASE sportcracks;

USE sportcracks;

CREATE TABLE tipo_usuarios
(
	id_tipo 	TINYINT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
	tipo 		VARCHAR(80)			NOT NULL

)ENGINE = innoDB;

INSERT INTO tipo_usuarios (id_tipo, tipo)
VALUES (1, 'Admin'),
       (2, 'Común');

CREATE TABLE usuarios
(
	id_usuario	 	INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
	nombre			VARCHAR(80) 			NOT NULL, 
	apellido		VARCHAR(80)			NOT NULL, 
	email			VARCHAR(100) 	UNIQUE		NOT NULL,
	usuario		VARCHAR(80) 	UNIQUE		NOT NULL, 
	password		VARCHAR(80) 			NOT NULL,
	id_fk_tipo	    	TINYINT UNSIGNED            NOT NULL,

	FOREIGN KEY(id_fk_tipo) REFERENCES tipo_usuarios(id_tipo) ON DELETE CASCADE ON UPDATE CASCADE

) ENGINE = innoDB;

INSERT INTO usuarios
VALUES (1, 'Juli', 'Preiss', 'julian.preiss@davinci.edu.ar', 'juli.preiss', '$2y$10$Cl/AhxW5kIEBZyDrdK3q5uQFUflLPCkYj5kPYC5YHRPJlToFjdXpW', 1),
	(2, 'Andy', 'Quintero', 'yobani.quintero@davinci.edu.ar', 'andy.quintero', '$2y$10$iKAowvIIjdyhSkyNu.32COm8CFqYJA/MzC32GKFbyq2bobIRDiEFa', 1);


CREATE TABLE productos
(
	id_producto 	INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
	nombre 			VARCHAR(80) 		NOT NULL,
	marca			VARCHAR(20) 		NOT NULL,
	deporte			VARCHAR(20)			NOT NULL,
	medidas			VARCHAR(20)			NOT NULL,
	color		 	VARCHAR(30)			NOT NULL,
	img 			VARCHAR(45)			NOT NULL,
	precio			FLOAT(8, 2)			NOT NULL
) ENGINE=innoDB;

INSERT INTO productos
VALUES	(1, 'Mini Neo Trainer', 'Umbro', 'Futbol', 'Numero 3', 'Amarilla', 'umbro.webp', 899.99),
	(2, 'Real Madrid Madridista', 'Dribbling', 'Futbol','Numero 5', 'Blanca y Azul', 'madrid.webp', 1490.00),
	(3, 'Ufc Finale Estambul', 'Adidas', 'Futbol','Numero 5', 'Magenta y blanco', 'adidas.webp', 5999.00),
	(4, 'Uar Jaguares Naciones', 'Gilbert', 'Rugby','Numero 4', 'Blanca y celeste', 'guindapumas.webp', 5199.00),
	(5, 'Patriot Tubo X3', 'Nassau', 'Tenis', 'Standard', 'Verde', 'nassau.webp', 1250.00),
	(6, 'Court', 'Penn', 'Tenis', 'Standard', 'Verde', 'penn.webp', 1199.99),
	(7, 'Gn7x', 'Molten', 'Basket', 'Numero 7', 'Naranja Ladrillo', 'molten.webp', 9368.00),
	(8, 'Evolution', 'Dribbling', 'Basket', 'Numero 5', 'Naranja', 'dribblingbasket.webp', 9368.00),
	(9, 'Wolfi Cuero Sintetico', 'Wolfi', 'Voley', 'Numero 5', 'Blanca, amarilla y azul', 'wolfi.webp', 949.99),
	(10, 'Naufrago Castaway', 'Wilson', 'Voley', 'Numero 5', 'Blanca y roja', 'wilsonvoley.webp', 2890.00),
	(11, 'Suecia Ultra Grip', 'Penalty', 'Handball', 'Numero 2', 'Azul y roja', 'penaltyhandball.webp', 4909.99);
	

CREATE TABLE comentarios
(	
	id_comentario 	INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
	fecha_alta 		DATE 			 	NOT NULL,
	comentario 		VARCHAR(250)			NOT NULL,
	id_fk_usuario		INT UNSIGNED 			NOT NULL,
	id_fk_producto	INT UNSIGNED 			NOT NULL,

	FOREIGN KEY(id_fk_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY(id_fk_producto) REFERENCES productos(id_producto) ON DELETE CASCADE ON UPDATE CASCADE

) ENGINE=innoDB;

INSERT INTO comentarios
VALUES	(1, '2021-04-05', 'Esta piola!', 1, 1),
	(2, '2021-04-06', 'Me gusto!', 2, 7),
	(3, '2021-04-05', 'Esta piola!', 1, 7),
	(4, '2021-04-05', 'Me gusto!', 2, 1);

CREATE TABLE password_resets
(
    id_pass 		INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    email   		VARCHAR(100) UNIQUE         NOT NULL,
    token   		VARCHAR(255)                NOT NULL,
    limitetiempo  	DATETIME                    NOT NULL
) ENGINE = innoDB;

--Profe, cuando incluiamos el on delete y cascade en carrito, dejaba de funcionar correctamente, por eso tuvimos que dejarlo así

CREATE TABLE carrito
(
	id_fk_usuario	INT 		UNSIGNED	NOT NULL,	
	id_fk_producto	INT 		UNSIGNED	NOT NULL,
	cantidad		SMALLINT 	UNSIGNED 	NOT NULL,

	FOREIGN KEY(id_fk_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY(id_fk_producto) REFERENCES productos(id_producto) ON DELETE CASCADE ON UPDATE CASCADE

)ENGINE = innoDB;


