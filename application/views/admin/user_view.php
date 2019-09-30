<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="<?php echo site_url('admin/dashboard'); ?>">Dashboard</a>
  </li>
  <li class="breadcrumb-item">
    <a href="<?php echo site_url('admin/users'); ?>">Manage Users</a>
  </li>
  <li class="breadcrumb-item active"><?php echo $page_title; ?></li>
</ol>

<!-- DataTables Example -->
<div class="card mb-3">
  <div class="card-header">              
    <i class="fas fa-table"></i>&nbsp;<?php echo $page_title; ?>
  </div>
  <div class="card-body">
    <div class="pb-3"><a href="<?php echo site_url('admin/users/index'); ?>" class="btn btn-primary">Manage Roles</a></div>
    <div class="table-responsive">
        <div class="form-group">
          <label for="id"><strong>User Id:&nbsp;</strong><?php echo $user_data->id; ?></label>
        </div>
        <div class="form-group">
          <label for="first_name"><strong>First Name:&nbsp;</strong><?php echo $user_data->first_name; ?></label>
        </div>
        <div class="form-group">
          <label for="last_name"><strong>Last Name:&nbsp;</strong><?php echo $user_data->last_name; ?></label>
        </div>
        <div class="form-group">
          <label for="username"><strong>Username:&nbsp;</strong><?php echo $user_data->username; ?></label>
        </div>
        <div class="form-group">
          <label for="email"><strong>Email:&nbsp;</strong><?php echo $user_data->email; ?></label>
        </div>
    </div>
  </div>
</div>