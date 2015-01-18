<?php
	echo $this->element('admin/header');
	echo $this->Session->flash();
?>

<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
			<div class="panel-heading">
					<h3 class="panel-title sign-in"><?php echo $this->Html->image('logo.png') ?></h3>
				</div>
				<div class="panel-body">
					<?php echo $this->Form->create('User', array('url' => array('action' => 'reset')));?>
						<fieldset>
							<?php
								echo $this->Form->input('email', array('div' => 'form-group', 'class' => 'form-control', 'placeholder' => __('Your Email Address'), 'label' => false));
								echo $this->Form->submit(__('Reset Password'), array('class' => 'btn btn-lg btn-success btn-block')); ?>

							<div class="bottom-links">
								<?php echo $this->Html->link(__('Return to the login page'), array('action' => 'login')); ?>
							</div>
						</fieldset>
					<?php echo $this->Form->end(); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php echo $this->element('admin/footer'); ?>