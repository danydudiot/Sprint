-- DROP DATABASE IF EXISTS sprint;
-- CREATE DATABASE IF NOT EXISTS sprint;
-- USE sprint;
# -----------------------------------------------------------------------------
#       TABLE : rdv
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS rdv
 (
   idrdv INTEGER(8) NOT NULL AUTO_INCREMENT ,
   idmotif INTEGER(2) NOT NULL  ,
   idclient INTEGER(4) NOT NULL  ,
   idemploye INTEGER(4) NOT NULL  ,
   horairedebut DATETIME NULL ,
   horairefin DATETIME NULL
   , PRIMARY KEY (idrdv) 
 )

 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE rdv
# -----------------------------------------------------------------------------


CREATE  INDEX i_fk_rdv_motif
     ON rdv (idmotif ASC);

CREATE  INDEX i_fk_rdv_client
     ON rdv (idclient ASC);

CREATE  INDEX i_fk_rdv_employe
     ON rdv (idemploye ASC);

# -----------------------------------------------------------------------------
#       TABLE : motif
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS motif
 (
   idmotif INTEGER(2) NOT NULL AUTO_INCREMENT ,
   intitule VARCHAR(64) NULL ,
   document VARCHAR(128)
   , PRIMARY KEY (idmotif) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : tacheadmin
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS tacheadmin
 (
   idta INTEGER(8) NOT NULL AUTO_INCREMENT ,
   idemploye INTEGER(4) NOT NULL  ,
   horairedebut DATETIME NULL  ,
   horairefin DATETIME NULL  ,
   libelle VARCHAR(32) NULL  
   , PRIMARY KEY (idta) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE tacheadmin
# -----------------------------------------------------------------------------


CREATE  INDEX i_fk_tacheadmin_employe
     ON tacheadmin (idemploye ASC);

# -----------------------------------------------------------------------------
#       TABLE : typecompte
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS typecompte
 (
   idtypecompte INTEGER(2) NOT NULL AUTO_INCREMENT ,
   idmotif INTEGER(2) NOT NULL  ,
   nom VARCHAR(64) NULL UNIQUE ,
   actif BOOL NULL  
      DEFAULT 1
   , PRIMARY KEY (idtypecompte) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE typecompte
# -----------------------------------------------------------------------------


CREATE UNIQUE INDEX i_fk_typecompte_motif
     ON typecompte (idmotif ASC);

# -----------------------------------------------------------------------------
#       TABLE : contrat
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS contrat
 (
   idcontrat INTEGER(8) NOT NULL AUTO_INCREMENT ,
   idtypecontrat INTEGER(2) NOT NULL  ,
   tarifmensuel DECIMAL(13,2) NULL  ,
   dateouverture DATE NULL  
   , PRIMARY KEY (idcontrat) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE contrat
# -----------------------------------------------------------------------------


CREATE  INDEX i_fk_contrat_typecontrat
     ON contrat (idtypecontrat ASC);


# -----------------------------------------------------------------------------
#       TABLE : client
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS client
 (
   idclient INTEGER(4) NOT NULL AUTO_INCREMENT ,
   idemploye INTEGER(4) NOT NULL  ,
   nom VARCHAR(32) NULL  ,
   prenom VARCHAR(32) NULL  ,
   datenaissance DATE NULL  ,
   datecreation DATE NULL  ,
   adresse VARCHAR(128) NULL  ,
   numtel VARCHAR(16) NULL  ,
   email VARCHAR(64) NULL  ,
   profession VARCHAR(32) NULL  ,
   situationfamiliale VARCHAR(32) NULL  ,
   civilitee VARCHAR(8) NULL  
   , PRIMARY KEY (idclient) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE client
# -----------------------------------------------------------------------------


CREATE  INDEX i_fk_client_employe
     ON client (idemploye ASC);

# -----------------------------------------------------------------------------
#       TABLE : categorie
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS categorie
 (
   idcategorie INTEGER(2) NOT NULL AUTO_INCREMENT ,
   libellecategorie VARCHAR(32) NULL  
   , PRIMARY KEY (idcategorie) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : typecontrat
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS typecontrat
 (
   idtypecontrat INTEGER(2) NOT NULL AUTO_INCREMENT ,
   idmotif INTEGER(2) NOT NULL  ,
   nom VARCHAR(64) NULL UNIQUE ,
   actif BOOL NULL  
      DEFAULT 1
   , PRIMARY KEY (idtypecontrat) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE typecontrat
# -----------------------------------------------------------------------------


CREATE UNIQUE INDEX i_fk_typecontrat_motif
     ON typecontrat (idmotif ASC);

# -----------------------------------------------------------------------------
#       TABLE : employe
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS employe
 (
   idemploye INTEGER(4) NOT NULL AUTO_INCREMENT ,
   idcategorie INTEGER(2) NOT NULL  ,
   nom VARCHAR(32) NULL  ,
   prenom VARCHAR(32) NULL  ,
   login VARCHAR(32) NULL UNIQUE ,
   password VARCHAR(128) NULL  ,
   color VARCHAR(32) NOT NULL DEFAULT 'lush-green'
   , PRIMARY KEY (idemploye) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE EMPLOYE
# -----------------------------------------------------------------------------


CREATE  INDEX i_fk_employe_categorie
     ON employe (idcategorie ASC);

# -----------------------------------------------------------------------------
#       TABLE : compte
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS compte
 (
   idcompte INTEGER(8) NOT NULL AUTO_INCREMENT ,
   idtypecompte INTEGER(2) NOT NULL  ,
   solde DECIMAL(13,2) NULL  ,
   decouvert DECIMAL(13,2) NULL  ,
   datecreation DATE NULL  
   , PRIMARY KEY (idcompte) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE compte
# -----------------------------------------------------------------------------


CREATE  INDEX i_fk_compte_typecompte
     ON compte (idtypecompte ASC);


# -----------------------------------------------------------------------------
#       TABLE : operation
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS operation
  (
    idoperation INTEGER(8) NOT NULL AUTO_INCREMENT ,
    idcompte INTEGER(8) NOT NULL ,
    source VARCHAR(32) NOT NULL ,
    libelle VARCHAR(64) NOT NULL ,
    dateoperation DATETIME NOT NULL ,
    montant DECIMAL(8,2) ,
    iscredit INTEGER(1),
    PRIMARY KEY (idoperation)
  )
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : possedecontrat
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS possedecontrat
 (
   idcontrat INTEGER(8) NOT NULL ,
   idclient INTEGER(4) NOT NULL   
   , PRIMARY KEY (idcontrat,idclient) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE possedecontrat
# -----------------------------------------------------------------------------


CREATE  INDEX i_fk_possedecontrat_client
     ON possedecontrat (idclient ASC);

CREATE  INDEX i_fk_possedecontrat_contrat
     ON possedecontrat (idcontrat ASC);

# -----------------------------------------------------------------------------
#       TABLE : possedecompte
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS possedecompte
 (
   idcompte INTEGER(8) NOT NULL  ,
   idclient INTEGER(4) NOT NULL  
   , PRIMARY KEY (idcompte,idclient) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE possedecompte
# -----------------------------------------------------------------------------


CREATE  INDEX i_fk_possedecompte_compte
     ON possedecompte (idcompte ASC);

CREATE  INDEX i_fk_possedecompte_client
     ON possedecompte (idclient ASC);


# -----------------------------------------------------------------------------
#       CREATION DES REFERENCES DE TABLE
# -----------------------------------------------------------------------------


ALTER TABLE rdv 
  ADD FOREIGN KEY fk_rdv_motif (idmotif)
      REFERENCES motif (idmotif) ;


ALTER TABLE rdv 
  ADD FOREIGN KEY fk_rdv_client (idclient)
      REFERENCES client (idclient) ;


ALTER TABLE rdv 
  ADD FOREIGN KEY fk_rdv_employe (idemploye)
      REFERENCES employe (idemploye) ;


ALTER TABLE tacheadmin 
  ADD FOREIGN KEY fk_tacheadmin_employe (idemploye)
      REFERENCES employe (idemploye) ;


ALTER TABLE typecompte 
  ADD FOREIGN KEY fk_typecompte_motif (idmotif)
      REFERENCES motif (idmotif) ;


ALTER TABLE contrat 
  ADD FOREIGN KEY fk_contrat_typecontrat (idtypecontrat)
      REFERENCES typecontrat (idtypecontrat) ;


ALTER TABLE client 
  ADD FOREIGN KEY fk_client_employe (idemploye)
      REFERENCES employe (idemploye) ;


ALTER TABLE typecontrat 
  ADD FOREIGN KEY fk_typecontrat_motif (idmotif)
      REFERENCES motif (idmotif) ;


ALTER TABLE employe 
  ADD FOREIGN KEY fk_employe_categorie (idcategorie)
      REFERENCES categorie (idcategorie) ;


ALTER TABLE compte 
  ADD FOREIGN KEY fk_compte_typecompte (idtypecompte)
      REFERENCES typecompte (idtypecompte) ;


ALTER TABLE possedecontrat 
  ADD FOREIGN KEY fk_possedecontrat_client (idclient)
      REFERENCES client (idclient) ;


ALTER TABLE possedecontrat 
  ADD FOREIGN KEY fk_possedecontrat_contrat (idcontrat)
      REFERENCES contrat (idcontrat) ;


ALTER TABLE possedecompte 
  ADD FOREIGN KEY fk_possedecompte_compte (idcompte)
      REFERENCES compte (idcompte) ;


ALTER TABLE possedecompte 
  ADD FOREIGN KEY fk_possedecompte_client (idclient)
      REFERENCES client (idclient) ;

ALTER TABLE operation
  ADD FOREIGN KEY fk_operation_compte (idcompte)
      REFERENCES compte (idcompte);