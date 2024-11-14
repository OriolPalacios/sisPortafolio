-- Script para la creación de la base de datos y las tablas necesarias para el proyecto
-- Este script es meramente descriptivo e instructivo para describir el diseño de la base de datos, no tiene ningún efecto real sobre la aplicación


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
    estado enum("Observado", "Completado", "Pendiente"),
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
    evaluacion_entrada TEXT,
    informe_resultado_evaluacion_entrada TEXT,
    resolucion_evaluacion_entrada TEXT,
    enunciados_primera_parcial TEXT,
    resolucion_primera_parcial TEXT,
    enunciados_segunda_parcial TEXT,
    resolucion_segunda_parcial TEXT,
    enunciados_tercera_parcial TEXT,
    resolucion_tercera_parcial TEXT,
    asistencia_resolucion_primera_parcial TEXT,
    asistencia_resolucion_segunda_parcial TEXT,
    asistencia_resolucion_tercera_parcial TEXT,
    registro_ingreso_notas TEXT,
    rubrica_proyecto TEXT,
    asignacion_proyectos_individuales_o_grupales TEXT,
    informe_entrega_final_proyectos TEXT,
    otras_evaluaciones TEXT,
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
    id_portafolio INT,
    caratula TEXT,
    carga_academica TEXT,
    filosofia TEXT,
    cv TEXT,
    plan_sesiones TEXT,
    asistencia_alumnos TEXT,
    evidencia_actividades_ensenianza TEXT,
    registro_notas_practicas TEXT,
    proyecto_individual_grupal TEXT,
    fecha_de_revision DATE,
    FOREIGN KEY (id_revisor_usuario) REFERENCES USUARIO(id) ON DELETE CASCADE,
    FOREIGN KEY (id_docente_usuario) REFERENCES USUARIO(id) ON DELETE CASCADE,
    FOREIGN KEY (id_portafolio) REFERENCES PORTAFOLIO_CURSO(id) ON DELETE CASCADE
);


CREATE TABLE OBSERVACIONES (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_portafolio INT,
    observacion TEXT,
    fecha_observacion DATE,
    FOREIGN KEY (id_portafolio) REFERENCES PORTAFOLIO_CURSO(id) ON DELETE CASCADE
);