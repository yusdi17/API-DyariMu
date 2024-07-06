<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\UserProfileController;
/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('register', 'Auth::register');
$routes->post('/login', 'Auth::login');
$routes->get('users/search', 'UserController::search');
$routes->post('userpost', 'UserPostController::create');
$routes->resource('userpost', ['controller' => 'UserPostController']);
$routes->post('postlike', 'PostLikeController::likePost');
$routes->delete('userpost/(:num)', 'UserPostController::delete/$1');
$routes->resource('userpost', ['controller' => 'UserPostController']);
$routes->group('comment', function ($routes) {
  $routes->get('post/(:num)', 'CommentController::index/$1');
  $routes->post('create', 'CommentController::create');
  $routes->put('update/(:num)', 'CommentController::update/$1');
  $routes->delete('delete/(:num)', 'CommentController::delete/$1');
});

$routes->group('profile', ['namespace' => 'App\Controllers'], function ($routes) {
  $routes->post('create', 'Profile::create');
});

// Contoh routes untuk menampilkan profil
$routes->get('profile/(:num)', 'Profile::show/$1'); // Menggunakan HTTP method GET untuk menampilkan profil berdasarkan user_id





