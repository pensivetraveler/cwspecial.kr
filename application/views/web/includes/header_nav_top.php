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
				<li class="nav-item">
					<a class="nav-link fw-medium" aria-current="page" href="<?=base_url('/works')?>">작업물</a>
				</li>
				<li class="nav-item">
					<a class="nav-link fw-medium" href="<?=base_url('/notices')?>">공지사항</a>
				</li>
				<li class="nav-item">
					<a class="nav-link fw-medium" href="<?=base_url('/inquiries')?>">1:1 문의</a>
				</li>
				<li class="nav-item">
					<a class="nav-link fw-medium" href="<?=base_url('/myinfo')?>">내 정보</a>
				</li>
				<li class="nav-item">
					<a class="nav-link fw-medium" href="<?=base_url('/admin/dashboard')?>" target="_blank">Admin</a>
				</li>
			</ul>
		</div>
		<div class="landing-menu-overlay d-lg-none"></div>
		<!-- Menu wrapper: End -->
		<!-- Toolbar: Start -->
		<ul class="navbar-nav flex-row align-items-center ms-auto">
			<!-- navbar button: Start -->
			<li>
				<a
					href="<?=base_url('/auth/login')?>"
					class="btn btn-primary px-2 px-sm-4 px-lg-2 px-xl-4"
					target="_blank"
				><span class="tf-icons ri-user-line me-md-1"></span
					><span class="d-none d-md-block">Login/Register</span></a
				>
			</li>
			<!-- navbar button: End -->
		</ul>
		<!-- Toolbar: End -->
	</div>
</nav>
<!-- Navbar: End -->
