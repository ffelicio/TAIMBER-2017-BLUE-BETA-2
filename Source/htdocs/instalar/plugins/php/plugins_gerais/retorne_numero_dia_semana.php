<?php

// retorna o numero do dia da semana
function retorne_numero_dia_semana(){

// valida dia
switch(date("D")){
	
	case "Sun":
	return 1;
	break;
	
    case "Mon":
	return 2;
	break;
	
    case "Tue":
	return 3;
	break;
	
    case "Wed":
	return 4;
	break;
	
    case "Thu":
	return 5;
	break;
	
    case "Fri":
	return 6;
	break;
	
    case "Sat":
	return 7;
	break;

};

};

?>