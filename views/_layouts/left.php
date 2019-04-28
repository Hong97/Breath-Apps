


<div class="main-menu">
	<header class="header">
		<a href="index.html" class="logo"><i class="ico mdi mdi-cube-outline"></i>Breath App</a>
		<button type="button" class="button-close fa fa-times js__menu_close"></button>
		<div class="user">
			<h2 class="name"><a href="profile.html"><?= $_SESSION["userName"]?></a></h2>
		</div>
		<!-- /.user -->
	</header>
	<!-- /.header -->
	<div class="content">

		<div class="navigation">
			<h5 class="title">Breath App Menu</h5>
			<!-- /.title -->
			<ul class="menu js__accordion">
				<li>						
					<a class="waves-effect" href="<?=URL_BASE?>/users/dashboard"><i class="menu-icon mdi mdi-view-dashboard"></i><span>Dashboard</span></a>
				</li>
				<li>
					<a class="waves-effect" href="<?=URL_BASE?>/users/profile?userID=<?= $_SESSION["userID"]?>"><i class="menu-icon fa fa-user"></i><span>Profile</span></a>
				</li>
				<li>
					<a class="waves-effect" href="<?= URL_BASE;?>/groups"><i class="menu-icon fa fa-group"></i><span>Groups</span></a>
				</li>	
				<li>
					<a class="waves-effect" href="<?=URL_BASE?>/events/priority-list"><i class="menu-icon fa fa-clock-o"></i><span>Priority</span></a>
				</li>
				<li>
					<a class="waves-effect" href="<?=URL_BASE?>/events"><i class="menu-icon fa fa-calendar"></i><span>Events</span></a>
				</li>
				
			</ul>
		</div>
		<!-- /.navigation -->
	</div>
	<!-- /.content -->
</div>
<!-- /.main-menu -->