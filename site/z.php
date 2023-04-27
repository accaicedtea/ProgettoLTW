SELECT s.id as id, s.utente as utente, s.data as data, s.descrizione as descrizione, c.nome as categoria,s.importo as importo 
    FROM spesa s join categoria c on c.id=s.categoria
    WHERE s.utente = '$username' and YEAR(s.data) = YEAR('$data_oggi') and Month(s.data) < Month('$data_oggi')
    UNION
    SELECT s.id as id, s.utente as utente, s.data as data, s.descrizione as descrizione, c.nome as categoria,s.importo as importo 
    FROM spesa s join categoria c on c.id=s.categoria 
    WHERE s.utente = '$username' and Year(s.data) = YEAR('$data_oggi') and MONTH(s.data) = MONTH('$data_oggi') and DAY(s.data) <= DAY('$data_oggi')
    union
    SELECT s.id as id, s.utente as utente, s.data as data, s.descrizione as descrizione, c.nome as categoria,s.importo as importo 
    FROM spesa s join categoria c on c.id=s.categoria 
    WHERE s.utente = '$username' and YEAR(s.data) < YEAR('$data_oggi')