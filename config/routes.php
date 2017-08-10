<?php

    $routes->get('/', function() {
        HelloWorldController::index();
    });

    $routes->get('/hiekkalaatikko', function() {
        HelloWorldController::sandbox();
    });

// RESEPTI 

    $routes->get('/reseptit', function() {
        ReseptitController::nayta_reseptilistaus();
    });

    //create
    $routes->get('/reseptit/uusi', function() {
        ReseptitController::nayta_reseptinlisays();
    });

    $routes->get('/reseptit/:id', function($id) {
        ReseptitController::nayta_resepti($id);
    });



// AINESOSAT

    $routes->get('/ainesosat', function() {
        AinesosatController::nayta_ainesosalistaus();
    });

    //create
    $routes->get('/ainesosat/uusi', function() {
        AinesosatController::nayta_ainesosanlisays();
    });

    $routes->get('/ainesosat/:id', function($id) {
        AinesosatController::nayta_ainesosa($id);
    });

    //store
    $routes->post('/ainesosat/', function() {
        AinesosatController::tallenna_ainesosa();
    });

    

    

// MUUT

    $routes->get('/etusivu', function() {
        HelloWorldController::nayta_etusivu();
    });

    $routes->get('/kirjautuminen', function() {
        HelloWorldController::nayta_kirjautuminen();
    });

    $routes->get('/reseptit/1', function() {
        HelloWorldController::nayta_resepti();
    });

    $routes->get('/reseptit/1/muokkaus', function() {
        HelloWorldController::nayta_reseptinmuokkaus();
    });

    $routes->get('/laakkeet', function() {
        HelloWorldController::nayta_laakelistaus();
    });

    $routes->get('/laakkeet/1', function() {
        HelloWorldController::nayta_laake();
    });

    $routes->get('/laakkeet/1/muokkaus', function() {
        HelloWorldController::nayta_laakkeenmuokkaus();
    });