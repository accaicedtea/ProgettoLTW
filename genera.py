import random
from datetime import date, timedelta
import mysql.connector

# Connessione al database
db = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="4money"
)

cursor = db.cursor()

# Elenca gli utenti presenti nel database
cursor.execute("SELECT username FROM utente where username!='accaicedtea'")
users = cursor.fetchall()
users = [user[0] for user in users]

# Ottieni l'ultimo ID delle spese presenti nel database
cursor.execute("SELECT MAX(id) FROM spesa")
result = cursor.fetchone()
last_id = result[0] if result[0] else 0

# Genera spese casuali per gli utenti
for user in users:
    num_expenses = random.randint(1, 50)  # Numero casuale di spese per ogni utente
    
    for _ in range(num_expenses):
        last_id += 1  # Incrementa l'ID
        
        expense_amount = round(random.uniform(10.0, 1000.0), 2)  # Importo casuale tra 10 e 100
        expense_amount = expense_amount*-1
        #expense_date = date.today() - timedelta(days=random.randint(1, 120))  # Data casuale negli ultimi 30 giorni
        expense_date = date.today() + timedelta(days=random.randint(1, 30)) # date future da oggi a 30 g avvenire
        expense_description = "Spesa casuale"  # Descrizione della spesa
        expense_category = random.randint(0, 6)  # Categoria casuale da 1 a 5
        
        # Inserisci la spesa nel database
        insert_query = "INSERT INTO spesa (id, utente, importo, data, descrizione, categoria) VALUES (%s, %s, %s, %s, %s, %s)"
        insert_values = (last_id, user, expense_amount, expense_date, expense_description, expense_category)
        cursor.execute(insert_query, insert_values)

db.commit()
db.close()
