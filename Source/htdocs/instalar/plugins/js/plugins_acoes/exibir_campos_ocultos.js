
// exibe os campos ocultos
function exibir_campos_ocultos(){

//id de campo
var v_idcampo = "id_div_campo_publicacao_usuario";

// valida elemento existe
if(retorna_elemento_id_existe(v_idcampo) == true){
	
	// exibe o campo de publicacao
	document.getElementById(v_idcampo).style.display = "table";

};

};
