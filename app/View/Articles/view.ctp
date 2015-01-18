<div class="container">
	<div class="row">
		<div class="box">
			<div class="col-lg-12">
				<h1><?php echo $article['Article']['title']; ?></h1>

				<?php
					$image = 'slide-1.jpg';
					if (!empty($article['Article']['image'])) {
						$image = 'uploads/thumbs/' . $article['Article']['image'];
					}

					echo $this->Html->image($image, array('class' => 'img-responsive img-border img-full'));
				?>

				<h2><small><?php echo $this->Time->format('jS F Y', $article['Article']['date']); ?></small></h2>

				<?php echo $article['Article']['content']; ?>
			</div>

			<div class="col-lg-12 text-center">
				<ul class="pager">
					<li class="previous">
						<?php echo $this->Html->link(__('%s Back to articles', '&larr;'), array('action' => 'index'), array('escape' => false)); ?>
					</li>
				</ul>
			</div>

		</div>
	</div>
</div>
<!-- /.container -->