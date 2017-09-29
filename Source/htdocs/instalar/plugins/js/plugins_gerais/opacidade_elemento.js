
// opacidade em elemento
function opacidade_elemento(idcampo_1, modo){

// valida o modo
switch(modo){
	
	case 0:
	document.getElementById(idcampo_1).style.opacity = "1";
	break;
	
	case 1:
	document.getElementById(idcampo_1).style.opacity = "0";
	break;
	
};

};
