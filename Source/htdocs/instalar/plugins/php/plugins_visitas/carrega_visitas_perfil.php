<?php

// carrega as visitas do perfil
function carrega_visitas_perfil(){

// globals
global $tabela_banco;

// dados compilados do usuario
$dados_compilados_usuario = atualiza_retorna_dados_usuario_sessao(false, false);

// separa dados por tabela
$array_dados_visitas = $dados_compilados_usuario[$tabela_banco[11]];

// array com dados de visitas
$array_dados_visitas = inverte_array($array_dados_visitas);

// valida se o valor e array
if(is_array($array_dados_visitas) == false){

    // retorno nulo
    return null;

};

// contador de avanco
$contador = contador_avanco(retorne_campo_formulario_request(2), 3) + 1;

// contador final
$contador_final = contador_avanco(retorne_campo_formulario_request(2), 1);

// listando usuarios visitados
for($contador == $contador; $contador <= $contador_final; $contador++){

    // valida idusuario
    if($array_dados_visitas[$contador][UIDAMIGO] != null){

        // separa dados
        $perfil_usuario = constroe_imagem_perfil_miniatura(true, true, $array_dados_visitas[$contador][UIDAMIGO]);
	    $campo_visitas = retorne_numero_visitas($array_dados_visitas[$contador][UIDAMIGO], true);

		// data da visita
		$data = converte_data_amigavel(true, $array_dados_visitas[$contador][DATA]);
		
		// html
		$html .= "
		<div class='classe_div_perfil_usuario_configuracao classe_cor_3' title='$data'>
		
		<div class='classe_div_perfil_usuario_configuracao_imagem'>
		$perfil_usuario
		</div>
		
		<div class='classe_div_perfil_usuario_configuracao_opcoes'>
		<div class='classe_div_perfil_usuario_configuracao_opcoes_separa span_link'>$campo_visitas</div>
		<div class='classe_div_perfil_usuario_configuracao_opcoes_separa span_link'>$data</div>
		</div>
		
		</div>
		
		";
		
	};
	
};

// array de retorno
$array_retorno["dados"] = $html;

// retorno
return json_encode($array_retorno);

};

?>