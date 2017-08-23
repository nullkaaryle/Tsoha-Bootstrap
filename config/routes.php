<?php

    function check_logged_in(){
        BaseController::check_logged_in();
    }

    $routes->get('/', function() {
        HelloWorldController::index();
    });

    $routes->get('/etusivu', function() {
        HelloWorldController::nayta_etusivu();
    });

    $routes->get('/hiekkalaatikko', function() {
        HelloWorldController::sandbox();
    });

// KIRJAUTUMINEN

    $routes->get('/kirjautuminen', function() {
        ApteekitController::nayta_kirjautuminen();
    });

    $routes->post('/kirjautuminen', function() {
        ApteekitController::kirjaudu_sisaan();
    });

    $routes->post('/kirjaudu_ulos', 'check_logged_in', function() {
        ApteekitController::kirjaudu_ulos();
    });


// RESEPTI 

    $routes->get('/reseptit', 'check_logged_in', function() {
        ReseptitController::nayta_reseptilistaus();
    });

    //create
    $routes->get('/reseptit/uusi', 'check_logged_in', function() {
        ReseptitController::nayta_reseptinlisays();
    });

    $routes->get('/reseptit/:id', 'check_logged_in', function($id) {
        ReseptitController::nayta_resepti($id);
    });

    $routes->get('/reseptit/:id/muokkaus', 'check_logged_in', function($id) {
        ReseptitController::nayta_reseptinmuokkaus($id);
    });



// AINESOSAT

    $routes->get('/ainesosat', 'check_logged_in', function() {
        AinesosatController::nayta_ainesosalistaus();
    });

    //create
    $routes->get('/ainesosat/uusi', 'check_logged_in', function() {
        AinesosatController::nayta_ainesosanlisays();
    });

    $routes->get('/ainesosat/:id', 'check_logged_in', function($id) {
        AinesosatController::nayta_ainesosa($id);
    });

    //store
    $routes->post('/ainesosat/', 'check_logged_in', function() {
        AinesosatController::tallenna_ainesosa();
    });

    $routes->get('/ainesosat/:id/muokkaa', 'check_logged_in', function($id) {
        AinesosatController::nayta_ainesosanmuokkaus($id);
    });

    $routes->post('/ainesosat/:id/muokkaa', 'check_logged_in', function($id) {
        AinesosatController::muokkaa_ainesosaa($id);
    });

    $routes->post('/ainesosat/:id/poista', 'check_logged_in', function($id) {
        AinesosatController::poista_ainesosa($id);
    });




// LÄÄKKEET  

    $routes->get('/laakkeet', 'check_logged_in', function() {
        LaakkeetController::nayta_laakelistaus();
    });

    $routes->get('/laakkeet/:id', 'check_logged_in', function($id) {
        LaakkeetController::nayta_laake($id);
    });

    $routes->get('/laakkeet/:id/muokkaus', function($id) {
        LaakkeetController::nayta_laakkeenmuokkaus($id);
    });

// MUUT

    
   

    