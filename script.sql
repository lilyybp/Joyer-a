
CREATE SCHEMA IF NOT EXISTS 'joyeria' DEFAULT CHARACTER SET utf8 ;
USE 'joyeria' ;

-- CREATE TABLES
CREATE TABLE `usuario` (
  `usuario` varchar(20) NOT NULL,
  `password` varchar(15) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(40) DEFAULT NULL,
  `tipo` varchar(10) NOT NULL,
  PRIMARY KEY (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `prenda` (
  `id_prenda` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_prenda` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_prenda`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

CREATE TABLE `proceso` (
  `id_proceso` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_proceso` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id_proceso`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;


CREATE TABLE `prenda_proceso` (
  `prenda` int(11) NOT NULL,
  `proceso` int(11) NOT NULL,
  `tiempo_estimado` time DEFAULT NULL,
  PRIMARY KEY (`prenda`,`proceso`),
  KEY `fkProceso1` (`proceso`),
  CONSTRAINT `fkPrenda1` FOREIGN KEY (`prenda`) REFERENCES `prenda` (`id_prenda`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fkProceso1` FOREIGN KEY (`proceso`) REFERENCES `proceso` (`id_proceso`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `pedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `folio` int(11) NOT NULL,
  `nombre_cliente` varchar(50) DEFAULT NULL,
  `operador` varchar(20) NOT NULL,
  `prenda` int(11) NOT NULL,
  `proceso` int(11) NOT NULL,
  `dificultad` int(11) DEFAULT NULL,
  `comentario` varchar(200) DEFAULT NULL,
  `tiempoEstimado` int(11) DEFAULT NULL,
  `urgencia` varchar(10) DEFAULT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`,`folio`),
  KEY `fkOperador` (`operador`),
  KEY `fkPrenda2` (`prenda`),
  KEY `fkProceso2` (`proceso`),
  CONSTRAINT `fkOperador` FOREIGN KEY (`operador`) REFERENCES `usuario` (`usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fkPrenda2` FOREIGN KEY (`prenda`) REFERENCES `prenda` (`id_prenda`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fkProceso2` FOREIGN KEY (`proceso`) REFERENCES `proceso` (`id_proceso`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`operador`) REFERENCES `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;


CREATE TABLE `cola` (
  `folio` int(11) NOT NULL,
  `operador` varchar(20) NOT NULL,
  `tiempoEstimado` int(11) DEFAULT NULL,
  `urgencia` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`folio`),
  KEY `operador` (`operador`),
  CONSTRAINT `cola_ibfk_1` FOREIGN KEY (`operador`) REFERENCES `usuario` (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `historial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `folio` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `prenda` int(11) DEFAULT NULL,
  `proceso` int(11) DEFAULT NULL,
  `operador` varchar(20) DEFAULT NULL,
  `tiempo_esperado` int(11) DEFAULT NULL,
  `tiempo_total` int(11) DEFAULT NULL,
  `nombre_cliente` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`,`folio`),
  KEY `fkPrenda3` (`prenda`),
  KEY `fkProceso3` (`proceso`),
  KEY `fkOperador2` (`operador`),
  CONSTRAINT `fkOperador2` FOREIGN KEY (`operador`) REFERENCES `usuario` (`usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fkPrenda3` FOREIGN KEY (`prenda`) REFERENCES `prenda` (`id_prenda`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fkProceso3` FOREIGN KEY (`proceso`) REFERENCES `proceso` (`id_proceso`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- INSERTS

INSERT INTO usuario (usuario, password, nombre, tipo) VALUES ("admin","admin","Administrador", "admin");
INSERT INTO usuario(usuario, password, nombre, tipo) VALUES ("sergio","1234","Sergio","operador");
INSERT INTO usuario(usuario, password, nombre, tipo) VALUES ("eduardo","1234","Eduardo","operador");
INSERT INTO usuario(usuario, password, nombre, tipo) VALUES ("jose","1234","Jose","operador");
INSERT INTO usuario(usuario, password, nombre, tipo) VALUES ("tomas","1234","Tomas","operador");


--PRENDAS

INSERT INTO prenda VALUES (1, "cadena");
INSERT INTO prenda VALUES (2, "pulsera");
INSERT INTO prenda VALUES (3, "dije");
INSERT INTO prenda VALUES (4, "anillo");
INSERT INTO prenda VALUES (5, "esclava");
INSERT INTO prenda VALUES (6, "arete");
INSERT INTO prenda VALUES (7, "arracada");
INSERT INTO prenda VALUES (8, "rosario");
INSERT INTO prenda VALUES (9, "pulso");
INSERT INTO prenda VALUES (10, "argolla");
INSERT INTO prenda VALUES (11, "broqueles");


--PROCESOS

INSERT INTO proceso (nombre_proceso) VALUES ("Poner asas mas grandes");
INSERT INTO proceso (nombre_proceso) VALUES ("Uña de anillo y ajustar piedra");
INSERT INTO proceso (nombre_proceso) VALUES ("Soldar pajuela");
INSERT INTO proceso (nombre_proceso) VALUES ("Montar piedra");
INSERT INTO proceso (nombre_proceso) VALUES ("Quitar imagen");
INSERT INTO proceso (nombre_proceso) VALUES ("soldar");
INSERT INTO proceso (nombre_proceso) VALUES ("Agrandar");
INSERT INTO proceso (nombre_proceso) VALUES ("Hacer dos asas");
INSERT INTO proceso (nombre_proceso) VALUES ("Hacer brazo");
INSERT INTO proceso (nombre_proceso) VALUES ("Hacer arillo");
INSERT INTO proceso (nombre_proceso) VALUES ("Recortar");

-- PRENDA-PROCESO

INSERT INTO prenda_proceso VALUES (1, 1, '00:01:27');
INSERT INTO prenda_proceso VALUES (2, 1, '00:01:39');
INSERT INTO prenda_proceso VALUES (3, 2, '00:03:15');


-- HISTORIAL PRUEBAS

INSERT INTO historial VALUES (1,10221,"2017-09-10",1,1, "eduardo", 0,0,"Lucia Ruiz" );


-- PEDIDOS


INSERT INTO pedido VALUES(1,10221,"Maria Luisa Perez","jose","arete","Soldar pajuela", );






--ESTOOOOOOOOO


DROP TABLE historial;
DROP TABLE pedido;
DROP TABLE cola;
DROP TABLE prenda_proceso;

CREATE TABLE prenda_proceso (
  id int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  prenda int(11) NOT NULL,
  proceso int(11) NOT NULL,
  tiempo_estimado time DEFAULT NULL,
  KEY `fkProceso1` (`proceso`),
  CONSTRAINT `fkPrenda1` FOREIGN KEY (`prenda`) REFERENCES `prenda` (`id_prenda`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fkProceso1` FOREIGN KEY (`proceso`) REFERENCES `proceso` (`id_proceso`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `pedido` (
  `id` int NOT NULL AUTO_INCREMENT,
  `folio` int NOT NULL,
  `nombre_cliente` varchar(50) DEFAULT NULL,
  `operador` varchar(20) NOT NULL,
  `prenda_proceso` int NOT NULL,
  `comentario` varchar(200) DEFAULT NULL,
  `tiempoEstimado` int DEFAULT NULL,
  `urgencia` varchar(10) DEFAULT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`,`folio`),
  KEY `fkOperador` (`operador`),
  CONSTRAINT `fkOperador` FOREIGN KEY (`operador`) REFERENCES `usuario` (`usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fkPrendaProceso` FOREIGN KEY (`prenda_proceso`) REFERENCES `prenda_proceso` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`operador`) REFERENCES `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

CREATE TABLE `cola` (
  `folio` int(11) NOT NULL,
  `operador` varchar(20) NOT NULL,
  `tiempoEstimado` int(11) DEFAULT NULL,
  `urgencia` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`folio`),
  KEY `operador` (`operador`),
  CONSTRAINT `cola_ibfk_1` FOREIGN KEY (`operador`) REFERENCES `usuario` (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `historial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `folio` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `prenda_proceso` int(11) DEFAULT NULL,
  `operador` varchar(20) DEFAULT NULL,
  `tiempo_esperado` int(11) DEFAULT NULL,
  `tiempo_total` int(11) DEFAULT NULL,
  `nombre_cliente` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`,`folio`),
  CONSTRAINT `fkOperador2` FOREIGN KEY (`operador`) REFERENCES `usuario` (`usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fkPrenda_proceso3` FOREIGN KEY (`prenda_proceso`) REFERENCES `prenda_proceso` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO prenda_proceso VALUES (1,1,1,10);
INSERT INTO prenda_proceso VALUES (2,2,2,8);
INSERT INTO prenda_proceso VALUES (3,1,3,30);
INSERT INTO prenda_proceso VALUES (4,1,4,22);
INSERT INTO prenda_proceso VALUES (5,2,3,9);

INSERT INTO cola VALUES(22113, 'sergio',10,'baja');
INSERT INTO cola VALUES(12394, 'sergio',8,'baja');
INSERT INTO cola VALUES(90887, 'eduardo',8,'baja');
INSERT INTO cola VALUES(77658, 'eduardo',7,'baja');
INSERT INTO cola VALUES(88433, 'jose',8,'baja');
INSERT INTO cola VALUES(56472, 'jose',8,'baja');
INSERT INTO cola VALUES(10990, 'jose',8,'baja');
INSERT INTO cola VALUES(54209, 'jose',8,'baja');





