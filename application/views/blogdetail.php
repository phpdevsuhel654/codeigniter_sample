<!-- Page Content -->
<h2>Blog</h2>
<div class="row">
	<div class="col-md-12">
		<h3>Latest Posts</h3>
		<div class="row mt-3">
			<div class="col-md-12">
				<h6><strong><?php echo $blog->title; ?></strong></h6>
				<div class="col-md-12"><?php echo $blog->description; ?></div>
				<div class="col-md-12">
					<strong>Created on <?php echo date('M d, Y', strtotime($blog->created_at)); ?></strong>
				</div>
			</div>
		</div>

		<?php
			if(!empty($comments)) {
		?>
		<!-- Comments -->
		<div class="row  mt-3">
			<div class="col-md-12">
				<h3>Comments</h3>
			</div>
			<?php
				foreach($comments as $key => $comment) {
			?>
			<div class="col-md-12" style="background-color:#5f5f5f; margin-top:5px; margin-bottom:5px; color:#ffffff; ">
				<p><?php echo $comment->comment; ?></p>
				<p><i><?php echo 'Comment by ' . $comment->name . ' at ' . date('M d, Y H:i', strtotime($comment->created_at)); ?></i></p>
			</div>
			<?php
				}
			?>
		</div>
		<?php
			}
		?>

		<!-- Add Comments Form -->
		<div class="row  mt-3">
			<div class="col-md-12">
				<h3>Add Your Comment</h3>
			</div>
			<div class="col-md-6">
				<!---- Success Message ---->
				<?php if ($this->session->flashdata('success')) { ?>
					<div class="alert alert-success"><strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?></div>
				<?php } ?>
				<!---- Error Message ---->
				<?php if ($this->session->flashdata('failure')) { ?>
					<div class="alert alert-danger"><strong>Error!</strong> <?php echo $this->session->flashdata('failure'); ?></div>
				<?php } ?>
				<?php if (!empty(validation_errors())) { ?>
					<div class="alert alert-danger"><strong>Error!</strong> <?php echo validation_errors(); ?></div>
				<?php } ?>
				<?php echo form_open('home/blogdetail/' . $slug, array('id' => 'frm_comment', 'name' => 'frm_comment', 'action' => 'post')); ?>
				<form action="" method="post" id="frm_comment" name="frm_comment">
					<input type="hidden" id="post_id" name="post_id" value="<?php echo $blog->id; ?>" >
					<div class="form-group">
						<label for="name">Name:</label>
						<input type="text" class="form-control" id="name" name="name" >
					</div>
					<div class="form-group">
						<label for="email">Email:</label>
						<input type="text" class="form-control" id="email" name="email" >
					</div>
					<div class="form-group">
						<label for="comment">Comment:</label>
						<textarea class="form-control" rows="5" id="comment" name="comment" ></textarea>
					</div>
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>

	</div>
</div>
<!-- Page Content -->