$(document).ready(function(){
	// Aqui que tudo começa. Observe que usei o atributo name do campo que será digitado o texto como referência.
	new Autocomplete("campo_estado", function() {
		// Quando o autocomplete trazer o resultado da consulta, vai atribuir nos campos correspondentes
		this.setValue = function( id, estado, sigla ) {
			$("#id_val").val(id);
			$("#estado_val").val(estado);
			$("#sigla_val").val(sigla);
		}
		if ( this.isModified )
			this.setValue("");
		if ( this.value.length < 1 && this.isNotClick )
			return ;
		// O arquivo php abaixo é que será chamado via AJAX, sendo passado o parâmetro q com o valor digitado no campo
		return "ajax.php?q=" + this.value;
	});

});