
// publica conteudo de url
function publicar_conteudo_url(idcampo_1, idcampo_2, idcampo_3){

// id de campo
var v_idcampo_1 = v_variaveis_javascript['id_campo_textarea_publicar'];

// imagens
var v_imagens = null;

// obtendo conteudo de array
dados = v_array_conteudo_url[0];

// criando lista com imagens
for(i = 0; i <= v_array_conteudo_url_imagens.length; i++){
	
	// url de imagem
	var v_url_imagem = v_array_conteudo_url_imagens[i];
	
	// valida o url da imagem
	if(v_url_imagem != null){
		
		// atualiza o html
		v_imagens += v_url_imagem + "," + "\n";
	
	};
	
};

// array com valores
var array_valores = [];

// obtendo informacoes
var v_titulo = dados["titulo"];
var v_descricao = dados["descricao"];

// atualiza o array de valores
array_valores[0] = v_titulo;
array_valores[1] = v_descricao;
array_valores[2] = v_imagens;
array_valores[3] = dados["url"];

// publicando conteudo de url
executador_acao(array_valores, 95, v_array_conteudo_url[2]);

// seta o valor de campo
seta_valor_campo(idcampo_1, null, 0);

// exibe um elemento oculto
exibe_elemento_oculto(idcampo_2, null);

// seta o valor de campo
seta_valor_campo(idcampo_3, null, 1);

};
