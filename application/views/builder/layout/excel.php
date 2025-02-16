<div class="row g-6 mb-6">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb"><?=get_admin_breadcrumbs($titleList)?></ol>
	</nav>
</div>
<div class="row g-6 mb-6">
	<div class="card mb-6">
		<div class="card-header border-bottom">
			<h5 class="mb-0"><?=lang('nav.'.$titleList[1])?> 엑셀 업로드</h5>
			<span class="small d-block mt-1 text-gray">엑셀 업로드 관리 페이지입니다.</span>
			<div class="mt-4">
				<h6 class="mb-1">유의사항</h6>
				<p class="text-start mb-0">
					- 파일제한 : <?=UPLOAD_MAX_FILESIZE_TXT?>B
				</p>
				<p class="text-start mb-0">
					- 허용파일 : 파일 확장자 <span class="h6">.xlsx</span> 파일
				</p>
			</div>
			<div class="mt-4">
				<h6 class="mb-1">작성 시 주의사항</h6>
				<p class="text-start mb-0">
					- 반드시 아래 샘플 양식을 활용하고 불필요한 빈칸이 없도록 작성합니다.
				</p>
				<p class="text-start mb-0">
					- 빈 칸을 주의해서 작성해주세요.
				</p>
				<p class="text-start mb-0">
					- 샘플 양식을 활용 시 첫번째 행은 삭제하지 마십시오.
				</p>
				<p class="text-start mt-4">
					<a href="<?=$sampleFile?>" class="btn btn-secondary p-2" download=""><i class="ri-download-line ri-14px me-2"></i><span class="small">샘플 파일 다운로드</span></a>
				</p>
			</div>
			<div class="row mt-8">
				<div class="input-group input-group-merge">
					<div class="form-floating form-floating-outline">
						<input type="file" name="excelFile" id="excelFile" accept="application/vnd.sealed.xls" class="form-control">
						<label for="form_side-thumbnail">엑셀업로드</label>
					</div>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="table-responsive text-nowrap mt-4">
				<table class="table table-centered mb-0 table-nowrap" id="inline-editable">
					<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Position</th>
						<th>Office</th>
						<th>Age</th>
						<th>Start date</th>
						<th>Salary</th>
						<th></th>
					</tr>
					</thead>

					<tbody>
					<tr>
						<td>1</td>
						<td>Tiger Nixon</td>
						<td>System Architect</td>
						<td>Edinburgh</td>
						<td>61</td>
						<td>2016/04/25</td>
						<td>$320,800</td>
						<td><button value="remove">remove</button></td>
					</tr>
					<tr>
						<td>2</td>
						<td>Garrett Winters</td>
						<td>Accountant</td>
						<td>Tokyo</td>
						<td>63</td>
						<td>2016/07/25</td>
						<td>$170,750</td>
						<td><button value="remove">remove</button></td>
					</tr>
					<tr>
						<td>3</td>
						<td>Ashton Cox</td>
						<td>Junior Technical Author</td>
						<td>San Francisco</td>
						<td>66</td>
						<td>2019/01/12</td>
						<td>$86,000</td>
						<td><button value="remove">remove</button></td>
					</tr>
					<tr>
						<td>4</td>
						<td>Cedric Kelly</td>
						<td>Senior Javascript Developer</td>
						<td>Edinburgh</td>
						<td>22</td>
						<td>2017/03/29</td>
						<td>$433,060</td>
						<td><button value="remove">remove</button></td>
					</tr>
					<tr>
						<td>5</td>
						<td>Airi Satou</td>
						<td>Accountant</td>
						<td>Tokyo</td>
						<td>33</td>
						<td>2018/11/28</td>
						<td>$162,700</td>
						<td><button value="remove">remove</button></td>
					</tr>
					<tr>
						<td>6</td>
						<td>Brielle Williamson</td>
						<td>Integration Specialist</td>
						<td>New York</td>
						<td>61</td>
						<td>2017/12/02</td>
						<td>$372,000</td>
						<td><button value="remove">remove</button></td>
					</tr>
					<tr>
						<td>7</td>
						<td>Herrod Chandler</td>
						<td>Sales Assistant</td>
						<td>San Francisco</td>
						<td>59</td>
						<td>2017/08/06</td>
						<td>$137,500</td>
						<td><button value="remove">remove</button></td>
					</tr>
					<tr>
						<td>8</td>
						<td>Rhona Davidson</td>
						<td>Integration Specialist</td>
						<td>Tokyo</td>
						<td>55</td>
						<td>2015/10/14</td>
						<td>$327,900</td>
						<td><button value="remove">remove</button></td>
					</tr>
					<tr>
						<td>9</td>
						<td>Colleen Hurst</td>
						<td>Javascript Developer</td>
						<td>San Francisco</td>
						<td>39</td>
						<td>2019/09/15</td>
						<td>$205,500</td>
						<td><button value="remove">remove</button></td>
					</tr>
					<tr>
						<td>10</td>
						<td>Sonya Frost</td>
						<td>Software Engineer</td>
						<td>Edinburgh</td>
						<td>23</td>
						<td>2018/12/13</td>
						<td>$103,600</td>
						<td><button value="remove">remove</button></td>
					</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
