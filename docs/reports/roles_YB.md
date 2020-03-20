Prise en charge le 31.10.2019, par Yvann Butticaz

# Analyse du problème
    Gestion des rôles utilisateurs inexistante sur l'application.

## Fonctionnement actuel
    Tout utilisateur classique a le droit de participant. Pour les droit plus élevés, des commandes custom artisan sont utilisées.
    Aucune table de rôle n'est présente dans la base de donnée

## Description du problème
    Une page d'administration des rôles est nécessaire pour une meilleure gestion des roles.

## Description de la solution
- Ajouter une table rôle dans la base de donnée 
- Modifier les commandes artisan custom pour correspondre avec la table roles
- Ajouter une page d'administration générale sur lequel se trouvera un lien à la page d'administration des rôles
- Sur la page d'administration des rôles, implémenter un CRUD.


# Plan d'intervention


1. _(Terminé, le 4 octobre)_ Implementation d'une table role dans la DB.

2. _(Terminé, le 31 octobre)_ Modification des commandes custom artisan pour correspondre avec la base de donnée, utlisation d'eloquent.

3. _(Terminé, le 31 octobre)_ Ajout d'un bouton "Administration" dans le menu. 

4. _(Terminé, le 31 octobre)_ Ajout des routes pour l'administration et la gestion des roles.

5. _(Terminé, le 31 octobre)_ Ajout du controller "AdministrationController".

6. _(Terminé, le 7 Novembre)_ Ajout dans la page d'administration d'un lien à la page de gestion des rôles.

7. _(Terminé, le 12 Novembre)_ Ajout du controller "RoleController" et de la page des roles.

8. _(Terminé, le 26 Novembre)_ Implémentation du crud dans la page des roles :
    - Affichage des données "role" dans le tableau
    - Ajout de roles
    - Modification de roles
    - Suppression de roles 

# Tests

(Terminés, le ...)

# Commit / Merge

(Fait, le 26 Novembre) Commit sur la branche Yvann

# Revue de code

(Effectuée, le ...)

# Documentation

(Mise à jour, le ...)