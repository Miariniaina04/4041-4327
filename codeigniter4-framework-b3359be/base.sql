-- =============================================
-- Base de données - Mobile Money (Version 1)
-- =============================================

-- Préfixes valides de l'opérateur (033, 037, etc.)
CREATE TABLE IF NOT EXISTS prefixes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    prefix VARCHAR(4) NOT NULL UNIQUE,
    actif BOOLEAN DEFAULT 1,
    operateur_principal BOOLEAN DEFAULT 0,
    description TEXT
);

-- Comptes clients
CREATE TABLE IF NOT EXISTS comptes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    telephone VARCHAR(20) NOT NULL UNIQUE,
    solde REAL DEFAULT 0.0,
    prefix_id INTEGER,
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (prefix_id) REFERENCES prefixes(id)
);

-- Types d'opérations (dépôt, retrait, transfert)
CREATE TABLE IF NOT EXISTS operation_types (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom VARCHAR(50) NOT NULL UNIQUE,
    description TEXT
);

-- Barèmes de frais
CREATE TABLE IF NOT EXISTS frais_baremes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    operation_type_id INTEGER NOT NULL,
    min_montant DECIMAL(15,2) NOT NULL,
    max_montant DECIMAL(15,2) NOT NULL,
    frais DECIMAL(15,2) NOT NULL,
    FOREIGN KEY (operation_type_id) REFERENCES operation_types(id)
);

-- Transactions
CREATE TABLE IF NOT EXISTS transactions (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    compte_id_from INTEGER,
    compte_id_to INTEGER,
    operation_type_id INTEGER NOT NULL,
    montant DECIMAL(15,2) NOT NULL,
    frais DECIMAL(15,2) DEFAULT 0.0,
    montant_total DECIMAL(15,2) NOT NULL,
    date_transaction DATETIME DEFAULT CURRENT_TIMESTAMP,
    statut VARCHAR(20) DEFAULT 'succes',
    FOREIGN KEY (compte_id_from) REFERENCES comptes(id),
    FOREIGN KEY (compte_id_to) REFERENCES comptes(id),
    FOREIGN KEY (operation_type_id) REFERENCES operation_types(id)
);

-- commission_inter
CREATE TABLE IF NOT EXISTS commissions_inter (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    prefix_source_id INTEGER,
    prefix_dest_id INTEGER,
    commission_pourcentage DECIMAL(5,2) DEFAULT 0.0,  -- ex: 1.5 %
    FOREIGN KEY (prefix_source_id) REFERENCES prefixes(id),
    FOREIGN KEY (prefix_dest_id) REFERENCES prefixes(id)
);
-- Insertion des données de base
--- prefixes test
INSERT OR IGNORE INTO prefixes (prefix, description, operateur_principal) VALUES 
('033', 'Airtel', 1),
('037', 'Orange', 0),
('034', 'Telma', 0);
--- prefixes operation_types test
INSERT OR IGNORE INTO operation_types (nom, description) VALUES 
('depot', 'Dépôt d\'argent'),
('retrait', 'Retrait d\'argent'),
('transfert', 'Transfert entre comptes');

INSERT OR IGNORE INTO comptes (telephone, prefix_id) VALUES
("0337208662",1);

INSERT OR IGNORE INTO commissions_inter (prefix_source_id,prefix_dest_id) VALUES
(1, 2, 1.5),
(1, 3, 2.0),
(2, 3, 1.0);