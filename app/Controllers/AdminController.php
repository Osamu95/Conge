<?php

namespace App\Controllers;

use App\Models\EmployesModel;
use App\Models\DepartementModel;
use App\Models\TypeCongesModel;

class AdminController extends BaseController{
    protected $helpers = ['form'];

    // ========== DASHBOARD ==========
    public function home(){
        // Vérifier que l'utilisateur est admin
        $user = session()->get('user');
        if(!$user || $user['role'] !== 'ADMIN') {
            return redirect()->to('/');
        }

        return view('modal', [
            'page' => 'pages/dashboard-admin',
            'title' => 'Tableau de bord',
            'sidebar' => 'Administration'
        ]);
    }

    // ========== EMPLOYÉS ==========
    public function getEmployes(){
        $employesModel = new EmployesModel();
        
        return view('modal', [
            'page' => 'pages/gestion-employes',
            'title' => 'Gestion des employés',
            'sidebar' => 'Administration',
            'employes' => $employesModel->findAll()
        ]);
    }

    public function getEmploye($id){
        $employesModel = new EmployesModel();
        $employe = $employesModel->find($id);

        if(!$employe) {
            return redirect()->back()->with('error', 'Employé non trouvé');
        }

        return view('modal', [
            'page' => 'pages/employe-detail',
            'title' => 'Détail employé',
            'sidebar' => 'Administration',
            'employe' => $employe
        ]);
    }

    public function updateEmploye($id){
        $employesModel = new EmployesModel();
        
        $data = [
            'nom' => $this->request->getPost('nom'),
            'prenom' => $this->request->getPost('prenom'),
            'email' => $this->request->getPost('email'),
            'department_id' => $this->request->getPost('department_id'),
            'actif' => $this->request->getPost('actif') ? 1 : 0
        ];

        if($employesModel->update($id, $data)) {
            return redirect()->back()->with('success', 'Employé mis à jour');
        } else {
            return redirect()->back()->with('error', 'Erreur lors de la mise à jour');
        }
    }

    public function deleteEmploye($id){
        $employesModel = new EmployesModel();
        
        if($employesModel->delete($id)) {
            return redirect()->to('/admin/employe')->with('success', 'Employé supprimé');
        } else {
            return redirect()->back()->with('error', 'Erreur lors de la suppression');
        }
    }

    // ========== DÉPARTEMENTS ==========
    public function getDeparments(){
        $departementModel = new DepartementModel();
        
        return view('modal', [
            'page' => 'pages/gestion-departments',
            'title' => 'Gestion des départements',
            'sidebar' => 'Administration',
            'departments' => $departementModel->findAll()
        ]);
    }

    public function getDeparment($id){
        $departementModel = new DepartementModel();
        $department = $departementModel->find($id);

        if(!$department) {
            return redirect()->back()->with('error', 'Département non trouvé');
        }

        return view('modal', [
            'page' => 'pages/department-detail',
            'title' => 'Détail département',
            'sidebar' => 'Administration',
            'department' => $department
        ]);
    }

    public function updateDeparment($id){
        $departementModel = new DepartementModel();
        
        $data = [
            'nom' => $this->request->getPost('nom'),
            'description' => $this->request->getPost('description')
        ];

        if($departementModel->update($id, $data)) {
            return redirect()->back()->with('success', 'Département mis à jour');
        } else {
            return redirect()->back()->with('error', 'Erreur lors de la mise à jour');
        }
    }

    public function deleteDeparment($id){
        $departementModel = new DepartementModel();
        
        if($departementModel->delete($id)) {
            return redirect()->to('/admin/deparment')->with('success', 'Département supprimé');
        } else {
            return redirect()->back()->with('error', 'Erreur lors de la suppression');
        }
    }

    // ========== TYPES DE CONGÉ ==========
    public function getTypeconges(){
        $typeCongesModel = new TypeCongesModel();
        
        return view('modal', [
            'page' => 'pages/gestion-typeconges',
            'title' => 'Gestion des types de congé',
            'sidebar' => 'Administration',
            'types' => $typeCongesModel->findAll()
        ]);
    }

    public function getTypeconge($id){
        $typeCongesModel = new TypeCongesModel();
        $type = $typeCongesModel->find($id);

        if(!$type) {
            return redirect()->back()->with('error', 'Type de congé non trouvé');
        }

        return view('modal', [
            'page' => 'pages/typeconge-detail',
            'title' => 'Détail type de congé',
            'sidebar' => 'Administration',
            'type' => $type
        ]);
    }

    public function updateTypeconge($id){
        $typeCongesModel = new TypeCongesModel();
        
        $data = [
            'libelle' => $this->request->getPost('libelle'),
            'jours_annuels' => $this->request->getPost('jours_annuels'),
            'deductible' => $this->request->getPost('deductible') ? 1 : 0
        ];

        if($typeCongesModel->update($id, $data)) {
            return redirect()->back()->with('success', 'Type de congé mis à jour');
        } else {
            return redirect()->back()->with('error', 'Erreur lors de la mise à jour');
        }
    }

    public function deleteTypeconge($id){
        $typeCongesModel = new TypeCongesModel();
        
        if($typeCongesModel->delete($id)) {
            return redirect()->to('/admin/typeconge')->with('success', 'Type de congé supprimé');
        } else {
            return redirect()->back()->with('error', 'Erreur lors de la suppression');
        }
    }
}
