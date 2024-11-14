INSERT INTO dbportafolio.MALLA_CURRICULAR (nombre_carrera, facultad, duracion_semestres, anio_vigencia, activo)
VALUES 
('Ingeniería de Sistemas', 'Facultad de Ingeniería', 10, '2021-01-01', TRUE),
('Ingeniería Civil', 'Facultad de Ingeniería', 10, '2018-03-01', TRUE),
('Arquitectura', 'Facultad de Arquitectura', 10, '2019-02-01', TRUE),
('Administración', 'Facultad de Ciencias Económicas', 8, '2020-01-01', TRUE),
('Derecho', 'Facultad de Derecho', 12, '2017-01-01', FALSE);

INSERT INTO dbportafolio.CURSO (id_malla, codigo_curso, area_curricular, nombre_curso, tipo)
VALUES 
(1, 'INF101', 'Programación', 'Introducción a la Programación', 'Obligatorio'),
(1, 'INF203', 'Sistemas de Información', 'Análisis de Sistemas', 'Obligatorio'),
(2, 'CIV301', 'Estructuras', 'Mecánica de Materiales', 'Obligatorio'),
(3, 'ARQ204', 'Diseño Arquitectónico', 'Diseño de Espacios Públicos', 'Electivo'),
(4, 'ADM101', 'Economía', 'Introducción a la Economía', 'Obligatorio');

INSERT INTO dbportafolio.SEMESTRE (nombre_semestre, inicio, fin, activo)
VALUES 
('2024-I', '2024-03-01', '2024-07-30', TRUE),
('2024-II', '2024-08-01', '2024-12-15', TRUE),
('2023-I', '2023-03-01', '2023-07-30', FALSE),
('2023-II', '2023-08-01', '2023-12-15', FALSE),
('2022-I', '2022-03-01', '2022-07-30', FALSE);

INSERT INTO dbportafolio.CURSO_SEMESTRE (id_curso, id_semestre, activo)
VALUES 
(1, 1, TRUE),
(2, 1, TRUE),
(3, 2, TRUE),
(4, 3, FALSE),
(5, 4, FALSE);

INSERT INTO dbportafolio.USUARIO (nombres, apellido_paterno, apellido_materno, fecha_nacimiento, sexo, correo, telefono, contrasena, departamento, especialidad, revisor_asignado, activo)
VALUES 
('Carlos', 'Ramirez', 'Lopez', '1985-05-12', 'M', 'carlos.ramirez@uni.edu.pe', '999123456', 'password123', 'Lima', 'Sistemas', FALSE, TRUE),
('Lucia', 'Torres', 'Gomez', '1990-07-20', 'F', 'lucia.torres@uni.edu.pe', '998765432', 'pass456', 'Lima', 'Software', TRUE, TRUE),
('Ricardo', 'Mendoza', 'Perez', '1975-02-15', 'M', 'ricardo.mendoza@uni.edu.pe', '997123654', 'secure789', 'Cusco', 'Bio-informática', TRUE, TRUE),
('Marta', 'Castillo', 'Flores', '1982-08-24', 'F', 'marta.castillo@uni.edu.pe', '996789321', 'admin001', 'Lima', 'Sistemas', FALSE, TRUE),
('Elena', 'Vargas', 'Rios', '1995-03-10', 'F', 'elena.vargas@uni.edu.pe', '995456789', 'docpass789', 'Arequipa', 'Base de datos', FALSE, TRUE),
('root', 'root', 'root', '1995-03-10', 'M', 'root', 'root', 'root', 'root', 'root', TRUE, TRUE);

INSERT INTO dbportafolio.ROLES (nombre_rol)
VALUES 
('Administrador'),
('Docente'),
('Revisor'),
('Root');

INSERT INTO dbportafolio.USUARIO_ROL (id_usuario, id_rol, fecha_asignacion, activo)
VALUES 
(1, 1, '2024-01-15', TRUE),
(2, 2, '2024-02-01', TRUE),
(3, 3, '2024-02-10', TRUE),
(4, 3, '2024-02-15', TRUE),
(5, 2, '2024-03-01', TRUE),
(6, 4, '2024-03-01', TRUE);

INSERT INTO dbportafolio.ASIGNACION_REVISION (id_administrador_usuario, id_revisor_usuario, id_docente_usuario, id_semestre, fecha_asignacion, activo)
VALUES 
(1, 3, 2, 1, '2024-03-15', TRUE),  -- Asignación de Lucia como Docente, Ricardo como Revisor
(1, 4, 2, 1, '2024-03-20', TRUE),  -- Asignación de Lucia como Docente, Marta como Revisor
(1, 3, 5, 2, '2024-08-05', TRUE),  -- Asignación de Elena como Docente, Ricardo como Revisor
(1, 3, 4, 3, '2023-03-01', FALSE),  -- Asignación de Marta como Revisor
(1, 4, 3, 4, '2023-08-15', FALSE);  -- Asignación de Ricardo como Revisor

INSERT INTO dbportafolio.PORTAFOLIO_CURSO (id_asignacion_revision, id_curso_semestre, codigo_curso_semestre, formato, estado, tipo)
VALUES 
(1, 1, 'INF101-2024I', 'PDF', 'Pendiente', 'Teórico'),
(2, 2, 'INF203-2024I', 'PDF', 'Completado', 'Práctico'),
(3, 3, 'CIV301-2024II', 'Word', 'Observado', 'Teórico'),
(4, 4, 'ARQ204-2023I', 'PDF', 'Observado', 'Práctico'),
(5, 5, 'ADM101-2023II', 'Word', 'Pendiente', 'Teórico');

INSERT INTO dbportafolio.EVALUACION_Teorico (id_revisor_usuario, id_docente_usuario, id_portafolio_curso, caratula, carga_academica, filosofia, cv, silabo, avance_por_sesiones, registro_entrega_silabo, asistencia_alumnos, evidencia_actividades_ensenianza, evaluacion_entrada, informe_resultado_evaluacion_entrada, resolucion_evaluacion_entrada, enunciados_primera_parcial, resolucion_primera_parcial, enunciados_segunda_parcial, resolucion_segunda_parcial, enunciados_tercera_parcial, resolucion_tercera_parcial, asistencia_resolucion_primera_parcial, asistencia_resolucion_segunda_parcial, asistencia_resolucion_tercera_parcial, registro_ingreso_notas, rubrica_proyecto, asignacion_proyectos_individuales_o_grupales, informe_entrega_final_proyectos, otras_evaluaciones, cierre_portafolio, fecha_de_revision)
VALUES 
(3, 2, 1, 'Completado', 'Pendiente', 'Observado', 'Completado', 'Completado', 'Pendiente', 'Completado', 'Completado', 'Completado', 'Pendiente', 'Completado', 'Completado', 'Pendiente', 'Observado', 'Completado', 'Pendiente', 'No Aplica', 'No Aplica', 'Pendiente', 'Observado', 'No Aplica', 'Completado', 'Observado', 'Pendiente', 'Completado', 'Pendiente', 'Observado', '2024-04-15');

INSERT INTO dbportafolio.EVALUACION_Practico (id_revisor_usuario, id_docente_usuario, id_portafolio, caratula, carga_academica, filosofia, cv, plan_sesiones, asistencia_alumnos, evidencia_actividades_ensenianza, registro_notas_practicas, proyecto_individual_grupal, fecha_de_revision)
VALUES 
(4, 5, 1, 'Completado', 'Pendiente', 'Observado', 'Completado', 'Pendiente', 'Observado', 'Completado', 'Pendiente', 'Completado', '2024-04-18');

INSERT INTO dbportafolio.OBSERVACIONES (id_portafolio, observacion, fecha_observacion)
VALUES 
(1, 'Se observa que falta el silabo del curso en el portafolio.', '2024-05-02'),
(2, 'El formato del portafolio presenta errores en la estructura.', '2024-05-05'),
(3, 'Los registros de asistencia no están completos para todas las sesiones.', '2024-05-10'),
(4, 'Falta evidencia de actividades de enseñanza en el portafolio.', '2024-05-12'),
(5, 'El documento de carga académica contiene información incompleta.', '2024-05-15');