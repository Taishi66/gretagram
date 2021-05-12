#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: user
#------------------------------------------------------------

CREATE TABLE user(
        id_user Int  Auto_increment  NOT NULL ,
        nom     Varchar (50) NOT NULL ,
        prenom  Varchar (50) NOT NULL ,
        email   Varchar (50) NOT NULL ,
        mdp     Varchar (50) NOT NULL
	,CONSTRAINT user_PK PRIMARY KEY (id_user)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: compte
#------------------------------------------------------------

CREATE TABLE compte(
        id_compte          Int  Auto_increment  NOT NULL ,
        description_compte Varchar (50) NOT NULL ,
        abonnes            Int NOT NULL ,
        abonnements        Int NOT NULL ,
        publications       Int NOT NULL ,
        id_user            Int NOT NULL
	,CONSTRAINT compte_PK PRIMARY KEY (id_compte)

	,CONSTRAINT compte_user_FK FOREIGN KEY (id_user) REFERENCES user(id_user)
	,CONSTRAINT compte_user_AK UNIQUE (id_user)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: article
#------------------------------------------------------------

CREATE TABLE article(
        id_article               Int  Auto_increment  NOT NULL ,
        titre                    Varchar (50) NOT NULL ,
        contenu                  Text NOT NULL ,
        date_art                 Date NOT NULL ,
        likes                    Int NOT NULL ,
        media                    Text NOT NULL ,
        id_compte                Int NOT NULL ,
        id_compte_compte_article Int NOT NULL
	,CONSTRAINT article_AK UNIQUE (id_compte)
	,CONSTRAINT article_PK PRIMARY KEY (id_article)

	,CONSTRAINT article_compte_FK FOREIGN KEY (id_compte_compte_article) REFERENCES compte(id_compte)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: commentaire
#------------------------------------------------------------

CREATE TABLE commentaire(
        id_com      Int  Auto_increment  NOT NULL ,
        contenu_com Text NOT NULL ,
        id_compte   Int NOT NULL ,
        id_article  Int NOT NULL
	,CONSTRAINT commentaire_PK PRIMARY KEY (id_com)

	,CONSTRAINT commentaire_compte_FK FOREIGN KEY (id_compte) REFERENCES compte(id_compte)
	,CONSTRAINT commentaire_article0_FK FOREIGN KEY (id_article) REFERENCES article(id_article)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: likes
#------------------------------------------------------------

CREATE TABLE likes(
        id_like    Int  Auto_increment  NOT NULL ,
        date_like  Date NOT NULL ,
        id_article Int NOT NULL
	,CONSTRAINT likes_PK PRIMARY KEY (id_like)

	,CONSTRAINT likes_article_FK FOREIGN KEY (id_article) REFERENCES article(id_article)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: compte_like
#------------------------------------------------------------

CREATE TABLE compte_like(
        id_like   Int NOT NULL ,
        id_compte Int NOT NULL
	,CONSTRAINT compte_like_PK PRIMARY KEY (id_like,id_compte)

	,CONSTRAINT compte_like_likes_FK FOREIGN KEY (id_like) REFERENCES likes(id_like)
	,CONSTRAINT compte_like_compte0_FK FOREIGN KEY (id_compte) REFERENCES compte(id_compte)
)ENGINE=InnoDB;

