<?php

    use SelfPhp\Route;


    /******************************************************************
     *  
     *                  ____________________________________
     * 
     * 
     *                      S.P. Framework v1.0
     * 
     *                  ____________________________________                        
     * 
     */
    Route::get('/', 'AuthController@login');
    Route::get('/dashboard', 'DashboardController@index');

    Route::post('/events/create', 'DashboardController@create_events');

    Route::get('/login', 'AuthController@login');
    Route::get('/register', 'AuthController@signup');

    Route::post('/login', 'AuthController@login_user'); 
    Route::post('/register', 'AuthController@signup_user');
    Route::post('/users/create', 'AuthController@signup_user');
    Route::post('/auth/authentication-settings', 'AuthController@settings');

    Route::post('/clients/create', 'DashboardController@create_clients');

    // Get resources
    Route::post('/users/get-users', 'AuthController@fetch_users'); 
    Route::post('/events/get-events', 'DashboardController@fetch_events');
    Route::post('/clients/get-clients', 'ClientsController@fetch_clients');
    Route::post('/clients/update-client', 'ClientsController@update_clients');
    Route::post('/clients/delete-client', 'ClientsController@delete_clients');
    Route::post('/tickets/create-ticket', 'TicketController@create_tickets');
    Route::post('/tickets/get-tickets', 'TicketController@fetch_tickets');

    Route::get('/logout', 'AuthController@logout'); 
