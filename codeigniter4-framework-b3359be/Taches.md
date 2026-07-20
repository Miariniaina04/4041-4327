# Tâches - Projet Mobile Money

**Binôme :** [Vos Noms Ici]  
**Version 1** - Date de livraison : 

## Version 1 (v1)

### Étudiant 1 : [Nom]
- [ ]  Creation de Github de notre projet

- [ ] Création de la base de données (`base.sql`) : tables `prefixes`, `operation_types`, `frais_barèmes`, `comptes`, `transactions`
  - [ ] Creation du `prefixes`
  - [ ] Creation du  `operation_types`
  - [ ] Creation du `frais_barèmes`
  - [ ] Creation du `comptes`
  - [ ] Creation du `transactions`

- [ ] Mise en place des modèles (Models) pour toutes les entités
  - [ ] PrefixesModele
  - [ ] OperationTypesModele
  - [ ] FraisBaremesModele
  - [ ] ComptesModele
  - [ ] TransactionsModele

> Page de Configuration Prefixes : 
- [ ] CRUD pour les préfixes (côté opérateur)
  - [ ] Ajouter Prefixes 
  - [ ] Modifier Prefixes 
  - [ ] Supprimer Prefixes 
  - [ ] Filtrages Prefixes

> Pages d'operation : 
- [ ] CRUD pour les types d'opérations et barèmes de frais
  - [ ]  fil
- [ ] Calcul automatique des frais selon les tranches de montant
- [ ] Tableau de bord opérateur (gains, situation des comptes clients)

### Étudiant 2 : [Nom]
- [ ] Interface de login automatique client (numéro de téléphone)
- [ ] Création automatique de compte si inexistant
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
- [ ] Commit + Tag `v1`

**Statut :** En cours / Terminé