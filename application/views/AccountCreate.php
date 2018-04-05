<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1> Inscription au rallye lecture</h1>

<?php
    echo validation_errors();
    echo form_open('Account/create');
    
    echo form_label('Nom: ','nom');
    echo form_input('nom',''); ?> <br><?php
    
    echo form_label('Prenom: ','prenom'); 
    echo form_input('prenom',''); ?> <br><?php
    
    echo form_label('Votre email: ','login'); 
    echo form_input('login',''); ?> <br><?php
    
    echo form_label('Mot de passe: ','mdp');
    echo form_input('mdp',''); ?> <br><?php
    
    echo form_label('Confirmez votre mot de passe: ','confirmMdp'); 
    echo form_input('confirmMdp',''); ?> <br><?php
    
    echo $this->aauth->generate_recaptcha_field();
    
    echo form_submit('creer','Créer votre compte'); ?> <br><?php
    echo form_close();
?>

