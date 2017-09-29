
// retorna a geolocalizacao
function retorna_geolocalizacao(position){

// array de valores
var array_valores = [];

// atualiza o array de retorno	
array_valores["latitude"] = position.coords.latitude;
array_valores["longitude"] = position.coords.longitude;

// salvando localizacao
executador_acao(array_valores, 122, null);

};
