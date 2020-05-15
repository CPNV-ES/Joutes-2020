# Documentation technique
Ce document centralise des informations techniques utiles aux développeurs de l'application.
## Définitions
### Poule
Groupe d'équipes qui vont s'affronter dans des matches jusqu'à obtention d'un classement final.
Une poule est dans l'un des quatre états suivants:
1. Préparation: on est en train de définir ses participants, horaires, matches, etc...
2. Prête: on peut la visualiser mais sans rien modifier
3. En cours: on peut introduire des résultats de match
4. Terminée: on peut la visualiser mais sans rien modifier, le classement est définitif
### Participants à une poule
Il faut distinguer deux types de participants:
1. **Concret** : une des équipes inscrites au tournoi, dont on peut afficher le nom dans le planning des matches et le classement
2. **Abstrait** : une équipe qui ne sera identifiée que quand le classement des poules de la phase précédente sera définitif. Exemple: une poule de quatre équipes en phase 2 regroupe le premier et le deuxième de deux poules de la phase 1
Les participants d'une poule sont définis par la table `contenders`, qui est définie comme suit:
```
id,int(10) unsigned,NOT NULL
pool_id,int(10) unsigned,NOT NULL
team_id,int(10) unsigned,NULL
pool_from_id,int(10) unsigned,NULL
rank_in_pool,int(11),NULL
``` 
mode_id,int(10)
- `pool_id` est la clé étrangère qui place le participant dans une poule
- Si le participant est abstrait, alors:
  - `team_id` est nul
  - `pool_from_id` identifie la poule de la phase précédente d'où viendra le participant concret
  - `rank_in_pool` dit le combien-tième du classement de cette poule sera le participant concret
- Si le participant est concret, il est identifié par `team_id` 

Exemples:
1. `id`=19, `pool_id`=4, `team_id`=82  => Le participant 19 est concret (équipe 82), il est inscrit à la poule 4
2. `id`=122, `pool_id`=12, `team_id`=null, `pool_from_id`=4, `rank_in_pool=2`  => Le participant 122 est abstrait, ce sera le 2ème du classement de la poule 4
3. `id`=122, `pool_id`=12, `team_id`=82, `pool_from_id`=4, `rank_in_pool=2`  => Quelque temps plus tard, le participant 122 est devenu concret, c'est l'équipe 82, qui s'est classée 2ème de la poule 4

