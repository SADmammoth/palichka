<?php
class MessageGrid extends WP_Widget
{
  public function __construct()
  {
    $widget_options = array(
      'classname' => 'message',
      'description' => 'Блок, содержащий выделенный загловок, текст и кнопку действия'
    );
    parent::__construct('message', 'Сообщение', $widget_options);
  }

  public function widget($args, $instance)
  {
    $title = apply_filters('widget_title', $instance['title']);
    $subtitle = $instance['subtitle'];
    $desc = $instance['desc'];
    $button = $instance['button'];
    $link = $instance['link'];
    ?>
     <section id='<?php echo $this->id; ?>' class='message-grid'>
      <h2 class='h2 message-title wide-toleft'><?php echo $title; ?>
        <br/>
        <span class='subtitle'><?php echo $subtitle; ?></span></h2>
      <a href='#' class='button'><?php echo $button; ?></a>
      <p class='description hyphenated wide-toleft'><?php echo $desc; ?></p>
    </section>
    <?php
  }

  public function form($instance)
  {
    $title = !empty($instance['title']) ? $instance['title'] : '';
    $subtitle = !empty($instance['subtitle']) ? $instance['subtitle'] : '';
    $desc = !empty($instance['desc']) ? $instance['desc'] : '';
    $button = !empty($instance['button']) ? $instance['button'] : '';
    $link = !empty($instance['link']) ? $instance['link'] : '';
    ?>
    <div>
      <label for="<?php echo $this->get_field_id('title'); ?>">Заголовок:</label>
      <br/>
      <input type="text" id="<?php echo $this->get_field_id(
        'title'
      ); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($title); ?>" />
  </div>
  <div>
      <label for="<?php echo $this->get_field_id('subtitle'); ?>">Подзаголовок:</label>
      <br/>
      <input type="text" id="<?php echo $this->get_field_id(
        'subtitle'
      ); ?>" name="<?php echo $this->get_field_name('subtitle'); ?>" value="<?php echo esc_attr($subtitle); ?>" />
  </div>
  <div>  
    <label for="<?php echo $this->get_field_id('desc'); ?>">Текст:</label>
    <br/>
    <textarea id="<?php echo $this->get_field_id(
      'desc'
    ); ?>" name="<?php echo $this->get_field_name('desc'); ?>" style='resize: vertical; width: 100%;'><?php echo esc_attr($desc); ?></textarea>
  </div>
  <div>  
    <label for="<?php echo $this->get_field_id('button'); ?>">Текст кнопки:</label>
    <br/>
    <input type="text" id="<?php echo $this->get_field_id(
      'button'
    ); ?>" name="<?php echo $this->get_field_name('button'); ?>" value="<?php echo esc_attr($button); ?>" />
  </div>
  <div>  
    <label for="<?php echo $this->get_field_id('link'); ?>">Ссылка кнопки:</label>
    <br/>
    <select id="<?php echo $this->get_field_id(
      'link'
    ); ?>" name="<?php echo $this->get_field_name('link'); ?>" value="<?php echo esc_attr($link); ?>">
    <?php
    echo print_r(get_pages());
    $links = get_pages();

    foreach ($links as $one_link) { ?><option <?php echo $link == $one_link->guid
  ? 'selected'
  : ''; ?> value='<?php echo $one_link->guid; ?>'><?php echo $one_link->post_title; ?></option><?php }?>
    </select>
  </div>
  <?php
  }

  public function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['subtitle'] = strip_tags($new_instance['subtitle']);
    $instance['desc'] = strip_tags($new_instance['desc']);
    $instance['button'] = strip_tags($new_instance['button']);
    $instance['link'] = strip_tags($new_instance['link']);
    return $instance;
  }
}

function register_message_widget()
{
  register_widget('MessageGrid');
}
add_action('widgets_init', 'register_message_widget');
?>
