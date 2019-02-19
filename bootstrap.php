<?php
require_once __DIR__ . '/vendor/autoload.php';

use Ig0rbm\HandyBox\HandyBoxContainer;
use Kulaxyz\Blog\boxes\ModelBox;
use Kulaxyz\Blog\boxes\DBDriverBox;
use Kulaxyz\Blog\boxes\ValidatorBox;
use Kulaxyz\Blog\boxes\UserHelpBox;
use Kulaxyz\Blog\boxes\FormBox;
use Kulaxyz\Blog\boxes\FormBuilderBox;



session_start();

$container = new HandyBoxContainer();

$container->register(new DBDriverBox);
$container->register(new ValidatorBox);
$container->register(new ModelBox);
$container->register(new UserHelpBox);
$container->register(new FormBox);
$container->register(new FormBuilderBox);




