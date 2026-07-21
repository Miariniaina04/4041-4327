<?php

namespace App\Models;

use CodeIgniter\Model;

class EpargneModele extends Model
{
    protected $table            = 'epargnes';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_telephone','id_pourcentage','epargne','date_creation'];

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

    public function getEpargneByID ($id)
    {
        $epargnes = $this->where('id_comptes', $id)->first();
        return $epargnes ? (float)$epargnes['epargnes'] : 0.0;
    }

    public function getEpargnePourcentageById ($id)
    {
        return $this->where('id_porcentages', $id)
                    ->first();
    }
}
