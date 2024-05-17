<?php
if (file_exists('./assets/init.php')) {
    require_once('./assets/init.php');
} else {
    die('Please put this file in the home directory !');
}
function PT_UpdateLangs($lang, $key, $value) {
    global $sqlConnect;
    $update_query         = "UPDATE langs SET `{lang}` = '{lang_text}' WHERE `lang_key` = '{lang_key}'";
    $update_replace_array = array(
        "{lang}",
        "{lang_text}",
        "{lang_key}"
    );
    return str_replace($update_replace_array, array(
        $lang,
        mysqli_real_escape_string($sqlConnect, $value),
        $key
    ), $update_query);
}
$updated = false;
if (!empty($_GET['updated'])) {
    $updated = true;
}
if (!empty($_POST['query'])) {
    $query = mysqli_query($mysqli, base64_decode($_POST['query']));
    if ($query) {
        $data['status'] = 200;
    } else {
        $data['status'] = 400;
        $data['error']  = mysqli_error($mysqli);
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if (!empty($_POST['update_langs'])) {
    $data  = array();
    $query = mysqli_query($sqlConnect, "SHOW COLUMNS FROM `langs`");
    while ($fetched_data = mysqli_fetch_assoc($query)) {
        $data[] = $fetched_data['Field'];
    }
    unset($data[0]);
    unset($data[1]);
    unset($data[2]);
    unset($data[3]);
    $lang_update_queries = array();
    foreach ($data as $key => $value) {
        $value = ($value);
        if ($value == 'arabic') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'buy_album', 'شراء الألبوم');
            $lang_update_queries[] = PT_UpdateLangs($value, 'mentioned_you_on_a_comment.', 'ذكرك في تعليق.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'one_of_my_follower_mention_me_in_comment', 'ذكرني أحد المتابعين لي في تعليق');
            $lang_update_queries[] = PT_UpdateLangs($value, 'one_of_my_follower_mention_me_in_comment_replay', 'ذكرني أحد متابعيني في رد أحد التعليقات');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replay_comment', 'الرد للتعليق');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replayed_on__auser__comment_', 'تم الرد على | auser | ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'point_system', 'نظام النقاط');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_comment.', 'النقاط على التعليق.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_upload_new_song.', 'نقاط على تحميل أغنية جديدة.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_replay_to_comment.', 'نقاط على الرد على تعليق.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_like_some_one_track.', 'نقاط على الإعجاب بمسار واحد.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_dislike_some_one_track.', 'نقاط على كره المسار.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_like_some_one_comment.', 'يشير إلى الإعجاب بالتعليق.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_create_new_playlist.', 'نقاط على إنشاء قائمة تشغيل جديدة.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_re-post_track.', 'نقاط على إعادة نشر المسار.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_download_track.', 'نقاط على تنزيل المسار.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_like_blog_comment.', 'يشير إلى الإعجاب بتعليق المدونة.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_dislike_comment.', 'يشير إلى عدم الإعجاب بالتعليق.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_dislike_blog_comment.', 'يشير إلى عدم الإعجاب بتعليق المدونة.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_import_track.', 'النقاط على مسار الاستيراد.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_user_update_his_profile_picture.', 'نقاط على المستخدم تحديث صورته الشخصية.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_purchase_track.', 'النقاط على مسار الشراء.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_user_go_pro.', 'النقاط على المستخدم GO PRO.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_review_some_one_track.', 'نقاط على مراجعة بعض مسار واحد.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_report_some_one_track.', 'نقاط على الإبلاغ عن المسار.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_report_comment.', 'نقاط على الإبلاغ عن تعليق.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_add_to_playlist.', 'نقاط على إضافة المسار إلى قائمة التشغيل.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_user_update_his_profile_cover.', 'نقاط على تحديث غلاف ملف التعريف الخاص بك.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_new_article', 'إنشاء مقال جديد');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_blog_bost', 'إنشاء منشور مدونة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_article_html', 'بيانات HTML');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_file', 'قم بتحميل ملف');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_photo', 'حمل الصورة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'success', 'نجاح');
            $lang_update_queries[] = PT_UpdateLangs($value, 'article_saved_successfully', 'تم تقديم مقالتك بنجاح.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'warning', 'تحذير');
            $lang_update_queries[] = PT_UpdateLangs($value, 'stream_url_not_found.', 'لم يتم العثور على عنوان البث.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_can_earn_points_and_transfer_them_to_your_wallet_by_doing_the_activities_below.', 'يمكنك كسب النقاط وتحويلها إلى محفظتك من خلال القيام بالأنشطة أدناه.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_or_register_to_start_earning_points_', 'تسجيل الدخول أو التسجيل لبدء كسب النقاط!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'point', 'نقطة');
        } else if ($value == 'dutch') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'buy_album', 'Album kopen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'mentioned_you_on_a_comment.', 'noemde je bij een opmerking.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'one_of_my_follower_mention_me_in_comment', 'Een van mijn volgers noemde me in een opmerking');
            $lang_update_queries[] = PT_UpdateLangs($value, 'one_of_my_follower_mention_me_in_comment_replay', 'Een van mijn volgers noemde me in het antwoord van een reactie');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replay_comment', 'Reageer op commentaar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replayed_on__auser__comment_', 'antwoordde op | auser | ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'point_system', 'Puntensysteem');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_comment.', 'Punten op commentaar.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_upload_new_song.', 'Punten bij het uploaden van een nieuw nummer.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_replay_to_comment.', 'Punten over het beantwoorden van een opmerking.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_like_some_one_track.', 'Punten op het leuk vinden van een track.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_dislike_some_one_track.', 'Punten op een afkeer van een track.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_like_some_one_comment.', 'Punten op het leuk vinden van een opmerking.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_create_new_playlist.', 'Punten voor het maken van een nieuwe afspeellijst.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_re-post_track.', 'Punten bij het opnieuw plaatsen van een track.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_download_track.', 'Punten voor het downloaden van een track.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_like_blog_comment.', 'Punten over het leuk vinden van de opmerking van een blog.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_dislike_comment.', 'Wijst op een afkeer van een opmerking.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_dislike_blog_comment.', 'Punten op het afkeuren van de opmerking van een blog.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_import_track.', 'Punten op importspoor.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_user_update_his_profile_picture.', 'Punten waarop de gebruiker zijn profielfoto bijwerkt.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_purchase_track.', 'Punten op aankoopspoor.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_user_go_pro.', 'Punten op de gebruiker gaan PRO.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_review_some_one_track.', 'Punten op een overzicht van een track.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_report_some_one_track.', 'Punten bij het melden van een track.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_report_comment.', 'Punten over het melden van een opmerking.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_add_to_playlist.', 'Wijst op het toevoegen van een track aan een afspeellijst.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_user_update_his_profile_cover.', 'Punten voor het bijwerken van uw profielomslag.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_new_article', 'Maak een nieuw artikel');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_blog_bost', 'Maak een blogpost');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_article_html', 'HTML-gegevens');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_file', 'Een bestand uploaden');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_photo', 'Upload foto');
            $lang_update_queries[] = PT_UpdateLangs($value, 'success', 'Succes');
            $lang_update_queries[] = PT_UpdateLangs($value, 'article_saved_successfully', 'Uw artikel is met succes ingediend.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'warning', 'Waarschuwing');
            $lang_update_queries[] = PT_UpdateLangs($value, 'stream_url_not_found.', 'Stream-URL is niet gevonden.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_can_earn_points_and_transfer_them_to_your_wallet_by_doing_the_activities_below.', 'U kunt punten verdienen en deze overboeken naar uw portemonnee door de onderstaande activiteiten uit te voeren.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_or_register_to_start_earning_points_', 'Log in of registreer om punten te verdienen!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'point', 'Punt');
        } else if ($value == 'french') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'buy_album', 'Acheter l\'album');
            $lang_update_queries[] = PT_UpdateLangs($value, 'mentioned_you_on_a_comment.', 'vous a mentionné dans un commentaire.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'one_of_my_follower_mention_me_in_comment', 'Un de mes followers m\'a mentionné dans un commentaire');
            $lang_update_queries[] = PT_UpdateLangs($value, 'one_of_my_follower_mention_me_in_comment_replay', 'Un de mes followers m\'a mentionné dans la réponse d\'un commentaire');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replay_comment', 'Répondre au commentaire');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replayed_on__auser__comment_', 'a répondu le | auser | ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'point_system', 'Système de points');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_comment.', 'Points sur le commentaire.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_upload_new_song.', 'Points sur le téléchargement d\'une nouvelle chanson.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_replay_to_comment.', 'Points sur la réponse à un commentaire.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_like_some_one_track.', 'Points sur aimer une piste.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_dislike_some_one_track.', 'Points à ne pas aimer une piste.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_like_some_one_comment.', 'Points sur aimer un commentaire.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_create_new_playlist.', 'Points sur la création d\'une nouvelle liste de lecture.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_re-post_track.', 'Points lors de la re-publication d\'une piste.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_download_track.', 'Points sur le téléchargement d\'une piste.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_like_blog_comment.', 'Points sur aimer le commentaire d\'un blog.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_dislike_comment.', 'Points sur le fait de ne pas aimer un commentaire.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_dislike_blog_comment.', 'Points sur le fait de ne pas aimer le commentaire d\'un blog.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_import_track.', 'Points sur la piste d\'importation.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_user_update_his_profile_picture.', 'Les points sur l\'utilisateur mettent à jour sa photo de profil.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_purchase_track.', 'Points sur la piste d\'achat.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_user_go_pro.', 'Les points sur l\'utilisateur vont PRO.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_review_some_one_track.', 'Points sur l\'examen d\'une piste.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_report_some_one_track.', 'Points sur le rapport d\'une trace.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_report_comment.', 'Points sur le rapport d\'un commentaire.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_add_to_playlist.', 'Points sur l\'ajout d\'une piste à une liste de lecture.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_user_update_his_profile_cover.', 'Points sur la mise à jour de la couverture de votre profil.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_new_article', 'Créer un nouvel article');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_blog_bost', 'Créer un article de blog');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_article_html', 'Données HTML');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_file', 'Télécharger un fichier');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_photo', 'Envoyer la photo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'success', 'Succès');
            $lang_update_queries[] = PT_UpdateLangs($value, 'article_saved_successfully', 'Votre article a été soumis avec succès.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'warning', 'avertissement');
            $lang_update_queries[] = PT_UpdateLangs($value, 'stream_url_not_found.', 'L\'URL du flux n\'a pas été trouvée.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_can_earn_points_and_transfer_them_to_your_wallet_by_doing_the_activities_below.', 'Vous pouvez gagner des points et les transférer dans votre portefeuille en effectuant les activités ci-dessous.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_or_register_to_start_earning_points_', 'Connectez-vous ou inscrivez-vous pour commencer à gagner des points!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'point', 'Point');
        } else if ($value == 'german') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'buy_album', 'Album kaufen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'mentioned_you_on_a_comment.', 'erwähnte dich in einem Kommentar.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'one_of_my_follower_mention_me_in_comment', 'Einer meiner Anhänger erwähnte mich in einem Kommentar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'one_of_my_follower_mention_me_in_comment_replay', 'Einer meiner Anhänger erwähnte mich in der Antwort eines Kommentars');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replay_comment', 'Auf Kommentar antworten');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replayed_on__auser__comment_', 'antwortete auf | auser | ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'point_system', 'Punktesystem');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_comment.', 'Punkte auf Kommentar.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_upload_new_song.', 'Punkte beim Hochladen eines neuen Songs.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_replay_to_comment.', 'Punkte bei der Beantwortung eines Kommentars.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_like_some_one_track.', 'Punkte, die einen Track mögen.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_dislike_some_one_track.', 'Punkte, wenn man eine Spur nicht mag.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_like_some_one_comment.', 'Punkte zum Liken eines Kommentars.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_create_new_playlist.', 'Punkte beim Erstellen einer neuen Wiedergabeliste.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_re-post_track.', 'Punkte beim erneuten Posten eines Tracks.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_download_track.', 'Punkte beim Herunterladen eines Titels.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_like_blog_comment.', 'Punkte, die den Kommentar eines Blogs mögen.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_dislike_comment.', 'Punkte, wenn Sie einen Kommentar nicht mögen.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_dislike_blog_comment.', 'Punkte, wenn Sie den Kommentar eines Blogs nicht mögen.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_import_track.', 'Punkte auf der Importspur.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_user_update_his_profile_picture.', 'Punkte auf Benutzer aktualisieren sein Profilbild.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_purchase_track.', 'Punkte auf Kaufspur.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_user_go_pro.', 'Punkte auf Benutzer gehen PRO.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_review_some_one_track.', 'Punkte bei der Überprüfung einer Spur.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_report_some_one_track.', 'Punkte beim Melden eines Tracks.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_report_comment.', 'Punkte zum Melden eines Kommentars.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_add_to_playlist.', 'Punkte beim Hinzufügen eines Titels zu einer Wiedergabeliste.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_user_update_his_profile_cover.', 'Punkte zum Aktualisieren Ihrer Profilabdeckung.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_new_article', 'Neuen Artikel erstellen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_blog_bost', 'Erstellen Sie einen Blog-Beitrag');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_article_html', 'HTML-Daten');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_file', 'Eine Datei hochladen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_photo', 'Foto hochladen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'success', 'Erfolg');
            $lang_update_queries[] = PT_UpdateLangs($value, 'article_saved_successfully', 'Ihr Artikel wurde erfolgreich eingereicht.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'warning', 'Warnung');
            $lang_update_queries[] = PT_UpdateLangs($value, 'stream_url_not_found.', 'Stream-URL wurde nicht gefunden.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_can_earn_points_and_transfer_them_to_your_wallet_by_doing_the_activities_below.', 'Sie können Punkte sammeln und diese in Ihre Brieftasche übertragen, indem Sie die folgenden Aktivitäten ausführen.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_or_register_to_start_earning_points_', 'Melden Sie sich an oder registrieren Sie sich, um Punkte zu sammeln!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'point', 'Punkt');
        } else if ($value == 'russian') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'buy_album', 'Купить альбом');
            $lang_update_queries[] = PT_UpdateLangs($value, 'mentioned_you_on_a_comment.', 'упомянул вас в комментарии.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'one_of_my_follower_mention_me_in_comment', 'Один из моих подписчиков упомянул меня в комментарии');
            $lang_update_queries[] = PT_UpdateLangs($value, 'one_of_my_follower_mention_me_in_comment_replay', 'Один из моих подписчиков упомянул меня в ответе на комментарий');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replay_comment', 'Ответить на комментарий');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replayed_on__auser__comment_', 'ответил на | auser | ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'point_system', 'Система очков');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_comment.', 'Очки по комментарию.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_upload_new_song.', 'Очки за загрузку новой песни.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_replay_to_comment.', 'Указывает на ответ на комментарий.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_like_some_one_track.', 'Указывает на то, что нравится какой-то трек.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_dislike_some_one_track.', 'Указывает на то, что трек не нравится.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_like_some_one_comment.', 'Очки за понравившийся комментарий.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_create_new_playlist.', 'Очки при создании нового списка воспроизведения.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_re-post_track.', 'Очки за повторную публикацию трека.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_download_track.', 'Очки при загрузке трека.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_like_blog_comment.', 'Очки за понравившийся комментарий в блоге.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_dislike_comment.', 'Очки за неприятие комментария.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_dislike_blog_comment.', 'Очки за неприятие комментария в блоге.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_import_track.', 'Очки на импортном треке.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_user_update_his_profile_picture.', 'Очки на пользователя обновляют его изображение профиля.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_purchase_track.', 'Очки на треке покупки.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_user_go_pro.', 'Очки на пользователя становятся ПРО.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_review_some_one_track.', 'Очки на просмотр какого-то одного трека.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_report_some_one_track.', 'Очки за сообщение о треке.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_report_comment.', 'Очки за сообщение о комментарии.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_add_to_playlist.', 'Очки при добавлении трека в плейлист.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_user_update_his_profile_cover.', 'Очки по обновлению обложки вашего профиля.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_new_article', 'Создать новую статью');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_blog_bost', 'Создать сообщение в блоге');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_article_html', 'Данные HTML');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_file', 'Загрузить файл');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_photo', 'Загрузить фото');
            $lang_update_queries[] = PT_UpdateLangs($value, 'success', 'Успех');
            $lang_update_queries[] = PT_UpdateLangs($value, 'article_saved_successfully', 'Ваша статья была успешно отправлена.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'warning', 'Предупреждение');
            $lang_update_queries[] = PT_UpdateLangs($value, 'stream_url_not_found.', 'URL-адрес потока не найден.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_can_earn_points_and_transfer_them_to_your_wallet_by_doing_the_activities_below.', 'Вы можете зарабатывать баллы и переводить их в свой кошелек, выполняя указанные ниже действия.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_or_register_to_start_earning_points_', 'Войдите или зарегистрируйтесь, чтобы начать зарабатывать очки!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'point', 'Точка');
        } else if ($value == 'spanish') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'buy_album', 'Comprar álbum');
            $lang_update_queries[] = PT_UpdateLangs($value, 'mentioned_you_on_a_comment.', 'te mencionó en un comentario.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'one_of_my_follower_mention_me_in_comment', 'Uno de mis seguidores me mencionó en un comentario.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'one_of_my_follower_mention_me_in_comment_replay', 'Uno de mis seguidores me mencionó en la respuesta de un comentario.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replay_comment', 'Responder al comentario');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replayed_on__auser__comment_', 'respondió en | auser | ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'point_system', 'Sistema de puntos');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_comment.', 'Puntos sobre el comentario.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_upload_new_song.', 'Puntos por subir nueva canción.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_replay_to_comment.', 'Puntos sobre la respuesta a un comentario.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_like_some_one_track.', 'Señala que le gusta alguna pista.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_dislike_some_one_track.', 'Puntos sobre el disgusto de una pista.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_like_some_one_comment.', 'Puntos sobre dar me gusta a un comentario.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_create_new_playlist.', 'Puntos sobre la creación de una nueva lista de reproducción.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_re-post_track.', 'Puntos por volver a publicar una pista.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_download_track.', 'Puntos al descargar una pista.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_like_blog_comment.', 'Señala que le gusta el comentario de un blog.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_dislike_comment.', 'Señala que no le gusta un comentario.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_dislike_blog_comment.', 'Señala que no le gusta el comentario de un blog.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_import_track.', 'Puntos en pista de importación.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_user_update_his_profile_picture.', 'Puntos en el usuario actualizan su foto de perfil.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_purchase_track.', 'Puntos en la pista de compra.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_user_go_pro.', 'Los puntos en el usuario se vuelven PRO.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_review_some_one_track.', 'Puntos al revisar alguna pista.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_report_some_one_track.', 'Puntos al informar una pista.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_report_comment.', 'Puntos sobre cómo informar un comentario.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_add_to_playlist.', 'Puntos al agregar una pista a una lista de reproducción.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_user_update_his_profile_cover.', 'Puntos sobre la actualización de la portada de su perfil.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_new_article', 'Crear nuevo artículo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_blog_bost', 'Crear publicación de blog');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_article_html', 'Datos HTML');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_file', 'Cargar un archivo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_photo', 'Subir foto');
            $lang_update_queries[] = PT_UpdateLangs($value, 'success', 'Éxito');
            $lang_update_queries[] = PT_UpdateLangs($value, 'article_saved_successfully', 'Su artículo se ha enviado correctamente.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'warning', 'Advertencia');
            $lang_update_queries[] = PT_UpdateLangs($value, 'stream_url_not_found.', 'No se ha encontrado la URL de la transmisión.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_can_earn_points_and_transfer_them_to_your_wallet_by_doing_the_activities_below.', 'Puede ganar puntos y transferirlos a su billetera realizando las siguientes actividades.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_or_register_to_start_earning_points_', '¡Inicie sesión o regístrese para comenzar a ganar puntos!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'point', 'Punto');
        } else if ($value == 'turkish') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'buy_album', 'Albüm Satın Al');
            $lang_update_queries[] = PT_UpdateLangs($value, 'mentioned_you_on_a_comment.', 'bir yorumda sizden bahsetti.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'one_of_my_follower_mention_me_in_comment', 'Takipçilerimden biri bir yorumda benden bahsetti');
            $lang_update_queries[] = PT_UpdateLangs($value, 'one_of_my_follower_mention_me_in_comment_replay', 'Takipçilerimden biri bir yorumun yanıtında benden bahsetti');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replay_comment', 'Yorumu yanıtlayın');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replayed_on__auser__comment_', 'yanıtlandı | auser | ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'point_system', 'Puan sistemi');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_comment.', 'Yorumdaki noktalar.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_upload_new_song.', 'Yeni şarkı yükleme puanları.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_replay_to_comment.', 'Yoruma yanıt verme üzerine puan.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_like_some_one_track.', 'Bir parçayı beğenmeye dikkat edin.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_dislike_some_one_track.', 'Bir parçayı beğenmeme noktaları.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_like_some_one_comment.', 'Bir yorumu beğenmeye işaret eder.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_create_new_playlist.', 'Yeni oynatma listesi oluşturmaya ilişkin puanlar.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_re-post_track.', 'Bir parçayı yeniden yayınlamaya ilişkin puanlar.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_download_track.', 'Parça indirme ile ilgili noktalar.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_like_blog_comment.', 'Bir blogun yorumunun beğenilmesine ilişkin puan.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_dislike_comment.', 'Bir yorumu beğenmeme üzerine puan.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_dislike_blog_comment.', 'Bir blogun yorumunu beğenmeme üzerine işaret eder.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_import_track.', 'İçe aktarma yolundaki noktalar.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_user_update_his_profile_picture.', 'Kullanıcı üzerindeki puanlar profil resmini günceller.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_purchase_track.', 'Satın alma yolundaki puanlar.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_user_go_pro.', 'Kullanıcı üzerindeki puanlar PRO olur.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_review_some_one_track.', 'Bir parçayı gözden geçirme noktaları.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_report_some_one_track.', 'Bir parkuru bildirme noktaları.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_report_comment.', 'Bir yorumu bildirmeye ilişkin noktalar.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_add_to_playlist.', 'Bir oynatma listesine parça eklemeye ilişkin noktalar.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_user_update_his_profile_cover.', 'Profil kapağınızı güncellemeyle ilgili noktalar.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_new_article', 'Yeni makale oluştur');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_blog_bost', 'Blog yayını oluştur');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_article_html', 'HTML verileri');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_file', 'Bir dosya yükle');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_photo', 'Fotoğraf yükle');
            $lang_update_queries[] = PT_UpdateLangs($value, 'success', 'Başarı');
            $lang_update_queries[] = PT_UpdateLangs($value, 'article_saved_successfully', 'Makaleniz başarıyla gönderildi.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'warning', 'Uyarı');
            $lang_update_queries[] = PT_UpdateLangs($value, 'stream_url_not_found.', 'Akış URL\'si bulunamadı.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_can_earn_points_and_transfer_them_to_your_wallet_by_doing_the_activities_below.', 'Aşağıdaki aktiviteleri yaparak puan kazanabilir ve cüzdanınıza aktarabilirsiniz.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_or_register_to_start_earning_points_', 'Puan kazanmaya başlamak için Giriş Yapın veya Kaydolun!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'point', 'Nokta');
        } else if ($value == 'english') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'buy_album', 'Buy Album');
            $lang_update_queries[] = PT_UpdateLangs($value, 'mentioned_you_on_a_comment.', 'mentioned you on a comment.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'one_of_my_follower_mention_me_in_comment', 'One of my followers mentioned me in a comment');
            $lang_update_queries[] = PT_UpdateLangs($value, 'one_of_my_follower_mention_me_in_comment_replay', 'One of my followers mentioned me in a comment\'s reply');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replay_comment', 'Reply to comment');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replayed_on__auser__comment_', 'replied on |auser| comment,');
            $lang_update_queries[] = PT_UpdateLangs($value, 'point_system', 'Points system');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_comment.', 'Points on comment.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_upload_new_song.', 'Points on upload new song.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_replay_to_comment.', 'Points on replying to a comment.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_like_some_one_track.', 'Points on liking some one track.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_dislike_some_one_track.', 'Points on disliking a track.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_like_some_one_comment.', 'Points on liking a comment.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_create_new_playlist.', 'Points on creating new playlist.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_re-post_track.', 'Points on re-posting a track.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_download_track.', 'Points on downloading a track.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_like_blog_comment.', 'Points on liking a blog\'s comment.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_dislike_comment.', 'Points on disliking a comment.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_dislike_blog_comment.', 'Points on disliking a blog\'s comment.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_import_track.', 'Points on import track.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_user_update_his_profile_picture.', 'Points on user update his profile picture.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_purchase_track.', 'Points on purchase track.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_user_go_pro.', 'Points on user go PRO.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_review_some_one_track.', 'Points on review some one track.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_report_some_one_track.', 'Points on reporting a track.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_report_comment.', 'Points on reporting a comment.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_add_to_playlist.', 'Points on adding track to a playlist.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_user_update_his_profile_cover.', 'Points on updating your profile cover.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_new_article', 'Create new article');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_blog_bost', 'Create blog post');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_article_html', 'HTML data');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_file', 'Upload a file');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_photo', 'Upload Photo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'success', 'Success');
            $lang_update_queries[] = PT_UpdateLangs($value, 'article_saved_successfully', 'Your article has been submitted successfully.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'warning', 'Warning');
            $lang_update_queries[] = PT_UpdateLangs($value, 'stream_url_not_found.', 'Stream URL has not been found.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_can_earn_points_and_transfer_them_to_your_wallet_by_doing_the_activities_below.', 'You can earn points and transfer them to your wallet by doing the activities below.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_or_register_to_start_earning_points_', 'Login or Register to start earning points!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'point', 'Point');
        } else if ($value != 'english') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'buy_album', 'Buy Album');
            $lang_update_queries[] = PT_UpdateLangs($value, 'mentioned_you_on_a_comment.', 'mentioned you on a comment.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'one_of_my_follower_mention_me_in_comment', 'One of my followers mentioned me in a comment');
            $lang_update_queries[] = PT_UpdateLangs($value, 'one_of_my_follower_mention_me_in_comment_replay', 'One of my followers mentioned me in a comment\'s reply');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replay_comment', 'Reply to comment');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replayed_on__auser__comment_', 'replied on |auser| comment,');
            $lang_update_queries[] = PT_UpdateLangs($value, 'point_system', 'Points system');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_comment.', 'Points on comment.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_upload_new_song.', 'Points on upload new song.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_replay_to_comment.', 'Points on replying to a comment.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_like_some_one_track.', 'Points on liking some one track.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_dislike_some_one_track.', 'Points on disliking a track.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_like_some_one_comment.', 'Points on liking a comment.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_create_new_playlist.', 'Points on creating new playlist.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_re-post_track.', 'Points on re-posting a track.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_download_track.', 'Points on downloading a track.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_like_blog_comment.', 'Points on liking a blog\'s comment.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_dislike_comment.', 'Points on disliking a comment.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_dislike_blog_comment.', 'Points on disliking a blog\'s comment.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_import_track.', 'Points on import track.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_user_update_his_profile_picture.', 'Points on user update his profile picture.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_purchase_track.', 'Points on purchase track.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_user_go_pro.', 'Points on user go PRO.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_review_some_one_track.', 'Points on review some one track.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_report_some_one_track.', 'Points on reporting a track.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_report_comment.', 'Points on reporting a comment.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_add_to_playlist.', 'Points on adding track to a playlist.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'points_on_user_update_his_profile_cover.', 'Points on updating your profile cover.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_new_article', 'Create new article');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_blog_bost', 'Create blog post');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_article_html', 'HTML data');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_file', 'Upload a file');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_photo', 'Upload Photo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'success', 'Success');
            $lang_update_queries[] = PT_UpdateLangs($value, 'article_saved_successfully', 'Your article has been submitted successfully.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'warning', 'Warning');
            $lang_update_queries[] = PT_UpdateLangs($value, 'stream_url_not_found.', 'Stream URL has not been found.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_can_earn_points_and_transfer_them_to_your_wallet_by_doing_the_activities_below.', 'You can earn points and transfer them to your wallet by doing the activities below.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_or_register_to_start_earning_points_', 'Login or Register to start earning points!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'point', 'Point');
        }
    }
    if (!empty($lang_update_queries)) {
        foreach ($lang_update_queries as $key => $query) {
            $sql = mysqli_query($mysqli, $query);
        }
    }
    $name = md5(microtime()) . '_updated.php';
    rename('update.php', $name);
}
?>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1"/>
      <title>Updating DeepSound</title>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <style>
         @import url('https://fonts.googleapis.com/css?family=Roboto:400,500');
         @media print {
            .wo_update_changelog {max-height: none !important; min-height: !important}
            .btn, .hide_print, .setting-well h4 {display:none;}
         }
         * {outline: none !important;}
         body {background: #f3f3f3;font-family: 'Roboto', sans-serif;}
         .light {font-weight: 400;}
         .bold {font-weight: 500;}
         .btn {height: 52px;line-height: 1;font-size: 16px;transition: all 0.3s;border-radius: 2em;font-weight: 500;padding: 0 28px;letter-spacing: .5px;}
         .btn svg {margin-left: 10px;margin-top: -2px;transition: all 0.3s;vertical-align: middle;}
         .btn:hover svg {-webkit-transform: translateX(3px);-moz-transform: translateX(3px);-ms-transform: translateX(3px);-o-transform: translateX(3px);transform: translateX(3px);}
         .btn-main {color: #ffffff;background-color: #f98f1d;border-color: #f98f1d;}
         .btn-main:disabled, .btn-main:focus {color: #fff;}
         .btn-main:hover {color: #ffffff;background-color: #0dcde2;border-color: #0dcde2;box-shadow: -2px 2px 14px rgba(168, 72, 73, 0.35);}
         svg {vertical-align: middle;}
         .main {color: #f98f1d;}
         .wo_update_changelog {
          border: 1px solid #eee;
          padding: 10px !important;
         }
         .content-container {display: -webkit-box; width: 100%;display: -moz-box;display: -ms-flexbox;display: -webkit-flex;display: flex;-webkit-flex-direction: column;flex-direction: column;min-height: 100vh;position: relative;}
         .content-container:before, .content-container:after {-webkit-box-flex: 1;box-flex: 1;-webkit-flex-grow: 1;flex-grow: 1;content: '';display: block;height: 50px;}
         .wo_install_wiz {position: relative;background-color: white;box-shadow: 0 1px 15px 2px rgba(0, 0, 0, 0.1);border-radius: 10px;padding: 20px 30px;border-top: 1px solid rgba(0, 0, 0, 0.04);}
         .wo_install_wiz h2 {margin-top: 10px;margin-bottom: 30px;display: flex;align-items: center;}
         .wo_install_wiz h2 span {margin-left: auto;font-size: 15px;}
         .wo_update_changelog {padding:0;list-style-type: none;margin-bottom: 15px;max-height: 440px;overflow-y: auto; min-height: 440px;}
         .wo_update_changelog li {margin-bottom:7px; max-height: 20px; overflow: hidden;}
         .wo_update_changelog li span {padding: 2px 7px;font-size: 12px;margin-right: 4px;border-radius: 2px;}
         .wo_update_changelog li span.added {background-color: #4CAF50;color: white;}
         .wo_update_changelog li span.changed {background-color: #e62117;color: white;}
         .wo_update_changelog li span.improved {background-color: #9C27B0;color: white;}
         .wo_update_changelog li span.compressed {background-color: #795548;color: white;}
         .wo_update_changelog li span.fixed {background-color: #2196F3;color: white;}
         input.form-control {background-color: #f4f4f4;border: 0;border-radius: 2em;height: 40px;padding: 3px 14px;color: #383838;transition: all 0.2s;}
input.form-control:hover {background-color: #e9e9e9;}
input.form-control:focus {background: #fff;box-shadow: 0 0 0 1.5px #a84849;}
         .empty_state {margin-top: 80px;margin-bottom: 80px;font-weight: 500;color: #6d6d6d;display: block;text-align: center;}
         .checkmark__circle {stroke-dasharray: 166;stroke-dashoffset: 166;stroke-width: 2;stroke-miterlimit: 10;stroke: #7ac142;fill: none;animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;}
         .checkmark {width: 80px;height: 80px; border-radius: 50%;display: block;stroke-width: 3;stroke: #fff;stroke-miterlimit: 10;margin: 100px auto 50px;box-shadow: inset 0px 0px 0px #7ac142;animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;}
         .checkmark__check {transform-origin: 50% 50%;stroke-dasharray: 48;stroke-dashoffset: 48;animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;}
         @keyframes stroke { 100% {stroke-dashoffset: 0;}}
         @keyframes scale {0%, 100% {transform: none;}  50% {transform: scale3d(1.1, 1.1, 1); }}
         @keyframes fill { 100% {box-shadow: inset 0px 0px 0px 54px #7ac142; }}
      </style>
   </head>
   <body>
      <div class="content-container container">
         <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
               <div class="wo_install_wiz">
                 <?php if ($updated == false) { ?>
                  <div>
                     <h2 class="light">Update to v1.3.3 </span></h2>
                     <div class="setting-well">
                        <h4>Changelog</h4>
                        <ul class="wo_update_changelog">
                            <li>[Added] ability to restrict rights of certain user from uploading / importing a song. </li>
                            <li>[Added] auto friend function in admin panel. </li>
                            <li>[Added] ability to mention @ someone in the comments. </li>
                            <li>[Added] point system, users can earn points by doing several activities in the site. </li>
                            <li>[Added] ability for user to post blogs. </li>
                            <li>[Added] ability to reply comments. </li>
                            <li>[Added] more APIs</li>
                            <li>[Fixed] 25+ reported bugs.</li>
                            <li>[Improved] speed.</li>
                        </ul>
                        <p class="hide_print">Note: The update process might take few minutes.</p>
                        <p class="hide_print">Important: If you got any fail queries, please copy them, open a support ticket and send us the details.</p>
                        <br>
                             <button class="pull-right btn btn-default" onclick="window.print();">Share Log</button>
                             <button type="button" class="btn btn-main" id="button-update">
                             Update 
                             <svg viewBox="0 0 19 14" xmlns="http://www.w3.org/2000/svg" width="18" height="18">
                                <path fill="currentColor" d="M18.6 6.9v-.5l-6-6c-.3-.3-.9-.3-1.2 0-.3.3-.3.9 0 1.2l5 5H1c-.5 0-.9.4-.9.9s.4.8.9.8h14.4l-4 4.1c-.3.3-.3.9 0 1.2.2.2.4.2.6.2.2 0 .4-.1.6-.2l5.2-5.2h.2c.5 0 .8-.4.8-.8 0-.3 0-.5-.2-.7z"></path>
                             </svg>
                          </button>
                     </div>
                     <?php }?>
                     <?php if ($updated == true) { ?>
                      <div>
                        <div class="empty_state">
                           <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                              <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
                              <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                           </svg>
                           <p>Congratulations, you have successfully updated your site. Thanks for choosing DeepSound.</p>
                           <br>
                           <a href="<?php echo $wo['config']['site_url'] ?>" class="btn btn-main" style="line-height:50px;">Home</a>
                        </div>
                     </div>
                     <?php }?>
                  </div>
               </div>
            </div>
            <div class="col-md-1"></div>
         </div>
      </div>
   </body>
</html>
<script>  
var queries = [
    "UPDATE `config` SET value = '1.3.3' WHERE name = 'version';",
    "ALTER TABLE `users` ADD `upload_import` INT(11) UNSIGNED NULL DEFAULT '1' AFTER `ref_user_id`;",
    "ALTER TABLE `users` ADD `email_on_comment_mention` INT(11) UNSIGNED NOT NULL DEFAULT '0' AFTER `upload_import`;",
    "ALTER TABLE `users` ADD `email_on_comment_replay_mention` INT(11) UNSIGNED NOT NULL DEFAULT '0' AFTER `upload_import`;",
    "CREATE TABLE `comment_replies` (  `id` int(11) NOT NULL,  `comment_id` int(11) NOT NULL DEFAULT 0,  `user_id` int(11) NOT NULL DEFAULT 0,  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,  `time` int(11) NOT NULL DEFAULT 0) ENGINE=InnoDB DEFAULT CHARSET=utf8;",
    "ALTER TABLE `comment_replies`  ADD PRIMARY KEY (`id`),  ADD KEY `comment_id` (`comment_id`),  ADD KEY `user_id` (`user_id`);",
    "ALTER TABLE `comment_replies`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;",
    "CREATE TABLE `point_system` (  `id` int(11) UNSIGNED NOT NULL,  `user_id` int(11) UNSIGNED NOT NULL,  `action` varchar(150) NOT NULL,  `reword` int(10) UNSIGNED NOT NULL DEFAULT 0,  `is_add` int(10) UNSIGNED NOT NULL DEFAULT 1,  `obj` text NOT NULL,  `time` int(11) UNSIGNED NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",
    "ALTER TABLE `point_system`  ADD PRIMARY KEY (`id`);",
    "ALTER TABLE `point_system`  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'allow_user_create_blog', 'off');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'point_system', 'on');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'point_system_comment_cost', '10');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'point_system_upload_cost', '30');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'point_system_replay_comment_cost', '40');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'point_system_like_track_cost', '45');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'point_system_dislike_track_cost', '50');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'point_system_like_comment_cost', '55');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'point_system_repost_cost', '60');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'point_system_track_download_cost', '65');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'point_system_like_blog_comment_cost', '70');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'point_system_unlike_comment_cost', '55');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'point_system_unlike_blog_comment_cost', '70');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'point_system_import_cost', '80');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'point_system_purchase_track_cost', '81');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'point_system_go_pro_cost', '82');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'point_system_review_track_cost', '83');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'point_system_report_track_cost', '84');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'point_system_report_comment_cost', '85');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'point_system_add_to_playlist_cost', '86');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'point_system_create_new_playlist_cost', '87');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'point_system_update_profile_picture_cost', '5');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'point_system_update_profile_cover_cost', '10');",
    "ALTER TABLE `blog` ADD `created_by` INT(11) UNSIGNED NOT NULL DEFAULT '0' AFTER `created_at`;",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'point_system_points_to_dollar', '0.001');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'buy_album');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'mentioned_you_on_a_comment.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'one_of_my_follower_mention_me_in_comment');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'one_of_my_follower_mention_me_in_comment_replay');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'replay_comment');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'replayed_on__auser__comment_');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'mentioned_you_on_a_comment.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'point_system');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'points_on_comment.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'points_on_upload_new_song.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'points_on_replay_to_comment.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'points_on_like_some_one_track.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'points_on_dislike_some_one_track.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'points_on_like_some_one_comment.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'points_on_create_new_playlist.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'points_on_re-post_track.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'points_on_download_track.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'points_on_like_blog_comment.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'points_on_dislike_comment.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'points_on_dislike_blog_comment.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'points_on_import_track.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'points_on_user_update_his_profile_picture.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'points_on_purchase_track.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'points_on_user_go_pro.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'points_on_review_some_one_track.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'points_on_report_some_one_track.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'points_on_report_comment.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'points_on_add_to_playlist.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'points_on_user_update_his_profile_cover.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'create_new_article');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'create_blog_bost');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'create_article_html');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'upload_file');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'upload_photo');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'success');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'article_saved_successfully');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'warning');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'stream_url_not_found.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'you_can_earn_points_and_transfer_them_to_your_wallet_by_doing_the_activities_below.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'login_or_register_to_start_earning_points_');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'point');",
];

$('#input_code').bind("paste keyup input propertychange", function(e) {
    if (isPurchaseCode($(this).val())) {
        $('#button-update').removeAttr('disabled');
    } else {
        $('#button-update').attr('disabled', 'true');
    }
});

function isPurchaseCode(str) {
    var patt = new RegExp("(.*)-(.*)-(.*)-(.*)-(.*)");
    var res = patt.test(str);
    if (res) {
        return true;
    }
    return false;
}

$(document).on('click', '#button-update', function(event) {
    if ($('body').attr('data-update') == 'true') {
        window.location.href = '<?php echo $site_url?>';
        return false;
    }
    $(this).attr('disabled', true);
    $('.wo_update_changelog').html('');
    $('.wo_update_changelog').css({
        background: '#1e2321',
        color: '#fff'
    });
    $('.setting-well h4').text('Updating..');
    $(this).attr('disabled', true);
    RunQuery();
});

var queriesLength = queries.length;
var query = queries[0];
var count = 0;
function b64EncodeUnicode(str) {
    // first we use encodeURIComponent to get percent-encoded UTF-8,
    // then we convert the percent encodings into raw bytes which
    // can be fed into btoa.
    return btoa(encodeURIComponent(str).replace(/%([0-9A-F]{2})/g,
        function toSolidBytes(match, p1) {
            return String.fromCharCode('0x' + p1);
    }));
}
function RunQuery() {
    var query = queries[count];
    $.post('?update', {
        query: b64EncodeUnicode(query)
    }, function(data, textStatus, xhr) {
        if (data.status == 200) {
            $('.wo_update_changelog').append('<li><span class="added">SUCCESS</span> ~$ mysql > ' + query + '</li>');
        } else {
            $('.wo_update_changelog').append('<li><span class="changed">FAILED</span> ~$ mysql > ' + query + '</li>');
        }
        count = count + 1;
        if (queriesLength > count) {
            setTimeout(function() {
                RunQuery();
            }, 1500);
        } else {
            $('.wo_update_changelog').append('<li><span class="added">Updating Langauges & Categories</span> ~$ languages.sh, Please wait, this might take some time..</li>');
            $.post('?run_lang', {
                update_langs: 'true'
            }, function(data, textStatus, xhr) {
              $('.wo_update_changelog').append('<li><span class="fixed">Finished!</span> ~$ Congratulations! you have successfully updated your site. Thanks for choosing DeepSound.</li>');
              $('.setting-well h4').text('Update Log');
              $('#button-update').html('Home <svg viewBox="0 0 19 14" xmlns="http://www.w3.org/2000/svg" width="18" height="18"> <path fill="currentColor" d="M18.6 6.9v-.5l-6-6c-.3-.3-.9-.3-1.2 0-.3.3-.3.9 0 1.2l5 5H1c-.5 0-.9.4-.9.9s.4.8.9.8h14.4l-4 4.1c-.3.3-.3.9 0 1.2.2.2.4.2.6.2.2 0 .4-.1.6-.2l5.2-5.2h.2c.5 0 .8-.4.8-.8 0-.3 0-.5-.2-.7z"></path> </svg>');
              $('#button-update').attr('disabled', false);
              $(".wo_update_changelog").scrollTop($(".wo_update_changelog")[0].scrollHeight);
              $('body').attr('data-update', 'true');
            });
        }
        $(".wo_update_changelog").scrollTop($(".wo_update_changelog")[0].scrollHeight);
    });
}
</script>