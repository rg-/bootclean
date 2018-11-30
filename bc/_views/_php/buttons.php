<h3>Basic buttons</h3>
<div class="example-block gmb-2">
	<button type="button" class="btn btn-primary">Primary</button>
	<button type="button" class="btn btn-secondary">Secondary</button>
	<button type="button" class="btn btn-success">Success</button>
	<button type="button" class="btn btn-info">Info</button>
	<button type="button" class="btn btn-warning">Warning</button>
	<button type="button" class="btn btn-danger">Danger</button>
	<button type="button" class="btn btn-light">Light</button>
	<button type="button" class="btn btn-dark">Dark</button>
	<button type="button" class="btn btn-link">Link</button>
</div>

<h3>Outline buttons</h3>
<div class="example-block gmb-2">
	<button type="button" class="btn btn-outline-primary">Primary</button>
	<button type="button" class="btn btn-outline-secondary">Secondary</button>
	<button type="button" class="btn btn-outline-success">Success</button>
	<button type="button" class="btn btn-outline-info">Info</button>
	<button type="button" class="btn btn-outline-warning">Warning</button>
	<button type="button" class="btn btn-outline-danger">Danger</button>
	<button type="button" class="btn btn-outline-light">Light</button>
	<button type="button" class="btn btn-outline-dark">Dark</button>
</div>

<h3>Sizes</h3>
<div class="example-block gmb-2">
	<div class="row">
		<div class="col-sm-6">
			<p>
				<button type="button" class="btn btn-primary btn-lg">Large button</button>
				<button type="button" class="btn btn-secondary btn-lg">Large button</button>
			</p>
			<p>
				<button type="button" class="btn btn-primary">Default button</button>
				<button type="button" class="btn btn-secondary">Default button</button>
			</p>
			<p>
				<button type="button" class="btn btn-primary btn-sm">Small button</button>
				<button type="button" class="btn btn-secondary btn-sm">Small button</button>
			</p>
			<p>
				<button type="button" class="btn btn-primary btn-lg btn-block">Block level button</button>
				<button type="button" class="btn btn-secondary btn-lg btn-block">Block level button</button>
			</p>
		</div>
		<div class="col-sm-6">
			<p>
				<button type="button" class="btn btn-primary btn-lg">ปุ่มใหญ่</button>
				<button type="button" class="btn btn-secondary btn-lg">ปุ่มใหญ่</button>
			</p>
			<p>
				<button type="button" class="btn btn-primary">ปุ่มปกติ</button>
				<button type="button" class="btn btn-secondary">ปุ่มปกติ</button>
			</p>
			<p>
				<button type="button" class="btn btn-primary btn-sm">ปุ่มเล็ก</button>
				<button type="button" class="btn btn-secondary btn-sm">ปุ่มเล็ก</button>
			</p>
			<p>
				<button type="button" class="btn btn-primary btn-lg btn-block">ปุ่มระดับบล็อค</button>
				<button type="button" class="btn btn-secondary btn-lg btn-block">ปุ่มระดับบล็อค</button>
			</p>
		</div>
	</div>
</div>

<h3>Active state</h3>
<div class="example-block gmb-2">
	<button type="button" class="btn btn-primary active">Primary</button>
	<button type="button" class="btn btn-secondary active">Secondary</button>
	<button type="button" class="btn btn-success active">Success</button>
	<button type="button" class="btn btn-info active">Info</button>
	<button type="button" class="btn btn-warning active">Warning</button>
	<button type="button" class="btn btn-danger active">Danger</button>
	<button type="button" class="btn btn-light active">Light</button>
	<button type="button" class="btn btn-dark active">Dark</button>
	<hr />
	<button type="button" class="btn btn-primary active">ปุ่มหลัก</button>
	<button type="button" class="btn btn-secondary active">ปุ่มลำดับสอง</button>
	<button type="button" class="btn btn-success active">สำเร็จ</button>
	<button type="button" class="btn btn-info active">ข้อมูล</button>
	<button type="button" class="btn btn-warning active">เตือน</button>
	<button type="button" class="btn btn-danger active">อันตราย</button>
	<button type="button" class="btn btn-light active">สว่าง</button>
	<button type="button" class="btn btn-dark active">มืด</button>
</div>

<h3>Disabled state</h3>
<div class="example-block gmb-2">
	<p>
		<button type="button" class="btn btn-primary" disabled="">Primary button</button>
		<button type="button" class="btn btn-secondary" disabled="">Secondary button</button>
	</p>
	<p>
		<button type="button" class="btn btn-primary" disabled="">ปุ่มหลัก</button>
		<button type="button" class="btn btn-secondary" disabled="">ปุ่มลำดับสอง</button>
	</p>
</div>

<h3>Toggle states</h3>
<div class="example-block gmb-2">
	<button type="button" class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off">
		Single toggle
	</button>
</div>

<h3>Checkbox and radio buttons</h3>
<div class="example-block gmb-2">
	<div class="btn-group-toggle" data-toggle="buttons">
		<label class="btn btn-primary active">
			<input type="checkbox" checked autocomplete="off"> Checkbox 1 (pre-checked)
		</label>
		<label class="btn btn-primary">
			<input type="checkbox" autocomplete="off"> Checkbox 2
		</label>
		<label class="btn btn-primary">
			<input type="checkbox" autocomplete="off"> Checkbox 3
		</label>
	</div>
	<hr>
	<div class="btn-group btn-group-toggle" data-toggle="buttons">
		<label class="btn btn-primary active">
			<input type="radio" name="options" id="option1" autocomplete="off" checked> Radio 1 (preselected)
		</label>
		<label class="btn btn-primary">
			<input type="radio" name="options" id="option2" autocomplete="off"> Radio 2
		</label>
		<label class="btn btn-primary">
			<input type="radio" name="options" id="option3" autocomplete="off"> Radio 3
		</label>
	</div>
</div>