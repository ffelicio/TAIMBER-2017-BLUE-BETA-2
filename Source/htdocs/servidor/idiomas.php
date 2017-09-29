<?php

// valida idioma
switch($_SESSION[SESSAO_IDIOMA]){
	
	case 0:
	include_once("idioma_pt_br.php");
	break;
	
	case 1:
	include_once("idioma_ingles.php");
	break;
	
	default:
	include_once("idioma_pt_br.php");
	
};

?>