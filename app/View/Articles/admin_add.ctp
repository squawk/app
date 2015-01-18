<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo __('Add Article');?></h1>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<?php echo __('Article Details');?>
	</div>
	<div class="panel-body">
		<?php echo $this->Form->create(); ?>
			<fieldset>
				<?php
					echo $this->Form->input('title', array('div' => 'form-group', 'class' => 'form-control'));
					echo $this->Form->input('brief', array('div' => 'form-group', 'class' => 'form-control'));
					echo $this->Ck->input('content', array('div' => 'form-group'));
				?>


				<div class="row">
					<div class="col-lg-6">
						<?php
							echo $this->Form->input('meta_description', array('div' => 'form-group', 'class' => 'form-control'));
						?>
					</div>
					<div class="col-lg-6">
						<?php
							echo $this->Form->input('meta_keywords', array('div' => 'form-group', 'class' => 'form-control'));
						?>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6">
						<?php
							echo $this->Form->input('date', array('div' => 'form-group'));
						?>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6">
						<?php
							echo $this->Form->input('route',
													array('label' => __('301 Redirect'),
														  'class' => 'form-control',
														  'after' => __('If set, the page will link to this URL')));
						?>
					</div>
				</div>
				<div class="checkbox check">
					<?php echo $this->Form->input('new_window',
												  array('label' => __('Make this article open in a new window?'))); ?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->submit(__('Add Article'),
												   array('class' => 'btn btn-primary'));?>
				</div>
			</fieldset>
		<?php echo $this->Form->end();?>
	</div>
	<div class="panel-footer">
		<?php echo $this->Html->link(__('Back to Articles'),
									 array('action' => 'index'),
									 array('class' => 'btn btn-default'));?>
	</div>
</div>