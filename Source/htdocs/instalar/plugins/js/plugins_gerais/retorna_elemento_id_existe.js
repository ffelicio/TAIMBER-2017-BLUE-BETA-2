
// retorna se o elemento existe por id
function retorna_elemento_id_existe(id_elemento){

// valida elemento existe
if($("#" + id_elemento).length == 0) {

    // elemento nao existe
    return false;
	
}else{
	
	// elemento existe
    return true;
	
};

};
