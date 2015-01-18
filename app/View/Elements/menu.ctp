<?php
$loadMenu = $topMenu;
if (!empty($type) && $type == 'bottom') {
	$loadMenu = $bottomMenu;
}

if (empty($li['active'])) {
	$li['active'] = 'active';
}

if ($loadMenu) :
	// is there a ul class defined?
	if (!empty($ul['class'])) : ?>
		<ul class="<?php echo $ul['class']; ?>">
	<?php else : ?>
		<ul>
	<?php endif; ?>

	<?php foreach ($loadMenu as $menu) :
		$options = array();
		if (!empty($menu['new_window'])) {
			$options['target'] = '_blank';
		}

		$liClass = array();

		if (!empty($li['class'])) {
			$liClass[] = $li['class'];
		}

		if (str_replace($this->request->base, '', $this->request->here) == $menu['url']) {
			$liClass[] = $li['active'];
		}
		?>

		<li<?php if (!empty($liClass)) : ?> class="<?php echo implode(' ', $liClass); ?>"<?php endif; ?>>
			<?php echo $this->Html->link($menu['title'], $menu['url'], $options); ?>
		</li>
	<?php endforeach; ?></ul>
<?php endif; ?>