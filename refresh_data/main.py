import requests
import zipfile
import os

if os.path.isfile('PrixCarburants_quotidien_20211206.xml'):
    print("Le fichier existe déjà !")

    exit(0)
else:
    r = requests.get('https://donnees.roulez-eco.fr/opendata/jour', allow_redirects=True)

    open('PrixCarburants_quotidien_20211206.zip', 'wb').write(r.content)

    with zipfile.ZipFile('PrixCarburants_quotidien_20211206.zip', 'r') as zip_ref:
        zip_ref.extractall('C:/Users/pierreb/PycharmProjects/prix_essence')

    os.remove('PrixCarburants_quotidien_20211206.zip')
    os.rename('PrixCarburants_quotidien_20211206.xml', 'C:/Users/pierreb/PycharmProjects/prix_essence/prix.xml')


print("Fin du programme, les données ont été actualisés / récupérées")