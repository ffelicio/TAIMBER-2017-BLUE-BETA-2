<?php

// constroe o conteudo de publicacao de conteudo de url
function constroe_conteudo_publicacao_conteudo_url($chave, $modo){

// globals
global $tabela_banco;
global $codigos_especiais;

// tabela
$tabela = $tabela_banco[29];

// query
$query = "select *from $tabela where chave='$chave';";

// dados de query
$dados_query = plugin_executa_query($query);

// dados
$dados = $dados_query["dados"][0];

// separa os dados
$id = $dados["id"];
$titulo = $dados[TITULO];
$descricao = $dados[DESCRICAO];
$imagens = $dados[IMAGENS];
$url = $dados[URL];

// valida id
if($id == null){

	// retorno nulo
	return null;
	
};

// array com imagens
$array_imagens = explode($codigos_especiais[12], $imagens);

// numero de imagens
$numero_imagens = count($array_imagens) - 1;

// contador
$contador = 0;

// listando e construindo imagens
foreach($array_imagens as $url_imagem){

	// valida url de imagem
	if($url_imagem != null){

		// imagem de publicacao
		$imagem_convertida = converte_tag_imagem($url_imagem, true);
		
		// valida numero de imagens
		if($numero_imagens > 1){
			
			// valida o contador
			if($contador >= 1){
				
				// imagens
				$imagens_publicacao[0] .= "
				$imagem_convertida
				";
				
				// zera o contador
				$contador = 0;

			}else{
				
				// imagens
				$imagens_publicacao[1] .= "
				$imagem_convertida				
				";
				
				// atualiza o contador
				$contador++;
				
			};
		
		}else{
			
			// imagens
			$imagens_publicacao[0] .= "
			$imagem_convertida
			";

		};

	};
	
};

// valida o numero de imagens
if($numero_imagens > 1){
	
	// classes
	$classe[0] = "classe_imagem_publicacao_conteudo_url_1";

	// lista de imagens
	$lista_imagens = "

	<div class='$classe[0]'>
	$imagens_publicacao[0]
	</div>

	<div class='$classe[0]'>
	$imagens_publicacao[1]
	</div>

	";

}else{

	// classes
	$classe[0] = "classe_imagem_publicacao_conteudo_url_2";	

	// lista de imagens
	$lista_imagens = "

	<div class='$classe[0]'>
	$imagens_publicacao[0]
	</div>

	";

};

// converte todas as urls, links, videos etc
$descricao = converter_urls(false, $descricao);

// adiciona link em titulo
$titulo = "<a href='$url' title='$titulo' target='_blank'>$titulo</a>";

// id de campos
$idcampo[0] = retorne_idcampo_md5();
$idcampo[1] = retorne_idcampo_md5();

// campos
$campo[0] = constroe_opcoes_conteudo_url($chave, $idcampo[0], $modo, $idcampo[1]);

// html
$html = "
<div class='classe_publicacao_conteudo_url' id='$idcampo[1]'>
$campo[0]
<div class='classe_publicacao_conteudo_url_titulo'>$titulo</div>
<div class='classe_publicacao_conteudo_url_conteudo'>$descricao</div>
<div class='classe_publicacao_conteudo_url_imagens'>$lista_imagens</div>
</div>
";

// retorno
return $html;

};

?>