CREATE DATABASE TUC
USE TUC

CREATE TABLE usuario(matricula INT NOT NULL,
					 nombres NVARCHAR(100) NOT NULL,
					 apellidoP NVARCHAR(100) NOT NULL,
					 apellidoM NVARCHAR(100) NOT NULL,
					 correo NVARCHAR(100) NOT NULL,
					 contrasena NVARCHAR(100) NOT NULL,
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
INSERT INTO usuario VALUES(202220024,
						   'Alan Arturo',
						   'Pedroza', 'Espinosa',
						   'alan200471@hotmail.com',
						   'alan007w',
						   '2004-05-13',
						   2,
						   'CREDENCIAL A INTEGRAR')

SELECT * FROM usuario


CREATE TABLE conductor(idconductor INT NOT NULL,
					   matricula INT NOT NULL,
					   nolicencia NVARCHAR(50) NOT NULL,
					   CONSTRAINT pk_IdConductor PRIMARY KEY (idconductor),
					   CONSTRAINT fk_Matricula FOREIGN KEY (matricula) REFERENCES usuario(matricula))
					   
SELECT * FROM conductor

CREATE TABLE autos(idconductor INT NOT NULL,
				   placa NVARCHAR(100) NOT NULL,
				   niv NVARCHAR(100) NOT NULL,
				   color NVARCHAR(100) NOT NULL,
				   modelo NVARCHAR(100) NOT NULL,
				   marca NVARCHAR(100) NOT NULL,
				   fechaalta DATE NOT NULL,
				   capacidad INT NOT NULL,
				   año INT NOT NULL,
				   tipo NVARCHAR(100) NOT NULL,
				   CONSTRAINT pk_Placa PRIMARY KEY (placa),
				   CONSTRAINT fk_IdConductor FOREIGN KEY (idconductor) REFERENCES conductor(idconductor))

SELECT * FROM autos

CREATE TABLE rutas(idruta INT NOT NULL,
				   idconductor INT NOT NULL,
				   puntosalida NVARCHAR(200) NOT NULL,
				   puntollegada NVARCHAR(200) NOT NULL,
			       horariosalida NVARCHAR(30) NOT NULL,
				   CONSTRAINT pk_IdRuta PRIMARY KEY (idruta),
				   CONSTRAINT fk_IdConductorRuta FOREIGN KEY (idconductor) REFERENCES conductor(idconductor))

SELECT * FROM rutas

CREATE TABLE viaje(idviaje INT NOT NULL,
				   idconductor INT NOT NULL,
				   pasajeros INT NOT NULL,
				   placa NVARCHAR(100) NOT NULL,
				   costoxpersona INT NOT NULL,
				   calificacion INT NOT NULL,
				   comentarios NVARCHAR(255) NOT NULL,
				   CONSTRAINT pk_IdViaje PRIMARY KEY (idviaje),
				   CONSTRAINT fk_Placa FOREIGN KEY (placa) REFERENCES autos(placa),
				   CONSTRAINT fk_Conductor FOREIGN KEY (idconductor) REFERENCES conductor(idconductor))

SELECT * FROM viaje

CREATE TABLE pasajeros(idviaje INT,
					   matricula INT,
					   CONSTRAINT fk_IdViajeP FOREIGN KEY (idviaje) REFERENCES viaje(idviaje),
					   CONSTRAINT fk_MatriculaP FOREIGN KEY (matricula) REFERENCES usuario(matricula))

SELECT * FROM pasajeros

CREATE TABLE validacion(idvalidacion INT NOT NULL,
						matricula INT NOT NULL,
						estatus INT NOT NULL,
						CONSTRAINT pk_IdValidacion PRIMARY KEY (idvalidacion),
						CONSTRAINT fk_MatriculaValid FOREIGN KEY (matricula) REFERENCES usuario(matricula))

SELECT * FROM validacion

CREATE TABLE documentacion(matricula INT NOT NULL,
						   idvalidacion INT NOT NULL,
						   CONSTRAINT fk_MatriculaDoc FOREIGN KEY (matricula) REFERENCES usuario(matricula),
						   CONSTRAINT fk_IdValidacionDoc FOREIGN KEY (idvalidacion) REFERENCES validacion(idvalidacion))