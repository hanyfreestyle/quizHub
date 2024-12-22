@if( File::isFile(base_path('routes/AppPlugin/config/siteMaps.php')))
    @if($isactive)
        @if($type == 'web_master_meta' and $row->web_master_meta)
            <meta name="google-site-verification" content="{{$row->web_master_meta}}"/>
        @elseif($type == 'tag_manager_code_header' and $row->tag_manager_code )
            <!-- Google Tag Manager -->
            <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
                })(window,document,'script','dataLayer','{{$row->tag_manager_code}}');</script>
            <!-- End Google Tag Manager -->

        @elseif($type == 'tag_manager_code_body')
            <!-- Google Tag Manager (noscript) -->
            <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{$row->tag_manager_code}}" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
            <!-- End Google Tag Manager (noscript) -->
        @endif
    @endif
@endif
