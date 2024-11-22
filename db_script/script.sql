-- Script para la creación de la base de datos y las tablas necesarias para el proyecto
-- Este script es meramente descriptivo e instructivo para describir el diseño de la base de datos, no tiene ningún efecto real sobre la aplicación


create database sisportafolio;
use sisportafolio;

CREATE TABLE MALLA_CURRICULAR (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_carrera VARCHAR(255) NOT NULL,
    facultad VARCHAR(255) NOT NULL,
    duracion_semestres INT NOT NULL,
    anio_vigencia DATE NOT NULL,
    activo BOOLEAN DEFAULT TRUE
);


CREATE TABLE CURSO (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_malla INT,
    codigo_curso VARCHAR(50) NOT NULL,
    area_curricular VARCHAR(255),
    nombre_curso VARCHAR(255) NOT NULL,
    tipo VARCHAR(50),
    FOREIGN KEY (id_malla) REFERENCES MALLA_CURRICULAR(id) ON DELETE CASCADE
);


CREATE TABLE SEMESTRE (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_semestre VARCHAR(50) NOT NULL,
    inicio DATE NOT NULL,
    fin DATE NOT NULL,
    activo BOOLEAN DEFAULT TRUE
);


CREATE TABLE CURSO_SEMESTRE (
    id INT auto_increment primary key,
    carrera VARCHAR(255),
    id_curso INT,
    id_semestre INT,
    activo BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (id_curso) REFERENCES CURSO(id) ON DELETE CASCADE,
    FOREIGN KEY (id_semestre) REFERENCES SEMESTRE(id) ON DELETE CASCADE
);


CREATE TABLE USUARIO (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombres VARCHAR(255) NOT NULL,
    apellido_paterno VARCHAR(255) NOT NULL,
    apellido_materno VARCHAR(255),
    fecha_nacimiento DATE,
    sexo CHAR(1),
    correo VARCHAR(255) UNIQUE NOT NULL,
    telefono VARCHAR(50),
    contrasena VARCHAR(255) NOT NULL,
    departamento VARCHAR(255),
    especialidad VARCHAR(255),
    revisor_asignado BOOLEAN DEFAULT FALSE,
    activo BOOLEAN DEFAULT TRUE,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


CREATE TABLE ROLES (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_rol VARCHAR(50) NOT NULL UNIQUE
);


CREATE TABLE USUARIO_ROL (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    id_rol INT,
    fecha_asignacion DATE NOT NULL,
    activo BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (id_usuario) REFERENCES USUARIO(id) ON DELETE CASCADE,
    FOREIGN KEY (id_rol) REFERENCES ROLES(id) ON DELETE CASCADE
);


CREATE TABLE ASIGNACION_REVISION (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_administrador_usuario INT,
    id_revisor_usuario INT,
    id_docente_usuario INT,
    id_semestre INT,
    fecha_asignacion DATE NOT NULL,
    activo BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (id_administrador_usuario) REFERENCES USUARIO(id) ON DELETE CASCADE,
    FOREIGN KEY (id_revisor_usuario) REFERENCES USUARIO(id) ON DELETE CASCADE,
    FOREIGN KEY (id_docente_usuario) REFERENCES USUARIO(id) ON DELETE CASCADE,
    FOREIGN KEY (id_semestre) REFERENCES SEMESTRE(id) ON DELETE CASCADE
);


CREATE TABLE PORTAFOLIO_CURSO (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_asignacion_revision INT,
    id_curso_semestre INT,
    codigo_curso_semestre VARCHAR(50),
    formato VARCHAR(50),
    estado enum("Observado", "Completado", "Pendiente"), -- potencialmente cambiable a Completo, Incompleto y Observado
    tipo VARCHAR(50),
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,		
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_asignacion_revision) REFERENCES ASIGNACION_REVISION(id) ON DELETE CASCADE,
    FOREIGN KEY (id_curso_semestre) REFERENCES CURSO_SEMESTRE(id) ON DELETE CASCADE
);


CREATE TABLE EVALUACION_Teorico (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_revisor_usuario INT,
    id_docente_usuario INT,
    id_portafolio_curso INT,
    caratula TEXT,
    carga_academica TEXT,
    filosofia TEXT,
    cv TEXT,    
    silabo TEXT,
    avance_por_sesiones TEXT,
    registro_entrega_silabo TEXT,
    asistencia_alumnos TEXT,    
    evidencia_actividades_ensenianza TEXT,
    relacion_estudiantes TEXT,
    -- evaluacion de entrada
    evaluacion_entrada TEXT,
    informe_resultado_evaluacion_entrada TEXT,
    resolucion_evaluacion_entrada TEXT,
    -- resolucion de las parciales
    resolucion_primera_parcial TEXT,
    resolucion_segunda_parcial TEXT,
    resolucion_tercera_parcial TEXT,
    resolucion_sustitutorio TEXT,
    -- enunciados de las parciales
    enunciados_primera_parcial TEXT,
    enunciados_segunda_parcial TEXT,
    enunciados_tercera_parcial TEXT,
    enunciados_sustitutorio TEXT,
    -- asistencia a las parciales
    asistencia_resolucion_primera_parcial TEXT,
    asistencia_resolucion_segunda_parcial TEXT, 
    asistencia_resolucion_tercera_parcial TEXT,
    -- registro de ingreso de notas
    registro_ingreso_notas_primera_parcial TEXT,
    registro_ingreso_notas_segunda_parcial TEXT,
    registro_ingreso_notas_tercera_parcial TEXT,
    registro_ingreso_notas_sustiturio TEXT,
    -- min max mean
    min_max_mean_notas_primera_parcial TEXT,
    min_max_mean_notas_segunda_parcial TEXT,
    min_max_mean_notas_tercera_parcial TEXT,
    -- proyectos (opcional)
    rubrica_proyecto TEXT NULL,
    asignacion_proyectos_individuales_o_grupales TEXT NULL,
    informe_entrega_final_proyectos TEXT NULL,
    otras_evaluaciones TEXT NULL,
    -- cierre del portafolio
    cierre_portafolio TEXT,
    fecha_de_revision DATE,
    FOREIGN KEY (id_revisor_usuario) REFERENCES USUARIO(id) ON DELETE CASCADE,
    FOREIGN KEY (id_docente_usuario) REFERENCES USUARIO(id) ON DELETE CASCADE,
    FOREIGN KEY (id_portafolio_curso) REFERENCES PORTAFOLIO_CURSO(id) ON DELETE CASCADE
);


CREATE TABLE EVALUACION_Practico (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_revisor_usuario INT,
    id_docente_usuario INT,
    id_portafolio_curso INT,
    caratula TEXT,
    carga_academica TEXT,
    filosofia TEXT,
    cv TEXT,
    plan_sesiones TEXT,
    asistencia_alumnos TEXT,
    evidencia_actividades_ensenianza TEXT,
    relacion_estudiantes TEXT,
    -- registro de notas
    registro_notas_practicas_primera_parcial TEXT,
    registro_notas_practicas_segunda_parcial TEXT,
    proyecto_individual_grupal TEXT NULL,
    fecha_de_revision DATE,
    FOREIGN KEY (id_revisor_usuario) REFERENCES USUARIO(id) ON DELETE CASCADE,
    FOREIGN KEY (id_docente_usuario) REFERENCES USUARIO(id) ON DELETE CASCADE,
    FOREIGN KEY (id_portafolio_curso) REFERENCES PORTAFOLIO_CURSO(id) ON DELETE CASCADE
);


CREATE TABLE OBSERVACIONES (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_portafolio_curso INT,
    observacion TEXT,
    fecha_observacion DATE,
    FOREIGN KEY (id_portafolio_curso) REFERENCES PORTAFOLIO_CURSO(id) ON DELETE CASCADE
);

-- Insercion de datos
INSERT INTO MALLA_CURRICULAR (nombre_carrera, facultad, duracion_semestres, anio_vigencia, activo)
VALUES
-- Facultad de Arquitectura y Artes Plasticas
('Arquitectura', 'Facultad de Arquitectura y Artes Plasticas', 3, '2017-01-01', TRUE),
('Arquitectura', 'Facultad de Arquitectura y Artes Plasticas', 3, '2024-06-14', TRUE),

-- Facultad de Ciencias Contables y Financieras
('Contabilidad', 'Facultad de Ciencias Contables y Financieras', 3, '2017-01-01', TRUE),
('Contabilidad', 'Facultad de Ciencias Contables y Financieras', 3, '2024-06-14', TRUE),

-- Facultad de Derecho y Ciencias Politicas
('Derecho', 'Facultad de Derecho y Ciencias Politicas', 3, '2017-01-01', TRUE),
('Derecho', 'Facultad de Derecho y Ciencias Politicas', 3, '2024-06-14', TRUE),

-- Facultad de Enfermeria
('Enfermeria', 'Facultad de Enfermeria', 3, '2017-01-01', TRUE),
('Enfermeria', 'Facultad de Enfermeria', 3, '2024-06-14', TRUE),

-- Facultad de Ingenieria de Procesos
('Ingenieria Quimica', 'Facultad de Ingenieria de Procesos', 3, '2017-01-01', TRUE),
('Ingenieria Quimica', 'Facultad de Ingenieria de Procesos', 3, '2024-06-14', TRUE),
('Ingenieria Petroquimica', 'Facultad de Ingenieria de Procesos', 3, '2017-01-01', TRUE),
('Ingenieria Petroquimica', 'Facultad de Ingenieria de Procesos', 3, '2024-06-14', TRUE),

-- Facultad de Agronomia y Zootecnia
('Agronomia', 'Facultad de Agronomia y Zootecnia', 3, '2017-01-01', TRUE),
('Agronomia', 'Facultad de Agronomia y Zootecnia', 3, '2024-06-14', TRUE),
('Zootecnia', 'Facultad de Agronomia y Zootecnia', 3, '2017-01-01', TRUE),
('Zootecnia', 'Facultad de Agronomia y Zootecnia', 3, '2024-06-14', TRUE),

-- Facultad de Administracion y Turismo
('Turismo', 'Facultad de Administracion y Turismo', 3, '2017-01-01', TRUE),
('Turismo', 'Facultad de Administracion y Turismo', 3, '2024-06-14', TRUE),

-- Facultad de Ciencias Biologicas
('Biologia', 'Facultad de Ciencias Biologicas', 3, '2017-01-01', TRUE),
('Biologia', 'Facultad de Ciencias Biologicas', 3, '2024-06-14', TRUE),

-- Facultad de Ciencias Quimicas, Fisicas y Matematicas
('Fisica', 'Facultad de Ciencias Quimicas, Fisicas y Matematicas', 3, '2017-01-01', TRUE),
('Fisica', 'Facultad de Ciencias Quimicas, Fisicas y Matematicas', 3, '2024-06-14', TRUE),
('Matematica', 'Facultad de Ciencias Quimicas, Fisicas y Matematicas', 3, '2017-01-01', TRUE),
('Matematica', 'Facultad de Ciencias Quimicas, Fisicas y Matematicas', 3, '2024-06-14', TRUE),

-- Facultad de Ciencias Sociales
('Psicologia', 'Facultad de Ciencias Sociales', 3, '2017-01-01', TRUE),
('Psicologia', 'Facultad de Ciencias Sociales', 3, '2024-06-14', TRUE),
('Filosofia', 'Facultad de Ciencias Sociales', 3, '2017-01-01', TRUE),
('Filosofia', 'Facultad de Ciencias Sociales', 3, '2024-06-14', TRUE),
('Antropologia', 'Facultad de Ciencias Sociales', 3, '2017-01-01', TRUE),
('Antropologia', 'Facultad de Ciencias Sociales', 3, '2024-06-14', TRUE),
('Arqueologia', 'Facultad de Ciencias Sociales', 3, '2017-01-01', TRUE),
('Arqueologia', 'Facultad de Ciencias Sociales', 3, '2024-06-14', TRUE),
('Historia', 'Facultad de Ciencias Sociales', 3, '2017-01-01', TRUE),
('Historia', 'Facultad de Ciencias Sociales', 3, '2024-06-14', TRUE),

-- Facultad de Comunicacion Social e Idiomas
('Ciencias de la Comunicacion', 'Facultad de Comunicacion Social e Idiomas', 3, '2017-01-01', TRUE),
('Ciencias de la Comunicacion', 'Facultad de Comunicacion Social e Idiomas', 3, '2024-06-14', TRUE),

-- Facultad de Economia
('Economia', 'Facultad de Economia', 3, '2017-01-01', TRUE),
('Economia', 'Facultad de Economia', 3, '2024-06-14', TRUE),

-- Facultad de Educacion
('Educacion', 'Facultad de Educacion', 3, '2017-01-01', TRUE),
('Educacion', 'Facultad de Educacion', 3, '2024-06-14', TRUE),

-- Facultad de Ingenieria Civil
('Ingenieria Civil', 'Facultad de Ingenieria Civil', 3, '2017-01-01', TRUE),
('Ingenieria Civil', 'Facultad de Ingenieria Civil', 3, '2024-06-14', TRUE),

-- Facultad de Ingenieria Electrica, Electronica, Informatica y Mecanica
('Ingenieria Electrica', 'Facultad de Ingenieria Electrica, Electronica, Informatica y Mecanica', 3, '2017-01-01', TRUE),
('Ingenieria Electrica', 'Facultad de Ingenieria Electrica, Electronica, Informatica y Mecanica', 3, '2024-06-14', TRUE),
('Ingenieria Electronica', 'Facultad de Ingenieria Electrica, Electronica, Informatica y Mecanica', 3, '2017-01-01', TRUE),
('Ingenieria Electronica', 'Facultad de Ingenieria Electrica, Electronica, Informatica y Mecanica', 3, '2024-06-14', TRUE),
('Ingenieria Mecanica', 'Facultad de Ingenieria Electrica, Electronica, Informatica y Mecanica', 3, '2017-01-01', TRUE),
('Ingenieria Mecanica', 'Facultad de Ingenieria Electrica, Electronica, Informatica y Mecanica', 3, '2024-06-14', TRUE),
('Ingenieria Informatica y de Sistemas', 'Facultad de Ingenieria Electrica, Electronica, Informatica y Mecanica', 3, '2017-01-01', TRUE),
('Ingenieria Informatica y de Sistemas', 'Facultad de Ingenieria Electrica, Electronica, Informatica y Mecanica', 3, '2024-06-14', TRUE),

-- Facultad de Medicina Humana
('Medicina Humana', 'Facultad de Medicina Humana', 3, '2017-01-01', TRUE),
('Medicina Humana', 'Facultad de Medicina Humana', 3, '2024-06-14', TRUE),
('Odontologia', 'Facultad de Medicina Humana', 3, '2017-01-01', TRUE),
('Odontologia', 'Facultad de Medicina Humana', 3, '2024-06-14', TRUE),

-- Facultad de Ingenieria Geologica, Minas y Metalurgica
('Ingenieria Geologica', 'Facultad de Ingenieria Geologica, Minas y Metalurgica', 3, '2017-01-01', TRUE),
('Ingenieria Geologica', 'Facultad de Ingenieria Geologica, Minas y Metalurgica', 3, '2024-06-14', TRUE),
('Ingenieria de Minas', 'Facultad de Ingenieria Geologica, Minas y Metalurgica', 3, '2017-01-01', TRUE),
('Ingenieria de Minas', 'Facultad de Ingenieria Geologica, Minas y Metalurgica', 3, '2024-06-14', TRUE),
('Ingenieria Metalurgica', 'Facultad de Ingenieria Geologica, Minas y Metalurgica', 3, '2017-01-01', TRUE),
('Ingenieria Metalurgica', 'Facultad de Ingenieria Geologica, Minas y Metalurgica', 3, '2024-06-14', TRUE),

-- Facultad de Ciencias de la Salud
('Farmacia y Bioquimica', 'Facultad de Ciencias de la Salud', 3, '2017-01-01', TRUE),
('Farmacia y Bioquimica', 'Facultad de Ciencias de la Salud', 3, '2024-06-14', TRUE)

-- Inserciones de los CURSO para ESTHER CRISTINA PACHECO VASQUEZ
INSERT INTO CURSO (id_malla, codigo_curso, area_curricular, nombre_curso, tipo) VALUES
(23, 'IF470AME', 'Estudios Generales', 'LENGUAJE DE PROGRAMACION', 'Teorico'),
(3, 'IF902BCO', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Teorico'),
(39, 'IF902BEU', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Teorico');

-- Inserciones de los CURSO para WILLIAN ZAMALLOA PARO
INSERT INTO CURSO (id_malla, codigo_curso, area_curricular, nombre_curso, tipo) VALUES
(49, 'IF616AIN', 'Especialidad', 'DESARROLLO DE SOFTWARE II', 'Practico'),
(49, 'IF617AIN', 'Especialidad', 'INGENIERIA DE SOFTWARE II', 'Teorico'),
(31, 'IF902AAQ', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Teorico');

-- Inserciones de los CURSO para HARLEY VERA OLIVERA
INSERT INTO CURSO (id_malla, codigo_curso, area_curricular, nombre_curso, tipo) VALUES
(49, 'IF710BIN', 'Especialidad', 'SEMINARIO DE INVESTIGACION I', 'Teorico');

-- Inserciones de los CURSO para MARITZA KATHERINE IRPANOCCA CUSIMAYTA
INSERT INTO CURSO (id_malla, codigo_curso, area_curricular, nombre_curso, tipo) VALUES
(43, 'IF212AEI', 'Estudios Generales', 'ANALISIS NUMERICO', 'Teorico'),
(23, 'IF471AME', 'Estudios Generales', 'METODOS NUMERICOS', 'Teorico'),
(19, 'IF902ABI', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Teorico'),
(47, 'IF902BBI', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Practico'),
(57, 'IF902AMI', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Teorico');

-- Inserciones de los CURSO para EFRAINA GLADYS CUTIPA ARAPA
INSERT INTO CURSO (id_malla, codigo_curso, area_curricular, nombre_curso, tipo) VALUES
(49, 'IF451AIN', 'Especialidad', 'POGRAMACION I', 'Practico'),
(49, 'IF552AIN', 'Especialidad', 'REDES DE COMPUTADORAS I', 'Teorico'),
(21, 'IF902AFI', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Teorico');

-- Inserciones de los CURSO para DARIO FRANCISCO DUEÑAS BUSTINZA
INSERT INTO CURSO (id_malla, codigo_curso, area_curricular, nombre_curso, tipo) VALUES
(49, 'IF480BIN', 'Especialidad', 'ADMINISTRACION DE TECNOLOGÍAS DE LA INFORMACION', 'Teorico'),
(19, 'IF902BBI', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Teorico'),
(49, 'IF481AIN', 'Especialidad', 'INGENIERIA ECONOMICA', 'Practico'),
(11, 'IF902AGI', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Teorico');

-- CURSO de Doris Sabina Aguirre Carbajal
INSERT INTO CURSO (id_malla, codigo_curso, area_curricular, nombre_curso, tipo) VALUES
(49, 'IF459BIN', 'Especialidad', 'COMPUTACION GRAFICA II', 'Practico'),
(3, 'IF902ACO', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Teorico'),
(39, 'IF902DEU', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Teorico'),
(7, 'IF902AEN', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Teorico'),
(21, 'IF902AFI', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Practico');

-- CURSO de Tany Villalba Villalba
INSERT INTO CURSO (id_malla, codigo_curso, area_curricular, nombre_curso, tipo) VALUES
(49, 'IF556AIN', 'Especialidad', 'SISTEMAS EMBEBIDOS', 'Teorico'),
(37, 'IF902BAE', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Teorico'),
(61, 'IF902BEN', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Teorico');

-- CURSO de Carlos Fernando Montoya Cubas
INSERT INTO CURSO (id_malla, codigo_curso, area_curricular, nombre_curso, tipo) VALUES
(49, 'IF453CIN', 'Especialidad', 'PROGRAMACION II', 'Practico'),
(49, 'IF466AIN', 'Especialidad', 'COMPILADORES', 'Teorico'),
(49, 'IF650BIN', 'Especialidad', 'MODELOS PROBABILISTICOS', 'Teorico'),
(49, 'IF651BIN', 'Especialidad', 'INTELIGENCIA ARTIFICIAL', 'Teorico');

-- CURSO de Carlos Ramon Quispe Onofre
INSERT INTO CURSO (id_malla, codigo_curso, area_curricular, nombre_curso, tipo) VALUES
(57, 'IF401AMI', 'Especialidad', 'PROGRAMACION DIGITAL', 'Teorico'),
(49, 'IF669BIN', 'Especialidad', 'MODELADO Y SIMULACION', 'Teorico'),
(19, 'IF902ABI', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Practico'),
(39, 'IF902AEE', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Teorico'),
(33, 'IF902AHI', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Teorico');

-- CURSO de Boris Chullo Llave
INSERT INTO CURSO (id_malla, codigo_curso, area_curricular, nombre_curso, tipo) VALUES
(49, 'IF453BIN', 'Especialidad', 'PROGRAMACION II', 'Practico'),
(49, 'IF455AIN', 'Especialidad', 'ALGORITMOS PARALELOS Y DISTRIBUIDOS', 'Teorico'),
(49, 'IF467BIN', 'Especialidad', 'ANALISIS Y DISEÑO DE ALGORITMOS', 'Teorico'),
(13, 'IF902AAO', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Practico'),
(5, 'IF902ADR', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Practico');

-- CURSO de Ray Dueñas Jimenez
INSERT INTO CURSO (id_malla, codigo_curso, area_curricular, nombre_curso, tipo) VALUES
(45, 'IF109ALI', 'Especialidad', 'PROGRAMACION DIGITAL II', 'Teorico'),
(49, 'IF619BIN', 'Especialidad', 'ANaLISIS DE DATOS EMPRESARIALES', 'Practico'),
(49, 'IF711BIN', 'Especialidad', 'SEMINARIO DE INVESTIGACION II', 'Teorico'),
(3, 'IF902ACO', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Practico'),
(5, 'IF902ADR', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Teorico'),
(51, 'IF902AIA', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Teorico');

-- CURSO de Hector Eduardo Ugarte Rojas
INSERT INTO CURSO (id_malla, codigo_curso, area_curricular, nombre_curso, tipo) VALUES
(49, 'IF453AIN', 'Especialidad', 'PROGRAMACION II', 'Practico'),
(49, 'IF454AIN', 'Especialidad', 'TEORIA DE LA COMPUTACION', 'Teorico'),
(49, 'IF611AIN', 'Especialidad', 'METODOLOGIA DE DESARROLLO DE SOFTWARE', 'Teorico'),
(15, 'IF902AAO', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Teorico'),
(43, 'IF902AEI', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Teorico');

-- CURSO de Liseth Urpy Segundo Carpio
INSERT INTO CURSO (id_malla, codigo_curso, area_curricular, nombre_curso, tipo) VALUES
(49, 'IF064AIN', 'Especialidad', 'TALLER DE DEBATE', 'Practico'),
(49, 'IF613AIN', 'Especialidad', 'DESARROLLO DE SOFTWARE I', 'Practico'),
(49, 'IF619AIN', 'Especialidad', 'ANaLISIS DE DATOS EMPRESARIALES', 'Teorico'),
(53, 'IF902AMD', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Teorico');

-- CURSO de Luis Alvaro Monzon Condori
INSERT INTO CURSO (id_malla, codigo_curso, area_curricular, nombre_curso, tipo) VALUES
(49, 'IF451BIN', 'Especialidad', 'PROGRAMACION I', 'Practico'),
(49, 'IF613BIN', 'Especialidad', 'DESARROLLO DE SOFTWARE I', 'Practico'),
(49, 'IF613CIN', 'Especialidad', 'DESARROLLO DE SOFTWARE I', 'Practico'),
(41, 'IF902ACI', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Teorico'),
(9, 'IF902AQI', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Practico');

-- CURSO de Jisbaj Gamarra Salas
INSERT INTO CURSO (id_malla, codigo_curso, area_curricular, nombre_curso, tipo) VALUES
(49, 'IF611BIN', 'Especialidad', 'METODOLOGIA DE DESARROLLO DE SOFTWARE', 'Teorico'),
(37, 'IF902AEO', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Teorico');

-- CURSO de Henry Samuel Dueñas de la Cruz
INSERT INTO CURSO (id_malla, codigo_curso, area_curricular, nombre_curso, tipo) VALUES
(49, 'IF614BIN', 'Especialidad', 'INGENIERIA DE SOFTWARE I', 'Teorico'),
(45, 'IF902ALI', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Teorico');

-- CURSO de Ana Rocio Cardenas Maita
INSERT INTO CURSO (id_malla, codigo_curso, area_curricular, nombre_curso, tipo) VALUES
(1, 'IF902AAT', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Teorico');

-- CURSO de Raul Huillca Huallparimachi
INSERT INTO CURSO (id_malla, codigo_curso, area_curricular, nombre_curso, tipo) VALUES
(49, 'IF467AIN', 'Especialidad', 'ANALISIS Y DISEÑO DE ALGORITMOS', 'Teorico');

-- CURSO de Gabriela Zuñiga Rojas
INSERT INTO CURSO (id_malla, codigo_curso, area_curricular, nombre_curso, tipo) VALUES
(49, 'IF651AIN', 'Especialidad', 'INTELIGENCIA ARTIFICIAL', 'Practico'),
(49, 'IF652AIN', 'Especialidad', 'APRENDIZAJE AUTOMATICO', 'Practico'),
(49, 'IF656AIN', 'Especialidad', 'PROCESAMIENTO DE LENGUAJE NATURAL', 'Practico'),
(29, 'IF902AAN', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Practico'),
(33, 'IF902AAE', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Practico'),
(37, 'IF902BAE', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Practico'),
(7, 'IF902AEN', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Practico'),
(57, 'IF902AMI', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Practico');

-- CURSO de Maria del Pilar Venegas Vergara
INSERT INTO CURSO (id_malla, codigo_curso, area_curricular, nombre_curso, tipo) VALUES
(57, 'IF391AMI', 'Estudios Generales', 'SISTEMA DE BASE DE DATOS', 'Practico'),
(49, 'IF614AIN', 'Especialidad', 'INGENIERIA DE SOFTWARE I', 'Teorico');

-- CURSO de Victor Dario Sosa Jauregui
INSERT INTO CURSO (id_malla, codigo_curso, area_curricular, nombre_curso, tipo) VALUES
(49, 'IF612AIN', 'Especialidad', 'FUNDAMENTOS Y DISEÑO DE BASE DE DATOS', 'Practico'),
(49, 'IF617AIN', 'Especialidad', 'INGENIERIA DE SOFTWARE II', 'Practico'),
(49, 'IF619BIN', 'Especialidad', 'ANaLISIS DE DATOS EMPRESARIALES', 'Teorico');

-- CURSO de Julio Vladimir Quispe Sota
INSERT INTO CURSO (id_malla, codigo_curso, area_curricular, nombre_curso, tipo) VALUES
(49, 'IF455BIN', 'Especialidad', 'ALGORITMOS PARALELOS Y DISTRIBUIDOS', 'Teorico');

-- CURSO de Élida Falcon Huallpa
INSERT INTO CURSO (id_malla, codigo_curso, area_curricular, nombre_curso, tipo) VALUES
(45, 'IF107ALI', 'Estudios Generales', 'PROGRAMACION DIGITAL I', 'Teorico');

-- CURSO de Vittali Quispe Surco
INSERT INTO CURSO (id_malla, codigo_curso, area_curricular, nombre_curso, tipo) VALUES
(49, 'IF459AIN', 'Especialidad', 'COMPUTACION GRAFICA II', 'Teorico'),
(49, 'IF466AIN', 'Especialidad', 'COMPILADORES', 'Practico'),
(49, 'IF618AIN', 'Especialidad', 'TOPICOS AVANZADOS EN INGENIERIA DE SOFTWARE', 'Teorico'),
(39, 'IF902AEU', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Practico'),
(39, 'IF902DEU', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Practico');

-- CURSO de Vanesa Lavilla Alvarez
INSERT INTO CURSO (id_malla, codigo_curso, area_curricular, nombre_curso, tipo) VALUES
(49, 'IF550AIN', 'Especialidad', 'ORGANIZACION Y ARQUITECTURA DEL COMPUTADOR', 'Practico'),
(49, 'IF553AIN', 'Especialidad', 'LENGUAJE ENSAMBLADOR', 'Practico'),
(41, 'IF758ACI', 'Estudios Generales', 'METODOS NUMERICOS', 'Practico'),
(39, 'IF902DEU', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Practico'),
(43, 'IF902AEI', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Practico'),
(45, 'IF902ALI', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Practico'),
(17, 'IF902ATU', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Practico');

-- CURSO de Lisha Sabah Diaz Caceres
INSERT INTO CURSO (id_malla, codigo_curso, area_curricular, nombre_curso, tipo) VALUES
(49, 'IF063BIN', 'Especialidad', 'QUECHUA', 'Practico'),
(1, 'IF902AAT', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Practico'),
(3, 'IF902ACO', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Practico'),
(39, 'IF902CEU', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Practico'),
(51, 'IF902AIA', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Practico'),
(55, 'IF902AGI', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Practico');

-- CURSO de Marcio Fernando Merma Quispe
INSERT INTO CURSO (id_malla, codigo_curso, area_curricular, nombre_curso, tipo) VALUES
(43, 'IF467AEI', 'Estudios Generales', 'PROGRAMACION DIGITAL', 'Practico'),
(5, 'IF902ADR', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Practico'),
(33, 'IF902AHI', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Practico'),
(51, 'IF902AFO', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Practico');

-- CURSO de Olmer Claudio Villena Leon
INSERT INTO CURSO (id_malla, codigo_curso, area_curricular, nombre_curso, tipo) VALUES
(49, 'IF060AIN', 'Especialidad', 'MUSICA', 'Practico'),
(31, 'IF902AAQ', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Practico'),
(33, 'IF902AAE', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Practico'),
(39, 'IF902AEE', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Practico');

-- CURSO de Raimar Abarca Mora
INSERT INTO CURSO (id_malla, codigo_curso, area_curricular, nombre_curso, tipo) VALUES
(49, 'IF063AIN', 'Especialidad', 'QUECHUA', 'Practico');

-- CURSO de Gerar Francis Quispe Torres
INSERT INTO CURSO (id_malla, codigo_curso, area_curricular, nombre_curso, tipo) VALUES
(49, 'IF456AIN', 'Especialidad', 'ALGORITMOS AVANZADOS', 'Teorico'),
(49, 'IF614AIN', 'Especialidad', 'INGENIERIA DE SOFTWARE I', 'Practico'),
(39, 'IF902BEU', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Practico');

-- CURSO de Jonel Ccente Zuzunaga
INSERT INTO CURSO (id_malla, codigo_curso, area_curricular, nombre_curso, tipo) VALUES
(7, 'IF902BEN', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Practico'),
(59, 'IF902AMT', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Teorico');

-- CURSO de Stephan Jhoel Cosio Loaiza
INSERT INTO CURSO (id_malla, codigo_curso, area_curricular, nombre_curso, tipo) VALUES
(49, 'IF483BIN', 'Especialidad', 'FORMULACION DE PROYECTOS DE TECNOLOGIAS DE LA INFORMACION', 'Teorico');

-- CURSO de Luz Indira Ticona Felix
INSERT INTO CURSO (id_malla, codigo_curso, area_curricular, nombre_curso, tipo) VALUES
(23, 'IF470AME', 'Estudios Generales', 'LENGUAJE DE PROGRAMACION', 'Practico'),
(49, 'IF656AIN', 'Especialidad', 'PROCESAMIENTO DE LENGUAJE NATURAL', 'Practico'),
(13, 'IF902AAO', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Practico'),
(43, 'IF902AEI', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Practico');

-- CURSO de Edelmira Davila Andrade
INSERT INTO CURSO (id_malla, codigo_curso, area_curricular, nombre_curso, tipo) VALUES
(23, 'IF471AME', 'Estudios Generales', 'METODOS NUMERICOS', 'Practico'),
(49, 'IF556AIN', 'Especialidad', 'SISTEMAS EMBEBIDOS', 'Practico'),
(51, 'IF902AIA', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Practico'),
(59, 'IF902AMT', 'Estudios Generales', 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION', 'Practico');

-- SEMESTRE
INSERT INTO SEMESTRE (nombre_semestre, inicio, fin, activo) 
VALUES ('2022-II', '2022-08-15', '2023-02-16', FALSE);

-- ROLES
INSERT INTO ROLES (nombre_rol)
VALUES 
('Administrador'),
('Docente'),
('Revisor'),
('Root');


-- USUARIOS
INSERT INTO USUARIO VALUES 
("LAURO","ENCISO","RODAS","1974-06-05","M","LAURO.ENCISO@unsaac.edu.pe","999833533","password","Ingenieria","Ingenieria de Sistemas",True),
("JULIO CESAR","CARBAJAL","LUNA","1975-10-23","M","JULIO.CESAR.CARBAJAL@unsaac.edu.pe","999150808","password","Ingenieria","Ingenieria de Sistemas",True),
("NILA ZONIA","ACURIO","USCA","1977-09-21","F","NILA.ZONIA.ACURIO@unsaac.edu.pe","999816538","password","Ingenieria","Ingenieria de Sistemas",True),
("JAVIER ARTURO","ROZAS","HUACHO","1985-05-06","M","JAVIER.ARTURO.ROZAS@unsaac.edu.pe","999232242","password","Ingenieria","Ingenieria de Sistemas",True),
("LINO PRISCILIANO","FLORES","PACHECO","1991-05-17","M","LINO.PRISCILIANO.FLORES@unsaac.edu.pe","999302642","password","Ingenieria","Ingenieria de Sistemas",True),
("EDWIN","CARRASCO","POBLETE","1974-02-26","F","EDWIN.CARRASCO@unsaac.edu.pe","999916639","password","Ingenieria","Ingenieria de Sistemas",True),
("EMILIO","PALOMINO","OLIVERA","1995-11-15","M","EMILIO.PALOMINO@unsaac.edu.pe","999631379","password","Ingenieria","Ingenieria de Sistemas",True),
("ENRIQUE","GAMARRA","SALDIVAR","1973-11-23","M","ENRIQUE.GAMARRA@unsaac.edu.pe","999842608","password","Ingenieria","Ingenieria de Sistemas",True),
("DENNIS IVAN","CANDIA","OVIEDO","1971-07-04","F","DENNIS.IVAN.CANDIA@unsaac.edu.pe","999104312","password","Ingenieria","Ingenieria de Sistemas",True),
("RONY","VILLAFUERTE","SERNA","1994-09-22","M","RONY.VILLAFUERTE@unsaac.edu.pe","999707313","password","Ingenieria","Ingenieria de Sistemas",True),
("GUZMAN","TICONA","PARI","1971-05-22","M","GUZMAN.TICONA@unsaac.edu.pe","999440297","password","Ingenieria","Ingenieria de Sistemas",True),
("YESHICA ISELA","ORMENO","AYALA","1989-06-17","F","YESHICA.ISELA.ORMENO@unsaac.edu.pe","999256021","password","Ingenieria","Ingenieria de Sistemas",True),
("JAVIER DAVID","CHAVEZ","CENTENO","1985-11-13","F","JAVIER.DAVID.CHAVEZ@unsaac.edu.pe","999511994","password","Ingenieria","Ingenieria de Sistemas",True),
("ROXANA LISETTE","QUINTANILLA","PORTUGAL","1977-12-30","M","ROXANA.LISETTE.QUINTANILLA@unsaac.edu.pe","999130349","password","Ingenieria","Ingenieria de Sistemas",True),
("IVAN CESAR","MEDRANO","VALENCIA","1988-11-18","M","IVAN.CESAR.MEDRANO@unsaac.edu.pe","999688465","password","Ingenieria","Ingenieria de Sistemas",True),
("LUIS BELTRAN","PALMA","TTITO","1993-05-29","F","LUIS.BELTRAN.PALMA@unsaac.edu.pe","999354772","password","Ingenieria","Ingenieria de Sistemas",True),
("ROBERT WILBERT","ALZAMORA","PAREDES","1974-08-29","F","ROBERT.WILBERT.ALZAMORA@unsaac.edu.pe","999052109","password","Ingenieria","Ingenieria de Sistemas",True),
("WALDO ELIO","IBARRA","ZAMBRANO","1999-01-29","F","WALDO.ELIO.IBARRA@unsaac.edu.pe","999906417","password","Ingenieria","Ingenieria de Sistemas",True),
("KARELIA","MEDINA","MIRANDA","1991-04-19","M","KARELIA.MEDINA@unsaac.edu.pe","999236400","password","Ingenieria","Ingenieria de Sistemas",True),
("VANESSA MARIBEL","CHOQUE","SOTO","1993-03-22","M","VANESSA.MARIBEL.CHOQUE@unsaac.edu.pe","999147382","password","Ingenieria","Ingenieria de Sistemas",True),
("MANUEL AURELIO","PENALOZA","FIGUEROA","1976-10-13","F","MANUEL.AURELIO.PENALOZA@unsaac.edu.pe","999135871","password","Ingenieria","Ingenieria de Sistemas",True),
("JOSW MAURO","PILLCO","QUISPE","1997-05-07","M","JOSW.MAURO.PILLCO@unsaac.edu.pe","999674972","password","Ingenieria","Ingenieria de Sistemas",True),
("LINO AQUILES","BACA","CARDENAS","1988-07-22","M","LINO.AQUILES.BACA@unsaac.edu.pe","999046871","password","Ingenieria","Ingenieria de Sistemas",True),
("ESTHER CRISTINA","PACHECO","VASQUEZ","1988-06-20","F","ESTHER.CRISTINA.PACHECO@unsaac.edu.pe","999373103","password","Ingenieria","Ingenieria de Sistemas",True),
("WILLIAN","ZAMALLOA","PARO","1990-04-02","F","WILLIAN.ZAMALLOA@unsaac.edu.pe","999639453","password","Ingenieria","Ingenieria de Sistemas",True),
("HARLEY","VERA","OLIVERA","1979-07-04","F","HARLEY.VERA@unsaac.edu.pe","999476959","password","Ingenieria","Ingenieria de Sistemas",True),
("MARITZA KATHERINE","IRPANOCA","CUSIMAYTA","1972-04-21","M","MARITZA.KATHERINE.IRPANOCA@unsaac.edu.pe","999974433","password","Ingenieria","Ingenieria de Sistemas",True),
("EFRAINA GLADYS","CUTIPA","ARAPA","1987-08-08","F","EFRAINA.GLADYS.CUTIPA@unsaac.edu.pe","999025395","password","Ingenieria","Ingenieria de Sistemas",True),
("DARIO FRANCISCO","DUENAS","BUSTINZA","1974-11-15","F","DARIO.FRANCISCO.DUENAS@unsaac.edu.pe","999521068","password","Ingenieria","Ingenieria de Sistemas",True),
("DORIS SABINA","AGUIRRE","CARBAJAL","1997-08-10","F","DORIS.SABINA.AGUIRRE@unsaac.edu.pe","999717595","password","Ingenieria","Ingenieria de Sistemas",True),
("TANY","VILLALBA","VILLALBA","1980-01-13","M","TANY.VILLALBA@unsaac.edu.pe","999474988","password","Ingenieria","Ingenieria de Sistemas",True),
("CARLOS FERNANDO","MONTOYA","CUBAS","1999-06-30","F","CARLOS.FERNANDO.MONTOYA@unsaac.edu.pe","999114532","password","Ingenieria","Ingenieria de Sistemas",True),
("CARLOS RAMON","QUISPE","ONOFRE","1981-08-01","M","CARLOS.RAMON.QUISPE@unsaac.edu.pe","999095357","password","Ingenieria","Ingenieria de Sistemas",True),
("BORIS","CHULLO","LLAVE","1976-04-26","F","BORIS.CHULLO@unsaac.edu.pe","999284327","password","Ingenieria","Ingenieria de Sistemas",True),
("RAY","DUENAS","JIMWNEZ","1997-07-25","M","RAY.DUENAS@unsaac.edu.pe","999317806","password","Ingenieria","Ingenieria de Sistemas",True),
("HWCTOR EDUARDO","UGARTE","ROJAS","1989-12-30","M","HWCTOR.EDUARDO.UGARTE@unsaac.edu.pe","999921777","password","Ingenieria","Ingenieria de Sistemas",True),
("LISETH URPY","SEGUNDO","CARPIO","1973-07-30","F","LISETH.URPY.SEGUNDO@unsaac.edu.pe","999041757","password","Ingenieria","Ingenieria de Sistemas",True),
("LUIS ALVARO","MONZON","CONDORI","1992-07-18","M","LUIS.ALVARO.MONZON@unsaac.edu.pe","999682287","password","Ingenieria","Ingenieria de Sistemas",True),
("VITALI","QUISPE","SURCO","1977-01-02","F","VITALI.QUISPE@unsaac.edu.pe","999562707","password","Ingenieria","Ingenieria de Sistemas",True),
("JISBAJ","GAMARRAS","SALAS","1970-12-17","M","JISBAJ.GAMARRAS@unsaac.edu.pe","999668009","password","Ingenieria","Ingenieria de Sistemas",True),
("HENRY SAMUEL","DUENAS","DE","1979-06-10","F","HENRY.SAMUEL.DUENAS@unsaac.edu.pe","999513495","password","Ingenieria","Ingenieria de Sistemas",True),
("ANA ROCIO","CARDENAS","MAITA","1980-10-28","M","ANA.ROCIO.CARDENAS@unsaac.edu.pe","999363185","password","Ingenieria","Ingenieria de Sistemas",True),
("RAUL","HUILLCA","HUALLPARIMACHI","1992-08-14","M","RAUL.HUILLCA@unsaac.edu.pe","999849467","password","Ingenieria","Ingenieria de Sistemas",True),
("GABRIELA","ZUNIGA","ROJAS","1996-04-06","M","GABRIELA.ZUNIGA@unsaac.edu.pe","999829288","password","Ingenieria","Ingenieria de Sistemas",True),
("MARIA DEL","PILAR","VENEGAS","1990-05-17","M","MARIA.DEL.PILAR@unsaac.edu.pe","999085496","password","Ingenieria","Ingenieria de Sistemas",True),
("VICTOR DARIO","SOSA","JAUREGUI","1999-03-03","F","VICTOR.DARIO.SOSA@unsaac.edu.pe","999238324","password","Ingenieria","Ingenieria de Sistemas",True),
("JULIO VLADIMIR","QUISPE","SOTA","1971-01-12","F","JULIO.VLADIMIR.QUISPE@unsaac.edu.pe","999942520","password","Ingenieria","Ingenieria de Sistemas",True),
("WLIDA","FALCON","HUALLPA","1970-09-28","M","WLIDA.FALCON@unsaac.edu.pe","999911345","password","Ingenieria","Ingenieria de Sistemas",True),
("VANESA","LAVILLA","ALVAREZ","1978-06-11","M","VANESA.LAVILLA@unsaac.edu.pe","999004241","password","Ingenieria","Ingenieria de Sistemas",True),
("LISHA SABAH","DIAZ","CACERES","1981-10-02","F","LISHA.SABAH.DIAZ@unsaac.edu.pe","999895746","password","Ingenieria","Ingenieria de Sistemas",True),
("MARCIO FERNANDO","MERMA","QUISPE","1996-04-13","M","MARCIO.FERNANDO.MERMA@unsaac.edu.pe","999252150","password","Ingenieria","Ingenieria de Sistemas",True),
("OLMER CLAUDIO","VILLENA","LEON","1978-08-07","M","OLMER.CLAUDIO.VILLENA@unsaac.edu.pe","999109426","password","Ingenieria","Ingenieria de Sistemas",True),
("RAIMAR","ABARCA","MORA","1975-10-15","M","RAIMAR.ABARCA@unsaac.edu.pe","999328418","password","Ingenieria","Ingenieria de Sistemas",True),
("GERAR FRANCIS","QUISPE","TORRES","1970-03-07","F","GERAR.FRANCIS.QUISPE@unsaac.edu.pe","999210365","password","Ingenieria","Ingenieria de Sistemas",True),
("JONEL","CCENTE","ZUZUNAGA","1977-01-12","M","JONEL.CCENTE@unsaac.edu.pe","999529032","password","Ingenieria","Ingenieria de Sistemas",True),
("STEPHAN JHOEL","COSIO","LOAIZA","1993-06-11","F","STEPHAN.JHOEL.COSIO@unsaac.edu.pe","999617539","password","Ingenieria","Ingenieria de Sistemas",True),
("LUZ INDIRA","TICONA","FWLIX","1999-04-20","F","LUZ.INDIRA.TICONA@unsaac.edu.pe","999869700","password","Ingenieria","Ingenieria de Sistemas",True),
("EDELMIRA","DAVILA","ANDRADE","1972-12-22","F","EDELMIRA.DAVILA@unsaac.edu.pe","999585471","password","Ingenieria","Ingenieria de Sistemas",True);

-- USUARIO_ROL
INSERT INTO USUARIO_ROL VALUES
(),