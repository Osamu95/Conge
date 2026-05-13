<?php

namespace App\Controllers;

use App\Models\UserModel;
use Config\Services;

class AuthController extends BaseController{
    protected $helpers = ['form'];

    public function loginForm(){
        // Vérifier si l'utilisateur est déjà authentifié
        if(session()->get('user')) {
            return redirect()->to('/' . strtolower(session()->get('user')['role']) . '/dashboard');
        }

        return view('pages/index');
    }

    public function login(){
        // Valider les données
        $validation = \Config\Services::validation();
        
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required|min_length[6]'
        ];

        if(!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        if($user && password_verify($password, $user['password'])) {
            // Vérifier si l'utilisateur est actif
            if($user['status'] === 'inactive') {
                return redirect()->back()->with('error', 'Votre compte est désactivé');
            }

            session()->set('user', [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role']
            ]);

            return redirect()->to('/' . strtolower($user['role']) . '/dashboard');
        } else {
            return redirect()->back()->withInput()->with('error', 'Email ou mot de passe incorrect');
        }
    }

    public function logout(){
        session()->destroy();
        return redirect()->to('/');
    }
}