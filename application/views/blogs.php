<!-- Page Content -->
<h2>Blog</h2>
<div class="row">
	<div class="col-md-12">
		<h3>Latest Posts</h3>
		<?php
			if(!empty($blogs)) {
				foreach($blogs as $key => $blog) {
		?>
			<div class="row mt-3">
				<div class="col-md-12">
					<h6><strong><?php echo ($key+1) . '. ' . $blog->title; ?></strong></h6>
					<div class="col-md-12"><?php echo substr($blog->description, 0, 250); ?>...<br/><a href="<?php echo base_url('/home/blogdetail') . '/' .  $blog->slug; ?>">Read More</a>
					</div>
					<div class="col-md-12">
						<strong>Created on <?php echo date('M d, Y', strtotime($blog->created_at)); ?></strong>
					</div>
				</div>
			</div>
		<?php
				}
			}
		?>
	</div>
</div>
<!-- Page Content -->