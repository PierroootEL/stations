import os
import requests
import time
import zipfile
import datetime
import json
import xmltodict

class refresh_data:
    def __init__(self):
        self.path = 'C:/Users/Pierre/Documents/stations/refresh_data/'
        self.date = datetime.datetime.now() - datetime.timedelta(days=1)

    def mainIsXmlFileAlreadyExists(self):
        if os.path.isfile('data.xml'):
            print("Le fichier XML existe déjà ! Suppression en cours \n")

            os.remove(self.path + 'data.xml')

        if os.path.isfile('data.json'):
            print("Le fichier JSON existe déjà ! Suppression en cours \n")

            os.remove(self.path + 'data.json')

            return True
        elif os.path.isfile('prix.xml') == False:
            print("Aucun fichier de présent le téléchargement peut commencer \n")

            return True
        else:
            print("Erreur, le fichier ne peut pas être reconnu, arrêt du programme \n")

            exit(1)

    def mainDownloadData(self):
        print("Démarrage du téléchargement \n")
        if requests.get('https://donnees.roulez-eco.fr/opendata/jour', allow_redirects=True):
            self.data = requests.get('https://donnees.roulez-eco.fr/opendata/jour', allow_redirects=True)

            print("Données téléchargé avec succès \n")

            return True
        else:
            print("Erreur de téléchargement du fichier \n")

            exit(2)

    def mainOpenFile(self):
        if open(self.path + 'PrixCarburants_quotidien_' + self.date.strftime("%Y") + self.date.strftime("%m") + self.date.strftime("%d") + '.zip', 'wb').write(self.data.content):
            return True
        else:
            print("Impossible d'ouvrir et d'écrire dans le fichier ! \n")

            exit(3)

    def mainUnzipFile(self):
        print("Début dézippage du fichier \n")
        with zipfile.ZipFile(
                self.path + 'PrixCarburants_quotidien_' + self.date.strftime("%Y") + self.date.strftime("%m") + self.date.strftime("%d") + '.zip',
                'r') as zip_ref:
            zip_ref.extractall(self.path)
        print("Le fichier à bien été dézippé ! \n")

    def mainDeleteCompressedData(self):
        print("Suppression du fichier ZIP \n")
        if os.remove(self.path + 'PrixCarburants_quotidien_' + self.date.strftime("%Y") + self.date.strftime("%m") + self.date.strftime("%d") + '.zip'):
            print("Le fichier n'a pas pu être supprimé ! \n")

            exit(4)
        else:
            print("Le fichier a bien été supprimé ! \n")

    def mainRenameXmlData(self):
        print("Renommage du fichier XML en cours \n")
        if os.rename(self.path + 'PrixCarburants_quotidien_' + self.date.strftime("%Y") + self.date.strftime("%m") + self.date.strftime("%d") + '.xml', self.path + 'data.xml'):
            print("Erreur, impossible de renommé le fichier XML ! \n")

            exit(5)
        else:
            print("Fichier XML renommé avec succès \n")

    def mainDataLog(self):
        if os.path.isfile(self.path + 'log.json'):
            os.remove(self.path + 'log.json')

            print("Fichier de log supprimé avec succès !")

        log = self.date.strftime("%Y") + ':' + self.date.strftime("%m") + ':' + self.date.strftime("%d") + '_' + self.date.strftime("%H") + ':' + self.date.strftime("%M") + ':' + self.date.strftime("%S")

        json_data = json.dumps(log)

        with open(self.path + "log.json", "w") as json_file:
            json_file.write(json_data)

            json_file.close()

    def mainXmltoJson(self):
        print("Début de la conversion du XML en JSON \n")
        with open(self.path + "data.xml") as xml_file:
            data_dict = xmltodict.parse(xml_file.read())
        xml_file.close()

        json_data = json.dumps(data_dict)

        with open(self.path + "data.json", "w") as json_file:
            json_file.write(json_data)

            json_file.close()

        print("Conversion terminée avec succès \n")
