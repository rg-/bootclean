<h2>Static example</h2>
<div class="example-block">
	<div class="modal modal-static">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Modal title | ไตเติล</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<p>One fine body&hellip;</p>
					<p>สไตรค์อุตรายันเนคเทค โอเลี้ยงเซ็นทารา ไพลินลูป</p>
				</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
					<button class="btn btn-primary" type="button">Save changes</button>
				</div>
			</div>
		</div>
	</div>
</div>

<h2>External load</h2>
<div class="example-block">
	<!--normal modal-->
	<a href="modals/modal.php" class="btn btn-secondary" data-toggle="external-modal" data-target="#main-modal">Normal modal</a>
	
	<a href="modals/modal.php" class="btn btn-secondary" data-toggle="external-modal" data-target="#main-modal" data-target-size="modal-lg">Large modal</a>
	
	<a href="modals/modal.php" class="btn btn-secondary" data-toggle="external-modal" data-target="#main-modal" data-target-size="modal-xs">Small modal</a>
	
	<a href="modals/modal.php" class="btn btn-secondary" data-toggle="external-modal" data-target="#main-modal" data-target-size="modal-dialog-centered">Vertically centered</a>
	
	<button data-external-target="modals/modal-full-content.php" class="btn btn-secondary" type="button" data-toggle="external-modal" data-target="#main-modal" data-target-size="modal-dialog-full">Full centered</button>
</div>

<h2>Optional sizes</h2>
<div class="example-block">
	<!--normal modal-->
	<button class="btn btn-secondary" type="button" data-toggle="modal" data-target="#myModal">Normal modal</button>
	<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 id="myModalLabel" class="modal-title">Modal title | ไตเติล</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam suscipit tincidunt iaculis. Phasellus hendrerit sem non dui commodo, vel iaculis nulla tincidunt.</p>
					<p>ช็อป โก๊ะ สกรัม เบนโตะสหรัฐทัวร์นาเมนท์ มั้งซามูไรพาสปอร์ตภควัทคีตาดัมพ์ฟีเวอร์ สตาร์ โฟล์คเทคโนแครตซิ่งราเมน ซาฟารีท็อปบู๊ทมยุราภิรมย์คอนเซปต์ ดัมพ์โอเปร่า ยังไง.</p>
				</div>
			</div>
		</div>
	</div>
	<!--end normal modal-->
	<!--large modal-->
	<button class="btn btn-secondary" type="button" data-toggle="modal" data-target=".bd-example-modal-lg">Large modal</button>
	<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 id="myLargeModalLabel" class="modal-title">Modal title | ไตเติล</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam suscipit tincidunt iaculis. Phasellus hendrerit sem non dui commodo, vel iaculis nulla tincidunt.</p>
					<p>ช็อป โก๊ะ สกรัม เบนโตะสหรัฐทัวร์นาเมนท์ มั้งซามูไรพาสปอร์ตภควัทคีตาดัมพ์ฟีเวอร์ สตาร์ โฟล์คเทคโนแครตซิ่งราเมน ซาฟารีท็อปบู๊ทมยุราภิรมย์คอนเซปต์ ดัมพ์โอเปร่า ยังไง.</p>
				</div>
			</div>
		</div>
	</div>
	<!--end large modal-->
	<!--small modal-->
	<button class="btn btn-secondary" type="button" data-toggle="modal" data-target=".bd-example-modal-sm">Small modal</button>
	<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 id="mySmallModalLabel" class="modal-title">Modal title | ไตเติล</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam suscipit tincidunt iaculis. Phasellus hendrerit sem non dui commodo, vel iaculis nulla tincidunt.</p>
					<p>ช็อป โก๊ะ สกรัม เบนโตะสหรัฐทัวร์นาเมนท์ มั้งซามูไรพาสปอร์ตภควัทคีตาดัมพ์ฟีเวอร์ สตาร์ โฟล์คเทคโนแครตซิ่งราเมน ซาฟารีท็อปบู๊ทมยุราภิรมย์คอนเซปต์ ดัมพ์โอเปร่า ยังไง.</p>
				</div>
			</div>
		</div>
	</div>
	<!--end small modal-->
	
	<!--Vertically centered modal-->
	<button class="btn btn-secondary" type="button" data-toggle="modal" data-target=".bd-example-modal-vc">Vertically centered</button>
	<div class="modal fade bd-example-modal-vc" tabindex="-1" role="dialog" aria-labelledby="myVCModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 id="mySmallModalLabel" class="modal-title">Modal title | ไตเติล</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam suscipit tincidunt iaculis. Phasellus hendrerit sem non dui commodo, vel iaculis nulla tincidunt.</p>
					<p>ช็อป โก๊ะ สกรัม เบนโตะสหรัฐทัวร์นาเมนท์ มั้งซามูไรพาสปอร์ตภควัทคีตาดัมพ์ฟีเวอร์ สตาร์ โฟล์คเทคโนแครตซิ่งราเมน ซาฟารีท็อปบู๊ทมยุราภิรมย์คอนเซปต์ ดัมพ์โอเปร่า ยังไง.</p>
				</div>
			</div>
		</div>
	</div>
	<!--end Vertically centered modal-->
	
	<!-- Full modal-->
	<button class="btn btn-secondary" type="button" data-toggle="modal" data-target=".bd-example-modal-full">Full centered</button>
	<div class="modal fade bd-example-modal-full modal-full" tabindex="-1" role="dialog" aria-labelledby="myFullModalLabel" aria-hidden="true">
		
		<button class="close custom-close" type="button" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<div class="modal-dialog modal-dialog-full" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 id="mySmallModalLabel" class="modal-title">Modal title | ไตเติล</h5> 
				</div>
				<div class="modal-body">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam suscipit tincidunt iaculis. Phasellus hendrerit sem non dui commodo, vel iaculis nulla tincidunt.</p>
					<p>ช็อป โก๊ะ สกรัม เบนโตะสหรัฐทัวร์นาเมนท์ มั้งซามูไรพาสปอร์ตภควัทคีตาดัมพ์ฟีเวอร์ สตาร์ โฟล์คเทคโนแครตซิ่งราเมน ซาฟารีท็อปบู๊ทมยุราภิรมย์คอนเซปต์ ดัมพ์โอเปร่า ยังไง.</p>
				</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
					<button class="btn btn-primary" type="button">Save changes</button>
				</div>
			</div>
		</div>
	</div>
	<!--end full modal-->
</div>