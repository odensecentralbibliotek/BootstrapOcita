<?php

function BootstrapOcita_preprocess_html(&$vars) {
	$path = current_path();

	if (strpos($path, "event-created") !== FALSE) {
		drupal_add_css(path_to_theme().'/css/ocita_cal.css');
	}
	// Add font awesome cdn.
	drupal_add_css('//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css', array(
			'type' => 'external',
		));
	// add calendar CSS to reconfigure the style for calender
	drupal_add_css(path_to_theme().'/css/calendar_multiday.css');
drupal_add_css("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css");
drupal_add_js(path_to_theme().'/js/button.js');
drupal_add_js(path_to_theme().'/js/custom-order.js');
drupal_add_css(path_to_theme().'/css/megamenu.css');
}


function BootstrapOcita_css_alter(&$css) {
	$path = drupal_get_path('module', 'tb_megamenu');
	//unset($css[$path.'/css/default.css']);
	//unset($css[$path.'/css/base.css']);
	//unset($css[$path.'/css/compatibility.css']);
}


function BootstrapOcita_menu_link(array $variables) {
	$element  = $variables['element'];
	$sub_menu = '';

	if ($element['#below']) {
		if (($element['#original_link']['menu_name'] == 'management') && (module_exists('navbar'))) {
			$sub_menu = drupal_render($element['#below']);
		}
		//Here we need to change from ==1 to >=1 to allow for multilevel submenus
		 elseif ((!empty($element['#original_link']['depth'])) && ($element['#original_link']['depth'] >= 1)) {
			// Add our own wrapper.
			unset($element['#below']['#theme_wrappers']);
			$sub_menu = '<ul class="dropdown-menu">'.drupal_render($element['#below']).'</ul>';
			// Generate as standard dropdown.
			$element['#title'] .= ' <span class="fa fa-circle"></span>';//Smartmenus plugin add's caret
			$element['#attributes']['class'][]     = 'dropdown';
			$element['#localized_options']['html'] = TRUE;

			// Set dropdown trigger element to # to prevent inadvertant page loading
			// when a submenu link is clicked.
			$element['#localized_options']['attributes']['data-target'] = '#';
			$element['#localized_options']['attributes']['class'][]     = 'dropdown-toggle';
			//comment element bellow if you want your parent menu links to be "clickable"
			$element['#localized_options']['attributes']['data-toggle'] = 'dropdown';
		}
	}
	if (isset($element['#localized_options']['attributes']['class'])) {
		$array_class = $element['#localized_options']['attributes']['class'];
		foreach ($array_class as $i => $class) {
			if (substr($class, 0, 3) == 'fa-') {
				unset($element['#localized_options']['attributes']['class'][$i]);
				$icon = '<div class="'.$class.'"></div>';
			}
		}
	}
	$output = l($element['#title'], $element['#href'], $element['#localized_options']);
	if (!empty($icon)) {
		$output = substr_replace($output, $icon, -4, 0);
	}

	if (($element['#href'] == $_GET['q'] || ($element['#href'] == '<front>' && drupal_is_front_page())) && (empty($element['#localized_options']['language']))) {
		$element['#attributes']['class'][] = 'active';
	}
	return '<li'.drupal_attributes($element['#attributes']).'>'.$output.$sub_menu."</li>\n";
}
