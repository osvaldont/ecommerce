<?php 

use \Hcode\PageAdmin;
use \Hcode\Model\User;


/* Rota para a pagina principal de usuarios - Lista de usuarios*/
$app->get('/admin/users', function() {

	User::verifyLogin();

	$users = User::listAll();

	$page = new PageAdmin();

    $page->setTpl("users", array(
    	"users"=>$users
    ));

});

/* Rota para a tela de cadastro de usuário - Tela Novo Usuário*/
$app->get('/admin/users/create', function() {

	User::verifyLogin();

	$page = new PageAdmin();

    $page->setTpl("users-create");

});

/* Rota para a funcionalidade de exclusão de usuário - delete*/
$app->get('/admin/users/:iduser/delete', function($iduser) {

	User::verifyLogin();

	$user = new User();

	$user->get((int)$iduser);

	$user->delete();

	header("Location: /ecommerce/admin/users");
	exit();

});

/* Rota para a tela de alteração de usuário - Tela Alteração*/
$app->get('/admin/users/:iduser', function($iduser) {

	User::verifyLogin();

	$user = new User();

	$user->get((int)$iduser);

	$page = new PageAdmin();

	$page->setTpl("users-update", array(
		"user"=>$user->getValues()
	));
   

});

/* Rota para a funcionalidade de inclusão de categorias - save*/
$app->post('/admin/users/create', function() {

	User::verifyLogin();

	$user = new User();

	$_POST["inadmin"] = (isset($_POST["inadmin"]))?1:0;

	$password = password_hash($_POST["despassword"], PASSWORD_DEFAULT,[
		"cost"=>12
	]);

	$_POST["despassword"] = $password;

	$user->setData($_POST);

	$user->save();

	header("Location: /ecommerce/admin/users");
	exit();
	

});

/* Rota para a funcionalidade de alteração de usuário - update*/
$app->post('/admin/users/:iduser', function($iduser) {

	User::verifyLogin();

	$user = new User();

	$_POST["inadmin"] = (isset($_POST["inadmin"]))?1:0;

	$user->get((int)$iduser);

	$user->setData($_POST);

	$user->update();

	header("Location: /ecommerce/admin/users");
	exit();

});


 ?>