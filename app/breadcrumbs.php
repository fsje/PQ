<?php
/**
 * Created by PhpStorm.
 * User: jomo
 * Date: 04/12/2018
 * Time: 10:22
 */

/**
 * @param array $data
 * @param string $seperator
 * @param string $home
 * @return string
 */
function breadCrumbs( $data = array(), $seperator = ' &raquo; ', $home = 'Hjem')
{
    // URL Aliases
    $staticAliases = array(
        'simplified' => 'Subfolder',
        'food' => 'Madvarer',
        'packaging' => 'Emballage',
    );

    // Path
    $path = array_filter(explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)));

    // Our base path.
    $base = ($_SERVER['HTTPS'] ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';

    // Initalize a temporary array with breadcrumbs.
    $breadcrumbs = array("<span class='bc-item'><a href=\"$base\">$home</a></span>");

    // Last index in our path array.
    $last = end(array_keys($path));

    // Build our breadcrumbs.
    foreach($path as $x => $crumb)
    {
        // Display title.
            if(array_key_exists($crumb, $staticAliases) && !is_numeric($crumb)){
                $title = setBreadcrumbTitle($staticAliases[$crumb]);
            }elseif(is_numeric($crumb) && array_search($crumb, $data)){
                $title = setBreadcrumbTitle($data['seo_alias']);
            }else{
                $title = setBreadcrumbTitle($crumb);
            }


        // Check if we're on our last index.
        if ($x != $last){
            $breadcrumbs[] = "<span class='bc-item'><a href=\"$base$crumb\">$title</a></span>";
        }else{
            $breadcrumbs[] = '<span class="bc-item">' . $title . '</span>';
        }

    }

    return implode($seperator, $breadcrumbs);
}

/**
 * @param $text
 * @param string $extension
 * @return string
 */
function setBreadcrumbTitle($text, $extension = '.php')
{
    return ucwords(str_replace(Array($extension, '_'), Array('', ' '), $text));
}