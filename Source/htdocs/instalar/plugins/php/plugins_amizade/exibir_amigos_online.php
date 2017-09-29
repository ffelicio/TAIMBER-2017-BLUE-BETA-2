<?php

// exibe os amigos online
function exibir_amigos_online(){

// id de usuario
$uid = retorne_idusuario_request();

// valida se zera o contador
if(retorne_campo_formulario_request(20) == true){
	
	// zerando o contador
	contador_avanco(retorne_campo_formulario_request(2), 2);

};

// contador de avanco
$contador = contador_avanco(retorne_campo_formulario_request(2), 3);

// contador final
$contador_final = contador_avanco(retorne_campo_formulario_request(2), 1);

// array de amigos online
$array_dados = retorne_array_amigos_online($uid);

// listando usuarios online
for($contador == $contador; $contador <= $contador_final; $contador++){

	// uid
	$uid = $array_dados[$contador];
	
	// valida usuario online
	if($uid != null){

		// imagem de perfil de usuario
		$imagem_perfil_usuario = constroe_imagem_perfil_miniatura_amizade(false, true, false, $uid);

		// classe
		$classe[0] = "classe_div_separa_amigo_visualizar_perfil";

		// perfil basico de usuario
		$html .= "

		<div class='$classe[0]'>
		$imagem_perfil_usuario
		</div>
		
		";
		
	};
	
};

// array de retorno
$array_retorno["dados"] = $html;
$array_retorno["zerou_contador"] = retorne_campo_formulario_request(20);

// retorno
return json_encode($array_retorno);

};

?>