<?php

// adiciona conteudo de url
function adicionar_conteudo_url(){

// dados de formulario
$url = retorne_campo_formulario_request(48);
$chave = retorna_chave_request();

// valida url
if(retorna_host_valido_dados_site($url) == false){
	
	// atualiza o array de retorno
	$array_retorno["dados"] = null;

	// retorno
	return json_encode($array_retorno);
	
};

// dados
$dados = obter_informacoes_site($url);

// separa os dados
$titulo = $dados[0];
$descricao = $dados[1];
$imagens = $dados[2];

// campos
$campo[0] = constroe_visualizar_imagens_conteudo_url($imagens);

// html
$html = "
<div class='classe_exibe_informacoes_site'>
<div class='classe_exibe_informacoes_site_titulo classe_cor_2'>$titulo</div>
<div class='classe_exibe_informacoes_site_texto'>$descricao</div>
<div class='classe_exibe_informacoes_site_imagens'>$campo[0]</div>
</div>
";

// atualiza o array de retorno
$array_retorno["dados"][TITULO] = $titulo;
$array_retorno["dados"][DESCRICAO] = $descricao;
$array_retorno["dados"][IMAGENS] = $imagens;
$array_retorno["dados"][CONTEUDO] = $html;
$array_retorno["dados"][URL] = $url;

// retorno
return json_encode($array_retorno);

};

?>