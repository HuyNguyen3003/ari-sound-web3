<?php
if (IS_LOGGED == false || $music->config->soundcloud_import == 'off') {
    header("Location: $site_url");
    exit();
}

$music->site_title = lang("Import");
$music->site_pagename = 'import';
$music->site_description = $music->config->description;
$music->site_content = loadPage("import/content", []);