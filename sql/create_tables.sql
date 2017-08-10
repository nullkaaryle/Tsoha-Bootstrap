CREATE TABLE Potilas (
    id              SERIAL PRIMARY KEY,
    etunimi         VARCHAR(15) NOT NULL,
    sukunimi        VARCHAR(15) NOT NULL,
    syntymaaika     DATE NOT NULL
);

CREATE TABLE Laakari (
    id              SERIAL PRIMARY KEY,
    etunimi         VARCHAR(15) NOT NULL,
    sukunimi        VARCHAR(15) NOT NULL,
    tunnus          INTEGER UNIQUE CHECK (tunnus < 100000) NOT NULL
);

CREATE TABLE Apteekki (
    id              SERIAL PRIMARY KEY,
    nimi            VARCHAR(30) NOT NULL,
    kayttajatunnus  VARCHAR(15) UNIQUE NOT NULL,
    salasana        VARCHAR(15) NOT NULL
);

CREATE TABLE Laake (
    id              SERIAL PRIMARY KEY,
    tuotenimi       VARCHAR(30) UNIQUE NOT NULL,
    pakkaus         VARCHAR(30) NOT NULL,
    kayttoaihe      VARCHAR(100) NOT NULL
);

CREATE TABLE Ainesosa (
    id              SERIAL PRIMARY KEY,
    aine            VARCHAR(30) UNIQUE NOT NULL
);

CREATE TABLE Laakkeenosa (
    id              SERIAL PRIMARY KEY,
    laake           INTEGER NOT NULL,
    ainesosa        INTEGER NOT NULL,
    vahvuus         VARCHAR(30),
    FOREIGN KEY (laake)       REFERENCES Laake(id),
    FOREIGN KEY (ainesosa)    REFERENCES Ainesosa(id)
);

CREATE TABLE Resepti (
    id              SERIAL PRIMARY KEY,
    apteekki        INTEGER NOT NULL,
    potilas         INTEGER NOT NULL,
    laakari         INTEGER NOT NULL,
    laake           INTEGER NOT NULL,
    ohje            VARCHAR(100) NOT NULL,
    paivamaara      DATE NOT NULL,
    FOREIGN KEY (apteekki)      REFERENCES Apteekki(id),
    FOREIGN KEY (potilas)       REFERENCES Potilas(id),
    FOREIGN KEY (laakari)       REFERENCES Laakari(id),
    FOREIGN KEY (laake)         REFERENCES Laake(id)
);