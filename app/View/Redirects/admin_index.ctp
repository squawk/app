<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo __('Redirects'); ?></h1>
	</div>
</div>

<div class="well">
	<?php echo $this->Form->create('Redirect', array('action' => 'index'));?>
		<fieldset class="form-group">
			<div class="input-group custom-search-form">
				<?php if (!empty($search)) : ?>
					<?php echo $this->Form->input('search', array('class' => 'form-control', 'label' => false, 'div' => false, 'value' => $search));?>
				<?php else : ?>
					<?php echo $this->Form->input('search',
												  array('type' => 'text',
														'class' => 'form-control',
														'placeholder' => 'Search...',
														'label' => false,
														'div' => false));?>
				<?php endif; ?>

				<span class="input-group-btn">
						<?php echo $this->Form->button('<i class="fa fa-search"></i>',
													   array('class' => 'btn btn-default',
															 'escape' => false,
															 'type' => 'submit',
															 'div' => false));?>
					</span>
			</div>
			<!-- /input-group -->
		</fieldset>
		<?php if (!empty($search)) : ?>
			<?php echo $this->Html->link(__('Reset'), array('action' => 'index')); ?>
		<?php endif; ?>
	<?php echo $this->Form->end();?>

	<?php echo $this->Html->link('<i class="fa fa-plus"></i> ' . __('Add a Redirect'),
								 array('action' => 'add'),
								 array('class' => 'btn btn-primary',
									   'escape' => false)); ?>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<?php echo __('Current Redirects'); ?>
			</div>

			<!-- /.panel-heading -->
			<div class="panel-body">
				<?php if ($redirects) : ?>
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th><?php echo $this->Paginator->sort('url', __('URL'));?></th>
									<th><?php echo $this->Paginator->sort('redirect', __('Redirect To'));?></th>
									<th><?php echo __('Options');?></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($redirects as $redirect) : ?>
									<tr>
										<td><?php echo $this->Html->link($redirect['Redirect']['url'], '/' . $redirect['Redirect']['url'], array('target' => '_blank')); ?></td>
										<td><?php echo (!empty($redirect['Redirect']['redirect'])) ? $redirect['Redirect']['redirect'] : '/'; ?></td>
										<td>
											<?php
												echo $this->Html->link('<i class="fa fa-edit"></i>',
																   array('action' => 'edit', $redirect['Redirect']['id']),
																   array('class' => 'btn btn-warning',
																		 'escape' => false,
																		 'alt' => __('Edit'),
																		 'title' => __('Edit')));


												echo '&nbsp;';
												echo $this->Form->postLink('<i class="fa fa-trash-o"></i>',
																		   array('action' => 'delete', $redirect['Redirect']['id']),
																		   array('class' => 'btn btn-danger',
																				 'escape' => false,
																				 'alt' => __('Delete'),
																				 'title' => __('Delete'),
																				 'confirm' => __('Are you sure you want to delete the redirect: %s?', $redirect['Redirect']['url'])));
											?>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>

						<?php echo $this->element('admin/pagination'); ?>
					</div>
				<?php elseif (!empty($search)) : ?>
					<?php echo __('Your search returned no results, please try again!'); ?>
				<?php else : ?>
					<?php echo __('There are no redirects at the moment!'); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>