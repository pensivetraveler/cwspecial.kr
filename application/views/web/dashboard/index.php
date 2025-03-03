<div class="position-relative">
	<div class="h-px-800 d-flex flex-column justify-content-center">
		<div class="hero-text-box text-center">
			<h2 class="text-primary hero-title fs-2 font-gaeulsopung-b">우리의 작업물을 사용할<br>그 누군가를 상상하며</h2>
			<h5 class="mb-8 font-santteutdotum-m">
				창원대학교 특수교육과 AAC 제작팀
			</h5>
		</div>
		<div class="mt-8 text-center">
			<h3 class="font-SFssaraknoon"><b>새로운 작업물</b></h3>
			<ul class="list-group list-group-flush mb-8" id="dashboard-article-list">
				<?php foreach ($list as $item): ?>
				<a href="/works/view/<?=$item->article_id?>" class="fw-bold list-group-item list-group-item-action waves-effect lh-1 py-8 border-0">
					<?=$item->subject?>
				</a>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</div>
