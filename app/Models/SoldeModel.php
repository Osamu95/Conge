<?php

namespace App\Models;

use CodeIgniter\Model;

class SoldeModel extends Model
{
    protected $table = 'soldes';
    protected $primaryKey = 'id';
    
    protected $allowedFields = [
        'employe_id',
        'types_conge_id',
        'annee',
        'jours_attribues',
        'jours_pris'
    ];
    
    protected $returnType = 'array';
    protected $useTimestamps = false;
    
    // Récupérer les soldes avec les types de congé
    public function getSoldesWithTypes($employe_id, $annee = null)
    {
        $annee = $annee ?? date('Y');
        
        return $this->select('soldes.*, types_conge.libelle, types_conge.jours_annuels, types_conge.deductible')
                    ->join('types_conge', 'types_conge.id = soldes.types_conge_id')
                    ->where('soldes.employe_id', $employe_id)
                    ->where('soldes.annee', $annee)
                    ->findAll();
    }
}