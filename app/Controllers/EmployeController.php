<?php 

namespace App\Controllers;
use App\Models\EmployesModel;

class EmployeController extends BaseController
{
    public function home(){
        $employeModel = new EmployesModel();
        $demandes = $employeModel->getDernieresDemandes(1, 5);
        $statistiques = $employeModel->getStatDemandes(1);
        return view('modal', [
            'page' => 'pages/dashboard-employe',
            'title' => 'Tableau de bord',
            'sidebar' => 'Espace employé',
            // 'sidebar' => view('inc/sidebar', ['active' => 'dashboard']),
            'demandes' => $demandes,
            'statistiques' => $statistiques
        ]);
    }

    public function demandeForm(){
        return view('employe/new_demande');
    }

    public function submitDemande(){
        $employeModel = new EmployesModel();
        $data = [
            'employe_id' => session()->get('user_id'),
            'type_conge_id' => $this->request->getPost('type_conge_id'),
            'start_date' => $this->request->getPost('start_date'),
            'end_date' => $this->request->getPost('end_date'),
            'reason' => $this->request->getPost('reason'),
            'status' => 'en_attente'
        ];
        $employeModel->save($data);
        return redirect()->to('/employe/demandes');
    }

    public function getDemandes(){
        $employeModel = new EmployesModel();
        $demandes = $employeModel->where('employe_id', session()->get('user_id'))->findAll();
        return view('employe/demandes', ['demandes' => $demandes]);
    }

    public function profile(){
        return view('employe/profile');
    }
}