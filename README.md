
## Table des matières
- [Lancer le projet](#lancer-le-projet)
- [Relancer les conteneurs après un redémarrage](#relancer-les-conteneurs-après-un-redémarrage)
- [Construire l’image pour la production](#construire-limage-pour-la-production)
- [Liens utiles](#liens-utiles)
- [Remarques](#remarques)
- [Sources du projet](#sources-du-projet)

---

## Lancer le projet

### 1. Environnement de développement

#### Linux / WSL / Ubuntu

Placez-vous dans le dossier racine du projet (là où se trouve `docker-compose.yml`) et lancez :

```bash
docker compose up --build
````

#### Windows PowerShell / CMD

Placez-vous dans le dossier racine du projet et exécutez :

```powershell
docker compose up --build
```

Services accessibles :

* Application web : [http://localhost:8085](http://localhost:8085)
* PhpMyAdmin : [http://localhost:8086](http://localhost:8086)

Arrêter les conteneurs :

```bash
docker compose down
```

Réinitialiser complètement (volumes supprimés) :

```bash
docker compose down -v
```

---

## Relancer les conteneurs après un redémarrage

Les conteneurs Docker ne disparaissent pas après un redémarrage.

Afficher les conteneurs existants :

```bash
docker ps -a
```

Les relancer sans reconstruire :

```bash
docker compose start
```

Voir les logs :

```bash
docker compose logs -f
```

---

## Construire l’image pour la production

Si tu souhaites créer **une image unique du service web** prête pour la production, nommée `bandnamesgenerator:1.0.0` :

> ⚠️ **Important :** cette image ne contient que l’application web.  
> Pour que l’application fonctionne correctement, la **base de données MySQL** doit être accessible via un autre conteneur ou serveur.

Le **Dockerfile de l’application** se trouve dans : **app/php/**.

Pour créer l’image de production :

```bash
docker build -t bandnamesgenerator:1.0.0 -f app/php/Dockerfile .
```

---

## Liens utiles

* docker-watch : [https://docs.docker.com/compose/how-tos/file-watch/](https://docs.docker.com/compose/how-tos/file-watch/)

* Docker : [https://docs.docker.com/](https://docs.docker.com/)

---

## Remarques

### ❗ 1. Pourquoi nous n’avons pas utilisé un bind-mount

Un bind-mount (`./app/php:/var/www/html`) aurait permis un rechargement automatique,
mais ce projet utilisait **docker-watch** pour surveiller les fichiers PHP et relancer FPM(**FastCGI Process Manager** une façon plus rapide, stable et optimisée de faire fonctionner PHP, idéale en Docker) automatiquement.

Cela présente deux implications :

#### ✔ Avantages

* Isolation complète entre l’hôte et le conteneur
* Comportement plus proche d’une production réelle
* Aucun fichier sensible exposé directement depuis la machine

#### ❗ Inconvénients

* Impossible d’utiliser un bind-mount simple
  → le code devait être *copié* dans l’image à chaque build
  → ce qui nécessite un Dockerfile dédié côté PHP

### ❗ 2. Obligation de créer un Dockerfile MySQL

Comme nous n’avions plus de bind-mount pour injecter automatiquement `data.sql` :

* MySQL avait besoin d’un Dockerfile personnalisé (`Dockerfile.mysql`)
* Cela permet d’intégrer le script d'initialisation directement dans l’image MySQL

Sans cela :

* le script SQL n’était pas exécuté au bon moment
* la base restait vide
* certains conteneurs entraient en boucle de restart

### 💡 3. Autres remarques pertinentes

* L’extension `pdo_mysql` doit être activée dans l’image PHP.
* Le port `8085` a été choisi pour éviter les conflits avec Apache installé localement.
* En production, remplacer `docker-watch` par un serveur dédié type :

  * Nginx + PHP-FPM
  * Supervisor pour gérer les processus

---

## Sources du projet

* Dockerfile PHP (images officielles) :
  [https://hub.docker.com/_/php](https://hub.docker.com/_/php)

* Dockerfile MySQL (images officielles) :
  [https://hub.docker.com/_/mysql](https://hub.docker.com/_/mysql)

* Docker Compose : [https://docs.docker.com/compose/](https://docs.docker.com/compose/)

```

