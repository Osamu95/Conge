<?php

namespace App\Models;

use CodeIgniter\Model;

class DemandesModel extends Model{
    protected $table = 'demandes';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['employe_id', 'type_conge_id', 'date_debut', 'date_fin', 'motif', 'statut'];
    protected $useTimestamps = false;
}
