<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployesModel extends Model
{
    protected $table = "employes";
    protected $primaryKey = "id";
    protected $allowedFields = ['nom', 'prenom', 'email', 'passwd', 'role', 'department_id', 'date_embauche', 'actif'];
    
    protected $returnType = 'array';
    protected $useTimestamps = false;

    protected $validationRules = [
        'nom' => [
            'label' => 'nom',
            'rules' => 'required|min_length[2]|max_length[255]'
        ],
        'prenom' => [
            'label' => 'prenom',
            'rules' => 'required|min_length[2]|max_length[255]'
        ],
        'email' => [
            'label' => 'email',
            'rules' => 'required|valid_email|is_unique[employes.email,id,{id}]'
        ],
        'passwd' => [
            'label' => 'mot de passe',
            'rules' => 'required|min_length[6]'
        ],
        'role' => [
            'label' => 'role',
            'rules' => 'required|max_length[255]'
        ],
        'department_id' => [
            'label' => 'departement',
            'rules' => 'required|integer'
        ],
        'date_embauche' => [
            'label' => 'date d\'embauche',
            'rules' => 'required|valid_date'
        ],
        'actif' => [
            'label' => 'actif',
            'rules' => 'required|integer'
        ]
    ];

    public function getEmployesWithDepartment()
    {
        return $this->select('employes.*, departments.nom as department_nom')
                    ->join('departments', 'departments.id = employes.department_id', 'left')
                    ->findAll();
    }

    public function getDernieresDemandes($employe_id, $limit = 5)
    {
        $congeModel = new CongeModel();
        return $congeModel->getCongesByEmployeId($employe_id, $limit, 'DESC');
    }

    // CORRIGÉ : Méthode pour obtenir les statistiques de TOUTES les demandes
    public function getStatDemandes($employe_id)
    {
        $congeModel = new CongeModel();
        // Récupérer toutes les demandes de l'employé (sans limite)
        $demandes = $congeModel->getCongesByEmployeId($employe_id, null, 'DESC');
    
        // Initialiser les compteurs à 0 (toujours définis)
        $demande_en_attente = 0;
        $demande_approuve = 0;
        $demande_refuse = 0;
        
        // Si on a des demandes, les compter
        if (is_array($demandes) && !empty($demandes)) {
            foreach ($demandes as $demande) {
                switch ($demande['statut']) {
                    case 'en_attente':
                        $demande_en_attente++;
                        break;
                    case 'approuve':
                        $demande_approuve++;
                        break;
                    case 'refuse':
                        $demande_refuse++;
                        break;
                }
            }
        }
        
        return [
            'en_attente' => $demande_en_attente,
            'approuve' => $demande_approuve,
            'refuse' => $demande_refuse
        ];
    }
    
    // OPTIONNEL : Si vous voulez une méthode pour compter par statut spécifique
    public function countDemandesByStatut($employe_id, $statut)
    {
        $congeModel = new CongeModel();
        $demandes = $congeModel->getCongesByEmployeId($employe_id, null, 'DESC');
        
        $count = 0;
        if (is_array($demandes)) {
            foreach ($demandes as $demande) {
                if ($demande['statut'] === $statut) {
                    $count++;
                }
            }
        }
        
        return $count;
    }
    
    // Soldes d'un employé
    public function getSoldes($employe_id, $annee = null)
    {
        $annee = $annee ?? date('Y');
        
        $soldesModel = new SoldeModel();
        return $soldesModel->where('employe_id', $employe_id)
                           ->where('annee', $annee)
                           ->findAll();
    }
}