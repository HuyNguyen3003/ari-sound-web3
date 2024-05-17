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
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_users_found', 'لم يتم العثور على المستخدمين');
            $lang_update_queries[] = PT_UpdateLangs($value, 'show_only_in_track_page', 'تظهر فقط في صفحة المسار');
            $lang_update_queries[] = PT_UpdateLangs($value, 'show_on_all_pages', 'عرض في كل الصفحات');
            $lang_update_queries[] = PT_UpdateLangs($value, 'edit_spotlight', 'تحرير الأضواء');
            $lang_update_queries[] = PT_UpdateLangs($value, 'blog', 'مدونة');
            $lang_update_queries[] = PT_UpdateLangs($value, '1309', 'كوميديا');
            $lang_update_queries[] = PT_UpdateLangs($value, '1310', 'السيارات والمركبات');
            $lang_update_queries[] = PT_UpdateLangs($value, '1311', 'الاقتصاد والتجارة');
            $lang_update_queries[] = PT_UpdateLangs($value, '1312', 'التعليم');
            $lang_update_queries[] = PT_UpdateLangs($value, '1313', 'وسائل الترفيه');
            $lang_update_queries[] = PT_UpdateLangs($value, '1314', 'أفلام');
            $lang_update_queries[] = PT_UpdateLangs($value, '1315', 'الألعاب');
            $lang_update_queries[] = PT_UpdateLangs($value, '1316', 'التاريخ والحقائق');
            $lang_update_queries[] = PT_UpdateLangs($value, '1317', 'نمط الحياة');
            $lang_update_queries[] = PT_UpdateLangs($value, '1318', 'طبيعي >> صفة');
            $lang_update_queries[] = PT_UpdateLangs($value, '1319', 'الأخبار والسياسة');
            $lang_update_queries[] = PT_UpdateLangs($value, '1320', 'الناس والأمم');
            $lang_update_queries[] = PT_UpdateLangs($value, '1321', 'الحيوانات الأليفة والحيوانات');
            $lang_update_queries[] = PT_UpdateLangs($value, '1322', 'الأماكن والمناطق');
            $lang_update_queries[] = PT_UpdateLangs($value, '1323', 'العلوم والتكنولوجيا');
            $lang_update_queries[] = PT_UpdateLangs($value, '1324', 'رياضة');
            $lang_update_queries[] = PT_UpdateLangs($value, '1325', 'السفر والأحداث');
            $lang_update_queries[] = PT_UpdateLangs($value, '1326', 'آخر');
            $lang_update_queries[] = PT_UpdateLangs($value, 'read_more', 'اقرأ أكثر');
            $lang_update_queries[] = PT_UpdateLangs($value, 'categories', 'الاقسام');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_more_articles_to_show.', 'لا مزيد من المقالات لإظهارها.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'article', 'مقالة - سلعة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'share_to', 'حصة ل');
            $lang_update_queries[] = PT_UpdateLangs($value, 'blogs', 'المدونات');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_more_articles', 'لا مزيد من المقالات لإظهارها');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_more_article_found', 'لم يتم العثور على المزيد من المقالات');
            $lang_update_queries[] = PT_UpdateLangs($value, 'delete_song', 'حذف أغنية');
            $lang_update_queries[] = PT_UpdateLangs($value, 'delete_this_song_from_playlist', 'إزالة من قائمة التشغيل');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_song_description', 'الرجاء إدخال وصف الأغنية');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_song_tags', 'الرجاء إدخال علامات الأغنية');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_upload_song_thumbnail', 'يرجى تحميل صورة مصغرة للأغنية');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_have_reached_your_upload_limit__upgrade_to_upload_unlimited_songs.', 'لقد وصلت إلى الحد الأقصى للتحميل ، قم بالترقية لتحميل الأغاني غير المحدودة.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'advertising', 'إعلان');
            $lang_update_queries[] = PT_UpdateLangs($value, 'wallet', 'محفظة نقود');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_ad', 'حملة جديدة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'category', 'الفئة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'results', 'النتائج');
            $lang_update_queries[] = PT_UpdateLangs($value, 'spent', 'أنفق');
            $lang_update_queries[] = PT_UpdateLangs($value, 'action', 'عمل');
            $lang_update_queries[] = PT_UpdateLangs($value, '2checkout', '2Checkout');
            $lang_update_queries[] = PT_UpdateLangs($value, 'address', 'عنوان');
            $lang_update_queries[] = PT_UpdateLangs($value, 'city', 'مدينة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'state', 'حالة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'zip', 'الرمز البريدي');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone_number', 'رقم الهاتف');
            $lang_update_queries[] = PT_UpdateLangs($value, 'card_number', 'رقم البطاقة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay', 'دفع');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replenish', 'ملئ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_check_the_details', 'يرجى التحقق من التفاصيل');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirmation', 'التأكيد');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_to_delete_this_ad_', 'هل أنت متأكد أنك تريد حذف هذه الحملة؟');
            $lang_update_queries[] = PT_UpdateLangs($value, 'deleted', 'تم الحذف');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_check_details', 'please_check_details');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirming_your_payment__please_wait..', 'تأكيد الدفع الخاص بك ، يرجى الانتظار ..');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment_declined__please_try_again_later.', 'تم رفض الدفع ، يرجى المحاولة مرة أخرى لاحقًا.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'my_balance', 'رصيدي');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replenish_my_balance', 'تجديد رصيدي');
            $lang_update_queries[] = PT_UpdateLangs($value, 'browse_to_upload', 'استعرض لتحميل');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_advertising', 'حملة جديدة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_new_ad', 'إنشاء حملة جديدة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_current_wallet_balance_is__0__please_top_up_your_wallet_to_continue.', 'رصيد محفظتك الحالي هو 0 ، يرجى تعبئة محفظتك للمتابعة.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'top_up', 'فوق حتى');
            $lang_update_queries[] = PT_UpdateLangs($value, 'url', 'URL');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_media', 'اختر الوسائط');
            $lang_update_queries[] = PT_UpdateLangs($value, 'target_audience', 'الجمهور المستهدف');
            $lang_update_queries[] = PT_UpdateLangs($value, 'placement', 'تحديد مستوى');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pricing', 'التسعير');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay_per_click', 'تدفع عن كل نقرة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay_per_impression', 'الدفع لكل مرة ظهور');
            $lang_update_queries[] = PT_UpdateLangs($value, 'spending_limit_per_day', 'حد الإنفاق في اليوم');
            $lang_update_queries[] = PT_UpdateLangs($value, 'media_file_is_invalid._please_select_a_valid_image', 'ملف الوسائط غير صالح. يرجى اختيار صورة صالحة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error_', 'خطأ!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'file_is_too_big__max_upload_size_is', 'الملف كبير جدًا ، الحد الأقصى لحجم التحميل هو');
            $lang_update_queries[] = PT_UpdateLangs($value, 'media_file_is_invalid._please_select_a_valid_image___video', 'ملف الوسائط غير صالح. يرجى اختيار صورة / فيديو صالح');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_ad_has_been_published_successfully', 'تم نشر حملتك بنجاح.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'the_url_is_invalid._please_enter_a_valid_url', 'عنوان URL غير صالح. أدخل رابط صحيح من فضلك.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ad_title_must_be_between_5_100', 'يجب أن يتراوح عنوان الحملة بين 5/100.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'edit_ad', 'تحرير الحملة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_changes_to_the_ad_were_successfully_saved', 'تم حفظ تغييراتك على الحملة بنجاح.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'name_must_be_between_5_32', 'يجب أن يكون الاسم بين 5/32');
            $lang_update_queries[] = PT_UpdateLangs($value, 'clicks', 'نقرات');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ads_analytics', 'تحليلات الحملة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'this_year', 'هذه السنة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'view_report', 'عرض التقرير');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ad_analytics', 'تحليلات الحملة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'sponsor_ads', 'كفيل');
            $lang_update_queries[] = PT_UpdateLangs($value, 'by', 'بواسطة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'import', 'استيراد');
            $lang_update_queries[] = PT_UpdateLangs($value, 'import_from_soundcloud.', 'استيراد من SoundCloud.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'enter_the_soundcloud_track_link_and_click_the_button_below.', 'الصق عنوان URL الخاص بـ SoundCloud أعلاه.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error_found_while_importing_your_track__please_try_again_later.', 'تم العثور على خطأ أثناء استيراد المسار ، يرجى المحاولة مرة أخرى لاحقًا.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_valid_soundcloud_track_url.', 'يرجى إدخال عنوان URL صالح لبرنامج SoundCloud.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_soundcloud_track_link_to_import.', 'الرجاء إدخال رابط مسار SoundCloud للاستيراد.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error_found_while_importing_your_track__please_check_soundcloud_client_id.', 'تم العثور على خطأ أثناء استيراد المسار الخاص بك ، يرجى التحقق من معرف عميل SoundCloud.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'dmca', 'DMCA');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_soundcloud', 'تسجيل الدخول مع SoundCloud');
            $lang_update_queries[] = PT_UpdateLangs($value, 'dcma', 'DCMA');
            $lang_update_queries[] = PT_UpdateLangs($value, 'move_to_album', 'الانتقال إلى ألبوم');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_albums', 'اختر ألبومات');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_select_which_album_you_want_to_add_this_song_to.', 'الرجاء تحديد الألبوم الذي تريد إضافة هذه الأغنية إليه.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'review_track', 'مراجعة المسار');
            $lang_update_queries[] = PT_UpdateLangs($value, 'review', 'إعادة النظر');
            $lang_update_queries[] = PT_UpdateLangs($value, 'review_track.', 'مراجعة المسار.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_your_review.', 'الرجاء إدخال رأيك.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'thanks_for_your_submission.', 'شكرا لتقديمك.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'reviews', 'التعليقات');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_reviews_on_this_track_yet.', 'ليست هناك أي تعليقات على هذا المسار بعد.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_new_track.', 'تحميل مسار جديد.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'notification', 'إعلام');
            $lang_update_queries[] = PT_UpdateLangs($value, 'notification_settings', 'إعدادات الإشعار');
            $lang_update_queries[] = PT_UpdateLangs($value, 'someone_followed_me', 'شخص ما تبعني');
            $lang_update_queries[] = PT_UpdateLangs($value, 'someone_liked_one_of_my_tracks', 'شخص ما أحب أحد مساراتي');
            $lang_update_queries[] = PT_UpdateLangs($value, 'someone_liked_one_of_my_comments', 'شخص ما أحب أحد تعليقاتي');
            $lang_update_queries[] = PT_UpdateLangs($value, 'approve_disapprove_artist_request', 'قبول / رفض طلب (طلبات) الفنان');
            $lang_update_queries[] = PT_UpdateLangs($value, 'approve_disapprove_bank_payment_request', 'الموافقة / رفض طلب (طلبات) الدفع المصرفي');
            $lang_update_queries[] = PT_UpdateLangs($value, 'one_of_my_following_upload_new_track', 'قام أحد الفنانين التابعين لي بتحميل مسار جديد');
            $lang_update_queries[] = PT_UpdateLangs($value, 'one_of_my_following_users_upload_new_track', 'قام أحد الفنانين التابعين لي بتحميل مسار جديد');
            $lang_update_queries[] = PT_UpdateLangs($value, 'notify_me_when', 'قم بتنبيهي عندما');
            $lang_update_queries[] = PT_UpdateLangs($value, 'new_notification', 'إشعار جديد');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_can_not_import_this_track_because_this_track_is_imported_before.', 'تم استيراد هذا المسار بالفعل ، يرجى اختيار مسار آخر.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'manage_sessions', 'إدارة الجلسات');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ip_address', 'عنوان IP');
            $lang_update_queries[] = PT_UpdateLangs($value, 'platform', 'برنامج');
            $lang_update_queries[] = PT_UpdateLangs($value, 'browser', 'المتصفح');
            $lang_update_queries[] = PT_UpdateLangs($value, 'last_seen', 'اخر ظهور');
            $lang_update_queries[] = PT_UpdateLangs($value, 'actions', 'أفعال');
            $lang_update_queries[] = PT_UpdateLangs($value, 'session_expired', 'انتهت الجلسة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_session_has_been_expired__please_login_again.', 'انتهت جلستك ، يرجى تسجيل الدخول مرة أخرى.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'two-factor_authentication', 'توثيق ذو عاملين');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone', 'هاتف');
            $lang_update_queries[] = PT_UpdateLangs($value, 'enable', 'مكن');
            $lang_update_queries[] = PT_UpdateLangs($value, 'disable', 'تعطيل');
            $lang_update_queries[] = PT_UpdateLangs($value, 'turn_on_2-step_login_to_level-up_your_account_s_security__once_turned_on__you_ll_use_both_your_password_and_a_6-digit_security_code_sent_to_your_phone_or_email_to_log_in.', 'قم بتشغيل تسجيل الدخول من خطوتين لتحسين مستوى حسابك');
            $lang_update_queries[] = PT_UpdateLangs($value, 'a_confirmation_email_has_been_sent.', 'تم إرسال رسالة تأكيد بالبريد الإلكتروني.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_an_email_that_contains_the_confirmation_code_to_enable_two-factor_authentication.', 'لقد أرسلنا رسالة بريد إلكتروني تحتوي على رمز التأكيد لتمكين المصادقة الثنائية.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirmation_code', 'رمز التأكيد');
            $lang_update_queries[] = PT_UpdateLangs($value, 'a_confirmation_message_and_email_were_sent.', 'تم إرسال رسالة تأكيد والبريد الإلكتروني.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_a_message_and_an_email_that_contain_the_confirmation_code_to_enable_two-factor_authentication', 'لقد أرسلنا رسالة ورسالة بريد إلكتروني تحتوي على رمز التأكيد لتمكين المصادقة الثنائية');
            $lang_update_queries[] = PT_UpdateLangs($value, 'a_confirmation_message_was_sent.', 'تم إرسال رسالة تأكيد.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_a_message_that_contains_the_confirmation_code_to_enable_two-factor_authentication.', 'لقد أرسلنا رسالة تحتوي على رمز التأكيد لتمكين المصادقة الثنائية.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_you_an_email_with_the_confirmation_code.', 'لقد أرسلنا لك رسالة بريد إلكتروني مع رمز التأكيد.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'wrong_confirmation_code.', 'رمز التأكيد الخاطئ.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_e-mail_has_been_successfully_verified.', 'تم التحقق من بريدك الإلكتروني بنجاح.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'unusual_login', 'تسجيل دخول غير عادي');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_you_the_confirmation_code_to_your_email_address.', 'لقد أرسلنا لك رمز التأكيد إلى عنوان بريدك الإلكتروني.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'to_log_in__you_need_to_verify_your_identity.', 'لتسجيل الدخول ، تحتاج إلى التحقق من هويتك.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'welcome...', 'مرحبا بعودتك!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'stations', 'محطات');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_stations_found', 'لا توجد محطات');
            $lang_update_queries[] = PT_UpdateLangs($value, 'add_station', 'إضافة محطة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'search_for_stations', 'البحث عن المحطات');
            $lang_update_queries[] = PT_UpdateLangs($value, 'station_search.', 'محطة البحث.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_more_than_3_characters.', 'الرجاء إدخال أكثر من 3 أحرف.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error_found_while_search_stations__please_try_again_later.', 'تم العثور على خطأ أثناء محطات البحث ، يرجى المحاولة مرة أخرى لاحقًا.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_already_add_this_station.', 'قمت بالفعل بإضافة هذه المحطة.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'delete_station', 'حذف المحطة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_more_stations_found', 'لم يتم العثور على المزيد من المحطات');
            $lang_update_queries[] = PT_UpdateLangs($value, 'the_track_has_been_moved_to_this_album_successfully.', 'تم نقل المسار إلى الألبوم التالي.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'someone_liked_disliked_one_of_my_tracks', 'شخص ما أحب / لم يعجبني أحد مساراتي');
            $lang_update_queries[] = PT_UpdateLangs($value, 'disliked_your_song.', 'لم يعجبك أغنيتك.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'reviewed_your_song.', 'استعرض أغنيتك.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'someone_reviewed_one_of_my_tracks', 'شخص ما استعرض أحد مساراتي');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_can_not_import_this_track_because_this_track_is_one_of_soundcloud_go__tracks.', 'لا يمكنك استيراد هذا المسار لأن هذا المسار هو أحد مسارات SoundCloud Go.');
        } else if ($value == 'dutch') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_users_found', 'Geen gebruikers gevonden');
            $lang_update_queries[] = PT_UpdateLangs($value, 'show_only_in_track_page', 'Alleen weergeven op trackpagina');
            $lang_update_queries[] = PT_UpdateLangs($value, 'show_on_all_pages', 'Weergeven op alle pagina\'s');
            $lang_update_queries[] = PT_UpdateLangs($value, 'edit_spotlight', 'Spotlight bewerken');
            $lang_update_queries[] = PT_UpdateLangs($value, 'blog', 'blog');
            $lang_update_queries[] = PT_UpdateLangs($value, '1309', 'Komedie');
            $lang_update_queries[] = PT_UpdateLangs($value, '1310', 'Auto\'s en voertuigen');
            $lang_update_queries[] = PT_UpdateLangs($value, '1311', 'Economie en handel');
            $lang_update_queries[] = PT_UpdateLangs($value, '1312', 'Opleiding');
            $lang_update_queries[] = PT_UpdateLangs($value, '1313', 'vermaak');
            $lang_update_queries[] = PT_UpdateLangs($value, '1314', 'Films');
            $lang_update_queries[] = PT_UpdateLangs($value, '1315', 'gaming');
            $lang_update_queries[] = PT_UpdateLangs($value, '1316', 'Geschiedenis en feiten');
            $lang_update_queries[] = PT_UpdateLangs($value, '1317', 'Levensstijl');
            $lang_update_queries[] = PT_UpdateLangs($value, '1318', 'natuurlijk');
            $lang_update_queries[] = PT_UpdateLangs($value, '1319', 'Nieuws en politiek');
            $lang_update_queries[] = PT_UpdateLangs($value, '1320', 'Mensen en naties');
            $lang_update_queries[] = PT_UpdateLangs($value, '1321', 'Huisdieren en dieren');
            $lang_update_queries[] = PT_UpdateLangs($value, '1322', 'Plaatsen en regio\'s');
            $lang_update_queries[] = PT_UpdateLangs($value, '1323', 'Wetenschap en technologie');
            $lang_update_queries[] = PT_UpdateLangs($value, '1324', 'Sport');
            $lang_update_queries[] = PT_UpdateLangs($value, '1325', 'Reizen en evenementen');
            $lang_update_queries[] = PT_UpdateLangs($value, '1326', 'anders');
            $lang_update_queries[] = PT_UpdateLangs($value, 'read_more', 'Lees verder');
            $lang_update_queries[] = PT_UpdateLangs($value, 'categories', 'Categorieën');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_more_articles_to_show.', 'Geen artikelen meer om te tonen.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'article', 'Artikel');
            $lang_update_queries[] = PT_UpdateLangs($value, 'share_to', 'Delen naar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'blogs', 'blogs');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_more_articles', 'Geen artikelen meer om te tonen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_more_article_found', 'Geen artikelen meer gevonden');
            $lang_update_queries[] = PT_UpdateLangs($value, 'delete_song', 'Nummer verwijderen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'delete_this_song_from_playlist', 'Verwijderen uit afspeellijst');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_song_description', 'Voer de nummerbeschrijving in');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_song_tags', 'Voer de tags van het nummer in');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_upload_song_thumbnail', 'Upload een miniatuur van het nummer');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_have_reached_your_upload_limit__upgrade_to_upload_unlimited_songs.', 'Je hebt je uploadlimiet bereikt, upgrade om onbeperkte nummers te uploaden.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'advertising', 'Advertising');
            $lang_update_queries[] = PT_UpdateLangs($value, 'wallet', 'Portemonnee');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_ad', 'Nieuwe campagne');
            $lang_update_queries[] = PT_UpdateLangs($value, 'category', 'Categorie');
            $lang_update_queries[] = PT_UpdateLangs($value, 'results', 'resultaten');
            $lang_update_queries[] = PT_UpdateLangs($value, 'spent', 'besteed');
            $lang_update_queries[] = PT_UpdateLangs($value, 'action', 'Actie');
            $lang_update_queries[] = PT_UpdateLangs($value, '2checkout', '2Checkout');
            $lang_update_queries[] = PT_UpdateLangs($value, 'address', 'Adres');
            $lang_update_queries[] = PT_UpdateLangs($value, 'city', 'stad');
            $lang_update_queries[] = PT_UpdateLangs($value, 'state', 'Staat');
            $lang_update_queries[] = PT_UpdateLangs($value, 'zip', 'ritssluiting');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone_number', 'Telefoonnummer');
            $lang_update_queries[] = PT_UpdateLangs($value, 'card_number', 'Kaartnummer');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay', 'Betalen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replenish', 'Replenish');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_check_the_details', 'Controleer de details');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirmation', 'Bevestiging');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_to_delete_this_ad_', 'Weet u zeker dat u deze campagne wilt verwijderen?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'deleted', 'verwijderde');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_check_details', 'please_check_details');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirming_your_payment__please_wait..', 'Bevestiging van uw betaling, even geduld aub ..');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment_declined__please_try_again_later.', 'Betaling geweigerd, probeer het later opnieuw.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'my_balance', 'Mijn balans');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replenish_my_balance', 'Vul mijn saldo aan');
            $lang_update_queries[] = PT_UpdateLangs($value, 'browse_to_upload', 'Bladeren om te uploaden');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_advertising', 'Nieuwe campagne');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_new_ad', 'Maak een nieuwe campagne');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_current_wallet_balance_is__0__please_top_up_your_wallet_to_continue.', 'Uw huidige portemonnee-saldo is 0, vul uw portemonnee aan om door te gaan.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'top_up', 'Bijvullen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'url', 'URL');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_media', 'Selecteer media');
            $lang_update_queries[] = PT_UpdateLangs($value, 'target_audience', 'Doelgroep');
            $lang_update_queries[] = PT_UpdateLangs($value, 'placement', 'Plaatsing');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pricing', 'pricing');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay_per_click', 'Betaal per klik');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay_per_impression', 'Betaal per vertoning');
            $lang_update_queries[] = PT_UpdateLangs($value, 'spending_limit_per_day', 'Bestedingslimiet per dag');
            $lang_update_queries[] = PT_UpdateLangs($value, 'media_file_is_invalid._please_select_a_valid_image', 'Mediabestand is ongeldig. Selecteer een geldige afbeelding');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error_', 'Fout!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'file_is_too_big__max_upload_size_is', 'Bestand is te groot, maximale uploadgrootte is');
            $lang_update_queries[] = PT_UpdateLangs($value, 'media_file_is_invalid._please_select_a_valid_image___video', 'Mediabestand is ongeldig. Selecteer een geldige afbeelding / video');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_ad_has_been_published_successfully', 'Uw campagne is succesvol gepubliceerd.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'the_url_is_invalid._please_enter_a_valid_url', 'De URL is ongeldig. Voer een geldige URL in.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ad_title_must_be_between_5_100', 'Campagnetitel moet tussen 5/100 liggen.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'edit_ad', 'Campagne bewerken');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_changes_to_the_ad_were_successfully_saved', 'Uw wijzigingen in de campagne zijn succesvol opgeslagen.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'name_must_be_between_5_32', 'Naam moet tussen 5/32 zijn');
            $lang_update_queries[] = PT_UpdateLangs($value, 'clicks', 'klikken');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ads_analytics', 'Campagne-analyse');
            $lang_update_queries[] = PT_UpdateLangs($value, 'this_year', 'Dit jaar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'view_report', 'Bekijk rapport');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ad_analytics', 'Campagne-analyse');
            $lang_update_queries[] = PT_UpdateLangs($value, 'sponsor_ads', 'SPONSOR');
            $lang_update_queries[] = PT_UpdateLangs($value, 'by', 'Door');
            $lang_update_queries[] = PT_UpdateLangs($value, 'import', 'Importeren');
            $lang_update_queries[] = PT_UpdateLangs($value, 'import_from_soundcloud.', 'Importeren vanuit SoundCloud.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'enter_the_soundcloud_track_link_and_click_the_button_below.', 'Plak hierboven uw SoundCloud-URL.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error_found_while_importing_your_track__please_try_again_later.', 'Er is een fout gevonden tijdens het importeren van uw track. Probeer het later opnieuw.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_valid_soundcloud_track_url.', 'Voer een geldige SoundCloud-track-URL in.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_soundcloud_track_link_to_import.', 'Voer de SoundCloud-tracklink in om te importeren.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error_found_while_importing_your_track__please_check_soundcloud_client_id.', 'Fout gevonden bij het importeren van uw track, controleer SoundCloud-client-ID.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'dmca', 'DMCA');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_soundcloud', 'Inloggen met SoundCloud');
            $lang_update_queries[] = PT_UpdateLangs($value, 'dcma', 'DCMA');
            $lang_update_queries[] = PT_UpdateLangs($value, 'move_to_album', 'Ga naar een album');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_albums', 'Selecteer albums');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_select_which_album_you_want_to_add_this_song_to.', 'Selecteer aan welk album u dit nummer wilt toevoegen.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'review_track', 'Beoordeling bijhouden');
            $lang_update_queries[] = PT_UpdateLangs($value, 'review', 'Recensie');
            $lang_update_queries[] = PT_UpdateLangs($value, 'review_track.', 'Review track.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_your_review.', 'Voer uw beoordeling in.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'thanks_for_your_submission.', 'Bedankt voor uw inzending.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'reviews', 'beoordelingen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_reviews_on_this_track_yet.', 'Nog geen beoordelingen op dit nummer.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_new_track.', 'upload nieuw nummer.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'notification', 'Kennisgeving');
            $lang_update_queries[] = PT_UpdateLangs($value, 'notification_settings', 'Notificatie instellingen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'someone_followed_me', 'Iemand volgde mij');
            $lang_update_queries[] = PT_UpdateLangs($value, 'someone_liked_one_of_my_tracks', 'Iemand vond een van mijn nummers leuk');
            $lang_update_queries[] = PT_UpdateLangs($value, 'someone_liked_one_of_my_comments', 'Iemand vond een van mijn opmerkingen leuk');
            $lang_update_queries[] = PT_UpdateLangs($value, 'approve_disapprove_artist_request', 'Verzoek / aanvragen kunstenaar goedkeuren / afkeuren');
            $lang_update_queries[] = PT_UpdateLangs($value, 'approve_disapprove_bank_payment_request', 'Verzoek / bankverzoek (en) goedkeuren / afkeuren');
            $lang_update_queries[] = PT_UpdateLangs($value, 'one_of_my_following_upload_new_track', 'Een van mijn volgende artiesten heeft een nieuw nummer geüpload');
            $lang_update_queries[] = PT_UpdateLangs($value, 'one_of_my_following_users_upload_new_track', 'Een van mijn volgende artiesten heeft een nieuw nummer geüpload');
            $lang_update_queries[] = PT_UpdateLangs($value, 'notify_me_when', 'Laat me weten wanneer');
            $lang_update_queries[] = PT_UpdateLangs($value, 'new_notification', 'Nieuwe melding');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_can_not_import_this_track_because_this_track_is_imported_before.', 'Deze track is al geïmporteerd, kies een andere track.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'manage_sessions', 'Sessies beheren');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ip_address', 'IP adres');
            $lang_update_queries[] = PT_UpdateLangs($value, 'platform', 'Platform');
            $lang_update_queries[] = PT_UpdateLangs($value, 'browser', 'browser');
            $lang_update_queries[] = PT_UpdateLangs($value, 'last_seen', 'Laatst gezien');
            $lang_update_queries[] = PT_UpdateLangs($value, 'actions', 'acties');
            $lang_update_queries[] = PT_UpdateLangs($value, 'session_expired', 'Sessie verlopen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_session_has_been_expired__please_login_again.', 'Uw sessie is verlopen, log opnieuw in.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'two-factor_authentication', 'Twee-factor authenticatie');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone', 'Telefoon');
            $lang_update_queries[] = PT_UpdateLangs($value, 'enable', 'in staat stellen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'disable', 'uitschakelen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'turn_on_2-step_login_to_level-up_your_account_s_security__once_turned_on__you_ll_use_both_your_password_and_a_6-digit_security_code_sent_to_your_phone_or_email_to_log_in.', 'Schakel inloggen in twee stappen in om uw account een hoger niveau te geven');
            $lang_update_queries[] = PT_UpdateLangs($value, 'a_confirmation_email_has_been_sent.', 'Er is een bevestigingsmail verzonden.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_an_email_that_contains_the_confirmation_code_to_enable_two-factor_authentication.', 'We hebben een e-mail verzonden met de bevestigingscode om tweefactorauthenticatie in te schakelen.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirmation_code', 'Bevestigingscode');
            $lang_update_queries[] = PT_UpdateLangs($value, 'a_confirmation_message_and_email_were_sent.', 'Een bevestigingsbericht en e-mail zijn verzonden.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_a_message_and_an_email_that_contain_the_confirmation_code_to_enable_two-factor_authentication', 'We hebben een bericht en een e-mail verzonden met de bevestigingscode om tweefactorauthenticatie mogelijk te maken');
            $lang_update_queries[] = PT_UpdateLangs($value, 'a_confirmation_message_was_sent.', 'Er is een bevestigingsbericht verzonden.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_a_message_that_contains_the_confirmation_code_to_enable_two-factor_authentication.', 'We hebben een bericht verzonden met de bevestigingscode om tweefactorauthenticatie in te schakelen.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_you_an_email_with_the_confirmation_code.', 'We hebben je een e-mail gestuurd met de bevestigingscode.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'wrong_confirmation_code.', 'Verkeerde bevestigingscode.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_e-mail_has_been_successfully_verified.', 'Uw e-mail is succesvol geverifieerd.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'unusual_login', 'Ongebruikelijke login');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_you_the_confirmation_code_to_your_email_address.', 'We hebben u de bevestigingscode naar uw e-mailadres gestuurd.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'to_log_in__you_need_to_verify_your_identity.', 'Om in te loggen, moet u uw identiteit verifiëren.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'welcome...', 'Welkom terug!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'stations', 'stations');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_stations_found', 'Geen zenders gevonden');
            $lang_update_queries[] = PT_UpdateLangs($value, 'add_station', 'Station toevoegen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'search_for_stations', 'Zoeken naar zenders');
            $lang_update_queries[] = PT_UpdateLangs($value, 'station_search.', 'Zender zoeken.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_more_than_3_characters.', 'Voer meer dan 3 tekens in.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error_found_while_search_stations__please_try_again_later.', 'Fout gevonden tijdens het zoeken van zenders, probeer het later opnieuw.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_already_add_this_station.', 'Je hebt dit station al toegevoegd.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'delete_station', 'Station verwijderen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_more_stations_found', 'Geen stations meer gevonden');
            $lang_update_queries[] = PT_UpdateLangs($value, 'the_track_has_been_moved_to_this_album_successfully.', 'Het nummer is verplaatst naar het volgende album.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'someone_liked_disliked_one_of_my_tracks', 'Iemand vond een van mijn tracks leuk / niet leuk');
            $lang_update_queries[] = PT_UpdateLangs($value, 'disliked_your_song.', 'vond je lied niet leuk.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'reviewed_your_song.', 'heeft je lied beoordeeld.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'someone_reviewed_one_of_my_tracks', 'Iemand heeft een van mijn tracks beoordeeld');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_can_not_import_this_track_because_this_track_is_one_of_soundcloud_go__tracks.', 'Je kunt deze track niet importeren omdat deze een van SoundCloud Go-tracks is.');
        } else if ($value == 'french') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_users_found', 'Aucun utilisateur trouvé');
            $lang_update_queries[] = PT_UpdateLangs($value, 'show_only_in_track_page', 'Afficher uniquement dans la page de piste');
            $lang_update_queries[] = PT_UpdateLangs($value, 'show_on_all_pages', 'Montrer sur toutes les pages');
            $lang_update_queries[] = PT_UpdateLangs($value, 'edit_spotlight', 'Modifier Spotlight');
            $lang_update_queries[] = PT_UpdateLangs($value, 'blog', 'Blog');
            $lang_update_queries[] = PT_UpdateLangs($value, '1309', 'La comédie');
            $lang_update_queries[] = PT_UpdateLangs($value, '1310', 'Voitures et véhicules');
            $lang_update_queries[] = PT_UpdateLangs($value, '1311', 'Économie et commerce');
            $lang_update_queries[] = PT_UpdateLangs($value, '1312', 'Éducation');
            $lang_update_queries[] = PT_UpdateLangs($value, '1313', 'Divertissement');
            $lang_update_queries[] = PT_UpdateLangs($value, '1314', 'Films');
            $lang_update_queries[] = PT_UpdateLangs($value, '1315', 'Jeu');
            $lang_update_queries[] = PT_UpdateLangs($value, '1316', 'Histoire et faits');
            $lang_update_queries[] = PT_UpdateLangs($value, '1317', 'Style de vie');
            $lang_update_queries[] = PT_UpdateLangs($value, '1318', 'Naturel');
            $lang_update_queries[] = PT_UpdateLangs($value, '1319', 'Nouvelles et politique');
            $lang_update_queries[] = PT_UpdateLangs($value, '1320', 'Peuples et Nations');
            $lang_update_queries[] = PT_UpdateLangs($value, '1321', 'Animaux et Animaux');
            $lang_update_queries[] = PT_UpdateLangs($value, '1322', 'Lieux et régions');
            $lang_update_queries[] = PT_UpdateLangs($value, '1323', 'Science et technologie');
            $lang_update_queries[] = PT_UpdateLangs($value, '1324', 'Sport');
            $lang_update_queries[] = PT_UpdateLangs($value, '1325', 'Voyage et événements');
            $lang_update_queries[] = PT_UpdateLangs($value, '1326', 'Autre');
            $lang_update_queries[] = PT_UpdateLangs($value, 'read_more', 'Lire la suite');
            $lang_update_queries[] = PT_UpdateLangs($value, 'categories', 'Les catégories');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_more_articles_to_show.', 'Pas plus d\'articles à montrer.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'article', 'Article');
            $lang_update_queries[] = PT_UpdateLangs($value, 'share_to', 'Partager à');
            $lang_update_queries[] = PT_UpdateLangs($value, 'blogs', 'Blogs');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_more_articles', 'Plus d\'articles à afficher');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_more_article_found', 'Pas plus d\'articles trouvés');
            $lang_update_queries[] = PT_UpdateLangs($value, 'delete_song', 'Supprimer la chanson');
            $lang_update_queries[] = PT_UpdateLangs($value, 'delete_this_song_from_playlist', 'Supprimer de la playlist');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_song_description', 'S\'il vous plaît entrer la description de la chanson');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_song_tags', 'S\'il vous plaît entrer les tags de la chanson');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_upload_song_thumbnail', 'S\'il vous plaît télécharger la vignette de la chanson');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_have_reached_your_upload_limit__upgrade_to_upload_unlimited_songs.', 'Vous avez atteint votre limite de téléchargement, effectuez une mise à niveau pour télécharger des morceaux illimités.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'advertising', 'La publicité');
            $lang_update_queries[] = PT_UpdateLangs($value, 'wallet', 'Portefeuille');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_ad', 'Nouvelle campagne');
            $lang_update_queries[] = PT_UpdateLangs($value, 'category', 'Catégorie');
            $lang_update_queries[] = PT_UpdateLangs($value, 'results', 'Résultats');
            $lang_update_queries[] = PT_UpdateLangs($value, 'spent', 'Dépensé');
            $lang_update_queries[] = PT_UpdateLangs($value, 'action', 'Action');
            $lang_update_queries[] = PT_UpdateLangs($value, '2checkout', '2Checkout');
            $lang_update_queries[] = PT_UpdateLangs($value, 'address', 'Adresse');
            $lang_update_queries[] = PT_UpdateLangs($value, 'city', 'Ville');
            $lang_update_queries[] = PT_UpdateLangs($value, 'state', 'Etat');
            $lang_update_queries[] = PT_UpdateLangs($value, 'zip', 'Zip *: français');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone_number', 'Numéro de téléphone');
            $lang_update_queries[] = PT_UpdateLangs($value, 'card_number', 'Numéro de carte');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay', 'Payer');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replenish', 'Remplir');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_check_the_details', 'S\'il vous plaît vérifier les détails');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirmation', 'Confirmation');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_to_delete_this_ad_', 'Êtes-vous sûr de vouloir supprimer cette campagne?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'deleted', 'supprimé');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_check_details', 'please_check_details');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirming_your_payment__please_wait..', 'Confirmant votre paiement, veuillez patienter ..');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment_declined__please_try_again_later.', 'Paiement refusé, veuillez réessayer plus tard.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'my_balance', 'Mon solde');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replenish_my_balance', 'Reconstituer mon équilibre');
            $lang_update_queries[] = PT_UpdateLangs($value, 'browse_to_upload', 'Parcourir pour télécharger');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_advertising', 'Nouvelle campagne');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_new_ad', 'Créer une nouvelle campagne');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_current_wallet_balance_is__0__please_top_up_your_wallet_to_continue.', 'Votre solde de portefeuille actuel est 0, veuillez recharger votre portefeuille pour continuer.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'top_up', 'Recharger');
            $lang_update_queries[] = PT_UpdateLangs($value, 'url', 'URL');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_media', 'Sélectionnez le média');
            $lang_update_queries[] = PT_UpdateLangs($value, 'target_audience', 'Public cible');
            $lang_update_queries[] = PT_UpdateLangs($value, 'placement', 'Placement');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pricing', 'Prix');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay_per_click', 'Payer avec un clic');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay_per_impression', 'Pay Per Impression');
            $lang_update_queries[] = PT_UpdateLangs($value, 'spending_limit_per_day', 'Limite de dépenses par jour');
            $lang_update_queries[] = PT_UpdateLangs($value, 'media_file_is_invalid._please_select_a_valid_image', 'Le fichier multimédia n\'est pas valide. Veuillez sélectionner une image valide');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error_', 'Erreur!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'file_is_too_big__max_upload_size_is', 'Le fichier est trop gros, la taille maximale de téléchargement est');
            $lang_update_queries[] = PT_UpdateLangs($value, 'media_file_is_invalid._please_select_a_valid_image___video', 'Le fichier multimédia n\'est pas valide. Veuillez sélectionner une image / vidéo valide');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_ad_has_been_published_successfully', 'Votre campagne a été publiée avec succès.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'the_url_is_invalid._please_enter_a_valid_url', 'L\'URL n\'est pas valide. Veuillez entrer une URL valide.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ad_title_must_be_between_5_100', 'Le titre de la campagne doit être compris entre 5/100.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'edit_ad', 'Modifier la campagne');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_changes_to_the_ad_were_successfully_saved', 'Vos modifications dans la campagne ont été enregistrées avec succès.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'name_must_be_between_5_32', 'Le nom doit être compris entre 5/32');
            $lang_update_queries[] = PT_UpdateLangs($value, 'clicks', 'Clics');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ads_analytics', 'Analyse de campagne');
            $lang_update_queries[] = PT_UpdateLangs($value, 'this_year', 'Cette année');
            $lang_update_queries[] = PT_UpdateLangs($value, 'view_report', 'Voir le rapport');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ad_analytics', 'Analyse de campagne');
            $lang_update_queries[] = PT_UpdateLangs($value, 'sponsor_ads', 'PARRAINER');
            $lang_update_queries[] = PT_UpdateLangs($value, 'by', 'Par');
            $lang_update_queries[] = PT_UpdateLangs($value, 'import', 'Importation');
            $lang_update_queries[] = PT_UpdateLangs($value, 'import_from_soundcloud.', 'Importer depuis SoundCloud.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'enter_the_soundcloud_track_link_and_click_the_button_below.', 'Collez votre URL SoundCloud ci-dessus.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error_found_while_importing_your_track__please_try_again_later.', 'Erreur détectée lors de l\'importation de votre piste, veuillez réessayer ultérieurement.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_valid_soundcloud_track_url.', 'Veuillez entrer une URL de piste SoundCloud valide.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_soundcloud_track_link_to_import.', 'Veuillez entrer le lien de la piste SoundCloud à importer.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error_found_while_importing_your_track__please_check_soundcloud_client_id.', 'Erreur détectée lors de l\'importation de votre piste, veuillez vérifier l\'ID client SoundCloud.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'dmca', 'DMCA');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_soundcloud', 'Connexion avec SoundCloud');
            $lang_update_queries[] = PT_UpdateLangs($value, 'dcma', 'DCMA');
            $lang_update_queries[] = PT_UpdateLangs($value, 'move_to_album', 'Déplacer vers un album');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_albums', 'Sélectionner des albums');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_select_which_album_you_want_to_add_this_song_to.', 'Veuillez sélectionner l\'album auquel vous souhaitez ajouter cette chanson.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'review_track', 'Piste de révision');
            $lang_update_queries[] = PT_UpdateLangs($value, 'review', 'La revue');
            $lang_update_queries[] = PT_UpdateLangs($value, 'review_track.', 'Piste de révision.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_your_review.', 'S\'il vous plaît entrer votre avis.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'thanks_for_your_submission.', 'Merci pour votre soumission.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'reviews', 'Avis');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_reviews_on_this_track_yet.', 'Aucun commentaire sur cette piste pour le moment.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_new_track.', 'télécharger une nouvelle piste.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'notification', 'Notification');
            $lang_update_queries[] = PT_UpdateLangs($value, 'notification_settings', 'Notification Settings');
            $lang_update_queries[] = PT_UpdateLangs($value, 'someone_followed_me', 'Quelqu\'un m\'a suivi');
            $lang_update_queries[] = PT_UpdateLangs($value, 'someone_liked_one_of_my_tracks', 'Quelqu\'un a aimé un de mes morceaux');
            $lang_update_queries[] = PT_UpdateLangs($value, 'someone_liked_one_of_my_comments', 'Quelqu\'un a aimé un de mes commentaires');
            $lang_update_queries[] = PT_UpdateLangs($value, 'approve_disapprove_artist_request', 'Approuver / désapprouver les demandes d\'artistes');
            $lang_update_queries[] = PT_UpdateLangs($value, 'approve_disapprove_bank_payment_request', 'Approuver / désapprouver les demandes de paiement bancaire');
            $lang_update_queries[] = PT_UpdateLangs($value, 'one_of_my_following_upload_new_track', 'Un de mes artistes suivants a ajouté une nouvelle piste');
            $lang_update_queries[] = PT_UpdateLangs($value, 'one_of_my_following_users_upload_new_track', 'Un de mes artistes suivants a ajouté une nouvelle piste');
            $lang_update_queries[] = PT_UpdateLangs($value, 'notify_me_when', 'M\'avertir quand');
            $lang_update_queries[] = PT_UpdateLangs($value, 'new_notification', 'New notification');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_can_not_import_this_track_because_this_track_is_imported_before.', 'Cette piste est déjà importée, veuillez choisir une autre piste.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'manage_sessions', 'Gérer les sessions');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ip_address', 'Adresse IP');
            $lang_update_queries[] = PT_UpdateLangs($value, 'platform', 'Plate-forme');
            $lang_update_queries[] = PT_UpdateLangs($value, 'browser', 'Navigateur');
            $lang_update_queries[] = PT_UpdateLangs($value, 'last_seen', 'Dernière vue');
            $lang_update_queries[] = PT_UpdateLangs($value, 'actions', 'Actions');
            $lang_update_queries[] = PT_UpdateLangs($value, 'session_expired', 'La session a expiré');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_session_has_been_expired__please_login_again.', 'Votre session a expiré, veuillez vous reconnecter.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'two-factor_authentication', 'Authentification à deux facteurs');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone', 'Téléphone');
            $lang_update_queries[] = PT_UpdateLangs($value, 'enable', 'Activer');
            $lang_update_queries[] = PT_UpdateLangs($value, 'disable', 'Désactiver');
            $lang_update_queries[] = PT_UpdateLangs($value, 'turn_on_2-step_login_to_level-up_your_account_s_security__once_turned_on__you_ll_use_both_your_password_and_a_6-digit_security_code_sent_to_your_phone_or_email_to_log_in.', 'Activez la connexion en deux étapes pour mettre votre compte à niveau.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'a_confirmation_email_has_been_sent.', 'Un email de confirmation a été envoyé.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_an_email_that_contains_the_confirmation_code_to_enable_two-factor_authentication.', 'Nous avons envoyé un courrier électronique contenant le code de confirmation pour activer l\'authentification à deux facteurs.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirmation_code', 'Confirmation code');
            $lang_update_queries[] = PT_UpdateLangs($value, 'a_confirmation_message_and_email_were_sent.', 'Un message de confirmation et un email ont été envoyés.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_a_message_and_an_email_that_contain_the_confirmation_code_to_enable_two-factor_authentication', 'Nous avons envoyé un message et un courrier électronique contenant le code de confirmation pour activer l\'authentification à deux facteurs.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'a_confirmation_message_was_sent.', 'Un message de confirmation a été envoyé.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_a_message_that_contains_the_confirmation_code_to_enable_two-factor_authentication.', 'Nous avons envoyé un message contenant le code de confirmation pour activer l\'authentification à deux facteurs.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_you_an_email_with_the_confirmation_code.', 'Nous vous avons envoyé un email avec le code de confirmation.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'wrong_confirmation_code.', 'Mauvais code de confirmation.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_e-mail_has_been_successfully_verified.', 'Votre courriel a été vérifié avec succès.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'unusual_login', 'Login inhabituel');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_you_the_confirmation_code_to_your_email_address.', 'Nous vous avons envoyé le code de confirmation à votre adresse e-mail.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'to_log_in__you_need_to_verify_your_identity.', 'Pour vous connecter, vous devez vérifier votre identité.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'welcome...', 'Nous saluons le retour!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'stations', 'Stations');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_stations_found', 'Aucune station trouvée');
            $lang_update_queries[] = PT_UpdateLangs($value, 'add_station', 'Ajouter une station');
            $lang_update_queries[] = PT_UpdateLangs($value, 'search_for_stations', 'Rechercher des stations');
            $lang_update_queries[] = PT_UpdateLangs($value, 'station_search.', 'Recherche de station.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_more_than_3_characters.', 'Veuillez saisir plus de 3 caractères.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error_found_while_search_stations__please_try_again_later.', 'Erreur trouvée lors de la recherche de stations, veuillez réessayer ultérieurement.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_already_add_this_station.', 'Vous ajoutez déjà cette station.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'delete_station', 'Delete Station');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_more_stations_found', 'Pas plus de stations trouvées');
            $lang_update_queries[] = PT_UpdateLangs($value, 'the_track_has_been_moved_to_this_album_successfully.', 'La piste a été déplacée dans l\'album suivant.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'someone_liked_disliked_one_of_my_tracks', 'Quelqu\'un a aimé / n\'aime pas l\'un de mes morceaux');
            $lang_update_queries[] = PT_UpdateLangs($value, 'disliked_your_song.', 'n\'a pas aimé votre chanson.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'reviewed_your_song.', 'examiné votre chanson.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'someone_reviewed_one_of_my_tracks', 'Quelqu\'un a passé en revue une de mes pistes');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_can_not_import_this_track_because_this_track_is_one_of_soundcloud_go__tracks.', 'Vous ne pouvez pas importer cette piste car cette piste est l\'une des pistes SoundCloud Go.');
        } else if ($value == 'german') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_users_found', 'Keine Benutzer gefunden');
            $lang_update_queries[] = PT_UpdateLangs($value, 'show_only_in_track_page', 'Nur auf der Titelseite anzeigen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'show_on_all_pages', 'Auf allen Seiten anzeigen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'edit_spotlight', 'Spotlight bearbeiten');
            $lang_update_queries[] = PT_UpdateLangs($value, 'blog', 'Blog');
            $lang_update_queries[] = PT_UpdateLangs($value, '1309', 'Komödie');
            $lang_update_queries[] = PT_UpdateLangs($value, '1310', 'Autos und Fahrzeuge');
            $lang_update_queries[] = PT_UpdateLangs($value, '1311', 'Wirtschaft und Handel');
            $lang_update_queries[] = PT_UpdateLangs($value, '1312', 'Bildung');
            $lang_update_queries[] = PT_UpdateLangs($value, '1313', 'Unterhaltung');
            $lang_update_queries[] = PT_UpdateLangs($value, '1314', 'Filme');
            $lang_update_queries[] = PT_UpdateLangs($value, '1315', 'Gaming');
            $lang_update_queries[] = PT_UpdateLangs($value, '1316', 'Geschichte und Fakten');
            $lang_update_queries[] = PT_UpdateLangs($value, '1317', 'Lebensstil');
            $lang_update_queries[] = PT_UpdateLangs($value, '1318', 'Natürlich');
            $lang_update_queries[] = PT_UpdateLangs($value, '1319', 'Nachrichten und Politik');
            $lang_update_queries[] = PT_UpdateLangs($value, '1320', 'Menschen und Nationen');
            $lang_update_queries[] = PT_UpdateLangs($value, '1321', 'Haustiere und Tiere');
            $lang_update_queries[] = PT_UpdateLangs($value, '1322', 'Orte und Regionen');
            $lang_update_queries[] = PT_UpdateLangs($value, '1323', 'Wissenschaft und Technik');
            $lang_update_queries[] = PT_UpdateLangs($value, '1324', 'Sport');
            $lang_update_queries[] = PT_UpdateLangs($value, '1325', 'Reisen und Veranstaltungen');
            $lang_update_queries[] = PT_UpdateLangs($value, '1326', 'Andere');
            $lang_update_queries[] = PT_UpdateLangs($value, 'read_more', 'Weiterlesen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'categories', 'Kategorien');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_more_articles_to_show.', 'Keine weiteren Artikel zum Anzeigen.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'article', 'Artikel');
            $lang_update_queries[] = PT_UpdateLangs($value, 'share_to', 'Teilen mit');
            $lang_update_queries[] = PT_UpdateLangs($value, 'blogs', 'Blogs');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_more_articles', 'Keine weiteren Artikel zum Anzeigen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_more_article_found', 'Keine weiteren Artikel gefunden');
            $lang_update_queries[] = PT_UpdateLangs($value, 'delete_song', 'Song löschen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'delete_this_song_from_playlist', 'Von der Wiedergabeliste entfernen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_song_description', 'Bitte geben Sie die Songbeschreibung ein');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_song_tags', 'Bitte geben Sie die Tags des Songs ein');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_upload_song_thumbnail', 'Bitte laden Sie das Miniaturbild des Songs hoch');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_have_reached_your_upload_limit__upgrade_to_upload_unlimited_songs.', 'Sie haben Ihr Upload-Limit erreicht. Aktualisieren Sie, um unbegrenzt viele Songs hochzuladen.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'advertising', 'Werbung');
            $lang_update_queries[] = PT_UpdateLangs($value, 'wallet', 'Brieftasche');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_ad', 'Neue Kampagne');
            $lang_update_queries[] = PT_UpdateLangs($value, 'category', 'Kategorie');
            $lang_update_queries[] = PT_UpdateLangs($value, 'results', 'Ergebnisse');
            $lang_update_queries[] = PT_UpdateLangs($value, 'spent', 'Verbraucht');
            $lang_update_queries[] = PT_UpdateLangs($value, 'action', 'Aktion');
            $lang_update_queries[] = PT_UpdateLangs($value, '2checkout', '2Kasse');
            $lang_update_queries[] = PT_UpdateLangs($value, 'address', 'Adresse');
            $lang_update_queries[] = PT_UpdateLangs($value, 'city', 'Stadt');
            $lang_update_queries[] = PT_UpdateLangs($value, 'state', 'Zustand');
            $lang_update_queries[] = PT_UpdateLangs($value, 'zip', 'Postleitzahl');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone_number', 'Telefonnummer');
            $lang_update_queries[] = PT_UpdateLangs($value, 'card_number', 'Kartennummer');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay', 'Zahlen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replenish', 'Ergänzen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_check_the_details', 'Bitte überprüfen Sie die Details');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirmation', 'Bestätigung');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_to_delete_this_ad_', 'Möchten Sie diese Kampagne wirklich löschen?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'deleted', 'gelöscht');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_check_details', 'please_check_details');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirming_your_payment__please_wait..', 'Bitte warten Sie, bis die Zahlung bestätigt wurde.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment_declined__please_try_again_later.', 'Zahlung abgelehnt. Bitte versuchen Sie es später erneut.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'my_balance', 'Mein Gleichgewicht');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replenish_my_balance', 'Mein Guthaben auffüllen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'browse_to_upload', 'Zum Hochladen durchsuchen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_advertising', 'Neue Kampagne');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_new_ad', 'Neue Kampagne erstellen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_current_wallet_balance_is__0__please_top_up_your_wallet_to_continue.', 'Ihr aktueller Brieftaschen-Kontostand ist 0. Bitte füllen Sie Ihre Brieftasche auf, um fortzufahren.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'top_up', 'Aufladen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'url', 'URL');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_media', 'Wählen Sie Medien');
            $lang_update_queries[] = PT_UpdateLangs($value, 'target_audience', 'Zielgruppe');
            $lang_update_queries[] = PT_UpdateLangs($value, 'placement', 'Platzierung');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pricing', 'Preisgestaltung');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay_per_click', 'Pay Per Click');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay_per_impression', 'Pay Per Impression');
            $lang_update_queries[] = PT_UpdateLangs($value, 'spending_limit_per_day', 'Ausgabenlimit pro Tag');
            $lang_update_queries[] = PT_UpdateLangs($value, 'media_file_is_invalid._please_select_a_valid_image', 'Mediendatei ist ungültig. Bitte wählen Sie ein gültiges Bild');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error_', 'Error!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'file_is_too_big__max_upload_size_is', 'Datei ist zu groß, maximale Upload-Größe ist');
            $lang_update_queries[] = PT_UpdateLangs($value, 'media_file_is_invalid._please_select_a_valid_image___video', 'Mediendatei ist ungültig. Bitte wählen Sie ein gültiges Bild / Video aus');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_ad_has_been_published_successfully', 'Ihre Kampagne wurde erfolgreich veröffentlicht.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'the_url_is_invalid._please_enter_a_valid_url', 'Die URL ist ungültig. Bitte geben Sie eine gültige URL ein.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ad_title_must_be_between_5_100', 'Der Kampagnentitel muss zwischen 5/100 liegen.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'edit_ad', 'Kampagne bearbeiten');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_changes_to_the_ad_were_successfully_saved', 'Ihre Änderungen an der Kampagne wurden erfolgreich gespeichert.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'name_must_be_between_5_32', 'Der Name muss zwischen 5/32 liegen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'clicks', 'Klicks');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ads_analytics', 'Kampagnenanalyse');
            $lang_update_queries[] = PT_UpdateLangs($value, 'this_year', 'Dieses Jahr');
            $lang_update_queries[] = PT_UpdateLangs($value, 'view_report', 'Zeige Bericht');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ad_analytics', 'Kampagnenanalyse');
            $lang_update_queries[] = PT_UpdateLangs($value, 'sponsor_ads', 'SPONSOR');
            $lang_update_queries[] = PT_UpdateLangs($value, 'by', 'Durch');
            $lang_update_queries[] = PT_UpdateLangs($value, 'import', 'Einführen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'import_from_soundcloud.', 'Aus SoundCloud importieren.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'enter_the_soundcloud_track_link_and_click_the_button_below.', 'Fügen Sie oben Ihre SoundCloud-URL ein.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error_found_while_importing_your_track__please_try_again_later.', 'Beim Importieren Ihres Tracks ist ein Fehler aufgetreten. Bitte versuchen Sie es später erneut.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_valid_soundcloud_track_url.', 'Bitte geben Sie eine gültige SoundCloud-Track-URL ein.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_soundcloud_track_link_to_import.', 'Bitte geben Sie den zu importierenden SoundCloud-Tracklink ein.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error_found_while_importing_your_track__please_check_soundcloud_client_id.', 'Beim Importieren Ihres Tracks ist ein Fehler aufgetreten. Überprüfen Sie die SoundCloud-Client-ID.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'dmca', 'DMCA');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_soundcloud', 'Loggen Sie sich mit SoundCloud ein');
            $lang_update_queries[] = PT_UpdateLangs($value, 'dcma', 'DCMA');
            $lang_update_queries[] = PT_UpdateLangs($value, 'move_to_album', 'Zu einem Album wechseln');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_albums', 'Alben auswählen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_select_which_album_you_want_to_add_this_song_to.', 'Bitte wählen Sie das Album aus, zu dem Sie diesen Titel hinzufügen möchten.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'review_track', 'Track überprüfen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'review', 'Rezension');
            $lang_update_queries[] = PT_UpdateLangs($value, 'review_track.', 'Track überprüfen.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_your_review.', 'Bitte geben Sie Ihre Bewertung ein.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'thanks_for_your_submission.', 'Vielen Dank für Ihren Beitrag.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'reviews', 'Bewertungen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_reviews_on_this_track_yet.', 'Noch keine Reviews auf diesem Track.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_new_track.', 'lade einen neuen Track hoch.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'notification', 'Benachrichtigung');
            $lang_update_queries[] = PT_UpdateLangs($value, 'notification_settings', 'Benachrichtigungseinstellungen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'someone_followed_me', 'Jemand folgte mir');
            $lang_update_queries[] = PT_UpdateLangs($value, 'someone_liked_one_of_my_tracks', 'Jemand mochte einen meiner Titel');
            $lang_update_queries[] = PT_UpdateLangs($value, 'someone_liked_one_of_my_comments', 'Jemand mochte einen meiner Kommentare');
            $lang_update_queries[] = PT_UpdateLangs($value, 'approve_disapprove_artist_request', 'Künstleranfrage (n) genehmigen / ablehnen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'approve_disapprove_bank_payment_request', 'Bankzahlungsanforderung (en) genehmigen / ablehnen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'one_of_my_following_upload_new_track', 'Einer meiner folgenden Künstler hat einen neuen Track hochgeladen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'one_of_my_following_users_upload_new_track', 'Einer meiner folgenden Künstler hat einen neuen Track hochgeladen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'notify_me_when', 'Benachrichtigen Sie mich wenn');
            $lang_update_queries[] = PT_UpdateLangs($value, 'new_notification', 'Neue Benachrichtigung');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_can_not_import_this_track_because_this_track_is_imported_before.', 'Dieser Track ist bereits importiert, bitte wählen Sie einen anderen Track.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'manage_sessions', 'Sitzungen verwalten');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ip_address', 'IP Adresse');
            $lang_update_queries[] = PT_UpdateLangs($value, 'platform', 'Plattform');
            $lang_update_queries[] = PT_UpdateLangs($value, 'browser', 'Browser');
            $lang_update_queries[] = PT_UpdateLangs($value, 'last_seen', 'Zuletzt gesehen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'actions', 'Aktionen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'session_expired', 'Sitzung abgelaufen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_session_has_been_expired__please_login_again.', 'Ihre Sitzung ist abgelaufen, bitte melden Sie sich erneut an.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'two-factor_authentication', 'Zwei-Faktor-Authentifizierung');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone', 'Telefon');
            $lang_update_queries[] = PT_UpdateLangs($value, 'enable', 'Aktivieren');
            $lang_update_queries[] = PT_UpdateLangs($value, 'disable', 'Deaktivieren');
            $lang_update_queries[] = PT_UpdateLangs($value, 'turn_on_2-step_login_to_level-up_your_account_s_security__once_turned_on__you_ll_use_both_your_password_and_a_6-digit_security_code_sent_to_your_phone_or_email_to_log_in.', 'Aktivieren Sie die zweistufige Anmeldung, um Ihr Konto aufzustocken');
            $lang_update_queries[] = PT_UpdateLangs($value, 'a_confirmation_email_has_been_sent.', 'Eine Bestätigungs-E-Mail wurde gesendet.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_an_email_that_contains_the_confirmation_code_to_enable_two-factor_authentication.', 'Wir haben eine E-Mail gesendet, die den Bestätigungscode enthält, um die Zwei-Faktor-Authentifizierung zu aktivieren.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirmation_code', 'Bestätigungscode');
            $lang_update_queries[] = PT_UpdateLangs($value, 'a_confirmation_message_and_email_were_sent.', 'Eine Bestätigungsnachricht und eine E-Mail wurden gesendet.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_a_message_and_an_email_that_contain_the_confirmation_code_to_enable_two-factor_authentication', 'Wir haben eine Nachricht und eine E-Mail gesendet, die den Bestätigungscode enthält, um die Zwei-Faktor-Authentifizierung zu aktivieren');
            $lang_update_queries[] = PT_UpdateLangs($value, 'a_confirmation_message_was_sent.', 'Eine Bestätigungsnachricht wurde gesendet.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_a_message_that_contains_the_confirmation_code_to_enable_two-factor_authentication.', 'Wir haben eine Nachricht gesendet, die den Bestätigungscode enthält, um die Zwei-Faktor-Authentifizierung zu aktivieren.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_you_an_email_with_the_confirmation_code.', 'Wir haben Ihnen eine E-Mail mit dem Bestätigungscode gesendet.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'wrong_confirmation_code.', 'Falscher Bestätigungscode.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_e-mail_has_been_successfully_verified.', 'Ihre E-Mail wurde erfolgreich verifiziert.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'unusual_login', 'Ungewöhnliches Login');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_you_the_confirmation_code_to_your_email_address.', 'Wir haben Ihnen den Bestätigungscode an Ihre E-Mail-Adresse gesendet.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'to_log_in__you_need_to_verify_your_identity.', 'Um sich anzumelden, müssen Sie Ihre Identität überprüfen.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'welcome...', 'Willkommen zurück!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'stations', 'Stationen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_stations_found', 'Keine Sender gefunden');
            $lang_update_queries[] = PT_UpdateLangs($value, 'add_station', 'Station hinzufügen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'search_for_stations', 'Nach Sendern suchen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'station_search.', 'Sendersuche.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_more_than_3_characters.', 'Bitte geben Sie mehr als 3 Zeichen ein.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error_found_while_search_stations__please_try_again_later.', 'Bei der Suche nach Sendern wurde ein Fehler gefunden. Bitte versuchen Sie es später erneut.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_already_add_this_station.', 'Sie haben diesen Sender bereits hinzugefügt.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'delete_station', 'Station löschen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_more_stations_found', 'Keine weiteren Stationen gefunden');
            $lang_update_queries[] = PT_UpdateLangs($value, 'the_track_has_been_moved_to_this_album_successfully.', 'Der Titel wurde in das folgende Album verschoben.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'someone_liked_disliked_one_of_my_tracks', 'Jemand mochte / mochte einen meiner Titel nicht');
            $lang_update_queries[] = PT_UpdateLangs($value, 'disliked_your_song.', 'mochte dein Lied nicht.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'reviewed_your_song.', 'hat dein Lied rezensiert.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'someone_reviewed_one_of_my_tracks', 'Jemand hat einen meiner Titel überprüft');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_can_not_import_this_track_because_this_track_is_one_of_soundcloud_go__tracks.', 'Sie können diese Spur nicht importieren, da es sich bei dieser Spur um eine SoundCloud Go-Spur handelt.');
        } else if ($value == 'russian') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_users_found', 'Пользователи не найдены');
            $lang_update_queries[] = PT_UpdateLangs($value, 'show_only_in_track_page', 'Показывать только на странице трека');
            $lang_update_queries[] = PT_UpdateLangs($value, 'show_on_all_pages', 'Показать на всех страницах');
            $lang_update_queries[] = PT_UpdateLangs($value, 'edit_spotlight', 'Редактировать Прожектор');
            $lang_update_queries[] = PT_UpdateLangs($value, 'blog', 'Блог');
            $lang_update_queries[] = PT_UpdateLangs($value, '1309', 'комедия');
            $lang_update_queries[] = PT_UpdateLangs($value, '1310', 'Автомобили и транспортные средства');
            $lang_update_queries[] = PT_UpdateLangs($value, '1311', 'Экономика и торговля');
            $lang_update_queries[] = PT_UpdateLangs($value, '1312', 'образование');
            $lang_update_queries[] = PT_UpdateLangs($value, '1313', 'Развлечения');
            $lang_update_queries[] = PT_UpdateLangs($value, '1314', 'Кино');
            $lang_update_queries[] = PT_UpdateLangs($value, '1315', 'азартные игры');
            $lang_update_queries[] = PT_UpdateLangs($value, '1316', 'История и факты');
            $lang_update_queries[] = PT_UpdateLangs($value, '1317', 'Стиль жизни');
            $lang_update_queries[] = PT_UpdateLangs($value, '1318', 'натуральный');
            $lang_update_queries[] = PT_UpdateLangs($value, '1319', 'Новости и Политика');
            $lang_update_queries[] = PT_UpdateLangs($value, '1320', 'Люди и народы');
            $lang_update_queries[] = PT_UpdateLangs($value, '1321', 'Домашние животные и животные');
            $lang_update_queries[] = PT_UpdateLangs($value, '1322', 'Места и Регионы');
            $lang_update_queries[] = PT_UpdateLangs($value, '1323', 'Наука и технология');
            $lang_update_queries[] = PT_UpdateLangs($value, '1324', 'Sport');
            $lang_update_queries[] = PT_UpdateLangs($value, '1325', 'Путешествия и События');
            $lang_update_queries[] = PT_UpdateLangs($value, '1326', 'Другие');
            $lang_update_queries[] = PT_UpdateLangs($value, 'read_more', 'Подробнее');
            $lang_update_queries[] = PT_UpdateLangs($value, 'categories', 'категории');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_more_articles_to_show.', 'Нет больше статей, чтобы показать.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'article', 'Статья');
            $lang_update_queries[] = PT_UpdateLangs($value, 'share_to', 'Поделиться с');
            $lang_update_queries[] = PT_UpdateLangs($value, 'blogs', 'Блоги');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_more_articles', 'Нет больше статей для показа');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_more_article_found', 'Больше статей не найдено');
            $lang_update_queries[] = PT_UpdateLangs($value, 'delete_song', 'Удалить песню');
            $lang_update_queries[] = PT_UpdateLangs($value, 'delete_this_song_from_playlist', 'Удалить из плейлиста');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_song_description', 'Пожалуйста, введите описание песни');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_song_tags', 'Пожалуйста, введите теги песни');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_upload_song_thumbnail', 'Пожалуйста, загрузите миниатюру песни');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_have_reached_your_upload_limit__upgrade_to_upload_unlimited_songs.', 'Вы достигли предела загрузки, обновите, чтобы загрузить неограниченное количество песен.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'advertising', 'реклама');
            $lang_update_queries[] = PT_UpdateLangs($value, 'wallet', 'Кошелек');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_ad', 'Новая кампания');
            $lang_update_queries[] = PT_UpdateLangs($value, 'category', 'категория');
            $lang_update_queries[] = PT_UpdateLangs($value, 'results', 'Полученные результаты');
            $lang_update_queries[] = PT_UpdateLangs($value, 'spent', 'потраченный');
            $lang_update_queries[] = PT_UpdateLangs($value, 'action', 'действие');
            $lang_update_queries[] = PT_UpdateLangs($value, '2checkout', '2Checkout');
            $lang_update_queries[] = PT_UpdateLangs($value, 'address', 'Адрес');
            $lang_update_queries[] = PT_UpdateLangs($value, 'city', 'город');
            $lang_update_queries[] = PT_UpdateLangs($value, 'state', 'государственный');
            $lang_update_queries[] = PT_UpdateLangs($value, 'zip', 'застежка-молния');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone_number', 'Номер телефона');
            $lang_update_queries[] = PT_UpdateLangs($value, 'card_number', 'Номер карты');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay', 'Оплатить');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replenish', 'Восполнение');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_check_the_details', 'Пожалуйста, проверьте детали');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirmation', 'подтверждение');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_to_delete_this_ad_', 'Вы уверены, что хотите удалить эту кампанию?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'deleted', 'Исключен');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_check_details', 'please_check_details');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirming_your_payment__please_wait..', 'Подтверждение оплаты, пожалуйста, подождите ..');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment_declined__please_try_again_later.', 'Платеж отклонен, повторите попытку позже.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'my_balance', 'Мой баланс');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replenish_my_balance', 'Пополнить мой баланс');
            $lang_update_queries[] = PT_UpdateLangs($value, 'browse_to_upload', 'Обзор для загрузки');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_advertising', 'Новая кампания');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_new_ad', 'Создать новую кампанию');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_current_wallet_balance_is__0__please_top_up_your_wallet_to_continue.', 'Ваш текущий баланс кошелька равен 0, для продолжения пополните свой кошелек.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'top_up', 'Пополнить');
            $lang_update_queries[] = PT_UpdateLangs($value, 'url', 'URL');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_media', 'Выберите медиа');
            $lang_update_queries[] = PT_UpdateLangs($value, 'target_audience', 'Целевая аудитория');
            $lang_update_queries[] = PT_UpdateLangs($value, 'placement', 'размещение');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pricing', 'ценообразование');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay_per_click', 'Оплата за клик');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay_per_impression', 'Оплата за показ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'spending_limit_per_day', 'Лимит расходов в день');
            $lang_update_queries[] = PT_UpdateLangs($value, 'media_file_is_invalid._please_select_a_valid_image', 'Медиа-файл недействителен. Пожалуйста, выберите действительное изображение');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error_', 'Ошибка!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'file_is_too_big__max_upload_size_is', 'Файл слишком большой, максимальный размер загрузки');
            $lang_update_queries[] = PT_UpdateLangs($value, 'media_file_is_invalid._please_select_a_valid_image___video', 'Медиа-файл недействителен. Пожалуйста, выберите действительное изображение / видео');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_ad_has_been_published_successfully', 'Ваша кампания была успешно опубликована.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'the_url_is_invalid._please_enter_a_valid_url', 'URL недействителен. Пожалуйста, введите корректный адрес.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ad_title_must_be_between_5_100', 'Название кампании должно быть между 5/100.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'edit_ad', 'Изменить кампанию');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_changes_to_the_ad_were_successfully_saved', 'Ваши изменения в кампании были успешно сохранены.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'name_must_be_between_5_32', 'Имя должно быть между 5/32');
            $lang_update_queries[] = PT_UpdateLangs($value, 'clicks', 'щелчки');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ads_analytics', 'Аналитика кампании');
            $lang_update_queries[] = PT_UpdateLangs($value, 'this_year', 'Этот год');
            $lang_update_queries[] = PT_UpdateLangs($value, 'view_report', 'Посмотреть отчет');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ad_analytics', 'Аналитика кампании');
            $lang_update_queries[] = PT_UpdateLangs($value, 'sponsor_ads', 'СПОНСОР');
            $lang_update_queries[] = PT_UpdateLangs($value, 'by', 'По');
            $lang_update_queries[] = PT_UpdateLangs($value, 'import', 'импорт');
            $lang_update_queries[] = PT_UpdateLangs($value, 'import_from_soundcloud.', 'Импорт из SoundCloud.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'enter_the_soundcloud_track_link_and_click_the_button_below.', 'Вставьте ваш URL SoundCloud выше.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error_found_while_importing_your_track__please_try_again_later.', 'При импорте трека обнаружена ошибка. Повторите попытку позже.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_valid_soundcloud_track_url.', 'Пожалуйста, введите действительный URL трека SoundCloud.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_soundcloud_track_link_to_import.', 'Пожалуйста, введите ссылку на трек SoundCloud для импорта.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error_found_while_importing_your_track__please_check_soundcloud_client_id.', 'При импорте трека обнаружена ошибка, проверьте идентификатор клиента SoundCloud.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'dmca', 'DMCA');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_soundcloud', 'Войти через SoundCloud');
            $lang_update_queries[] = PT_UpdateLangs($value, 'dcma', 'DCMA');
            $lang_update_queries[] = PT_UpdateLangs($value, 'move_to_album', 'Переместить в альбом');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_albums', 'Выберите альбомы');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_select_which_album_you_want_to_add_this_song_to.', 'Пожалуйста, выберите, в какой альбом вы хотите добавить эту песню.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'review_track', 'Обзор трека');
            $lang_update_queries[] = PT_UpdateLangs($value, 'review', 'Обзор');
            $lang_update_queries[] = PT_UpdateLangs($value, 'review_track.', 'Обзор трека.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_your_review.', 'Пожалуйста, введите ваш отзыв.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'thanks_for_your_submission.', 'Спасибо за заявку.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'reviews', 'Отзывы');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_reviews_on_this_track_yet.', 'На этот трек пока нет отзывов.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_new_track.', 'загрузить новый трек.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'notification', 'уведомление');
            $lang_update_queries[] = PT_UpdateLangs($value, 'notification_settings', 'Настройки уведомлений');
            $lang_update_queries[] = PT_UpdateLangs($value, 'someone_followed_me', 'Кто-то последовал за мной');
            $lang_update_queries[] = PT_UpdateLangs($value, 'someone_liked_one_of_my_tracks', 'Кому-то понравился один из моих треков');
            $lang_update_queries[] = PT_UpdateLangs($value, 'someone_liked_one_of_my_comments', 'Кому-то понравился один из моих комментариев');
            $lang_update_queries[] = PT_UpdateLangs($value, 'approve_disapprove_artist_request', 'Утвердить / Отклонить запрос художника');
            $lang_update_queries[] = PT_UpdateLangs($value, 'approve_disapprove_bank_payment_request', 'Утвердить / отклонить запрос (ы) банковского платежа');
            $lang_update_queries[] = PT_UpdateLangs($value, 'one_of_my_following_upload_new_track', 'Один из моих следующих исполнителей загрузил новый трек');
            $lang_update_queries[] = PT_UpdateLangs($value, 'one_of_my_following_users_upload_new_track', 'Один из моих следующих исполнителей загрузил новый трек');
            $lang_update_queries[] = PT_UpdateLangs($value, 'notify_me_when', 'Сообщите мне, когда');
            $lang_update_queries[] = PT_UpdateLangs($value, 'new_notification', 'Новое уведомление');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_can_not_import_this_track_because_this_track_is_imported_before.', 'Этот трек уже импортирован, выберите другой трек.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'manage_sessions', 'Управление сессиями');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ip_address', 'Айпи адрес');
            $lang_update_queries[] = PT_UpdateLangs($value, 'platform', 'Платформа');
            $lang_update_queries[] = PT_UpdateLangs($value, 'browser', 'браузер');
            $lang_update_queries[] = PT_UpdateLangs($value, 'last_seen', 'Последнее посещение');
            $lang_update_queries[] = PT_UpdateLangs($value, 'actions', 'действия');
            $lang_update_queries[] = PT_UpdateLangs($value, 'session_expired', 'Сессия истекла');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_session_has_been_expired__please_login_again.', 'Ваша сессия истекла, пожалуйста, войдите снова.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'two-factor_authentication', 'Двухфакторная аутентификация');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone', 'Телефон');
            $lang_update_queries[] = PT_UpdateLangs($value, 'enable', 'включить');
            $lang_update_queries[] = PT_UpdateLangs($value, 'disable', 'Отключить');
            $lang_update_queries[] = PT_UpdateLangs($value, 'turn_on_2-step_login_to_level-up_your_account_s_security__once_turned_on__you_ll_use_both_your_password_and_a_6-digit_security_code_sent_to_your_phone_or_email_to_log_in.', 'Включите двухэтапный вход, чтобы повысить уровень своей учетной записи');
            $lang_update_queries[] = PT_UpdateLangs($value, 'a_confirmation_email_has_been_sent.', 'Письмо с подтверждением было отправлено.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_an_email_that_contains_the_confirmation_code_to_enable_two-factor_authentication.', 'Мы отправили электронное письмо с кодом подтверждения для включения двухфакторной аутентификации.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirmation_code', 'Код подтверждения');
            $lang_update_queries[] = PT_UpdateLangs($value, 'a_confirmation_message_and_email_were_sent.', 'Подтверждение и электронное письмо были отправлены.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_a_message_and_an_email_that_contain_the_confirmation_code_to_enable_two-factor_authentication', 'Мы отправили сообщение и электронное письмо с кодом подтверждения для включения двухфакторной аутентификации');
            $lang_update_queries[] = PT_UpdateLangs($value, 'a_confirmation_message_was_sent.', 'Подтверждение было отправлено.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_a_message_that_contains_the_confirmation_code_to_enable_two-factor_authentication.', 'Мы отправили сообщение с кодом подтверждения для включения двухфакторной аутентификации.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_you_an_email_with_the_confirmation_code.', 'Мы отправили вам письмо с кодом подтверждения.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'wrong_confirmation_code.', 'Неверный код подтверждения.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_e-mail_has_been_successfully_verified.', 'Ваш E-mail был успешно подтвержден.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'unusual_login', 'Необычный логин');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_you_the_confirmation_code_to_your_email_address.', 'Мы отправили вам код подтверждения на ваш адрес электронной почты.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'to_log_in__you_need_to_verify_your_identity.', 'Для входа необходимо подтвердить свою личность.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'welcome...', 'Добро пожаловать назад!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'stations', 'станций');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_stations_found', 'Станции не найдены');
            $lang_update_queries[] = PT_UpdateLangs($value, 'add_station', 'Добавить станцию');
            $lang_update_queries[] = PT_UpdateLangs($value, 'search_for_stations', 'Поиск станций');
            $lang_update_queries[] = PT_UpdateLangs($value, 'station_search.', 'Поиск станции.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_more_than_3_characters.', 'Пожалуйста, введите более 3 символов.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error_found_while_search_stations__please_try_again_later.', 'При поиске станций обнаружена ошибка, повторите попытку позже.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_already_add_this_station.', 'Вы уже добавили эту станцию.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'delete_station', 'Удалить станцию');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_more_stations_found', 'Больше станций не найдено');
            $lang_update_queries[] = PT_UpdateLangs($value, 'the_track_has_been_moved_to_this_album_successfully.', 'Трек был перемещен в следующий альбом.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'someone_liked_disliked_one_of_my_tracks', 'Кому-то понравился / не понравился один из моих треков');
            $lang_update_queries[] = PT_UpdateLangs($value, 'disliked_your_song.', 'не понравилась твоя песня');
            $lang_update_queries[] = PT_UpdateLangs($value, 'reviewed_your_song.', 'пересмотрел вашу песню.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'someone_reviewed_one_of_my_tracks', 'Кто-то просмотрел один из моих треков');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_can_not_import_this_track_because_this_track_is_one_of_soundcloud_go__tracks.', 'Вы не можете импортировать этот трек, потому что этот трек является одним из треков SoundCloud Go.');
        } else if ($value == 'spanish') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_users_found', 'No se encontraron usuarios');
            $lang_update_queries[] = PT_UpdateLangs($value, 'show_only_in_track_page', 'Mostrar solo en la página de seguimiento');
            $lang_update_queries[] = PT_UpdateLangs($value, 'show_on_all_pages', 'Mostrar en todas las páginas');
            $lang_update_queries[] = PT_UpdateLangs($value, 'edit_spotlight', 'Editar Spotlight');
            $lang_update_queries[] = PT_UpdateLangs($value, 'blog', 'Blog');
            $lang_update_queries[] = PT_UpdateLangs($value, '1309', 'Comedia');
            $lang_update_queries[] = PT_UpdateLangs($value, '1310', 'Autos y vehiculos');
            $lang_update_queries[] = PT_UpdateLangs($value, '1311', 'Economía y comercio');
            $lang_update_queries[] = PT_UpdateLangs($value, '1312', 'Educación');
            $lang_update_queries[] = PT_UpdateLangs($value, '1313', 'Entretenimiento');
            $lang_update_queries[] = PT_UpdateLangs($value, '1314', 'Películas');
            $lang_update_queries[] = PT_UpdateLangs($value, '1315', 'Juego de azar');
            $lang_update_queries[] = PT_UpdateLangs($value, '1316', 'Historia y hechos');
            $lang_update_queries[] = PT_UpdateLangs($value, '1317', 'Estilo de vida');
            $lang_update_queries[] = PT_UpdateLangs($value, '1318', 'Natural');
            $lang_update_queries[] = PT_UpdateLangs($value, '1319', 'Noticias y politica');
            $lang_update_queries[] = PT_UpdateLangs($value, '1320', 'Pueblos y naciones');
            $lang_update_queries[] = PT_UpdateLangs($value, '1321', 'Mascotas y animales');
            $lang_update_queries[] = PT_UpdateLangs($value, '1322', 'Lugares y Regiones');
            $lang_update_queries[] = PT_UpdateLangs($value, '1323', 'Ciencia y Tecnología');
            $lang_update_queries[] = PT_UpdateLangs($value, '1324', 'Deporte');
            $lang_update_queries[] = PT_UpdateLangs($value, '1325', 'Viajes y eventos');
            $lang_update_queries[] = PT_UpdateLangs($value, '1326', 'Otro');
            $lang_update_queries[] = PT_UpdateLangs($value, 'read_more', 'Lee mas');
            $lang_update_queries[] = PT_UpdateLangs($value, 'categories', 'Categorias');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_more_articles_to_show.', 'No hay más artículos para mostrar.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'article', 'Artículo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'share_to', 'Compartir a');
            $lang_update_queries[] = PT_UpdateLangs($value, 'blogs', 'Blogs');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_more_articles', 'No hay más artículos para mostrar.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_more_article_found', 'No se encontraron más artículos.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'delete_song', 'Eliminar canción');
            $lang_update_queries[] = PT_UpdateLangs($value, 'delete_this_song_from_playlist', 'Eliminar de la lista de reproducción');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_song_description', 'Por favor ingrese la descripción de la canción');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_song_tags', 'Por favor, introduzca las etiquetas de la canción');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_upload_song_thumbnail', 'Sube la miniatura de la canción');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_have_reached_your_upload_limit__upgrade_to_upload_unlimited_songs.', 'Ha alcanzado su límite de carga, actualice para cargar canciones ilimitadas.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'advertising', 'Publicidad');
            $lang_update_queries[] = PT_UpdateLangs($value, 'wallet', 'Billetera');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_ad', 'Nueva campaña');
            $lang_update_queries[] = PT_UpdateLangs($value, 'category', 'Categoría');
            $lang_update_queries[] = PT_UpdateLangs($value, 'results', 'Resultados');
            $lang_update_queries[] = PT_UpdateLangs($value, 'spent', 'Gastado');
            $lang_update_queries[] = PT_UpdateLangs($value, 'action', 'Acción');
            $lang_update_queries[] = PT_UpdateLangs($value, '2checkout', '2Caja');
            $lang_update_queries[] = PT_UpdateLangs($value, 'address', 'Dirección');
            $lang_update_queries[] = PT_UpdateLangs($value, 'city', 'Ciudad');
            $lang_update_queries[] = PT_UpdateLangs($value, 'state', 'Estado');
            $lang_update_queries[] = PT_UpdateLangs($value, 'zip', 'Cremallera');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone_number', 'Número de teléfono');
            $lang_update_queries[] = PT_UpdateLangs($value, 'card_number', 'Número de tarjeta');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay', 'Paga');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replenish', 'Reponer');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_check_the_details', 'Por favor revise los detalles');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirmation', 'Confirmación');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_to_delete_this_ad_', '¿Estás seguro de que deseas eliminar esta campaña?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'deleted', 'eliminado');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_check_details', 'please_check_details');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirming_your_payment__please_wait..', 'Confirmando su pago, por favor espere ...');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment_declined__please_try_again_later.', 'Pago rechazado, intente nuevamente más tarde.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'my_balance', 'Mi balance');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replenish_my_balance', 'Reponer mi saldo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'browse_to_upload', 'Navegar para cargar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_advertising', 'Nueva campaña');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_new_ad', 'Crear nueva campaña');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_current_wallet_balance_is__0__please_top_up_your_wallet_to_continue.', 'El saldo actual de su billetera es 0, recargue su billetera para continuar.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'top_up', 'Completar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'url', 'URL');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_media', 'Select Media');
            $lang_update_queries[] = PT_UpdateLangs($value, 'target_audience', 'Público objetivo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'placement', 'Colocación');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pricing', 'Precios');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay_per_click', 'Pago por clic');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay_per_impression', 'Pago por impresión');
            $lang_update_queries[] = PT_UpdateLangs($value, 'spending_limit_per_day', 'Límite de gasto por día');
            $lang_update_queries[] = PT_UpdateLangs($value, 'media_file_is_invalid._please_select_a_valid_image', 'El archivo multimedia no es válido. Por favor seleccione una imagen válida');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error_', 'Error!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'file_is_too_big__max_upload_size_is', 'El archivo es demasiado grande, el tamaño máximo de carga es');
            $lang_update_queries[] = PT_UpdateLangs($value, 'media_file_is_invalid._please_select_a_valid_image___video', 'El archivo multimedia no es válido. Selecciona una imagen / video válido');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_ad_has_been_published_successfully', 'Su campaña ha sido publicada con éxito.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'the_url_is_invalid._please_enter_a_valid_url', 'La URL no es válida. Por favor introduzca un URL válido.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ad_title_must_be_between_5_100', 'El título de la campaña debe estar entre 5/100.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'edit_ad', 'Editar campaña');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_changes_to_the_ad_were_successfully_saved', 'Sus cambios en la campaña se guardaron correctamente.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'name_must_be_between_5_32', 'El nombre debe estar entre 5/32');
            $lang_update_queries[] = PT_UpdateLangs($value, 'clicks', 'Clics');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ads_analytics', 'Análisis de campaña');
            $lang_update_queries[] = PT_UpdateLangs($value, 'this_year', 'Este año');
            $lang_update_queries[] = PT_UpdateLangs($value, 'view_report', 'Vista del informe');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ad_analytics', 'Análisis de campaña');
            $lang_update_queries[] = PT_UpdateLangs($value, 'sponsor_ads', 'PATROCINADOR');
            $lang_update_queries[] = PT_UpdateLangs($value, 'by', 'Por');
            $lang_update_queries[] = PT_UpdateLangs($value, 'import', 'Importar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'import_from_soundcloud.', 'Importar desde SoundCloud.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'enter_the_soundcloud_track_link_and_click_the_button_below.', 'Pegue su URL de SoundCloud arriba.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error_found_while_importing_your_track__please_try_again_later.', 'Se encontró un error al importar su pista. Vuelva a intentarlo más tarde.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_valid_soundcloud_track_url.', 'Ingrese una URL de pista válida de SoundCloud.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_soundcloud_track_link_to_import.', 'Ingrese el enlace de la pista de SoundCloud para importar.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error_found_while_importing_your_track__please_check_soundcloud_client_id.', 'Se encontró un error al importar su pista, verifique la ID del cliente de SoundCloud.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'dmca', 'DMCA');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_soundcloud', 'Inicie sesión con SoundCloud');
            $lang_update_queries[] = PT_UpdateLangs($value, 'dcma', 'DCMA');
            $lang_update_queries[] = PT_UpdateLangs($value, 'move_to_album', 'Moverse a un álbum');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_albums', 'Seleccionar álbumes');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_select_which_album_you_want_to_add_this_song_to.', 'Seleccione a qué álbum desea agregar esta canción.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'review_track', 'Pista de revisión');
            $lang_update_queries[] = PT_UpdateLangs($value, 'review', 'revisión');
            $lang_update_queries[] = PT_UpdateLangs($value, 'review_track.', 'Revisar pista.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_your_review.', 'Por favor, introduzca su opinión.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'thanks_for_your_submission.', 'Gracias por tu presentación.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'reviews', 'Comentarios');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_reviews_on_this_track_yet.', 'Aún no hay reseñas sobre esta pista.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_new_track.', 'subir nueva pista');
            $lang_update_queries[] = PT_UpdateLangs($value, 'notification', 'Notificación');
            $lang_update_queries[] = PT_UpdateLangs($value, 'notification_settings', 'Configuración de las notificaciones');
            $lang_update_queries[] = PT_UpdateLangs($value, 'someone_followed_me', 'Alguien me siguió');
            $lang_update_queries[] = PT_UpdateLangs($value, 'someone_liked_one_of_my_tracks', 'A alguien le gustó una de mis canciones.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'someone_liked_one_of_my_comments', 'A alguien le gustó uno de mis comentarios.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'approve_disapprove_artist_request', 'Aprobar / Rechazar solicitud (es) de artista');
            $lang_update_queries[] = PT_UpdateLangs($value, 'approve_disapprove_bank_payment_request', 'Aprobar / rechazar solicitudes de pago bancario');
            $lang_update_queries[] = PT_UpdateLangs($value, 'one_of_my_following_upload_new_track', 'Uno de mis siguientes artistas subió una nueva canción.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'one_of_my_following_users_upload_new_track', 'Uno de mis siguientes artistas subió una nueva canción.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'notify_me_when', 'Notifícame cuando');
            $lang_update_queries[] = PT_UpdateLangs($value, 'new_notification', 'Nueva notificación');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_can_not_import_this_track_because_this_track_is_imported_before.', 'Esta pista ya está importada, elija otra pista.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'manage_sessions', 'Administrar sesiones');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ip_address', 'Dirección IP');
            $lang_update_queries[] = PT_UpdateLangs($value, 'platform', 'Plataforma');
            $lang_update_queries[] = PT_UpdateLangs($value, 'browser', 'Navegador');
            $lang_update_queries[] = PT_UpdateLangs($value, 'last_seen', 'Ultima vez visto');
            $lang_update_queries[] = PT_UpdateLangs($value, 'actions', 'Comportamiento');
            $lang_update_queries[] = PT_UpdateLangs($value, 'session_expired', 'Sesión expirada');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_session_has_been_expired__please_login_again.', 'Su sesión ha caducado, vuelva a iniciar sesión.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'two-factor_authentication', 'Autenticación de dos factores');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone', 'Teléfono');
            $lang_update_queries[] = PT_UpdateLangs($value, 'enable', 'Habilitar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'disable', 'Inhabilitar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'turn_on_2-step_login_to_level-up_your_account_s_security__once_turned_on__you_ll_use_both_your_password_and_a_6-digit_security_code_sent_to_your_phone_or_email_to_log_in.', 'Active el inicio de sesión en 2 pasos para subir de nivel su cuenta');
            $lang_update_queries[] = PT_UpdateLangs($value, 'a_confirmation_email_has_been_sent.', 'Un correo electrónico de confirmación ha sido enviado.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_an_email_that_contains_the_confirmation_code_to_enable_two-factor_authentication.', 'Hemos enviado un correo electrónico que contiene el código de confirmación para habilitar la autenticación de dos factores.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirmation_code', 'Código de confirmación');
            $lang_update_queries[] = PT_UpdateLangs($value, 'a_confirmation_message_and_email_were_sent.', 'Se envió un mensaje de confirmación y un correo electrónico.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_a_message_and_an_email_that_contain_the_confirmation_code_to_enable_two-factor_authentication', 'Hemos enviado un mensaje y un correo electrónico que contienen el código de confirmación para permitir la autenticación de dos factores.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'a_confirmation_message_was_sent.', 'Se envió un mensaje de confirmación.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_a_message_that_contains_the_confirmation_code_to_enable_two-factor_authentication.', 'Hemos enviado un mensaje que contiene el código de confirmación para habilitar la autenticación de dos factores.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_you_an_email_with_the_confirmation_code.', 'Le hemos enviado un correo electrónico con el código de confirmación.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'wrong_confirmation_code.', 'Código de confirmación incorrecto.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_e-mail_has_been_successfully_verified.', 'Su correo electrónico ha sido verificado con éxito.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'unusual_login', 'Inicio de sesión inusual');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_you_the_confirmation_code_to_your_email_address.', 'Le hemos enviado el código de confirmación a su dirección de correo electrónico.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'to_log_in__you_need_to_verify_your_identity.', 'Para iniciar sesión, debe verificar su identidad.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'welcome...', '¡Dar una buena acogida!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'stations', 'Estaciones');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_stations_found', 'No se encontraron estaciones');
            $lang_update_queries[] = PT_UpdateLangs($value, 'add_station', 'Agregar estación');
            $lang_update_queries[] = PT_UpdateLangs($value, 'search_for_stations', 'Busca estaciones');
            $lang_update_queries[] = PT_UpdateLangs($value, 'station_search.', 'Búsqueda de estación.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_more_than_3_characters.', 'Por favor, introduzca más de 3 caracteres.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error_found_while_search_stations__please_try_again_later.', 'Se encontró un error al buscar estaciones, por favor intente más tarde.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_already_add_this_station.', 'Ya agregaste esta estación.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'delete_station', 'Eliminar estación');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_more_stations_found', 'No se encontraron más estaciones');
            $lang_update_queries[] = PT_UpdateLangs($value, 'the_track_has_been_moved_to_this_album_successfully.', 'La pista se ha movido al siguiente álbum.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'someone_liked_disliked_one_of_my_tracks', 'A alguien le gustó / no le gustó una de mis canciones');
            $lang_update_queries[] = PT_UpdateLangs($value, 'disliked_your_song.', 'No me gustó tu canción.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'reviewed_your_song.', 'revisó tu canción');
            $lang_update_queries[] = PT_UpdateLangs($value, 'someone_reviewed_one_of_my_tracks', 'Alguien revisó una de mis canciones.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_can_not_import_this_track_because_this_track_is_one_of_soundcloud_go__tracks.', 'No puede importar esta pista porque esta es una de las pistas de SoundCloud Go.');
        } else if ($value == 'turkish') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_users_found', 'Kullanıcı bulunamadı');
            $lang_update_queries[] = PT_UpdateLangs($value, 'show_only_in_track_page', 'Sadece parça sayfasında göster');
            $lang_update_queries[] = PT_UpdateLangs($value, 'show_on_all_pages', 'Tüm sayfalarda göster');
            $lang_update_queries[] = PT_UpdateLangs($value, 'edit_spotlight', 'Spot Işığını Düzenle');
            $lang_update_queries[] = PT_UpdateLangs($value, 'blog', 'Blog');
            $lang_update_queries[] = PT_UpdateLangs($value, '1309', 'Komedi');
            $lang_update_queries[] = PT_UpdateLangs($value, '1310', 'Otomobiller ve Araçlar');
            $lang_update_queries[] = PT_UpdateLangs($value, '1311', 'Ekonomi ve Ticaret');
            $lang_update_queries[] = PT_UpdateLangs($value, '1312', 'Eğitim');
            $lang_update_queries[] = PT_UpdateLangs($value, '1313', 'Eğlence');
            $lang_update_queries[] = PT_UpdateLangs($value, '1314', 'filmler');
            $lang_update_queries[] = PT_UpdateLangs($value, '1315', 'kumar');
            $lang_update_queries[] = PT_UpdateLangs($value, '1316', 'Tarihçe ve Gerçekler');
            $lang_update_queries[] = PT_UpdateLangs($value, '1317', 'Yaşam tarzı');
            $lang_update_queries[] = PT_UpdateLangs($value, '1318', 'Doğal');
            $lang_update_queries[] = PT_UpdateLangs($value, '1319', 'Haberler ve Politika');
            $lang_update_queries[] = PT_UpdateLangs($value, '1320', 'İnsanlar ve Milletler');
            $lang_update_queries[] = PT_UpdateLangs($value, '1321', 'Evcil Hayvanlar ve Hayvanlar');
            $lang_update_queries[] = PT_UpdateLangs($value, '1322', 'Yerler ve Bölgeler');
            $lang_update_queries[] = PT_UpdateLangs($value, '1323', 'Bilim ve Teknoloji');
            $lang_update_queries[] = PT_UpdateLangs($value, '1324', 'Spor');
            $lang_update_queries[] = PT_UpdateLangs($value, '1325', 'Seyahat ve Etkinlikler');
            $lang_update_queries[] = PT_UpdateLangs($value, '1326', 'Diğer');
            $lang_update_queries[] = PT_UpdateLangs($value, 'read_more', 'Daha fazla oku');
            $lang_update_queries[] = PT_UpdateLangs($value, 'categories', 'Kategoriler');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_more_articles_to_show.', 'Gösterilecek başka makale yok.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'article', 'makale');
            $lang_update_queries[] = PT_UpdateLangs($value, 'share_to', 'Paylaş');
            $lang_update_queries[] = PT_UpdateLangs($value, 'blogs', 'Bloglar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_more_articles', 'Gösterilecek başka makale yok');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_more_article_found', 'Başka makale bulunamadı');
            $lang_update_queries[] = PT_UpdateLangs($value, 'delete_song', 'Şarkıyı Sil');
            $lang_update_queries[] = PT_UpdateLangs($value, 'delete_this_song_from_playlist', 'Oynatma listesinden kaldır');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_song_description', 'Lütfen şarkı açıklamasını girin');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_song_tags', 'Lütfen şarkının etiketlerini giriniz');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_upload_song_thumbnail', 'Lütfen şarkı küçük resmini yükleyin');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_have_reached_your_upload_limit__upgrade_to_upload_unlimited_songs.', 'Yükleme sınırınıza ulaştınız, sınırsız şarkı yüklemek için yükseltme yapın.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'advertising', 'reklâm');
            $lang_update_queries[] = PT_UpdateLangs($value, 'wallet', 'Cüzdan');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_ad', 'Yeni Kampanya');
            $lang_update_queries[] = PT_UpdateLangs($value, 'category', 'Kategori');
            $lang_update_queries[] = PT_UpdateLangs($value, 'results', 'Sonuçlar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'spent', 'harcanmış');
            $lang_update_queries[] = PT_UpdateLangs($value, 'action', 'Aksiyon');
            $lang_update_queries[] = PT_UpdateLangs($value, '2checkout', '2Checkout');
            $lang_update_queries[] = PT_UpdateLangs($value, 'address', 'Adres');
            $lang_update_queries[] = PT_UpdateLangs($value, 'city', 'Kent');
            $lang_update_queries[] = PT_UpdateLangs($value, 'state', 'Belirtmek, bildirmek');
            $lang_update_queries[] = PT_UpdateLangs($value, 'zip', 'Zip');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone_number', 'Telefon numarası');
            $lang_update_queries[] = PT_UpdateLangs($value, 'card_number', 'Kart numarası');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay', 'Ödemeli');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replenish', 'Yenileyici');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_check_the_details', 'Lütfen detayları kontrol et');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirmation', 'Onayla');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_to_delete_this_ad_', 'Bu kampanyayı silmek istediğinize emin misiniz?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'deleted', 'silindi');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_check_details', 'please_check_details');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirming_your_payment__please_wait..', 'Ödemenizi onaylayın, lütfen bekleyin ..');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment_declined__please_try_again_later.', 'Ödeme reddedildi, lütfen daha sonra tekrar deneyin.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'my_balance', 'Benim dengem');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replenish_my_balance', 'Bakiyemi doldur');
            $lang_update_queries[] = PT_UpdateLangs($value, 'browse_to_upload', 'Yüklemeye Göz At');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_advertising', 'Yeni Kampanya');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_new_ad', 'Yeni kampanya oluştur');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_current_wallet_balance_is__0__please_top_up_your_wallet_to_continue.', 'Geçerli cüzdan bakiyeniz 0, lütfen devam etmek için cüzdanınızı doldurun.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'top_up', 'Top Up');
            $lang_update_queries[] = PT_UpdateLangs($value, 'url', 'URL');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_media', 'Medya Seç');
            $lang_update_queries[] = PT_UpdateLangs($value, 'target_audience', 'Hedef kitle');
            $lang_update_queries[] = PT_UpdateLangs($value, 'placement', 'Yerleştirme');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pricing', 'Fiyatlandırma');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay_per_click', 'Tıklama başına ödeme');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay_per_impression', 'Gösterim Başına Ödeme');
            $lang_update_queries[] = PT_UpdateLangs($value, 'spending_limit_per_day', 'Günlük harcama limiti');
            $lang_update_queries[] = PT_UpdateLangs($value, 'media_file_is_invalid._please_select_a_valid_image', 'Medya dosyası geçersiz. Lütfen geçerli bir resim seçin');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error_', 'Hata!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'file_is_too_big__max_upload_size_is', 'Dosya çok büyük, Maksimum yükleme boyutu');
            $lang_update_queries[] = PT_UpdateLangs($value, 'media_file_is_invalid._please_select_a_valid_image___video', 'Medya dosyası geçersiz. Lütfen geçerli bir resim / video seçin');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_ad_has_been_published_successfully', 'Kampanyanız başarıyla yayınlandı.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'the_url_is_invalid._please_enter_a_valid_url', 'URL geçersiz. Lütfen geçerli bir adres girin.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ad_title_must_be_between_5_100', 'Kampanya başlığı 5/100 arasında olmalıdır.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'edit_ad', 'Kampanya düzenle');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_changes_to_the_ad_were_successfully_saved', 'Kampanyadaki değişiklikleriniz başarıyla kaydedildi.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'name_must_be_between_5_32', 'İsim 5/32 arasında olmalıdır');
            $lang_update_queries[] = PT_UpdateLangs($value, 'clicks', 'Tıklanma');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ads_analytics', 'Kampanya analizi');
            $lang_update_queries[] = PT_UpdateLangs($value, 'this_year', 'Bu yıl');
            $lang_update_queries[] = PT_UpdateLangs($value, 'view_report', 'Raporu görüntüle');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ad_analytics', 'Kampanya analizi');
            $lang_update_queries[] = PT_UpdateLangs($value, 'sponsor_ads', 'SPONSOR');
            $lang_update_queries[] = PT_UpdateLangs($value, 'by', 'Tarafından');
            $lang_update_queries[] = PT_UpdateLangs($value, 'import', 'İthalat');
            $lang_update_queries[] = PT_UpdateLangs($value, 'import_from_soundcloud.', 'SoundCloud\'dan İçe Aktar.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'enter_the_soundcloud_track_link_and_click_the_button_below.', 'SoundCloud URL\'nizi yukarıya yapıştırın.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error_found_while_importing_your_track__please_try_again_later.', 'Parça içe aktarılırken hata bulundu, lütfen daha sonra tekrar deneyin.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_valid_soundcloud_track_url.', 'Lütfen geçerli bir SoundCloud parça URL\'si girin.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_soundcloud_track_link_to_import.', 'Lütfen içeri aktarmak için SoundCloud track linkini girin.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error_found_while_importing_your_track__please_check_soundcloud_client_id.', 'İzinizi içe aktarırken hata bulundu, lütfen SoundCloud müşteri kimliğini kontrol edin.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'dmca', 'DMCA');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_soundcloud', 'SoundCloud ile giriş yap');
            $lang_update_queries[] = PT_UpdateLangs($value, 'dcma', 'DCMA');
            $lang_update_queries[] = PT_UpdateLangs($value, 'move_to_album', 'Bir albüme taşı');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_albums', 'Albüm seç');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_select_which_album_you_want_to_add_this_song_to.', 'Lütfen bu şarkıyı eklemek istediğiniz albümü seçin.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'review_track', 'Parçayı İncele');
            $lang_update_queries[] = PT_UpdateLangs($value, 'review', 'gözden geçirmek');
            $lang_update_queries[] = PT_UpdateLangs($value, 'review_track.', 'Parçayı gözden geçir.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_your_review.', 'Lütfen yorumunuzu giriniz.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'thanks_for_your_submission.', 'Gönderdiğiniz için teşekkürler.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'reviews', 'yorumlar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_reviews_on_this_track_yet.', 'Bu parça hakkında henüz yorum yapılmamış.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_new_track.', 'yeni parça yükle.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'notification', 'Bildirim');
            $lang_update_queries[] = PT_UpdateLangs($value, 'notification_settings', 'Bildirim ayarları');
            $lang_update_queries[] = PT_UpdateLangs($value, 'someone_followed_me', 'Biri beni takip etti');
            $lang_update_queries[] = PT_UpdateLangs($value, 'someone_liked_one_of_my_tracks', 'Birisi izlerimden birini beğendi');
            $lang_update_queries[] = PT_UpdateLangs($value, 'someone_liked_one_of_my_comments', 'Birisi benim yorumlarımdan birini beğendi');
            $lang_update_queries[] = PT_UpdateLangs($value, 'approve_disapprove_artist_request', 'Sanatçı isteklerini onayla / reddet');
            $lang_update_queries[] = PT_UpdateLangs($value, 'approve_disapprove_bank_payment_request', 'Banka ödeme taleplerini onayla / reddet');
            $lang_update_queries[] = PT_UpdateLangs($value, 'one_of_my_following_upload_new_track', 'Takip eden sanatçılarımdan biri yeni bir parça yükledi');
            $lang_update_queries[] = PT_UpdateLangs($value, 'one_of_my_following_users_upload_new_track', 'Takip eden sanatçılarımdan biri yeni bir parça yükledi');
            $lang_update_queries[] = PT_UpdateLangs($value, 'notify_me_when', 'Bana ne zaman bildir');
            $lang_update_queries[] = PT_UpdateLangs($value, 'new_notification', 'Yeni bildirim');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_can_not_import_this_track_because_this_track_is_imported_before.', 'Bu parça zaten içe aktarıldı, lütfen başka bir parça seçin.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'manage_sessions', 'Oturumları Yönet');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ip_address', 'IP adresi');
            $lang_update_queries[] = PT_UpdateLangs($value, 'platform', 'platform');
            $lang_update_queries[] = PT_UpdateLangs($value, 'browser', 'Tarayıcı');
            $lang_update_queries[] = PT_UpdateLangs($value, 'last_seen', 'Son görülen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'actions', 'Eylemler');
            $lang_update_queries[] = PT_UpdateLangs($value, 'session_expired', 'Oturum süresi doldu');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_session_has_been_expired__please_login_again.', 'Oturumunuzun süresi doldu, lütfen tekrar giriş yapın.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'two-factor_authentication', 'İki faktörlü kimlik doğrulama');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone', 'Telefon');
            $lang_update_queries[] = PT_UpdateLangs($value, 'enable', 'etkinleştirme');
            $lang_update_queries[] = PT_UpdateLangs($value, 'disable', 'Devre Dışı');
            $lang_update_queries[] = PT_UpdateLangs($value, 'turn_on_2-step_login_to_level-up_your_account_s_security__once_turned_on__you_ll_use_both_your_password_and_a_6-digit_security_code_sent_to_your_phone_or_email_to_log_in.', 'Hesabınızı seviyelendirmek için 2 adımlı girişi açın');
            $lang_update_queries[] = PT_UpdateLangs($value, 'a_confirmation_email_has_been_sent.', 'Bir onay e-postası gönderildi.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_an_email_that_contains_the_confirmation_code_to_enable_two-factor_authentication.', 'İki faktörlü kimlik doğrulamayı etkinleştirmek için onay kodunu içeren bir e-posta gönderdik.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirmation_code', 'Onay kodu');
            $lang_update_queries[] = PT_UpdateLangs($value, 'a_confirmation_message_and_email_were_sent.', 'Bir onay mesajı ve e-posta gönderildi.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_a_message_and_an_email_that_contain_the_confirmation_code_to_enable_two-factor_authentication', 'İki faktörlü kimlik doğrulamayı etkinleştirmek için onay kodunu içeren bir mesaj ve e-posta gönderdik');
            $lang_update_queries[] = PT_UpdateLangs($value, 'a_confirmation_message_was_sent.', 'Bir onay mesajı gönderildi.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_a_message_that_contains_the_confirmation_code_to_enable_two-factor_authentication.', 'İki faktörlü kimlik doğrulamayı etkinleştirmek için onay kodunu içeren bir mesaj gönderdik.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_you_an_email_with_the_confirmation_code.', 'Onay kodunu içeren bir e-posta gönderdik.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'wrong_confirmation_code.', 'Yanlış onay kodu.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_e-mail_has_been_successfully_verified.', 'E-posta adresiniz başarıyla doğrulandı.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'unusual_login', 'Olağandışı giriş');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_you_the_confirmation_code_to_your_email_address.', 'Onay kodunu e-posta adresinize gönderdik.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'to_log_in__you_need_to_verify_your_identity.', 'Giriş yapmak için kimliğinizi doğrulamanız gerekir.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'welcome...', 'Tekrar hoşgeldiniz!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'stations', 'İstasyonlar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_stations_found', 'İstasyon bulunamadı');
            $lang_update_queries[] = PT_UpdateLangs($value, 'add_station', 'İstasyon ekle');
            $lang_update_queries[] = PT_UpdateLangs($value, 'search_for_stations', 'İstasyonları ara');
            $lang_update_queries[] = PT_UpdateLangs($value, 'station_search.', 'İstasyon Arama.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_more_than_3_characters.', 'Lütfen 3 karakterden fazla girin.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error_found_while_search_stations__please_try_again_later.', 'Arama istasyonlarında hata bulundu, lütfen daha sonra tekrar deneyin.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_already_add_this_station.', 'Bu istasyonu zaten eklediniz.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'delete_station', 'İstasyonu Sil');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_more_stations_found', 'Başka istasyon bulunamadı');
            $lang_update_queries[] = PT_UpdateLangs($value, 'the_track_has_been_moved_to_this_album_successfully.', 'Parça aşağıdaki albüme taşındı.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'someone_liked_disliked_one_of_my_tracks', 'Birisi izlerimden birini beğendi / beğenmedi');
            $lang_update_queries[] = PT_UpdateLangs($value, 'disliked_your_song.', 'şarkından hoşlanmadı.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'reviewed_your_song.', 'şarkını inceledi.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'someone_reviewed_one_of_my_tracks', 'Birisi izlerimden birini inceledi');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_can_not_import_this_track_because_this_track_is_one_of_soundcloud_go__tracks.', 'Bu parçayı içe aktaramazsınız çünkü bu parça SoundCloud Go parçalarından biridir.');
        } else if ($value == 'english') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_users_found', 'No users found');
            $lang_update_queries[] = PT_UpdateLangs($value, 'show_only_in_track_page', 'Show only in track page');
            $lang_update_queries[] = PT_UpdateLangs($value, 'show_on_all_pages', 'Show on all pages');
            $lang_update_queries[] = PT_UpdateLangs($value, 'edit_spotlight', 'Edit Spotlight');
            $lang_update_queries[] = PT_UpdateLangs($value, 'blog', 'Blog');
            $lang_update_queries[] = PT_UpdateLangs($value, '1309', 'Comedy');
            $lang_update_queries[] = PT_UpdateLangs($value, '1310', 'Cars and Vehicles');
            $lang_update_queries[] = PT_UpdateLangs($value, '1311', 'Economics and Trade');
            $lang_update_queries[] = PT_UpdateLangs($value, '1312', 'Education');
            $lang_update_queries[] = PT_UpdateLangs($value, '1313', 'Entertainment');
            $lang_update_queries[] = PT_UpdateLangs($value, '1314', 'Movies & Animation');
            $lang_update_queries[] = PT_UpdateLangs($value, '1315', 'Gaming');
            $lang_update_queries[] = PT_UpdateLangs($value, '1316', 'History and Facts');
            $lang_update_queries[] = PT_UpdateLangs($value, '1317', 'Live Style');
            $lang_update_queries[] = PT_UpdateLangs($value, '1318', 'Natural');
            $lang_update_queries[] = PT_UpdateLangs($value, '1319', 'News and Politics');
            $lang_update_queries[] = PT_UpdateLangs($value, '1320', 'People and Nations');
            $lang_update_queries[] = PT_UpdateLangs($value, '1321', 'Pets and Animals');
            $lang_update_queries[] = PT_UpdateLangs($value, '1322', 'Places and Regions');
            $lang_update_queries[] = PT_UpdateLangs($value, '1323', 'Science and Technology');
            $lang_update_queries[] = PT_UpdateLangs($value, '1324', 'Sport');
            $lang_update_queries[] = PT_UpdateLangs($value, '1325', 'Travel and Events');
            $lang_update_queries[] = PT_UpdateLangs($value, '1326', 'Other');
            $lang_update_queries[] = PT_UpdateLangs($value, 'read_more', 'Read more');
            $lang_update_queries[] = PT_UpdateLangs($value, 'categories', 'Categories');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_more_articles_to_show.', 'No more articles to show.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'article', 'Article');
            $lang_update_queries[] = PT_UpdateLangs($value, 'share_to', 'Share to');
            $lang_update_queries[] = PT_UpdateLangs($value, 'blogs', 'Blogs');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_more_articles', 'No more articles to show');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_more_article_found', 'No more articles found');
            $lang_update_queries[] = PT_UpdateLangs($value, 'delete_song', 'Delete Song');
            $lang_update_queries[] = PT_UpdateLangs($value, 'delete_this_song_from_playlist', 'Remove from playlist');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_song_description', 'Please enter the song description');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_song_tags', 'Please enter song\'s tags');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_upload_song_thumbnail', 'Please upload song thumbnail');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_have_reached_your_upload_limit__upgrade_to_upload_unlimited_songs.', 'You have reached your upload limit, upgrade to upload unlimited songs.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'advertising', 'Advertising');
            $lang_update_queries[] = PT_UpdateLangs($value, 'wallet', 'Wallet');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_ad', 'New Campaign');
            $lang_update_queries[] = PT_UpdateLangs($value, 'category', 'Category');
            $lang_update_queries[] = PT_UpdateLangs($value, 'results', 'Results');
            $lang_update_queries[] = PT_UpdateLangs($value, 'spent', 'Spent');
            $lang_update_queries[] = PT_UpdateLangs($value, 'action', 'Action');
            $lang_update_queries[] = PT_UpdateLangs($value, '2checkout', '2Checkout');
            $lang_update_queries[] = PT_UpdateLangs($value, 'address', 'Address');
            $lang_update_queries[] = PT_UpdateLangs($value, 'city', 'City');
            $lang_update_queries[] = PT_UpdateLangs($value, 'state', 'State');
            $lang_update_queries[] = PT_UpdateLangs($value, 'zip', 'Zip');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone_number', 'Phone number');
            $lang_update_queries[] = PT_UpdateLangs($value, 'card_number', 'Card Number');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay', 'Pay');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replenish', 'Replenish');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_check_the_details', 'Please check the details');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirmation', 'Confirmation');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_to_delete_this_ad_', 'Are you sure you want to delete this campaign?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'deleted', 'deleted');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_check_details', 'please_check_details');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirming_your_payment__please_wait..', 'Confirming your payment, please wait..');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment_declined__please_try_again_later.', 'Payment declined, please try again later.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'my_balance', 'My Balance');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replenish_my_balance', 'Replenish My Balance');
            $lang_update_queries[] = PT_UpdateLangs($value, 'browse_to_upload', 'Browse To Upload');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_advertising', 'New campaign ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_new_ad', 'Create new campaign');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_current_wallet_balance_is__0__please_top_up_your_wallet_to_continue.', 'Your current wallet balance is 0, please top up your wallet to continue.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'top_up', 'Top Up');
            $lang_update_queries[] = PT_UpdateLangs($value, 'url', 'URL');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_media', 'Select Media');
            $lang_update_queries[] = PT_UpdateLangs($value, 'target_audience', 'Target Audience');
            $lang_update_queries[] = PT_UpdateLangs($value, 'placement', 'Placement');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pricing', 'Pricing');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay_per_click', 'Pay Per Click');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay_per_impression', 'Pay Per Impression');
            $lang_update_queries[] = PT_UpdateLangs($value, 'spending_limit_per_day', 'Spending limit per day');
            $lang_update_queries[] = PT_UpdateLangs($value, 'media_file_is_invalid._please_select_a_valid_image', 'Media file is invalid. Please select a valid image');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error_', 'Error!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'file_is_too_big__max_upload_size_is', 'File is too big, Max upload size is');
            $lang_update_queries[] = PT_UpdateLangs($value, 'media_file_is_invalid._please_select_a_valid_image___video', 'Media file is invalid. Please select a valid image / video');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_ad_has_been_published_successfully', 'Your campaign has been published successfully.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'the_url_is_invalid._please_enter_a_valid_url', 'The URL is invalid. Please enter a valid URL.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ad_title_must_be_between_5_100', 'Campaign title must be between 5/100.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'edit_ad', 'Edit campaign');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_changes_to_the_ad_were_successfully_saved', 'Your changes to the campaign were successfully saved.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'name_must_be_between_5_32', 'Name must be between 5/32');
            $lang_update_queries[] = PT_UpdateLangs($value, 'clicks', 'Clicks');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ads_analytics', 'Campaign analytics');
            $lang_update_queries[] = PT_UpdateLangs($value, 'this_year', 'This year');
            $lang_update_queries[] = PT_UpdateLangs($value, 'view_report', 'View report');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ad_analytics', 'Campaign analytics');
            $lang_update_queries[] = PT_UpdateLangs($value, 'sponsor_ads', 'SPONSOR');
            $lang_update_queries[] = PT_UpdateLangs($value, 'by', 'By');
            $lang_update_queries[] = PT_UpdateLangs($value, 'import', 'Import');
            $lang_update_queries[] = PT_UpdateLangs($value, 'import_from_soundcloud.', 'Import From SoundCloud.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'enter_the_soundcloud_track_link_and_click_the_button_below.', 'Paste your SoundCloud URL above.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error_found_while_importing_your_track__please_try_again_later.', 'Error found while importing your track, please try again later.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_valid_soundcloud_track_url.', 'Please enter a valid SoundCloud track URL.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_soundcloud_track_link_to_import.', 'Please enter SoundCloud track link to import.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error_found_while_importing_your_track__please_check_soundcloud_client_id.', 'Error found while importing your track, please check SoundCloud client ID.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'dmca', 'DMCA');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_soundcloud', 'Login with SoundCloud');
            $lang_update_queries[] = PT_UpdateLangs($value, 'dcma', 'DCMA');
            $lang_update_queries[] = PT_UpdateLangs($value, 'move_to_album', 'Move to an album');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_albums', 'Select albums');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_select_which_album_you_want_to_add_this_song_to.', 'Please select which album you want to add this song to.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'review_track', 'Review Track');
            $lang_update_queries[] = PT_UpdateLangs($value, 'review', 'Review');
            $lang_update_queries[] = PT_UpdateLangs($value, 'review_track.', 'Review track.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_your_review.', 'Please enter your review.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'thanks_for_your_submission.', 'Thanks for your submission.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'reviews', 'Reviews');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_reviews_on_this_track_yet.', 'No reviews on this track yet.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_new_track.', 'upload new track.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'notification', 'Notification');
            $lang_update_queries[] = PT_UpdateLangs($value, 'notification_settings', 'Notification Settings');
            $lang_update_queries[] = PT_UpdateLangs($value, 'someone_followed_me', 'Someone followed me');
            $lang_update_queries[] = PT_UpdateLangs($value, 'someone_liked_one_of_my_tracks', 'Someone liked one of my tracks');
            $lang_update_queries[] = PT_UpdateLangs($value, 'someone_liked_one_of_my_comments', 'Someone liked one of my comments');
            $lang_update_queries[] = PT_UpdateLangs($value, 'approve_disapprove_artist_request', 'Approve/Disapprove artist request(s)');
            $lang_update_queries[] = PT_UpdateLangs($value, 'approve_disapprove_bank_payment_request', 'Approve/Disapprove bank payment request(s)');
            $lang_update_queries[] = PT_UpdateLangs($value, 'one_of_my_following_upload_new_track', 'One of my following artists uploaded a new track');
            $lang_update_queries[] = PT_UpdateLangs($value, 'one_of_my_following_users_upload_new_track', 'One of my following artists uploaded a new track');
            $lang_update_queries[] = PT_UpdateLangs($value, 'notify_me_when', 'Notify me when');
            $lang_update_queries[] = PT_UpdateLangs($value, 'new_notification', 'New notification');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_can_not_import_this_track_because_this_track_is_imported_before.', 'This track is already imported, please choose another track.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'manage_sessions', 'Manage Sessions');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ip_address', 'IP Address');
            $lang_update_queries[] = PT_UpdateLangs($value, 'platform', 'Platform');
            $lang_update_queries[] = PT_UpdateLangs($value, 'browser', 'Browser');
            $lang_update_queries[] = PT_UpdateLangs($value, 'last_seen', 'Last Seen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'actions', 'Actions');
            $lang_update_queries[] = PT_UpdateLangs($value, 'session_expired', 'Session Expired');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_session_has_been_expired__please_login_again.', 'Your Session has been expired, please login again.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'two-factor_authentication', 'Two-factor authentication');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone', 'Phone');
            $lang_update_queries[] = PT_UpdateLangs($value, 'enable', 'Enable');
            $lang_update_queries[] = PT_UpdateLangs($value, 'disable', 'Disable');
            $lang_update_queries[] = PT_UpdateLangs($value, 'turn_on_2-step_login_to_level-up_your_account_s_security__once_turned_on__you_ll_use_both_your_password_and_a_6-digit_security_code_sent_to_your_phone_or_email_to_log_in.', 'Turn on 2-step login to level-up your account\'s security, Once turned on, you\'ll use both your password and a 6-digit security code sent to your phone or email to log in.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'a_confirmation_email_has_been_sent.', 'A confirmation email has been sent.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_an_email_that_contains_the_confirmation_code_to_enable_two-factor_authentication.', 'We have sent an email that contains the confirmation code to enable Two-factor authentication.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirmation_code', 'Confirmation code');
            $lang_update_queries[] = PT_UpdateLangs($value, 'a_confirmation_message_and_email_were_sent.', 'A confirmation message and email were sent.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_a_message_and_an_email_that_contain_the_confirmation_code_to_enable_two-factor_authentication', 'We have sent a message and an email that contain the confirmation code to enable two-factor authentication');
            $lang_update_queries[] = PT_UpdateLangs($value, 'a_confirmation_message_was_sent.', 'A confirmation message was sent.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_a_message_that_contains_the_confirmation_code_to_enable_two-factor_authentication.', 'We have sent a message that contains the confirmation code to enable Two-factor authentication.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_you_an_email_with_the_confirmation_code.', 'We have sent you an email with the confirmation code.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'wrong_confirmation_code.', 'Wrong confirmation code.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_e-mail_has_been_successfully_verified.', 'Your E-mail has been successfully verified.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'unusual_login', 'Unusual login');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_you_the_confirmation_code_to_your_email_address.', 'We have sent you the confirmation code to your email address.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'to_log_in__you_need_to_verify_your_identity.', 'To log in, you need to verify your identity.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'welcome...', 'Welcome Back!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'stations', 'Stations');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_stations_found', 'No stations found');
            $lang_update_queries[] = PT_UpdateLangs($value, 'add_station', 'Add Station');
            $lang_update_queries[] = PT_UpdateLangs($value, 'search_for_stations', 'Search for stations');
            $lang_update_queries[] = PT_UpdateLangs($value, 'station_search.', 'Station Search.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_more_than_3_characters.', 'Please enter more than 3 characters.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error_found_while_search_stations__please_try_again_later.', 'Error found while search stations, please try again later.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_already_add_this_station.', 'You already add this station.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'delete_station', 'Delete Station');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_more_stations_found', 'No more stations found');
            $lang_update_queries[] = PT_UpdateLangs($value, 'the_track_has_been_moved_to_this_album_successfully.', 'The track has been moved to following album.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'someone_liked_disliked_one_of_my_tracks', 'Someone liked/disliked one of my tracks');
            $lang_update_queries[] = PT_UpdateLangs($value, 'disliked_your_song.', 'disliked your song.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'reviewed_your_song.', 'reviewed your song.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'someone_reviewed_one_of_my_tracks', 'Someone reviewed one of my tracks');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_can_not_import_this_track_because_this_track_is_one_of_soundcloud_go__tracks.', 'You can not import this track because this track is one of SoundCloud Go+ tracks.');
        } else if ($value != 'english') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_users_found', 'No users found');
            $lang_update_queries[] = PT_UpdateLangs($value, 'show_only_in_track_page', 'Show only in track page');
            $lang_update_queries[] = PT_UpdateLangs($value, 'show_on_all_pages', 'Show on all pages');
            $lang_update_queries[] = PT_UpdateLangs($value, 'edit_spotlight', 'Edit Spotlight');
            $lang_update_queries[] = PT_UpdateLangs($value, 'blog', 'Blog');
            $lang_update_queries[] = PT_UpdateLangs($value, '1309', 'Comedy');
            $lang_update_queries[] = PT_UpdateLangs($value, '1310', 'Cars and Vehicles');
            $lang_update_queries[] = PT_UpdateLangs($value, '1311', 'Economics and Trade');
            $lang_update_queries[] = PT_UpdateLangs($value, '1312', 'Education');
            $lang_update_queries[] = PT_UpdateLangs($value, '1313', 'Entertainment');
            $lang_update_queries[] = PT_UpdateLangs($value, '1314', 'Movies & Animation');
            $lang_update_queries[] = PT_UpdateLangs($value, '1315', 'Gaming');
            $lang_update_queries[] = PT_UpdateLangs($value, '1316', 'History and Facts');
            $lang_update_queries[] = PT_UpdateLangs($value, '1317', 'Live Style');
            $lang_update_queries[] = PT_UpdateLangs($value, '1318', 'Natural');
            $lang_update_queries[] = PT_UpdateLangs($value, '1319', 'News and Politics');
            $lang_update_queries[] = PT_UpdateLangs($value, '1320', 'People and Nations');
            $lang_update_queries[] = PT_UpdateLangs($value, '1321', 'Pets and Animals');
            $lang_update_queries[] = PT_UpdateLangs($value, '1322', 'Places and Regions');
            $lang_update_queries[] = PT_UpdateLangs($value, '1323', 'Science and Technology');
            $lang_update_queries[] = PT_UpdateLangs($value, '1324', 'Sport');
            $lang_update_queries[] = PT_UpdateLangs($value, '1325', 'Travel and Events');
            $lang_update_queries[] = PT_UpdateLangs($value, '1326', 'Other');
            $lang_update_queries[] = PT_UpdateLangs($value, 'read_more', 'Read more');
            $lang_update_queries[] = PT_UpdateLangs($value, 'categories', 'Categories');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_more_articles_to_show.', 'No more articles to show.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'article', 'Article');
            $lang_update_queries[] = PT_UpdateLangs($value, 'share_to', 'Share to');
            $lang_update_queries[] = PT_UpdateLangs($value, 'blogs', 'Blogs');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_more_articles', 'No more articles to show');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_more_article_found', 'No more articles found');
            $lang_update_queries[] = PT_UpdateLangs($value, 'delete_song', 'Delete Song');
            $lang_update_queries[] = PT_UpdateLangs($value, 'delete_this_song_from_playlist', 'Remove from playlist');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_song_description', 'Please enter the song description');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_song_tags', 'Please enter song\'s tags');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_upload_song_thumbnail', 'Please upload song thumbnail');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_have_reached_your_upload_limit__upgrade_to_upload_unlimited_songs.', 'You have reached your upload limit, upgrade to upload unlimited songs.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'advertising', 'Advertising');
            $lang_update_queries[] = PT_UpdateLangs($value, 'wallet', 'Wallet');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_ad', 'New Campaign');
            $lang_update_queries[] = PT_UpdateLangs($value, 'category', 'Category');
            $lang_update_queries[] = PT_UpdateLangs($value, 'results', 'Results');
            $lang_update_queries[] = PT_UpdateLangs($value, 'spent', 'Spent');
            $lang_update_queries[] = PT_UpdateLangs($value, 'action', 'Action');
            $lang_update_queries[] = PT_UpdateLangs($value, '2checkout', '2Checkout');
            $lang_update_queries[] = PT_UpdateLangs($value, 'address', 'Address');
            $lang_update_queries[] = PT_UpdateLangs($value, 'city', 'City');
            $lang_update_queries[] = PT_UpdateLangs($value, 'state', 'State');
            $lang_update_queries[] = PT_UpdateLangs($value, 'zip', 'Zip');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone_number', 'Phone number');
            $lang_update_queries[] = PT_UpdateLangs($value, 'card_number', 'Card Number');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay', 'Pay');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replenish', 'Replenish');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_check_the_details', 'Please check the details');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirmation', 'Confirmation');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_to_delete_this_ad_', 'Are you sure you want to delete this campaign?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'deleted', 'deleted');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_check_details', 'please_check_details');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirming_your_payment__please_wait..', 'Confirming your payment, please wait..');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment_declined__please_try_again_later.', 'Payment declined, please try again later.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'my_balance', 'My Balance');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replenish_my_balance', 'Replenish My Balance');
            $lang_update_queries[] = PT_UpdateLangs($value, 'browse_to_upload', 'Browse To Upload');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_advertising', 'New campaign ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_new_ad', 'Create new campaign');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_current_wallet_balance_is__0__please_top_up_your_wallet_to_continue.', 'Your current wallet balance is 0, please top up your wallet to continue.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'top_up', 'Top Up');
            $lang_update_queries[] = PT_UpdateLangs($value, 'url', 'URL');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_media', 'Select Media');
            $lang_update_queries[] = PT_UpdateLangs($value, 'target_audience', 'Target Audience');
            $lang_update_queries[] = PT_UpdateLangs($value, 'placement', 'Placement');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pricing', 'Pricing');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay_per_click', 'Pay Per Click');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay_per_impression', 'Pay Per Impression');
            $lang_update_queries[] = PT_UpdateLangs($value, 'spending_limit_per_day', 'Spending limit per day');
            $lang_update_queries[] = PT_UpdateLangs($value, 'media_file_is_invalid._please_select_a_valid_image', 'Media file is invalid. Please select a valid image');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error_', 'Error!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'file_is_too_big__max_upload_size_is', 'File is too big, Max upload size is');
            $lang_update_queries[] = PT_UpdateLangs($value, 'media_file_is_invalid._please_select_a_valid_image___video', 'Media file is invalid. Please select a valid image / video');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_ad_has_been_published_successfully', 'Your campaign has been published successfully.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'the_url_is_invalid._please_enter_a_valid_url', 'The URL is invalid. Please enter a valid URL.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ad_title_must_be_between_5_100', 'Campaign title must be between 5/100.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'edit_ad', 'Edit campaign');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_changes_to_the_ad_were_successfully_saved', 'Your changes to the campaign were successfully saved.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'name_must_be_between_5_32', 'Name must be between 5/32');
            $lang_update_queries[] = PT_UpdateLangs($value, 'clicks', 'Clicks');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ads_analytics', 'Campaign analytics');
            $lang_update_queries[] = PT_UpdateLangs($value, 'this_year', 'This year');
            $lang_update_queries[] = PT_UpdateLangs($value, 'view_report', 'View report');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ad_analytics', 'Campaign analytics');
            $lang_update_queries[] = PT_UpdateLangs($value, 'sponsor_ads', 'SPONSOR');
            $lang_update_queries[] = PT_UpdateLangs($value, 'by', 'By');
            $lang_update_queries[] = PT_UpdateLangs($value, 'import', 'Import');
            $lang_update_queries[] = PT_UpdateLangs($value, 'import_from_soundcloud.', 'Import From SoundCloud.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'enter_the_soundcloud_track_link_and_click_the_button_below.', 'Paste your SoundCloud URL above.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error_found_while_importing_your_track__please_try_again_later.', 'Error found while importing your track, please try again later.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_valid_soundcloud_track_url.', 'Please enter a valid SoundCloud track URL.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_soundcloud_track_link_to_import.', 'Please enter SoundCloud track link to import.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error_found_while_importing_your_track__please_check_soundcloud_client_id.', 'Error found while importing your track, please check SoundCloud client ID.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'dmca', 'DMCA');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_soundcloud', 'Login with SoundCloud');
            $lang_update_queries[] = PT_UpdateLangs($value, 'dcma', 'DCMA');
            $lang_update_queries[] = PT_UpdateLangs($value, 'move_to_album', 'Move to an album');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_albums', 'Select albums');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_select_which_album_you_want_to_add_this_song_to.', 'Please select which album you want to add this song to.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'review_track', 'Review Track');
            $lang_update_queries[] = PT_UpdateLangs($value, 'review', 'Review');
            $lang_update_queries[] = PT_UpdateLangs($value, 'review_track.', 'Review track.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_your_review.', 'Please enter your review.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'thanks_for_your_submission.', 'Thanks for your submission.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'reviews', 'Reviews');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_reviews_on_this_track_yet.', 'No reviews on this track yet.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_new_track.', 'upload new track.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'notification', 'Notification');
            $lang_update_queries[] = PT_UpdateLangs($value, 'notification_settings', 'Notification Settings');
            $lang_update_queries[] = PT_UpdateLangs($value, 'someone_followed_me', 'Someone followed me');
            $lang_update_queries[] = PT_UpdateLangs($value, 'someone_liked_one_of_my_tracks', 'Someone liked one of my tracks');
            $lang_update_queries[] = PT_UpdateLangs($value, 'someone_liked_one_of_my_comments', 'Someone liked one of my comments');
            $lang_update_queries[] = PT_UpdateLangs($value, 'approve_disapprove_artist_request', 'Approve/Disapprove artist request(s)');
            $lang_update_queries[] = PT_UpdateLangs($value, 'approve_disapprove_bank_payment_request', 'Approve/Disapprove bank payment request(s)');
            $lang_update_queries[] = PT_UpdateLangs($value, 'one_of_my_following_upload_new_track', 'One of my following artists uploaded a new track');
            $lang_update_queries[] = PT_UpdateLangs($value, 'one_of_my_following_users_upload_new_track', 'One of my following artists uploaded a new track');
            $lang_update_queries[] = PT_UpdateLangs($value, 'notify_me_when', 'Notify me when');
            $lang_update_queries[] = PT_UpdateLangs($value, 'new_notification', 'New notification');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_can_not_import_this_track_because_this_track_is_imported_before.', 'This track is already imported, please choose another track.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'manage_sessions', 'Manage Sessions');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ip_address', 'IP Address');
            $lang_update_queries[] = PT_UpdateLangs($value, 'platform', 'Platform');
            $lang_update_queries[] = PT_UpdateLangs($value, 'browser', 'Browser');
            $lang_update_queries[] = PT_UpdateLangs($value, 'last_seen', 'Last Seen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'actions', 'Actions');
            $lang_update_queries[] = PT_UpdateLangs($value, 'session_expired', 'Session Expired');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_session_has_been_expired__please_login_again.', 'Your Session has been expired, please login again.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'two-factor_authentication', 'Two-factor authentication');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone', 'Phone');
            $lang_update_queries[] = PT_UpdateLangs($value, 'enable', 'Enable');
            $lang_update_queries[] = PT_UpdateLangs($value, 'disable', 'Disable');
            $lang_update_queries[] = PT_UpdateLangs($value, 'turn_on_2-step_login_to_level-up_your_account_s_security__once_turned_on__you_ll_use_both_your_password_and_a_6-digit_security_code_sent_to_your_phone_or_email_to_log_in.', 'Turn on 2-step login to level-up your account\'s security, Once turned on, you\'ll use both your password and a 6-digit security code sent to your phone or email to log in.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'a_confirmation_email_has_been_sent.', 'A confirmation email has been sent.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_an_email_that_contains_the_confirmation_code_to_enable_two-factor_authentication.', 'We have sent an email that contains the confirmation code to enable Two-factor authentication.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirmation_code', 'Confirmation code');
            $lang_update_queries[] = PT_UpdateLangs($value, 'a_confirmation_message_and_email_were_sent.', 'A confirmation message and email were sent.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_a_message_and_an_email_that_contain_the_confirmation_code_to_enable_two-factor_authentication', 'We have sent a message and an email that contain the confirmation code to enable two-factor authentication');
            $lang_update_queries[] = PT_UpdateLangs($value, 'a_confirmation_message_was_sent.', 'A confirmation message was sent.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_a_message_that_contains_the_confirmation_code_to_enable_two-factor_authentication.', 'We have sent a message that contains the confirmation code to enable Two-factor authentication.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_you_an_email_with_the_confirmation_code.', 'We have sent you an email with the confirmation code.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'wrong_confirmation_code.', 'Wrong confirmation code.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_e-mail_has_been_successfully_verified.', 'Your E-mail has been successfully verified.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'unusual_login', 'Unusual login');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_you_the_confirmation_code_to_your_email_address.', 'We have sent you the confirmation code to your email address.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'to_log_in__you_need_to_verify_your_identity.', 'To log in, you need to verify your identity.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'welcome...', 'Welcome Back!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'stations', 'Stations');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_stations_found', 'No stations found');
            $lang_update_queries[] = PT_UpdateLangs($value, 'add_station', 'Add Station');
            $lang_update_queries[] = PT_UpdateLangs($value, 'search_for_stations', 'Search for stations');
            $lang_update_queries[] = PT_UpdateLangs($value, 'station_search.', 'Station Search.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_enter_more_than_3_characters.', 'Please enter more than 3 characters.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error_found_while_search_stations__please_try_again_later.', 'Error found while search stations, please try again later.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_already_add_this_station.', 'You already add this station.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'delete_station', 'Delete Station');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_more_stations_found', 'No more stations found');
            $lang_update_queries[] = PT_UpdateLangs($value, 'the_track_has_been_moved_to_this_album_successfully.', 'The track has been moved to following album.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'someone_liked_disliked_one_of_my_tracks', 'Someone liked/disliked one of my tracks');
            $lang_update_queries[] = PT_UpdateLangs($value, 'disliked_your_song.', 'disliked your song.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'reviewed_your_song.', 'reviewed your song.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'someone_reviewed_one_of_my_tracks', 'Someone reviewed one of my tracks');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_can_not_import_this_track_because_this_track_is_one_of_soundcloud_go__tracks.', 'You can not import this track because this track is one of SoundCloud Go+ tracks.');
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
                     <h2 class="light">Update to v1.3 </span></h2>
                     <div class="setting-well">
                        <h4>Changelog</h4>
                        <ul class="wo_update_changelog">
                            <li>[Added] blog system (only admin can create blogs).</li>
                            <li>[Added] Advertisement: Display ads on your websites.</li>
                            <li>[Added] Ability to import from sound cloud.</li>
                            <li>[Added] Ability to Login via soundcloud.</li>
                            <li>[Added] Ability to add preexisting single/song into an album.</li>
                            <li>[Added] Ability to edit/move song position in an album.</li>
                            <li>[Added] Ability to review song.</li>
                            <li>[Added] custom fields.</li>
                            <li>[Added] DMCA page.</li>
                            <li>[Added] Notification management system (Users can choose what kind of notifications they want to get).</li>
                            <li>[Added] Session manager (users can view / manage browser / platforms where they are logged in).</li>
                            <li>[Added] Two-factor authentication system using email or phone.</li>
                            <li>[Added] Confirmation system when user login from new location.</li>
                            <li>[Added] Twilio API for sending SMS messages.</li>
                            <li>[Added] new APIs.</li>
                            <li>[Added] Mass notifications.</li>
                            <li>[Added] Invitation Codes.</li>
                            <li>[Added] Radio stations.</li>
                            <li>[Fixed] 20+ reported bugs.</li>
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
    "UPDATE `config` SET value = '1.3' WHERE name = 'version';",
    "ALTER TABLE `songs` ADD `sort_order` INT(11) UNSIGNED NULL DEFAULT '0' AFTER `display_embed`;",
    "ALTER TABLE `songs` ADD `src` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' AFTER `sort_order`;",
    "CREATE TABLE IF NOT EXISTS `reviews` (`id` int(11) NOT NULL,`track_id` int(11) NOT NULL DEFAULT '0',`user_id` int(11) NOT NULL DEFAULT '0',`description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,`rate` int(11) UNSIGNED NOT NULL DEFAULT '0',`time` int(11) NOT NULL DEFAULT '0') ENGINE=InnoDB DEFAULT CHARSET=utf8;",
    "ALTER TABLE `reviews`ADD PRIMARY KEY (`id`),ADD KEY `track_id` (`track_id`),ADD KEY `user_id` (`user_id`),ADD KEY `rate` (`rate`),ADD KEY `time` (`time`);",
    "ALTER TABLE `reviews` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;",
    "CREATE TABLE IF NOT EXISTS `ads_transactions` (`id` int(11) NOT NULL,`ad_id` int(11) NOT NULL DEFAULT '0',`track_owner` int(11) NOT NULL DEFAULT '0',`amount` varchar(11) NOT NULL DEFAULT '0',`type` varchar(50) NOT NULL DEFAULT '',`time` varchar(100) NOT NULL DEFAULT '') ENGINE=InnoDB DEFAULT CHARSET=utf8;",
    "CREATE TABLE IF NOT EXISTS `user_ads` (`id` int(11) NOT NULL,`name` varchar(500) NOT NULL DEFAULT '',`results` int(11) NOT NULL DEFAULT '0',`spent` varchar(20) NOT NULL DEFAULT '0',`status` int(1) NOT NULL DEFAULT '1',`audience` text,`category` varchar(50) NOT NULL DEFAULT '',`media` varchar(1000) NOT NULL DEFAULT '',`url` varchar(3000) NOT NULL DEFAULT '',`user_id` int(11) NOT NULL DEFAULT '0',`placement` varchar(50) NOT NULL DEFAULT '',`posted` varchar(50) NOT NULL DEFAULT '0',`headline` varchar(1000) NOT NULL DEFAULT '',`description` varchar(1000) NOT NULL DEFAULT '',`location` varchar(1000) NOT NULL DEFAULT '',`type` varchar(50) NOT NULL DEFAULT '',`day_limit` varchar(11) NOT NULL DEFAULT '0',`day` varchar(50) NOT NULL DEFAULT '',`day_spend` varchar(11) NOT NULL DEFAULT '0') ENGINE=InnoDB DEFAULT CHARSET=utf8;",
    "ALTER TABLE `ads_transactions` ADD PRIMARY KEY (`id`);",
    "ALTER TABLE `user_ads` ADD PRIMARY KEY (`id`), ADD KEY `type` (`type`), ADD KEY `location` (`location`(255)), ADD KEY `placement` (`placement`), ADD KEY `user_id` (`user_id`), ADD KEY `category` (`category`), ADD KEY `status` (`status`);",
    "ALTER TABLE `ads_transactions` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;",
    "ALTER TABLE `user_ads` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;",
    "ALTER TABLE `terms` CHANGE `type` `type` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '';",
    "ALTER TABLE `terms` CHANGE `content` `content` LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;",
    "CREATE TABLE IF NOT EXISTS `blog` ( `id` int(11) NOT NULL, `title` varchar(120) NOT NULL DEFAULT '', `content` text, `description` text, `posted` varchar(300) DEFAULT '0', `category` int(255) DEFAULT '0', `thumbnail` varchar(100) DEFAULT 'upload/photos/d-blog.jpg', `view` int(11) DEFAULT '0', `shared` int(11) DEFAULT '0', `tags` varchar(300) DEFAULT '', `created_at` int(11) NOT NULL DEFAULT '0') ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES(NULL, 'usr_v_mon', 'on'),(NULL, 'stripe_id', ''),(NULL, 'ad_v_price', '0.1'),(NULL, 'pub_price', '0.02'),(NULL, 'ad_c_price', '0.5'),(NULL, 'sound_cloud_client_id', ''),(NULL, 'soundcloud_login', 'off'),(NULL, 'sound_cloud_client_secret', ''),(NULL, 'emailNotification', 'off'),(NULL, 'login_auth', '0'),(NULL, 'two_factor', '0'),(NULL, 'two_factor_type', 'email'),(NULL, 'sms_twilio_username', ''),(NULL, 'sms_twilio_password', ''),(NULL, 'sms_t_phone_number', ''),(NULL, 'sms_phone_number', ''),(NULL, 'rapidapi_key', '69bd0c7193msh3c4abb39db3a82fp18c336jsn8470910ae9f0'),(NULL, 'soundcloud_go', 'off');",
    "ALTER TABLE `blog` ADD PRIMARY KEY (`id`), ADD KEY `title` (`title`), ADD KEY `category` (`category`), ADD KEY `tags` (`tags`(255));",
    "ALTER TABLE `blog` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;",
    "ALTER TABLE `langs` ADD `ref` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' AFTER `id`;",
    "ALTER TABLE `langs` ADD INDEX(`ref`);",
    "ALTER TABLE `langs` ADD `options` TEXT NOT NULL AFTER `id`;",
    "ALTER TABLE `langs` CHANGE `options` `options` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `ref`;",
    "INSERT INTO `terms` (`id`, `type`, `content`) VALUES (NULL, 'dmca', '&lt;h4&gt;1- Write your DMCA Notice.&lt;/h4&gt; &lt;br&gt;                &lt;p&gt;Lorem ipsum dolor sit amet, consectetur adisdpisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis sdnostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse          cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/p&gt; &lt;br&gt;                &lt;br&gt; &lt;br&gt;                &lt;h4&gt;2- Random title&lt;/h4&gt; &lt;br&gt;                &lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/p&gt;');",
    "ALTER TABLE `users` ADD `email_on_follow_user` INT(11) UNSIGNED NULL DEFAULT '0' AFTER `web_device_id`, ADD `email_on_liked_track` INT(11) UNSIGNED NULL DEFAULT '0' AFTER `email_on_follow_user`, ADD `email_on_liked_comment` INT(11) UNSIGNED NULL DEFAULT '0' AFTER `email_on_liked_track`, ADD `email_on_artist_status_changed` INT(11) UNSIGNED NULL DEFAULT '0' AFTER `email_on_liked_comment`, ADD `email_on_receipt_status_changed` INT(11) UNSIGNED NULL DEFAULT '0' AFTER `email_on_artist_status_changed`, ADD `email_on_new_track` INT(11) UNSIGNED NULL DEFAULT '0' AFTER `email_on_receipt_status_changed`, ADD `two_factor` INT(11) UNSIGNED NOT NULL DEFAULT '0' AFTER `email_on_new_track`, ADD `new_email` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' AFTER `two_factor`, ADD `two_factor_verified` INT(11) UNSIGNED NOT NULL DEFAULT '0' AFTER `new_email`, ADD `new_phone` VARCHAR(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' AFTER `two_factor_verified`, ADD `phone_number` VARCHAR(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' AFTER `new_phone`, ADD `last_login_data` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL AFTER `phone_number`;",
    "CREATE TABLE `profile_fields` ( `id` int(11) NOT NULL, `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '', `description` text COLLATE utf8_unicode_ci, `type` text COLLATE utf8_unicode_ci, `length` int(11) NOT NULL DEFAULT '0', `placement` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'profile', `registration_page` int(11) NOT NULL DEFAULT '0', `profile_page` int(11) NOT NULL DEFAULT '0', `select_type` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'none', `active` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0') ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;",
    "ALTER TABLE `profile_fields` ADD PRIMARY KEY (`id`), ADD KEY `registration_page` (`registration_page`), ADD KEY `active` (`active`), ADD KEY `profile_page` (`profile_page`);",
    "ALTER TABLE `profile_fields` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;",
    "CREATE TABLE `user_fields` ( `id` int(11) NOT NULL, `user_id` int(11) NOT NULL DEFAULT '0') ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;",
    "ALTER TABLE `user_fields` ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`);",
    "ALTER TABLE `user_fields` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;",
    "CREATE TABLE `admin_invitations` (  `id` int(11) NOT NULL,  `code` varchar(300) NOT NULL DEFAULT '0',  `posted` varchar(50) NOT NULL DEFAULT '0') ENGINE=InnoDB DEFAULT CHARSET=utf8;",
    "ALTER TABLE `admin_invitations` ADD PRIMARY KEY (`id`), ADD KEY `code` (`code`(255));",
    "ALTER TABLE `admin_invitations` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;",
    "ALTER TABLE `admin_invitations` ADD `status` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'Pending' AFTER `posted`;",
    "ALTER TABLE `users` ADD `email_on_reviewed_track` INT(11) UNSIGNED NULL DEFAULT '0' AFTER `email_on_new_track`;",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'soundcloud_import', 'off'), (NULL, 'radio_station_import', 'off');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'no_users_found');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'show_only_in_track_page');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'show_on_all_pages');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'edit_spotlight');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'blog');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, '1309', 'blog_categories');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, '1310', 'blog_categories');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, '1311', 'blog_categories');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, '1312', 'blog_categories');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, '1313', 'blog_categories');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, '1314', 'blog_categories');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, '1315', 'blog_categories');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, '1316', 'blog_categories');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, '1317', 'blog_categories');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, '1318', 'blog_categories');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, '1319', 'blog_categories');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, '1320', 'blog_categories');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, '1321', 'blog_categories');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, '1322', 'blog_categories');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, '1323', 'blog_categories');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, '1324', 'blog_categories');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, '1325', 'blog_categories');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, '1326', 'blog_categories');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'read_more');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'categories');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'no_more_articles_to_show.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'article');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'share_to');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'blogs');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'no_more_articles');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'no_more_article_found');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'delete_song');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'delete_this_song_from_playlist');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'please_enter_song_description');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'please_enter_song_tags');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'please_upload_song_thumbnail');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'you_have_reached_your_upload_limit__upgrade_to_upload_unlimited_songs.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'advertising');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'wallet');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'create_ad');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'category');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'results');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'spent');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'action');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, '2checkout');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'address');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'city');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'state');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'zip');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'phone_number');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'card_number');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'pay');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'replenish');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'please_check_the_details');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'confirmation');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'are_you_sure_you_want_to_delete_this_ad_');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'deleted');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'please_check_details');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'confirming_your_payment__please_wait..');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'payment_declined__please_try_again_later.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'my_balance');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'replenish_my_balance');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'browse_to_upload');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'create_advertising');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'create_new_ad');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'your_current_wallet_balance_is__0__please_top_up_your_wallet_to_continue.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'top_up');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'url');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'select_media');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'target_audience');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'placement');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'pricing');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'pay_per_click');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'pay_per_impression');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'spending_limit_per_day');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'media_file_is_invalid._please_select_a_valid_image');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'error_');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'file_is_too_big__max_upload_size_is');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'media_file_is_invalid._please_select_a_valid_image___video');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'your_ad_has_been_published_successfully');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'the_url_is_invalid._please_enter_a_valid_url');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'ad_title_must_be_between_5_100');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'edit_ad');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'your_changes_to_the_ad_were_successfully_saved');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'name_must_be_between_5_32');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'clicks');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'ads_analytics');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'this_year');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'view_report');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'ad_analytics');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'sponsor_ads');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'by');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'import');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'import_from_soundcloud.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'enter_the_soundcloud_track_link_and_click_the_button_below.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'error_found_while_importing_your_track__please_try_again_later.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'please_enter_valid_soundcloud_track_url.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'please_enter_soundcloud_track_link_to_import.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'error_found_while_importing_your_track__please_check_soundcloud_client_id.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'dmca');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'login_with_soundcloud');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'dcma');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'move_to_album');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'select_albums');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'please_select_which_album_you_want_to_add_this_song_to.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'review_track');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'review');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'review_track.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'please_enter_your_review.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'thanks_for_your_submission.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'reviews');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'no_reviews_on_this_track_yet.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'upload_new_track.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'notification');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'notification_settings');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'someone_followed_me');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'someone_liked_one_of_my_tracks');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'someone_liked_one_of_my_comments');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'approve_disapprove_artist_request');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'approve_disapprove_bank_payment_request');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'one_of_my_following_upload_new_track');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'one_of_my_following_users_upload_new_track');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'notify_me_when');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'new_notification');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'you_can_not_import_this_track_because_this_track_is_imported_before.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'manage_sessions');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'ip_address');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'platform');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'browser');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'last_seen');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'actions');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'session_expired');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'your_session_has_been_expired__please_login_again.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'two-factor_authentication');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'phone');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'enable');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'disable');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'turn_on_2-step_login_to_level-up_your_account_s_security__once_turned_on__you_ll_use_both_your_password_and_a_6-digit_security_code_sent_to_your_phone_or_email_to_log_in.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'a_confirmation_email_has_been_sent.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'we_have_sent_an_email_that_contains_the_confirmation_code_to_enable_two-factor_authentication.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'confirmation_code');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'a_confirmation_message_and_email_were_sent.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'we_have_sent_a_message_and_an_email_that_contain_the_confirmation_code_to_enable_two-factor_authentication');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'a_confirmation_message_was_sent.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'we_have_sent_a_message_that_contains_the_confirmation_code_to_enable_two-factor_authentication.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'we_have_sent_you_an_email_with_the_confirmation_code.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'wrong_confirmation_code.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'your_e-mail_has_been_successfully_verified.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'unusual_login');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'we_have_sent_you_the_confirmation_code_to_your_email_address.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'to_log_in__you_need_to_verify_your_identity.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'welcome...');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'stations');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'no_stations_found');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'add_station');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'search_for_stations');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'station_search.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'please_enter_more_than_3_characters.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'error_found_while_search_stations__please_try_again_later.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'you_already_add_this_station.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'delete_station');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'no_more_stations_found');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'the_track_has_been_moved_to_this_album_successfully.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'someone_liked_disliked_one_of_my_tracks');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'disliked_your_song.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'reviewed_your_song.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'someone_reviewed_one_of_my_tracks');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'you_can_not_import_this_track_because_this_track_is_one_of_soundcloud_go__tracks.');",
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