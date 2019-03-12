CREATE OR REPLACE FUNCTION inscript(
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
    SELECT code INTO STRICT code_client FROM clients WHERE nom = nomPar 
    		AND prenom = prenomPar AND adresse = adressePar AND
    		cp = cpPar AND ville = villePar AND pays = paysPar;
    EXCEPTION
        WHEN NO_DATA_FOUND THEN
             INSERT INTO clients (nom, prenom, adresse, cp, ville, pays)
             		VALUES (nomPar, prenomPar, adressePar,cpPar, villePar, paysPar)
             		RETURNING code INTO code_client;
             RETURN code_client;
    RETURN 0;
END;
$$ LANGUAGE plpgsql;

