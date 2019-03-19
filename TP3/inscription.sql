CREATE OR REPLACE FUNCTION inscription(
 nomPar VARCHAR, 
 prenomPar VARCHAR,
 adressePar VARCHAR,
 cpPar CHAR,
 villePar VARCHAR,
 paysPar VARCHAR)

RETURNS integer AS $$
DECLARE 
	code_client integer;
BEGIN
    SELECT code INTO code_client FROM clients WHERE nom = nomPar
    		AND prenom = prenomPar AND adresse = adressePar;
    IF FOUND THEN code_client := 0;
    ELSE
       INSERT INTO clients (nom, prenom, adresse, cp, ville, pays)
          VALUES (DEFAULT, nomPar, prenomPar, adressePar,cpPar, villePar, paysPar)
          RETURNING code INTO code_client;
    END IF;
    RETURN code_client;

END;
$$ LANGUAGE plpgsql;

