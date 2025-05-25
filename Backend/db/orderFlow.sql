drop database if exists orderflowdb;
create database orderflowdb;
use orderflowdb;
-- Tabla empleado
CREATE TABLE empleado (
    id_empleado INT AUTO_INCREMENT,
    contrasena_empleado VARCHAR(20),
    nombre_empleado VARCHAR(100),
    apellido_empleado VARCHAR(100),
    numero_telefono_empleado VARCHAR(9),
    correo_empleado VARCHAR(120),
    rol_empleado ENUM('camarero','barra','cocinero','administrador') NOT NULL,
    es_admin BOOLEAN,
    id_jefe INT,
    PRIMARY KEY (id_empleado),
    FOREIGN KEY (id_jefe) REFERENCES empleado(id_empleado) ON DELETE CASCADE
);

-- Tabla mesa
CREATE TABLE mesa (
    id_mesa INT AUTO_INCREMENT,
    zona_mesa VARCHAR(30),
    capacidad_mesa INT,
    estado_mesa ENUM('disponible','ocupado') DEFAULT 'disponible',
    PRIMARY KEY (id_mesa)
);

-- Tabla comanda
CREATE TABLE comanda (
    id_comanda INT AUTO_INCREMENT,
    estado_comanda ENUM('en cola','preparación','preparado','servido') DEFAULT 'en cola',
    fecha_hora DATETIME,
    id_empleado INT,
    id_mesa INT,
    PRIMARY KEY (id_comanda),
    FOREIGN KEY (id_empleado) REFERENCES empleado(id_empleado) ON DELETE CASCADE,
    FOREIGN KEY (id_mesa) REFERENCES mesa(id_mesa) ON DELETE CASCADE
);

-- Tabla categoria_menu
CREATE TABLE categoria_menu (
    id_categoria INT AUTO_INCREMENT,
    nombre_categoria VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_categoria)
);

-- Tabla producto (simplificada)
CREATE TABLE producto (
    id_producto INT AUTO_INCREMENT,
    nombre_producto varchar(100),
    imagen_producto TEXT,
    precio_producto DECIMAL(6,2),
    descripcion_producto TEXT,
    tipo ENUM('barra','cocina') NOT NULL,
    id_categoria INT,
    PRIMARY KEY (id_producto),
    FOREIGN KEY (id_categoria) REFERENCES categoria_menu(id_categoria) ON DELETE CASCADE
);

-- Tabla linea_comanda
CREATE TABLE linea_comanda (
    id_lineacomanda INT AUTO_INCREMENT,
    tipo_lineacomanda ENUM('cocina','barra'),
    numero_lineas INT,
    unidades INT,
    estado_lineacomanda ENUM('en cola','preparación','preparado') DEFAULT 'en cola',
    id_producto INT,
    id_comanda INT,
    PRIMARY KEY (id_lineacomanda),
    FOREIGN KEY (id_producto) REFERENCES producto(id_producto) ON DELETE CASCADE,
    FOREIGN KEY (id_comanda) REFERENCES comanda(id_comanda) ON DELETE CASCADE
);

-- trigger
delimiter //
create trigger set_tipo_lineacomanda before insert on linea_comanda
for each row
begin
    declare tipoprod enum('barra','cocina');
    select tipo into tipoprod from producto where id_producto = new.id_producto;
    set new.tipo_lineacomanda = tipoprod;
end;
//
delimiter ;



-- INSERTS PARA `empleado`
INSERT INTO empleado (contrasena_empleado, nombre_empleado, apellido_empleado, numero_telefono_empleado, correo_empleado, rol_empleado, es_admin, id_jefe) VALUES ('admin123', 'Joan', 'Paute', '600112233', 'admin@orderflow.com', 'administrador', 1, NULL);
INSERT INTO empleado (contrasena_empleado, nombre_empleado, apellido_empleado, numero_telefono_empleado, correo_empleado, rol_empleado, es_admin, id_jefe) VALUES ('7@nPO8^b_S', 'Lorena', 'Zabala', '563818231', 'chuy81@hotmail.com', 'cocinero', 0, 1);
INSERT INTO empleado (contrasena_empleado, nombre_empleado, apellido_empleado, numero_telefono_empleado, correo_empleado, rol_empleado, es_admin, id_jefe) VALUES ('V&%lo88cbR', 'Pili', 'Uribe', '957883074', 'juanitanogues@hotmail.com', 'cocinero', 0, 1);
INSERT INTO empleado (contrasena_empleado, nombre_empleado, apellido_empleado, numero_telefono_empleado, correo_empleado, rol_empleado, es_admin, id_jefe) VALUES ('xh^h1CNsD#', 'Daniel', 'Vázquez', '291022528', 'aibanez@hotmail.com', 'barra', 0, 1);
INSERT INTO empleado (contrasena_empleado, nombre_empleado, apellido_empleado, numero_telefono_empleado, correo_empleado, rol_empleado, es_admin, id_jefe) VALUES ('MdQU#W*Q)6', 'Nicolasa', 'Sureda', '934938142', 'ainara37@galvez-casas.es', 'barra', 0, 1);
INSERT INTO empleado (contrasena_empleado, nombre_empleado, apellido_empleado, numero_telefono_empleado, correo_empleado, rol_empleado, es_admin, id_jefe) VALUES ('@m)pBxlt2r', 'Filomena', 'Martínez', '448666354', 'castrilloagata@guerra.com', 'camarero', 0, 1);
INSERT INTO empleado (contrasena_empleado, nombre_empleado, apellido_empleado, numero_telefono_empleado, correo_empleado, rol_empleado, es_admin, id_jefe) VALUES ('@GHr0Yg!LS', 'Segismundo', 'Pina', '898779720', 'benito91@gmail.com', 'camarero', 0, 1);

-- Mesas del salón
INSERT INTO mesa (zona_mesa) VALUES ('salon');
INSERT INTO mesa (zona_mesa) VALUES ('salon');
INSERT INTO mesa (zona_mesa) VALUES ('salon');
INSERT INTO mesa (zona_mesa) VALUES ('salon');
INSERT INTO mesa (zona_mesa) VALUES ('salon');

-- Mesas de la terraza
INSERT INTO mesa (zona_mesa) VALUES ('terraza');
INSERT INTO mesa (zona_mesa) VALUES ('terraza');
INSERT INTO mesa (zona_mesa) VALUES ('terraza');
INSERT INTO mesa (zona_mesa) VALUES ('terraza');
INSERT INTO mesa (zona_mesa) VALUES ('terraza');

-- Mesas del piso 1
INSERT INTO mesa (zona_mesa) VALUES ('piso 1');
INSERT INTO mesa (zona_mesa) VALUES ('piso 1');
INSERT INTO mesa (zona_mesa) VALUES ('piso 1');
INSERT INTO mesa (zona_mesa) VALUES ('piso 1');
INSERT INTO mesa (zona_mesa) VALUES ('piso 1');

-- Desayuno (tipo cocina, id_categoria=1)
INSERT INTO producto (nombre_producto, imagen_producto, precio_producto, descripcion_producto, tipo, id_categoria) VALUES
('Tostada con mantequilla', '', 2.50, 'Tostada con mantequilla y mermelada', 'cocina', 1),
('Huevos revueltos', '', 3.00, 'Huevos revueltos con jamón', 'cocina', 1),
('Croissant', '', 2.20, 'Croissant recién horneado', 'cocina', 1),
('Café con leche', '', 1.80, 'Café con leche caliente', 'cocina', 1),
('Zumo de naranja', '', 2.00, 'Zumo natural de naranja', 'cocina', 1),
('Tortilla de patatas', '', 3.50, 'Tortilla española tradicional', 'cocina', 1),
('Magdalenas', '', 2.00, 'Magdalenas caseras', 'cocina', 1),
('Pan con tomate', '', 2.50, 'Pan con tomate y aceite de oliva', 'cocina', 1),
('Yogur con frutas', '', 2.80, 'Yogur natural con frutas frescas', 'cocina', 1),
('Bizcocho casero', '', 2.50, 'Bizcocho de vainilla casero', 'cocina', 1);

-- Bebidas (tipo barra, id_categoria=2)
INSERT INTO producto (nombre_producto, imagen_producto, precio_producto, descripcion_producto, tipo, id_categoria) VALUES
('Coca-Cola', '', 1.50, 'Refresco de cola', 'barra', 2),
('Fanta Naranja', '', 1.50, 'Refresco de naranja', 'barra', 2),
('Agua mineral', '', 1.00, 'Agua sin gas', 'barra', 2),
('Cerveza Mahou', '', 2.00, 'Cerveza rubia', 'barra', 2),
('Vino tinto', '', 3.50, 'Copa de vino tinto', 'barra', 2),
('Zumo de piña', '', 1.80, 'Zumo natural de piña', 'barra', 2),
('Café espresso', '', 1.20, 'Café solo intenso', 'barra', 2),
('Té helado', '', 1.50, 'Té frío con limón', 'barra', 2),
('Refresco limón', '', 1.50, 'Refresco sabor limón', 'barra', 2),
('Agua con gas', '', 1.00, 'Agua mineral con gas', 'barra', 2);

-- Entrantes (tipo cocina, id_categoria=3)
INSERT INTO producto (nombre_producto, imagen_producto, precio_producto, descripcion_producto, tipo, id_categoria) VALUES
('Ensalada César', '', 4.50, 'Lechuga, pollo, queso y salsa César', 'cocina', 3),
('Croquetas caseras', '', 3.80, 'Croquetas de jamón ibérico', 'cocina', 3),
('Sopa de verduras', '', 3.00, 'Sopa caliente de verduras', 'cocina', 3),
('Calamares a la romana', '', 5.00, 'Calamares fritos con limón', 'cocina', 3),
('Patatas bravas', '', 3.50, 'Patatas con salsa picante', 'cocina', 3),
('Pimientos de padrón', '', 3.80, 'Pimientos fritos con sal', 'cocina', 3),
('Tabla de quesos', '', 6.00, 'Variedad de quesos españoles', 'cocina', 3),
('Boquerones en vinagre', '', 4.20, 'Boquerones marinados', 'cocina', 3),
('Gazpacho andaluz', '', 3.50, 'Sopa fría de tomate', 'cocina', 3),
('Huevos rellenos', '', 3.80, 'Huevos con relleno de atún', 'cocina', 3);

-- Plato fuerte (tipo cocina, id_categoria=4)
INSERT INTO producto (nombre_producto, imagen_producto, precio_producto, descripcion_producto, tipo, id_categoria) VALUES
('Paella valenciana', '', 9.50, 'Arroz con marisco y pollo', 'cocina', 4),
('Lomo a la plancha', '', 7.00, 'Lomo de cerdo a la plancha', 'cocina', 4),
('Pollo al horno', '', 7.50, 'Pollo asado con hierbas', 'cocina', 4),
('Merluza a la romana', '', 8.00, 'Filete de merluza frito', 'cocina', 4),
('Bacalao a la vizcaína', '', 8.50, 'Bacalao con salsa de tomate', 'cocina', 4),
('Entrecot de ternera', '', 10.00, 'Entrecot con patatas fritas', 'cocina', 4),
('Carrillera de cerdo', '', 9.00, 'Carrillera estofada', 'cocina', 4),
('Tortilla española', '', 6.00, 'Tortilla de patatas tradicional', 'cocina', 4),
('Espaguetis a la boloñesa', '', 7.00, 'Pasta con salsa boloñesa', 'cocina', 4),
('Hamburguesa casera', '', 7.50, 'Hamburguesa con queso y bacon', 'cocina', 4);

-- Tapas (tipo barra, id_categoria=5)
INSERT INTO producto (nombre_producto, imagen_producto, precio_producto, descripcion_producto, tipo, id_categoria) VALUES
('Tortilla de patatas', '', 3.50, 'Tortilla española para compartir', 'barra', 5),
('Pincho de chorizo', '', 2.50, 'Pincho de chorizo frito', 'barra', 5),
('Aceitunas', '', 1.50, 'Aceitunas verdes y negras', 'barra', 5),
('Jamón serrano', '', 5.00, 'Jamón ibérico de bellota', 'barra', 5),
('Queso manchego', '', 4.50, 'Queso curado manchego', 'barra', 5),
('Boquerones fritos', '', 4.00, 'Boquerones rebozados', 'barra', 5),
('Alitas de pollo', '', 4.50, 'Alitas con salsa barbacoa', 'barra', 5),
('Calamares', '', 4.00, 'Calamares fritos crujientes', 'barra', 5),
('Croquetas de bacalao', '', 3.80, 'Croquetas de bacalao caseras', 'barra', 5),
('Patatas alioli', '', 3.00, 'Patatas con salsa alioli', 'barra', 5);
