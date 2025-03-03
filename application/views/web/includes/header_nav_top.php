<!-- Navbar: Start -->
<nav class="layout-navbar container shadow-none py-0">
	<div class="navbar navbar-expand-lg landing-navbar border-top-0 px-4 px-md-8">
		<!-- Menu logo wrapper: Start -->
		<div class="navbar-brand app-brand demo d-flex py-0 py-lg-2 me-6">
			<!-- Mobile menu toggle: Start-->
			<button
					class="navbar-toggler border-0 px-0 me-2"
					type="button"
					data-bs-toggle="collapse"
					data-bs-target="#navbarSupportedContent"
					aria-controls="navbarSupportedContent"
					aria-expanded="false"
					aria-label="Toggle navigation">
				<i class="tf-icons ri-menu-fill ri-24px align-middle"></i>
			</button>
			<!-- Mobile menu toggle: End-->
			<a href="<?=base_url('/dashboard')?>" class="app-brand-link">
				<span class="app-brand-logo demo">
					<img src="<?=base_url('public/assets/web/img/logo.png')?>" alt="" class="w-px-100">
				</span>
			</a>
		</div>
		<!-- Menu logo wrapper: End -->
		<!-- Menu wrapper: Start -->
		<div class="collapse navbar-collapse landing-nav-menu" id="navbarSupportedContent">
			<button
					class="navbar-toggler border-0 text-heading position-absolute end-0 top-0 scaleX-n1-rtl"
					type="button"
					data-bs-toggle="collapse"
					data-bs-target="#navbarSupportedContent"
					aria-controls="navbarSupportedContent"
					aria-expanded="false"
					aria-label="Toggle navigation">
				<i class="tf-icons ri-close-fill"></i>
			</button>
			<ul class="navbar-nav me-auto p-4 p-lg-0">
				<?php if(!$isAdmin): ?>
				<li class="nav-item">
					<a class="nav-link fw-medium" aria-current="page" href="<?=base_url('/myWorks')?>"><?=lang('nav.MyWorks')?></a>
				</li>
				<?php endif; ?>
				<li class="nav-item">
					<a class="nav-link fw-medium" aria-current="page" href="<?=base_url('/works')?>"><?=lang('nav.Works')?></a>
				</li>
				<li class="nav-item">
					<a class="nav-link fw-medium" href="<?=base_url('/notices')?>"><?=lang('nav.Notices')?></a>
				</li>
				<?php if($isAdmin): ?>
				<li class="nav-item">
					<a class="nav-link fw-medium" href="<?=base_url('/admin/dashboard')?>" target="_blank">Admin</a>
				</li>
				<?php else: ?>
				<li class="nav-item">
					<a class="nav-link fw-medium" href="<?=base_url('/inquiries')?>"><?=lang('nav.Inquiries')?></a>
				</li>
				<li class="nav-item">
					<a class="nav-link fw-medium" href="<?=base_url('/auth/passwordCheck?redirect_to=/myInfo')?>"><?=lang('nav.MyInfo')?></a>
				</li>
				<?php endif; ?>
			</ul>
		</div>
		<div class="landing-menu-overlay d-lg-none"></div>
		<!-- Menu wrapper: End -->
		<!-- Toolbar: Start -->
		<ul class="navbar-nav flex-row align-items-center ms-auto">
			<!-- Notification -->
			<li class="nav-item dropdown-notifications navbar-dropdown dropdown me-8 me-xl-1">
				<a
						class="nav-link btn btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow"
						href="javascript:void(0);"
						data-bs-toggle="dropdown"
						data-bs-auto-close="outside"
						aria-expanded="false">
					<i class="ri-notification-2-line ri-22px"></i>
					<?php if(count($messages)>0): ?>
					<span class="position-absolute top-0 start-50 translate-middle-y badge badge-dot bg-danger mt-2 border"></span>
					<?php endif; ?>
				</a>
				<ul class="dropdown-menu dropdown-menu-end py-0">
					<li class="dropdown-menu-header border-bottom py-50">
						<div class="dropdown-header d-flex align-items-center py-2">
							<h6 class="mb-0 me-auto"><?=lang('Notification')?></h6>
							<div class="d-flex align-items-center">
								<?php if(count($messages)>0): ?>
								<span class="badge rounded-pill bg-label-primary fs-xsmall me-2"><?=count($messages)?> New</span>
								<?php endif; ?>
							</div>
						</div>
					</li>
					<li class="dropdown-notifications-list scrollable-container">
						<ul class="list-group list-group-flush">
							<?php foreach ($messages as $message): ?>
							<li class="list-group-item list-group-item-action dropdown-notifications-item" onclick="readMessage(<?=$message->message_id?>, <?=$message->article_id?>)">
								<div class="d-flex">
									<div class="flex-grow-1">
										<h6 class="small mb-1"><?=$message->content?></h6>
										<small class="text-muted"><?=get_message_time($message->created_dt)?></small>
									</div>
									<div class="flex-shrink-0 dropdown-notifications-actions">
										<a href="javascript:void(0)" class="dropdown-notifications-read"
										><span class="badge badge-dot"></span
											></a>
									</div>
								</div>
							</li>
							<?php endforeach; ?>
						</ul>
					</li>
					<li class="border-top">
						<div class="d-grid p-4">
							<a class="btn btn-primary btn-sm d-flex" href="/myWorks">
								<small class="align-middle"><?=lang('nav.MyWorks')?></small>
							</a>
						</div>
					</li>
				</ul>
			</li>
			<!--/ Notification -->

			<!-- navbar button: Start -->
			<?php if(!$isLogin): ?>
			<li>
				<a
					href="<?=base_url('/auth/login')?>"
					class="btn btn-sm btn-primary px-2 px-sm-4 px-lg-2 px-xl-4"
				><span class="tf-icons ri-login-box-line me-md-1"></span
					><span class="d-none d-md-block"><?=lang('Login')?></span></a
				>
			</li>
			<?php else: ?>
			<li>
				<a
					href="<?=base_url('/auth/logout')?>"
					class="btn btn-sm btn-danger px-2 px-sm-4 px-lg-2 px-xl-4"
				><span class="tf-icons ri-logout-box-r-line me-md-1"></span
					><span class="d-none d-md-block"><?=lang('Logout')?></span></a
				>
			</li>
			<?php endif; ?>
			<!-- navbar button: End -->
		</ul>
		<!-- Toolbar: End -->
	</div>
</nav>
<!-- Navbar: End -->
