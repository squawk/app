<!-- Start Results Bar -->
<?php
	$this->Paginator->options(array('url'=>Router::getParam('pass')));
?>
<div class="paging">
	<div class="totalresults">
		<strong><?php echo $this->Paginator->counter(array('format' => 'Showing %start% - %end%</strong> (of %count%)')); ?></strong>
	</div>
	<div class="pagenumber">
		<ul class="pagination">
			<?php if($this->Paginator->hasPrev()) : ?>
				<li><?php echo $this->Paginator->first('<< Start ', null, null, array('class' => 'disabled')); ?></li>
				<li><?php echo $this->Paginator->prev('<< Prev ', null, null, array('class' => 'disabled')); ?></li>
			<?php endif; ?>

			<?php if (is_string($this->Paginator->numbers())): ?>
				<?php echo $this->Paginator->numbers(array('separator' => '',
														   'before' => '',
														   'after' => '',
														   'tag' => 'li',
														   'currentTag' => 'span',
														   'currentClass' => 'active'));?>
			<?php endif; ?>

			<?php if($this->Paginator->hasNext()): ?>
				<li><?php echo $this->Paginator->next(' Next >>', null, null, array('class' => 'disabled')); ?></li>
				<li><?php echo $this->Paginator->last(' End >>', null, null, array('class' => 'disabled')); ?></li>
			<?php endif; ?>
		</ul>
	</div>
</div>
<!-- End Results Bar -->