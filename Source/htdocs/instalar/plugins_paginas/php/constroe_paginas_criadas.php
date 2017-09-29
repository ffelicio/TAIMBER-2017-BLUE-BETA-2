<?php

// constroe as paginas criadas pelo usuario
function constroe_paginas_criadas(){

// globals
global $tabela_banco;
global $idioma_sistema;

// tabela
$tabela = $tabela_banco[18];

// id de usuario logado
$uid = retorne_idusuario_logado();

// limit de query
$limit = retorne_limit_query_iniciar(false, null);

// query
$query = "select *from $tabela where uid='$uid' order by id desc $limit;";

// array de dados
$dados_query = plugin_executa_query($query);

// contador
$contador = 0;

// linhas
$linhas = $dados_query["linhas"];

// construindo paginas
for($contador == $contador; $contador <= $linhas; $contador++){
	
	// dados
	$dados = $dados_query["dados"][$contador];
	
	// separa os dados
	$id = $dados["id"];
	$data = $dados[DATA];
	
	// valida o id da pagina
	if($id != null){
		
		// dados do perfil da pagina
		$dados_perfil = retorne_dados_perfil_pagina($id);
		
		// separa os dados do perfil
		$titulo_da_pagina = $dados_perfil[TITULO_DA_PAGINA];
		$descricao_da_pagina = $dados_perfil[DESCRICAO_DA_PAGINA];

		// imagem de perfil de pagina
		$imagem_perfil = retorne_imagem_perfil_pagina($id, false);

		// adiciona link ao titulo da pagina
		$titulo_da_pagina = retorne_link_pagina($id, $titulo_da_pagina, $titulo_da_pagina);

		// data amigavel
		$data = converte_data_amigavel(true, $data);
		
		// campos
		$campo[0] = "
		
		<div class='classe_pagina_miniatura_conteudo_pesquisa'>

		<div class='classe_pagina_miniatura_titulo'>
		$titulo_da_pagina
		</div>

		<div class='classe_pagina_miniatura_descreve'>
		$descricao_da_pagina
		</div>

		<div class='classe_pagina_miniatura_data classe_cor_2'>
		$idioma_sistema[477]$data
		</div>
	
		</div>
		
		";

		// campos
		$campo[0] = "
		
		<div class='classe_pagina_miniatura_criada'>

		<div class='classe_pagina_miniatura_imagem'>
		$imagem_perfil
		</div>

		$campo[0]

		</div>

		";
		
		// html
		$html .= $campo[0];
		
	};
	
};

// array dados
$array_retorno["dados"] = $html;

// retorno
return json_encode($array_retorno);

};

?>