CREATE DATABASE TUC
USE TUC

CREATE TABLE usuario(matricula INT NOT NULL,
					 nombres NVARCHAR(100) NOT NULL,
					 apellidoP NVARCHAR(100) NOT NULL,
					 apellidoM NVARCHAR(100) NOT NULL,
					 correo NVARCHAR(100) NOT NULL,
					 contraseña NVARCHAR(100) NOT NULL,
					 fechanacimiento DATE NOT NULL,
					 rol INT NOT NULL,
					 credencial NVARCHAR(100) NOT NULL,
					 CONSTRAINT pk_Matricula PRIMARY KEY (matricula))

INSERT INTO usuario VALUES(202220023,
						   'Alan Misael',
						   'Bazan', 'Zenil',
						   'alan200470@hotmail.com',
						   'alan007w',
						   '2004-05-13',
						   1,
						   'CREDENCIAL A INTEGRAR')

SELECT * FROM usuario


