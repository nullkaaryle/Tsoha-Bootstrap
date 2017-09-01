<?php

    function check_logged_in(){
        BaseController::check_logged_in();
    }

    $routes->get('/', function() {
        EtusivuController::index();
    });

    $routes->get('/etusivu', function() {
        EtusivuController::nayta_etusivu();
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

    $routes->get('/reseptit/uusi', 'check_logged_in', function() {
        ReseptitController::nayta_reseptinlisays();
    });

    $routes->get('/reseptit/:id', 'check_logged_in', function($id) {
        ReseptitController::nayta_resepti($id);
    });

     $routes->post('/reseptit/', 'check_logged_in', function() {
        ReseptitController::tallenna_resepti();
    });

    $routes->get('/reseptit/:id/muokkaa', 'check_logged_in', function($id) {
        ReseptitController::nayta_reseptinmuokkaus($id);
    });

    $routes->post('/reseptit/:id/muokkaa', 'check_logged_in', function($id) {
        ReseptitController::muokkaa_reseptia($id);
    });

    $routes->post('/reseptit/:id/poista', 'check_logged_in', function($id) {
        ReseptitController::poista_resepti($id);
    });


// AINESOSAT

    $routes->get('/ainesosat', 'check_logged_in', function() {
        AinesosatController::nayta_ainesosalistaus();
    });

    $routes->get('/ainesosat/uusi', 'check_logged_in', function() {
        AinesosatController::nayta_ainesosanlisays();
    });

    $routes->get('/ainesosat/:id', 'check_logged_in', function($id) {
        AinesosatController::nayta_ainesosa($id);
    });
   
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
    



    
   

    