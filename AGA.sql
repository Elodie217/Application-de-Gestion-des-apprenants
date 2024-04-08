#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: aga_Promo
#------------------------------------------------------------

CREATE TABLE aga_Promo(
        Id_promo        Int  Auto_increment  NOT NULL ,
        Nom_promo       Varchar (255) ,
        DateDebut_promo Date ,
        DateFin_promo   Date ,
        Place_promo     Int
	,CONSTRAINT aga_Promo_PK PRIMARY KEY (Id_promo)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: aga_Cours
#------------------------------------------------------------

CREATE TABLE aga_Cours(
        Id_cours         Int  Auto_increment  NOT NULL ,
        Date_cours       Date ,
        HeureDebut_cours Time ,
        HeureFin_cours   Time NOT NULL ,
        Code_cours       Varchar (255) NOT NULL ,
        Id_promo         Int NOT NULL
	,CONSTRAINT aga_Cours_PK PRIMARY KEY (Id_cours)

	,CONSTRAINT aga_Cours_aga_Promo_FK FOREIGN KEY (Id_promo) REFERENCES aga_Promo(Id_promo)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: aga_Role
#------------------------------------------------------------

CREATE TABLE aga_Role(
        Id_role  Int  Auto_increment  NOT NULL ,
        Nom_role Varchar (255)
	,CONSTRAINT aga_Role_PK PRIMARY KEY (Id_role)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: aga_Utilisateur
#------------------------------------------------------------

CREATE TABLE aga_Utilisateur(
        Id_utilisateur          Int  Auto_increment  NOT NULL ,
        Nom_utilisateur         Varchar (255) ,
        Prenom_utilisateur      Varchar (255) ,
        MotDePasse_utilisateur  Varchar (255) ,
        Activiation_utilisateur Bool ,
        Email_utilisateur       Varchar (255) ,
        Id_role                 Int NOT NULL
	,CONSTRAINT aga_Utilisateur_AK UNIQUE (Email_utilisateur)
	,CONSTRAINT aga_Utilisateur_PK PRIMARY KEY (Id_utilisateur)

	,CONSTRAINT aga_Utilisateur_aga_Role_FK FOREIGN KEY (Id_role) REFERENCES aga_Role(Id_role)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: aga_UtilisateurPromo
#------------------------------------------------------------

CREATE TABLE aga_UtilisateurPromo(
        Id_utilisateur Int NOT NULL ,
        Id_promo       Int NOT NULL
	,CONSTRAINT aga_UtilisateurPromo_PK PRIMARY KEY (Id_utilisateur,Id_promo)

	,CONSTRAINT aga_UtilisateurPromo_aga_Utilisateur_FK FOREIGN KEY (Id_utilisateur) REFERENCES aga_Utilisateur(Id_utilisateur)
	,CONSTRAINT aga_UtilisateurPromo_aga_Promo0_FK FOREIGN KEY (Id_promo) REFERENCES aga_Promo(Id_promo)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: aga_UtilisateursCours
#------------------------------------------------------------

CREATE TABLE aga_UtilisateursCours(
        Id_cours                  Int NOT NULL ,
        Id_utilisateur            Int NOT NULL ,
        Absence_UtilisateursCours Bool NOT NULL ,
        Retard_UtilisateursCours  Bool NOT NULL
	,CONSTRAINT aga_UtilisateursCours_PK PRIMARY KEY (Id_cours,Id_utilisateur)

	,CONSTRAINT aga_UtilisateursCours_aga_Cours_FK FOREIGN KEY (Id_cours) REFERENCES aga_Cours(Id_cours)
	,CONSTRAINT aga_UtilisateursCours_aga_Utilisateur0_FK FOREIGN KEY (Id_utilisateur) REFERENCES aga_Utilisateur(Id_utilisateur)
)ENGINE=InnoDB;

