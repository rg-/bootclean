<h2>Simple alerts</h2>
<div class="example-block">
	<?php
	if(isset($theme_root['scheme'])){ 
		$partials = $theme_root['scheme'];
		foreach($partials as $p){
			BC_get_partial('alert', array(
				'html'=> 'Lorem ipsum dolor sit amet <b>'.$p.'</b>, consectetur adipiscing elit <a href="#" class="alert-link">alert link</a>.',
				//'dismiss'=>true,
				'context'=>$p
			));
		}
	}
	?>
</div>

<h2>Dismissable alerts</h2>
<div class="example-block">
	<?php
	if(isset($theme_root['scheme'])){ 
		$partials = $theme_root['scheme'];
		foreach($partials as $p){
			BC_get_partial('alert', array(
				'html'=> '<b>'.$p.'!!!</b> Lorem ipsum dolor sit amet, consectetur adipiscing elit <a href="#" class="alert-link">Go now?</a>.',
				'dismiss'=>true,
				'context'=>$p
			));
		}
	}
	?>
</div>


<h3>Additional content</h3>
<div class="example-block">
	<div class="alert alert-success" role="alert">
		<h4 class="alert-heading">Well done!</h4>
		<p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
		<p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
	</div>
	<div class="alert alert-success" role="alert">
		<h4 class="alert-heading">สุกี้ปารุสก์ คอมไพเลอร์!</h4>
		<p>โมเด็มโดเมนลอสแองเจลิสโฟลเดอร์ศรีษะ กำมือโอริยาโกลกาตา นงลักษณ์โรมาเนีย มาดริด ทนงแช็ตศรีษะทัชแพด. กีวีคลีนิคยูไลพากษ์ กงเต็กกันยายนกบิลพัสดุ์โพรเซสโพรโทคอล.</p>
		<p class="mb-0">แปซิฟิกอัพโหลดมือถืออินเดีย บราวเซอร์ คัตเอาต์ เตลุคูคอมไพเลอร์ แฮ็กเกอร์จ็อบส์อัสสัม.</p>
	</div>
</div>