	<div class="pre-loader"></div>
	<div class="header clearfix">
		<div class="header-right"> 
			<div class="ml-3 menu-icon">
				<span></span>
				<span></span>
				<span></span>
				<span></span>
			</div>
			<div class="user-info-dropdown">
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<span class="user-icon"><i class="fa fa-user-o" style="color:#003b59!important;"></i></span>
						<span class="user-name"> <?php print( $query_fetch['name'] ) ?> </span>
					</a>
					<div class="dropdown-menu dropdown-menu-right">

						<a class="dropdown-item" href="/admin-panel/profile"><i class="fa fa-user-md"></i> Profile </a>
						<a class="dropdown-item" href="/admin-panel/password.php"> <i class="icon-copy fa fa-key"></i> Password </a>
						<a class="dropdown-item" href="/admin-panel/logout"><i class="fa fa-sign-out"></i> Log Out </a>
					
					</div>
				</div>
			</div> 
		</div>
	</div>