
// deteca a resolucao da pagina
function detecta_resolucao(){

// largura
var largura = window.screen.availWidth;

// array de valores
var array_valores = [];

// atualiza o array de valores
array_valores[0] = largura;

// analisando resolucao
executador_acao(array_valores, 97, null);

};

