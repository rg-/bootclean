<?php 
// TODO, classes and so on for $item['dropdown']['expanded'] 
if( isset($params) ){
	if( isset($params['items']) && !isset($params['items_html']) ){
		$items = $params['items'];
		$item_count = 0;
		foreach($items as $item){
			$dropdown = '';
			$class = '';
			$a_class = '';			
			$data = ''; 
			$megamenu = false;
			$show = false;
			
			$id = isset( $item['id'] ) ? $item['id'] : 'nav-item-'.$item_count.'';
			
			if( isset( $item['dropdown']['items'] ) || isset($item['dropdown']['items_html']) ){
				$dropdown_HTML = '';
				$class = 'dropdown';
				$a_class = 'dropdown-toggle';
				 
				$hover = isset( $item['dropdown']['hover'] ) ? $item['dropdown']['hover'] : false;
				$hover_respond = isset( $item['dropdown']['hover-respond'] ) ? 'data-hover-respond="'.$item['dropdown']['hover-respond'].'"' : '';
				$animated =  isset( $item['dropdown']['animated'] ) ? 'animated '.$item['dropdown']['animated'] : '';
				$animated_respond =  isset( $item['dropdown']['animated-respond'] ) ? 'data-animated-respond="'.$item['dropdown']['animated-respond'].'"' : '';
				
				$megamenu = isset( $item['dropdown']['megamenu'] ) ? $item['dropdown']['megamenu'] : false;
				$class = $megamenu ? 'megamenu '.$class : $class;
				$show = isset( $item['dropdown']['show'] ) ? $item['dropdown']['show'] : false;
				$class = $show ? 'show '.$class : $class;
				
				$data = 'data-toggle="dropdown" aria-haspopup="true" aria-expanded="'. ( $show ? 'true' : 'false' ) .'"'; 
				
				if($hover){
					$data .= ' data-hover="dropdown" '.$hover_respond.' ';
				}  
				if( isset($item['dropdown']['items']) && !isset($item['dropdown']['items_html']) ){
					$items = $item['dropdown']['items'];
					foreach($items as $subitem){ 
						if(isset($subitem['href'])){
							$dropdown_HTML .= '<a class="dropdown-item" href="'.$subitem['href'].'">'.$subitem['text'].'</a>';
						}else{
							$dropdown_HTML .= '<span class="dropdown-item-text">'.$subitem['text'].'</span>';
						}
					}
				}
				if( isset($item['dropdown']['items_html']) ){
					$dropdown_HTML = $item['dropdown']['items_html'];
				}
				
				$dropdown_class = isset( $item['dropdown']['class'] ) ? $item['dropdown']['class'] : 'dropdown-menu';
				$dropdown_class = $megamenu ? 'dropdown-megamenu-menu '.$dropdown_class : $dropdown_class;
				$dropdown_class = $show ? 'show '.$dropdown_class : $dropdown_class;
				$dropdown = '<div class="'.$dropdown_class.' '.$animated.'" '.$animated_respond.'>';
				$dropdown .= $dropdown_HTML; 
				$dropdown .= '</div>'; 
			}
			if(isset($item['href'])){ 
				?><li id="<?php echo $id; ?>" class="nav-item <?php echo $class; ?>"><a class="nav-link <?php echo $a_class; ?>" href="<?php echo $item['href']; ?>" <?php echo $data; ?>><?php echo $item['text']; ?></a><?php echo $dropdown; ?></li><?php
			}else{
				?>
				<li class="nav-item"><span id="<?php echo $id; ?>" class="nav-item-text <?php echo $class; ?>"><?php echo $item['text']; ?></span></li>
				<?php
			} 
			$item_count++;
		}
	}
	if( isset($params['items_html']) ){
		?>
		<?php echo $params['items_html']; ?>
		<?php
	}
}

?>