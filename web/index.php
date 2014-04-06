<?php

// 1-
// Pour eviter le message d'erreur si la variable n'est pas dans l'URL en GET.

$input = isset($_GET['name']) ? $_GET['name'] : 'World';

printf('Hello %s', $input);