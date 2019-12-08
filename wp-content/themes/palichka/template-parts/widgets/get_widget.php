<?php
function get_widget($widget_id, $fields)
{
  $array = [];
  preg_match('/^(.*)-([0-9]+)$/', $widget_id, $widget_id_array);
  $widget = get_option('widget_' . $widget_id_array[1])[$widget_id_array[2]];
  foreach ($fields as $field) {
    if ($field === 'id_number') {
      $array['id_number'] = $widget_id_array[2];
    }
    if ($field === 'type_id') {
      $array['type_id'] = $widget_id_array[1];
    }
    $array[$field] = $widget[$field];
  }
  return $array;
}
?>
