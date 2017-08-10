<?php

    $routes->get('/', function() {
        HelloWorldController::index();
    });

    $routes->get('/hiekkalaatikko', function() {
        HelloWorldController::sandbox();
    });

    $routes->get('/reseptit', function() {
        ReseptitController::nayta_reseptilistaus();
    });

     $routes->get('/reseptit/1', function() {
        HelloWorldController::nayta_resepti();
    });

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