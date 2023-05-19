import random
from datetime import date, timedelta
import mysql.connector
#####################################################################################
###############non si usa

#
#
#
#
#
#TODO: NON USARE

#
#
#

# Connessione al database
db = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="4money"
)
cursor = db.cursor()

# Genera utenti casuali
def generate_random_user():
    username = "user" + str(random.randint(1, 1000))  # Genera un nome utente casuale
    name = "Nome" + str(random.randint(1, 1000))  # Genera un nome casuale
    surname = "Cognome" + str(random.randint(1, 1000))  # Genera un cognome casuale
    gender = random.randint(0, 1)  # Genera un sesso casuale (0 o 1)
    nationalities = [
        'Paraguay', 'Perù', 'Polinesia Francese', 'Polonia', 'Porto Rico', 'Portogallo', 'Qatar',
        'RD del Congo', 'Regno Unito', 'Rep. Ceca', 'Rep. Centrafricana', 'Rep. del Congo',
        'Rep. Dominicana', 'Riunione', 'Romania', 'Ruanda', 'Russia', 'S', 'Sahara Occidentale',
        'Saint Kitts e Nevis', 'Saint Vincent e Grenadine', 'Saint-Barth', 'Saint-Martin',
        'Saint-Pierre e Miquelon', 'Samoa', 'Samoa Americane', 'San Marino', "Sant'Elena",
        'Santa Lucia', 'Senegal', 'Serbia', 'Seychelles', 'Sierra Leone', 'Singapore',
        'Sint Maarten', 'Siria', 'Slovacchia', 'Slovenia', 'Somalia', 'Spagna', 'Sri Lanka',
        'Stati Uniti', 'Sudafrica', 'Sudan', 'Sudan del Sud', 'Suriname', 'Svalbard e Jan Mayen',
        'Svezia', 'Svizzera', 'Swaziland', 'Tagikistan', 'Taiwan', 'Tanzania',
        'Terre australi e antartiche francesi', "Territorio britannico dell'oceano Indiano",
        'Thailandia', 'Timor Est', 'Togo', 'Tokelau', 'Tonga', 'Trinidad e Tobago', 'Tunisia',
        'Turchia', 'Turkmenistan', 'Turks e Caicos', 'Tuvalu', 'Ucraina', 'Uganda', 'Ungheria',
        'Uruguay', 'Uzbekistan', 'Vanuatu', 'Venezuela', 'Vietnam', 'Wallis e Futuna', 'Yemen', 'Zambia'
    ]
    nationality = random.choice(nationalities)  # Genera una nazionalità casuale
    birth_date = date.today() - timedelta(days=random.randint(365 * 18, 365 * 60))  # Genera una data di nascita casuale per età tra 18 e 60 anni
    email = username + "@example.com"  # Genera un indirizzo email basato sul nome utente
    password = "Ciao1234!"  # Genera una password predefinita
    profile_picture = "./assets/img/avatars/icons8-anime-sama.svg"  # Percorso dell'immagine del profilo

    return (username, name, surname, gender, nationality, birth_date, email, password, profile_picture)


# Inserisci utente nel database
def insert_user(user):
    sql = "INSERT INTO utente (username, nome, cognome, sesso, nazionalita, dataN, email, password, pfp) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)"
    cursor.execute(sql, user)
    db.commit()
    print("Utente inserito correttamente!")


# Genera e inserisci 10 utenti casuali nel database
for _ in range(100):
    user = generate_random_user()
    insert_user(user)

# Chiudi la connessione al database
db.close()
