<?php

// Home page
Router::get('/', 'HomeController@index');

// About page
Router::get('/about', 'AboutController@index');
Router::get('/about/{id}', 'AboutController@index');