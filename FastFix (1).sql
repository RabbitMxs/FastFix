Create database FastFix;
use FastFix;

CREATE TABLE tipoUsuario(
    idTipo INT(4) AUTO_INCREMENT PRIMARY KEY,
    nombre char(20)
);

CREATE TABLE usuario(
    idUsuario INT(4) AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(20) NOT NULL,
    apellidoM VARCHAR(50) NOT NULL,
    apellidoP VARCHAR(50) NOT NULL,
    genero CHAR(1) NOT NULL,
    email VARCHAR(50) NOT NULL,
    clave CHAR(100) not NULL,
    foto CHAR(5),
    idTipoUsuario int(4),
    FOREIGN KEY (idTipoUsuario) REFERENCES tipoUsuario(idTipo)
);

CREATE TABLE proveedor(
    id INT(4) AUTO_INCREMENT PRIMARY KEY,
    nombre char(20),
    apellidoM VARCHAR(50) NOT NULL,
    apellidoP VARCHAR(50) NOT NULL,
    direccion char(50)
);

CREATE TABLE tipoComponente (
    id INT(4) AUTO_INCREMENT PRIMARY KEY,
    nombre CHAR(25)
);

CREATE TABLE tipoCotizacion (
    idTipoCotizacion INT(2) AUTO_INCREMENT PRIMARY KEY,
    nombre char(20)
);

CREATE TABLE cotizacion(
    id INT(5) AUTO_INCREMENT PRIMARY KEY,
    total numeric(11,2),
    fecha date ,
    idUsuario INT(4),
    idTipoCotizacion INT(4),
    FOREIGN KEY (idUsuario) REFERENCES usuario(idUsuario),
    FOREIGN KEY (idTipoCotizacion) REFERENCES tipoCotizacion(idTipoCotizacion)
);

CREATE TABLE componente(
    id INT(4) AUTO_INCREMENT PRIMARY KEY,
    nombre char(20),
    caracteristicas char(200),
    costo numeric(10,4),
    idProveedor INT(4),
    idTipoComponente INT(4),
    FOREIGN KEY (idProveedor) REFERENCES proveedor(id),
    FOREIGN KEY (idTipoComponente) REFERENCES tipoComponente(id)
);

CREATE TABLE compCotizacion(
    idCotizacion INT(5),
    idComponente INT(5),
    PRIMARY KEY (idCotizacion,idComponente),
    FOREIGN KEY (idCotizacion) REFERENCES cotizacion(id),
    FOREIGN KEY (idComponente) REFERENCES componente(id)
);

CREATE TABLE compatibilidad(
    idComponente1 INT(4),
    idComponente2 INT(4),
    PRIMARY KEY (idComponente1,idComponente2),
    FOREIGN KEY (idComponente1) REFERENCES componente(id),
    FOREIGN KEY (idComponente2) REFERENCES componente(id)
);