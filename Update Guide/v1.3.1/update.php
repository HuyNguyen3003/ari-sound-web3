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
            $lang_update_queries[] = PT_UpdateLangs($value, 'remove_song', 'إزالة الأغنية');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invalid_file_format__only_mp3__ogg__opus__oga__wav__and_mpeg_is_allowed', 'تنسيق ملف غير صالح ، يُسمح فقط بملفات mp3 و ogg و opus و oga و wav و mpeg');
            $lang_update_queries[] = PT_UpdateLangs($value, 'my_affiliates', 'الشركات التابعة لي');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_affiliate_link', 'رابط الانتساب الخاص بك');
            $lang_update_queries[] = PT_UpdateLangs($value, 'import_from', 'الاستيراد من');
            $lang_update_queries[] = PT_UpdateLangs($value, 'paste_your_url_above.', 'قم بلصق عنوان URL الخاص بك أعلاه.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_a_valid_link_to_import.', 'يرجى إدخال رابط صالح للاستيراد.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'import_sounds', 'استيراد الموسيقى');
            $lang_update_queries[] = PT_UpdateLangs($value, 'link_must_be_like_ex__https___music.apple.com_us_album_wolves_1445055015_i_1445055017', 'يجب أن يكون الرابط مثل EX: https://music.apple.com/us/album/wolves/1445055015؟i=1445055017');
            $lang_update_queries[] = PT_UpdateLangs($value, 'itunes_partner_token', 'الرمز المميز لشريك Itunes');
            $lang_update_queries[] = PT_UpdateLangs($value, 'listen_in_deezer', 'الاستماع في Deezer');
            $lang_update_queries[] = PT_UpdateLangs($value, 'type', 'نوع');
            $lang_update_queries[] = PT_UpdateLangs($value, 'banners_ads', 'إعلانات البانر');
            $lang_update_queries[] = PT_UpdateLangs($value, 'audio_ads', 'إعلانات صوتية');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_audio', 'حدد الصوت');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error_500_internal_server_error_', 'خطأ 500 - خطأ داخلي في المخدم!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_songs_found__add_new_songs.', 'لم يتم العثور على أغاني ، أضف أغاني جديدة.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'add_upload_folder', 'إضافة مجلد تحميل');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_folder', 'تحميل مجلد');
            $lang_update_queries[] = PT_UpdateLangs($value, 'playlist_single', 'قائمة التشغيل');
            $lang_update_queries[] = PT_UpdateLangs($value, 'drop_your_files', 'أفلت ملفاتك للتحميل');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invite_new_users', 'دعوة مستخدمين جدد.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'get_credits', 'احصل على قروض.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'to_skip_ad', 'لتخطي الإعلان');
            $lang_update_queries[] = PT_UpdateLangs($value, 'campaign_deleted_succ', 'تم حذف الحملة بنجاح.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'earn_up', 'اربح ما يصل إلى  {{PRICE}} لكل مستخدم تشير إليه!');
        } else if ($value == 'dutch') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'remove_song', 'Nummer verwijderen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invalid_file_format__only_mp3__ogg__opus__oga__wav__and_mpeg_is_allowed', 'Ongeldig bestandsformaat, alleen mp3, ogg, opus, oga, wav en mpeg zijn toegestaan');
            $lang_update_queries[] = PT_UpdateLangs($value, 'my_affiliates', 'Mijn partners');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_affiliate_link', 'Uw partnerlink');
            $lang_update_queries[] = PT_UpdateLangs($value, 'import_from', 'Importeren van');
            $lang_update_queries[] = PT_UpdateLangs($value, 'paste_your_url_above.', 'Plak hierboven uw URL.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_a_valid_link_to_import.', 'Voer een geldige link in om te importeren.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'import_sounds', 'Muziek importeren');
            $lang_update_queries[] = PT_UpdateLangs($value, 'link_must_be_like_ex__https___music.apple.com_us_album_wolves_1445055015_i_1445055017', 'Link moet als EX zijn: https://music.apple.com/us/album/wolves/1445055015?i=1445055017');
            $lang_update_queries[] = PT_UpdateLangs($value, 'itunes_partner_token', 'Itunes Partner Token');
            $lang_update_queries[] = PT_UpdateLangs($value, 'listen_in_deezer', 'Listen in Deezer');
            $lang_update_queries[] = PT_UpdateLangs($value, 'type', 'Type');
            $lang_update_queries[] = PT_UpdateLangs($value, 'banners_ads', 'Banners advertenties');
            $lang_update_queries[] = PT_UpdateLangs($value, 'audio_ads', 'Audio-advertenties');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_audio', 'Selecteer Audio');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error_500_internal_server_error_', 'Fout 500 - Interne Server Fout!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_songs_found__add_new_songs.', 'Geen nummers gevonden, voeg nieuwe nummers toe.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'add_upload_folder', 'Add Upload Folder');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_folder', 'Upload Folder');
            $lang_update_queries[] = PT_UpdateLangs($value, 'playlist_single', 'afspeellijst');
            $lang_update_queries[] = PT_UpdateLangs($value, 'drop_your_files', 'Zet uw bestanden neer om te uploaden');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invite_new_users', 'Nodig nieuwe gebruikers uit.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'get_credits', 'Ontvang credits.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'to_skip_ad', 'om advertentie over te slaan');
            $lang_update_queries[] = PT_UpdateLangs($value, 'campaign_deleted_succ', 'Campagne is verwijderd.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'earn_up', 'Verdien tot {{PRICE}} voor elke gebruiker die u naar ons verwijst!');
        } else if ($value == 'french') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'remove_song', 'Supprimer la chanson');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invalid_file_format__only_mp3__ogg__opus__oga__wav__and_mpeg_is_allowed', 'Format de fichier non valide, seuls les fichiers mp3, ogg, opus, oga, wav et mpeg sont autorisés');
            $lang_update_queries[] = PT_UpdateLangs($value, 'my_affiliates', 'Mes affiliés');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_affiliate_link', 'Votre lien d&#39;affiliation');
            $lang_update_queries[] = PT_UpdateLangs($value, 'import_from', 'Importer de');
            $lang_update_queries[] = PT_UpdateLangs($value, 'paste_your_url_above.', 'Collez votre URL ci-dessus.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_a_valid_link_to_import.', 'Veuillez saisir un lien valide pour importer.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'import_sounds', 'Importer de la musique');
            $lang_update_queries[] = PT_UpdateLangs($value, 'link_must_be_like_ex__https___music.apple.com_us_album_wolves_1445055015_i_1445055017', 'Le lien doit être comme EX: https://music.apple.com/us/album/wolves/1445055015?i=1445055017');
            $lang_update_queries[] = PT_UpdateLangs($value, 'itunes_partner_token', 'Jeton de partenaire Itunes');
            $lang_update_queries[] = PT_UpdateLangs($value, 'listen_in_deezer', 'Listen in Deezer');
            $lang_update_queries[] = PT_UpdateLangs($value, 'type', 'Type');
            $lang_update_queries[] = PT_UpdateLangs($value, 'banners_ads', 'Bannières publicitaires');
            $lang_update_queries[] = PT_UpdateLangs($value, 'audio_ads', 'Audio Ads');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_audio', 'Select Audio');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error_500_internal_server_error_', 'Erreur 500 - Erreur interne du serveur!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_songs_found__add_new_songs.', 'Aucune chanson trouvée, ajoutez de nouvelles chansons.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'add_upload_folder', 'Ajouter un dossier de téléchargement');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_folder', 'Télécharger le dossier');
            $lang_update_queries[] = PT_UpdateLangs($value, 'playlist_single', 'Playlist');
            $lang_update_queries[] = PT_UpdateLangs($value, 'drop_your_files', 'Déposez vos fichiers à télécharger');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invite_new_users', 'Invitez de nouveaux utilisateurs.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'get_credits', 'Obtenez des crédits.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'to_skip_ad', 'ignorer l&#39;annonce');
            $lang_update_queries[] = PT_UpdateLangs($value, 'campaign_deleted_succ', 'La campagne a bien été supprimée.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'earn_up', 'Gagnez jusqu&#39;à {{PRICE}} pour chaque utilisateur que vous nous référez!');
        } else if ($value == 'german') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'remove_song', 'Song entfernen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invalid_file_format__only_mp3__ogg__opus__oga__wav__and_mpeg_is_allowed', 'Ungültiges Dateiformat, nur MP3, Ogg, Opus, Oga, WAV und MPEG sind zulässig');
            $lang_update_queries[] = PT_UpdateLangs($value, 'my_affiliates', 'Meine Partner');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_affiliate_link', 'Ihr Affiliate-Link');
            $lang_update_queries[] = PT_UpdateLangs($value, 'import_from', 'Importieren von');
            $lang_update_queries[] = PT_UpdateLangs($value, 'paste_your_url_above.', 'Fügen Sie oben Ihre URL ein.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_a_valid_link_to_import.', 'Bitte geben Sie einen gültigen Link zum Importieren ein.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'import_sounds', 'Musik importieren');
            $lang_update_queries[] = PT_UpdateLangs($value, 'link_must_be_like_ex__https___music.apple.com_us_album_wolves_1445055015_i_1445055017', 'Der Link muss wie EX sein: https://music.apple.com/us/album/wolves/1445055015?i=1445055017');
            $lang_update_queries[] = PT_UpdateLangs($value, 'itunes_partner_token', 'Itunes Partner Token');
            $lang_update_queries[] = PT_UpdateLangs($value, 'listen_in_deezer', 'Listen in Deezer');
            $lang_update_queries[] = PT_UpdateLangs($value, 'type', 'Art');
            $lang_update_queries[] = PT_UpdateLangs($value, 'banners_ads', 'Bannerwerbung');
            $lang_update_queries[] = PT_UpdateLangs($value, 'audio_ads', 'Audio-Anzeigen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_audio', 'Wählen Sie Audio');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error_500_internal_server_error_', 'Fehler 500 - interner Server-Fehler!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_songs_found__add_new_songs.', 'Keine Songs gefunden, neue Songs hinzufügen.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'add_upload_folder', 'Upload-Ordner hinzufügen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_folder', 'Ordner hochladen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'playlist_single', 'Wiedergabeliste');
            $lang_update_queries[] = PT_UpdateLangs($value, 'drop_your_files', 'Legen Sie Ihre Dateien zum Hochladen ab');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invite_new_users', 'Neue Benutzer einladen.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'get_credits', 'Holen Sie sich Credits.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'to_skip_ad', 'Anzeige überspringen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'campaign_deleted_succ', 'Kampagne erfolgreich gelöscht.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'earn_up', 'Verdienen Sie bis zu {{PREIS}} für jeden Benutzer, den Sie an uns verweisen!');
        } else if ($value == 'russian') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'remove_song', 'Удалить песню');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invalid_file_format__only_mp3__ogg__opus__oga__wav__and_mpeg_is_allowed', 'Неверный формат файла, разрешены только mp3, ogg, opus, oga, wav и mpeg');
            $lang_update_queries[] = PT_UpdateLangs($value, 'my_affiliates', 'Мои филиалы');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_affiliate_link', 'Ваша партнерская ссылка');
            $lang_update_queries[] = PT_UpdateLangs($value, 'import_from', 'Импортировать из');
            $lang_update_queries[] = PT_UpdateLangs($value, 'paste_your_url_above.', 'Вставьте свой URL выше.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_a_valid_link_to_import.', 'Пожалуйста, введите действительную ссылку для импорта.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'import_sounds', 'Импорт музыки');
            $lang_update_queries[] = PT_UpdateLangs($value, 'link_must_be_like_ex__https___music.apple.com_us_album_wolves_1445055015_i_1445055017', 'Ссылка должна быть похожа на EX: https://music.apple.com/us/album/wolves/1445055015?i=1445055017');
            $lang_update_queries[] = PT_UpdateLangs($value, 'itunes_partner_token', 'Itunes Партнерский токен');
            $lang_update_queries[] = PT_UpdateLangs($value, 'listen_in_deezer', 'Слушай в Deezer');
            $lang_update_queries[] = PT_UpdateLangs($value, 'type', 'Тип');
            $lang_update_queries[] = PT_UpdateLangs($value, 'banners_ads', 'Баннеры Реклама');
            $lang_update_queries[] = PT_UpdateLangs($value, 'audio_ads', 'Аудиообъявления');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_audio', 'Выберите Аудио');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error_500_internal_server_error_', 'Ошибка 500 внутренняя ошибка сервера!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_songs_found__add_new_songs.', 'Песни не найдены, добавьте новые песни.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'add_upload_folder', 'Добавить папку загрузки');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_folder', 'Загрузить папку');
            $lang_update_queries[] = PT_UpdateLangs($value, 'playlist_single', 'Playlist');
            $lang_update_queries[] = PT_UpdateLangs($value, 'drop_your_files', 'Оставьте свои файлы для загрузки');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invite_new_users', 'Пригласите новых пользователей.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'get_credits', 'Получить кредиты.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'to_skip_ad', 'пропустить объявление');
            $lang_update_queries[] = PT_UpdateLangs($value, 'campaign_deleted_succ', 'Кампания успешно удалена.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'earn_up', 'Зарабатывайте до {{PRICE}} за каждого пользователя, которого вы обращаетесь к нам!');
        } else if ($value == 'spanish') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'remove_song', 'Eliminar canción');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invalid_file_format__only_mp3__ogg__opus__oga__wav__and_mpeg_is_allowed', 'Formato de archivo no válido, solo se permiten mp3, ogg, opus, oga, wav y mpeg');
            $lang_update_queries[] = PT_UpdateLangs($value, 'my_affiliates', 'Mis afiliados');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_affiliate_link', 'Su enlace de afiliado');
            $lang_update_queries[] = PT_UpdateLangs($value, 'import_from', 'Importar de');
            $lang_update_queries[] = PT_UpdateLangs($value, 'paste_your_url_above.', 'Pega tu URL arriba.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_a_valid_link_to_import.', 'Ingrese un enlace válido para importar.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'import_sounds', 'Importar música');
            $lang_update_queries[] = PT_UpdateLangs($value, 'link_must_be_like_ex__https___music.apple.com_us_album_wolves_1445055015_i_1445055017', 'El enlace debe ser como EX: https://music.apple.com/us/album/wolves/1445055015?i=1445055017');
            $lang_update_queries[] = PT_UpdateLangs($value, 'itunes_partner_token', 'Token de socio de iTunes');
            $lang_update_queries[] = PT_UpdateLangs($value, 'listen_in_deezer', 'Escucha en Deezer');
            $lang_update_queries[] = PT_UpdateLangs($value, 'type', 'Tipo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'banners_ads', 'Anuncios de Banners');
            $lang_update_queries[] = PT_UpdateLangs($value, 'audio_ads', 'Anuncios de audio');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_audio', 'Seleccionar audio');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error_500_internal_server_error_', '¡Error 500 - Error Interno del Servidor!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_songs_found__add_new_songs.', 'No se encontraron canciones, agregue nuevas canciones.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'add_upload_folder', 'Agregar carpeta de carga');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_folder', 'Subir carpeta');
            $lang_update_queries[] = PT_UpdateLangs($value, 'playlist_single', 'Lista de reproducción');
            $lang_update_queries[] = PT_UpdateLangs($value, 'drop_your_files', 'Suelta tus archivos para subir');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invite_new_users', 'Invita a nuevos usuarios.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'get_credits', 'Obtener créditos.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'to_skip_ad', 'Saltar anuncio');
            $lang_update_queries[] = PT_UpdateLangs($value, 'campaign_deleted_succ', 'Campaña eliminada con éxito.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'earn_up', '¡Gane hasta {{PRECIO}} por cada usuario que nos recomiende!');
        } else if ($value == 'turkish') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'remove_song', 'Şarkıyı Kaldır');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invalid_file_format__only_mp3__ogg__opus__oga__wav__and_mpeg_is_allowed', 'Geçersiz dosya biçimi, yalnızca mp3, ogg, opus, oga, wav ve mpeg&#39;e izin verilir');
            $lang_update_queries[] = PT_UpdateLangs($value, 'my_affiliates', 'Bağlı Kuruluşlarım');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_affiliate_link', 'Satış ortağı bağlantınız');
            $lang_update_queries[] = PT_UpdateLangs($value, 'import_from', 'Den ithal');
            $lang_update_queries[] = PT_UpdateLangs($value, 'paste_your_url_above.', 'URL&#39;nizi yukarıya yapıştırın.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_a_valid_link_to_import.', 'Lütfen içe aktarmak için geçerli bir bağlantı girin.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'import_sounds', 'Müziği İçe Aktar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'link_must_be_like_ex__https___music.apple.com_us_album_wolves_1445055015_i_1445055017', 'Bağlantı EX gibi olmalıdır: https://music.apple.com/us/album/wolves/1445055015?i=1445055017');
            $lang_update_queries[] = PT_UpdateLangs($value, 'itunes_partner_token', 'Itunes İş Ortağı Jetonu');
            $lang_update_queries[] = PT_UpdateLangs($value, 'listen_in_deezer', 'Deezer&#39;ı dinle');
            $lang_update_queries[] = PT_UpdateLangs($value, 'type', 'tip');
            $lang_update_queries[] = PT_UpdateLangs($value, 'banners_ads', 'Afiş Reklamları');
            $lang_update_queries[] = PT_UpdateLangs($value, 'audio_ads', 'Sesli Reklamlar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_audio', 'Ses Seçin');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error_500_internal_server_error_', 'Hata 500 - iç sunucu hatası!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_songs_found__add_new_songs.', 'Hiçbir şarkı bulunamadı, yeni şarkılar ekleyin.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'add_upload_folder', 'Yükleme Klasörü Ekle');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_folder', 'Klasörü Yükle');
            $lang_update_queries[] = PT_UpdateLangs($value, 'playlist_single', 'Oynatma Listesi');
            $lang_update_queries[] = PT_UpdateLangs($value, 'drop_your_files', 'Yüklemek için dosyalarınızı bırakın');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invite_new_users', 'Yeni Kullanıcılar davet edin.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'get_credits', 'Kredi Al.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'to_skip_ad', 'Reklamı Atlamak için');
            $lang_update_queries[] = PT_UpdateLangs($value, 'campaign_deleted_succ', 'Kampanya başarıyla silindi.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'earn_up', 'Bize referans verdiğiniz her kullanıcı için {{PRICE}} kazanın!');
        } else if ($value == 'english') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'remove_song', 'Remove Song');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invalid_file_format__only_mp3__ogg__opus__oga__wav__and_mpeg_is_allowed', 'Invalid file format, only mp3, ogg, opus, oga, wav, and mpeg is allowed');
            $lang_update_queries[] = PT_UpdateLangs($value, 'my_affiliates', 'My Affiliates');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_affiliate_link', 'Your affiliate link');
            $lang_update_queries[] = PT_UpdateLangs($value, 'import_from', 'Import From');
            $lang_update_queries[] = PT_UpdateLangs($value, 'paste_your_url_above.', 'Paste your URL above.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_a_valid_link_to_import.', 'Please enter a valid link to import.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'import_sounds', 'Import Music');
            $lang_update_queries[] = PT_UpdateLangs($value, 'link_must_be_like_ex__https___music.apple.com_us_album_wolves_1445055015_i_1445055017', 'Link must be like EX: https://music.apple.com/us/album/wolves/1445055015?i=1445055017');
            $lang_update_queries[] = PT_UpdateLangs($value, 'itunes_partner_token', 'Itunes Partner Token');
            $lang_update_queries[] = PT_UpdateLangs($value, 'listen_in_deezer', 'Listen in Deezer');
            $lang_update_queries[] = PT_UpdateLangs($value, 'type', 'Type');
            $lang_update_queries[] = PT_UpdateLangs($value, 'banners_ads', 'Banners Ads');
            $lang_update_queries[] = PT_UpdateLangs($value, 'audio_ads', 'Audio Ads');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_audio', 'Select Audio');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error_500_internal_server_error_', 'Error 500 internal server error!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_songs_found__add_new_songs.', 'No songs found, add new songs.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'add_upload_folder', 'Add Upload Folder');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_folder', 'Upload Folder');
            $lang_update_queries[] = PT_UpdateLangs($value, 'playlist_single', 'Playlist');
            $lang_update_queries[] = PT_UpdateLangs($value, 'drop_your_files', 'Drop your files to upload');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invite_new_users', 'Invite new Users.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'get_credits', 'Get Credits.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'to_skip_ad', 'to Skip Ad');
            $lang_update_queries[] = PT_UpdateLangs($value, 'campaign_deleted_succ', 'Campaign deleted successfully.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'earn_up', 'Earn up to {{PRICE}} for each user your refer to us!');
        } else if ($value != 'english') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'remove_song', 'Remove Song');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invalid_file_format__only_mp3__ogg__opus__oga__wav__and_mpeg_is_allowed', 'Invalid file format, only mp3, ogg, opus, oga, wav, and mpeg is allowed');
            $lang_update_queries[] = PT_UpdateLangs($value, 'my_affiliates', 'My Affiliates');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_affiliate_link', 'Your affiliate link');
            $lang_update_queries[] = PT_UpdateLangs($value, 'import_from', 'Import From');
            $lang_update_queries[] = PT_UpdateLangs($value, 'paste_your_url_above.', 'Paste your URL above.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_a_valid_link_to_import.', 'Please enter a valid link to import.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'import_sounds', 'Import Music');
            $lang_update_queries[] = PT_UpdateLangs($value, 'link_must_be_like_ex__https___music.apple.com_us_album_wolves_1445055015_i_1445055017', 'Link must be like EX: https://music.apple.com/us/album/wolves/1445055015?i=1445055017');
            $lang_update_queries[] = PT_UpdateLangs($value, 'itunes_partner_token', 'Itunes Partner Token');
            $lang_update_queries[] = PT_UpdateLangs($value, 'listen_in_deezer', 'Listen in Deezer');
            $lang_update_queries[] = PT_UpdateLangs($value, 'type', 'Type');
            $lang_update_queries[] = PT_UpdateLangs($value, 'banners_ads', 'Banners Ads');
            $lang_update_queries[] = PT_UpdateLangs($value, 'audio_ads', 'Audio Ads');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_audio', 'Select Audio');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error_500_internal_server_error_', 'Error 500 internal server error!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_songs_found__add_new_songs.', 'No songs found, add new songs.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'add_upload_folder', 'Add Upload Folder');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_folder', 'Upload Folder');
            $lang_update_queries[] = PT_UpdateLangs($value, 'playlist_single', 'Playlist');
            $lang_update_queries[] = PT_UpdateLangs($value, 'drop_your_files', 'Drop your files to upload');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invite_new_users', 'Invite new Users.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'get_credits', 'Get Credits.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'to_skip_ad', 'to Skip Ad');
            $lang_update_queries[] = PT_UpdateLangs($value, 'campaign_deleted_succ', 'Campaign deleted successfully.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'earn_up', 'Earn up to {{PRICE}} for each user your refer to us!');
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
                     <h2 class="light">Update to v1.3.1 </span></h2>
                     <div class="setting-well">
                        <h4>Changelog</h4>
                        <ul class="wo_update_changelog">
                            <li>[Added] the ability to add custom pages.</li>
                            <li>[Added] affiliate system .</li>
                            <li>[Added] ability to upload a folder to an album.</li>
                            <li>[Added] ability to set discover as landing page (enable/disable).</li>
                            <li>[Added] Itunes importer and Itunes affiliate system.</li>
                            <li>[Added] the ability to import songs from deezer.</li>
                            <li>[Added] audio ads, user can create ads in audio.</li>
                            <li>[Added] the option for admin to only upload.</li>
                            <li>[Added] the option for artists to only upload.</li>
                            <li>[Added] the ability to like blog comments.</li>
                            <li>[Added] more APIs</li>
                            <li>[Fixed] 30+ reported bugs.</li>
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
                           <p>Congratulations, you have successfully updated your site. Thanks for choosing WoWonder.</p>
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
    "UPDATE `config` SET value = '1.3.1' WHERE name = 'version';",
    "CREATE TABLE IF NOT EXISTS `blog_comments` (`id` int(11) NOT NULL,`article_id` int(11) NOT NULL DEFAULT '0',`user_id` int(11) NOT NULL DEFAULT '0',`value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,`time` int(11) NOT NULL DEFAULT '0') ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",
    "ALTER TABLE `blog_comments` ADD PRIMARY KEY (`id`), ADD KEY `track_id` (`article_id`), ADD KEY `user_id` (`user_id`);",
    "ALTER TABLE `blog_comments` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;",
    "CREATE TABLE IF NOT EXISTS `blog_likes` (`id` int(11) NOT NULL,`article_id` int(11) NOT NULL DEFAULT '0',`user_id` int(11) NOT NULL DEFAULT '0',`comment_id` int(11) unsigned NOT NULL DEFAULT '0',`time` int(11) NOT NULL DEFAULT '0') ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",
    "ALTER TABLE `blog_likes`ADD PRIMARY KEY (`id`),ADD KEY `article_id` (`article_id`),ADD KEY `user_id` (`user_id`),ADD KEY `time` (`time`);",
    "ALTER TABLE `blog_likes` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;",
    "ALTER TABLE `reports` ADD `mode` VARCHAR(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'track' AFTER `ignored`;",
    "CREATE TABLE `custompages` (`id` int(11) NOT NULL AUTO_INCREMENT,`page_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',`page_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',`page_content` text COLLATE utf8_unicode_ci,`page_type` int(11) NOT NULL DEFAULT '0',PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'affiliate_system', '0');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'affiliate_type', '0');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'amount_ref', '0.10');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'amount_percent_ref', '0');",
    "ALTER TABLE `users` CHANGE `balance` `balance` FLOAT(20) UNSIGNED NOT NULL DEFAULT '0';",
    "ALTER TABLE `users` ADD `referrer` INT(11) NOT NULL DEFAULT '0' AFTER `last_login_data`, ADD `ref_user_id` INT(11) NOT NULL DEFAULT '0' AFTER `referrer`;",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'discover_land', '0');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'itunes_import', 'on');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'itunes_affiliate', 'admin');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'itunes_partner_token', '');",
    "ALTER TABLE `songs` ADD `itunes_token` VARCHAR(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' AFTER `src`;",
    "ALTER TABLE `songs` ADD INDEX(`itunes_token`);",
    "ALTER TABLE `songs` ADD `itunes_affiliate_url` VARCHAR(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' AFTER `itunes_token`;",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'deezer_import', 'off');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'audio_ads', 'on');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'who_audio_ads', 'users');",
    "ALTER TABLE `user_ads` ADD `ad_type` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'image' AFTER `day_spend`;",
    "ALTER TABLE `user_ads` ADD `audio_media` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' AFTER `media`;",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'who_can_upload', 'all');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'android_n_push_id', '');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'android_n_push_key', '');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'ios_n_push_id', '');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'ios_n_push_key', '');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'web_push_id', '');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'web_push_key', '');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'remove_song');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'invalid_file_format__only_mp3__ogg__opus__oga__wav__and_mpeg_is_allowed');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'remove_song');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'invalid_file_format__only_mp3__ogg__opus__oga__wav__and_mpeg_is_allowed');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'my_affiliates');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'your_affiliate_link');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'import_from');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'paste_your_url_above.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'please_enter_a_valid_link_to_import.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'import_sounds');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'link_must_be_like_ex__https___music.apple.com_us_album_wolves_1445055015_i_1445055017');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'itunes_partner_token');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'listen_in_deezer');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'type');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'banners_ads');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'audio_ads');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'select_audio');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'error_500_internal_server_error_');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'no_songs_found__add_new_songs.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'add_upload_folder');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'upload_folder');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'playlist_single');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'drop_your_files');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'invite_new_users');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'get_credits');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'to_skip_ad');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'campaign_deleted_succ');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'earn_up');",
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