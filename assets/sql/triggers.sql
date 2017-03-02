CREATE OR REPLACE FUNCTION create_club()
  RETURNS trigger AS
$BODY$
	BEGIN
	INSERT INTO club_info (id_club) values (old.id_club);
  INSERT INTO club_fans(id_club) values(old.id_club);
	RETURN NEW;
	END;
$BODY$
  LANGUAGE plpgsql

CREATE TRIGGER trigger_club
  AFTER UPDATE
  ON club
  FOR EACH ROW
  EXECUTE PROCEDURE create_club();
