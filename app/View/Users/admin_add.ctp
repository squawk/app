<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo __('Add a User'); ?></h1>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<?php echo __('User Details');?>
	</div>
	<div class="panel-body">
		<?php
			echo $this->Form->create();
			echo $this->Form->input('admin', array('type' => 'hidden', 'value' => true));
		?>
			<fieldset>
				<div class="row">
					<div class="col-lg-6">
						<?php
							echo $this->Form->input('username', array('div' => 'form-group', 'class' => 'form-control'));
							echo $this->Form->input('first_name', array('div' => 'form-group', 'class' => 'form-control'));
							echo $this->Form->input('last_name', array('div' => 'form-group', 'class' => 'form-control'));
						?>
					</div>
					<div class="col-lg-6">
						<?php
							echo $this->Form->input('password', array('div' => 'form-group', 'class' => 'form-control'));
							echo $this->Form->input('retype_password', array('type' => 'password', 'div' => 'form-group', 'class' => 'form-control'));
							echo $this->Form->input('email', array('div' => 'form-group', 'class' => 'form-control'));
						?>
					</div>
				</div>
				<div class="form-group">
					<?php echo $this->Form->submit(__('Add User'), array('class' => 'btn btn-primary'));?>
				</div>
			</fieldset>
		<?php echo $this->Form->end();?>
	</div>

	<div class="panel-footer">
		<?php echo $this->Html->link(__('Back to users'), array('action' => 'index'), array('class' => 'btn btn-default'));?>
	</div>
</div>