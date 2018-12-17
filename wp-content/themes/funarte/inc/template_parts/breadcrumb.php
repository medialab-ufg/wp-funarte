<?php
/**
 * links: array of link
 * link: one array = ['link_name'=>'link name', 'link_url'=>'link URL']
 */
if(!isset($links)):
	echo "<br><b> parameter not found! </b><br>";
else:
?>
<div class="box-breadcrumb">
	<a class="box-breadcrumb__home" href="/"><i class="mdi mdi-home"></i></a>
	<?php foreach ($links as $link): ?>
		<?php if (empty($link['link_url']) || !isset($link['link_url']) || $link['link_url'] == ''): ?>
			<span><?php echo $link['link_name']; ?></span>
		<?php else: ?>
			<a href="<?php echo $link['link_url']; ?>"><?php echo $link['link_name']; ?></a>
		<?php endif; ?>
	<?php endforeach; ?>
</div>
<?php endif; ?>