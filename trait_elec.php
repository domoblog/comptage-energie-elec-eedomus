<?php
/*************************************************************************************/
/*                 ### Report electricité eedomus SQL V2.0 ###                       */
/*                                                                                   */
/*                       Developpement par Aurel@domo-blog.fr                        */
/*                                                                                   */
/*************************************************************************************/

include ('parametres.php');

//-----------------------suppression des enregitrements erronés---------------------
//Connexion a MySQL
mysql_connect($server, $sqllogin, $sqlpass) OR die('Erreur de connexion à la base');
//Selection de la base 
mysql_select_db('historique') OR die('Erreur de sélection de la base');  
	//Lance la requette
    $requete = mysql_query('DELETE FROM electricite WHERE conso > 5') OR die('Erreur de la requête MySQL'); 

//-----------------------calcul de la conso hebdo--------------------------
//Connexion a MySQL
mysql_connect($server, $sqllogin, $sqlpass) OR die('Erreur de connexion à la base');
//Selection de la base 
mysql_select_db('historique') OR die('Erreur de sélection de la base');  
	//Lance la requette
    $requete = mysql_query('SELECT SUM(conso) FROM electricite WHERE WEEK(date) = WEEK(curdate()) AND YEAR(date) = YEAR(curdate())') OR die('Erreur de la requête MySQL'); 
	//On récupère les données
	     while($resultat = mysql_fetch_row($requete))  
     {  
		$consohebdo = $resultat[0];
	 }
	 
//-----------------------calcul de la conso mensuelle--------------------------
//Connexion a MySQL
mysql_connect($server, $sqllogin, $sqlpass) OR die('Erreur de connexion à la base');
//Selection de la base 
mysql_select_db('historique') OR die('Erreur de sélection de la base');  
	//Lance la requette
    $requete = mysql_query('SELECT SUM(conso) FROM electricite WHERE MONTH(date) = MONTH(curdate()) AND YEAR(date) = YEAR(curdate())') OR die('Erreur de la requête MySQL'); 
	//On récupère les données
	     while($resultat = mysql_fetch_row($requete))  
     {  
		$consomensuelle = $resultat[0];
	 }
	 
// on ferme la connexion à mysql
mysql_close();

//-----------------------calcul de la conso annuel--------------------------
//Connexion a MySQL
mysql_connect($server, $sqllogin, $sqlpass) OR die('Erreur de connexion à la base');
//Selection de la base 
mysql_select_db('historique') OR die('Erreur de sélection de la base');  
	//Lance la requette
    $requete = mysql_query('SELECT SUM(conso) FROM electricite WHERE YEAR(date) = YEAR(curdate())') OR die('Erreur de la requête MySQL'); 
	//On récupère les données
	     while($resultat = mysql_fetch_row($requete))  
     {  
		$consoannuelle = $resultat[0];
	 }
	 
// on ferme la connexion à mysql
mysql_close();


// conversion en kWh
$consohebdokwh = ($consohebdo / $prix_kwh);
$consomensuellekwh = ($consomensuelle / $prix_kwh);
$consoannuellekwh = ($consoannuelle / $prix_kwh);




//******************************************** Update conso hebdo***********************************************
// construction de l'URL de l'API
$url = "http://$IPeedomus/api/set?action=periph.value";
$url .= "&api_user=$api_user";
$url .= "&api_secret=$api_secret";
$url .= "&periph_id=$periph_hebdo";
$url .= "&value=$consohebdo";

// appel de l'API
$result = file_get_contents($url);

// on controle le résultat
if (strpos($result, '"success": 1') == false)
{
  echo "Une erreur est survenue sur l'update hebdo: [".$result."]";
}
else
{
 echo "update hebdo ok<br/>";
}

//******************************************** Update conso mensuelle***********************************************
// construction de l'URL de l'API
$url = "http://$IPeedomus/api/set?action=periph.value";
$url .= "&api_user=$api_user";
$url .= "&api_secret=$api_secret";
$url .= "&periph_id=$periph_mensuel";
$url .= "&value=$consomensuelle";

// appel de l'API
$result = file_get_contents($url);

// on controle le résultat
if (strpos($result, '"success": 1') == false)
{
  echo "Une erreur est survenue sur l'update mensuel: [".$result."]";
}
else
{
 echo "update mensuel ok<br/>";
}

//******************************************** Update conso annuelle***********************************************
// construction de l'URL de l'API
$url = "http://$IPeedomus/api/set?action=periph.value";
$url .= "&api_user=$api_user";
$url .= "&api_secret=$api_secret";
$url .= "&periph_id=$periph_annuel";
$url .= "&value=$consoannuelle";

// appel de l'API
$result = file_get_contents($url);

// on controle le résultat
if (strpos($result, '"success": 1') == false)
{
  echo "Une erreur est survenue sur l'update annuel: [".$result."]";
}
else
{
 echo "update annuel ok<br/>";
}

//******************************************** Update conso hebdo kWh***********************************************
// construction de l'URL de l'API
$url = "http://$IPeedomus/api/set?action=periph.value";
$url .= "&api_user=$api_user";
$url .= "&api_secret=$api_secret";
$url .= "&periph_id=$periph_hebdokwh";
$url .= "&value=$consohebdokwh";

// appel de l'API
$result = file_get_contents($url);

// on controle le résultat
if (strpos($result, '"success": 1') == false)
{
  echo "Une erreur est survenue sur l'update kwh hebdo: [".$result."]";
}
else
{
 echo "update kWh hebdo ok<br/>";
}

//******************************************** Update conso mensuelle kWh***********************************************
// construction de l'URL de l'API
$url = "http://$IPeedomus/api/set?action=periph.value";
$url .= "&api_user=$api_user";
$url .= "&api_secret=$api_secret";
$url .= "&periph_id=$periph_mensuelkwh";
$url .= "&value=$consomensuellekwh";

// appel de l'API
$result = file_get_contents($url);

// on controle le résultat
if (strpos($result, '"success": 1') == false)
{
  echo "Une erreur est survenue sur l'update kwh mensuel: [".$result."]";
}
else
{
 echo "update kWh mensuel ok<br/>";
}

//******************************************** Update conso annuelle kWh***********************************************
// construction de l'URL de l'API
$url = "http://$IPeedomus/api/set?action=periph.value";
$url .= "&api_user=$api_user";
$url .= "&api_secret=$api_secret";
$url .= "&periph_id=$periph_annuelkwh";
$url .= "&value=$consoannuellekwh";

// appel de l'API
$result = file_get_contents($url);

// on controle le résultat
if (strpos($result, '"success": 1') == false)
{
  echo "Une erreur est survenue sur l'update kwh annuel: [".$result."]";
}
else
{
 echo "update kWh annuel ok";
}

?>