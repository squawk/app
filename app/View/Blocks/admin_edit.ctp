<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo __('Edit a Content Block');?></h1>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<?php echo __('Block Details');?>
	</div>
	<div class="panel-body">
		<?php echo $this->Form->create();?>
			<fieldset>
				<div class="form-group">
					<?php
						echo $this->Form->input('id');

						echo $this->Form->input('name',
												array('label' => __('Name *'),
													  'class' => 'form-control'));
					?>
				</div>
				<div class="form-group">
					<?php
						echo $this->Form->input('slug',
												array('label' => __('Slug / Key'),
													  'class' => 'form-control',
													  'after' => __('Used to call the content block in your front end code')));
					?>
				</div>
				<div class="form-group">
					<?php
						echo $this->Ck->input('content');
					?>
				</div>

				<div class="form-group">
					<?php echo $this->Form->submit(__('Save Changes'),
												   array('class' => 'btn btn-primary'));?>
				</div>
			</fieldset>
		<?php echo $this->Form->end();?>
	</div>
	<div class="panel-footer">
		<?php echo $this->Html->link(__('Back to content blocks'),
									 array('action' => 'index'),
									 array('class' => 'btn btn-default'));?>
	</div>
</div>