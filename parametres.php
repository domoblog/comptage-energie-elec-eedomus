<?php
/*************************************************************************************/
/*                ### parametres Report electricit� eedomus SQL ###                  */
/*                                                                                   */
/*                   Developpement par Aurel@www.domo-blog.fr                        */
/*                                                                                   */
/*************************************************************************************/
 
//*************************************** API eedomus *********************************
// Identifiants de l'API eeDomus
$api_user = "xxxxx"; //ici saisir api user
$api_secret = "xxxxxxxxxxxxx";  //ici saisir api secret

//*************************************** Parametres network **************************
//@IP eedomus
$IPeedomus="192.168.x.x"; //ici saisir ip eedomus
//server MySQL
$server='localhost';
//MySQL login
$sqllogin='xxxxxx'; //ici saisir le user sql de phpmyadmin
//MySQL password
$sqlpass='xxxxxxx'; //ici saisir le pass du user phpmyadmin


//*************************************** codes api couts elec *************************
//numero du peripherique relev� hebdo
$periph_hebdo=11111;
//numero du peripherique relev� mensuel
$periph_mensuel=11111;
//numero du peripherique relev� annuel
$periph_annuel=11111;

//*************************************** codes api kWh elec ***************************
//hebdo kWh
$periph_annuel=11111;
//hebdo kWh
$periph_hebdokwh=11111;
//mensuel kWh
$periph_mensuelkwh=11111;
//annuel kWh
$periph_annuelkwh=11111;

//*************************************** codes api relev� elec *************************
//numero du peripherique de relev� electrique
$periph_rlv_elec=11111;


//tarif du kWh
$prix_kwh=0.1329;
?>