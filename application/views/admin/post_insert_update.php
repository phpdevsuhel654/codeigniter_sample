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
      <?php
        if(empty($post_id)) {
          echo form_open('admin/posts/insert', array('id' => 'frm_post', 'name' => 'frm_post', 'action' => 'post'));
        } else {
          echo form_open('admin/posts/update/' . $post_id, array('id' => 'frm_post', 'name' => 'frm_post', 'action' => 'post'));
        }
      ?>
        <div class="form-group">
          <label for="title">Title:</label>
          <input type="text" class="form-control" id="title" name="title" value="<?php echo (!empty($post_data->title))?$post_data->title:""; ?>">
        </div>
        <div class="form-group">
          <label for="description">Description:</label>
          <?php /* ?><div id="quill_editor" class="quill_editor"><?php echo (!empty($post_data->description))?$post_data->description:""; ?></div><?php */ ?>
          <textarea class="form-control" id="description" name="description" ><?php echo (!empty($post_data->description))?$post_data->description:""; ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary" onclick="">Submit</button>
      </form>
    </div>
  </div>
</div>
<script>
  CKEDITOR.replace( 'description' );
</script>