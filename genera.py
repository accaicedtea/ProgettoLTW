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
cursor.execute("SELECT username FROM utente")
users = cursor.fetchall()
users = [user[0] for user in users]

# Genera spese casuali per gli utenti
for user in users:
    num_expenses = random.randint(1, 5)  # Numero casuale di spese per ogni utente
    
    for _ in range(num_expenses):
        expense_id = random.randint(1, 1000)  # ID casuale della spesa
        expense_amount = round(random.uniform(10.0, 100.0), 2)  # Importo casuale tra 10 e 100
        expense_date = date.today() - timedelta(days=random.randint(1, 30))  # Data casuale negli ultimi 30 giorni
        expense_description = "Spesa casuale"  # Descrizione della spesa
        expense_category = random.randint(1, 5)  # Categoria casuale da 1 a 5
        
        # Inserisci la spesa nel database
        insert_query = "INSERT INTO spesa (id, utente, importo, data, descrizione, categoria) VALUES (%s, %s, %s, %s, %s, %s)"
        insert_values = (expense_id, user, expense_amount, expense_date, expense_description, expense_category)
        cursor.execute(insert_query, insert_values)

db.commit()
db.close()
