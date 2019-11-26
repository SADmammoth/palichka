<?php header("Content-type: text/css; charset: UTF-8"); 
define('WP_USE_THEMES', false);

include('../../../../wp-load.php');
/* CSS variables, representing basic theme parameters.
   Change it to customize site layout */
   
   

$image= get_theme_mod('pick_main_picture');
$dark_background= get_theme_mod('dark_background');
$background= get_theme_mod('background');
$light_background= get_theme_mod('light_background');
$buttons_color= get_theme_mod('buttons_color');
$buttons_hover= get_theme_mod('buttons_hover');
$shadow_color= get_theme_mod('shadow');
$shadow_opacity= dechex(get_theme_mod('shadow_opacity')*255/100);
$primary_text_color= get_theme_mod('primary_text_color');
$secondary_text_color= get_theme_mod('secondary_text_color');
$common_text_color= get_theme_mod('common_text_color');

?>
:root {
    /*Backgrounds and shadows*/
    --main-image: url('<?php echo $image ?>');
    --dark-background: <?php echo $dark_background; ?>;
    --background: <?php echo $background; ?>;
    --light-background: <?php echo $light_background; ?>;
    --buttons-color: <?php echo $buttons_color; ?>;
    --buttons-hover: <?php echo $buttons_hover; ?>;
    --shadow-color: <?php echo $shadow_color; ?><?php echo $shadow_opacity; ?>;
    --shadow: 2px 2px 4px var(--shadow-color);
    --error-bg: #ff8269c4;
    --error-color: #802d18;
    /*Typography*/
    --font: 'Roboto', sans-serif;
    --primary-text-color: <?php echo $primary_text_color; ?>;
    --secondary-text-color: <?php echo $secondary_text_color; ?>;
    --common-text-color: <?php echo $common_text_color; ?>;
    /*Minor UI elements*/
    --divider: 2px solid var(--primary-text-color);
}
<?php
?>

