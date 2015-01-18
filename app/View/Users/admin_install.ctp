<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo __('Welcome to Coderity');?></h1>
	</div>
</div>

<?php
	echo $this->Form->create();
	echo $this->Form->input('admin', array('type' => 'hidden', 'value' => true));
?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h1><?php echo __('Install Coderity'); ?></h1>

			<h5><?php echo __('Simply fill out the form below to install Coderity.'); ?></h5>
		</div>

		<div class="panel-body">
			<fieldset>
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							<?php
								echo $this->Form->input('Setting.site_name',
														array('class' => 'form-control',
															  'required' => true));
							?>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<?php
								echo $this->Form->input('Setting.site_email',
														array('type' => 'email',
															  'class' => 'form-control',
															  'required' => true));
							?>
						</div>
					</div>
				</div>
			</fieldset>
		</div>

		<div class="panel-heading">
			<h5><?php echo __('Enter the following details to create the default Admin user.'); ?></h5>
		</div>
		<div class="panel-body">
			<fieldset>
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							<?php
								echo $this->Form->input('first_name',
														array('class' => 'form-control'));
							?>
						</div>
						<div class="form-group">
							<?php
								echo $this->Form->input('last_name',
														array('class' => 'form-control'));
							?>
						</div>
						<div class="form-group">
							<?php
								echo $this->Form->input('email',
														array('class' => 'form-control'));
							?>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<?php
								echo $this->Form->input('username',
														array('class' => 'form-control'));
							?>
						</div>
						<div class="form-group">
							<?php
								echo $this->Form->input('password',
														array('class' => 'form-control'));
							?>
						</div>
						<div class="form-group">
							<?php
								echo $this->Form->input('retype_password',
														array('type'  => 'password',
															  'class' => 'form-control'));
							?>
						</div>
					</div>
				</div>
				<div class="form-group">
					<?php echo $this->Form->submit(__('Install Coderity'),
												   array('class' => 'btn btn-primary'));?>
				</div>
			</fieldset>
		</div>
	</div>

<?php echo $this->Form->end();?>