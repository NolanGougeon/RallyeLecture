<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Account
 *
 * @author adminSio
 */
class Account extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('EnseignantModel');
        $this->load->library('Aauth');
        $this->load->library('form_validation');
    }
    
    function create(){
        $this->load->library('form_validation');
        LoadValidationRules($this->EnseignantModel, $this->form_validation);
        $this->form_validation->set_rules('mdp','Mot de passe','required|max_length[100]');
        $this->form_validation->set_rules('confirmMdp','Confirmez votre mot de passe',"required|max_length[100]|callback_password_check");
        $this->form_validation->set_rules('g-recaptcha-response','Captcha','callback_recaptcha_check');
        if ($this->form_validation->run()) {
            $email=$this->input->post('login');
            $pass=$this->input->post('mdp');
            $idAuth=$this->aauth->create_user($email,$pass);
            $params = array(
                'nom'=>$this->input->post('nom'),
                'prenom'=> $this->input->post('prenom'),
                'login'=> $this->input->post('login'),
                'id'=>$idAuth
            );
            $this->EnseignantModel->add_enseignant($params);
            $this->aauth->add_member($this->aauth->get_user_id($email),'Enseignant');
            $this->attente_confirmation($email);
        }
        else{
            $this->load->view('AppHeader');
            $this->load->view('AccountCreate');
            $this->load->view('AppFooter');
        }
    }
    
    public function password_check(){
        $password=$this->input->post('mdp');
        $passwordConfirmation=$this->input->post('confirmMdp');
        if ($password != $passwordConfirmation) {
                  $this->form_validation->set_message('password_check','le mot de passe de confirmation est différent du mot de passe initial');
                  return false;
        }
        else {
            return true;
        }
    }
    
    public function attente_confirmation($email){
        $data['title']="Confirmation de votre inscription";
        $data['email']=$email;
        $this->load->view('AppHeader',$data);
        $this->load->view('AccountConfirmation',$data);
        $this->load->view('AppFooter');
    }
    
    public function verification($idAuth,$keyValue){
        $this->aauth->verify_user($idAuth,$keyValue);
        $this->load->view('AppHeader');
        $this->load->view('AccountConfirmation');
        $this->load->view('AppFooter');
    }
}