<nav
		class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
		id="layout-navbar">
	<div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
		<a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
			<i class="ri-menu-fill ri-22px"></i>
		</a>
	</div>

	<div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
		<!-- Search -->
<!--		<div class="navbar-nav align-items-center">-->
<!--			<div class="nav-item navbar-search-wrapper mb-0">-->
<!--				<a class="nav-item nav-link search-toggler fw-normal px-0" href="javascript:void(0);">-->
<!--					<i class="ri-search-line ri-22px scaleX-n1-rtl me-3"></i>-->
<!--					<span class="d-none d-md-inline-block text-muted">Search (Ctrl+/)</span>-->
<!--				</a>-->
<!--			</div>-->
<!--		</div>-->
		<!-- /Search -->

		<ul class="navbar-nav flex-row align-items-center ms-auto">
			<!-- Profiler -->
			<li class="nav-item nav-profiler">
				<a
						class="nav-link btn btn-text-secondary rounded-pill btn-icon"
						href="javascript:void(0);"
						data-bs-toggle="modal"
						data-bs-target="#profilerModal">
					<i class="ri-dashboard-2-line ri-22px"></i>
					<span class="d-none position-absolute top-0 start-50 translate-middle-y badge badge-dot bg-danger mt-2 border"></span>
				</a>
			</li>
			<!--/ Profiler -->

			<!-- Error -->
			<li class="nav-item nav-error">
				<a
						class="nav-link btn btn-text-secondary rounded-pill btn-icon"
						href="javascript:void(0);"
						data-bs-toggle="modal"
						data-bs-target="#errorModal">
					<i class="ri-error-warning-line ri-22px"></i>
					<span class="d-none position-absolute top-0 start-50 translate-middle-y badge badge-dot bg-danger mt-2 border"></span>
				</a>
			</li>
			<!--/ Error -->

			<!-- User -->
			<li class="nav-item navbar-dropdown dropdown-user dropdown">
				<a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
					<div class="avatar avatar-online bg-primary rounded-circle d-flex justify-content-center align-items-center">
						<span class="text-white"><?=mb_substr($headerData['name'],0,1)?></span>
					</div>
				</a>
				<ul class="dropdown-menu dropdown-menu-end">
					<li>
						<a class="dropdown-item" href="pages-account-settings-account.html">
							<div class="d-flex justify-content-between">
								<span class="fw-medium d-block small"><?=$this->userData->name?></span>
								<small class="text-muted"><?=$this->userData->id?></small>
							</div>
						</a>
					</li>
					<li>
						<div class="dropdown-divider"></div>
					</li>
					<li>
						<a class="dropdown-item" href="<?=base_url('/admin/myInfo')?>">
							<i class="ri-user-3-line ri-22px me-3"></i><span class="align-middle"><?=lang('My Info')?></span>
						</a>
					</li>
					<li>
						<div class="dropdown-divider"></div>
					</li>
					<li>
						<div class="d-grid px-4 pt-2 pb-1">
							<a class="btn btn-sm btn-danger d-flex" href="<?=base_url('admin/auth/logout')?>" target="_self">
								<small class="align-middle"><?=lang('Logout')?></small>
								<i class="ri-logout-box-r-line ms-2 ri-16px"></i>
							</a>
						</div>
					</li>
				</ul>
			</li>
			<!--/ User -->
		</ul>
	</div>

	<!-- Search Small Screens -->
	<div class="navbar-search-wrapper search-input-wrapper d-none">
		<input
				type="text"
				class="form-control search-input container-xxl border-0"
				placeholder="Search..."
				aria-label="Search..." />
		<i class="ri-close-fill search-toggler cursor-pointer"></i>
	</div>
</nav>
