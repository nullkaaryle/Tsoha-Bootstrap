-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Apteekki
( 
id SERIAL PRIMARY KEY,
kayttajatunnus varchar(15) UNIQUE NOT NULL,
salasana INTEGER NOT NULL
);

CREATE TABLE Laakeaine
( 
id SERIAL PRIMARY KEY,
laakeaine varchar(30) NOT NULL
);

CREATE TABLE Laake
( 
id SERIAL PRIMARY KEY,
nimi varchar(15) NOT NULL,
laakeaine1 varchar(30) NOT NULL,
laakeaine2 varchar(30) NOT NULL,
laakeaine3 varchar(30) NOT NULL,
vahvuus INTEGER NOT NULL,
pakkaus INTEGER NOT NULL,
kaytto varchar(100) NOT NULL,
FOREIGN KEY laakeaine1 REFERENCES Laakeaine(id),
FOREIGN KEY laakeaine2 REFERENCES Laakeaine(id),
FOREIGN KEY laakeaine3 REFERENCES Laakeaine(id)
);

CREATE TABLE Resepti
( 
id SERIAL PRIMARY KEY,
laake varchar(15) NOT NULL,
potilas varchar(50) NOT NULL,
laakari varchar(50) NOT NULL,
ohje varchar(100) NOT NULL,
paivamaara DATE,
FOREIGN KEY laake REFERENCES Laake(id) 
);