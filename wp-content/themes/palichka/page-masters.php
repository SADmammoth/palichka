<?php
/**
 * The template for displaying archive pages
 * Template name: Masters
 * Template Post Type: page
 * 
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package palichka
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
      <h1 class='h1-small background wide-toleft'>Галерея мастеров</h1>
      <section class='cards vertical-flex-block wide-toleft' style='min-height: 49vh'>
      <?php
      if ($_GET){
        $sort = isset($_GET['sort'])?$_GET['sort']: 'title';
        $invert = isset($_GET['invert'])?$_GET['invert']: 'ASC';
        
      }else{
        $sort = 'title';
        $invert = 'ASC';
      }

      if ($_POST){
        $sort = !empty($_POST['sort'])?$_POST['sort']: 'title';
        $invert = !empty($_POST['invert'])?$_POST['invert']: 'ASC';
        $tag = !empty($_POST['filter'])?$_POST['filter']: 'no_filter';
        $search=!empty($_POST['search'])?$_POST['search']: '';
      }else{
        $sort = 'title';
        $invert = 'ASC';
        $tag = 'no_filter';
        $search = '';
      }
      
     
      $my_query = new WP_Query(array(
        's' => $search,
        'show_post_count' => false,
        'post_type'     => 'masters',
        'tax_query' => $tag!== 'no_filter'?array(
          array(
            'taxonomy' => 'post_tag',
            'field' => 'slug',
            'terms' => $tag,
          ),
        ): '',
        'order' => $invert,
        'orderby' => $sort,
        ));
        
        if($my_query->found_posts){
        while ($my_query->have_posts()){
        $my_query->the_post();
        get_template_part( 'template-parts/masters-card');
        }
         }else
         {
           ?>
          <p class='additional-text container'>Мастера не найдены</p>
          <?php
         }
        
        ?>
      </section>
      <aside class='sidebar background insidelayout-fromright desktop'>
        <div class='options'>
          <form  id='sort-form' action='/wordpress/archive-masters' method='POST' id='search-form' class='option'>
            <label for='search'><i class="fas fa-search pictogram"></i></label>
            <input id='search' onchange='this.form.submit()' class='option-box' name='search' type='search' placeholder="Поиск" 
            value='<?php  echo !empty($_POST['search'])?$_POST['search']:'' ?>'
            />
          </form>
          <form id='sort-form' action='/wordpress/archive-masters' method='POST' class='option-box option dropdown'>
            <label for='sort'><i class="fas fa-sort-amount-up pictogram"></i>Сортировка</label>
            <input id='sort' class='common-dropdown dropdown-trigger pictogram' type='checkbox'>
            <ul class='option-dropdown-content dropdown-content vertical-flex-block'>
            <li class='vflex-item'>
                <input onclick='setTimeout(close_dropdown, 300, this); ' id='sort_invert' name='invert' value='DESC' type='radio'
                 <?php  echo !empty($_POST['invert'])?($_POST['invert']=='DESC'?'checked':''):'' ?>>
                <label for='sort_invert'>Интвертировать</label>
              </li>
              <li class='vflex-item'>
                <input onclick='setTimeout(close_dropdown, 300, this); ' id='sort_byname' name='sort' value='title' type='radio' 
                <?php echo !empty($_POST['sort'])?($_POST['sort']=='title'?'checked':''):'checked' ?>>
                <label for='sort_byname '>По имени</label>
              </li>
              <li class='vflex-item'>
          
                <input onclick='setTimeout(close_dropdown, 300, this); ' id='sort_bytime' name='sort' value='date' type='radio'
                 <?php echo !empty($_POST['sort'])?($_POST['sort']=='date'?'checked':''):'' ?>>
                <label for='sort_bytime '>По дате добавления</label>
              </li>
            </ul>
          </form>
          <form id='filter-form' action='/wordpress/archive-masters' method='POST' class='option-box option dropdown'>
            <label for='filter'><i class="fas fa-filter pictogram"></i>Фильтр</label>
            <input id='filter' class='common-dropdown dropdown-trigger pictogram' type='checkbox'>
            <div class='option-dropdown-content dropdown-content vertical-flex-block'>
              <li class='vflex-item'>
                <input onclick='setTimeout(close_dropdown, 300, this); ' id='no_filter' name='filter' value='no_filter' type='radio'
                <?php echo !empty($_POST['filter'])?($_POST['filter']=='no_filter'?'checked':''):'checked' ?>>
                <label for='no_filter '>Нет фильтра</label>

              </li>
              <?php
              $tags = get_terms('post_tag');
              foreach ($tags as $one_tag){
                ?>
                <li class='vflex-item'>
                <input onclick='setTimeout(close_dropdown, 300, this);' id='filter_<?php echo $one_tag->slug?>' name='filter' value='<?php echo $one_tag->slug ?>' type='radio'
                <?php echo !empty($_POST['filter'])?($_POST['filter']==$one_tag->slug?'checked':''):'' ?>>
                <label for='filter_<?php echo $one_tag->slug?>'><?php echo $one_tag->name?></label>
                </li>
                <?php
              }
              ?>
            </div>
          </form>
        </div>
        </div>
      </aside>

      <div class='dropdown floating-btn handheld dropdown-reverse'>
          <input class='burger-icon dropdown-trigger' type='checkbox'>
          <div class='burger-menu-left dropdown-content'>
              <a onclick='close_dropdown(this);' class='close-dropdown pictogram'><i class='fas fa-times'></i></a>
              <div class='options'>
                  <div class='option'>
                    <label for='search'><i class="fas fa-search pictogram"></i></label>
                    <input id='search' class='option-box' type='search' placeholder="Поиск" />
                  </div>
                  <div class='option-box option dropdown'>
                    <label for='sort'><i class="fas fa-sort-amount-up pictogram"></i>Сортировка</label>
                    <input id='sort' class='common-dropdown dropdown-trigger pictogram' type='checkbox'>
                    <ul class='option-dropdown-content dropdown-content vertical-flex-block'>
                      <li class='vflex-item'>
                        <input onclick='setTimeout(close_dropdown, 300, this); ' id='sort_byname' name='sort' value='sort_byname' type='radio' checked>
                        <label for='sort_byname '>По имени</label>
                      </li>
                      <li class='vflex-item'>
                        <input onclick='setTimeout(close_dropdown, 300, this); ' id='sort_bytime' name='sort' value='sort_bytime' type='radio'>
                        <label for='sort_bytime '>По дате добавления</label>
                      </li>
                    </ul>
                  </div>
                  <div class='option-box option dropdown'>
                    <label for='filter'><i class="fas fa-filter pictogram"></i>Фильтр</label>
                    <input id='filter' class='common-dropdown dropdown-trigger pictogram' type='checkbox'>
                    <div class='option-dropdown-content dropdown-content vertical-flex-block'>
                      <li class='vflex-item'>
                        <input onclick='setTimeout(close_dropdown, 300, this); ' id='no_filter ' name='filter ' value='no_filter ' type='radio' checked>
                        <label for='no_filter '>Нет фильтра</label>
        
                      </li>
                      <li class='vflex-item'>
                        <input onclick='setTimeout(close_dropdown, 300, this); ' id='sort_byname ' name='filter ' value='filter_bybest' type='radio'>
                        <label for='filter_bybest '>Только лучшие</label>
                      </li>
                    </div>
                  </div>
                </div>
                </div>
          </div>
        </div>
      </div>
    </main>
</div>
<?php
get_footer();
