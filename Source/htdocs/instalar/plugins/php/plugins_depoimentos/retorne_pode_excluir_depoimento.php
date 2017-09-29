<?php

// retorna se pode excluir o depoimento
function retorne_pode_excluir_depoimento($dados){

// separa dados
$id = $dados["id"];
$uid = $dados[UID];
$uidamigo = $dados[UIDAMIGO];

// id de usuario logado
$idusuario = retorne_idusuario_logado();

// valida id
if($id == null){
	
	// nao pode excluir depoimento
    return false;
	
};

// valida usuario pode apagar depoimento
if($uid == $idusuario or $uidamigo == $idusuario){

	// pode excluir depoimento
    return true;
	
}else{
	
	// nao pode excluir depoimento
    return false;
	
};

};

?>