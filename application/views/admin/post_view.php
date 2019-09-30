<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="<?php echo site_url('admin/dashboard'); ?>">Dashboard</a>
  </li>
  <li class="breadcrumb-item">
    <a href="<?php echo site_url('admin/posts'); ?>">Manage Posts</a>
  </li>
  <li class="breadcrumb-item active"><?php echo $page_title; ?></li>
</ol>

<!-- DataTables Example -->
<div class="card mb-3">
  <div class="card-header">              
    <i class="fas fa-table"></i>&nbsp;<?php echo $page_title; ?>
  </div>
  <div class="card-body">
    <div class="pb-3"><a href="<?php echo site_url('admin/posts/index'); ?>" class="btn btn-primary">Manage Posts</a></div>
    <div class="table-responsive">
        <div class="form-group">
          <label for="id"><strong>Id:&nbsp;</strong><?php echo $post_data->id; ?></label>
        </div>
        <div class="form-group">
          <label for="title"><strong>Title:&nbsp;</strong><?php echo $post_data->title; ?></label>
        </div>
        <div class="form-group">
          <label for="description"><strong>Description:&nbsp;</strong><?php echo $post_data->description; ?></label>
        </div>
    </div>
  </div>
</div>