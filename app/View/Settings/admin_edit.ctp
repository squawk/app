<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo __('Edit Setting');?></h1>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<?php echo Inflector::Humanize($this->request->data['Setting']['name']);?>
	</div>
	<div class="panel-body">
		<?php
			echo $this->Form->create();
			echo $this->Form->input('id');
			echo $this->Form->input('name', array('type' => 'hidden'));
		?>
			<fieldset>
				<div class="form-group">
					<?php
						echo $this->Form->input('value',
												array('class' => 'form-control'));
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
		<?php echo $this->Html->link(__('Back to Settings'),
									 array('action' => 'index'),
									 array('class' => 'btn btn-default'));?>
	</div>
</div>