<?php

namespace App\Controllers;

use App\Models\DemandesModel;

class RhController extends BaseController{
    protected $helpers = ['form'];

    // ========== DASHBOARD ==========
    public function home(){
        // Vérifier que l'utilisateur est RH
        $user = session()->get('user');
        if(!$user || $user['role'] !== 'RH') {
            return redirect()->to('/');
        }

        $demandesModel = new DemandesModel();
        
        return view('modal', [
            'page' => 'pages/dashboard-rh',
            'title' => 'Tableau de bord',
            'sidebar' => 'Espace RH',
            'demandes' => $demandesModel->findAll()
        ]);
    }

    // ========== DEMANDES ==========
    public function accept($id){
        $demandesModel = new DemandesModel();
        
        if($demandesModel->update($id, ['statut' => 'approuvee'])) {
            return redirect()->back()->with('success', 'Demande approuvée');
        } else {
            return redirect()->back()->with('error', 'Erreur lors de la mise à jour');
        }
    }

    public function deny($id){
        $demandesModel = new DemandesModel();
        
        if($demandesModel->update($id, ['statut' => 'rejetee'])) {
            return redirect()->back()->with('success', 'Demande rejetée');
        } else {
            return redirect()->back()->with('error', 'Erreur lors de la mise à jour');
        }
    }

    public function filter(){
        $statut = $this->request->getGet('statut');
        $demandesModel = new DemandesModel();
        
        $demandes = $statut ? $demandesModel->where('statut', $statut)->findAll() : $demandesModel->findAll();
        
        return view('modal', [
            'page' => 'pages/liste-demandes',
            'title' => 'Filtre demandes',
            'sidebar' => 'Espace RH',
            'demandes' => $demandes,
            'statut' => $statut
        ]);
    }
}
