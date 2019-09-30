<!-- Header -->
<?php
	$action_name = $this->router->fetch_method();
	//echo $action_name; //exit();
	$home_sel = $blog_sel = $login_sel = $about_sel = $contact_sel = "";
	$home_act = $blog_act = $login_act = $about_act = $contact_act = "";
	if($action_name == 'index') {
		$home_sel = '<span class="sr-only">(current)</span>';
		$home_act = 'active';
	} else if($action_name == 'blogs' || $action_name == 'blogdetail') {
		$blog_sel = '<span class="sr-only">(current)</span>';
		$blog_act = 'active';
	} else if($action_name == 'login') {
		$login_sel = '<span class="sr-only">(current)</span>';
		$login_act = 'active';
	} else if($action_name == 'about') {
		$about_sel = '<span class="sr-only">(current)</span>';
		$about_act = 'active';
	} else if($action_name == 'contact') {
		$contact_sel = '<span class="sr-only">(current)</span>';
		$contact_act = 'active';
	}
?>
<header>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	  <a class="navbar-brand" href="<?php echo base_url('/'); ?>"><strong>My Blog</strong></a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNavDropdown">
		<ul class="navbar-nav">
		  <li class="nav-item <?php echo $home_act; ?>">
			<a class="nav-link" href="<?php echo base_url('/'); ?>">Home <?php echo $home_sel; ?></a>
		  </li>
		  <li class="nav-item <?php echo $blog_act; ?>">
			<a class="nav-link" href="<?php echo base_url('/home/blogs'); ?>">Blogs <?php echo $blog_sel; ?></a>
		  </li>
		  <li class="nav-item <?php echo $login_act; ?>">
			<a class="nav-link" href="<?php echo base_url('/admin/login'); ?>">Admin Login <?php echo $login_sel; ?></a>
		  </li>
		  <li class="nav-item <?php echo $about_act; ?>">
			<a class="nav-link" href="<?php echo base_url('/home/about'); ?>">About Us <?php echo $about_sel; ?></a>
		  </li>
		  <li class="nav-item <?php echo $contact_act; ?>">
			<a class="nav-link" href="<?php echo base_url('/home/contact'); ?>">Contact Us <?php echo $contact_sel; ?></a>
		  </li>
		</ul>
	  </div>
	</nav>	
</header>
<!-- Footer -->