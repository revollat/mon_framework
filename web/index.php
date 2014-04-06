<?php
use Symfony\Component\HttpFoundation\Response;

require_once __DIR__.'/../vendor/autoload.php';

// Twig template engine
$twig = new Twig_Environment(new Twig_Loader_Filesystem(array(
    realpath(__DIR__ . '/../views'),
)));

$response = new Response($twig->render('test.html.twig', array('toto' => 'essai')));

$response->send();
