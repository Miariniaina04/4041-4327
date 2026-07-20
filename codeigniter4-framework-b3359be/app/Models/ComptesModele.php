<?php

namespace App\Models;

use CodeIgniter\Model;

class ComptesModele extends Model
{
    protected $table            = 'comptes';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['telephone', 'solde', 'prefix_id'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
    
    public function getSolde($telephone)
    {
        $compte = $this->where('telephone', $telephone)->first();
        return $compte ? (float)$compte['solde'] : 0.0;
    }

    public function getCompteByTelephone($telephone)
    {
        return $this->where('telephone', $telephone)
                    ->first();
    }
    
    // mettre a jours
    public function updateSolde($compteId, $nouveauSolde)
    {
        return $this->update($compteId, ['solde' => $nouveauSolde]);
    }

    // retirer ou ajouter dans le solde
    public function ajusterSolde($compteId, $montant, $estAjout = true)
    {
        $compte = $this->find($compteId);
        
        if (!$compte) {
            return false;
        }

        $nouveauSolde = $estAjout 
            ? $compte['solde'] + $montant 
            : $compte['solde'] - $montant;

        // Éviter solde négatif
        if (!$estAjout && $nouveauSolde < 0) {
            return false;
        }

        return $this->update($compteId, ['solde' => $nouveauSolde]);
    }

    public function existe($telephone)
    {
        return $this->where('telephone', $telephone)->countAllResults() > 0;
    }

    public function getSoldeFrais($telephone, $frais)
    {
        $compte = $this->where('telephone', $telephone)->first();
        if ($compte) {
            return (float)$compte['solde'] - (float)$frais;
        }
        return null; // Compte non trouvé
    }

}
