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
      <!---- Success Message ---->
      <?php if ($this->session->flashdata('success')) { ?>
        <div class="alert alert-success"><strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?></div>
      <?php } ?>
      <!---- Error Message ---->
      <?php if ($this->session->flashdata('failure')) { ?>
        <div class="alert alert-danger"><strong>Success!</strong> <?php echo $this->session->flashdata('failure'); ?></div>
      <?php } ?>
      <?php if (!empty(validation_errors())) { ?>
        <div class="alert alert-danger"><strong>Error!</strong> <?php echo validation_errors(); ?></div>
      <?php } ?>
      <?php
        if(empty($role_id)) {
          echo form_open('admin/roles/insert', array('id' => 'frm_role', 'name' => 'frm_role', 'action' => 'post'));
        } else {
          echo form_open('admin/roles/update/' . $role_id, array('id' => 'frm_role', 'name' => 'frm_role', 'action' => 'post'));
        }
      ?>
        <div class="form-group">
          <label for="role_name">Role Name:</label>
          <input type="text" class="form-control" id="role_name" name="role_name" value="<?php echo (!empty($role_data->role_name))?$role_data->role_name:""; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</div>