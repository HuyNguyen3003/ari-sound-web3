<?php
if (empty($_POST['track_link']) || IS_LOGGED == false) {
    exit();
}
if (strpos($_POST['track_link'], 'soundcloud.com') === false) {
    $data['status'] = 400;
    $data['message'] = lang('Please enter soundcloud track link to import.');
    header('Content-type: application/json; charset=UTF-8');
    echo json_encode($data);
    exit();
}
$track_link = secure($_POST['track_link']);
$track = ImportFormSoundCloud($track_link);
if( isset($track['audio_id']) ){
    $data['status'] = 200;
    $data['trackid'] = $track['audio_id'];
}else if( isset($track['duplicated']) ){
    $data['status'] = 400;
    $data['message'] = lang('You can not import this track because this track is imported before.');
}else if( isset($track['soundcloud_pro']) ){
    $data['status'] = 400;
    $data['message'] = lang('You can not import this track because this track is one of SoundCloud Go+ tracks.');
}else{
    $data['status'] = 400;
    $data['message'] = lang('Error found while importing your track, please check soundcloud client ID.');
}