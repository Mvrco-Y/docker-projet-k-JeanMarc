# Band Names Generator

## Table des matières
- [Lancer le projet](#lancer-le-projet)
- [Relancer les conteneurs après un redémarrage](#relancer-les-conteneurs-après-un-redémarrage)
- [Construire l’image pour la production](#construire-limage-pour-la-production)
- [Gestion des environnements](#gestion-des-environnements)
- [Liens utiles](#liens-utiles)
- [Remarques](#remarques)
- [Sources du projet](#sources-du-projet)

---

## Lancer le projet

### 1. Environnement de développement

#### Linux / WSL / Ubuntu
Placez-vous dans le dossier racine du projet (là où se trouve `docker-compose.yml`) et lancez :

```bash
# Construire les images et démarrer les conteneurs
docker compose up --build
Windows PowerShell / CMD
Placez-vous dans le dossier racine du projet et lancez :

powershell
Copier le code
docker compose up --build
Les services accessibles :

Application web : http://localhost:8085

PhpMyAdmin : http://localhost:8086

Pour arrêter les conteneurs :

bash
Copier le code
docker compose down
Si vous voulez supprimer les volumes et repartir de zéro :

bash
Copier le code
docker compose down -v
Relancer les conteneurs après un redémarrage
Lorsque vous redémarrez votre machine, les conteneurs Docker arrêtés ne disparaissent pas (sauf si vous avez supprimé les volumes ou les conteneurs).

Pour vérifier les conteneurs existants :
docker ps -a

Pour relancer votre projet sans reconstruire les images :
docker compose start


Pour voir les logs et s’assurer que tout fonctionne :
docker compose logs -f
Construire l’image pour la production

Pour créer l’image du service web prête pour la production, nommée bandnamesgenerator:1.0.0 :
docker build -t bandnamesgenerator:1.0.0 -f Dockerfile .


Liens utiles
Docker

Docker Compose https://www.docker.com/

PHP Official Docs

PhpMyAdmin

Remarques
L’application utilise PHP 8.2 FPM et MySQL 8.0.

Les tables de la base sont créées automatiquement via data.sql.

Difficultés rencontrées : initialisation de la base MySQL, permissions et gestion des Dockerfile multiples.

Les erreurs liées aux extensions PHP (gd.so, zip.so) ne bloquent pas le fonctionnement principal.

Sources du projet
Dockerfile (service web)

Dockerfile.mysql (service base de données)

docker-compose.yml

.env (configuration des variables d’environnement)

data.sql (initialisation de la base de données)

Sources PHP (index.php et autres fichiers contenus dans /app/php)