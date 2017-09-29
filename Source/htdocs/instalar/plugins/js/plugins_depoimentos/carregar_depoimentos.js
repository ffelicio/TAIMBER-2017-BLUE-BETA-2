
// carrega os depoimentos
function carregar_depoimentos(idcampo_1, idcampo_2, idcampo_3, modo, limpar_antigos, idcampo_4){

// valida paginador
if(modo == 3){
	
	// consulta
	modo = v_variaveis_javascript['modo_carrega_depoimento'];

}else{

    // atualiza
	v_variaveis_javascript['modo_carrega_depoimento'] = modo;
	
};

// seta valores de variaveis globais
v_variaveis_javascript['modo_carrega_depoimento'] = modo;
v_variaveis_javascript['idcampo_paginador_depoimentos'] = idcampo_2;
v_variaveis_javascript['modo_carrega_depoimento_limpa'] = limpar_antigos;
v_variaveis_javascript['idcampo_visualizador_depoimentos'] = idcampo_3;

// valida o modo
if(modo == null || limpar_antigos == 1){
	
	// limpa dados antigos
    document.getElementById(idcampo_1).innerHTML = "";
	
};

// exibe a barra de progresso gif
oculta_exibe_elemento_idcampo(idcampo_4, 0);

// array de valores
var array_valores = [];

// array de valores
array_valores[0] = idcampo_4;

// carrega os depoimentos
executador_acao(array_valores, 35, idcampo_1);

// exibe o paginador
document.getElementById(idcampo_2).style.display = "block";

};
