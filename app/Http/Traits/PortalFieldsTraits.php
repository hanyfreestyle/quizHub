<?php

namespace App\Http\Traits;


trait PortalFieldsTraits {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadPortalFields() {


        $generalFields = self::generalFields();
        foreach ($generalFields as $platform) {
            $fields[] = (object)[
                'cat_id' => 'General',
                'id' => $platform['id'],
                'input' => 'text',
                'name' => __("portal/fields.{$platform['name_key']}"),
                'icon_i' => $platform['icon'],
                'name_key' => $platform['name_key'],
                'url' => $platform['url'] ?? null,
                'user' => $platform['user'] ?? null,
            ];
        }

        $businessPlatforms = self::businessPlatforms();
        foreach ($businessPlatforms as $platform) {
            $fields[] = (object)[
                'cat_id' => 'Business',
                'id' => $platform['id'],
                'input' => 'text',
                'name' => __("portal/fields.{$platform['name_key']}"),
                'icon_i' => $platform['icon'],
                'name_key' => $platform['name_key'],
                'url' => $platform['url'] ?? null,
                'user' => $platform['user'] ?? null,
            ];
        }


        $socialPlatforms = self::socialPlatforms();
        foreach ($socialPlatforms as $platform) {
            $fields[] = (object)[
                'cat_id' => 'Social',
                'id' => $platform['id'],
                'input' => 'text',
                'name' => __("portal/fields.{$platform['name_key']}"),
                'icon_i' => $platform['icon'],
                'name_key' => $platform['name_key'],
                'url' => $platform['url'] ?? null,
                'user' => $platform['user'] ?? null,
            ];
        }

        $messagingApps = self::messagingApps();
        foreach ($messagingApps as $platform) {
            $fields[] = (object)[
                'cat_id' => 'Messaging',
                'id' => $platform['id'],
                'input' => 'text',
                'name' => __("portal/fields.{$platform['name_key']}"),
                'icon_i' => $platform['icon'],
                'name_key' => $platform['name_key'],
                'url' => $platform['url'] ?? null,
                'user' => $platform['user'] ?? null,
            ];
        }

        return collect($fields);
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function suggestionsArr($lang) {
        $socialPlatforms = self::socialPlatforms();
        $messagingApps = self::messagingApps();


        if ($lang == 'ar') {

            $suggestions['Address'] = ['عنوان المكتب', 'عنوان العمل', 'عنوان المنزل', 'عنوان المراسلة', 'عنوان التوصيل'];
            $suggestions['Email'] = ['البريد الإلكتروني للعمل', 'البريد الإلكتروني الشخصي', 'بريد الدعم الفني', 'بريد الفواتير', 'بريد الموارد البشرية'];
            $suggestions['Phone'] = ['الهاتف المحمول', 'رقم الجوال', 'هاتف العمل', 'هاتف المنزل', 'رقم الفاكس'];
            $suggestions['Web'] = ['زيارة موقعنا الإلكتروني', 'استكشاف خدماتنا', 'تعرف علينا أكثر', 'تصفح متجرنا الإلكتروني', 'استعرض معرض أعمالنا'];
            $suggestions['CompanyURL'] = ['زيارة الموقع الرسمي للشركة', 'ملف الشركة', 'الموقع الإلكتروني للشركة', 'استكشاف أعمالنا', 'الصفحة الرسمية'];
            $suggestions['Link'] = ['اضغط هنا لمعرفة المزيد', 'تفقد هذا الرابط', 'استكشف هذه الصفحة', 'زيارة المورد', 'عرض معلومات إضافية'];
            $suggestions['GoogleMap'] = ['اعثر علينا على خرائط جوجل', 'حدد موقع مكتبنا', 'تفقد مواقع فروعنا', 'عرض اتجاهات الخريطة', 'انتقل إلى عنواننا'];
            $suggestions['BlogURL'] = ['اقرأ مدونتنا', 'استكشف مقالاتنا', 'اطلع على آخر التحديثات', 'اكتشف الأفكار', 'زيارة مساحة الكتابة الخاصة بنا'];
            $suggestions['PortfolioURL'] = ['تصفح معرض أعمالنا', 'استعرض مشاريعنا', 'شاهد أعمالنا السابقة', 'تفقد دراسات الحالة الخاصة بنا', 'استعرض إنجازاتنا'];
            $suggestions['Country'] = ['حدد دولتك', 'أدخل اسم بلدك', 'بلد الإقامة', 'بلد العمل', 'الدولة'];
            $suggestions['City'] = ['أدخل مدينتك', 'مدينة الإقامة', 'المدينة الحالية', 'مدينة المكتب', 'مسقط الرأس'];
            $suggestions['PostalCode'] = ['أدخل الرمز البريدي', 'رمز ZIP', 'الرمز البريدي للمراسلة', 'الرمز البريدي لمكان العمل', 'رمز التوصيل البريدي'];

            $suggestions['Shopify'] = ['متجر Shopify', 'ابدأ تجارتك الإلكترونية', 'استكشف متجرنا على Shopify', 'تعرف على منتجاتنا', 'ابدأ التسوق الآن'];
            $suggestions['WooCommerce'] = ['متجر WooCommerce', 'تسوق منتجاتنا', 'اكتشف عروض WooCommerce', 'قم بزيارة متجرنا الإلكتروني', 'اشترِ الآن عبر WooCommerce'];
            $suggestions['AmazonStore'] = ['متجر أمازون', 'تسوق من منتجاتنا', 'اكتشف عروضنا على أمازون', 'قم بزيارة متجرنا على أمازون', 'اطلب منتجاتك الآن'];
            $suggestions['Zendesk'] = ['دعم Zendesk', 'نظام التذاكر Zendesk', 'تواصل معنا عبر Zendesk', 'اكتشف خدمات الدعم الفني', 'تعرف على نظام الدعم الخاص بنا'];
            $suggestions['Freshdesk'] = ['دعم Freshdesk', 'نظام التذاكر Freshdesk', 'تواصل معنا عبر Freshdesk', 'اكتشف أدوات الدعم الفني', 'استفسر عن خدماتنا'];
            $suggestions['LiveChat'] = ['تواصل مباشر عبر LiveChat', 'الدردشة مع فريقنا', 'احصل على دعم فوري', 'ابدأ محادثتك الآن', 'اكتشف خدمة LiveChat'];
            $suggestions['GitHub'] = ['مستودع GitHub', 'استعرض مشاريعنا البرمجية', 'تعرف على أكوادنا', 'انضم إلى مجتمع GitHub', 'تابع تحديثاتنا البرمجية'];
            $suggestions['GitLab'] = ['مستودع GitLab', 'تصفح مشاريعنا', 'اكتشف أدوات التطوير', 'استعرض كود المصدر', 'انضم إلى فرقنا البرمجية'];
            $suggestions['Bitbucket'] = ['مستودع Bitbucket', 'استعرض أكوادنا البرمجية', 'تابع مشاريعنا', 'اكتشف أدوات Bitbucket', 'تعرف على كود المصدر الخاص بنا'];
            $suggestions['Calendly'] = ['حجز مواعيد عبر Calendly', 'حدد موعدًا معنا', 'قم بجدولة اجتماع', 'تعرف على أوقات العمل المتاحة', 'اكتشف تقاويمنا'];
            $suggestions['Zoom'] = ['اجتماع عبر Zoom', 'انضم إلى اجتماعنا الآن', 'احصل على رابط الاجتماع', 'تعرف على خدمات Zoom', 'تواصل معنا عبر Zoom'];
            $suggestions['GoogleMeet'] = ['اجتماع Google Meet', 'انضم إلى مكالمة الفيديو', 'احصل على رابط الاجتماع', 'تواصل مع فريقنا', 'اكتشف خدمات الاجتماعات'];
            $suggestions['MicrosoftTeamsMeeting'] = ['اجتماع Microsoft Teams', 'تواصل مع فريقنا عبر Teams', 'انضم إلى جلسة العمل', 'اكتشف أدوات Teams', 'ابدأ مكالمتك الآن'];
            $suggestions['Trello'] = ['لوحة Trello', 'استعرض خطط العمل', 'تابع مهامنا', 'تعرف على مشاريعنا', 'ابدأ العمل الجماعي'];
            $suggestions['Asana'] = ['مهام Asana', 'إدارة المشاريع عبر Asana', 'تابع سير العمل', 'تعرف على خططنا', 'اكتشف أدوات Asana'];
//            $suggestions['GoogleDrive'] = ['ملفات Google Drive', 'استعرض مستنداتنا', 'احصل على ملفاتك', 'اكتشف خدمات Google Drive', 'شارك بياناتك الآن'];
            $suggestions
            ['Dropbox'] = ['ملفات Dropbox', 'قم بتنزيل ملفاتك', 'شارك مستنداتك', 'استعرض ملفات Dropbox', 'اكتشف أدوات التخزين السحابية'];


            foreach ($socialPlatforms as $key => $platform) {
                $suggestions[$platform['id']] = [
                    "{$platform['id']}", // اسم المنصة
                    "صفحتنا على {$platform['id']}",
                    "تابعنا على {$platform['id']}",
                    "انضم إلينا على {$platform['id']}",
                    "اكتشف المزيد على {$platform['id']}",
                ];
            }

            foreach ($messagingApps as $key => $app) {
                $suggestions[$app['id']] = [
                    "{$app['id']}", // اسم التطبيق
                    "تواصل معنا عبر {$app['id']}",
                    "تابعنا على {$app['id']}",
                    "انضم إلى مجموعتنا على {$app['id']}",
                    "استكشف المزيد على {$app['id']}",
                ];
            }
        } else {

            $suggestions['Address'] = ['Office Address', 'Work Address', 'Home Address', 'Mailing Address', 'Delivery Address'];
            $suggestions['Email'] = ['Work Email', 'Personal Email', 'Support Email', 'Billing Email', 'HR Email'];
            $suggestions['Phone'] = ['Cell Phone', 'Mobile Number', 'Work Phone', 'Home Phone', 'Fax Number'];
            $suggestions['Web'] = ['Visit our website', 'Explore our services', 'Learn more about us', 'Check our online store', 'Browse our portfolio'];
            $suggestions['CompanyURL'] = ['Visit our official website', 'Company profile', 'Corporate website', 'Explore our business', 'Official page'];
            $suggestions['Link'] = ['Click here to learn more', 'Check out this link', 'Explore this page', 'Visit the resource', 'View additional information'];
            $suggestions['GoogleMap'] = ['Find us on Google Maps', 'Locate our office', 'Check our branch locations', 'View map directions', 'Navigate to our address'];
            $suggestions['BlogURL'] = ['Read our blog', 'Explore our articles', 'Check latest updates', 'Discover insights', 'Visit our writing space'];
            $suggestions['PortfolioURL'] = ['Browse our portfolio', 'Explore our projects', 'See our past work', 'Check our case studies', 'View our achievements'];
            $suggestions['Country'] = ['Select your country', 'Enter your country name', 'Your home country', 'Country of residence', 'Country of operation'];
            $suggestions['City'] = ['Enter your city', 'City of residence', 'Current city', 'Office city', 'Hometown'];
            $suggestions['PostalCode'] = ['Enter your postal code', 'ZIP Code', 'Mailing postal code', 'Workplace postal code', 'Delivery ZIP'];

            $suggestions['Shopify'] = ['Shopify Store', 'Start your online business', 'Explore our Shopify store', 'Discover our products', 'Start shopping now'];
            $suggestions['WooCommerce'] = ['WooCommerce Store', 'Shop our products', 'Explore WooCommerce deals', 'Visit our online store', 'Buy now through WooCommerce'];
            $suggestions['Amazon Store'] = ['Amazon Store', 'Shop our products', 'Discover our deals on Amazon', 'Visit our Amazon store', 'Order your products now'];
            $suggestions['Zendesk'] = ['Zendesk Support', 'Zendesk ticket system', 'Connect with us on Zendesk', 'Explore our support services', 'Learn about our helpdesk system'];
            $suggestions['Freshdesk'] = ['Freshdesk Support', 'Freshdesk ticketing system', 'Contact us via Freshdesk', 'Discover our support tools', 'Inquire about our services'];
            $suggestions['LiveChat'] = ['LiveChat Direct Support', 'Chat with our team', 'Get instant support', 'Start your chat now', 'Discover LiveChat services'];
            $suggestions['GitHub'] = ['GitHub Repository', 'Browse our code projects', 'Learn about our repositories', 'Join the GitHub community', 'Follow our latest updates'];
            $suggestions['GitLab'] = ['GitLab Repository', 'Explore our projects', 'Discover development tools', 'Browse source code', 'Join our development teams'];
            $suggestions['Bitbucket'] = ['Bitbucket Repository', 'Browse our codebase', 'Follow our projects', 'Discover Bitbucket tools', 'Learn about our source code'];
            $suggestions['Calendly'] = ['Calendly Scheduling', 'Book an appointment with us', 'Schedule a meeting', 'Check available times', 'Discover our calendars'];
            $suggestions['Zoom'] = ['Zoom Meeting', 'Join our meeting now', 'Get the meeting link', 'Learn about Zoom services', 'Connect with us via Zoom'];
            $suggestions['GoogleMeet'] = ['Google Meet Meeting', 'Join a video call', 'Get the meeting link', 'Connect with our team', 'Explore meeting tools'];
            $suggestions['MicrosoftTeamsMeeting'] = ['Microsoft Teams Meeting', 'Connect with us via Teams', 'Join a work session', 'Discover Teams tools', 'Start your call now'];
            $suggestions['Trello'] = ['Trello Board', 'Review our work plans', 'Track our tasks', 'Learn about our projects', 'Start team collaboration'];
            $suggestions['Asana'] = ['Asana Tasks', 'Manage projects with Asana', 'Track progress', 'Learn about our workflows', 'Discover Asana tools'];
            $suggestions['GoogleDrive'] = ['Google Drive Files', 'Browse our documents', 'Access your files', 'Discover Google Drive services', 'Share your data now'];
            $suggestions['Dropbox'] = ['Dropbox Files', 'Download your files', 'Share your documents', 'Browse Dropbox files', 'Explore cloud storage tools'];


            foreach ($socialPlatforms as $key => $platform) {
                $suggestions[$platform['id']] = [
                    "{$platform['id']}",
                    "Our {$platform['id']} Page",
                    "Follow us on {$platform['id']}",
                    "Join us on {$platform['id']}",
                    "Check out our {$platform['id']} profile",
                ];
            }

            foreach ($messagingApps as $key => $app) {
                $suggestions[$app['id']] = [
                    "{$app['id']}",
                    "Connect with us on {$app['id']}",
                    "Follow us on {$app['id']}",
                    "Join our group on {$app['id']}",
                    "Explore more on {$app['id']}",
                ];
            }
        }

        return $suggestions;
//        'Address' => ['Office Address', 'Work Address', 'Home Address', 'Mailing Address',],
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function loadSuggestionsArr($Arr, $Name) {
        if (isset($Arr[$Name])) {
            return $Arr[$Name];
        } else {
            return [];
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function socialPlatforms() {
        $socialPlatforms = [
            ['id' => 'Facebook', 'icon' => 'fa-brands fa-square-facebook', 'name_key' => 'social_facebook', 'url' => "https://www.facebook.com/", 'user' => "https://www.facebook.com/[USER]"],
            ['id' => 'Twitter', 'icon' => 'fa-brands fa-square-twitter', 'name_key' => 'social_twitter', 'url' => "https://www.twitter.com/", 'user' => "https://twitter.com/[USER]"],
            ['id' => 'LinkedIn', 'icon' => 'fa-brands fa-linkedin', 'name_key' => 'social_linkedin', 'url' => "https://www.linkedin.com/", 'user' => "https://www.linkedin.com/in/[USER]"],
            ['id' => 'Instagram', 'icon' => 'fa-brands fa-instagram', 'name_key' => 'social_instagram', 'url' => "https://www.instagram.com/", 'user' => "https://www.instagram.com/[USER]"],
            ['id' => 'YouTube', 'icon' => 'fa-brands fa-youtube', 'name_key' => 'social_youtube', 'url' => "https://www.youtube.com/", 'user' => "https://www.youtube.com/user/[USER]"],
            ['id' => 'Pinterest', 'icon' => 'fa-brands fa-pinterest', 'name_key' => 'social_pinterest', 'url' => "https://www.pinterest.com/", 'user' => "https://www.pinterest.com/[USER]"],
            ['id' => 'Snapchat', 'icon' => 'fa-brands fa-snapchat', 'name_key' => 'social_snapchat', 'url' => "https://www.snapchat.com/", 'user' => null],
            ['id' => 'TikTok', 'icon' => 'fa-brands fa-tiktok', 'name_key' => 'social_tiktok', 'url' => "https://www.tiktok.com/", 'user' => "https://www.tiktok.com/@[USER]"],
            ['id' => 'Reddit', 'icon' => 'fa-brands fa-reddit', 'name_key' => 'social_reddit', 'url' => "https://www.reddit.com/", 'user' => "https://www.reddit.com/user/[USER]"],
            ['id' => 'Vimeo', 'icon' => 'fa-brands fa-vimeo', 'name_key' => 'social_vimeo', 'url' => "https://www.vimeo.com/", 'user' => "https://vimeo.com/[USER]"],
            ['id' => 'Quora', 'icon' => 'fa-brands fa-quora', 'name_key' => 'social_quora', 'url' => "https://www.quora.com/", 'user' => "https://www.quora.com/profile/[USER]"],
            ['id' => 'Tumblr', 'icon' => 'fa-brands fa-tumblr', 'name_key' => 'social_tumblr', 'url' => "https://www.tumblr.com/", 'user' => null],
            ['id' => 'Twitch', 'icon' => 'fa-brands fa-twitch', 'name_key' => 'social_twitch', 'url' => "https://www.twitch.tv/", 'user' => "https://www.twitch.tv/[USER]"],
            ['id' => 'Medium', 'icon' => 'fa-brands fa-medium', 'name_key' => 'social_medium', 'url' => "https://www.medium.com/", 'user' => "https://medium.com/@[USER]"],
            ['id' => 'Dribbble', 'icon' => 'fa-brands fa-dribbble', 'name_key' => 'social_dribbble', 'url' => "https://www.dribbble.com/", 'user' => "https://dribbble.com/[USER]"],
            ['id' => 'Behance', 'icon' => 'fa-brands fa-behance', 'name_key' => 'social_behance', 'url' => "https://www.behance.net/", 'user' => "https://www.behance.net/[USER]"],
            ['id' => 'Flickr', 'icon' => 'fa-brands fa-flickr', 'name_key' => 'social_flickr', 'url' => "https://www.flickr.com/", 'user' => "https://www.flickr.com/people/[USER]"],
        ];
        return $socialPlatforms;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function messagingApps() {
        $messagingApps = [
            ['id' => 'WhatsApp', 'icon' => 'fa-brands fa-whatsapp', 'name_key' => 'messaging_whatsapp', 'url' => "https://www.whatsapp.com/", 'user' => "https://wa.me/[USER]"],
            ['id' => 'Telegram', 'icon' => 'fa-brands fa-telegram', 'name_key' => 'messaging_telegram', 'url' => "https://telegram.org/", 'user' => "https://t.me/[USER]"],
            ['id' => 'Messenger', 'icon' => 'fa-brands fa-facebook-messenger', 'name_key' => 'messaging_messenger', 'url' => "https://www.messenger.com/", 'user' => "https://www.messenger.com/t/[USER]"],
            ['id' => 'Microsoft Teams', 'icon' => 'fa-brands fa-microsoft', 'name_key' => 'messaging_teams', 'url' => "https://www.microsoft.com/en/microsoft-teams", 'user' => null],
            ['id' => 'Viber', 'icon' => 'fa-brands fa-viber', 'name_key' => 'messaging_viber', 'url' => "https://www.viber.com/", 'user' => null],
            ['id' => 'WeChat', 'icon' => 'fa-brands fa-weixin', 'name_key' => 'messaging_wechat', 'url' => "https://www.wechat.com/", 'user' => null],
            ['id' => 'Line', 'icon' => 'fa-brands fa-line', 'name_key' => 'messaging_line', 'url' => "https://line.me/", 'user' => null],
            ['id' => 'Kik', 'icon' => 'fa-solid fa-comment-dots', 'name_key' => 'messaging_kik', 'url' => "https://www.kik.com/", 'user' => null],
            ['id' => 'Signal', 'icon' => 'fa-solid fa-signal', 'name_key' => 'messaging_signal', 'url' => "https://signal.org/", 'user' => null],
            ['id' => 'Slack', 'icon' => 'fa-brands fa-slack', 'name_key' => 'messaging_slack', 'url' => "https://slack.com/", 'user' => null],
            ['id' => 'Discord', 'icon' => 'fa-brands fa-discord', 'name_key' => 'messaging_discord', 'url' => "https://discord.com/", 'user' => "https://discord.com/users/[USER]"],
            ['id' => 'Skype', 'icon' => 'fa-brands fa-skype', 'name_key' => 'messaging_skype', 'url' => "https://www.skype.com/", 'user' => "skype:[USER]?chat"],
            ['id' => 'GoogleChat', 'icon' => 'fa-brands fa-google', 'name_key' => 'messaging_google_chat', 'url' => "https://chat.google.com/", 'user' => null],
            ['id' => 'SnapchatChat', 'icon' => 'fa-brands fa-snapchat', 'name_key' => 'messaging_snapchat', 'url' => "https://www.snapchat.com/", 'user' => "https://www.snapchat.com/add/[USER]"],
        ];

        return $messagingApps;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function generalFields() {
        $generalFields = [
            ['id' => 'Address', 'icon' => 'fa-solid fa-map-marker-alt', 'name_key' => 'field_address', 'type' => 'text', 'placeholder' => 'Enter your address'],
            ['id' => 'Email', 'icon' => 'fa-solid fa-envelope', 'name_key' => 'field_email', 'type' => 'email', 'placeholder' => 'Enter your email'],
            ['id' => 'Phone', 'icon' => 'fa-solid fa-phone', 'name_key' => 'field_phone', 'type' => 'tel', 'placeholder' => 'Enter your phone number'],
            ['id' => 'Web', 'icon' => 'fa-solid fa-envelope', 'name_key' => 'field_web', 'type' => 'email', 'placeholder' => 'Enter your email'],
            ['id' => 'CompanyURL', 'icon' => 'fa-solid fa-globe', 'name_key' => 'field_company_url', 'type' => 'url', 'placeholder' => 'Enter company website URL'],
            ['id' => 'Link', 'icon' => 'fa-solid fa-link', 'name_key' => 'field_link', 'type' => 'url', 'placeholder' => 'Enter a link'],
            ['id' => 'GoogleMap', 'icon' => 'fa-solid fa-map', 'name_key' => 'field_google_map', 'type' => 'url', 'placeholder' => 'Enter Google Map URL'],
            ['id' => 'BlogURL', 'icon' => 'fa-solid fa-blog', 'name_key' => 'field_blog_url', 'type' => 'url', 'placeholder' => 'Enter blog URL'],
            ['id' => 'PortfolioURL', 'icon' => 'fa-solid fa-briefcase', 'name_key' => 'field_portfolio_url', 'type' => 'url', 'placeholder' => 'Enter portfolio URL'],
            ['id' => 'Country', 'icon' => 'fa-solid fa-flag', 'name_key' => 'field_country', 'type' => 'text', 'placeholder' => 'Enter your country'],
            ['id' => 'City', 'icon' => 'fa-solid fa-city', 'name_key' => 'field_city', 'type' => 'text', 'placeholder' => 'Enter your city'],
            ['id' => 'PostalCode', 'icon' => 'fa-solid fa-mail-bulk', 'name_key' => 'field_postal_code', 'type' => 'text', 'placeholder' => 'Enter your postal code'],
        ];

        return $generalFields;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function businessPlatforms() {
        $businessPlatforms = [
            ['id' => 'Shopify', 'icon' => 'fa-solid fa-store', 'name_key' => 'business_shopify', 'url' => 'https://www.shopify.com/', 'user' => 'https://[USER].myshopify.com'],
            ['id' => 'WooCommerce', 'icon' => 'fa-solid fa-shopping-cart', 'name_key' => 'business_woocommerce', 'url' => 'https://woocommerce.com/', 'user' => null],
            ['id' => 'AmazonStore', 'icon' => 'fa-solid fa-store-alt', 'name_key' => 'business_amazon_store', 'url' => 'https://www.amazon.com/', 'user' => 'https://www.amazon.com/shops/[USER]'],
            ['id' => 'Zendesk', 'icon' => 'fa-solid fa-headset', 'name_key' => 'business_zendesk', 'url' => 'https://www.zendesk.com/', 'user' => 'https://[USER].zendesk.com'],
            ['id' => 'Freshdesk', 'icon' => 'fa-solid fa-life-ring', 'name_key' => 'business_freshdesk', 'url' => 'https://freshdesk.com/', 'user' => 'https://[USER].freshdesk.com'],
            ['id' => 'LiveChat', 'icon' => 'fa-solid fa-comments', 'name_key' => 'business_livechat', 'url' => 'https://www.livechat.com/', 'user' => 'https://[USER].livechat.com'],
            ['id' => 'GitHub', 'icon' => 'fa-brands fa-github', 'name_key' => 'business_github', 'url' => 'https://github.com/', 'user' => 'https://github.com/[USER]'],
            ['id' => 'GitLab', 'icon' => 'fa-brands fa-gitlab', 'name_key' => 'business_gitlab', 'url' => 'https://gitlab.com/', 'user' => 'https://gitlab.com/[USER]'],
            ['id' => 'Bitbucket', 'icon' => 'fa-brands fa-bitbucket', 'name_key' => 'business_bitbucket', 'url' => 'https://bitbucket.org/', 'user' => 'https://bitbucket.org/[USER]'],
            ['id' => 'Calendly', 'icon' => 'fa-solid fa-calendar', 'name_key' => 'business_calendly', 'url' => 'https://calendly.com/', 'user' => 'https://calendly.com/[USER]'],
            ['id' => 'Zoom', 'icon' => 'fa-solid fa-video', 'name_key' => 'business_zoom', 'url' => 'https://zoom.us/', 'user' => 'https://zoom.us/j/[meeting-id]'],
            ['id' => 'GoogleMeet', 'icon' => 'fa-solid fa-video', 'name_key' => 'business_google_meet', 'url' => 'https://meet.google.com/', 'user' => null],
            ['id' => 'MicrosoftTeamsMeeting', 'icon' => 'fa-solid fa-video', 'name_key' => 'business_microsoft_teams_meeting', 'url' => 'https://www.microsoft.com/en/microsoft-teams/', 'user' => null],
            ['id' => 'Trello', 'icon' => 'fa-solid fa-columns', 'name_key' => 'business_trello', 'url' => 'https://trello.com/', 'user' => 'https://trello.com/[USER]'],
            ['id' => 'Asana', 'icon' => 'fa-solid fa-tasks', 'name_key' => 'business_asana', 'url' => 'https://asana.com/', 'user' => 'https://app.asana.com/0/[workspace-id]/[project-id]'],
            ['id' => 'GoogleDrive', 'icon' => 'fa-solid fa-cloud', 'name_key' => 'business_google_drive', 'url' => 'https://drive.google.com/', 'user' => 'https://drive.google.com/drive/u/[USER]'],
            ['id' => 'Dropbox', 'icon' => 'fa-solid fa-box', 'name_key' => 'business_dropbox', 'url' => 'https://www.dropbox.com/', 'user' => 'https://www.dropbox.com/home/[USER]'],
        ];


        return $businessPlatforms;
    }


}
