<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo __('Manage Leads');?></h1>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<?php echo __('Search');?>
	</div>
	<div class="panel-body">
		<?php echo $this->Form->create('Lead', array('action' => 'index'));?>
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
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<?php echo __('Leads');?>
	</div>
	<?php if (!empty($leads)): ?>
		<div class="panel-body">
			<?php echo $this->element('admin/pagination'); ?>
			<div class="table-responsive">
				<table class="table table-striped table-hover dataTable" summary="<?php __('List of Leads'); ?>">
					<tr>
						<th><?php echo $this->Paginator->sort('type');?></th>
						<th><?php echo $this->Paginator->sort('name', __('Submitted by'));?></th>
						<th><?php echo $this->Paginator->sort('email');?></th>
						<th><?php echo $this->Paginator->sort('status');?></th>
						<th><?php echo $this->Paginator->sort('created');?></th>
						<th class="actions"><?php echo __('Options');?></th>
					</tr>
					<?php
					$i = 0;
					foreach ($leads as $lead):
						$class = null;
						if ($i++ % 2 == 0) {
							$class = ' class="altrow"';
						}
					?>
						<tr<?php echo $class;?>>
							<td><?php echo Inflector::humanize($lead['Lead']['type']); ?></td>
							<td><?php echo $lead['Lead']['name']; ?></td>
							<td><a href="mailto:<?php echo $lead['Lead']['email']; ?>"><?php echo $lead['Lead']['email']; ?></a></td>
							<td><?php if(!empty($lead['Lead']['status'])) : ?><?php echo $lead['Lead']['status']; ?><?php else : ?><strong>New</strong><?php endif; ?></td>
							<td><?php echo $this->Time->niceShort($lead['Lead']['created']); ?></td>
							<td class="actions">
								<?php
								echo $this->Html->link('<i class="fa fa-picture-o"></i>',
													   array('action' => 'view',
															 $lead['Lead']['id']),
													   array('class' => 'btn btn-primary',
															 'escape' => false,
															 'alt' => __('View'),
															 'title' => __('View'),
															 'target' => '_blank'));
								?>
								<?php
								echo $this->Form->postLink('<i class="fa fa-trash-o"></i>',
														   array('action' => 'delete',
																 $lead['Lead']['id'],
																 true),
														   array('class' => 'btn btn-danger',
																 'escape' => false,
																 'alt' => __('Delete'),
																 'title' => __('Delete')),
														   __('Are you sure you want to delete this lead?'));
								?>
							</td>
						</tr>
					<?php endforeach; ?>
				</table>
			</div>
		</div>
		<div class="panel-footer">
			<?php echo $this->element('admin/pagination'); ?>
		</div>
	<?php elseif(!empty($search)): ?>
		<div class="panel-body">
			<p class="no-content"><?php echo __('Your search returned no results.');?></p>
		</div>
	<?php else: ?>
		<div class="panel-body">
			<p class="no-content"><?php echo __('There are no leads at the moment.');?></p>
		</div>
	<?php endif;?>
</div>




