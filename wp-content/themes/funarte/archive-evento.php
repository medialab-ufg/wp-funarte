<?php get_header(); ?>

<main role="main">
	<a href="#content" id="content" name="content" class="sr-only">Início do conteúdo</a>
	<div class="container mb-100">
	Em desenvolvimento
	</div>
</main>
<!--



<?php 
$categoria = (isset($_GET['area']) && ($_GET['area'] != 'Todas as áreas')) ? get_category_by_name($_GET['area']) : false;
$mes = (isset($_GET['mes'])) ? (int)$_GET['mes'] : date('n');
$ano = (isset($_GET['ano'])) ? (int)$_GET['ano'] : date('Y');

$estudiof = get_category_by_name('Estúdio F');
wp_dropdown_categories(array(
	'show_option_none' => 'Todas as áreas',
	'hide_empty' => false,
	'exclude' => array($estudiof->term_id),
	'id' => 'select-categoria',
	'name' => 'area',
	'selected' => ($categoria) ? $categoria->term_id : null)
);
?>

	<input type="hidden" name="ano" value="<?php echo $ano; ?>" />
	<select id="select-mes" name="mes">
		<option value="" <?php if(empty($mes)) { echo 'selected="selected"'; }?>>Todos os meses</option>
		<option value="1" <?php if($mes == 1) { echo 'selected="selected"'; }?>>Janeiro</option>
		<option value="2" <?php if($mes == 2) { echo 'selected="selected"'; }?>>Fevereiro</option>
		<option value="3" <?php if($mes == 3) { echo 'selected="selected"'; }?>>Março</option>
		<option value="4" <?php if($mes == 4) { echo 'selected="selected"'; }?>>Abril</option>
		<option value="5" <?php if($mes == 5) { echo 'selected="selected"'; }?>>Maio</option>
		<option value="6" <?php if($mes == 6) { echo 'selected="selected"'; }?>>Junho</option>
		<option value="7" <?php if($mes == 7) { echo 'selected="selected"'; }?>>Julho</option>
		<option value="8" <?php if($mes == 8) { echo 'selected="selected"'; }?>>Agosto</option>
		<option value="9" <?php if($mes == 9) { echo 'selected="selected"'; }?>>Setembro</option>
		<option value="10" <?php if($mes == 10) { echo 'selected="selected"'; }?>>Outubro</option>
		<option value="11" <?php if($mes == 11) { echo 'selected="selected"'; }?>>Novembro</option>
		<option value="12" <?php if($mes == 12) { echo 'selected="selected"'; }?>>Dezembro</option>						
	</select>

<?php while (have_posts()): the_post(); ?>
	<div>
		<a href=<?php echo get_post_permalink(get_the_ID()); ?> >
			<h3> <?php the_title(); ?> </h3> 
			<div> <?php echo get_the_date(); ?> </div>
		</a>
	</div> <br> <br>

	<label for="select-categoria">Filtre por </label>


<?php
//the_content();
endwhile;
?>
-->
<?php
get_footer();
?>
