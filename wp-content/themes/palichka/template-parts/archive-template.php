<?php
/**
 * Template name: Блог
 * Template Post Type: page
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package palichka
 */

function template_part($template_name, $part_name = null)
{
  ob_start();
  get_template_part($template_name, $part_name);
  $var = ob_get_contents();
  ob_end_clean();
  return $var;
}

function get_the_archive_template($post_type)
{
  $return_array = [];
  if ($_GET) {
    $sortby = isset($_GET['sortby']) ? $_GET['sortby'] : 'title';
    $order = isset($_GET['order']) ? $_GET['order'] : 'ASC';
  } else {
    $sortby = 'title';
    $order = 'ASC';
  }

  if ($_GET) {
    $sortby = !empty($_GET['sortby']) ? $_GET['sortby'] : 'title';
    $order = !empty($_GET['order']) ? $_GET['order'] : 'ASC';
    $tag = !empty($_GET['filter']) ? $_GET['filter'] : 'no_filter';
    $search = !empty($_GET['search']) ? $_GET['search'] : '';
  } else {
    $sortby = 'title';
    $order = 'ASC';
    $tag = 'no_filter';
    $search = '';
  }

  $my_query = new WP_Query(array(
    's' => $search,
    'show_post_count' => false,
    'post_type' => $post_type,
    'tax_query' =>
      $tag !== 'no_filter'
        ? array(
          array(
            'taxonomy' => $post_type . '_tag',
            'field' => 'slug',
            'terms' => $tag
          )
        )
        : '',
    'order' => $order,
    'orderby' => $sortby
  ));

  $arr = [];
  if ($my_query->found_posts) {
    while ($my_query->have_posts()) {
      $my_query->the_post();
      array_push($arr, template_part('template-parts/' . $post_type . '-card'));
    }
  } else {
    array_push(
      $arr,
      "<p class='additional-text container'>" .
        get_post_types(['name' => $post_type], 'objects')[$post_type]->labels->not_found .
        "</p>"
    );
  }
  ob_start();
  ?><aside class='sidebar background insidelayout-fromright desktop'>
         <div class='options'>
           <form  id='search-form' action='' method='GET' id='search-form' class='option'>
             <label for='search'><i class='fas fa-search pictogram'></i></label>
             <input id='search' onchange='this.form.submit()' class='option-box' name='search' type='search' placeholder='Поиск'
             value='<?php echo !empty($_GET['search']) ? $_GET['search'] : ''; ?>'
             />
           </form>
           <form id='sortby-form' action='' method='GET' class='option-box option dropdown'>
             <label for='sortby'><i class='fas fa-sort-amount-up pictogram'></i>Сортировка</label>
             <input id='sortby' class='common-dropdown dropdown-trigger pictogram' type='checkbox'>
             <ul class='option-dropdown-content dropdown-content vertical-flex-block'>
           
               <li class='vflex-item'>
                 <input onclick='setTimeout(close_dropdown, 300, this); ' id='sort_byname' name='sortby' value='title' type='radio' 
                 <?php echo !empty($_GET['sortby'])
                   ? ($_GET['sortby'] == 'title'
                     ? 'checked'
                     : '')
                   : 'checked'; ?>>
                 <label for='sort_byname '>По имени</label>
               </li>
               <li class='vflex-item'>
           
                 <input onclick='setTimeout(close_dropdown, 300, this); ' id='sort_bytime' name='sortby' value='date' type='radio'
                  <?php echo !empty($_GET['sortby'])
                    ? ($_GET['sortby'] == 'date'
                      ? 'checked'
                      : '')
                    : ''; ?>>
                 <label for='sort_bytime '>По дате добавления</label>
               </li>
               <hr class='divider vflex-item'></hr>
               <li class='vflex-item'>
                 <input onclick='setTimeout((input)=>{close_dropdown(input); input.form.submit()}, 300, this); ' id='sort_order' name='order' value='DESC' type='checkbox'
                  <?php echo !empty($_GET['order'])
                    ? ($_GET['order'] == 'DESC'
                      ? 'checked'
                      : '')
                    : ''; ?>>
                 <label for='sort_order'>Интвертировать</label>
               </li>
             </ul>
           </form>
           <?php
           $tags = get_terms($post_type . '_tag');
           if (!is_wp_error($tags) && count($tags) > 0): ?>
           <form id='filter-form' action='' method='GET' class='option-box option dropdown'>
             <label for='filter'><i class='fas fa-filter pictogram'></i>Фильтр</label>
             <input id='filter' class='common-dropdown dropdown-trigger pictogram' type='checkbox'>
             <div class='option-dropdown-content dropdown-content vertical-flex-block'>
               <li class='vflex-item'>
                 <input onclick='setTimeout(close_dropdown, 300, this); ' id='no_filter' name='filter' value='no_filter' type='radio'
                 <?php echo !empty($_GET['filter'])
                   ? ($_GET['filter'] == 'no_filter'
                     ? 'checked'
                     : '')
                   : 'checked'; ?>>
                 <label for='no_filter '>Нет фильтра</label>
 
               </li>
                 <?php foreach ($tags as $one_tag) { ?>
                 <li class='vflex-item'>
                 <input onclick='setTimeout(close_dropdown, 300, this);' id='filter_<?php echo $one_tag->slug; ?>' name='filter' value='<?php echo $one_tag->slug; ?>' type='radio'
                 <?php echo !empty($_GET['filter'])
                   ? ($_GET['filter'] == $one_tag->slug
                     ? 'checked'
                     : '')
                   : ''; ?>>
                 <label for='filter_<?php echo $one_tag->slug; ?>'><?php echo $one_tag->name; ?></label>
                 </li>
                 <?php } ?>
             </div>
           </form>
                 <?php endif;
           ?>
         </div>
         </div>
       </aside>
 
       <div class='dropdown floating-btn handheld dropdown-reverse'>
           <input class='burger-icon dropdown-trigger' type='checkbox'>
           <div class='burger-menu-left dropdown-content'>
               <a onclick='close_dropdown(this, false, false);' class='close-dropdown pictogram'><i class='fas fa-times'></i></a>
               <div class='options'>
           <form  id='search-form' action='' method='GET' id='search-form' class='option'>
             <label for='search'><i class='fas fa-search pictogram'></i></label>
             <input id='search' onchange='this.form.submit()' class='option-box' name='search' type='search' placeholder='Поиск'
             value='<?php echo !empty($_GET['search']) ? $_GET['search'] : ''; ?>'
             />
           </form>
           <form id='sortby-form' action='' method='GET' class='option-box option dropdown'>
             <label for='sortby'><i class='fas fa-sort-amount-up pictogram'></i>Сортировка</label>
             <input id='sortby' class='common-dropdown dropdown-trigger pictogram' type='checkbox'>
             <ul class='option-dropdown-content dropdown-content vertical-flex-block'>
           
               <li class='vflex-item'>
                 <input onclick='setTimeout(close_dropdown, 300, this); ' id='sort_byname' name='sortby' value='title' type='radio' 
                 <?php echo !empty($_GET['sortby'])
                   ? ($_GET['sortby'] == 'title'
                     ? 'checked'
                     : '')
                   : 'checked'; ?>>
                 <label for='sort_byname '>По имени</label>
               </li>
               <li class='vflex-item'>
           
                 <input onclick='setTimeout(close_dropdown, 300, this); ' id='sort_bytime' name='sortby' value='date' type='radio'
                  <?php echo !empty($_GET['sortby'])
                    ? ($_GET['sortby'] == 'date'
                      ? 'checked'
                      : '')
                    : ''; ?>>
                 <label for='sort_bytime '>По дате добавления</label>
               </li>
               <hr class='divider vflex-item'></hr>
               <li class='vflex-item'>
                 <input onclick='setTimeout((input)=>{close_dropdown(input); input.form.submit()}, 300, this); ' id='sort_order' name='order' value='DESC' type='checkbox'
                  <?php echo !empty($_GET['order'])
                    ? ($_GET['order'] == 'DESC'
                      ? 'checked'
                      : '')
                    : ''; ?>>
                 <label for='sort_order'>Интвертировать</label>
               </li>
             </ul>
           </form>
           <?php
           $tags = get_terms($post_type . '_tag');
           if (!is_wp_error($tags) && count($tags) > 0): ?>
           <form id='filter-form' action='' method='GET' class='option-box option dropdown'>
             <label for='filter'><i class='fas fa-filter pictogram'></i>Фильтр</label>
             <input id='filter' class='common-dropdown dropdown-trigger pictogram' type='checkbox'>
             <div class='option-dropdown-content dropdown-content vertical-flex-block'>
               <li class='vflex-item'>
                 <input onclick='setTimeout(close_dropdown, 300, this); ' id='no_filter' name='filter' value='no_filter' type='radio'
                 <?php echo !empty($_GET['filter'])
                   ? ($_GET['filter'] == 'no_filter'
                     ? 'checked'
                     : '')
                   : 'checked'; ?>>
                 <label for='no_filter '>Нет фильтра</label>
 
               </li>
                 <?php foreach ($tags as $one_tag) { ?>
                 <li class='vflex-item'>
                 <input onclick='setTimeout(close_dropdown, 300, this);' id='filter_<?php echo $one_tag->slug; ?>' name='filter' value='<?php echo $one_tag->slug; ?>' type='radio'
                 <?php echo !empty($_GET['filter'])
                   ? ($_GET['filter'] == $one_tag->slug
                     ? 'checked'
                     : '')
                   : ''; ?>>
                 <label for='filter_<?php echo $one_tag->slug; ?>'><?php echo $one_tag->name; ?></label>
                 </li>
                 <?php } ?>
             </div>
           </form>
                 <?php endif;
           ?>
         </div>
                 </div>
                 </div>
           </div>
         </div>
       </div>
       <?php
       $sidebar = ob_get_contents();
       ob_end_clean();
       $return_array = ['cards' => join('', $arr), 'sidebar' => $sidebar];
       return $return_array;
}
