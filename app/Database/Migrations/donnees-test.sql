-- Insertion des départements
INSERT INTO departments (nom, description) VALUES
('Direction Générale', 'Direction générale de l''entreprise'),
('Ressources Humaines', 'Gestion du personnel et des carrières'),
('Informatique', 'Développement et infrastructure IT'),
('Commercial', 'Ventes et relations clients'),
('Marketing', 'Communication et stratégie marketing'),
('Comptabilité', 'Gestion financière et comptable');

-- Insertion des employés
INSERT INTO employes (nom, prenom, email, passwd, role, department_id, date_embauche, actif) VALUES
('Martin', 'Sophie', 'sophie.martin@entreprise.com', 'hashed_password_001', 'DIRECTRICE', 1, '2015-06-01 00:00:00', 1),
('Dubois', 'Thomas', 'thomas.dubois@entreprise.com', 'hashed_password_002', 'RH_MANAGER', 2, '2016-03-15 00:00:00', 1),
('Bernard', 'Julie', 'julie.bernard@entreprise.com', 'hashed_password_003', 'RH', 2, '2018-09-10 00:00:00', 1),
('Petit', 'Nicolas', 'nicolas.petit@entreprise.com', 'hashed_password_004', 'DEV_MANAGER', 3, '2017-11-20 00:00:00', 1),
('Robert', 'Camille', 'camille.robert@entreprise.com', 'hashed_password_005', 'DEV', 3, '2019-04-05 00:00:00', 1),
('Richard', 'Antoine', 'antoine.richard@entreprise.com', 'hashed_password_006', 'DEV', 3, '2020-01-15 00:00:00', 1),
('Durand', 'Marie', 'marie.durand@entreprise.com', 'hashed_password_007', 'COMMERCIAL', 4, '2018-08-22 00:00:00', 1),
('Moreau', 'Lucas', 'lucas.moreau@entreprise.com', 'hashed_password_008', 'COMMERCIAL', 4, '2019-11-30 00:00:00', 1),
('Simon', 'Claire', 'claire.simon@entreprise.com', 'hashed_password_009', 'MARKETING', 5, '2020-05-14 00:00:00', 1),
('Laurent', 'Maxime', 'maxime.laurent@entreprise.com', 'hashed_password_010', 'COMPTABLE', 6, '2017-07-19 00:00:00', 1),
('Lefebvre', 'Emma', 'emma.lefebvre@entreprise.com', 'hashed_password_011', 'DEV', 3, '2021-02-28 00:00:00', 1),
('Garcia', 'Hugo', 'hugo.garcia@entreprise.com', 'hashed_password_012', 'COMMERCIAL', 4, '2021-06-10 00:00:00', 0); -- Actif = 0 (départ)

-- Insertion des types de congés
INSERT INTO types_conge (libelle, jours_annuels, deductible) VALUES
('Congés Payés', 25, 1),
('RTT', 12, 1),
('Congés Sans Solde', 0, 0),
('Congés Maladie', 0, 0),
('Congés Exceptionnels', 5, 0),
('Formation', 10, 1),
('Maternité/Paternité', 16, 0);

-- Insertion des soldes pour l'année 2024
INSERT INTO soldes (employe_id, types_conge_id, annee, jours_attribues, jours_pris) VALUES
-- Employé 1 (Sophie Martin)
(1, 1, 2024, 25, 12),
(1, 2, 2024, 12, 5),
-- Employé 2 (Thomas Dubois)
(2, 1, 2024, 25, 8),
(2, 2, 2024, 12, 3),
-- Employé 3 (Julie Bernard)
(3, 1, 2024, 25, 15),
(3, 2, 2024, 12, 6),
-- Employé 4 (Nicolas Petit)
(4, 1, 2024, 25, 20),
(4, 2, 2024, 12, 10),
(4, 5, 2024, 5, 2),
-- Employé 5 (Camille Robert)
(5, 1, 2024, 25, 5),
(5, 2, 2024, 12, 2),
-- Employé 6 (Antoine Richard)
(6, 1, 2024, 25, 18),
(6, 2, 2024, 12, 7),
-- Employé 7 (Marie Durand)
(7, 1, 2024, 25, 10),
(7, 2, 2024, 12, 4),
-- Employé 8 (Lucas Moreau)
(8, 1, 2024, 25, 22),
(8, 2, 2024, 12, 8),
-- Employé 9 (Claire Simon)
(9, 1, 2024, 25, 14),
(9, 2, 2024, 12, 5),
-- Employé 10 (Maxime Laurent)
(10, 1, 2024, 25, 9),
(10, 2, 2024, 12, 3),
-- Employé 11 (Emma Lefebvre)
(11, 1, 2024, 25, 6),
(11, 2, 2024, 12, 2);

-- Insertion des demandes de congés
INSERT INTO conges (employe_id, types_conge_id, date_debut, date_fin, nb_jours, motif, statut, commentaire_rh, created_at, traite_par) VALUES
-- Congés approuvés pour 2024
(1, 1, '2024-07-01 00:00:00', '2024-07-15 00:00:00', 12, 'Vacances d''été', 'APPROUVE', 'OK pour les dates', '2024-05-15 10:30:00', 2),
(2, 2, '2024-04-10 00:00:00', '2024-04-12 00:00:00', 3, 'RTT', 'APPROUVE', NULL, '2024-03-20 14:15:00', 3),
(3, 1, '2024-08-05 00:00:00', '2024-08-19 00:00:00', 15, 'Vacances en famille', 'APPROUVE', 'Solde suffisant', '2024-06-10 09:00:00', 2),
(4, 5, '2024-03-18 00:00:00', '2024-03-19 00:00:00', 2, 'Mariage', 'APPROUVE', 'Congé exceptionnel accepté', '2024-02-01 11:20:00', 2),
(5, 1, '2024-12-20 00:00:00', '2024-12-27 00:00:00', 5, 'Fêtes de fin d''année', 'APPROUVE', NULL, '2024-11-15 16:45:00', 3),
(7, 2, '2024-09-16 00:00:00', '2024-09-18 00:00:00', 3, 'RTT', 'APPROUVE', NULL, '2024-08-30 08:30:00', 2),

-- Congés en attente
(6, 1, '2025-02-10 00:00:00', '2025-02-20 00:00:00', 8, 'Vacances d''hiver', 'EN_ATTENTE', NULL, '2025-01-15 13:20:00', NULL),
(8, 1, '2025-03-03 00:00:00', '2025-03-10 00:00:00', 6, 'Semaine de repos', 'EN_ATTENTE', NULL, '2025-01-20 09:45:00', NULL),
(9, 2, '2025-04-22 00:00:00', '2025-04-25 00:00:00', 4, 'RTT à poser', 'EN_ATTENTE', NULL, '2025-01-18 14:00:00', NULL),
(11, 3, '2025-01-05 00:00:00', '2025-01-12 00:00:00', 8, 'Congé sans solde pour projet perso', 'EN_ATTENTE', NULL, '2024-12-01 10:15:00', NULL),

-- Congés refusés
(10, 1, '2024-11-01 00:00:00', '2024-11-15 00:00:00', 12, 'Voyage', 'REFUSE', 'Période de clôture comptable', '2024-10-01 15:20:00', 2),
(4, 1, '2024-05-20 00:00:00', '2024-06-05 00:00:00', 15, 'Grandes vacances', 'REFUSE', 'Trop d''absences dans l''équipe sur cette période', '2024-04-15 11:00:00', 2),

-- Congés pour 2025 déjà approuvés
(2, 1, '2025-07-14 00:00:00', '2025-07-25 00:00:00', 10, 'Vacances été 2025', 'APPROUVE', 'Approuvé en avance', '2025-01-10 09:30:00', 3),
(5, 2, '2025-01-30 00:00:00', '2025-01-31 00:00:00', 2, 'RTT', 'APPROUVE', NULL, '2025-01-05 16:20:00', 2),

-- Congés maladie
(3, 4, '2024-10-10 00:00:00', '2024-10-15 00:00:00', 6, 'Arrêt maladie', 'APPROUVE', 'Justificatif reçu', '2024-10-11 08:00:00', 2),
(7, 4, '2024-11-25 00:00:00', '2024-11-28 00:00:00', 4, 'Maladie', 'APPROUVE', 'Certificat médical ok', '2024-11-26 09:15:00', 2),

-- Formation
(6, 6, '2024-09-23 00:00:00', '2024-09-27 00:00:00', 5, 'Formation Docker', 'APPROUVE', 'Formation validée par le manager', '2024-08-15 13:45:00', 4),
(1, 6, '2024-11-18 00:00:00', '2024-11-22 00:00:00', 5, 'Leadership avancé', 'APPROUVE', NULL, '2024-10-01 10:00:00', 2);