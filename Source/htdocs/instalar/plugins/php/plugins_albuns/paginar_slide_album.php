<?php

// paginar slide album
function paginar_slide_album(){

// modo 0 volta
// modo 1 avança

// globals
global $tabela_banco;

// id de imagem atual
$id_imagem = retorne_campo_formulario_request(4);

// modo avançar ou voltar
$modo = retorne_campo_formulario_request(6);

// id de usuario via requeste
$idusuario = retorne_idusuario_request();

// id de campo
$idcampo[0] = retorne_campo_formulario_request(21);

// tabela
$tabela = $tabela_banco[4];

// id de pagina via requeste
$pagina = retorne_idpagina_request();

// valida pagina
if($pagina == null){
	
	// query
	$query = "select *from $tabela where uid='$idusuario' and modo_chat='0';";

}else{
	
	// query
	$query = "select *from $tabela where pagina='$pagina' and modo_chat='0';";	
	
};

// dados de query
$dados_query = plugin_executa_query($query);

// linhas
$linhas = $dados_query["linhas"];

// contador
$contador = 0;

// percorrendo imagens...
for($contador == $contador; $contador <= $linhas; $contador++){
	
	// dados
	$dados = $dados_query["dados"][$contador];
	
	// separando dados
	$id = $dados["id"];
	$uid = $dados[UID];
	
	// valida o id
	if($id != null){
		
		// valida ids de imagens
		if($id == $id_imagem){
			
			// atualiza os dados
			$bkp_dados_volta = $dados_query["dados"][$contador + 1];
			$bkp_dados_avanca = $dados_query["dados"][$contador - 1];
			
			// saindo do laço
			break;
			
		};
		
	};
	
};

// valida o modo
if($modo == true){
	
	// seta os dados
	$dados = $bkp_dados_avanca;
	
}else{
	
	// seta os dados
	$dados = $bkp_dados_volta;

};

// valida dados
if($dados != null){
	
	// html
	$html = constroe_imagem_album_dados($dados, 5, $idcampo[0]);
	
	// atualiza o array de retorno
	$array_retorno["limpar_dados_antigos"] = 1;
	
	// separa os dados
	$id = $dados["id"];

}else{
	
	// atualiza o array de retorno
	$array_retorno["limpar_dados_antigos"] = 0;
	
	// informa o id de retorno
	$id = $id_imagem;

};

// array de retorno
$array_retorno["dados"] = $html;
$array_retorno["id"] = $id;

// retorno
return json_encode($array_retorno);

};

?>