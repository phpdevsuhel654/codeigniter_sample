<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="<?php echo site_url('admin/dashboard'); ?>">Dashboard</a>
  </li>
  <li class="breadcrumb-item">
    <a href="<?php echo site_url('admin/comments'); ?>">Manage Comments</a>
  </li>
  <li class="breadcrumb-item active"><?php echo $page_title; ?></li>
</ol>

<!-- DataTables Example -->
<div class="card mb-3">
  <div class="card-header">              
    <i class="fas fa-table"></i>&nbsp;<?php echo $page_title; ?>
  </div>
  <div class="card-body">
    <div class="pb-3"><a href="<?php echo site_url('admin/comments/index'); ?>" class="btn btn-primary">Manage comments</a></div>
    <div class="table-responsive">
        <div class="form-group">
          <label for="id"><strong>Id:&nbsp;</strong><?php echo $comment_data->id; ?></label>
        </div>
        <div class="form-group">
          <label for="title"><strong>Post Title:&nbsp;</strong><?php echo $comment_data->post_title; ?></label>
        </div>
        <div class="form-group">
          <label for="title"><strong>Comment By Name:&nbsp;</strong><?php echo $comment_data->name; ?></label>
        </div>
        <div class="form-group">
          <label for="title"><strong>Comment By Email:&nbsp;</strong><?php echo $comment_data->email; ?></label>
        </div>
        <div class="form-group">
          <label for="description"><strong>Comment:&nbsp;</strong><?php echo $comment_data->comment; ?></label>
        </div>
    </div>
  </div>
</div>