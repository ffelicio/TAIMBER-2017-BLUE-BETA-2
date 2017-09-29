<?php

// carrega as imagens do album de usuario
function carrega_imagens_album_usuario(){

// globals
global $tabela_banco;
global $idioma_sistema;

// valida o modo album
if(retorne_modo_album() == true){
	
	// constroe as imagens de album de usuário pelo modo de pagina
	return constroe_imagens_album_usuario_modo_album();
	
};

// dados compilados do usuario
$dados_compilados_usuario = atualiza_retorna_dados_usuario_sessao(false, false);

// array com imagens
$array_imagens = $dados_compilados_usuario[$tabela_banco[4]];

// inverte o array
$array_imagens = inverte_array($array_imagens);

// contador de avanco
$contador = contador_avanco(retorne_campo_formulario_request(2), 3) + 1;

// contador final
$contador_final = contador_avanco(retorne_campo_formulario_request(2), 1);

// valida se o valor e array
if(is_array($array_imagens) == false){

    // retorno nulo
    return null;

};

// extraindo imagens
for($contador == $contador; $contador <= $contador_final; $contador++){

	// constroe a imagem de album por dados
	$html .= constroe_imagem_album_dados($array_imagens[$contador], 4, null);

};

// seta os dados de array de retorno
$array_retorno["dados"] = $html;

// retorno
return json_encode($array_retorno);

};

?>