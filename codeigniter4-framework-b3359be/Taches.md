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
  
- [ ] Calcul automatique des frais selon les tranches de montant : 
  - [ ] Fonctions :
    - [x] calcul_Depot : Numero 1 -> Numero 1 (Aucun Frais)
    - [x] calcul_Retrait : Numero 1 <- Numero 1 (Avec Frais) 
    - [x] calcul_Transfert : Numero 1 -> Numero 2 (Avec Frais)
    - [ ] calcul_Retrait_Transfert : Numero 1 <=> Numero 2 (Avec Frais)
  
- [ ] Tableau de bord opérateur (gains, situation des comptes clients)  (auth/Gain) :
  - [ ]  Tableau de Bord Gains pour chaque types (Tansfert et Retrait)
  - [ ]  Situation Clients

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
  - [ ] Voir solde
  - [ ] Dépôt (simulation)
  - [ ] Retrait (avec frais)
  - [ ] Transfert vers autre numéro (avec frais)
- [ ] Historique des transactions pour le client
- [ ] Design Bootstrap + responsive (frontend global)

### Tâches communes
- [ ] Configuration des routes dans CodeIgniter
- [ ] Mise en place de l'authentification simple (session par numéro)
- [ ] Validation des numéros selon préfixes
- [ ] Tests fonctionnels complets
- [ ] Mise à jour de `base.sql` avec données de test
- [ ] Documentation dans README.md (instructions d'installation)
- [x] Commit + Tag `v1`

## Version 2 (v2)

**Date de livraison :** [Mettre la date] - Tag : v2

### Étudiant 1 : [Nom]
- [ ] Configuration des préfixes pour les autres opérateurs (032, 031, etc.)
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

### Tâches communes
- [ ] Mise à jour de `base.sql` (nouvelles colonnes / tables si nécessaire)
- [ ] Modification des modèles (CompteModel, FraisBaremeModel, etc.)
- [ ] Mise à jour des contrôleurs pour les nouvelles fonctionnalités
- [ ] Tests des transferts inter-opérateurs et envoi multiple
- [ ] Mise à jour du tableau de bord opérateur
- [x] Commit + création du Tag `v2`

**Statut Version 2 :** En cours 