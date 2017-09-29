<?php

// carrega os usuarios bloqueados
function carrega_usuarios_bloqueados($modo){

// globals
global $tabela_banco;

// dados compilados do usuario
$dados_compilados_usuario = atualiza_retorna_dados_usuario_sessao(false, false);

// separa dados por tabela
$array_dados_bloqueio = $dados_compilados_usuario[$tabela_banco[10]];

// array com dados de bloqueio
$array_dados_bloqueio = inverte_array($array_dados_bloqueio);

// valida se o valor e array
if(is_array($array_dados_bloqueio) == false){

    // retorno nulo
    return null;

};

// contador de avanco
$contador = contador_avanco(retorne_campo_formulario_request(2), 3) + 1;

// contador final
$contador_final = contador_avanco(retorne_campo_formulario_request(2), 1);

// listando usuarios bloqueados
for($contador == $contador; $contador <= $contador_final; $contador++){

    // valida idusuario
    if($array_dados_bloqueio[$contador][UIDAMIGO] != null){

        // separa dados
        $perfil_usuario = constroe_imagem_perfil_miniatura(true, true, $array_dados_bloqueio[$contador][UIDAMIGO]);
	    
		// campo bloqueio
		$campo_bloqueio = campo_bloquear_usuario(false, $array_dados_bloqueio[$contador][UIDAMIGO]);

		// html
		$html .= "
		<div class='classe_div_perfil_usuario_configuracao classe_cor_3'>
		
		<div class='classe_div_perfil_usuario_configuracao_imagem'>
		$perfil_usuario
		</div>
		
		<div class='classe_div_perfil_usuario_configuracao_opcoes'>
		$campo_bloqueio
		</div>
		
		</div>
		
		";
		
	};
	
};

// retorno
return $html;

};

?>