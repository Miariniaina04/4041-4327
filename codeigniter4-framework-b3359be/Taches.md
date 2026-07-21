# Tâches - Projet Mobile Money

**Binôme :** [Vos Noms Ici]  

## Version 1 (v1)

### Étudiant 1 : [ETU4327]

> Pages d'operation (depots,retraits,transfert)  (Operateur/Operation) : 
- [x] Modele : 
  - [x] Fonctions :
    - [x] FraisBaremesModele : getByOperationType
    - [x] PrefixesModele : getActifs

- [x] Controllers : 
  - [x] OperationControllers :
    - [x] Fonctions : 
      - [x] index
      - [x] show
      - [x] CRUD 
  
- [x] CRUD pour les types d'opérations et barèmes de frais (Operateur/config.php) : 
  - [x]  Tableau Frais de depots
    - [x] CRUD   
  - [x]  Tableau Frais de retraits 
    - [x] CRUD  
  - [x]  Tableau Frais de Transferts
    - [x] CRUD  
  
- [x] Calcul automatique des frais selon les tranches de montant : 
  - [x] Fonctions :
    - [x] calcul_Depot : Numero 1 -> Numero 1 (Aucun Frais)
    - [x] calcul_Retrait : Numero 1 <- Numero 1 (Avec Frais) 
    - [x] calcul_Transfert : Numero 1 -> Numero 2 (Avec Frais)
    - [x] calcul_Retrait_Transfert : Numero 1 <=> Numero 2 (Avec Frais)
  
- [x] Tableau de bord opérateur (gains, situation des comptes clients)  (auth/Gain) :
  - [x]  Tableau de Bord Gains pour chaque types (Tansfert et Retrait)
  - [x]  Situation Clients

### Étudiant 2 : [ETU4041]

- [x]  Creation de Github de notre projet

- [x] Configuration Sqlite et Codeigniter 3
  - [x] Database.php (Configuration sqlite)

- [x] Création de la base de données (`base.sql`) : tables `prefixes`, `operation_types`, `frais_barèmes`, `comptes`, `transactions`
  - [x] Creation du `prefixes`
  - [x] Creation du  `operation_types`
  - [x] Creation du `frais_barèmes`
  - [x] Creation du `comptes`
  - [x] Creation du `transactions`
  
- [x] Insertion dans sqlite3 

- [x] Mise en place des modèles (Models) pour toutes les entités
  - [x] PrefixesModele
  - [x] OperationTypesModele
  - [x] FraisBaremesModele
  - [x] ComptesModele
  - [x] TransactionsModele

- [ ] Interface de login automatique client (numéro de téléphone)  (home/Login):
  - [x] Fonction login() 
  - [ ] Message d'auth 
  - [x] Page Login 
  - [x] Création automatique de compte si inexistant
- [ ] Opérations client :
  - [x] Voir solde
  - [x] Dépôt (simulation)
  - [x] Retrait (avec frais)
  - [x] Transfert vers autre numéro (avec frais)
- [x] Historique des transactions pour le client
- [x] Design Bootstrap + responsive (frontend global)

### Tâches communes
- [x] Configuration des routes dans CodeIgniter
- [x] Mise en place de l'authentification simple (session par numéro)
- [ ] Validation des numéros selon préfixes
- [ ] Tests fonctionnels complets
- [x] Mise à jour de `base.sql` avec données de test (sauf pour transaction)
- [ ] Documentation dans README.md (instructions d'installation)
- [x] Commit + Tag `v1`

## Version 2 (v2)

**Date de livraison :** [Mettre la date] - Tag : v2

### Étudiant 1 : [Nom]
- [ ] Configuration des préfixes pour les autres opérateurs (032, 031, etc.)
  - [x] fonction
- [ ] Ajout du champ `commission_pourcentage` dans les préfixes ou une nouvelle table
- [ ] Gestion des transferts inter-opérateurs avec commission supplémentaire
- [ ] Mise à jour du calcul des frais pour transferts vers autres opérateurs
- [ ] Page "Situation gain" : séparation Opérateur principal vs Autres opérateurs
- [ ] Situation des montants à envoyer à chaque opérateur (reporting)

### Étudiant 2 : [Nom]
- [ ] Option "inclure frais de retrait" lors de l'envoi (transfert)
- [ ] Envoi multiple vers plusieurs numéros (diviser le montant équitablement)
- [ ] Mise à jour du formulaire de transfert pour supporter plusieurs destinataires
- [ ] Amélioration de l'interface client (Bootstrap)

- [ ] css :
  - [ ] operation/client
  - [ ] operation/client/dashboard
  - [ ] operatioin/client/situation
  - [ ] 
### Tâches communes
- [ ] Mise à jour de `base.sql` (nouvelles colonnes / tables si nécessaire)
- [ ] Modification des modèles (CompteModel, FraisBaremeModel, etc.)
- [ ] Mise à jour des contrôleurs pour les nouvelles fonctionnalités
- [ ] Tests des transferts inter-opérateurs et envoi multiple
- [ ] Mise à jour du tableau de bord opérateur
- [x] Commit + création du Tag `v2`

**Statut Version 2 :** En cours 

## envoye tags step
```
 git tag -a nom_tag -m "message tag"
 git tag

```

## promotion en pourcentage ny frais de transfert si meme operateur
- tsy maintsy amprimina any anaty base
- [ ] creation de base de donnee promotion
  - [x] base.sql
- [x] creation de migrate
- [x] creation de seeder promotion
- [x] creation de modele par rapport a la table
- [x] autorise l'acces au fields
- [x] creation du controlleur
- [x] creation du fonction dans modele
- [ ] creation du function dans controlleur
  - [ ] verfier si meme operateur 
  - [ ] ajout de la promotion
- [ ] routage dans route
- [ ] affichage de la promotion simple
  - [ ] dupliquer form transfer -> prom/tranfert 
- [ ] 


### Alea 
Notion d'epargne 
  - pourcentage (choisis par client)
  - a chaque transfert (prend le pourcentage choisis par le client, les autres dans le solde)

- [] mis a jour de database 
- [] creation de tables epargne (id,id_comptes,poucentage_epargne)
- [ ] Mis a jour Migration
- [] creation de EpargneSeeder 
- [ ] creation EpargneModele
-  [ ] creation EpargneController
-  [ ] creation pages views (client/Epargne/)
   -  [ ] index.php
      -  [ ] afficher le solde et les epargnes 
  
