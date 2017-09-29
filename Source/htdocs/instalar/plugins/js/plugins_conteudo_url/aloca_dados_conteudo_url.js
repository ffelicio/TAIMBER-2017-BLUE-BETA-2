
// aloca os dados de conteudo de url
function aloca_dados_conteudo_url(dados, idcampo_1, idcampo_2){

// atualizando variaveis globais
v_array_conteudo_url[0] = dados;
v_array_conteudo_url[1] = idcampo_1;
v_array_conteudo_url[2] = idcampo_2;

// valida array de conteudo
if(v_array_conteudo_url.length == 0){

	// retorno
	return null;
	
};

// obtendo conteudo de array
dados = v_array_conteudo_url[0];
idcampo_1 = v_array_conteudo_url[1];

// exibe as informacoes coletadas
$("#" + idcampo_1).html(dados["conteudo"]);

};
