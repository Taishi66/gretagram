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
        mdp     Varchar (50) NOT NULL ,
        CONSTRAINT user_PK PRIMARY KEY (id_user)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: hashtag
#------------------------------------------------------------

CREATE TABLE hashtag(
        id_hashtag  Int  Auto_increment  NOT NULL ,
        nom_hashtag Text NOT NULL,
        CONSTRAINT hashtag_PK PRIMARY KEY (id_hashtag)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: compte
#------------------------------------------------------------

CREATE TABLE compte(
        id_compte          Int  Auto_increment  NOT NULL ,
        nom_compte         Varchar (50) NOT NULL ,
        description_compte Text NOT NULL ,
        abonnes            Int ,
        abonnements        Int ,
        publications       Int NOT NULL ,
        id_user            Int NOT NULL,
        CONSTRAINT compte_PK PRIMARY KEY (id_compte),
        CONSTRAINT compte_user_FK FOREIGN KEY (id_user) REFERENCES user(id_user)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: article
#------------------------------------------------------------

CREATE TABLE article(
        id_art    Int Auto_increment NOT NULL ,
        img_art   Text ,
        titre     Varchar (50) NOT NULL ,
        contenu   Text NOT NULL ,
        date      Date NOT NULL ,
        video     Text ,
        `like`      Int ,
        id_compte Int NOT NULL,
        CONSTRAINT article_PK PRIMARY KEY (id_art),
        CONSTRAINT article_compte_FK FOREIGN KEY (id_compte) REFERENCES compte(id_compte)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: commentaire
#------------------------------------------------------------

CREATE TABLE commentaire(
        id_com      Int  Auto_increment  NOT NULL ,
        contenu_com Text NOT NULL ,
        id_art      Int NOT NULL,
        CONSTRAINT commentaire_PK PRIMARY KEY (id_com),
	CONSTRAINT commentaire_article_FK FOREIGN KEY (id_art) REFERENCES article(id_art)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: hashtag_art
#------------------------------------------------------------

CREATE TABLE hashtag_art(
        id_hashtag Int NOT NULL ,
        id_art     Int NOT NULL,
        CONSTRAINT hashtag_art_PK PRIMARY KEY (id_hashtag,id_art),
        CONSTRAINT hashtag_art_hashtag_FK FOREIGN KEY (id_hashtag) REFERENCES hashtag(id_hashtag),
        CONSTRAINT hashtag_art_article0_FK FOREIGN KEY (id_art) REFERENCES article(id_art)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: hashtag_com
#------------------------------------------------------------

CREATE TABLE hashtag_com(
        id_com     Int NOT NULL ,
        id_hashtag Int NOT NULL ,
        CONSTRAINT hashtag_com_PK PRIMARY KEY (id_com,id_hashtag),
        CONSTRAINT hashtag_com_commentaire_FK FOREIGN KEY (id_com) REFERENCES commentaire(id_com),
        CONSTRAINT hashtag_com_hashtag0_FK FOREIGN KEY (id_hashtag) REFERENCES hashtag(id_hashtag)
)ENGINE=InnoDB;

