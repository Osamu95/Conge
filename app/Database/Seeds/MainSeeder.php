<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MainSeeder extends Seeder
{
    public function run()
    {
        // Insérer les statuts
        $statuts = [
            ['libelle' => 'en_attente'],
            ['libelle' => 'approuve'],
            ['libelle' => 'refuse'],
            ['libelle' => 'annule'],
        ];
        foreach ($statuts as $statut) {
            $this->db->table('statuts')->insert($statut);
        }

        // Insérer les départements
        $departements = [
            ['id' => 1, 'nom' => 'Informatique', 'description' => 'Equipe infrastructure et applications'],
            ['id' => 2, 'nom' => 'Ressources Humaines', 'description' => 'Gestion du personnel et des congés'],
            ['id' => 3, 'nom' => 'Comptabilite', 'description' => 'Suivi financier et paie'],
        ];
        foreach ($departements as $dept) {
            $this->db->table('departements')->insert($dept);
        }

        // Insérer les types de congé
        $typesConge = [
            ['id' => 1, 'libelle' => 'Congé annuel', 'jours_annuels' => 30, 'deductible' => 1],
            ['id' => 2, 'libelle' => 'Congé maladie', 'jours_annuels' => 10, 'deductible' => 1],
            ['id' => 3, 'libelle' => 'Congé spécial', 'jours_annuels' => 5, 'deductible' => 1],
        ];
        foreach ($typesConge as $type) {
            $this->db->table('types_conge')->insert($type);
        }

        // Insérer les employés
        $employes = [
            ['id' => 1, 'nom' => 'Rakoto', 'prenom' => 'Soa', 'email' => 'employe@techmada.mg', 'password' => password_hash('emp123', PASSWORD_DEFAULT), 'role' => 'employe', 'departement_id' => 1, 'date_embauche' => '2024-01-15', 'actif' => 1],
            ['id' => 2, 'nom' => 'Ranaivo', 'prenom' => 'Mira', 'email' => 'rh@techmada.mg', 'password' => password_hash('rh123', PASSWORD_DEFAULT), 'role' => 'rh', 'departement_id' => 2, 'date_embauche' => '2023-09-01', 'actif' => 1],
            ['id' => 3, 'nom' => 'Andriam', 'prenom' => 'Tiana', 'email' => 'admin@techmada.mg', 'password' => password_hash('admin123', PASSWORD_DEFAULT), 'role' => 'admin', 'departement_id' => 3, 'date_embauche' => '2022-05-10', 'actif' => 1],
            ['id' => 4, 'nom' => 'Razafindra', 'prenom' => 'Hery', 'email' => 'hery@techmada.mg', 'password' => password_hash('emp123', PASSWORD_DEFAULT), 'role' => 'employe', 'departement_id' => 1, 'date_embauche' => '2024-03-12', 'actif' => 1],
            ['id' => 5, 'nom' => 'Raso', 'prenom' => 'Mialy', 'email' => 'mialy@techmada.mg', 'password' => password_hash('emp123', PASSWORD_DEFAULT), 'role' => 'employe', 'departement_id' => 2, 'date_embauche' => '2023-11-20', 'actif' => 1],
            ['id' => 6, 'nom' => 'Randriamampianina', 'prenom' => 'Lova', 'email' => 'lova@techmada.mg', 'password' => password_hash('emp123', PASSWORD_DEFAULT), 'role' => 'employe', 'departement_id' => 3, 'date_embauche' => '2022-08-05', 'actif' => 1],
        ];
        foreach ($employes as $emp) {
            $this->db->table('employes')->insert($emp);
        }

        // Insérer les soldes
        $soldes = [
            ['employe_id' => 1, 'type_conge_id' => 1, 'annee' => 2025, 'jours_attribues' => 30, 'jours_pris' => 12],
            ['employe_id' => 1, 'type_conge_id' => 2, 'annee' => 2025, 'jours_attribues' => 10, 'jours_pris' => 2],
            ['employe_id' => 1, 'type_conge_id' => 3, 'annee' => 2025, 'jours_attribues' => 5, 'jours_pris' => 4],
            ['employe_id' => 4, 'type_conge_id' => 1, 'annee' => 2025, 'jours_attribues' => 30, 'jours_pris' => 8],
            ['employe_id' => 4, 'type_conge_id' => 2, 'annee' => 2025, 'jours_attribues' => 10, 'jours_pris' => 1],
            ['employe_id' => 5, 'type_conge_id' => 1, 'annee' => 2025, 'jours_attribues' => 30, 'jours_pris' => 14],
            ['employe_id' => 5, 'type_conge_id' => 2, 'annee' => 2025, 'jours_attribues' => 10, 'jours_pris' => 0],
            ['employe_id' => 6, 'type_conge_id' => 1, 'annee' => 2025, 'jours_attribues' => 30, 'jours_pris' => 6],
            ['employe_id' => 6, 'type_conge_id' => 3, 'annee' => 2025, 'jours_attribues' => 5, 'jours_pris' => 1],
        ];
        foreach ($soldes as $solde) {
            $this->db->table('soldes')->insert($solde);
        }

        // Insérer les congés
        $conges = [
            ['employe_id' => 1, 'type_conge_id' => 1, 'date_debut' => '2025-06-16', 'date_fin' => '2025-06-20', 'nb_jours' => 5, 'motif' => 'Congé annuel', 'statut_id' => 1, 'commentaire_rh' => null, 'traite_par' => null, 'created_at' => '2025-06-01 08:00:00'],
            ['employe_id' => 1, 'type_conge_id' => 2, 'date_debut' => '2025-06-02', 'date_fin' => '2025-06-03', 'nb_jours' => 2, 'motif' => 'Repos médical', 'statut_id' => 2, 'commentaire_rh' => 'Demande validée', 'traite_par' => 2, 'created_at' => '2025-06-02 09:15:00'],
            ['employe_id' => 1, 'type_conge_id' => 1, 'date_debut' => '2025-05-12', 'date_fin' => '2025-05-16', 'nb_jours' => 5, 'motif' => 'Vacances', 'statut_id' => 2, 'commentaire_rh' => 'Approuvé', 'traite_par' => 2, 'created_at' => '2025-05-12 10:30:00'],
            ['employe_id' => 1, 'type_conge_id' => 3, 'date_debut' => '2025-07-10', 'date_fin' => '2025-07-10', 'nb_jours' => 1, 'motif' => 'Autorisation spéciale', 'statut_id' => 3, 'commentaire_rh' => 'Motif incomplet', 'traite_par' => 2, 'created_at' => '2025-07-01 11:00:00'],
            ['employe_id' => 4, 'type_conge_id' => 1, 'date_debut' => '2025-08-01', 'date_fin' => '2025-08-05', 'nb_jours' => 5, 'motif' => 'Premier congé', 'statut_id' => 1, 'commentaire_rh' => null, 'traite_par' => null, 'created_at' => '2025-07-28 14:00:00'],
            ['employe_id' => 4, 'type_conge_id' => 1, 'date_debut' => '2025-09-15', 'date_fin' => '2025-09-19', 'nb_jours' => 5, 'motif' => 'Voyage familial', 'statut_id' => 1, 'commentaire_rh' => null, 'traite_par' => null, 'created_at' => '2025-09-01 08:20:00'],
            ['employe_id' => 5, 'type_conge_id' => 2, 'date_debut' => '2025-07-08', 'date_fin' => '2025-07-09', 'nb_jours' => 2, 'motif' => 'Repos médical', 'statut_id' => 2, 'commentaire_rh' => 'Validé par RH', 'traite_par' => 2, 'created_at' => '2025-07-08 09:10:00'],
            ['employe_id' => 6, 'type_conge_id' => 1, 'date_debut' => '2025-10-20', 'date_fin' => '2025-10-24', 'nb_jours' => 5, 'motif' => 'Congé annuel', 'statut_id' => 3, 'commentaire_rh' => 'Refus pour période chargée', 'traite_par' => 2, 'created_at' => '2025-10-01 10:00:00'],
            ['employe_id' => 5, 'type_conge_id' => 3, 'date_debut' => '2025-11-03', 'date_fin' => '2025-11-03', 'nb_jours' => 1, 'motif' => 'Autorisation spéciale', 'statut_id' => 1, 'commentaire_rh' => null, 'traite_par' => null, 'created_at' => '2025-10-28 11:00:00'],
        ];
        foreach ($conges as $conge) {
            $this->db->table('conges')->insert($conge);
        }
    }
}