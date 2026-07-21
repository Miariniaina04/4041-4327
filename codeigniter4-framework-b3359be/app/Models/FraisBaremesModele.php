<?php

namespace App\Models;

use CodeIgniter\Model;

class FraisBaremesModele extends Model
{
    protected $table            = 'frais_baremes';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['operation_type_id', 'min_montant', 'max_montant', 'frais'];

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

    public function getByOperationType($typeId)
    {
        return $this->where('operation_type_id', $typeId)
                    ->orderBy('min_montant', 'ASC')
                    ->findAll();
    }

    public function getFraisByMontant($typeId, $montant)
    {
        return $this->where('operation_type_id', $typeId)
                    ->where('min_montant <=', $montant)
                    ->where('max_montant >=', $montant)
                    ->first();
    }

    public function commissionTransfert($montant)
    {
        $bareme = $this->where('operation_type_id', 3)
                       ->where('min_montant <=', $montant)
                       ->where('max_montant >=', $montant)
                       ->first();

        if ($bareme) {
            return $bareme['frais'] + ($bareme['frais'] * 0.05); 

        return null; 
        }  
    }
}