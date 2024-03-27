CREATE DATABASE scacchi;
USE scacchi;
CREATE TABLE utenti(
    idUtente INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(32) NOT NULL,
    cognome VARCHAR(32) NOT NULL,
    cittan VARCHAR(50) NOT NULL,
    datan DATE NOT NULL,
    nutente VARCHAR(32) NOT NULL,
    email VARCHAR(256) NOT NULL,
    pwd VARCHAR(128) NOT NULL,
    grado varchar(1) NOT NULL);

INSERT INTO utenti(nome,cognome,nutente,pwd,cittan,datan,email,grado) VALUES 
    ('Matteo','Panicciari','matteo','panicciari1','Civitanova Marche','2003-07-28','panicciari.matteo@istitutomontani.edu.it','1'),
    ('Lorenzo','Lallone','lorenzo','lallone1','Alba Adriatica','2003-04-09','lallone.lorenzo@istitutomontani.edu.it','0'),
    ('Lorenzo','Lallone','lorenzo1','lallone1','Alba Adriatica','2003-04-09','1a@b','0'),
    ('Lorenzo','Lallone','lorenzo2','lallone1','Alba Adriatica','2003-04-09','2a@b','0'),
    ('Lorenzo','Lallone','lorenzo3','lallone1','Alba Adriatica','2003-04-09','3a@b','0'),
    ('Lorenzo','Lallone','lorenzo4','lallone1','Alba Adriatica','2003-04-09','4a@b','0'),
    ('Lorenzo','Lallone','lorenzo5','lallone1','Alba Adriatica','2003-04-09','5a@b','0'),
    ('Lorenzo','Lallone','lorenzo6','lallone1','Alba Adriatica','2003-04-09','6a@b','0'),
    ('Lorenzo','Lallone','lorenzo7','lallone1','Alba Adriatica','2003-04-09','7a@b','0'),
    ('Lorenzo','Lallone','lorenzo8','lallone1','Alba Adriatica','2003-04-09','8a@b','0')