<?php

// constroe recomendações de usuarios
function carrega_recomendacoes_usuarios(){

// globals
global $tabela_banco;
global $idioma_sistema;

// tabela
$tabela = $tabela_banco[37];

// id de usuasrio logado
$uid = retorne_idusuario_logado();

// limit
$limit = "limit 0, ".NUMERO_RECOMENDACOES_INICIO;

// query
$query = "select *from $tabela where uid='$uid' order by id desc $limit;";

// dados de query
$dados_query = plugin_executa_query($query);

// linhas
$linhas = $dados_query["linhas"];

// valida o numero de linhas
if($linhas == 0){

	// retorno
	return null;
	
};

// contador
$contador = 0;

// construindo paginas
for($contador == $contador; $contador <= $linhas; $contador++){
	
	// dados
	$dados = $dados_query["dados"][$contador];
	
	// separando dados
	$uidamigo = $dados[UIDAMIGO];
	
	// valida uidamigo
	if($uidamigo != null){
		
		// campo de perfil de usuario
		$campo[0] = constroe_imagem_perfil_medio($uidamigo);
		
		// campos
		$campo[0] = "
		<div class='classe_separa_usuario_recomendado'>
		$campo[0]
		</div>
		";
		
		// constroe a pagina em miniatura de sugestao
		$html .= $campo[0];

	};
	
};

// id de campo
$idcampo[0] = retorne_idcampo_md5();
$idcampo[1] = retorne_idcampo_md5();

// imagens de sistema
$imagem_sistema[0] = retorne_imagem_sistema(83, null, false);
$imagem_sistema[1] = retorne_imagem_sistema(84, null, false);

// funcoes
$funcao[0] = "paginar_recomendacoes_usuario(0, \"$idcampo[0]\", \"$idcampo[1]\");";
$funcao[1] = "paginar_recomendacoes_usuario(1, \"$idcampo[0]\", \"$idcampo[1]\");";

// eventos
$evento[0] = "onclick='$funcao[0]'";
$evento[1] = "onclick='$funcao[1]'";

// campo de progresso gif
$progresso[0] = campo_progresso_gif($idcampo[1]);

// campo paginar
$campo[0] = "
<div class='classe_paginar_recomendacoes_usuarios_progresso'>
$progresso[0]
</div>

<div class='classe_paginar_recomendacoes_usuarios classe_cor_29'>

<div class='classe_paginar_recomendacoes_usuarios_separa' $evento[0]>
$imagem_sistema[0]
</div>

<div class='classe_paginar_recomendacoes_usuarios_separa' $evento[1]>
$imagem_sistema[1]
</div>

</div>
";

// html
$html = "
<div class='classe_recomendacoes_novos_amigos'>

<div class='classe_usuarios_recomendar_usuario' id='$idcampo[0]'>
$html
</div>

$campo[0]

</div>
";

// retorno
return $html;

};

?>