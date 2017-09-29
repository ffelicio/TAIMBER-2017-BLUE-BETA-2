<?php

// constroe o campo de configuracoes da pagina
function constroe_campo_configuracoes_pagina($pagina){

// globals
global $idioma_sistema;
global $tabela_banco;

// id de usuario logado
$uid = retorne_idusuario_logado();

// valida usuario dono da pagina
if(retorne_usuario_dono_pagina($uid, $pagina) == false){
	
	// valida usuario dono da pagina
	return null;
	
};

// array com campos
$array_campos = explode(",", $idioma_sistema[271]);

// array com campos de tabelas
$array_campos_tabela = explode(",", CAMPO_TABELA_CONFIGURACOES_PAGINA_CORPO);

// contador
$contador = 0;

// query
$query = "select *from $tabela_banco[23] where pagina='$pagina';";

// dados de query
$dados_query = plugin_executa_query($query);

// dados
$dados = $dados_query["dados"][0];

// lista campos disponiveis
foreach($array_campos as $campo){

// valida campo
if($campo != null){
	
	// campo de tabela
	$campo_tabela = $array_campos_tabela[$contador + 1];
	
	// trata o campo do formulario
	$campo_tabela = trata_campo_tabela($campo_tabela, false);
	
	// nome de campo elemento html
	$campo_elemento_nome = "campo_edita_configuracoes_pagina_$campo_tabela";
    
	// valor de campo
	$valor_campo = $dados[$campo_tabela];
	
	// atualiza o contador
	$contador++;

	// descricao
	$descricao = $array_campos[$contador - 1];
	
	// id de campos
	$icampo[0] = codifica_md5($campo_elemento_nome.data_atual());

	// valida configuracao
	if($valor_campo == true){
		
		// configuracao setado
		$setado = "checked";

	}else{
		
		// configuracao setado
		$setado = null;

	};

	// eventos
	$eventos[0] = "onclick='salvar_configuracoes_pagina(\"$icampo[0]\", \"2\", \"$contador\", \"$pagina\")';";
	
	// html
	$html .= "
	<div class='classe_separa_campo_formulario_edita_privacidade'>
	<input type='checkbox' id='$icampo[0]' $setado $eventos[0]>
	<span>$descricao</span>
	</div>
	";

};

};

// retorno
return $html;

};

?>