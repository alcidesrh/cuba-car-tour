<?php
	get_header();
    $category = get_category(get_query_var('cat'));
    $title = $category->description;
?>

<?php
require 'title.php';
if($category->slug == 'transfers' || $category->slug == 'services' || $category->slug == 'rent-car')
    get_template_part('transfer-list-page');
if($category->slug == 'cars' || $category->slug == 'sedan' || $category->slug == 'convertible')
    get_template_part('car-list-page');
else
get_template_part('tour-list-page');

	get_footer();