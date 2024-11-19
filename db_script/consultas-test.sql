-- SELECT
--     s.nombre_semestre,
--     COUNT(*) AS total_revisiones,
--     COUNT(CASE WHEN et.id IS NOT NULL THEN 1 END) AS evaluaciones_teoricas,
--     COUNT(CASE WHEN ep.id IS NOT NULL THEN 1 END) AS evaluaciones_practicas,
--     u.nombres, u.apellido_paterno, u.apellido_materno,
--     COUNT(CASE WHEN ar.id_revisor_usuario = u.id AND et.id IS NOT NULL THEN 1 END) AS revisiones_teoricas_por_revisor,
--     COUNT(CASE WHEN ar.id_revisor_usuario = u.id AND ep.id IS NOT NULL THEN 1 END) AS revisiones_practicas_por_revisor
-- FROM
--     SEMESTRE s
-- INNER JOIN ASIGNACION_REVISION ar ON s.id = ar.id_semestre
-- LEFT JOIN EVALUACION_Teorico et ON ar.id = et.id_asignacion_revision
-- LEFT JOIN EVALUACION_Practico ep ON ar.id = ep.id_asignacion_revision
-- INNER JOIN USUARIO u ON ar.id_revisor_usuario = u.id
-- WHERE
--     s.inicio <= :fecha_final_semestre AND s.fin >= :fecha_inicial_semestre
-- GROUP BY
--     s.nombre_semestre, u.id;


-- el administrador puede solicitar un reporte de las evaluaciones teoricas y practicas realizadas en un semestre en específico
SELECT *
FROM EVALUACION_Practico as ep
INNER JOIN PORTAFOLIO_CURSO as pc ON pc.id = ep.id_portafolio
INNER JOIN  CURSO_SEMESTRE as cs ON cs.id = pc.id_curso_semestre
INNER JOIN SEMESTRE as s ON s.id = cs.id_semestre
WHERE s.nombre_semestre = '2020-1';
