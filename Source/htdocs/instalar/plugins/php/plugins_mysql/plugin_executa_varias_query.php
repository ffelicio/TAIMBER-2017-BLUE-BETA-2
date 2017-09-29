<?php

// plugin executa varias query
function plugin_executa_varias_query($querys){

// listando querys
foreach($querys as $query){
	
	// valida query
	if($query != null){
		
		// valia pode executar a query
		if(retorne_pode_executar_query($query) == true){
			
			// rodando querys
			plugin_roda_query($query);

		};

	};

};

};

?>