import requests
import zipfile
import datetime
import time
import os

export = 'C:/Users/pierreb/Documents/stations/refresh_data/' # A changer en fonction du chemin d'accès

x = datetime.datetime.now() - datetime.timedelta(days=1)

if os.path.isfile('prix.xml'):
    print("Le fichier existe déjà ! Suppression en cours \n")

    os.remove('prix.xml')

    time.sleep(2)

print("Téléchargement des données en cours \n")

r = requests.get('https://donnees.roulez-eco.fr/opendata/jour', allow_redirects=True)

print("Données téléchargées avec succès \n")

time.sleep(2)

print("Ouverture du fichier en cours ! \n")

open('PrixCarburants_quotidien_' + x.strftime("%Y") + x.strftime("%m") + x.strftime("%d") + '.zip', 'wb').write(r.content)

time.sleep(2)

print("Dézippage du fichier en cours ! \n")

with zipfile.ZipFile('PrixCarburants_quotidien_' + x.strftime("%Y") + x.strftime("%m") + x.strftime("%d") + '.zip', 'r') as zip_ref:
        zip_ref.extractall(export)

time.sleep(2)

print("Dézippage terminé avec succès \n")

print("Suppresion du fichier ZIP ( gains de place ) en cours \n")

time.sleep(2)

os.remove('PrixCarburants_quotidien_' + x.strftime("%Y") + x.strftime("%m") + x.strftime("%d") + '.zip')

print("Fichier ZIP supprimé ! \n")

print("Renomme des données .xml en prix.xml \n")

time.sleep(2)

os.rename('PrixCarburants_quotidien_' + x.strftime("%Y") + x.strftime("%m") + x.strftime("%d") + '.xml', export + 'prix.xml')

time.sleep(1)

print("Fin de la récupération des données, tout est OK \n")

print("Fin du programme, les données ont été actualisés / récupérées")