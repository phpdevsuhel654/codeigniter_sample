<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="<?php echo site_url('admin/dashboard'); ?>">Dashboard</a>
  </li>
  <li class="breadcrumb-item active">Manage Users</li>
</ol>

<!-- DataTables Example -->
<div class="card mb-3">
  <div class="card-header">              
    <i class="fas fa-table"></i>&nbsp;Users Details              
  </div>
  <div class="card-body">
    <div class="pb-3"><a href="<?php echo site_url('admin/users/insert'); ?>" class="btn btn-primary">Add Role</a></div>
    <div class="table-responsive">
      <!---- Success Message ---->
      <?php if ($this->session->flashdata('success')) { ?>
        <div class="alert alert-success"><strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?></div>
      <?php } ?>
      <!---- Error Message ---->
      <?php if ($this->session->flashdata('failure')) { ?>
        <div class="alert alert-danger"><strong>Error!</strong> <?php echo $this->session->flashdata('failure'); ?></div>
      <?php } ?>
      <!-- Start: Filter block -->
      <div class="pb-3">
        <form class="form-search" method="post" action="<?php echo $form_url; ?>">
          <div class="col-md-4">
            <div class="input-group">
              <input type="text" class="form-control search-query" placeholder="Type your search word" name="search" id="search" value="<?php echo (!empty($search_string)?$search_string:"");?>">
              <span class="input-group-btn">
                <button type="submit" class="btn btn-purple btn-sm btn-search">
                  <span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
                  Search
                </button>
              </span>
            </div>
          </div>
        </form>
      </div>
      <!-- End: Filter block -->
      <table class="table table-bordered" cellspacing="0">
        <thead>
          <tr>
            <?php foreach($sort_cols as $field_name => $field_display): ?>
                <th>
                  <?php
                    $cur_field_sort_order = ($sort_by == $field_name ? $sort_order : 'asc');
                    echo anchor('admin/users/index/'.$field_name.'/'.$cur_field_sort_order.'/'.$search_string.'/'.$page, $field_display);
                    if($sort_by == $field_name && $cur_field_sort_order == 'asc') {
                      echo '<i class="fa fa-fw fa-sort-asc"></i>';
                    } else if($sort_by == $field_name && $cur_field_sort_order == 'desc') {
                      echo '<i class="fa fa-fw fa-sort-desc"></i>';
                    } else {
                      echo '<i class="fa fa-fw fa-sort"></i>';
                    }
                  ?>
                </th>
            <?php endforeach; ?>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $colspan = 6;
          if(!empty($results)) {
            foreach($results as $row) {
          ?>
            <tr>
              <td><?php echo $row->id; ?></td>
              <td><?php echo $row->first_name; ?></td>
              <td><?php echo $row->last_name; ?></td>
              <td><?php echo $row->username; ?></td>
              <td><?php echo $row->email; ?></td>
              <td>
                <a href="<?php echo site_url('admin/users/view/') . $row->id; ?>" class="icon_color"><i class="fas fa-eye"></i></a>&nbsp;
                <a href="<?php echo site_url('admin/users/update/') . $row->id; ?>" class="icon_color"><i class="fas fa-edit"></i></a>&nbsp;
                <a href="<?php echo site_url('admin/users/delete/') . $row->id; ?>" class="icon_color" onclick="if(!confirm('Are you sure you want to delete this?')) { return false; }"><i class="fas fa-window-close"></i></a>
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