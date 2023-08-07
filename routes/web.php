<?php

// Example of registering a route
// method('route', 'ControllerName@ActionName');

// Home page
Router::get('/', 'HomeController@indexAction');

// About page
Router::get('/about', 'AboutController@indexAction');
Router::get('/about/{id}', 'AboutController@indexAction');