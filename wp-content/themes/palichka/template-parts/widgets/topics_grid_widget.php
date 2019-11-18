<?php 
class TopicsGrid extends WP_Widget {
  public function __construct() {
    $widget_options = array( 
      'classname' => 'topics_grid',
      'description' => 'Избранные статьи из разделов'
    );
    parent::__construct( 'topics_grid', 'Группа разделов', $widget_options );
  }

  public function widget( $args, $instance ) {
    $title = apply_filters( 'widget_title', $instance[ 'title' ] );
    $topics =  get_theme_mod('topic_widgets');
    ?>
    <section id='<?php echo $this->id ?>' class='topics-section'>
      <div class='container'>
        <h2  class='h2'><?php echo $title ?></h2>
      </div>
      <div class='background'>
        <div class='container topics-grid'>
          <?php 
         
           foreach($topics as $topic){
            $terms = explode(',', $topic['topic']);
            if($topic['widget'] == $this->id){
            $args = array(
              'posts_per_page' => intval($topic['cards_count']),
              'format' => 'html',
              'show_post_count' => false,
              'echo'            => 1,
              'orderby' => 'date',
              'order' => 'DESC',
              
            );
           
            if($terms[0] !== 'false'){
              $args['post_type'] = $terms[0];
            } 
            if($terms[1] !== 'false'){
              $args['tax_query'] = array(
                array(
                    'taxonomy' => $terms[0].'_tag',
                    'field' => 'slug',
                    'terms' => $terms[1]
                )
                );
            }

              $my_query = new WP_Query($args);
              $card = $terms[0].'-card';
              switch($topic['layout']){
                case 'big-topic':
                ?>
                <div class='big-topic'>
                  <h3 class='h3'><?php echo $topic['title'] ?></h3>
                  <div class='cards vertical-flex-block'>
                  <?php   
                   while($my_query->have_posts()){
                    $my_query->the_post();
                    get_template_part('template-parts/'.$card);
                  }
                  ?>
                  <a href='<?php echo $topic['link'] ?>' class='link'>Далее</a>
                </div>
                </div>
                <?php
                break;
                case 'medium-topic':
                  ?>
                  <div class='medium-topic'>
                    <h3 class='h3'><?php echo $topic['title'] ?></h3>
                    <div class='cards vertical-flex-block'>
                    <?php 
                     while($my_query->have_posts()){
                      $my_query->the_post();
                      get_template_part('template-parts/'.$card);
                    }
                    ?>
                    <a href='<?php echo $topic['link'] ?>' class='link'>Далее</a>
                  </div>
                  </div>
                  <?php
                  break;
                case 'small-topic':
                  ?>
                  <div class='small-topic'>
                    <h3 class='h3'><?php echo $topic['title'] ?></h3>
                    <div class='cards horizontal-flex-block'>
                    <?php 
                     while($my_query->have_posts()){
                      $my_query->the_post();
                      get_template_part('template-parts/'.$card.'-min');
                    }
                    ?>
                      <a href='<?php echo $topic['link'] ?>' class='hflex-item pictogram'><i class="fas fa-chevron-right"></i></a>
                    </div>
                  </div>
                  <?php
                break;
              }
            }
           }
           ?>
        </div>
      </div>
    </section>
    <?php
  }

  public function form( $instance ) {
    $title = ! empty( $instance['title'] ) ? $instance['title'] : '';?>
    <div>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>">Заголовок:</label>
      <br/>
      <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
  </div>
  <div>  
    <p>Для редактирования виджетов разделов пройдите по пути: <br/><em>Все панели&gt;Настройки блоков&gt;Контент сайта&gt;Виджеты разделов</em></p>
  </div>
  <?php 
  }

  public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
   
    if($instance[ 'add' ]){
      echo  "<div class='repeater_one'>All</div>";
    }
    $instance[ 'add' ] = false;
    return $instance;
  }
}

function register_topics_widget() { 
  register_widget( 'TopicsGrid' );
}
add_action( 'widgets_init', 'register_topics_widget' );
?>