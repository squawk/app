<?php echo $this->element('admin/header'); ?>

<div id="wrapper">
	<?php echo $this->element('admin/menu'); ?>

	<div id="page-wrapper">
		<?php
			echo $this->Session->flash();
			echo $this->fetch('content');
		?>
	</div>
</div>

<?php echo $this->element('admin/footer'); ?>