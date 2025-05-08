DROP DATABASE IF EXISTS orderFlowDB;
CREATE DATABASE orderFlowDB;
USE orderFlowDB;

CREATE TABLE Empleado (
    id_empleado INT AUTO_INCREMENT,
    contrasena_empleado VARCHAR(20),
    nombre_empleado VARCHAR(100),
    apellido_empleado VARCHAR(100),
    numero_telefono_empleado VARCHAR(9),
    correo_empleado VARCHAR(120),
    rol_empleado ENUM('Camarero','Barra','Cocinero','Administrador') NOT NULL,
    es_admin BOOLEAN,
    id_jefe INT,
    PRIMARY KEY(id_empleado),
    FOREIGN KEY (id_jefe) REFERENCES Empleado(id_empleado)
);

CREATE TABLE Mesa (
    id_mesa INT AUTO_INCREMENT,
    zona_mesa VARCHAR(30),
    capacidad_mesa INT,
    estado_mesa ENUM('Disponible','Ocupado') DEFAULT 'Disponible',
    PRIMARY KEY(id_mesa)
);

CREATE TABLE Comanda (
    id_comanda INT AUTO_INCREMENT,
    estado_comanda ENUM('En Cola','Preparación','Preparado','Servido') DEFAULT 'En Cola',
    fecha_hora DATETIME,
    id_empleado INT,
    id_mesa INT,
    PRIMARY KEY(id_comanda),
    CONSTRAINT fk_empleadoID FOREIGN KEY (id_empleado) REFERENCES Empleado(id_empleado),
    CONSTRAINT fk_mesaID FOREIGN KEY (id_mesa) REFERENCES Mesa(id_mesa)
);

CREATE TABLE Producto (
    id_producto INT AUTO_INCREMENT,
    imagen_producto TEXT,
    precio_producto INT,
    seccion_menu VARCHAR(30),
    tipo enum('Barra','Cocina') NOT NULL,
    PRIMARY KEY(id_producto)
);

CREATE TABLE Barra (
    id_producto INT,
    marca VARCHAR(50),
    clase VARCHAR(50),
    tipo VARCHAR(50),
    tamaño ENUM('1/3','lata','botellin','grande','pequeña','nada') DEFAULT 'nada',
    nombre_producto_barra VARCHAR(100),
    PRIMARY KEY(id_producto),
    CONSTRAINT fk_productoID FOREIGN KEY (id_producto) REFERENCES Producto(id_producto)
);

CREATE TABLE Cocina (
    id_producto INT,
    nombre_cocina VARCHAR(100),
    PRIMARY KEY(id_producto),
    CONSTRAINT fk_productoID2 FOREIGN KEY (id_producto) REFERENCES Producto(id_producto)
);

CREATE TABLE Linea_Comanda (
    id_lineaComanda INT AUTO_INCREMENT,
    tipo_lineaComanda ENUM('Cocina','Barra'),
    numero_lineas INT,
    Unidades INT,
    estado_lineacomanda ENUM('En Cola','Preparación','Preparado') DEFAULT 'En Cola',
    id_producto INT,
    id_comanda INT,
    PRIMARY KEY(id_lineaComanda),
    CONSTRAINT fk_productoID3 FOREIGN KEY (id_producto) REFERENCES Producto(id_producto),
    CONSTRAINT fk_comandaID FOREIGN KEY (id_comanda) REFERENCES Comanda(id_comanda)
);

-- 3. Crear el TRIGGER
DELIMITER //
CREATE TRIGGER set_tipo_lineaComanda BEFORE INSERT ON Linea_Comanda
FOR EACH ROW
BEGIN
    DECLARE tipoProd ENUM('Barra','Cocina');
    SELECT tipo INTO tipoProd FROM Producto WHERE id_producto = NEW.id_producto;
    SET NEW.tipo_lineaComanda = tipoProd;
END;
//
DELIMITER ;