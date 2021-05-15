#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: hashtag
#------------------------------------------------------------

CREATE TABLE hashtag(
        id_hashtag  Int  Auto_increment  NOT NULL ,
        nom_hashtag Text NOT NULL
	,CONSTRAINT hashtag_PK PRIMARY KEY (id_hashtag)
)ENGINE=InnoDB;


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
        abonnes            Int,
        abonnements        Int,
        publications       Int,
        id_user            Int NOT NULL
	,CONSTRAINT compte_PK PRIMARY KEY (id_compte)

	,CONSTRAINT compte_user_FK FOREIGN KEY (id_user) REFERENCES user(id_user)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: article
#------------------------------------------------------------

CREATE TABLE article(
        id_article Int  Auto_increment  NOT NULL ,
        img_art    Text NOT NULL ,
        titre      Varchar (50) NOT NULL ,
        contenu    Text,
        date_art   Date NOT NULL ,
        video      Text,
        'like'       Int,
        id_compte  Int NOT NULL
	,CONSTRAINT article_PK PRIMARY KEY (id_article)

	,CONSTRAINT article_compte_FK FOREIGN KEY (id_compte) REFERENCES compte(id_compte)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: commentaire
#------------------------------------------------------------

CREATE TABLE commentaire(
        id_com      Int  Auto_increment  NOT NULL ,
        contenu_com Text NOT NULL ,
        id_user     Int NOT NULL ,
        id_article  Int NOT NULL
	,CONSTRAINT commentaire_PK PRIMARY KEY (id_com)

	,CONSTRAINT commentaire_user_FK FOREIGN KEY (id_user) REFERENCES user(id_user)
	,CONSTRAINT commentaire_article0_FK FOREIGN KEY (id_article) REFERENCES article(id_article)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: hashtag_art
#------------------------------------------------------------

CREATE TABLE hashtag_art(
        id_article Int NOT NULL ,
        id_hashtag Int NOT NULL
	,CONSTRAINT hashtag_art_PK PRIMARY KEY (id_article,id_hashtag)

	,CONSTRAINT hashtag_art_article_FK FOREIGN KEY (id_article) REFERENCES article(id_article)
	,CONSTRAINT hashtag_art_hashtag0_FK FOREIGN KEY (id_hashtag) REFERENCES hashtag(id_hashtag)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: hashtag_com
#------------------------------------------------------------

CREATE TABLE hashtag_com(
        id_hashtag Int NOT NULL ,
        id_com     Int NOT NULL
	,CONSTRAINT hashtag_com_PK PRIMARY KEY (id_hashtag,id_com)

	,CONSTRAINT hashtag_com_hashtag_FK FOREIGN KEY (id_hashtag) REFERENCES hashtag(id_hashtag)
	,CONSTRAINT hashtag_com_commentaire0_FK FOREIGN KEY (id_com) REFERENCES commentaire(id_com)
)ENGINE=InnoDB;

