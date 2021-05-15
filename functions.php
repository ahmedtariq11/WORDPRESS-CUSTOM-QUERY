// Get Posts
$posts = get_posts([
  'post_type' => 'press-release',
  'posts_per_page' => 25,
  'category' => 4,
]);

foreach($posts as $post){
  setup_postdata($post);

  echo '<h1>' . get_the_title() . '</h1>';
  echo '<a href="' . get_the_permalink() . '">Read More</a>';
  echo '<hr>';

}
wp_reset_postdata();

echo '<pre>';
print_r($posts);
echo '</pre><hr/>';




// WP QUERY
$query = new WP_Query([
  'post_type' => 'press-release',
  'posts_per_page' => 25,
  'category_name' => 'health',
]);

if($query->have_posts()){
  while($query->have_posts()) {
    $query->the_post();

    echo '<h1>' . get_the_title() . '</h1>';
    echo '<a href="'.get_the_permalink().'">Read More</a>';
    echo '<hr>';

  }
}

echo '<pre>';
print_r($query);
echo '</pre><hr/>';


// $WPDB
global $wpdb;
$results = $wpdb->get_results(
  "SELECT post_title, post_excerpt, ID 
   FROM $wpdb->posts
   LEFT JOIN  $wpdb->term_relationships as t
   ON ID = t.object_id
   WHERE post_type = 'press-release'
   AND post_status = 'publish'
   AND t.term_taxonomy_id = 3
   LIMIT 25"
 );

 echo '<pre>';
 print_r($results);
 echo '</pre>';

foreach($results as $release) {
  echo '<h1>'.$release->post_title.'</h1>';
  echo '<a href="'.get_the_permalink($release->ID).'">Read More</a>';
  echo '<hr>';
}
