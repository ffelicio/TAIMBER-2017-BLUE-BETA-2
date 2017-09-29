<?php

// constroe o perfil ultra basico
function constroe_perfil_ultra_basico(){

// globals
global $tabela_banco;

// valida pode construir perfil ultra basico
if(retorne_modo_pagina() == true or retorne_usuario_logado() == false){
	
	// retorno nulo
	return null;
	
};

// valida o tipo de acao de pagina
switch(retorne_tipo_acao_pagina()){
	
	case 98:
	return null;
	break;

};

// id de usuario via requeste
$uid = retorne_idusuario_request();

// usuario dono do perfil
$usuario_dono_perfil = retorne_usuario_dono_perfil($uid);

// dados compilados do usuario
$dados_compilados_usuario = atualiza_retorna_dados_usuario_sessao(false, false);

// separa os dados do perfil
$dados_perfil = $dados_compilados_usuario[$tabela_banco[1]];

// apelido de usuario
$apelido = $dados_perfil[APELIDO];

// valida apelido
if($apelido != null){
	
	// apelido de usuario
	$apelido = captular($dados_perfil[APELIDO]);
	
	// nome do usuário
	$nome = "
	<span class='classe_nome_topo_perfil_basico_usuario_apelido'>
	$apelido
	</span>	
	";
	
};

// campos
$campo[0] = "
<div class='classe_nome_topo_perfil_basico_usuario'>
$nome
</div>
";

// conteudo de topo de meio de pagina
$campo[1] = constroe_conteudo_topo_meio();

// constroe o campo frase de efeito
$campo[2] = constroe_campo_frase_efeito();

// html
$html = "
<div class='classe_div_perfil_ultra_basico'>

<div class='classe_div_perfil_ultra_basico_sub_topo'>
$campo[0]
</div>

$campo[1]
$campo[2]

</div>
";

// retorno
return $html;

};

?>