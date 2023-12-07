<?php

/**
 * Fonction qui affiche la page d'accueil du directeur
 * Ne prend pas de paramètres et ne retourne rien
 * @return void
 */
function vueDisplayHomeDirecteur($stat){
    $content="";
    require_once('gabaritDirecteurHomePage.php');
}

/**
 * Fonction qui affiche la page d'accueil du conseiller
 * Ne prend pas de paramètres et ne retourne rien
 * @return void
 */
function vueDisplayHomeConseiller(){
    $content="";
    require_once('gabaritConseillerHomePage.php');
}
/**
 * Fonction qui affiche la page d'accueil de l'agent d'accueil
 * Ne retourne rien
 * @param array $appointements liste des Rendez Vous de la semaine
 * @param array $TA liste des tâches admins de la semaine
 * @param string $dateOfWeek string de la date de reference de la semaine, 
 * @param string $username nom de l'Agent
 * par défaut aujourd'hui, format "yyyy-mm-dd";
 */
function vueDisplayHomeAgent($appointments, $TA, $dateOfWeek, $username) {
    $weekEvents = array("", "", "", "", "", "", "");
    // $weekEvents represente pour chaque entrée de 0 à 6, en chaine de caracteres, les eventHTML du jour correspondant
    foreach ($appointments as $appointment) {
        $appointmentDate = date_create_from_format("Y-m-d H:i:s", $appointment->HORAIRE);
        $weekNumber = date_format($appointmentDate, "N");
        $weekEvents[$weekNumber -1] .= vueGenerateAppointementHTML($appointment);
    }
    debug($username);
    require_once('gabaritAgentHomePage.php');
}
/**  */ 
function vueGenerateAppointementHTML($appointment) {
    $heureDebut = (substr($appointment->HORAIRE, 11, 5));
    $heureFin = (substr($appointment->HORAIRE, 11, 5)); // TODO ADD THE F*CKING END TIME IN THE DB.
    // TODO : AND THE COLOR OF THE CONSEILLER
    return '<div class="event" data-conseiller="'. $appointment->identiteEmploye .'" dataset-color="'. 'lush-green' .'">
        <h2>'. $appointment->INTITULE .'</h2>
        <p>'. $appointment->identiteClient .'</p>
        <div class="eventDetails">
            <div>
                <p class="eventStartTime">'. $heureDebut .'</p>
                <p class="eventEndTime">'. $heureFin .'</p>
            </div>
            <div class="eventConseiller lush-green">
                <i class="fa-solid fa-user-tie"></i>
                '. $appointment->identiteEmploye .'
            </div>
        </div>
    </div>';
}

/**
 * Fonction qui affiche la page de login
 * Ne prend pas de paramètres et ne retourne rien
 */
function vueDisplayLogin(){
    $content="";
    require_once('gabaritLanding.php');
}


/**
 * Fonction qui affiche la page du client
 * Ne retourne rien
 * @param string $client c'est les données du client
 */
function vueDisplayInfoClient($client, $listAccounts, $listContract){

    // pour faire le select pour le débit / crédit
    $optionSelect = "";
    $listA="";
    foreach ($listAccounts as $account) {
        $optionSelect .= "<option value=\"".$account->idCompte."\">".$account->intitule."</option>";
        $listA .= "<p>".$account->intitule." : ".$account->solde."€</p>";
    }
    $listC="";
    foreach ($listContract as $contract) {
        $listC .= "<p>".$contract->intitule." : ".$contract->tarifmensuel."€</p>";
    }

    // pour faire la synthèse
    $idClient = $client->IDCLIENT;
    $nameConseiller = $client->NOMCONSEILLER." ".$client->PRENOMCONSEILLER;
    $nameClient = $client->NOM;
    $naissance = $client->DATENAISSANCE;
    $creation = $client->DATECREATION;
    $firstNameClient = $client->PRENOM;
    $addressClient = $client->ADRESSE;
    $phoneClient = $client->NUMTEL;
    $emailClient = $client->EMAIL;
    $profession = $client->PROFESSION;
    $situation = $client->SITUATIONFAMILIALE;
    $civi = $client->CIVILITEE;
    require_once('gabaritInfoClient.php');
}
/**
 * Fonction qui affiche la page de resultat de recherche d'un client
 * Ne retourne rien
 * @param array $listClient c'est la liste des clients
 * @param string $link c'est le lien pour la synthèse
 */
function vueDisplayAdvanceSearchClient($listClient="") {
    
    if ($listClient == "") {
        $content = "";
    }
    else{
        $content="<form action=\"index.php\" method=\"post\"><table>";
        foreach ($listClient as $client) {
            $content="<form action=\"index.php\" method=\"post\">";
            $content .= "<input type=\"number\" name=\"idClient\" value=\"".$client->idClient."\" class=\"hidden\">";
            $content .= "<tr>
                            <td name=\"idClient\">".$client->idClient."</td>
                            <td>".$client->nom."</td><td>".$client->prenom."</td>
                            <td>".$client->dateNaissance."</td>
                            <td><input type=\"submit\" name=\"infoClientFromAdvancedBtn\" value=\"Synthèse\"></td>
                        </tr>";
            $content .= "</form>";
        }
        $content .= "</table>";
    }
    require_once('gabaritRechercheClient.php');
}

function vueDisplayGestionPersonnel($listEmployee,$mode= 'display') {
    if ($mode == 'display') {
        $content="";
        foreach ($listEmployee as $employee) {
            if ($employee->IDCATEGORIE == 1) {
                $category = "Directeur";
            }
            elseif ($employee->IDCATEGORIE == 2) {
                $category = "Conseiller";
            }
            elseif ($employee->IDCATEGORIE == 3) {
                $category = "Agent d'acceuil";
            }
            
            $content .= "<form action=\"index.php\" method=\"post\">
                            <p>
                                Id de l'employe : ".$employee->IDEMPLOYE.", 
                                Type d'employe : ".$category.", 
                                Nom de l'employé : ".$employee->NOM.", 
                                Prénom de l'employé : ".$employee->PRENOM.",  
                                Login de l'employé : ".$employee->LOGIN." 
                                <input type=\"hidden\" name=\"idEmployee\" value=\"".$employee->IDEMPLOYE ."\">
                                <input type=\"submit\" value=\"Modifier l'employe.\" name=\"modfiEmployeeBtn\">
                            </p>
                        </form>";
        }
    }
    else{
        $etat1=$listEmployee->IDCATEGORIE==1 ? "selected": "";
        $etat2=$listEmployee->IDCATEGORIE==2 ? "selected": "";
        $etat3=$listEmployee->IDCATEGORIE==3 ? "selected": "";
        $content="<h1>Modifier info employé</h1>
                    <form action=\"index.php\" method=\"post\">
                        <p>
                            <select name=\"idCategorie\" >
                                <option value=\"1\" ".$etat1." >Directeur</option>
                                <option value=\"2\" ".$etat2." >Conseiller</option>
                                <option value=\"3\" ".$etat3." >Agent d'acceuil</option>
                            </select>
                            <input type=\"text\" name=\"nameEmployee\" value=\"$listEmployee->NOM\">
                            <input type=\"text\" name=\"firstNameEmployee\" value=\"$listEmployee->PRENOM\">
                            <input type=\"text\" name=\"loginEmployee\" value=\"$listEmployee->LOGIN\">
                            <input type=\"text\" name=\"passwordEmployee\" value=\"$listEmployee->PASSWORD\">
                            <input type=\"submit\" value=\"Valider modification\">
                        </p>
                    </form>";
    }
    require_once('gabaritGestionPersonnel.php');

}






/**
 * Fonction qui affiche la page d'erreur
 * Ne retourne rien
 * @param string $error
 */
function vueDisplayError ($error) {
    $content = "<p>".$error."</p><p><a href=\"index.php\"/> Revenir au forum </a></p>";
    require_once('gabaritErreur.php');
}


function vueDisplayAgendaConseiller($appointment, $admin){
    $bla = json_encode($appointment);
    echo json_encode($admin);
    require_once('gabaritAgentHomePage.php');
}
