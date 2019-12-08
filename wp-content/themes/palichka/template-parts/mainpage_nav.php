<?php
function mainpage_nav()
{
  $array = [];
  $widget_ids = wp_get_sidebars_widgets()['main-content'];
  foreach ($widget_ids as $i => $widget_id) {
    $array[$i] = array(
      'link' => '#' . $widget_id,
      'link_text' => esc_html__(get_widget($widget_id, ['title'])['title'], 'palichka'),
      'hidden' => true
    );
  }
  return $array;
}
?>
