import requests
import zipfile
import datetime
import time
import os

export = 'C:/Users/pierreb/Documents/stations/refresh_data/' # A changer en fonction du chemin d'accès

x = datetime.datetime.now() - datetime.timedelta(days=1)

if os.path.isfile('prix.xml'):
    print("Le fichier existe déjà ! Suppression en cours")

    os.remove('prix.xml')

    time.sleep(2)


r = requests.get('https://donnees.roulez-eco.fr/opendata/jour', allow_redirects=True)

open('PrixCarburants_quotidien_' + x.strftime("%Y") + x.strftime("%m") + x.strftime("%d") + '.zip', 'wb').write(r.content)

with zipfile.ZipFile('PrixCarburants_quotidien_' + x.strftime("%Y") + x.strftime("%m") + x.strftime("%d") + '.zip', 'r') as zip_ref:
        zip_ref.extractall(export)

os.remove('PrixCarburants_quotidien_' + x.strftime("%Y") + x.strftime("%m") + x.strftime("%d") + '.zip')
os.rename('PrixCarburants_quotidien_' + x.strftime("%Y") + x.strftime("%m") + x.strftime("%d") + '.xml', export + 'prix.xml')

print("Fin du programme, les données ont été actualisés / récupérées")