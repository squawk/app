<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo __('Change Password'); ?></h1></h1>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<?php echo __('Change Your Password');?>
	</div>
	<div class="panel-body">
		<?php
			echo $this->Form->create();
		?>
			<p><?php echo __('To change your password enter in your current password and your new password twice.'); ?></p>

			<fieldset>
				<div class="row">
					<div class="col-lg-6">
						<?php
							echo $this->Form->input('old_password', array('type' => 'password', 'div' => 'form-group', 'class' => 'form-control', 'label' => __('Current Password')));

						?>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-6">
						<?php
							echo $this->Form->input('password', array('div' => 'form-group', 'class' => 'form-control', 'label' => __('New Password')));
						?>
					</div>
					<div class="col-lg-6">
						<?php

							echo $this->Form->input('retype_password', array('type' => 'password', 'div' => 'form-group', 'class' => 'form-control', 'label' => __('Retype Password')));
						?>
					</div>
				</div>

				<div class="form-group">
					<?php echo $this->Form->submit(__('Change Password'), array('class' => 'btn btn-primary'));?>
				</div>
			</fieldset>
		<?php echo $this->Form->end();?>
	</div>
</div>