<?php 

use \Hcode\Page;
use \Hcode\PageAdmin;
use \Hcode\Model\User;
use \Hcode\Model\Category;


/* Rota para a pagina principal de categorias - Lista de categorias*/
$app->get('/admin/categories', function() {

	User::verifyLogin();
	
	$categories = Category::listAll();

	$page = new PageAdmin();

	$page->setTpl("categories", [
		"categories"=>$categories
	]);
	

});

/* Rota para a tela de cadastro de categorias - Tela Novo Categoria*/
$app->get('/admin/categories/create', function() {

	User::verifyLogin();
	
	$page = new PageAdmin();

	$page->setTpl("categories-create");

});

/* Rota para a funcionalidade de inclusão de categorias - save*/
$app->post('/admin/categories/create', function() {

	User::verifyLogin();
	
	$category = new Category();

	$category->setData($_POST);

	$category->save();

	header("Location: /ecommerce/admin/categories");
	exit;

});

/* Rota para a funcionalidade de exclusão de categorias - delete*/
$app->get('/admin/categories/:idcategory/delete', function($idcategory) {

	User::verifyLogin();

	$category = new Category();

	$category->get((int)$idcategory);

	$category->delete();

	header("Location: /ecommerce/admin/categories");
	exit();

});

/* Rota para a tela de alteração de categorias - Tela Alteração*/
$app->get('/admin/categories/:idcategory', function($idcategory) {

	User::verifyLogin();

	$category = new Category();

	$category->get((int)$idcategory);

	$page = new PageAdmin();

	$page->setTpl("categories-update", [
		"category"=>$category->getValues()
	]);

});

/* Rota para a funcionalidade de alteração de categorias - update*/
$app->post('/admin/categories/:idcategory', function($idcategory) {

	User::verifyLogin();

	$category = new Category();

	$category->get((int)$idcategory);

	$category->setData($_POST);

	$category->save();

	header("Location: /ecommerce/admin/categories");
	exit();

});

/* Rota para direcinar para uma categoria especifica*/
$app->get('/categories/:idcategory', function($idcategory) {

	$category = new Category();

	$category->get((int)$idcategory);

	$page = new Page();

    $page->setTpl("category", [

    	"category"=>$category->getValues(),
    	"products"=>[]
	]);

});

 ?>