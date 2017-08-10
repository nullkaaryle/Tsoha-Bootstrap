INSERT INTO Potilas (etunimi, sukunimi, syntymaaika)
    VALUES ('Kerkko', 'Kuja', '1975-04-15');

INSERT INTO Potilas (etunimi, sukunimi, syntymaaika)
    VALUES ('Hannes', 'Horminen', '1943-12-08');

INSERT INTO Potilas (etunimi, sukunimi, syntymaaika)
    VALUES ('Tiia', 'Turakka', '1993-07-03');

INSERT INTO Potilas (etunimi, sukunimi, syntymaaika)
    VALUES ('Veikko', 'Vaara', '1975-04-02');

INSERT INTO Potilas (etunimi, sukunimi, syntymaaika)
    VALUES ('Tuua', 'Turakka', '1993-07-03');



INSERT INTO Laakari (etunimi, sukunimi, tunnus)
    VALUES ('Kaarlo', 'Kauhanen', 00032);

INSERT INTO Laakari (etunimi, sukunimi, tunnus)
    VALUES ('Heini', 'Hukkala', 94331);

INSERT INTO Laakari (etunimi, sukunimi, tunnus)
    VALUES ('Leena', 'Ulpu-Meriö', 43980);

INSERT INTO Laakari (etunimi, sukunimi, tunnus)
    VALUES ('Ville', 'Vaahtera', 23456);

INSERT INTO Laakari (etunimi, sukunimi, tunnus)
    VALUES ('Kaisa', 'Granqvist', 46832);



INSERT INTO Apteekki (nimi, kayttajatunnus, salasana)
    VALUES ('Kumpulan Apteekki', 'AptKum', 'AptKum123');

INSERT INTO Apteekki (nimi, kayttajatunnus, salasana)
    VALUES ('Kervolan Apteekki', 'Kervola', 'Kervola20171');

INSERT INTO Apteekki (nimi, kayttajatunnus, salasana)
    VALUES ('Apteekki Apu', 'apu', 'apu');

INSERT INTO Apteekki (nimi, kayttajatunnus, salasana)
    VALUES ('Pain Pharmacy', 'pp', 't6JK2X76Sg');

INSERT INTO Apteekki (nimi, kayttajatunnus, salasana)
    VALUES ('Gurulan Nuha ja Kuume Oy', 'Gurula', 'salasana');



INSERT INTO Laake (tuotenimi, pakkaus, kayttoaihe)
    VALUES ('Kipuxin', '10 tablettia', 'Kaikenlaisen kivun hoitoon.');

INSERT INTO Laake (tuotenimi, pakkaus, kayttoaihe)
    VALUES ('Kipuxin Comp', '10 tablettia', 'Kaikenlaisen kivun ja kuumeen hoitoon.');

INSERT INTO Laake (tuotenimi, pakkaus, kayttoaihe)
    VALUES ('Nitrocortison', '1 tuubi', 'Ohimeneviin sydänsärkyihin.');

INSERT INTO Laake (tuotenimi, pakkaus, kayttoaihe)
    VALUES ('Yzcin', '50 millilitraa', 'Limaisten yskien hoitoon.');

INSERT INTO Laake (tuotenimi, pakkaus, kayttoaihe)
    VALUES ('TimoteiPlus', '30 kapselia', 'Käytetään nenän timoteikutitukseen heinäkuisin.');

INSERT INTO Laake (tuotenimi, pakkaus, kayttoaihe)
    VALUES ('Kipuxin Comp Plus', '100 tablettia', 'Kaikenlaisen kivun, kuumeen ja kutinan hoitoon.');



INSERT INTO Ainesosa (aine)
    VALUES ('ibuxitiini');

INSERT INTO Ainesosa (aine)
    VALUES ('gurglium');

INSERT INTO Ainesosa (aine)
    VALUES ('comppaaja');

INSERT INTO Ainesosa (aine)
    VALUES ('kutizinhappo');

INSERT INTO Ainesosa (aine)
    VALUES ('nitroprofeeni');



INSERT INTO Laakkeenosa (laake, ainesosa, vahvuus)
    VALUES (1, 1, '15 milligrammaa');

INSERT INTO Laakkeenosa (laake, ainesosa, vahvuus)
    VALUES (2, 1, '15 milligrammaa');

INSERT INTO Laakkeenosa (laake, ainesosa, vahvuus)
    VALUES (2, 3, '50 milligrammaa');

INSERT INTO Laakkeenosa (laake, ainesosa, vahvuus)
    VALUES (3, 5, '300 milligrammaa');

INSERT INTO Laakkeenosa (laake, ainesosa, vahvuus)
    VALUES (4, 2, '7 millilitraa');

INSERT INTO Laakkeenosa (laake, ainesosa, vahvuus)
    VALUES (4, 3, '43 millilitraa');

INSERT INTO Laakkeenosa (laake, ainesosa, vahvuus)
    VALUES (5, 4, '35 yksikköä');

INSERT INTO Laakkeenosa (laake, ainesosa, vahvuus)
    VALUES (6, 1, '15 milligrammaa');

INSERT INTO Laakkeenosa (laake, ainesosa, vahvuus)
    VALUES (6, 3, '50 milligrammaa');

INSERT INTO Laakkeenosa (laake, ainesosa, vahvuus)
    VALUES (6, 2, '100 milligrammaa');



INSERT INTO Resepti (apteekki, potilas, laakari, laake, ohje, paivamaara)
    VALUES (1, 1, 1, 1, '2 tablettia iltaisin.', '2017-07-03');

INSERT INTO Resepti (apteekki, potilas, laakari, laake, ohje, paivamaara)
    VALUES (2, 2, 2, 2, '2 tablettia aamuin illoin.', '2017-06-05');

INSERT INTO Resepti (apteekki, potilas, laakari, laake, ohje, paivamaara)
    VALUES (3, 3, 3, 3, 'Voidetta 3 kertaa päivässä sydämen kohdalle', '2017-08-10');

INSERT INTO Resepti (apteekki, potilas, laakari, laake, ohje, paivamaara)
    VALUES (4, 4, 4, 4, '5 millilitraa aina tarvittaessa.', '2016-07-03');

INSERT INTO Resepti (apteekki, potilas, laakari, laake, ohje, paivamaara)
    VALUES (5, 5, 5, 5, '1 tabletti vuorokaudessa.', '2016-11-25');

INSERT INTO Resepti (apteekki, potilas, laakari, laake, ohje, paivamaara)
    VALUES (1, 2, 3, 6, '10 tablettia vuorokaudessa.', '2017-04-25');

INSERT INTO Resepti (apteekki, potilas, laakari, laake, ohje, paivamaara)
    VALUES (5, 4, 3, 1, '0,5 tablettia aamupalan kanssa.', '2017-01-11');