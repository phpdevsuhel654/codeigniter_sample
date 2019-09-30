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
        if(empty($user_id)) {
          echo form_open('admin/users/insert', array('id' => 'frm_user', 'name' => 'frm_user', 'action' => 'post'));
        } else {
          echo form_open('admin/users/update/' . $user_id, array('id' => 'frm_user', 'name' => 'frm_user', 'action' => 'post'));
        }
      ?>
        <div class="form-group">
          <label for="first_name">First Name:</label>
          <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo (!empty($user_data->first_name))?$user_data->first_name:""; ?>">
        </div><div class="form-group">
          <label for="last_name">Last Name:</label>
          <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo (!empty($user_data->last_name))?$user_data->last_name:""; ?>">
        </div>
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" class="form-control" id="username" name="username" value="<?php echo (!empty($user_data->username))?$user_data->username:""; ?>">
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="text" class="form-control" id="email" name="email" value="<?php echo (!empty($user_data->email))?$user_data->email:""; ?>">
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" class="form-control" id="password" name="password" value="">
        </div>
        <div class="form-group">
          <label for="confirm_password">Confirm Password:</label>
          <input type="password" class="form-control" id="confirm_password" name="confirm_password" value="">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</div>