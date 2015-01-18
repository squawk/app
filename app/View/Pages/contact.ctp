<div class="row">
	<div class="box">
		<?php if (!empty($page['Page']['content'])) {
			echo $page['Page']['content'];
		} ?>
	</div>
</div>

<div class="row">
	<div class="box">
		<div class="col-lg-12">
		<h3>Contact Form</h3>
			<?php echo $this->Form->create('Lead', array('role' => 'form')); ?>
				<div class="row">
					<?php
						echo $this->Form->input('name', array('div' => 'form-group col-lg-4', 'class' => 'form-control', 'label' => __('Name')));
						echo $this->Form->input('email', array('div' => 'form-group col-lg-4', 'class' => 'form-control', 'label' => __('Email Address')));
						echo $this->Form->input('phone', array('div' => 'form-group col-lg-4', 'class' => 'form-control', 'label' => __('Phone Number')));
					?>

					<div class="clearfix"></div>

					<?php
						echo $this->Form->input('message', array('div' => 'form-group col-lg-12', 'class' => 'form-control', 'label' => __('Message'), 'rows' => 6));
						echo $this->Form->submit(__('Submit'), array('div' => 'form-group col-lg-12', 'class' => 'btn btn-default'));
					?>
				</div>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>