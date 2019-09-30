<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="<?php echo site_url('admin/dashboard'); ?>">Dashboard</a>
  </li>
  <li class="breadcrumb-item active">Manage Comments</li>
</ol>

<!-- DataTables Example -->
<div class="card mb-3">
  <div class="card-header">              
    <i class="fas fa-table"></i>&nbsp;Comments Details              
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <!---- Success Message ---->
      <?php if ($this->session->flashdata('success')) { ?>
        <div class="alert alert-success"><strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?></div>
      <?php } ?>
      <!---- Error Message ---->
      <?php if ($this->session->flashdata('failure')) { ?>
        <div class="alert alert-danger"><strong>Error!</strong> <?php echo $this->session->flashdata('failure'); ?></div>
      <?php } ?>
      <table class="table table-bordered" cellspacing="0">
        <thead>
          <tr>
            <th>#</th>
            <th>Post Title</th>
            <th>Comment By Name</th>
            <th>Comment By Email</th>
            <th>Created At</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $colspan = 4;
          if(!empty($results)) {
            foreach($results as $row) {
          ?>
            <tr>
              <td><?php echo $row->id; ?></td>
              <td><?php echo $row->post_title; ?></td>
              <td><?php echo $row->name; ?></td>
              <td><?php echo $row->email; ?></td>
              <td><?php echo $row->created_at; ?></td>
              <td>
                <a href="<?php echo site_url('admin/comments/view/') . $row->id; ?>" class="icon_color"><i class="fas fa-eye"></i></a>&nbsp;
                <a href="<?php echo site_url('admin/comments/delete/') . $row->id; ?>" class="icon_color" onclick="if(!confirm('Are you sure you want to delete this?')) { return false; }"><i class="fas fa-window-close"></i></a>
              </td>
            </tr>
          <?php
            }
          } else {
          ?>
            <tr><td colspan="<?php echo $colspan; ?>">No data found.</td></tr>
          <?php
          }
          ?>
        </tbody>
        <tfoot>
          <tr>
            <th colspan="<?php echo $colspan; ?>"><div class="pagination"><?php echo $links; ?></div></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>