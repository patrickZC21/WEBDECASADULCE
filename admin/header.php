<?php $informativos=mysqli_fetch_array(mysqli_query($link,"select * from _informativos where id=1"));  if(!$_SESSION["id_usuario_ADM"]){?> <script>window.location.href='/admin/';</script><?php } ?>

<div id="header" class="header navbar navbar-inverse navbar-fixed-top">
			<!-- BEGIN container-fluid -->
			<div class="container-fluid">
				<!-- BEGIN mobile sidebar expand / collapse button -->
				<div class="navbar-header">
					<a href="home.php"><img src="<?= URL ?>/images/<?= $informativos["logo"] ?>" alt="" width="120" height="50"></a>
					<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<!-- END mobile sidebar expand / collapse button -->
				<!-- BEGIN header navigation right -->
				<div class="navbar-xs-justified">
					<ul class="nav navbar-nav navbar-right">
						<!--<li>
							<a href="javascript:;" data-toggle="search-bar" class="navbar-icon">
								<i class="ti-search"></i>
							</a>
						</li>-->
						<!--<li class="dropdown">
							<a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle navbar-icon with-label">
								<i class="ti-bell"></i>
							</a>
							<ul class="dropdown-menu dropdown-lg no-padding">
								<li class="dropdown-header"><a href="#" class="dropdown-close">&times;</a>Today</li>
								<li class="notification">
									<a href="#">
										<div class="notification-icon bg-primary">
											<i class="ti-apple"></i>
										</div>
										<div class="notification-info">
											<h4 class="notification-title">App Store <span class="notification-time">Just now</span></h4>
											<p class="notification-desc">
												Your iOS application has been approved
											</p>
										</div>
									</a>
								</li>
								<li class="notification">
									<a href="#">
										<div class="notification-icon bg-success">
											<i class="ti-android"></i>
										</div>
										<div class="notification-info">
											<h4 class="notification-title">Google Play <span class="notification-time">5 min ago</span></h4>
											<p class="notification-desc">
												Your android application has been approved
											</p>
										</div>
									</a>
								</li>
								<li class="notification">
									<a href="#">
										<div class="notification-icon bg-muted">
											<i class="ti-github"></i>
										</div>
										<div class="notification-info">
											<h4 class="notification-title">Github  <span class="notification-time">12 min ago</span></h4>
											<p class="notification-desc">
												Error with notifications from Private Repos
											</p>
										</div>
									</a>
								</li>
								<li class="dropdown-header"><a href="#" class="dropdown-close">&times;</a>Yesterday</li>
								<li class="notification">
									<a href="#">
										<div class="notification-icon bg-purple">
											<i class="ti-email"></i>
										</div>
										<div class="notification-info">
											<h4 class="notification-title">Gmail  <span class="notification-time">12:50pm</span></h4>
											<p class="notification-desc">
												You have 2 unread email
											</p>
										</div>
									</a>
								</li>
								<li class="notification">
									<a href="#">
										<div class="notification-icon">
											<img src="assets/img/user-2.jpg" alt="" />
										</div>
										<div class="notification-info">
											<h4 class="notification-title">Corey  <span class="notification-time">10:20am</span></h4>
											<p class="notification-desc">
												There's so much room for activities!
											</p>
										</div>
									</a>
								</li>
								<li class="notification">
									<a href="#">
										<div class="notification-icon bg-gradient-aqua">
											<i class="ti-twitter"></i>
										</div>
										<div class="notification-info">
											<h4 class="notification-title">Twitter  <span class="notification-time">12:50pm</span></h4>
											<p class="notification-desc">
												@sergiolucas: Most rain in the last two days: 85mm Gabo Island (Mar
											</p>
										</div>
									</a>
								</li>
							</ul>
						</li>-->
						<li class="dropdown">
							<a href="javascript:;" data-toggle="dropdown" class="navbar-icon">
								<i class="ti-settings"></i>
							</a>
							<ul class="dropdown-menu dropdown-md no-padding" data-dropdown-close="false">
								<li class="dropdown-header">Aspecto</li>
								<li class="setting">
									<div class="setting-icon bg-inverse"><i class="ti-wand"></i></div>
									<div class="setting-info">
										<div class="switcher">
											<input type="checkbox" name="setting_sidebar_inverse" id="setting_sidebar_inverse" checked />
											<label for="setting_sidebar_inverse"></label>
										</div>
										Sidebar Inverse
									</div>
								</li>
								<li class="setting">
									<div class="setting-icon bg-inverse"><i class="ti-layout-slider-alt"></i></div>
									<div class="setting-info">
										<div class="switcher">
											<input type="checkbox" name="setting_fixed_sidebar" id="setting_fixed_sidebar" checked />
											<label for="setting_fixed_sidebar"></label>
										</div>
										Fixed Sidebar
									</div>
								</li>
								<li class="setting">
									<div class="setting-icon bg-inverse"><i class="ti-layout-accordion-list"></i></div>
									<div class="setting-info">
										<div class="switcher">
											<input type="checkbox" name="setting_sidebar_minified" id="setting_sidebar_minified" />
											<label for="setting_sidebar_minified"></label>
										</div>
										Sidebar Minified
									</div>
								</li>
								<li class="dropdown-header">Header Settings</li>
								<li class="setting">
									<div class="setting-icon bg-inverse"><i class="ti-spray"></i></div>
									<div class="setting-info">
										<div class="switcher">
											<input type="checkbox" name="setting_header_inverse" id="setting_header_inverse" checked />
											<label for="setting_header_inverse"></label>
										</div>
										Header Inverse
									</div>
								</li>
								<li class="setting">
									<div class="setting-icon bg-inverse"><i class="ti-layout-tab-window"></i></div>
									<div class="setting-info">
										<div class="switcher">
											<input type="checkbox" name="setting_fixed_header" id="setting_fixed_header" checked />
											<label for="setting_fixed_header"></label>
										</div>
										Fixed Header
									</div>
								</li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="javascript:;" data-toggle="dropdown">
								<span class="navbar-user-img online pull-right">
									<i class="ti-user"></i>
								</span>
								<span class="hidden-xs "><?=$_SESSION["ADM_user_name"]?></span>
							</a>
							<ul class="dropdown-menu">
								
								
								<li class="divider"></li>
								<li><a href="index.php?cerrar">Salir</a></li>
							</ul>
						</li>
					</ul>
				</div>
				<!-- END header navigation right -->
			</div>
			<!-- END container-fluid -->
			<!-- BEGIN header-search-bar -->
			<div class="header-search-bar">
                <form action="#" method="POST" name="search_bar_form">
                    <div class="form-group">
                        <div class="left-icon"><i class="ti-search"></i></div>
                        <input type="text" class="form-control" id="header-search" placeholder="Search infinite admin..." />
                        <a href="javascript:;" data-dismiss="search-bar" class="right-icon"><i class="ti-close"></i></a>
                    </div>
                </form>
			</div>
			<!-- END header-search-bar -->
		</div>