<?php
require_once('modele/token.php');
require_once('token.php');

/**
 * renvoie le salt correspondant au login passé en paramètre, 
 * rien si ce login n'est pas présent dans la base de données.
 * @param string $login le login de l'employé
 * @return string le salt de l'employé
 */
function modGetSalt($login) {
    $connection = Connection::getInstance()->getConnection();
    $query = $connection -> prepare("SELECT salt FROM employe WHERE login=:logi");
    $prepared = $connection->prepare($query);
    $prepared -> bindParam(":logi", $login, PDO::PARAM_STR);
    $prepared -> execute();
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result = $prepared -> fetch();
    $prepared -> closeCursor();
    return $result->salt;
}

/**
 * renvoie toutes les infos de l'employé dont le login et password sont en paramètres,
 * rien si celui-ci n'est pas présent dans la base de données.
 * @param string $login le login de l'employé
 * @param string $password le password salé de l'employé
 * @return object les infos de l'employé (IDEMPLOYE, IDCATEGORIE, NOM, PRENOM, LOGIN, PASSWORD, COLOR, SALT)
 */
function modConnect($login, $password) {
    $connection = Connection::getInstance()->getConnection();
    $query = 'SELECT * FROM employe WHERE login=:logi AND password=:pass';
    $prepared = $connection->prepare($query);
    $prepared -> bindParam(':logi',$login,PDO::PARAM_STR);
    $prepared -> bindParam(':pass',$password,PDO::PARAM_STR);
    $prepared -> execute();
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result = $prepared -> fetch();
    $prepared -> closeCursor();
    return $result;
}

/**
 * renvoie toutes les infos du client dont l'id est en paramètre, 
 * rien si il n'est pas présent dans la base de données.
 * @param int $idClient l'id du client
 * @return object les infos du client (IDCLIENT, NOM, PRENOM, DATENAISSANCE, DATECREATION, ADRESSE, NUMTEL, EMAIL, PROFESSION, SITUATIONFAMILIALE, CIVILITEE, NOMCONSEILLER, PRENOMCONSEILLER)
 */
function modGetClientFromId($idClient) {
    $connection = Connection::getInstance()->getConnection();
    $query = 'SELECT IDCLIENT, client.NOM, client.PRENOM, DATENAISSANCE, DATECREATION, ADRESSE, NUMTEL, EMAIL, PROFESSION, SITUATIONFAMILIALE, CIVILITEE, employe.NOM AS NOMCONSEILLER, employe.PRENOM AS PRENOMCONSEILLER FROM client JOIN employe ON client.IDEMPLOYE=employe.IDEMPLOYE WHERE idClient=:idC';
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':idC', $idClient, PDO::PARAM_INT);
    $prepared -> execute();
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result = $prepared -> fetch();
    $prepared -> closeCursor();
    return $result;
}

/**
 * renvoie tous les comptes du client dont l'id est en paramètre,
 * rien si il n'est pas présent dans la base de données.
 * @param int $idClient l'id du client
 * @return array les comptes du client (IDCOMPTE, NOM, SOLDE, DECOUVERT, DATECREATION) (tableau d'objets)
 */
function modGetAccounts($idClient) {
    $connection = Connection::getInstance()->getConnection();
    $query = 'SELECT compte.idCompte,typecompte.NOM,solde,decouvert,datecreation FROM compte LEFT JOIN possedeCompte ON compte.idCompte=possedeCompte.idCompte NATURAL JOIN typecompte WHERE idClient=:idC';
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam('idC', $idClient, PDO::PARAM_INT);
    $prepared -> execute();
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result = $prepared -> fetchAll();
    $prepared -> closeCursor();
    return $result;
}

/**
 * renvoie l'id de la catégorie à laquelle appartient l'employé dont l'id est en paramètre,
 * rien si il n'est pas présent dans la base de données.
 * @param string $id l'id de l'employé
 * @return int l'id de la catégorie de l'employé
 */
function modGetTypeStaff($id) {
    $connection = Connection::getInstance()->getConnection();
    $query = 'SELECT idCategorie FROM employe WHERE idEmploye=:id';
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':id', $id, PDO::PARAM_STR);
    $prepared -> execute();
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result = $prepared -> fetch();
    $prepared -> closeCursor();
    return $result->idCategorie;
}

/**
 * renvoie l'id, le nom, le prénom et la date de naissance de tous les clients correspondants aux critères en paramètres,
 * rien si il n'est pas présent dans la base de données.
 * @param string $sname le nom du client
 * @param string $fname le prénom du client
 * @param string $bdate la date de naissance du client
 * @return array les clients correspondants aux critères (IDCLIENT, NOM, PRENOM, DATENAISSANCE) (tableau d'objets)
 */
function modAdvancedSearchClientABC($sname,$fname,$bdate) {
    $connection = Connection::getInstance()->getConnection();
    $query = 'SELECT idClient, nom, prenom, dateNaissance FROM client WHERE nom=:sname AND prenom=:fname AND dateNaissance=:bdate';
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':sname', $sname, PDO::PARAM_STR);
    $prepared -> bindParam(':fname', $fname, PDO::PARAM_STR);
    $prepared -> bindParam(':bdate', $bdate, PDO::PARAM_STR);
    $prepared -> execute();
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result = $prepared -> fetchAll();
    $prepared -> closeCursor();
    return $result;
}

/**
 * renvoie l'id, le nom, le prénom et la date de naissance de tous les clients correspondants aux critères en paramètres,
 * rien si il n'est pas présent dans la base de données.
 * @param string $sname le nom du client
 * @param string $fname le prénom du client
 * @return array les clients correspondants aux critères (IDCLIENT, NOM, PRENOM, DATENAISSANCE) (tableau d'objets)
 */
function modAdvancedSearchClientAB($sname,$fname) {
    $connection = Connection::getInstance()->getConnection();
    $query = 'SELECT idClient,nom,prenom,dateNaissance FROM client WHERE nom=:sname AND prenom=:fname';
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':sname', $sname, PDO::PARAM_STR);
    $prepared -> bindParam(':fname', $fname, PDO::PARAM_STR);
    $prepared -> execute();
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result = $prepared -> fetchAll();
    $prepared -> closeCursor();
    return $result;
}

/**
 * renvoie l'id, le nom, le prénom et la date de naissance de tous les clients correspondants aux critères en paramètres,
 * rien si il n'est pas présent dans la base de données.
 * @param string $fname le prénom du client
 * @param string $bdate la date de naissance du client
 * @return array les clients correspondants aux critères (IDCLIENT, NOM, PRENOM, DATENAISSANCE) (tableau d'objets)
 */
function modAdvancedSearchClientBC($fname,$bdate) {
    $connection = Connection::getInstance()->getConnection();
    $query = 'SELECT idClient,nom,prenom,dateNaissance FROM client WHERE prenom=:fname AND dateNaissance=:bdate';
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':fname', $fname, PDO::PARAM_STR);
    $prepared -> bindParam(':bdate', $bdate, PDO::PARAM_STR);
    $prepared -> execute();
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result = $prepared -> fetchAll();
    $prepared -> closeCursor();
    return $result;
}

/**
 * renvoie l'id, le nom, le prénom et la date de naissance de tous les clients correspondants aux critères en paramètres,
 * rien si il n'est pas présent dans la base de données.
 * @param string $sname le nom du client
 * @param string $bdate la date de naissance du client
 * @return array les clients correspondants aux critères (IDCLIENT, NOM, PRENOM, DATENAISSANCE) (tableau d'objets)
 */
function modAdvancedSearchClientAC($sname,$bdate) {
    $connection = Connection::getInstance()->getConnection();
    $query = 'SELECT idClient,nom,prenom,dateNaissance FROM client WHERE nom=:sname AND dateNaissance=:bdate';
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':sname', $sname, PDO::PARAM_STR);
    $prepared -> bindParam(':bdate', $bdate, PDO::PARAM_STR);
    $prepared -> execute();
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result = $prepared -> fetchAll();
    $prepared -> closeCursor();
    return $result;
}

/**
 * renvoie l'id, le nom, le prénom et la date de naissance de tous les clients correspondants aux critères en paramètres,
 * rien si il n'est pas présent dans la base de données.
 * @param string $sname le nom du client
 * @return array les clients correspondants aux critères (IDCLIENT, NOM, PRENOM, DATENAISSANCE) (tableau d'objets)
 */
function modAdvancedSearchClientA($sname) {
    $connection = Connection::getInstance()->getConnection();
    $query = 'SELECT idClient,nom,prenom,dateNaissance FROM client WHERE nom=:sname';
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':sname', $sname, PDO::PARAM_STR);
    $prepared -> execute();
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result = $prepared -> fetchAll();
    $prepared -> closeCursor();
    return $result;
}

/**
 * renvoie l'id, le nom, le prénom et la date de naissance de tous les clients correspondants aux critères en paramètres,
 * rien si il n'est pas présent dans la base de données.
 * @param string $fname le prénom du client
 * @return array les clients correspondants aux critères (IDCLIENT, NOM, PRENOM, DATENAISSANCE) (tableau d'objets)
 */
function modAdvancedSearchClientB($fname) {
    $connection = Connection::getInstance()->getConnection();
    $query = 'SELECT idClient,nom,prenom,dateNaissance FROM client WHERE prenom=:fname';
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':fname', $fname, PDO::PARAM_STR);
    $prepared -> execute();
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result = $prepared -> fetchAll();
    $prepared -> closeCursor();
    return $result;
}

/**
 * renvoie l'id, le nom, le prénom et la date de naissance de tous les clients correspondants aux critères en paramètres,
 * rien si il n'est pas présent dans la base de données.
 * @param string $bdate la date de naissance du client
 * @return array les clients correspondants aux critères (IDCLIENT, NOM, PRENOM, DATENAISSANCE) (tableau d'objets)
 */
function modAdvancedSearchClientC($bdate) {
    $connection = Connection::getInstance()->getConnection();
    $query = 'SELECT idClient,nom,prenom,dateNaissance FROM client WHERE dateNaissance=:bdate';
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':bdate', $bdate, PDO::PARAM_STR);
    $prepared -> execute();
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result = $prepared -> fetchAll();
    $prepared -> closeCursor();
    return $result;
}

/**
 * renvoie l'id du RDV, celui du motif, celui du client et celui de l'employé et l'horaire (début et fin) de tous les RDV de l'employé dont l'id est en paramètre,
 * rien si il n'est pas présent dans la base de données.
 * @param string $id l'id de l'employé
 * @return array les RDV de l'employé (IDRDV, IDMOTIF, IDCLIENT, IDEMPLOYE, HORAIREDEBUT, HORAIREFIN) (tableau d'objets)
 */
function modGetAppointmentConseiller($id) {
    $connection = Connection::getInstance()->getConnection();
    $query = 'SELECT idRDV,idMotif,idClient,idEmploye,horairedebut, horairefin FROM rdv NATURAL JOIN employe WHERE idEmploye=:id';
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':id', $id, PDO::PARAM_STR);
    $prepared -> execute();
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result = $prepared -> fetchAll();
    $prepared -> closeCursor();
    return $result;
}

/**
 * renvoie id de la tache admin, l'horaire (début et fin) et le libelle de toutes les taches admin de l'employé dont l'id est en paramètre,
 * rien si il n'est pas présent dans la base de données.
 * @param string $id l'id de l'employé
 * @return array les taches admin de l'employé (IDTA, HORAIREDEBUT, HORAIREFIN, LIBELLE) (tableau d'objets)
 */
function modGetAdminConseiller($id) {
    $connection = Connection::getInstance()->getConnection();
    $query = 'SELECT idTa, horairedebut, horairefin, libelle FROM tacheadmin NATURAL JOIN employe WHERE idEmploye=:id';
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':id', $id, PDO::PARAM_STR);
    $prepared -> execute();
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result = $prepared -> fetchAll();
    $prepared -> closeCursor();
    return $result;
}

/**
 * débite le compte dont l'id est en paramètre de la somme (positive) en paramètre
 * @param int $idA id du compte à débiter
 * @param string $sum la somme à débiter
 * @param string $date la date de l'opération
 * @return void
 */
function modDebit($idA,$sum,$date) {
    $connection = Connection::getInstance()->getConnection();
    $query = "UPDATE Compte SET solde=solde-:sum WHERE idCompte=:idA;
                INSERT INTO `operation`(`IDCOMPTE`, `SOURCE`, `LIBELLE`, `DATEOPERATION`, `MONTANT`, `ISCREDIT`) VALUES (:idA,'Banque','Debit',:date,:sum,0)";
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':sum', $sum, PDO::PARAM_STR);
    $prepared -> bindParam(':idA', $idA, PDO::PARAM_INT);
    $prepared -> bindParam(':date', $date, PDO::PARAM_STR);
    $prepared -> execute();
    $prepared -> closeCursor();
}

/**
 * crédite le compte dont l'id est en paramètre de la somme en paramètre 
 * @param int $idA id du compte à créditer
 * @param string $sum somme à créditer
 * @param string $date date de l'opération
 * @return void
 */
function modCredit($idA,$sum,$date) {
    $connection = Connection::getInstance()->getConnection();
    $query = "UPDATE Compte SET solde=solde+:sum WHERE idCompte=:idA;
                INSERT INTO `operation`(`IDCOMPTE`, `SOURCE`, `LIBELLE`, `DATEOPERATION`, `MONTANT`, `ISCREDIT`) VALUES (:idA,'Banque','Crédit',:date,:sum,1)";
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':idA', $idA, PDO::PARAM_INT);
    $prepared -> bindParam(':sum', $sum, PDO::PARAM_STR);
    $prepared -> bindParam(':date', $date, PDO::PARAM_STR);
    $prepared -> execute();
    $prepared -> closeCursor();
}

/**
 * renvoie le découvert du compte dont l'id est en paramètre,
 * rien si il n'est pas présent dans la base de données.
 * @param int $idA l'id du compte
 * @return string le découvert du compte
 */
function modGetDecouvert($idA) {
    $connection = Connection::getInstance()->getConnection();
    $query = 'SELECT decouvert FROM Compte WHERE idCompte=:idA';
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':idA', $idA, PDO::PARAM_INT);
    $prepared -> execute();
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result = $prepared -> fetch();
    $prepared -> closeCursor();
    return $result->decouvert;
}

/**
 * renvoie d'id du client à qui appartient le compte dont l'id est en paramètre,
 * rien si il n'est pas présent dans la base de données.
 * @param int $idAccount l'id du compte
 * @return int l'id du client
 */
function modGetIdClientFromAccount($idAccount){
    $connection = Connection::getInstance()->getConnection();
    $query = 'SELECT idClient FROM possedeCompte WHERE idCompte=:idA';
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':idA', $idAccount, PDO::PARAM_INT);
    $prepared -> execute();
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result = $prepared -> fetch();
    $prepared -> closeCursor();
    return $result->idClient;
}

/**
 * renvoie le solde du compte dont l'id est en paramètre,
 * rien si il n'est pas présent dans la base de données.
 * @param int $idA l'id du compte
 * @return string le solde du compte
 */
function modGetSolde($idA) {
    $connection = Connection::getInstance()->getConnection();
    $query = 'SELECT solde FROM Compte WHERE idCompte=:idA';
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':idA', $idA, PDO::PARAM_INT);
    $prepared -> execute();
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result = $prepared -> fetch();
    $prepared -> closeCursor();
    return $result->solde;
}
/**
 * renvoie la somme des soldes de tous les comptes
 * @return string la somme des soldes de tous les comptes
 */
function modSumAllSolde() {
    $connection = Connection::getInstance()->getConnection();
    $query = 'SELECT SUM(solde) AS somme FROM Compte';
    $prepared = $connection -> query($query);
    $prepared -> execute();
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result = $prepared -> fetch();
    $prepared -> closeCursor();
    return $result->somme;
}


/**
 * renvoie tous les contrats du client dont l'id est en paramètre,
 * rien si il n'est pas présent dans la base de données.
 * @param int $idClient l'id du client
 * @return array les contrats du client (IDCONTRAT, IDTYPECONTRAT, TARIFMENSUEL, DATEOUVERTURE) (tableau d'objets)
 */
function modGetContracts($idClient) {
    $connection = Connection::getInstance()->getConnection();
    $query = 'SELECT contrat.idContrat,idTypeContrat,tarifmensuel,dateouverture FROM contrat LEFT JOIN possedeContrat ON contrat.idContrat=possedeContrat.idContrat WHERE idClient=:idC';
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam('idC', $idClient, PDO::PARAM_INT);
    $prepared -> execute();
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result = $prepared -> fetchAll();
    $prepared -> closeCursor();
    return $result;
}

/**
 * renvoie le nombre de contrats
 * @return int le nombre de contrats
 */
function modGetNumberContracts() {
    $connection = Connection::getInstance()->getConnection();
    $query = 'SELECT COUNT(*) AS nbContracts FROM contrat';
    $prepared = $connection -> query($query);
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result = $prepared -> fetch();
    $prepared -> closeCursor();
    return $result->nbContracts;
}

/**
 * renvoie le nombre de comptes
 * @return int le nombre de comptes
 */
function modGetNumberAccounts() {
    $connection = Connection::getInstance()->getConnection();
    $query = 'SELECT COUNT(*) AS nbAccounts FROM compte';
    $prepared = $connection -> query($query);
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result = $prepared -> fetch();
    $prepared -> closeCursor();
    return $result->nbAccounts;
}


/**
 * renvoie l'intitule du motif dont l'id est en paramètre,
 * rien si il n'est pas présent dans la base de données.
 * @param int $id l'id du motif
 * @return string l'intitule du motif
 */
function modGetIntituleMotif($id) {
    $connection = Connection::getInstance()->getConnection();
    $query = 'SELECT intitule FROM Motif WHERE idMotif=:id';
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':id', $id, PDO::PARAM_INT);
    $prepared -> execute();
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result = $prepared -> fetch();
    $prepared -> closeCursor();
    return $result->intitule;
}

/**
 * renvoie toutes les infos de l'employé dont l'id est en paramètre,
 * rien si il n'est pas présent dans la base de données
 * @param string $id l'id de l'employé
 * @return object les infos de l'employé (IDEMPLOYE, IDCATEGORIE, NOM, PRENOM, LOGIN, PASSWORD, COLOR, SALT)
 */
function modGetEmployeFromId($id) {
    $connection = Connection::getInstance()->getConnection();
    $query = 'SELECT * FROM employe WHERE idEmploye=:id';
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':id', $id, PDO::PARAM_STR);
    $prepared -> execute();
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result = $prepared -> fetch();
    $prepared -> closeCursor();
    return $result;
}

/**
 * renvoie toutes les infos de tous les employés
 * @return array toutes les infos de tous les employés (IDEMPLOYE, IDCATEGORIE, NOM, PRENOM, LOGIN, PASSWORD, COLOR, SALT) (tableau d'objets)
 */
function modGetAllEmployes() {
    $connection = Connection::getInstance()->getConnection();
    $query = 'SELECT * FROM employe';
    $prepared = $connection -> query($query);
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result = $prepared -> fetchAll();
    $prepared -> closeCursor();
    return $result;
}

/**
 * renvoie le nombre de clients
 * @return int le nombre de clients
 */
function modGetNumberClients() {
    $connection = Connection::getInstance()->getConnection();
    $query = 'SELECT COUNT(*) AS nbClients FROM client';
    $prepared = $connection -> query($query);
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result = $prepared -> fetch();
    $prepared -> closeCursor();
    return $result->nbClients;
}

/**
 * renvoie le nombre de conseillers
 * @return int le nombre de conseillers
 */
function modGetNumberCounselors() {
    $connection = Connection::getInstance()->getConnection();
    $query = 'SELECT COUNT(*) AS nbCounselors FROM employe WHERE idCategorie=2';
    $prepared = $connection -> query($query);
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result = $prepared -> fetch();
    $prepared -> closeCursor();
    return $result->nbCounselors;
}

/**
 * renvoie le nombre d'agents
 * @return int le nombre d'agents
 */
function modGetNumberAgents() {
    $connection = Connection::getInstance()->getConnection();
    $query = 'SELECT COUNT(*) AS nbAgents FROM employe WHERE idCategorie=3';
    $prepared = $connection -> query($query);
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result = $prepared -> fetch();
    $prepared -> closeCursor();
    return $result->nbAgents;
}

/**
 * renvoie le nombre de types de contrat
 * @return int le nombre de types de contrat
 */
function modGetNumberContractTypes() {
    $connection = Connection::getInstance()->getConnection();
    $query = 'SELECT COUNT(*) AS nbContractTypes FROM typeContrat';
    $prepared = $connection -> query($query);
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result = $prepared -> fetch();
    $prepared -> closeCursor();
    return $result->nbContractTypes;
}

/**
 * renvoie le nombre de types de compte
 * @return int le nombre de types de compte
 */
function modGetNumberAccountTypes() {
    $connection = Connection::getInstance()->getConnection();
    $query = 'SELECT COUNT(*) AS nbAccountTypes FROM typeCompte';
    $prepared = $connection -> query($query);
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result = $prepared -> fetch();
    $prepared -> closeCursor();
    return $result->nbAccountTypes;
}

/**
 * renvoie le nombre de comptes actifs
 * @return int le nombre de comptes actifs
 */
function modGetNumberActiveAccounts() {
    $connection = Connection::getInstance()->getConnection();
    $query = 'SELECT COUNT(*) AS nbActiveAccounts FROM compte WHERE idTypeCompte IN (SELECT idTypeCompte FROM typeCompte WHERE actif=1)';
    $prepared = $connection -> query($query);
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result = $prepared -> fetch();
    $prepared -> closeCursor();
    return $result->nbActiveAccounts;
}

/**
 * renvoie le nombre de comptes inactifs
 * @return int le nombre de comptes inactifs
 */
function modGetNumberInactiveAccounts() {
    $connection = Connection::getInstance()->getConnection();
    $query = 'SELECT COUNT(*) AS nbInactiveAccounts FROM compte WHERE idTypeCompte IN (SELECT idTypeCompte FROM typeCompte WHERE actif=0)';
    $prepared = $connection -> query($query);
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result = $prepared -> fetch();
    $prepared -> closeCursor();
    return $result->nbInactiveAccounts;
}

/**
 * renvoie le nombre de contrats actifs
 * @return int le nombre de contrats actifs
 */
function modGetNumberActiveContracts() {
    $connection = Connection::getInstance()->getConnection();
    $query = 'SELECT COUNT(*) AS nbAciveContracts FROM contrat WHERE idTypeContrat IN (SELECT idTypeContrat FROM typeContrat WHERE actif=1)';
    $prepared = $connection -> query($query);
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result = $prepared -> fetch();
    $prepared -> closeCursor();
    return $result->nbActiveContracts;
}

/**
 * renvoie le nombre de contrats inactifs
 * @return int le nombre de contrats inactifs
 */
function modGetNumberInactiveContracts() {
    $connection = Connection::getInstance()->getConnection();
    $query = 'SELECT COUNT(*) AS nbInactiveContracts FROM contrat WHERE idTypeContrat IN (SELECT idTypeContrat FROM typeContrat WHERE actif=0';
    $prepared = $connection -> query($query);
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result = $prepared -> fetch();
    $prepared -> closeCursor();
    return $result->nbInactiveContracts;
}

/**
 * renvoie le nombre de comptes étant à découvert (dont le solde est négatif)
 * @return int le nombre de comptes étant à découvert
 */
function modGetNumberOverdraftAccounts() {
    $connection = Connection::getInstance()->getConnection();
    $query = 'SELECT COUNT(*) AS nbOverdraftAccounts FROM compte WHERE solde<0';
    $prepared = $connection -> query($query);
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result = $prepared -> fetch();
    $prepared -> closeCursor();
    return $result->nbOverdraftAccounts;
}

/**
 * renvoie le nombre de comptes n'étant pas à découvert (dont le solde est positif ou nul)
 * @return int le nombre de comptes n'étant pas à découvert
 */
function modGetNumberNonOverdraftAccounts() {
    $connection = Connection::getInstance()->getConnection();
    $query = 'SELECT COUNT(*) AS nbNonOverdraftAccounts FROM compte WHERE solde>=0';
    $prepared = $connection -> query($query);
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result = $prepared -> fetch();
    $prepared -> closeCursor();
    return $result->nbNonOverdraftAccounts;
}

/**
 * renvoie toutes les infos de tous les types de compte
 * @return array toutes les infos de tous les types de compte (IDTYPECOMPTE, NOM, ACTIF, DOCUMENT, IDMOTIF) (tableau d'objets)
 */
function modGetAllAccountTypes() {
    $connection = Connection::getInstance()->getConnection();
    $query = 'SELECT * FROM typeCompte NATURAL JOIN motif';
    $prepared = $connection -> query($query);
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result = $prepared -> fetchAll();
    $prepared -> closeCursor();
    return $result;
}

/**
 * renvoie toutes les informations de tous les types de contrat
 * @return array toutes les infos de tous les types de contrat (IDTYPECONTRAT, NOM, ACTIF, DOCUMENT, IDMOTIF) (tableau d'objets)
 */
function modGetAllContractTypes() {
    $connection = Connection::getInstance()->getConnection();
    $query = 'SELECT * FROM typeContrat NATURAL JOIN motif';
    $prepared = $connection -> query($query);
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result = $prepared -> fetchAll();
    $prepared -> closeCursor();
    return $result;
}

/**
 * renvoie toutes les infos du type de compte dont l'id est en paramètre,
 * rien si il n'est pas présent dans la base de données
 * @param int $idTypeAccount l'id du type de compte
 * @return object les infos du type de compte (IDTYPECOMPTE, NOM, ACTIF, DOCUMENT, IDMOTIF)
 */
function modGetTypeAccount($idTypeAccount) {
    $connection = Connection::getInstance()->getConnection();
    $query = 'SELECT * FROM typecompte NATURAL JOIN motif WHERE idtypecompte=:idA';
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':idA', $idTypeAccount, PDO::PARAM_INT);
    $prepared -> execute();
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result = $prepared -> fetch();
    return $result;
}

/**
 * renvoie toutes les infos du type de contrat dont l'id est en paramètre,
 * rien si il n'est pas présent dans la base de données
 * @param int $idContractType l'id du type de contrat
 * @return object les infos du type de contrat (IDTYPECONTRAT, NOM, ACTIF, DOCUMENT, IDMOTIF)
 */
function modGetContractFromId($idContractType) {
    $connection = Connection::getInstance()->getConnection();
    $query = 'SELECT * FROM typecontrat NATURAL JOIN motif WHERE idtypecontrat=:idC';
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':idC', $idContractType, PDO::PARAM_INT);
    $prepared -> execute();
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result = $prepared -> fetch();
    return $result;
}

/**
 * Fonction qui permet de mettre à jour les informations d'un type de compte
 * @param int $idAccount l'id du type de compte
 * @param string $name le nom du type de compte
 * @param int $active 1 si le type de compte est actif, 0 sinon
 * @param string $document le document du type de compte
 * @param int $idMotif l'id du motif du type de compte
 * @return void
 */
function modModifTypeAccount($idAccount, $name, $active, $document, $idMotif){
    $connection = Connection::getInstance()->getConnection();
    $query = 'UPDATE typecompte SET nom=:name, actif=:active WHERE idtypecompte=:idA;
                UPDATE motif SET document=:document WHERE idmotif=:idM';
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':idA', $idAccount, PDO::PARAM_INT);
    $prepared -> bindParam(':name', $name, PDO::PARAM_STR);
    $prepared -> bindParam(':active', $active, PDO::PARAM_INT);
    $prepared -> bindParam(':document', $document, PDO::PARAM_STR);
    $prepared -> bindParam(':idM', $idMotif, PDO::PARAM_INT);
    $prepared -> execute();
    $prepared -> closeCursor();
}

/**
 * Fonction qui permet de mettre à jour les informations d'un type de contrat
 * @param int $idContract l'id du type de contrat
 * @param string $name le nom du type de contrat
 * @param int $active 1 si le type de contrat est actif, 0 sinon
 * @param string $document le document du type de contrat
 * @param int $idMotif l'id du motif du type de contrat
 * @return void
 */
function modModifTypeContract($idContract, $name, $active, $document, $idMotif){
    $connection = Connection::getInstance()->getConnection();
    $query = 'UPDATE typecontrat SET nom=:name, actif=:active WHERE idtypecontrat=:idC;
                UPDATE motif SET document=:document WHERE idmotif=:idM';
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':idC', $idContract, PDO::PARAM_INT);
    $prepared -> bindParam(':name', $name, PDO::PARAM_STR);
    $prepared -> bindParam(':active', $active, PDO::PARAM_INT);
    $prepared -> bindParam(':document', $document, PDO::PARAM_STR);
    $prepared -> bindParam(':idM', $idMotif, PDO::PARAM_INT);
    $prepared -> execute();
    $prepared -> closeCursor();
}




/**
 * renvoie le ou les client(s) dont la somme des soldes des comptes est la plus élevée,
 * @return array le ou les client(s) dont la somme des soldes des comptes est la plus élevée (IDCLIENT, NOM, PRENOM) (tableau d'objets)
 */
function modGetRichestClient() {
    $connection = Connection::getInstance()->getConnection();
    $query = 'CREATE OR REPLACE VIEW totalIndividualWealth(idClient,totalWealth) AS
                SELECT idClient,SUM(solde) 
	            FROM Client NATURAL JOIN PossedeCompte NATURAL JOIN Compte;
            SELECT IDCLIENT, NOM, PRENOM FROM client WHERE idClient IN (SELECT idClient FROM totalInvidualWealth WHERE totalWealth=(SELECT MAX(totalWealth) FROM totalIndividualWealth));';
    $prepared = $connection -> query($query);
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result = $prepared -> fetchAll();
    $prepared -> closeCursor();
    return $result;
}

/**
 * renvoie l'intitulé de la catégorie dont l'id est en paramètre,
 * rien si il n'est pas présent dans la base de données
 * @param int $id l'id de la catégorie
 * @return string l'intitulé de la catégorie
 */
function modGetIntituleCategorie($id) {
    $connection = Connection::getInstance()->getConnection();
    $query = 'SELECT libellecategorie FROM Categorie WHERE idCategorie=:id';
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':id', $id, PDO::PARAM_INT);
    $prepared -> execute();
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result = $prepared -> fetch();
    $prepared -> closeCursor();
    return $result->libellecategorie;
}

/**
 * modifie les nom, prénom, login, password et id de catégorie de l'employé dont l'id est en premier paramètre
 * @param int $idE l'id de l'employé
 * @param string $sname le nom de l'employé
 * @param string $fname le prénom de l'employé
 * @param string $login le login de l'employé
 * @param string $password le password (salé) de l'employé
 * @param int $idCat l'id de la catégorie de l'employé
 * @param string $color la couleur de l'employé
 * @return void
 */
function modModifEmploye($idE, $sname, $fname, $login, $password, $idCat, $color) {
    $connection = Connection::getInstance()->getConnection();
    $query = 'UPDATE employe set nom=:sname, prenom=:fname, login=:login, password=:password, idCategorie=:idCat, color=:color WHERE idEmploye=:idE';
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':idE', $idE, PDO::PARAM_INT);
    $prepared -> bindParam(':sname', $sname, PDO::PARAM_STR);
    $prepared -> bindParam(':fname', $fname, PDO::PARAM_STR);
    $prepared -> bindParam(':login', $login, PDO::PARAM_STR);
    $prepared -> bindParam(':password', $password, PDO::PARAM_STR);
    $prepared -> bindParam(':idCat', $idCat, PDO::PARAM_INT);
    $prepared -> bindParam(':color', $color, PDO::PARAM_STR);
    $prepared -> execute();
    $prepared -> closeCursor();
}

/**
 * renvoie tous les rdv entre la première et la deuxième date mises en paramètres,
 * rien si il n'y en a pas dans la base de données
 * @param string $date1 date de début
 * @param string $date2 date de fin
 * @return array tous les rdv entre la première et la deuxième date mises en paramètres (IDEMPLOYE, IDENTITEEMPLOYE, COLOR, IDCLIENT, IDENTITECLIENT, HORAIREDEBUT, HORAIREFIN, INTITULE) (tableau d'objets
 */
function modGetAllAppoinmentsBetween($date1,$date2) {
    $connection = Connection::getInstance()->getConnection();
    $query = 'SELECT rdv.IDEMPLOYE,
    CONCAT(employe.PRENOM," ", employe.NOM) AS identiteEmploye,
    employe.COLOR,
    rdv.IDCLIENT,
    CONCAT(client.CIVILITEE," ", client.PRENOM," ", client.NOM) AS identiteClient,
    rdv.HORAIREDEBUT,
    rdv.HORAIREFIN,
    motif.INTITULE
    FROM rdv
    JOIN employe ON rdv.IDEMPLOYE=employe.IDEMPLOYE
    JOIN motif ON rdv.IDMOTIF=motif.IDMOTIF
    JOIN client ON rdv.IDCLIENT=client.IDCLIENT WHERE horairedebut>:d1 AND horairedebut<:d2';
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':d1', $date1, PDO::PARAM_STR);
    $prepared -> bindParam(':d2', $date2, PDO::PARAM_STR);
    $prepared -> execute();
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result= $prepared -> fetchAll();
    $prepared -> closeCursor();
    return $result;
}

/**
 * renvoie toutes les ta entre la première et la deuxième date mises en paramètres,
 * rien si il n'y en a pas dans la base de données
 * @param string $date1 date de début
 * @param string $date2 date de fin
 */
function modGetAllAdminBetween($date1,$date2) {
    $connection = Connection::getInstance()->getConnection();
    $query = 'SELECT * FROM tacheAdmin WHERE horaire>:d1 AND horaire<:d2';
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':d1', $date1, PDO::PARAM_STR);
    $prepared -> bindParam(':d2', $date2, PDO::PARAM_STR);
    $prepared -> execute();
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $prepared -> fetchAll();
    $prepared -> closeCursor();
    return $prepared;
}

/**
 * renvoie le nombre de rdv après la date1 mais avant la date2
 * @param string $date1 date de début
 * @param string $date2 date de fin
 */
function modGetNumberAppointmentsBetween($date1,$date2) {
    $connection = Connection::getInstance()->getConnection();
    $query = 'SELECT COUNT(*) AS nbAppointments FROM rdv WHERE horairedebut>:d1 AND horairedebut<:d2';
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':d1', $date1, PDO::PARAM_STR);
    $prepared -> bindParam(':d2', $date2, PDO::PARAM_STR);
    $prepared -> execute();
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result = $prepared -> fetch();
    return $result->nbAppointments;
}


/**
 * renvoie le nombre de contrats souscrit entre la première et la deuxième date mises en paramètres
 * @param string $date1 date de début
 * @param string $date2 date de fin
 * @return int le nombre de contrats souscrit entre la première et la deuxième date mises en paramètres
 */
function modGetNumberContractsBetween($date1,$date2) {
    $connection = Connection::getInstance()->getConnection();
    $query = 'SELECT COUNT(*) AS nbContracts FROM contrat WHERE dateouverture>:d1 AND dateouverture<:d2';
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':d1', $date1, PDO::PARAM_STR);
    $prepared -> bindParam(':d2', $date2, PDO::PARAM_STR);
    $prepared -> execute();
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result = $prepared -> fetch();
    return $result->nbContracts;
}

/**
 * renvoie le nombre de client à une date donnée
 * @param string $date la date
 * @return int le nombre de client à une date donnée
 */
function modGetNumberClientsAt($date){
    $connection = Connection::getInstance()->getConnection();
    $query = 'SELECT COUNT(*) AS nbClients FROM client WHERE datecreation<=:d';
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':d', $date, PDO::PARAM_STR);
    $prepared -> execute();
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result = $prepared -> fetch();
    return $result->nbClients;
}

/**
 * cree un nouveau rdv
 * @param int $idM l'id du motif
 * @param int $idC l'id du client
 * @param int $idE l'id de l'employe
 * @param string $time la date et l'heure 
 */
function modAddAppointment($idM,$idC,$idE,$time) {
    $connection = Connection::getInstance()->getConnection();
    $query = 'INSERT INTO rdv(idMotif,idClient,idEmploye,horaire) VALUES (:idM,:idC,:idE,:dt)';
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':idM', $idM, PDO::PARAM_INT);
    $prepared -> bindParam(':idC', $idC, PDO::PARAM_INT);
    $prepared -> bindParam(':idE', $idE, PDO::PARAM_INT);
    $prepared -> bindParam(':dt', $time, PDO::PARAM_STR);
    $prepared -> execute();
}

/**
 * modifie le decouvert du compte dont l'id est en paramètre
 * @param int $idC l'id du compte
 * @param string $deco le découvert
 */
function modSetDecouvert($idC,$deco) {
    $connection = Connection::getInstance()->getConnection();
    $query = 'UPDATE compte SET decouvert=:deco WHERE idCompte=:idC';
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':idC', $idC, PDO::PARAM_INT);
    $prepared -> bindParam(':deco', $deco, PDO::PARAM_STR);
    $prepared -> execute();
}

/**
 * cree un motif avec le libelle et le(s) document(s) en paramètres
 * @param string $label le libelle
 * @param string $doc le(s) document(s) 
 */
function modCreateMotive($label,$doc) {
    $connection = Connection::getInstance()->getConnection();
    $query = 'INSERT INTO motif(intitule,document) VALUES (:label,:doc)';
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':label', $label, PDO::PARAM_STR);
    $prepared -> bindParam(':doc', $doc, PDO::PARAM_STR);
    $prepared -> execute();
}

/**
 * cree un type de compte avec l'id de motif et le nom en paramètres
 * @param int $idM l'id du motif
 * @param string $name le nom du compte
 */
function modCreateTypeAccount($idM,$name) {
    $connection = Connection::getInstance()->getConnection();
    $query = 'INSERT INTO typeCompte(idMotif,nom) VALUES (:idM,:nameA)';
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':idM', $idM, PDO::PARAM_INT);
    $prepared -> bindParam(':nameA', $name, PDO::PARAM_STR);
    $prepared -> execute();
}

/**
 * cree un type de contrat avec l'id de motif et le nom en paramètres
 * @param int $idM l'id du motif
 * @param string $name le nom du contrat
 */
function modCreateTypeContract($idM,$name) {
    $connection = Connection::getInstance()->getConnection();
    $query = 'INSERT INTO typeContrat(idMotif,nom) VALUES (:idM,:nameA)';
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':idM', $idM, PDO::PARAM_INT);
    $prepared -> bindParam(':nameA', $name, PDO::PARAM_STR);
    $prepared -> execute();
}

/**
 * modifie les infos du client dont l'id est en paramètre
 * @param int $idC l'id du client
 * @param int $idE l'id du conseiller
 * @param string $sname le nom
 * @param string $fname le prenom
 * @param string $dob la date de naissance
 * @param string $dc la date de creation
 * @param string $adr l'adresse
 * @param string $num le numero de tel
 * @param string $email l'adresse mail
 * @param string $job la profession
 * @param string $fam la situation familiale
 * @param string $civ la civilite
 */
function modModifClient($idC,$idE,$sname,$fname,$dob,$dc,$adr,$num,$email,$job,$fam,$civ) {
    $connection = Connection::getInstance()->getConnection();
    $query = 'UPDATE client SET idEmploye=:idE, nom=:sname, prenom=:fname, dateNaissance=:dob, dateCreation=:dc, adresse=:adr, numTel=:num, email=:email, profession=:job, situationFamiliale=:fam, civilite=:civ WHERE idClient=:idC';
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':idC', $idC, PDO::PARAM_INT);
    $prepared -> bindParam(':idE', $idE, PDO::PARAM_INT);
    $prepared -> bindParam(':sname', $sname, PDO::PARAM_STR);
    $prepared -> bindParam(':fname', $fname, PDO::PARAM_STR);
    $prepared -> bindParam(':dob', $dob, PDO::PARAM_STR);
    $prepared -> bindParam(':dc', $dc, PDO::PARAM_STR);
    $prepared -> bindParam(':adr', $adr, PDO::PARAM_STR);
    $prepared -> bindParam(':num', $num, PDO::PARAM_STR);
    $prepared -> bindParam(':email', $email, PDO::PARAM_STR);
    $prepared -> bindParam(':job', $job, PDO::PARAM_STR);
    $prepared -> bindParam(':fam', $fam, PDO::PARAM_STR);
    $prepared -> bindParam(':civ', $civ, PDO::PARAM_STR);
    $prepared -> execute();
}

/**
 * cree une ta avec l'id d'employé, l'horaire et le libelle en paramètre
 * @param int $idE l'id de l'employé
 * @param string $h l'horaire
 * @param string $label le libelle
 */
function modCreateAdmin($idE,$h,$label) {
    $connection = Connection::getInstance()->getConnection();
    $query = 'INSERT INTO tacheAdmin(idEmploye,horaire,libelle) VALUES (:idE,:h,:label)';
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':idE', $idE, PDO::PARAM_INT);
    $prepared -> bindParam(':h', $h, PDO::PARAM_STR);
    $prepared -> bindParam(':label', $label, PDO::PARAM_STR);
    $prepared -> execute();
}

/**
 * cree un client avec les infos en paramètre
 * @param int $idE l'id du conseiller
 * @param string $sname le nom
 * @param string $fname le prenom
 * @param string $dob la date de naissance
 * @param string $dc la date de creation
 * @param string $adr l'adresse
 * @param string $num le numero de tel
 * @param string $email l'adresse mail
 * @param string $job la profession
 * @param string $fam la situation familiale
 * @param string $civ la civilite
 */
function modCreateClient($idE,$sname,$fname,$dob,$dc,$adr,$num,$email,$job,$fam,$civ) {
    $connection = Connection::getInstance()->getConnection();
    $query = 'INSERT INTO client(idEmploye,nom,prenom,dateNaissance,dateCreation,adresse,numTel,email,profession,situationFamiliate,civilite) VALUES (:idE,:sname,:fname,:dob,:dc,:adr,:num,:email,:job,:fam,:civ)';
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':idE', $idE, PDO::PARAM_INT);
    $prepared -> bindParam(':sname', $sname, PDO::PARAM_STR);
    $prepared -> bindParam(':fname', $fname, PDO::PARAM_STR);
    $prepared -> bindParam(':dob', $dob, PDO::PARAM_STR);
    $prepared -> bindParam(':dc', $dc, PDO::PARAM_STR);
    $prepared -> bindParam(':adr', $adr, PDO::PARAM_STR);
    $prepared -> bindParam(':num', $num, PDO::PARAM_STR);
    $prepared -> bindParam(':email', $email, PDO::PARAM_STR);
    $prepared -> bindParam(':job', $job, PDO::PARAM_STR);
    $prepared -> bindParam(':fam', $fam, PDO::PARAM_STR);
    $prepared -> bindParam(':civ', $civ, PDO::PARAM_STR);
    $prepared -> execute();
}



/**
 * renvoie la liste des operations du compte dont l'id est en paramètre
 * @param int $id l'id du compte
 * @return array la liste des operations du compte dont l'id est en paramètre (IDOPERATION, IDCOMPTE, SOURCE, LIBELLE, DATEOPERATION, MONTANT, ISCREDIT) (tableau d'objets)
 */
function modGetOperations($id) {
    $connection = Connection::getInstance()->getConnection();
    $query = 'SELECT * FROM operation WHERE idCompte=:id';
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':id', $id, PDO::PARAM_INT);
    $prepared -> execute();
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result = $prepared -> fetchAll();
    $prepared -> closeCursor();
    return $result;
}

/**
 * Fonction qui permet d'ajouter un employé
 * @param int $idCategorie l'id de la catégorie de l'employé
 * @param string $name le nom de l'employé
 * @param string $firstName le prénom de l'employé
 * @param string $login le login de l'employé
 * @param string $password le password (salé) de l'employé
 * @param string $color la couleur de l'employé
 * @return void
 */
function modAddEmploye($idCategorie, $name, $firstName, $login, $password, $color){
    $connection = Connection::getInstance()->getConnection();
    $query = 'INSERT INTO employe(idCategorie, nom, prenom, login, password, color) VALUES (:idCategorie, :name, :firstName, :login, :password, :color)';
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':idCategorie', $idCategorie, PDO::PARAM_INT);
    $prepared -> bindParam(':name', $name, PDO::PARAM_STR);
    $prepared -> bindParam(':firstName', $firstName, PDO::PARAM_STR);
    $prepared -> bindParam(':login', $login, PDO::PARAM_STR);
    $prepared -> bindParam(':password', $password, PDO::PARAM_STR);
    $prepared -> bindParam(':color', $color, PDO::PARAM_STR);
    $prepared -> execute();
    $prepared -> closeCursor();
}

/**
 * Fonction qui permet de supprimer un employé
 * @param int $idEmployee l'id de l'employé
 * @return void
 */
function modDeleteEmploye($idEmployee){
    $connection = Connection::getInstance()->getConnection();
    $query = 'DELETE FROM employe WHERE idEmploye=:idEmployee';
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':idEmployee', $idEmployee, PDO::PARAM_INT);
    $prepared -> execute();
    $prepared -> closeCursor();
}

/**
 * Fonction qui permet d'ajouter un type de compte
 * @param string $name le nom du type de compte
 * @param int $active 1 si le type de compte est actif, 0 sinon
 * @param string $document le document du type de compte
 * @return void
 */
function modAddTypeAccount($name, $active, $document){
    $connection = Connection::getInstance()->getConnection();
    $connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);
    $query = "INSERT INTO `motif`(`INTITULE`, `DOCUMENT`) VALUES ('Gestion de :name',:document);
    INSERT INTO `typecompte`(`IDMOTIF`, `NOM`, `ACTIF`) VALUES ((SELECT LAST_INSERT_ID()),:name,:active)";
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':name', $name, PDO::PARAM_STR);
    $prepared -> bindParam(':active', $active, PDO::PARAM_INT);
    $prepared -> bindParam(':document', $document, PDO::PARAM_STR);
    $prepared -> execute();
    $prepared -> closeCursor();
}

/**
 * Fonction qui permet d'ajouter un type de contrat
 * @param string $name le nom du type de contrat
 * @param int $active 1 si le type de contrat est actif, 0 sinon
 * @param string $document le document du type de contrat
 * @return void
 */
function modAddTypeContract($name, $active, $document){
    $connection = Connection::getInstance()->getConnection();
    $connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);
    $query = "INSERT INTO `motif`(`INTITULE`, `DOCUMENT`) VALUES ('Gestion de :name',:document);
    INSERT INTO `typecontrat`(`IDMOTIF`, `NOM`, `ACTIF`) VALUES ((SELECT LAST_INSERT_ID()),:name,:active)";
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':name', $name, PDO::PARAM_STR);
    $prepared -> bindParam(':active', $active, PDO::PARAM_INT);
    $prepared -> bindParam(':document', $document, PDO::PARAM_STR);
    $prepared -> execute();
    $prepared -> closeCursor();
}

/**
 * Fonction qui permet de supprimer un type de compte
 * @param int $idTypeAccount l'id du type de compte
 * @return void
 */
function modDeleteTypeAccount($idTypeAccount){
    $connection = Connection::getInstance()->getConnection();
    $connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);
    
    // Récupérer l'idmotif
    $query = 'SELECT idmotif FROM typecompte WHERE idtypecompte=:idTypeAccount';
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':idTypeAccount', $idTypeAccount, PDO::PARAM_INT);
    $prepared -> execute();
    $idMotif = $prepared->fetchColumn();
    $prepared -> closeCursor();

    // Supprimer les entrées
    $query = 'DELETE FROM typecompte WHERE idTypeCompte=:idTypeAccount;
              DELETE FROM motif WHERE idmotif = :idMotif';
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':idTypeAccount', $idTypeAccount, PDO::PARAM_INT);
    $prepared -> bindParam(':idMotif', $idMotif, PDO::PARAM_INT);
    $prepared -> execute();
    $prepared -> closeCursor();
}

/**
 * Fonction qui permet de supprimer un type de contrat
 * @param int $idTypeContract l'id du type de contrat
 * @return void
 */
function modDeleteTypeContract($idTypeContract){
    $connection = Connection::getInstance()->getConnection();
    $connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);
    
    // Récupérer l'idmotif
    $query = 'SELECT idmotif FROM typecontrat WHERE idtypecontrat=:idTypeContract';
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':idTypeContract', $idTypeContract, PDO::PARAM_INT);
    $prepared -> execute();
    $idMotif = $prepared->fetchColumn();
    $prepared -> closeCursor();

    // Supprimer les entrées
    $query = 'DELETE FROM typecontrat WHERE idTypecontrat=:idTypeContract;
              DELETE FROM motif WHERE idmotif = :idMotif';
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':idTypeContract', $idTypeContract, PDO::PARAM_INT);
    $prepared -> bindParam(':idMotif', $idMotif, PDO::PARAM_INT);
    $prepared -> execute();
    $prepared -> closeCursor();
}



function modGetAllConseiller(){
    $connection = Connection::getInstance()->getConnection();
    $query = 'SELECT idEmploye, CONCAT(employe.PRENOM," ", employe.NOM) AS identiteEmploye FROM employe WHERE idCategorie=2';
    $prepared = $connection -> query($query);
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result = $prepared -> fetchAll();
    $prepared -> closeCursor();
    return $result;
}


function modModifEmployeSetting($idEmploye, $login, $password, $color){
    $connection = Connection::getInstance()->getConnection();
    $query = 'UPDATE employe SET login=:login, password=:password, color=:color WHERE idEmploye=:idEmploye';
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':idEmploye', $idEmploye, PDO::PARAM_INT);
    $prepared -> bindParam(':login', $login, PDO::PARAM_STR);
    $prepared -> bindParam(':password', $password, PDO::PARAM_STR);
    $prepared -> bindParam(':color', $color, PDO::PARAM_STR);
    $prepared -> execute();
    $prepared -> closeCursor();
}






/* FONCTION NON UTILISEES


function modGetAllMotif() {
    $connection = Connection::getInstance()->getConnection();
    $query = 'SELECT * FROM motif';
    $prepared = $connection -> query($query);
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result = $prepared -> fetchAll();
    $prepared -> closeCursor();
    return $result;
}



function modGetMotifFromId($idMotif) {
    $connection = Connection::getInstance()->getConnection();
    $query = 'SELECT * FROM motif WHERE idmotif=:idM';
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':idM', $idMotif, PDO::PARAM_INT);
    $prepared -> execute();
    $prepared -> setFetchMode(PDO::FETCH_OBJ);
    $result = $prepared -> fetch();
    return $result;
}

function modModifMotif($idMotif, $intitule, $document) {
    $connection = Connection::getInstance()->getConnection();
    $query = 'UPDATE motif SET intitule=:intitule, document=:document WHERE idmotif=:idM';
    $prepared = $connection -> prepare($query);
    $prepared -> bindParam(':idM', $idMotif, PDO::PARAM_INT);
    $prepared -> bindParam(':intitule', $intitule, PDO::PARAM_STR);
    $prepared -> bindParam(':document', $document, PDO::PARAM_STR);
    $prepared -> execute();
    $prepared -> closeCursor();
}


*/