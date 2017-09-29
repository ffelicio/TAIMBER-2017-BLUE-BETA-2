<?php

// carrega a lista de amigos no perfil basico
function carregar_lista_amigos_perfil_basico($array_dados_amigos, $idusuario_informado){

// valida array de dados de amigos
if(is_array($array_dados_amigos) == true){

    // inverte a ordem do array de dados de amigos
    $array_dados_amigos = inverte_array($array_dados_amigos);
	
};

// contador
$contador = 0;

// carrega a lista de amigos
foreach($array_dados_amigos as $dados){
	
	// valida numero de amigos no perfil
	if($contador >= NUMERO_AMIGOS_CAMPO_PERFIL){

	    // saindo do looping
        break;	
	
	};
	
// id de usuario amigo
$idusuario = retorne_idamigo_dados_amigo(true, $dados, $idusuario_informado);

// valida id de usuario
if($idusuario != null){
	
    // imagem de perfil de usuario
	$imagem_perfil_usuario = constroe_imagem_perfil_miniatura_amizade(false, true, true, $idusuario);

	// html
	$html .= "
	<div class='classe_div_separa_amigo_visualizar_perfil'>
	$imagem_perfil_usuario
	</div>
	";

	// atualiza o contador
    $contador++;

};

};

// retorno
return $html;

};

?>