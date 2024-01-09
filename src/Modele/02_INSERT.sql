INSERT INTO categorie (libellecategorie) VALUES ('Directeur');
INSERT INTO categorie (libellecategorie) VALUES ('Conseiller');
INSERT INTO categorie (libellecategorie) VALUES ('Agent');

INSERT INTO motif (intitule, document) VALUES ('Compte Courant', 'Contrat de travail');
INSERT INTO motif (intitule, document) VALUES ('Compte Etudiant', 'Attestation de scolarite');
INSERT INTO motif (intitule, document) VALUES ('Compte Senior', 'Justificatif de pension');

INSERT INTO motif (intitule, document) VALUES ('Contrat d''Assurance Automobile', 'Carte grise');
INSERT INTO motif (intitule, document) VALUES ('Contrat de Pret', 'Releves bancaires');
INSERT INTO motif (intitule, document) VALUES ('Contrat d''Assurance Vie', 'Acte de naissance');

INSERT INTO typecompte (idmotif, nom, actif) VALUES (1, 'Compte Courant', 1);
INSERT INTO typecompte (idmotif, nom, actif) VALUES (2, 'Compte Etudiant', 1);
INSERT INTO typecompte (idmotif, nom, actif) VALUES (3, 'Compte Senior', 1);

INSERT INTO typecontrat (idmotif, nom, actif) VALUES (4, 'Contrat d''Assurance Automobile', 1);
INSERT INTO typecontrat (idmotif, nom, actif) VALUES (5, 'Contrat de Pret', 1);
INSERT INTO typecontrat (idmotif, nom, actif) VALUES (6, 'Contrat d''Assurance Vie', 1);

INSERT INTO employe (idcategorie, nom, prenom, login, password, color) VALUES (1, "King", "Augusta", "Lovelace", "$2y$12$qkz.9vq4D/qII0cVfsNGheAexwe8uvqipP.TiD2VeqqAqtYJ2rRtm", 'royal-purple'); -- 123

INSERT INTO employe (idcategorie, nom, prenom, login, password, color) VALUES (2, "Turing", "Alan", "Alan", "$2y$12$njNgks19Mdnkyq5LjnTF.uP2zWfMbIkf2xo6/a0UOSLxl2ujN/Puy", 'lush-green'); -- 123
INSERT INTO employe (idcategorie, nom, prenom, login, password, color) VALUES (2, "Hooper", "Thomas", "Thomas", "$2y$12$b6zxvrXxWYoHdo55Tr7I/u/YG6vdXbTiuYExrdEds2fdMExecGuxS", 'turquoise-cyan'); -- 123
INSERT INTO employe (idcategorie, nom, prenom, login, password, color) VALUES (2, "Andromeda", "Eleanor", "Eleanor", "$2y$12$PU3E8CV9uCRa/5PcrqzvqOucicNPcYtXAY8/pHsfTXqDH3RznDRo.", 'berry-red'); -- 123
INSERT INTO employe (idcategorie, nom, prenom, login, password, color) VALUES (2, "Arthur", "Ernest", "Ernest", "$2y$12$12okhBNXddxkXIJn.YywneGSsk37qSqo7J0VqdSiUY4LUYHLT8z1m", 'lavender'); -- 123
INSERT INTO employe (idcategorie, nom, prenom, login, password, color) VALUES (2, "Blake", "Charlie", "Charlie", "$2y$12$W4LEwafCZK7P.rnskiECNeEXSmKPD1U290pqFPb4RrnG8GGqsb38G", 'sunny-orange'); -- 123

INSERT INTO employe (idcategorie, nom, prenom, login, password, color) VALUES (3, "Babbage", "Charles", "Charles", "$2y$12$dXwfxEOCdZXHID76ZQyRie3virD1meoa/x/TEnHIyYBBRcaAkmwMW", "lemon-yellow"); -- 123
INSERT INTO employe (idcategorie, nom, prenom, login, password, color) VALUES (3, "Murdoch", "Matt", "Matt", "$2y$12$4MMpQMM.42o/iMM/L7O4qOo45Pc31pvpZhgdidaZInxoxZmWsua8i", "ocean-blue"); -- 123
INSERT INTO employe (idcategorie, nom, prenom, login, password, color) VALUES (3, "Merry", "Alexander", "Alexander", "$2y$12$C7aJBn.dW76vzhnhOwAzlOrXEUhKkeeJHoB8D9KzE0kM8w/5VIWZe", "coral-pink"); -- 123

INSERT INTO client (idemploye, nom, prenom, datenaissance, datecreation, adresse, numtel, email, profession, situationfamiliale, civilitee) VALUES (2, 'Jaquemin', 'Geoffroy', '2003-12-26 12:00:00', '2023-12-11 12:00:00', '28 Rue du pain, Paris', '06 81 81 81 60', 'travail.univ@email.com', 'Etudiant', 'Celibataire', 'M.');
INSERT INTO client (idemploye, nom, prenom, datenaissance, datecreation, adresse, numtel, email, profession, situationfamiliale, civilitee) VALUES (2, 'Shepard', 'John', '2000-07-03 12:00:00', '2023-02-14 12:00:00', '202 Normandy', '07 20 04 11 20', 'john.danse@email.com', 'Capitaine', 'Celibataire', 'Mx');
INSERT INTO client (idemploye, nom, prenom, datenaissance, datecreation, adresse, numtel, email, profession, situationfamiliale, civilitee) VALUES (3, 'Mievilly', 'Leo', '2004-01-17 12:00:00', '2004-01-17 12:00:00', 'Dans les Arbres', '05 13 90 11 10', 'leo.mievilly@email.com', 'Ecrivain', 'Celibataire', 'M.');
INSERT INTO client (idemploye, nom, prenom, datenaissance, datecreation, adresse, numtel, email, profession, situationfamiliale, civilitee) VALUES (3, 'Mievilly', 'Bartholomew', '2023-03-17 12:00:00', '2023-05-05 12:00:00', 'Dans les îles', '08 12 00 10 10', 'bfce3.mievilly@email.com', 'Chanteur', 'Celibataire', 'M.');
INSERT INTO client (idemploye, nom, prenom, datenaissance, datecreation, adresse, numtel, email, profession, situationfamiliale, civilitee) VALUES (4, 'Jacob', 'Max', '1976-05-12 12:00:00', '2012-12-12 12:00:00', 'Rue des Halles, Paris', '01 02 07 50 10', 'max.jacob@telegraphe.com', 'Poete', 'Celibataire', 'M.');
INSERT INTO client (idemploye, nom, prenom, datenaissance, datecreation, adresse, numtel, email, profession, situationfamiliale, civilitee) VALUES (4, "Hemingway", "Harold", "1998-10-31 12:00:00", "2012-06-01 12:00:00", "123 Sesame Street, Capital City", "01 14 14 88 10", "harold.hemingway@gmail.com", "Acteur", "Pacse", "M.");
INSERT INTO client (idemploye, nom, prenom, datenaissance, datecreation, adresse, numtel, email, profession, situationfamiliale, civilitee) VALUES (5, 'El Moumni', 'Salma', '1999-09-16 12:00:00', '2023-11-14 12:00:00', 'Rue des Halles, paris', '01 60 04 01 30', 'salma.el-moumni@email.com', 'Ecrivaine', 'N/A', 'Mme');
INSERT INTO client (idemploye, nom, prenom, datenaissance, datecreation, adresse, numtel, email, profession, situationfamiliale, civilitee) VALUES (6, 'Blake', 'Daphne', '1989-09-20 12:00:00', '2015-03-10 12:00:00', 'Weird Street, Crystal Cove', '01 23 45 67 89', 'daphne.blake@email.com', 'Enquetrice', 'Concubinage', 'Mme');
INSERT INTO client (idemploye, nom, prenom, datenaissance, datecreation, adresse, numtel, email, profession, situationfamiliale, civilitee) VALUES (6, 'Dinkley', 'Vera', '1989-09-13 12:00:00', '2015-03-10 12:00:00', 'Mystery Alley, Crystal Cove', '09 05 70 04 11', 'vera.dinckley@email.com', 'Enquetrice', 'Celibataire', 'Mme');
INSERT INTO client (idemploye, nom, prenom, datenaissance, datecreation, adresse, numtel, email, profession, situationfamiliale, civilitee) VALUES (6, 'Rogers', 'Sammy', '1990-01-24 12:00:00', '2015-03-10 12:00:00', 'Unknown Avenue, Crystal Cove', '02 40 02 03 05', 'sammy.doo@email.com', 'Enqueteur', 'Celibataire', 'Mr');
INSERT INTO client (idemploye, nom, prenom, datenaissance, datecreation, adresse, numtel, email, profession, situationfamiliale, civilitee) VALUES (6, 'Jones', 'Fred', '1989-09-13 12:00:00', '2015-03-10 12:00:00', 'Weird Street, Crystal Cove', '06 81 17 10 90', 'trap.piege@email.com', 'Enqueteur', 'Concubinage', 'Mr');
INSERT INTO client (idemploye, nom, prenom, datenaissance, datecreation, adresse, numtel, email, profession, situationfamiliale, civilitee) VALUES (6, 'Dooby-Doo', 'Scooby', '1996-09-13 12:00:00', '2015-03-10 12:00:00', 'Unknown Avenue, Crystal Cove', '02 01 27 25 01', 'scooby.snack@email.com', 'Enqueteur', 'Celibataire', 'Mx');

INSERT INTO compte (idtypecompte, solde, decouvert, datecreation) VALUES (2, 3000, 100, "2023-12-11 12:00:00");
INSERT INTO compte (idtypecompte, solde, decouvert, datecreation) VALUES (1, 7356, 150, "2017-06-27 12:00:00");
INSERT INTO compte (idtypecompte, solde, decouvert, datecreation) VALUES (2, 3000, 100, "2022-01-17 12:00:00");
INSERT INTO compte (idtypecompte, solde, decouvert, datecreation) VALUES (1, 37000000, 1000, "2023-05-05 12:00:00");
INSERT INTO compte (idtypecompte, solde, decouvert, datecreation) VALUES (3, 137000, 500, "2012-12-12 12:00:00");
INSERT INTO compte (idtypecompte, solde, decouvert, datecreation) VALUES (3, 329000, 600, "2012-06-01 12:00:00");
INSERT INTO compte (idtypecompte, solde, decouvert, datecreation) VALUES (1, 57000, 1000, "2023-11-14 12:00:00");
INSERT INTO compte (idtypecompte, solde, decouvert, datecreation) VALUES (1, 68000, 1000, "2015-03-10 12:00:00");
INSERT INTO compte (idtypecompte, solde, decouvert, datecreation) VALUES (1, 14000, 200, "2015-03-10 12:00:00");
INSERT INTO compte (idtypecompte, solde, decouvert, datecreation) VALUES (1, 71000, 1000, "2015-03-10 12:00:00");
INSERT INTO compte (idtypecompte, solde, decouvert, datecreation) VALUES (1, 31000, 1000, "2015-03-10 12:00:00");
INSERT INTO compte (idtypecompte, solde, decouvert, datecreation) VALUES (1, 141000000, 1000, "2015-03-10 12:00:00");

INSERT INTO possedecompte (idcompte, idclient) VALUES (1, 1);
INSERT INTO possedecompte (idcompte, idclient) VALUES (2, 2);
INSERT INTO possedecompte (idcompte, idclient) VALUES (3, 3);
INSERT INTO possedecompte (idcompte, idclient) VALUES (4, 4);
INSERT INTO possedecompte (idcompte, idclient) VALUES (5, 5);
INSERT INTO possedecompte (idcompte, idclient) VALUES (6, 6);
INSERT INTO possedecompte (idcompte, idclient) VALUES (7, 7);
INSERT INTO possedecompte (idcompte, idclient) VALUES (8, 8);
INSERT INTO possedecompte (idcompte, idclient) VALUES (9, 9);
INSERT INTO possedecompte (idcompte, idclient) VALUES (10, 10);
INSERT INTO possedecompte (idcompte, idclient) VALUES (11, 11);
INSERT INTO possedecompte (idcompte, idclient) VALUES (12, 12);

INSERT INTO contrat (idtypecontrat, tarifmensuel, dateouverture) VALUES (1, 43.71, "2019-03-21 12:00:00");
INSERT INTO contrat (idtypecontrat, tarifmensuel, dateouverture) VALUES (1, 52.34, "2023-07-13 12:00:00");
INSERT INTO contrat (idtypecontrat, tarifmensuel, dateouverture) VALUES (1, 39.46, "2012-07-09 12:00:00");
INSERT INTO contrat (idtypecontrat, tarifmensuel, dateouverture) VALUES (1, 73.92, "2016-09-28 12:00:00");

INSERT INTO contrat (idtypecontrat, tarifmensuel, dateouverture) VALUES (2, 200, "2023-01-29 12:00:00");
INSERT INTO contrat (idtypecontrat, tarifmensuel, dateouverture) VALUES (2, 100, "2023-09-18 12:00:00");
INSERT INTO contrat (idtypecontrat, tarifmensuel, dateouverture) VALUES (2, 100, "2018-03-04 12:00:00");
INSERT INTO contrat (idtypecontrat, tarifmensuel, dateouverture) VALUES (2, 230, "2017-05-09 12:00:00");

INSERT INTO contrat (idtypecontrat, tarifmensuel, dateouverture) VALUES (3, 50, "2023-08-15 12:00:00");
INSERT INTO contrat (idtypecontrat, tarifmensuel, dateouverture) VALUES (3, 50, "2021-04-30 12:00:00");
INSERT INTO contrat (idtypecontrat, tarifmensuel, dateouverture) VALUES (3, 50, "2020-01-02 12:00:00");
INSERT INTO contrat (idtypecontrat, tarifmensuel, dateouverture) VALUES (3, 50, "2018-06-18 12:00:00");

INSERT INTO possedecontrat (idcontrat, idclient) VALUES (1, 2);
INSERT INTO possedecontrat (idcontrat, idclient) VALUES (2, 3);
INSERT INTO possedecontrat (idcontrat, idclient) VALUES (3, 6);
INSERT INTO possedecontrat (idcontrat, idclient) VALUES (4, 11);

INSERT INTO possedecontrat (idcontrat, idclient) VALUES (5, 9);
INSERT INTO possedecontrat (idcontrat, idclient) VALUES (6, 1);
INSERT INTO possedecontrat (idcontrat, idclient) VALUES (7, 5);
INSERT INTO possedecontrat (idcontrat, idclient) VALUES (8, 7);

INSERT INTO possedecontrat (idcontrat, idclient) VALUES (9, 4);
INSERT INTO possedecontrat (idcontrat, idclient) VALUES (10, 8);
INSERT INTO possedecontrat (idcontrat, idclient) VALUES (11, 10);
INSERT INTO possedecontrat (idcontrat, idclient) VALUES (12, 12);

INSERT INTO operation (idcompte, source, libelle, dateoperation, montant, iscredit) VALUES (1, "Banque", "Pret", "2024-01-01 08:00:00", 100, 0);
INSERT INTO operation (idcompte, source, libelle, dateoperation, montant, iscredit) VALUES (1, "Gouvernement", "Bourse", "2024-01-03 14:30:00", 400, 1);

INSERT INTO operation (idcompte, source, libelle, dateoperation, montant, iscredit) VALUES (2, "Banque", "Assurance Auto", "2024-01-01 08:00:00", 43.71, 0);
INSERT INTO operation (idcompte, source, libelle, dateoperation, montant, iscredit) VALUES (2, "USAF", "Salaire", "2024-01-02 10:30:00", 6000, 1);

INSERT INTO operation (idcompte, source, libelle, dateoperation, montant, iscredit) VALUES (3, "Banque", "Assurance Auto", "2024-01-01 08:00:00", 52.34, 0);
INSERT INTO operation (idcompte, source, libelle, dateoperation, montant, iscredit) VALUES (3, "Editions Gallimard", "Droits d''Auteur", "2024-01-05 15:00:00", 1100, 1);

INSERT INTO operation (idcompte, source, libelle, dateoperation, montant, iscredit) VALUES (4, "Banque", "Assurance Vie", "2024-01-01 08:00:00", 50, 0);
INSERT INTO operation (idcompte, source, libelle, dateoperation, montant, iscredit) VALUES (4, "PetCo", "Salaire", "2024-01-01 00:00:00", 10000, 1);

INSERT INTO operation (idcompte, source, libelle, dateoperation, montant, iscredit) VALUES (5, "Banque", "Pret", "2024-01-01 08:00:00", 100, 0);
INSERT INTO operation (idcompte, source, libelle, dateoperation, montant, iscredit) VALUES (5, "Gouvernement", "Pension Retraite", "2024-01-03 14:30:00", 1200, 1);

INSERT INTO operation (idcompte, source, libelle, dateoperation, montant, iscredit) VALUES (6, "Banque", "Assurance Auto", "2024-01-01 08:00:00", 39.46, 0);
INSERT INTO operation (idcompte, source, libelle, dateoperation, montant, iscredit) VALUES (6, "Gouvernement", "Pension Retraite", "2024-01-03 14:30:00", 1600, 1);

INSERT INTO operation (idcompte, source, libelle, dateoperation, montant, iscredit) VALUES (7, "Banque", "Pret", "2024-01-01 08:00:00", 230, 0);
INSERT INTO operation (idcompte, source, libelle, dateoperation, montant, iscredit) VALUES (7, "Editions Grasset", "Droits d''Auteure", "2024-01-01 11:30:00", 2600, 1);

INSERT INTO operation (idcompte, source, libelle, dateoperation, montant, iscredit) VALUES (8, "Banque", "Assurance Vie", "2024-01-01 08:00:00", 50, 0);
INSERT INTO operation (idcompte, source, libelle, dateoperation, montant, iscredit) VALUES (8, "Mystery Inc", "Salaire", "2024-01-06 17:00:00", 3000, 1);

INSERT INTO operation (idcompte, source, libelle, dateoperation, montant, iscredit) VALUES (9, "Banque", "Pret", "2024-01-01 08:00:00", 200, 0);
INSERT INTO operation (idcompte, source, libelle, dateoperation, montant, iscredit) VALUES (9, "Mystery Inc", "Salaire", "2024-01-06 17:00:00", 3000, 1);

INSERT INTO operation (idcompte, source, libelle, dateoperation, montant, iscredit) VALUES (10, "Banque", "Assurance Vie", "2024-01-01 08:00:00", 50, 0);
INSERT INTO operation (idcompte, source, libelle, dateoperation, montant, iscredit) VALUES (10, "Mystery Inc", "Salaire", "2024-01-06 17:00:00", 3000, 1);

INSERT INTO operation (idcompte, source, libelle, dateoperation, montant, iscredit) VALUES (11, "Banque", "Assurance Auto", "2024-01-01 08:00:00", 73.92, 0);
INSERT INTO operation (idcompte, source, libelle, dateoperation, montant, iscredit) VALUES (11, "Mystery Inc", "Salaire", "2024-01-06 17:00:00", 3000, 1);

INSERT INTO operation (idcompte, source, libelle, dateoperation, montant, iscredit) VALUES (12, "Banque", "Assurance Vie", "2024-01-01 08:00:00", 50, 0);
INSERT INTO operation (idcompte, source, libelle, dateoperation, montant, iscredit) VALUES (12, "Mystery Inc", "Salaire", "2024-01-06 17:00:00", 3000, 1);

INSERT INTO rdv (idmotif, idclient, idemploye, horairedebut, horairefin) VALUES (1, 7, 5, "2024-01-01 09:00:00", "2024-01-01 10:00:00");
INSERT INTO rdv (idmotif, idclient, idemploye, horairedebut, horairefin) VALUES (2, 1, 2, "2024-01-02 13:30:00", "2024-01-02 14:30:00");
INSERT INTO rdv (idmotif, idclient, idemploye, horairedebut, horairefin) VALUES (3, 5, 4, "2024-01-03 16:00:00", "2024-01-03 17:00:00");
INSERT INTO rdv (idmotif, idclient, idemploye, horairedebut, horairefin) VALUES (4, 3, 3, "2024-01-05 11:00:00", "2024-01-05 12:00:00");
INSERT INTO rdv (idmotif, idclient, idemploye, horairedebut, horairefin) VALUES (5, 9, 6, "2024-01-06 10:30:00", "2024-01-06 11:30:00");
INSERT INTO rdv (idmotif, idclient, idemploye, horairedebut, horairefin) VALUES (6, 4, 3, "2024-01-04 14:00:00", "2024-01-04 15:00:00");

INSERT INTO tacheadmin (idemploye, horairedebut, horairefin, libelle) VALUES (2, "2024-01-03 09:00:00", "2024-01-03 10:00:00", "Etude dossier");
INSERT INTO tacheadmin (idemploye, horairedebut, horairefin, libelle) VALUES (3, "2024-01-02 14:00:00", "2024-01-02 15:00:00", "Etude dossier");
INSERT INTO tacheadmin (idemploye, horairedebut, horairefin, libelle) VALUES (4, "2024-01-04 11:00:00", "2024-01-04 12:00:00", "Etude dossier");
INSERT INTO tacheadmin (idemploye, horairedebut, horairefin, libelle) VALUES (5, "2024-01-06 16:00:00", "2024-01-06 17:00:00", "Etude dossier");
INSERT INTO tacheadmin (idemploye, horairedebut, horairefin, libelle) VALUES (6, "2024-01-01 10:00:00", "2024-01-01 11:00:00", "Etude dossier");
