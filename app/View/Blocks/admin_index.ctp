<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">
			<?php echo __('Content Blocks');?>
		</h1>
	</div>
</div>

<div class="well">
	<?php echo $this->Form->create('Block', array('action' => 'index'));?>
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
	<?php echo $this->Html->link('<i class="fa fa-plus"></i> ' . __('Add a new content block'),
								 array('action' => 'add'),
								 array('class' => 'btn btn-primary',
									   'escape' => false)); ?>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<?php echo __('Current Content Blocks'); ?>
			</div>

			<!-- /.panel-heading -->
			<div class="panel-body">
				<?php if ($blocks) : ?>
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th><?php echo $this->Paginator->sort('name'); ?></th>
									<th><?php echo $this->Paginator->sort('slug', __('Slug / Key')); ?></th>
									<th><?php echo $this->Paginator->sort('modified', __('Last Modified')); ?></th>
									<th><?php echo __('Actions'); ?></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($blocks as $block): ?>
									<tr>
										<td><?php echo h($block['Block']['name']); ?></td>
										<td><?php echo h($block['Block']['slug']); ?></td>
										<td><?php echo $this->Time->niceShort($block['Block']['modified']); ?></td>
										<td class="actions">
											<?php
											echo $this->Html->link('<i class="fa fa-edit"></i>',
																   array('action' => 'edit',
																		 $block['Block']['id']),
																   array('class' => 'btn btn-warning',
																		 'escape' => false,
																		 'alt' => __('Edit'),
																		 'title' => __('Edit')));

											if (!empty($block['Block']['revisions']))	{
												echo '&nbsp;';
												echo $this->Html->link('<i class="fa fa-clipboard"></i>',
																	   array('controller' => 'revisions',
																	   		 'action' => 'model',
																	   		 'Block',
																			 $block['Block']['id']),
																	   array('class' => 'btn btn-info',
																			 'escape' => false,
																			 'alt' => __('Revisions'),
																			 'title' => __('Revisions')));
											}

											echo '&nbsp';
											echo $this->Form->postLink('<i class="fa fa-trash-o"></i>',
																	   array('action' => 'delete',
																			 $block['Block']['id']),
																	   array('class' => 'btn btn-danger',
																			 'escape' => false,
																			 'alt' => __('Delete'),
																			 'title' => __('Delete')),
																	   __('Are you sure you want to delete this content block?'));
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
					<?php echo __('There are no content blocks at the moment!'); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>