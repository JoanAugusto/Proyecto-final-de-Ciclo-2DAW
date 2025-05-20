drop database if exists orderflowdb;
create database orderflowdb;
use orderflowdb;

create table empleado (
    id_empleado int auto_increment,
    contrasena_empleado varchar(20),
    nombre_empleado varchar(100),
    apellido_empleado varchar(100),
    numero_telefono_empleado varchar(9),
    correo_empleado varchar(120),
    rol_empleado enum('camarero','barra','cocinero','administrador') not null,
    es_admin boolean,
    id_jefe int,
    primary key(id_empleado),
    foreign key (id_jefe) references empleado(id_empleado) on delete cascade
);

create table mesa (
    id_mesa int auto_increment,
    zona_mesa varchar(30),
    capacidad_mesa int,
    estado_mesa enum('disponible','ocupado') default 'disponible',
    primary key(id_mesa)
);

create table comanda (
    id_comanda int auto_increment,
    estado_comanda enum('en cola','preparación','preparado','servido') default 'en cola',
    fecha_hora datetime,
    id_empleado int,
    id_mesa int,
    primary key(id_comanda),
    constraint fk_empleadoid foreign key (id_empleado) references empleado(id_empleado) on delete cascade,
    constraint fk_mesaid foreign key (id_mesa) references mesa(id_mesa) on delete cascade
);

create table producto (
    id_producto int auto_increment,
    imagen_producto text,
    precio_producto int,
    seccion_menu varchar(30),
    tipo enum('barra','cocina') not null,
    primary key(id_producto)
);

create table barra (
    id_producto int,
    marca varchar(50),
    clase varchar(50),
    tipo varchar(50),
    tamaño enum('1/3','lata','botellin','grande','pequeña','nada') default 'nada',
    nombre_producto_barra varchar(100),
    primary key(id_producto),
    constraint fk_productoid foreign key (id_producto) references producto(id_producto) on delete cascade
);

create table cocina (
    id_producto int,
    nombre_cocina varchar(100),
    primary key(id_producto),
    constraint fk_productoid2 foreign key (id_producto) references producto(id_producto) on delete cascade
);

create table linea_comanda (
    id_lineacomanda int auto_increment,
    tipo_lineacomanda enum('cocina','barra'),
    numero_lineas int,
    unidades int,
    estado_lineacomanda enum('en cola','preparación','preparado') default 'en cola',
    id_producto int,
    id_comanda int,
    primary key(id_lineacomanda),
    constraint fk_productoid3 foreign key (id_producto) references producto(id_producto) on delete cascade,
    constraint fk_comandaid foreign key (id_comanda) references comanda(id_comanda) on delete cascade
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

-- Productos Barra
IINSERT INTO producto (id_producto, imagen_producto, precio_producto, seccion_menu, tipo) VALUES (1, '', 2, 'bebidas', 'barra');
INSERT INTO producto (id_producto, imagen_producto, precio_producto, seccion_menu, tipo) VALUES (2, '', 2, 'bebidas', 'barra');
INSERT INTO producto (id_producto, imagen_producto, precio_producto, seccion_menu, tipo) VALUES (3, '', 2.2, 'bebidas', 'barra');
INSERT INTO producto (id_producto, imagen_producto, precio_producto, seccion_menu, tipo) VALUES (4, '', 1.5, 'bebidas', 'barra');
INSERT INTO producto (id_producto, imagen_producto, precio_producto, seccion_menu, tipo) VALUES (5, '', 2.5, 'desayuno', 'barra');
INSERT INTO producto (id_producto, imagen_producto, precio_producto, seccion_menu, tipo) VALUES (6, '', 1.3, 'desayuno', 'barra');
INSERT INTO producto (id_producto, imagen_producto, precio_producto, seccion_menu, tipo) VALUES (7, '', 1.5, 'desayuno', 'barra');
INSERT INTO producto (id_producto, imagen_producto, precio_producto, seccion_menu, tipo) VALUES (8, '', 1.4, 'desayuno', 'barra');
INSERT INTO producto (id_producto, imagen_producto, precio_producto, seccion_menu, tipo) VALUES (9, '', 1.8, 'desayuno', 'barra');
INSERT INTO producto (id_producto, imagen_producto, precio_producto, seccion_menu, tipo) VALUES (10, '', 2.3, 'bebidas', 'barra');
INSERT INTO producto (id_producto, imagen_producto, precio_producto, seccion_menu, tipo) VALUES (11, '', 2, 'bebidas', 'barra');
INSERT INTO producto (id_producto, imagen_producto, precio_producto, seccion_menu, tipo) VALUES (12, '', 2.8, 'bebidas', 'barra');
INSERT INTO producto (id_producto, imagen_producto, precio_producto, seccion_menu, tipo) VALUES (13, '', 2, 'desayuno', 'barra');
INSERT INTO producto (id_producto, imagen_producto, precio_producto, seccion_menu, tipo) VALUES (14, '', 1.8, 'bebidas', 'barra');
INSERT INTO producto (id_producto, imagen_producto, precio_producto, seccion_menu, tipo) VALUES (15, '', 2.5, 'bebidas', 'barra');
INSERT INTO producto (id_producto, imagen_producto, precio_producto, seccion_menu, tipo) VALUES (16, '', 2.5, 'desayuno', 'cocina');
INSERT INTO producto (id_producto, imagen_producto, precio_producto, seccion_menu, tipo) VALUES (17, '', 2.2, 'desayuno', 'cocina');
INSERT INTO producto (id_producto, imagen_producto, precio_producto, seccion_menu, tipo) VALUES (18, '', 3.5, 'desayuno', 'cocina');
INSERT INTO producto (id_producto, imagen_producto, precio_producto, seccion_menu, tipo) VALUES (19, '', 3, 'desayuno', 'cocina');
INSERT INTO producto (id_producto, imagen_producto, precio_producto, seccion_menu, tipo) VALUES (20, '', 3.2, 'desayuno', 'cocina');
INSERT INTO producto (id_producto, imagen_producto, precio_producto, seccion_menu, tipo) VALUES (21, '', 4, 'entrantes', 'cocina');
INSERT INTO producto (id_producto, imagen_producto, precio_producto, seccion_menu, tipo) VALUES (22, '', 3.8, 'entrantes', 'cocina');
INSERT INTO producto (id_producto, imagen_producto, precio_producto, seccion_menu, tipo) VALUES (23, '', 4.5, 'entrantes', 'cocina');
INSERT INTO producto (id_producto, imagen_producto, precio_producto, seccion_menu, tipo) VALUES (24, '', 4, 'entrantes', 'cocina');
INSERT INTO producto (id_producto, imagen_producto, precio_producto, seccion_menu, tipo) VALUES (25, '', 3.5, 'entrantes', 'cocina');
INSERT INTO producto (id_producto, imagen_producto, precio_producto, seccion_menu, tipo) VALUES (26, '', 8.5, 'primer plato', 'cocina');
INSERT INTO producto (id_producto, imagen_producto, precio_producto, seccion_menu, tipo) VALUES (27, '', 6, 'primer plato', 'cocina');
INSERT INTO producto (id_producto, imagen_producto, precio_producto, seccion_menu, tipo) VALUES (28, '', 7, 'primer plato', 'cocina');
INSERT INTO producto (id_producto, imagen_producto, precio_producto, seccion_menu, tipo) VALUES (29, '', 7.5, 'primer plato', 'cocina');
INSERT INTO producto (id_producto, imagen_producto, precio_producto, seccion_menu, tipo) VALUES (30, '', 5.5, 'primer plato', 'cocina');
INSERT INTO producto (id_producto, imagen_producto, precio_producto, seccion_menu, tipo) VALUES (31, '', 12, 'segundo plato', 'cocina');
INSERT INTO producto (id_producto, imagen_producto, precio_producto, seccion_menu, tipo) VALUES (32, '', 9, 'segundo plato', 'cocina');
INSERT INTO producto (id_producto, imagen_producto, precio_producto, seccion_menu, tipo) VALUES (33, '', 10, 'segundo plato', 'cocina');
INSERT INTO producto (id_producto, imagen_producto, precio_producto, seccion_menu, tipo) VALUES (34, '', 9.5, 'segundo plato', 'cocina');
INSERT INTO producto (id_producto, imagen_producto, precio_producto, seccion_menu, tipo) VALUES (35, '', 11, 'segundo plato', 'cocina');
INSERT INTO barra (id_producto, marca, clase, tipo, tamaño, nombre_producto_barra) VALUES (1, 'Coca-Cola', 'Refresco', 'Cola', 'lata', 'Coca-Cola');
INSERT INTO barra (id_producto, marca, clase, tipo, tamaño, nombre_producto_barra) VALUES (2, 'Fanta', 'Refresco', 'Naranja', 'lata', 'Fanta Naranja');
INSERT INTO barra (id_producto, marca, clase, tipo, tamaño, nombre_producto_barra) VALUES (3, 'Mahou', 'Cerveza', 'Clásica', '1/3', 'Cerveza Mahou');
INSERT INTO barra (id_producto, marca, clase, tipo, tamaño, nombre_producto_barra) VALUES (4, 'Font Vella', 'Agua', 'Sin gas', 'pequeña', 'Agua Mineral');
INSERT INTO barra (id_producto, marca, clase, tipo, tamaño, nombre_producto_barra) VALUES (5, 'Granini', 'Zumo', 'Piña', 'botellin', 'Zumo de Piña');
INSERT INTO barra (id_producto, marca, clase, tipo, tamaño, nombre_producto_barra) VALUES (6, 'Nespresso', 'Café', 'Solo', 'nada', 'Café Solo');
INSERT INTO barra (id_producto, marca, clase, tipo, tamaño, nombre_producto_barra) VALUES (7, 'Nespresso', 'Café', 'Con leche', 'nada', 'Café con Leche');
INSERT INTO barra (id_producto, marca, clase, tipo, tamaño, nombre_producto_barra) VALUES (8, 'Hornimans', 'Té', 'Verde', 'nada', 'Té Verde');
INSERT INTO barra (id_producto, marca, clase, tipo, tamaño, nombre_producto_barra) VALUES (9, 'ColaCao', 'Cacao', 'Caliente', 'nada', 'ColaCao');
INSERT INTO barra (id_producto, marca, clase, tipo, tamaño, nombre_producto_barra) VALUES (10, 'Estrella Galicia', 'Cerveza', 'Especial', '1/3', 'Cerveza Estrella Galicia');
INSERT INTO barra (id_producto, marca, clase, tipo, tamaño, nombre_producto_barra) VALUES (11, 'Nestea', 'Té frío', 'Limón', 'lata', 'Nestea Limón');
INSERT INTO barra (id_producto, marca, clase, tipo, tamaño, nombre_producto_barra) VALUES (12, 'Red Bull', 'Energética', 'Original', 'lata', 'Red Bull');
INSERT INTO barra (id_producto, marca, clase, tipo, tamaño, nombre_producto_barra) VALUES (13, 'Puleva', 'Batido', 'Chocolate', 'botellin', 'Batido Chocolate');
INSERT INTO barra (id_producto, marca, clase, tipo, tamaño, nombre_producto_barra) VALUES (14, 'Perrier', 'Agua', 'Con gas', 'botellin', 'Agua con Gas');
INSERT INTO barra (id_producto, marca, clase, tipo, tamaño, nombre_producto_barra) VALUES (15, 'Alhambra', 'Cerveza', 'Reserva 1925', '1/3', 'Cerveza Alhambra');
INSERT INTO cocina (id_producto, nombre_cocina) VALUES (16, 'Tostadas con tomate');
INSERT INTO cocina (id_producto, nombre_cocina) VALUES (17, 'Croissant a la plancha');
INSERT INTO cocina (id_producto, nombre_cocina) VALUES (18, 'Huevos revueltos');
INSERT INTO cocina (id_producto, nombre_cocina) VALUES (19, 'Churros con chocolate');
INSERT INTO cocina (id_producto, nombre_cocina) VALUES (20, 'Tarta de queso');
INSERT INTO cocina (id_producto, nombre_cocina) VALUES (21, 'Ensalada mixta');
INSERT INTO cocina (id_producto, nombre_cocina) VALUES (22, 'Gazpacho andaluz');
INSERT INTO cocina (id_producto, nombre_cocina) VALUES (23, 'Croquetas de jamón');
INSERT INTO cocina (id_producto, nombre_cocina) VALUES (24, 'Tortilla española');
INSERT INTO cocina (id_producto, nombre_cocina) VALUES (25, 'Patatas bravas');
INSERT INTO cocina (id_producto, nombre_cocina) VALUES (26, 'Paella de marisco');
INSERT INTO cocina (id_producto, nombre_cocina) VALUES (27, 'Lentejas estofadas');
INSERT INTO cocina (id_producto, nombre_cocina) VALUES (28, 'Espaguetis boloñesa');
INSERT INTO cocina (id_producto, nombre_cocina) VALUES (29, 'Arroz con pollo');
INSERT INTO cocina (id_producto, nombre_cocina) VALUES (30, 'Crema de calabaza');
INSERT INTO cocina (id_producto, nombre_cocina) VALUES (31, 'Entrecot de ternera');
INSERT INTO cocina (id_producto, nombre_cocina) VALUES (32, 'Pollo al horno');
INSERT INTO cocina (id_producto, nombre_cocina) VALUES (33, 'Pescado a la plancha');
INSERT INTO cocina (id_producto, nombre_cocina) VALUES (34, 'Hamburguesa completa');
INSERT INTO cocina (id_producto, nombre_cocina) VALUES (35, 'Costillas BBQ');
