##NOTICE

En cas d'erreur d'affichage de la barre de navigation et des liens du menu de gauche, modifier le fichier `navbar.php` : 
les valeurs 2, 3 et 4 des lignes 2, 4 et 6 correspondents a un url de la forme `localhost/HAKA/`. S'il y a plus de `/`, augmenter ces valeurs.


## PROJET PROGRAMMATION WEB

### Introduction

Le projet de programmation web doit être réalisé par groupes de 4 personnes. Il a pour but de vous
faire développer une application web utilisant l’architecture page générées - client léger.
Voici la liste des technologies qui sont autorisées dans le projet :

- HTML
- CSS
- MySQL
- PHP
- JavaScript

### Sujet

Le projet a pour but de développer une application de gestion de dettes et créances de type
Splitwise. Cette application se nommera Debster.

### Fonctionnalités

#### Inscription des utilisateurs

Un utilisateur doit pouvoir s’inscrire sur le serveur. Les informations qui sont fournies en cas
d’inscription sont :
- email (unique dans la base)
- mot de passe
- nom
- prénom
- âge
- pseudo

#### Authentification

Pour s’authentifier il faut fournir son adresse mail et son mot de passe. Une authentification est
valable pour une durée maximale d’une heure. Un utilisateur peut se déconnecter.

#### Carnet des amis

Les amis sont les personnes avec lesquelles un utilisateur donné peut contracter des dettes ou des
créances. Un utilisateur peut consulter la liste de ses amis sur Debster et afficher le solde de
comptes avec chacun (incluant les dépenses de groupe, décrit dans la section « Groupes »). Il est
également possible d’accéder aux transactions qui constituent le solde et les modifier. L’utilisateur
peut bien entendu à tout moment ajouter un ami dans sa liste, via son adresse email. Il est possible
aussi de supprimer un ami de sa liste.

#### Éditer les dettes/créances

Un utilisateur peut consulter la liste de ses dettes et créances dans lesquelles il intervient en tant
que source ou cible. Il peut aussi consulter son encours (somme des dettes et créances) qui inclut
aussi les dépenses de groupe (décrit dans la section « Groupes ») . Une dette à la structure suivante :
- Utilisateur source
- Montant > 0 en euros
- Utilisateur cible
- Message explicatif
- Date de création
- Statut
  - Ouvert
  - Remboursée
  - Annulée
- Date de fermeture
- Message de fermeture

Une dette se lit de la manière suivante : utilisateur source doit montant à utilisateur cible.

Il doit être possible :
- d’ajouter une dette ou une créance avec un de ses amis
- d’éditer le montant, le destinataire et le message explicatif d’une dette/créance ouverte
- de fermer un dette/créance en cours, par annulation ou remboursement. Dans ce cas
l’utilisateur doit saisir un message de fermeture.

La liste des dettes d’un utilisateur doit afficher seulement les dettes ouvertes par défaut.
Néanmoins il doit être aussi possible d’afficher aussi la liste des dettes fermées.

#### Groupes

Un utilisateur peut créer de groups qui correspondent à un voyage/une sortie ou autres et qui
permettent de saisir de dépenses pour plusieurs personnes.
Un groupe à la structure suivante :
- Nom
- Description
- Participants

#### Gestion du groupe

L’utilisateur peut choisir les personnes faisant partie du group en les sélectionnant de son carnet
d’amis ou en tapant un pseudo.
Il est possible d’ajouter davantage de participants de groupe à tout moment. Il est possible de
supprimer une personne du groupe seulement si elle n’est pas concernée par de transactions du
groupe (pas de dettes ou créances).

#### Saisie de dépenses

Une dépense a une structure suivante :
- Titre
- Montant > 0 en euros
- Date de création
- Créancier
- Débiteurs

Le créancier est choisi parmi la liste de personnes faisant partie du group donnée (c’est possible de
saisir une dépense couverte par quelqu’un d’autre), également pour les débiteurs.

Il y’a deux mode de la saisie de la créance :
- une répartition égale du montant à tout les débiteurs,
- une répartition manuelle (un montant pour chaque débiteur est saisi séparément).

#### Liste de dépenses

Une liste de tout les dépenses du group peut être affiché avec les éléments suivants : titre, montant,
créancier. C’est possible d’accéder aux détails de chaque dépense pour voir les débiteurs et leur
montants correspondants. L’utilisateur peut bien entendu à tout moment éditer les dépenses
existantes.

#### Encours du groupe

Il est possible d’afficher encours du groupe qui liste tout ses participants et ses sommes
due/créances.

#### Transactions optimisées

Dans un groupe de plusieurs personnes ça peut arriver que chacun doit un montant à quelqu’un
d’autre. Afin d’optimiser les transactions nécessaires pour régler l’encours du groupe l’application
traites toutes les dépenses et propose une liste de transactions minimale.

#### Partage du groupe

Il est possible de générer un lien qui permet de partager le groupe. Lors de l’ouverture de ce lien,
l’utilisateur choisi le surnom parmi la liste de personnes faisant partie du groupe ou si il n’est pas
dedans il peut taper un nouveau surnom.

### Contraintes

- Bien entendu l’application doivent être robustes à la saisie d’information erronées (mail
dans un format non valide, montant non numérique, etc...).
- Des messages d’erreurs clairs doivent être affichés en cas de problème avec l’application.
- L’application doit être sécurisée. Il ne doit pas être possible d’accéder aux informations d’un
utilisateur sans avoir rentré au moins une fois son mail et mot de passe. Il ne faut non plus
qu’un utilisateur puisse rajouter ou voir une dette qui ne le concerne pas.

### Déploiement

Un script doit permettre de déployer l’application sur un serveur comportant Apache, PHP et
MySQL. En outre le script de déploiement doit automatiquement :
- créer toutes les tables nécessaires à l’application
- insérer certains informations dans la base (spécification séparée)
Le script de déploiement doit être configuré pour se connecter sur un serveur MySQL à l’adresse
localhost avec un login de root et pas de password. Il doit impérativement se trouver à la racine du
projet et se nommer : install.php.
