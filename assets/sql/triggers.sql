CREATE OR REPLACE FUNCTION create_club()
  RETURNS trigger AS
$BODY$
	BEGIN

	INSERT INTO club_info (id_club) values (new.id_club);
  INSERT INTO club_facilities(id_club) values (new.id_club);
  INSERT INTO club_finances(id_club) values(new.id_club);
  INSERT INTO club_supporters(id_club) values(new.id_club);
  INSERT INTO club_stadium(id_club) values(new.id_club);
  INSERT INTO club_finances(id_club) values(new.id_club);
	RETURN NEW;
	END;
$BODY$
  LANGUAGE plpgsql;
