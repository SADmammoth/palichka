<?php 
class ArticleGrid extends WP_Widget {
  public function __construct() {
    $widget_options = array( 
      'classname' => 'article_grid',
      'description' => 'Группа статей с описанием и кнопкой'
    );
    parent::__construct( 'article_grid', 'Группа статей', $widget_options );
  }

  public function widget( $args, $instance ) {
    $title = apply_filters( 'widget_title', $instance[ 'title' ] );
    $desc = $instance[ 'desc' ];
    $number = $instance[ 'number' ];
    $topic = $instance['topic'];
    $tag = $instance['tag'];
    $link = $instance['link'];
    $button = $instance['button'];
    $card_name = $topic.'-card';
    ?>
    <section id='<?php echo $this->id ?>' class='articles-grid'>
    <h2 class='h2 title insidelayout-fromleft'><?php echo $title?></h2>
    <p class='description hyphenated wide-toright'><?php echo $desc?></p>
    <div class='articles background vertical-flex-block wide-toleft'>
      <?php
      global $post;
      if(!$tag){
        $args = array( 'post_type'=> $topic);
      }
      else {
        $args = array( 'post_type'=> $topic, 'post_tag' => $tag);
      }
      
      $myposts = get_posts( $args );
      $count = $number;
      foreach ( $myposts as $post ) : 
        if($count === 0){
          break;
        }
        setup_postdata( $post );
        get_template_part('template-parts/'. $card_name);
        $count--;
      endforeach; 
      wp_reset_postdata();?>
    </div>
    <a href='<?php echo $link ?>' class='button'><?php echo $button ?></a>
    </section>
    <?php
  }

  public function form( $instance ) {
    $title = ! empty( $instance['title'] ) ? $instance['title'] : '';
    $topic = ! empty( $instance['topic'] ) ? $instance['topic'] : ''; 
    $tag = ! empty( $instance['tag'] ) ? $instance['tag'] : '';
    $link = ! empty( $instance['link'] ) ? $instance['link'] : '';
    $desc = ! empty( $instance['desc'] ) ? $instance['desc'] : ''; 
    $number = ! empty( $instance['number'] ) ? $instance['number'] : '';
    $button = ! empty( $instance['button'] ) ? $instance['button'] : ''; 

    ?>
    <div>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>">Заголовок:</label>
      <br/>
      <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
  </div>
  <div>  
    <label for="<?php echo $this->get_field_id( 'topic' ); ?>">Раздел статей:</label>
    <br/>
    <select id="<?php echo $this->get_field_id( 'topic' ); ?>" name="<?php echo $this->get_field_name( 'topic' ); ?>" value="<?php echo esc_attr( $topic ); ?>">
    <?php 
      $categories = get_post_types(['public'=>true], 'objects');
      foreach ($categories as $cat){
        ?><option <?php echo ($topic == $cat->name)?'selected':''; ?> value='<?php echo $cat->name?>'><?php echo $cat->label?></option><?php
      }
    ?>
    </select>
  </div>
  <div>  
    <label for="<?php echo $this->get_field_id( 'tag' ); ?>">Теги статей:</label>
    <br/>
    <select id="<?php echo $this->get_field_id( 'tag' ); ?>" name="<?php echo $this->get_field_name( 'tag' ); ?>" value="<?php echo esc_attr( $tag ); ?>">
    <?php
      echo "<option value=false>Все</option>";
      $tags = get_terms('post_tag');
      foreach ($tags as $one_tag){
        ?><option <?php echo ($tag == $one_tag->slug)?'selected':''; ?> value='<?php echo $one_tag->slug?>'><?php echo $one_tag->name?></option><?php
      }
    ?>
    </select>
  </div>
  <div>  
    <label for="<?php echo $this->get_field_id( 'desc' ); ?>">Описание:</label>
    <br/>
    <textarea id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>" style='resize: vertical; width: 100%;'><?php echo esc_attr( $desc ); ?></textarea>
  </div>
    <div>  
    <label for="<?php echo $this->get_field_id( 'number' ); ?>">Число:</label>
    <br/>
    <input type="number" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo esc_attr( $number ); ?>" />
  </div>
  <div>  
    <label for="<?php echo $this->get_field_id( 'button' ); ?>">Текст кнопки:</label>
    <br/>
    <input type="text" id="<?php echo $this->get_field_id( 'button' ); ?>" name="<?php echo $this->get_field_name( 'button' ); ?>" value="<?php echo esc_attr( $button ); ?>" />
  </div>
  <div>  
    <label for="<?php echo $this->get_field_id( 'link' ); ?>">Ссылка кнопки:</label>
    <br/>
    <select id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" value="<?php echo esc_attr( $link ); ?>">
    <?php
      echo print_r(get_pages());
      $links = get_pages();
    
      foreach ($links as $one_link){
        ?><option <?php echo ($link == $one_link->guid)?'selected':''; ?> value='<?php echo $one_link->guid?>'><?php echo $one_link->post_title?></option><?php
      }
    ?>
    </select>
  </div>
  <?php 
  }

  public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
    $instance[ 'desc' ] = strip_tags( $new_instance[ 'desc' ] );
    $instance[ 'topic' ] = strip_tags( $new_instance[ 'topic' ] );
    $instance[ 'tag' ] = strip_tags( $new_instance[ 'tag' ] );
    $instance[ 'link' ] = strip_tags( $new_instance[ 'link' ] );
    $instance[ 'number' ] = strip_tags( $new_instance[ 'number' ] );
    $instance[ 'button' ] = strip_tags( $new_instance[ 'button' ] );
    return $instance;
  }
}

function register_article_widget() { 
  register_widget( 'ArticleGrid' );
}
add_action( 'widgets_init', 'register_article_widget' );
?>