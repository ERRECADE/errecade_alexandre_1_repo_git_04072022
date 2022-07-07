#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------
#------------------------------------------------------------
# Table: users
#------------------------------------------------------------
 
CREATE TABLE users(
        id         Int  Auto_increment  NOT NULL ,
	is_admin   TinyINT ,
        nom        Varchar (255) ,
        prenom     Varchar (255) ,
        email      Varchar (255) ,
        password   Varchar (64) ,
        is_actif   TinyINT ,
        created_at Date NOT NULL ,
        update_at  Date NOT NULL
                ,CONSTRAINT users_PK PRIMARY KEY (id)
)ENGINE=InnoDB;
        

 
 
#------------------------------------------------------------
# Table: blog
#------------------------------------------------------------
 
CREATE TABLE blog(
        id           Int  Auto_increment  NOT NULL ,
        titre Varchar (255) NOT NULL ,
        texte Text NOT NULL ,
        chapo Text NOT NULL ,
        created_at   Date NOT NULL ,
        update_at    Date NOT NULL ,
        users_id     Int NOT NULL
                ,CONSTRAINT blog_AK FOREIGN KEY (users_id)REFERENCES users(id)
                ,CONSTRAINT blog_PK PRIMARY KEY (id)
)ENGINE=InnoDB;
 
 
#------------------------------------------------------------
# Table: commentaire
#------------------------------------------------------------
 
CREATE TABLE commentaire(
        id          Int  Auto_increment  NOT NULL ,
        titre       Varchar (255) ,
        commentaire Text ,
        date        Date ,
        is_actif    TinyINT ,
        created_at  Date ,
        update_at   Date ,
        users_id    Int NOT NULL
                ,CONSTRAINT commentaire_AK FOREIGN KEY (users_id)REFERENCES users(id)
                ,CONSTRAINT commentaire_PK PRIMARY KEY (id)
)ENGINE=InnoDB;