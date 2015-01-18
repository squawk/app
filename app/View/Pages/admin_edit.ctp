<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo __('Edit a Page');?></h1>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<?php echo __('Page Details');?>
	</div>
	<div class="panel-body">
		<?php
			echo $this->Form->create('Page');
			echo $this->Form->input('id');
		?>
			<fieldset>
				<div class="form-group">
					<?php
						echo $this->Form->input('name',
												array('label' => __('Page Name *'),
													  'class' => 'form-control'));
					?>
				</div>
				<div class="form-group">
					<?php
						echo $this->Form->input('meta_title',
												array('label' => __('Meta Title *'),
													  'class' => 'form-control'));
					?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('parent_id',
											array('label' => __('Set Parent Page'),
												  'empty' => __('No Parent'),
												  'options' => $pages,
												  'class' => 'form-control')); ?>
				</div>
				<?php if (Configure::read('Content.subTitle')) : ?>
					<div class="form-group">
						<?php echo $this->Form->input('sub_title',
													  array('label' => __('Sub-title'),
															'class' => 'form-control')); ?>
					</div>
				<?php endif; ?>
				<div class="form-group">
					<?php
						echo $this->Ck->input('content');
					?>
				</div>

				<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							<?php
								echo $this->Form->input('meta_description',
														array('class' => 'form-control'));
							?>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<?php
								echo $this->Form->input('meta_keywords',
														array('class' => 'form-control'));
							?>
						</div>
					</div>
				</div>
				<?php //if (Configure::read('Content.topMenu')) : ?>
					<div class="checkbox check">
						<?php echo $this->Form->input('top_show',
													  array('label' => __('Show this page in the top menu?'))); ?>
					</div>
				<?php //endif; ?>
				<?php //if (Configure::read('Content.bottomMenu')) : ?>
					<div class="checkbox check">
						<?php echo $this->Form->input('bottom_show',
													  array('label' => __('Show this page in the bottom menu?'))); ?>
					</div>
				<?php //endif; ?>

				<div id="newWindow" class="checkbox check">
					<?php echo $this->Form->input('new_window',
													  array('label' => __('Make this page open in a new window?'))); ?>
				</div>
				<div class="well">
					<h3><?php echo __('Advanced Settings'); ?></h3>
					<p><?php echo __('These settings are optional and should only be edited if you are sure what you are doing.'); ?></p>
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<?php
									echo $this->Form->input('slug',
															array('label' => __('Page Slug'),
																  'class' => 'form-control'));
								?>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group">
								<?php
									echo $this->Form->input('view',
															array('label' => __('Page View'),
																  'class' => 'form-control'));
								?>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12">
							<div class="checkbox check">
								<?php echo $this->Form->input('make_homepage', array('label' => __('Make this page the home page'), 'type' => 'checkbox')); ?>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<?php
									echo $this->Form->input('route',
															array('label' => __('301 Redirect'),
																  'class' => 'form-control',
																  'after' => __('If set, the page will link to this URL')));
								?>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<?php
									echo $this->Form->input('post_route',
															array('label' => __('Post Redirect'),
																  'class' => 'form-control',
																  'after' => __('If set, any form will be redirected to this URL.')));
								?>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<?php echo $this->Form->submit(__('Save Changes'),
												   array('class' => 'btn btn-primary'));?>
				</div>
			</fieldset>
		<?php echo $this->Form->end();?>
	</div>
	<div class="panel-footer">
		<?php echo $this->Html->link(__('Back to pages'),
									 array('action' => 'index'),
									 array('class' => 'btn btn-default'));?>
	</div>
</div>

<script>
	$(function() {

		function showHide() {
			if ($('#PageTopShow').prop('checked') || $('#PageBottomShow').prop('checked')) {
				$('#newWindow').show();
			} else {
				$('#newWindow').hide();
			}
		};

		$('#PageTopShow').click(function() { showHide(); });
		$('#PageBottomShow').click(function() { showHide(); });

		showHide();
	});
</script>