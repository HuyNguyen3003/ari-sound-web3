<?php
if( empty($path['options'][1]) ) {
    header("Location: $site_url/404");
    exit();
}

if (!empty($path['options'][1])) {
    $arr = explode("_",$path['options'][1]);
    if( isset($arr[0]) && $arr[0] > 0 ){
        $article = Secure((int)$arr[0]);
    }
}

if( !empty($article) ) {
    if ($db->where('id', $article)->getValue(T_BLOG, 'id') === NULL) {
        header("Location: $site_url/404");
        exit();
    }

    if( !isset( $_SESSION['blog_view'][$article] ) ) {
        $db->where('id', $article)->update('blog', array('view' => $db->inc()));
        $_SESSION['blog_view'][$article] = true;
    }

}
$articleData = $db->arrayBuilder()->where('id', $article)->getOne(T_BLOG);



$music->site_pagename = $path['options'][1];
$music->site_description = $music->config->description;
$music->site_title = $articleData['title'];
$articleData['url'] = urlencode( $site_url . '/' . $articleData['id'] . '_' . url_slug(html_entity_decode($articleData['title'])) );

$music->site_content = loadPage("blogs/article", [
    'thumbnail' => getMedia($articleData['thumbnail']),
    'id' => $articleData['id'],
    'title' => $articleData['title'],
    'content' => $articleData['content'],
    'description' => $articleData['description'],
    'posted' => $articleData['posted'],
    'category' => $articleData['category'],
    'category_text' => lang($articleData['category']),
    'view' => $articleData['view'],
    'shared' => $articleData['shared'],
    'tags' => $articleData['tags'],
    'created_at' => $articleData['created_at'],
    'url' => $articleData['url']
]);