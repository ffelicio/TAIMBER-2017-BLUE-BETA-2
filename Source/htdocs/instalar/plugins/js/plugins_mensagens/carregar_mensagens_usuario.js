
// carrega as mensagens do usuario
function carregar_mensagens_usuario(idcampo_1, idcampo_2, uidamigo){

// exibe a barra de progresso gif
exibe_elemento_oculto(idcampo_1, 0);

// valida zerar contadores
if(v_variaveis_javascript['ultimo_uidamigo_mensagem'] != uidamigo && v_variaveis_javascript['uidamigo_mensagem_abrir'] != -1){
	
	// atualiza ultimo uidamigo utilizado
    v_variaveis_javascript['ultimo_uidamigo_mensagem'] = uidamigo;

	// zera o contador de avanco
	v_variaveis_javascript['zera_contador_mensagens'] = 1;

}else{
	
	// atualiza o contador de avanco...
	v_variaveis_javascript['zera_contador_mensagens'] = 0;

};

// valida uidamigo sendo passado
if(uidamigo == null){

    // altera a variavel que ira carregar o conteudo
    v_variaveis_javascript['campo_carrega_conteudo'] = idcampo_2;
    v_variaveis_javascript['zera_contador_mensagens'] = 0;

	// altera a variavel que ira carregar o conteudo
    v_variaveis_javascript['uidamigo_mensagem_abrir'] = null;
	
	// define o modo de carregamento de mensagens
    v_variaveis_javascript['modo_mensagens'] = 0;
	
}else{

	// define o modo de carregamento de mensagens
    v_variaveis_javascript['modo_mensagens'] = 1;

    // altera a variavel que ira carregar o conteudo
    v_variaveis_javascript['uidamigo_mensagem_abrir'] = uidamigo;
	
};

// array de valores
var array_valores = [];

// atualiza o array de valores
array_valores[0] = idcampo_1;

// carrega mensagens usuario
executador_acao(array_valores, 42, v_variaveis_javascript['campo_carrega_conteudo']);

};
