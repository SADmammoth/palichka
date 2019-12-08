<?php
class ArticleGrid extends WP_Widget
{
  public function __construct()
  {
    $widget_options = array(
      'classname' => 'article_grid',
      'description' => 'Группа статей с описанием и кнопкой'
    );
    parent::__construct('article_grid', 'Группа статей', $widget_options);
  }

  public function widget($args, $instance)
  {
    $title = apply_filters('widget_title', $instance['title']);
    $desc = $instance['desc'];
    $number = $instance['number'];
    $topic = explode(',', $instance['topic'])[0];
    $tag = explode(',', $instance['topic'])[1];
    $link = $instance['link'];
    $button = $instance['button'];
    $card_name = $topic . '-card';
    ?>
    <section id='<?php echo $this->id; ?>' class='articles-grid'>
    <h2 class='h2 title insidelayout-fromleft'><?php echo $title; ?></h2>
    <p class='description hyphenated wide-toright'><?php echo $desc; ?></p>
    <div class='articles background vertical-flex-block wide-toleft'>
      <?php
      $args = array(
        'posts_per_page' => intval($number),
        'format' => 'html',
        'show_post_count' => false,
        'echo' => 1,
        'orderby' => 'date',
        'order' => 'DESC'
      );
      if ($topic !== 'false') {
        $args['post_type'] = $topic;
      }
      if ($tag !== 'false') {
        $args['tax_query'] = array(
          array(
            'taxonomy' => $topic . '_tag',
            'field' => 'slug',
            'terms' => $tag
          )
        );
      }
      $my_query = new WP_Query($args);
      if ($my_query->have_posts()) {
        while ($my_query->have_posts()) {
          $my_query->the_post();
          get_template_part('template-parts/' . $card_name);
        }
      } else {
        echo '<h3 style="width: 30vw">' . get_post_type_object($topic)->labels->not_found . '</h3>';
      }
      ?>
    </div>
    <a href='<?php echo $link; ?>' class='button'><?php echo $button; ?></a>
    </section>
    <?php
  }

  public function form($instance)
  {
    $title = !empty($instance['title']) ? $instance['title'] : '';
    $topic = !empty($instance['topic']) ? $instance['topic'] : ',';
    $link = !empty($instance['link']) ? $instance['link'] : '';
    $desc = !empty($instance['desc']) ? $instance['desc'] : '';
    $number = !empty($instance['number']) ? $instance['number'] : '';
    $button = !empty($instance['button']) ? $instance['button'] : '';
    ?>
    <div>
      <label for="<?php echo $this->get_field_id('title'); ?>">Заголовок:</label>
      <br/>
      <input type="text" id="<?php echo $this->get_field_id(
        'title'
      ); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($title); ?>" />
  </div>
  <div>  
    <label for="<?php echo $this->get_field_id('topic'); ?>">Раздел статей:</label>
    <br/>
    <select id="<?php echo $this->get_field_id(
      'topic'
    ); ?>" name="<?php echo $this->get_field_name('topic'); ?>" value="<?php echo esc_attr($topic); ?>">
    <?php $categories = get_post_types(['public' => true], 'objects'); ?>
        <option <?php echo explode(',', $topic)[0] == 'false' && explode(',', $topic)[1] == 'false'
          ? 'selected'
          : ''; ?> value='<?php echo 'false,false'; ?>'><?php echo 'Все разделы, Все теги'; ?></option><?php foreach (
  $categories
  as $cat
) {
  $tags = get_terms([
    'taxonomy' => $cat->name . '_tag',
    'hide_empty' => false
  ]); ?>   <option <?php echo explode(',', $topic)[0] == $cat->name &&
   explode(',', $topic)[1] == 'false'
     ? 'selected'
     : ''; ?> value='<?php echo $cat->name . ',false'; ?>'><?php echo $cat->label .
  ', Все теги'; ?></option><?php
echo print_r($tags);
foreach ($tags as $one_tag) { ?>
          <option <?php echo explode(',', $topic)[0] == $cat->name &&
          explode(',', $topic)[1] == $one_tag->slug
            ? 'selected'
            : ''; ?> value='<?php echo $cat->name .
   ',' .
   $one_tag->slug; ?>'><?php echo $cat->label . ', тег: ' . $one_tag->name; ?></option><?php }

} ?>
    </select>
  </div>
  
  <div>  
    <label for="<?php echo $this->get_field_id('desc'); ?>">Описание:</label>
    <br/>
    <textarea id="<?php echo $this->get_field_id(
      'desc'
    ); ?>" name="<?php echo $this->get_field_name('desc'); ?>" style='resize: vertical; width: 100%;'><?php echo esc_attr($desc); ?></textarea>
  </div>
    <div>  
    <label for="<?php echo $this->get_field_id('number'); ?>">Число:</label>
    <br/>
    <input type="number" id="<?php echo $this->get_field_id(
      'number'
    ); ?>" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo esc_attr($number); ?>" />
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
    $instance['desc'] = strip_tags($new_instance['desc']);
    $instance['topic'] = strip_tags($new_instance['topic']);
    $instance['link'] = strip_tags($new_instance['link']);
    $instance['number'] = strip_tags($new_instance['number']);
    $instance['button'] = strip_tags($new_instance['button']);
    return $instance;
  }
}

function register_article_widget()
{
  register_widget('ArticleGrid');
}
add_action('widgets_init', 'register_article_widget');
?>
