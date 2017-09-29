
// obtem a geolocalizacao
function obtem_geolocalizacao(){

// valida geolocalizacao
if(navigator.geolocation){
    
	// setando posicao
	navigator.geolocation.getCurrentPosition(retorna_geolocalizacao);
	
};

};
