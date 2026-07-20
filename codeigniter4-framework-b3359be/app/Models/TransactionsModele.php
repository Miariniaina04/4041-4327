<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionsModele extends Model
{
    protected $table            = 'transactions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

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

    public function getTransactionsByPrefix($prefix)
    {
        return $this->where('prefix', $prefix)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    public function getTransactionsByDateRange($startDate, $endDate)
    {
        return $this->where('created_at >=', $startDate)
                    ->where('created_at <=', $endDate)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    public function getTransactionsByType($typeId)
    {
        return $this->where('operation_type_id', $typeId)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

   public function getTransactionsByClient($clientId)
    {
        return $this->where('compte_id_from', $clientId) 
                    ->orWhere('compte_id_to', $clientId) 
                    ->orderBy('id', 'DESC') 
                    ->findAll(); 
    }

    public function getTransactionsByMontantRange($minMontant, $maxMontant)
    {
        return $this->where('montant >=', $minMontant)
                    ->where('montant <=', $maxMontant)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

  public function getGainsParType()
    {
        return $this->select('operation_type_id, SUM(frais) as total_gains')
                    ->groupBy('operation_type_id')
                    ->findAll();
    }

    public function saveTransaction($data)
    {
        return $this->insert($data);
    }

    public function getHistoriqueParCompte($compteId)
    {
        return $this->select('transactions.*, operation_types.nom as type_nom')
                    ->join('operation_types', 'operation_types.id = transactions.operation_type_id')
                    ->groupStart()
                        ->where('compte_id_from', $compteId)
                        ->orWhere('compte_id_to', $compteId)
                    ->groupEnd()
                    ->orderBy('date_transaction', 'DESC')
                    ->findAll();
    }
}
