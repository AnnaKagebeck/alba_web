<?php
$functions_path = TEMPLATEPATH . '/functions/';
$includes_path = TEMPLATEPATH . '/includes/';

//Redirect admin to theme option upon activated
require_once $functions_path . 'admin-setup.php';

//Theme Options
require_once $functions_path . 'admin-options.php';

//Theme init
require_once $includes_path . 'theme-init.php';

//Widget and Sidebar
require_once $includes_path . 'sidebar-init.php';

require_once $includes_path . 'register-widgets.php';

//Additional function
require_once $includes_path . 'theme-function.php';

//Additional function
require_once $includes_path . 'shortcode.php';

//Loading jQuery
require_once $includes_path . 'theme-scripts.php';

?>