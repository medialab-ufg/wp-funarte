<?php
global $html;
$params = array_merge(array(
	'class' => '',
	'colunas' => 3,
	'exclude' => '/^(image\/(jpeg|png|gif)|audio\/)/',
	'titulo' => 'Arquivos Relacionados',
	'params' => array(),
	'wraper' => true,
	'return' => false
), (isset($params) ? $params : array()));

$files = get_post_files(get_the_ID(), $params['params'], $params['exclude']);

$html_widget = '';
if (!empty($files)) {
	if ($params['wraper'])
		$html_widget .= '<div class="box-links">';

		$html_widget .= '<h4 class="title-h1">' . $params['titulo'] . '</h4>';
		$html_widget .= '<ul class="list-links">';
		foreach ($files as $file) {
			$html_widget .= '<li>';
				$html_widget .= '<a href=' . $file->guid . ' title="Faça download do arquivo" >(' . date('d/m/Y', strtotime($file->post_date)) . ') ' . $file->post_title . '</a>';
			$html_widget .= '</li>';
		}
		$html_widget .= '</ul>';

	if ($params['wraper'])
		$html_widget .= '</div>';
}

if (!$params['return'])
	echo $html_widget;
?>