<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="<?php echo site_url('admin/dashboard'); ?>">Dashboard</a>
  </li>
  <li class="breadcrumb-item">
    <a href="<?php echo site_url('admin/roles'); ?>">Manage Roles</a>
  </li>
  <li class="breadcrumb-item active"><?php echo $page_title; ?></li>
</ol>

<!-- DataTables Example -->
<div class="card mb-3">
  <div class="card-header">              
    <i class="fas fa-table"></i>&nbsp;<?php echo $page_title; ?>
  </div>
  <div class="card-body">
    <div class="pb-3"><a href="<?php echo site_url('admin/roles/index'); ?>" class="btn btn-primary">Manage Roles</a></div>
    <div class="table-responsive">
        <div class="form-group">
          <label for="role_name"><strong>Role Id:&nbsp;</strong><?php echo $role_data->id; ?></label>
        </div>
        <div class="form-group">
          <label for="role_name"><strong>Role Name:&nbsp;</strong><?php echo $role_data->role_name; ?></label>
        </div>
    </div>
  </div>
</div>