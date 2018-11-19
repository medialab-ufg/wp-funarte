<div class="box-searchform">
	<form role="search" method="get" class="searchform" action="<?php echo home_url( '/' ); ?>">
		<fieldset>
			<legend>Formulário de busca</legend>
			<strong>Busca</strong>
			<label class="sr-only" for="s">Digite o que procura</label>
			<input type="text" value="" name="s" id="s">

			<div class="box-buttons">
				<button class="searchcancel" type="button">Cancelar</button>
				<input type="submit" id="searchsubmit" value="Pesquisar">
			</div>
		</fieldset>
	</form>

	<button type="button" class="searchform-button"><i class="mdi mdi-magnify"></i><i class="mdi mdi-close"></i></button>
</div>