/*----------------------------------------*/
/*CREACION DE BASE DE DATOS*/
/*----------------------------------------*/
CREATE DATABASE test;
USE test;

/*----------------------------------------*/
/*CREACION DE BASE DE TABLAS*/
/*----------------------------------------*/

SET FOREIGN_KEY_CHECKS=0;
truncate TABLE tipo_usr;
truncate TABLE usuario;
truncate TABLE personal;
SET FOREIGN_KEY_CHECKS=1;

 CREATE TABLE IF NOT EXISTS personal
(
	id_perso int(10) auto_increment not null,
    nombre varchar(35),
    apellido varchar(35),
    correo varchar (320),
    PRIMARY KEY (id_perso)
);

CREATE TABLE IF NOT EXISTS tipo_usr
(
	id_tipo int(10) auto_increment not null,
    perfil varchar(15),
    PRIMARY KEY (id_tipo)
);

CREATE TABLE IF NOT EXISTS usuario
(
	id_user int(10) auto_increment not null,
    id_perso int(10),
    nick_name varchar(20),
    clave varchar(35),
    estado boolean,
    id_tipo int(10),
    PRIMARY KEY (id_user),
    FOREIGN KEY (id_perso) REFERENCES personal(id_perso),
    FOREIGN KEY (id_tipo) REFERENCES tipo_usr(id_tipo)
);

/*----------------------------------------*/
/*CONSULTAS PARA MOSTRAR E INSERTAR DATOS*/
/*----------------------------------------*/

SELECT *
FROM personal AS p
INNER JOIN usuario AS u ON p.id_perso = u.id_perso
INNER JOIN tipo_usr AS t ON u.id_tipo = t.id_tipo ;

SELECT * FROM tipo_usr;
INSERT INTO tipo_usr(perfil) VALUE ('ADMINISTRADOR');
INSERT INTO tipo_usr(perfil) VALUE ('USUARIO');

SELECT * FROM personal;
INSERT INTO personal(nombre,apellido,correo) VALUES ('Lev Andrei','Merino Torres','merinolev96@gmail.com');
INSERT INTO personal(nombre,apellido,correo) VALUES ('Guillermo Enrique','Orellana','g_orellana@gmail.com');

SELECT * FROM usuario;
INSERT INTO usuario(id_perso,nick_name,clave,estado,id_tipo) VALUES ('1','administrador',md5('admin'),'1','1');
INSERT INTO usuario(id_perso,nick_name,clave,estado,id_tipo) VALUES ('2','invitado',md5('guest'),'0','2');