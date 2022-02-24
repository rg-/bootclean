<?php

/*
	
	EX

	$args = array(
		'theme_location' => 'primary'
	);
	$menu = new WPBC_Bootstrap_Nav_Menu($args); 
	$menu->showMenu();


*/
class WPBC_Bootstrap_Nav_Menu
{
    private $args = [
    		'menu' => '',
        'theme_location' => '',
        'container' => 'div',
        'container_class' => '',
        'menu_id' => '',
        'menu_class' => '',
        'add_li_class' => '',
        'link_class' => '',
        'submenu_css_class' => '',
    ];

    public function __construct()
    {
        add_filter( 'nav_menu_css_class', [$this,'add_additional_class_on_li'], 1, 3);
        add_filter( 'nav_menu_link_attributes', [$this,'add_menu_link_class'], 1, 3);
        add_filter( 'nav_menu_submenu_css_class', [$this,'add_submenu_class'], 1, 3);

        $this->args['menu'] = !empty($args['menu']) ? $args['menu'] : '';
        $this->args['theme_location'] = !empty($args['theme_location']) ? $args['theme_location'] : ''; 
    }

    public function wrapWithTag($tagName){
        $this->args['container'] = $tagName;
        return $this;
    }

    public function setMenuID($id)
    {
        $this->args['menu_id'] = $id;
        return $this;
    }

    public function setMenu($menu)
    {
        $this->args['menu'] = $menu;
        return $this;
    }

		public function setContainerClass($class)
    {
        $this->args['container_class'] = $class;
        return $this;
    }

    public function setMenuClass($class)
    {
        $this->args['menu_class'] = $class;
        return $this;
    }

    public function setListClass($class)
    {
        $this->args['add_li_class'] = $class;
        return $this;
    }
    public function setLinkClass($class)
    {
        $this->args['link_class'] = $class;
        return $this;
    }

    public function setSubMenuClass($class)
    {
        $this->args['submenu_css_class'] = $class;
        return $this;
    }

    public function showMenu()
    {
        return wp_nav_menu($this->args);
    }

    function add_submenu_class($classes, $args, $depth) {
        if(isset($args->submenu_css_class)) {
            $classes[] = $args->submenu_css_class;
        }
        return $classes;
    }
    function add_additional_class_on_li($classes, $item, $args) {
        if(isset($args->add_li_class)) {
            $classes[] = $args->add_li_class;
        }
        return $classes;
    }

    function add_menu_link_class( $atts, $item, $args ) {
        if (property_exists($args, 'link_class')) {
            $atts['class'] = $args->link_class;
        }
        return $atts;
    }
}