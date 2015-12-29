<?php

$app->group(['namespace' => 'App\Http\Controllers', 'prefix' => 'v1'], function ($app) {
    /*
     * Cards
     */
    $app->get('cards', 'CardsController@index');
    $app->get('cards/{number:\d{8}}', 'CardsController@show');

    /*
     * Balances
     */
    $app->get('cards/{number:\d{8}}/balances', 'BalancesController@index');
    $app->post('cards/{number:\d{8}}/balances', 'BalancesController@store');

    /*
     * Notifications
     */
    $app->put('cards/{number:\d{8}}/notifications/{id}', 'NotificationsController@update');

    /*
     * Districts
     */
    $app->get('districts', 'DistrictsController@index');

    /*
     * Neighborhoods
     */
    $app->get('neighborhoods', 'NeighborhoodsController@index');

    /*
     * Agencies
     */
    $app->get('agencies', 'AgenciesController@index');

    /*
     * Hooks
     */
    $app->post('hooks/mpeso-agencies', 'HooksControoler@mpesoAgencies');
});
