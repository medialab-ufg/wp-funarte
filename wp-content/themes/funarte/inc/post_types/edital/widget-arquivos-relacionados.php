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
		$html_widget .= '<div class="outras-infos-texto grid-' . $params['colunas'] . '-12">';
		
	$html_widget .= '<div class="widgets-pa arquivos-relacionados ' . $params['class'] . ' grid-' . $params['colunas'] . '-12">';
		$html_widget .= '<h3>' . $params['titulo'] . '</h3>';
		$html_widget .= '<ul>';
		foreach ($files as $file) {
			$html_widget .= '<li>';
				$link = '<a href=' . $file->guid . ' title="Faça download do arquivo" >' . $file->post_title . '</a>';
				$html_widget .= '<span>(' . date('d/m/Y', strtotime($file->post_date)) . ')' . $link . '</span>';
			$html_widget .= '</li>';
		}
		$html_widget .= '</ul>';
	$html_widget .= '</div>';

	if ($params['wraper'])
		$html_widget .= '</div>';
}

if (!$params['return'])
	echo $html_widget;
?>