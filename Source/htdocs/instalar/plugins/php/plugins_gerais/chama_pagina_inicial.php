<?php

// chama a pagina inicial
function chama_pagina_inicial(){

// pagia inicial
$pagina_inicial = PAGINA_INICIAL;

// redireciona
header("Location: $pagina_inicial");

};

?>