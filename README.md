# Lisez-moi

Pour configurer la connexion à la base de données :

- copier le fichier `config.exemple.php` dans un fichier `config.php`, toujours dans le dossier `lib/`
- remplisser les valeurs du tableau comme indiqué dans les commentaires.

Le fichier `config.php` est volontairement ignoré par GIT, de façon à ce que chacun dispose de ses propres configurations, sans risques d'effacement.

Le fichier SQL à importer se trouve dans le dossier du même nom. Ne pas oublier de faire des exports de temps à autres.

## Changements

### 22/11/2017

Pour tester que la connexion à la base de données fonctionne : pointer le navigateur vers le fichier `index.php`. Voici ce qu'il y aura, à peu près, à l'écran :

```
/home/vagrant/Ue219-Groupe1/index.php:12:
array (size=3)
  'id' => string '1' (length=1)
  'identifiant' => string 'Administrateur' (length=14)
  'motdepasse' => string '83CCutv8' (length=8)
Coucou Monde
```