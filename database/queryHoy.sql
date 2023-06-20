SELECT * FROM superhero;
SELECT * FROM gender;
SELECT * FROM colour;
SELECT * FROM race;
SELECT * FROM publisher;
SELECT * FROM alignment;



DELIMITER $$
CREATE PROCEDURE spu_superhero_list_publisher(IN _publisher_id INT)
BEGIN
	SELECT
			SP.id,
			SP.superhero_name,
			SP.full_name,
			CO.colour AS 'eye_colour',
			CL.colour AS 'hair_colour',
			CR.colour AS 'skin_colour'
		FROM superhero SP
		INNER JOIN colour CO ON CO.id = SP.eye_colour_id
		INNER JOIN colour CL ON CL.id = SP.hair_colour_id
		INNER JOIN colour CR ON CR.id = SP.skin_colour_id
		WHERE SP.publisher_id = _publisher_id
		ORDER BY SP.id ASC;
END $$


DELIMITER $$
CREATE PROCEDURE spu_publisher_list()
BEGIN
	SELECT * FROM publisher ORDER BY publisher_name;
END $$


CALL spu_superhero_list_publisher(5);
CALL spu_publisher_list();


-- -------------------------------------------------------------------------------
-- ACTIVIDAD 01
-- -------------------------------------------------------------------------------

-- LISTAR EN LAS OPTIONS DEL CONTROL SELECT
DELIMITER $$
CREATE PROCEDURE spu_publisher_name_listar()
BEGIN
	SELECT * FROM publisher ORDER BY id;
END $$


DELIMITER $$
CREATE PROCEDURE spu_alignment_listar()
BEGIN
	SELECT * FROM alignment ORDER BY id;
END $$


-- POBLAR LA TABLA POR FILTROS
DELIMITER $$
CREATE PROCEDURE spu_publisher_alignment_listar(
	IN _publisher_id 	INT,
 	IN _alignment_id	INT
)
BEGIN
	IF (_alignment_id = 0) THEN
		SELECT
				SP.superhero_name,
				SP.full_name,
				RC.race,
				PB.publisher_name,
				AL.alignment
			FROM superhero SP
			INNER JOIN race RC ON RC.id = SP.race_id
			INNER JOIN publisher PB ON PB.id = SP.publisher_id
			INNER JOIN alignment AL ON AL.id = SP.alignment_id
			WHERE SP.publisher_id = _publisher_id
			ORDER BY AL.id;
	ELSE
		SELECT
				SP.superhero_name,
				SP.full_name,
				RC.race,
				PB.publisher_name,
				AL.alignment
			FROM superhero SP
			INNER JOIN race RC ON RC.id = SP.race_id
			INNER JOIN publisher PB ON PB.id = SP.publisher_id
			INNER JOIN alignment AL ON AL.id = SP.alignment_id
			WHERE SP.publisher_id = _publisher_id AND SP.alignment_id = _alignment_id
			ORDER BY AL.id;
	END IF;
END $$



-- -------------------------------------------------------------------------------
-- ACTIVIDAD 02
-- -------------------------------------------------------------------------------
-- id, superhero_name, alignment (FK), height_cm, weight_kg
SELECT height_cm FROM superhero ORDER BY `height_cm` DESC;


SELECT * FROM superhero WHERE height_cm BETWEEN 0 AND 30480;



SELECT
		SH.id,
		SH.superhero_name,
		AL.alignment,
		SH.height_cm,
		SH.weight_kg,
		PB.publisher_name
FROM superhero SH
INNER JOIN alignment AL ON AL.id = SH.alignment_id
INNER JOIN publisher PB ON PB.id = SH.publisher_id
WHERE publisher_id = _publisher_id AND height_cm BETWEEN _height_min_cm AND _height_max_cm;








DELIMITER $$
CREATE PROCEDURE spu_publisher_height_listar
(
	IN _publisher_id	INT,
	IN _height_min_cm	INT,
	IN _height_max_cm	INT
)
BEGIN
	SELECT
		SH.id,
		SH.superhero_name,
		AL.alignment,
		SH.height_cm,
		SH.weight_kg,
		PB.publisher_name
	FROM superhero SH
	INNER JOIN alignment AL ON AL.id = SH.alignment_id
	INNER JOIN publisher PB ON PB.id = SH.publisher_id
	WHERE SH.publisher_id = _publisher_id AND SH.height_cm BETWEEN _height_min_cm AND _height_max_cm
	ORDER BY SH.id;
END $$





-- LLAMADAS
CALL spu_publisher_name_listar();
CALL spu_alignment_listar();
CALL spu_publisher_alignment_listar(5,0);
CALL spu_publisher_height_listar(3, 50, 1050);








