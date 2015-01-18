<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo __('Coderity CMS Dashboard'); ?></h1>
	</div>
</div>

<?php if (!$siteName) : ?>
	<div class="alert alert-danger"><i class="fa fa-info-circle"></i> <?php echo __('A Site Name is required for the website to work correctly.');?></div>
<?php endif; ?>

<?php if (!$siteEmail) : ?>
	<div class="alert alert-danger"><i class="fa fa-info-circle"></i> <?php echo __('A Site Email is required for the website to work correctly.');?></div>
<?php endif; ?>

<?php if (!$siteName || !$siteEmail) : ?>
	<p><?php echo $this->Html->link(__('Visit the Settings page now to resolve these issues'), array('controller' => 'settings', 'action' => 'index')); ?></p>
<?php endif; ?>

<?php
	/*
	$folders = array(WWW_ROOT . 'img/uploads', WWW_ROOT . 'img/uploads/thumbs');

	foreach ($folders as $folder) : ?>
		<?php if (!is_writable($folder)) : ?>
			<div class="alert alert-warning"><i class="fa fa-info-circle"></i> <?php echo __('Create the folder %s and make sure it is writable.', $folder);?></div>
		<?php endif; ?>
	<?php endforeach;
	*/
?>

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo __('What Would you like to do?'); ?></h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
	<div class="col-lg-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<?php echo $this->Html->link(__('Manage Site Pages'), array('controller' => 'pages', 'action' => 'index')); ?>
			</div>
			<div class="panel-body">
				<p><?php echo __('Manage your website pages and set your top and bottom menu.'); ?></p>
			</div>
		</div>
	</div>
	<!-- /.col-lg-4 -->
	<div class="col-lg-4">
		<div class="panel panel-success">
			<?php if (!Configure::read('Coderity') || Configure::read('Coderity.articles')) : ?>
				<div class="panel-heading">
					<?php echo $this->Html->link(__('Manage your Blog'), array('controller' => 'articles', 'action' => 'index')); ?>
				</div>
				<div class="panel-body">
					<p><?php echo __('Add, edit and delete articles in your blog.'); ?></p>
				</div>
			<?php else : ?>
				<div class="panel-heading">
					<?php echo $this->Html->link(__('Manage Setings'), array('controller' => 'settings', 'action' => 'index')); ?>
				</div>
				<div class="panel-body">
					<p><?php echo __('Add, edit and delete articles in your blog.'); ?></p>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<!-- /.col-lg-4 -->
	<div class="col-lg-4">
		<div class="panel panel-info">
			<div class="panel-heading">
				<?php echo $this->Html->link(__('User Management'), array('controller' => 'users', 'action' => 'index')); ?>
			</div>
			<div class="panel-body">
				<p><?php echo __('Control which users have access to the CMS.'); ?></p>
			</div>
		</div>
	</div>
	<!-- /.col-lg-4 -->
</div>