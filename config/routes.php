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

    $routes->get('/ainesosat/:id/muokkaa', function($id) {
        AinesosatController::nayta_ainesosanmuokkaus($id);
    });

    $routes->post('/ainesosat/:id/muokkaa', function($id) {
        AinesosatController::muokkaa_ainesosaa($id);
    });

    $routes->post('/ainesosat/:id/poista', function($id) {
        AinesosatController::poista_ainesosa($id);
    });




// LÄÄKKEET  

    $routes->get('/laakkeet', function() {
        LaakkeetController::nayta_laakelistaus();
    });

    $routes->get('/laakkeet/:id', function($id) {
        LaakkeetController::nayta_laake($id);
    });

// MUUT

    $routes->get('/etusivu', function() {
        HelloWorldController::nayta_etusivu();
    });

    $routes->get('/kirjautuminen', function() {
        HelloWorldController::nayta_kirjautuminen();
    });

    $routes->get('/reseptit/1/muokkaus', function() {
        HelloWorldController::nayta_reseptinmuokkaus();
    });

    

    $routes->get('/laakkeet/1/muokkaus', function() {
        HelloWorldController::nayta_laakkeenmuokkaus();
    });