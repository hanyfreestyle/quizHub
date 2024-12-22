<?php
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('defPortalAssets')) {
    function defPortalAssets($path, $secure = null): string {
        return app('url')->asset('assets/portal/' . $path, $secure);
    }
}

if (!function_exists('defCardAssets')) {
    function defCardAssets($path, $secure = null): string {
        return app('url')->asset('assets/card/' . $path, $secure);
    }
}
if (!function_exists('defQuizAssets')) {
    function defQuizAssets($path, $secure = null): string {
        return app('url')->asset('assets/quiz/' . $path, $secure);
    }
}

if (!function_exists('svgIcon')) {
    function svgIcon($icon) {
        return defPortalAssets('svg/icon-sprite.svg#'.$icon);
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('portalChangeLangKey')) {
    function portalChangeLangKey() {
        if (thisCurrentLocale() == 'ar') {
            $key = "en";
        } else {
            $key = "ar";
        }
        return $key;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('portalChangeLangText')) {
    function portalChangeLangText() {
        if (thisCurrentLocale() == 'ar') {
            $key = "English";
        } else {
            $key = "العربية";
        }
        return $key;
    }
}
if (!function_exists('portalChangeLangFlag')) {
    function portalChangeLangFlag() {
        if (thisCurrentLocale() == 'ar') {
            $key = "flag-icon flag-icon-us";
        } else {
            $key = "flag-icon flag-icon-ae";
        }
        return $key;
    }
}
if (!function_exists('bodyDir')) {
    function bodyDir() {
        if (thisCurrentLocale() == 'ar') {
            $key = ' class="rtl" ';
        } else {
            $key = null;
        }
        return $key;
    }
}
if (!function_exists('loaderWrapper')) {
    function loaderWrapper($active = false) {
        if ($active) {
            $key = '<div class="loader-wrapper" style="direction: ltr !important;"><div class="theme-loader"><div class="loader-p"></div></div></div>';
        } else {
            $key = null;
        }
        return $key;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('formValidation')) {
    function formValidation($req, $reqType) {
        $Validation = '';
        if ($req) {
            $Validation .= ' required="" ';
        }
        if ($reqType) {
            $str = explode('|', $reqType);
            $arr = explode('|', $reqType);

            foreach ($arr as $str) {
                if ($str == 'email') {
                    $Validation .= ' data-parsley-type="email" ';
                }
                if ($str == 'number') {
                    $Validation .= ' data-parsley-type="number" ';
                }
                if ($str == 'url') {
                    $Validation .= ' data-parsley-type="url" ';
                }
                if ($str == 'alphanum') {
                    $Validation .= ' data-parsley-type="alphanum" ';
                }

                if (strpos($str, 'len') !== false) {
                    if (preg_match('/len\[(\d+),\s*(\d+)\]/', $str, $matches)) {
                        $minLength = $matches[1]; // الرقم الأول
                        $maxLength = $matches[2]; // الرقم الثاني
                        $Validation .= 'data-parsley-length="[' . $minLength . ',' . $maxLength . ']"';
                    }
                }

                if (strpos($str, 'range') !== false) {
                    if (preg_match('/range\[(\d+),\s*(\d+)\]/', $str, $matches)) {
                        $minLength = $matches[1]; // الرقم الأول
                        $maxLength = $matches[2]; // الرقم الثاني
                        $Validation .= 'data-parsley-range="[' . $minLength . ',' . $maxLength . ']"';
                    }
                }

                if (strpos($str, 'equal') !== false) {
                    if (preg_match('/\[(.*?)\]/', $str, $matches)) {
                        $Validation .= ' data-parsley-equalto="' . $matches[1] . '" ';
                    }
                }

            }

        }

        return $Validation;
    }
}
if (!function_exists('colRow')) {
    function colRow($col) {
        if ($col) {
            $str = explode('|', $col);
            $text = "col-lg-" . IsArr($str, '0', 4);
            $text .= " col-" . IsArr($str, '1', 12);
        } else {
            $text = ' col-lg-4 col-6';
        }
        return $text;
    }
}


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('getUserPhoto')) {
    function getUserPhoto($row, $type, $size) {
        $photo = $row->photos->where('type', $type)->where("size", $size)->first();
        if ($photo) {
            $photoUrl = defImagesDir($photo->path);
        } else {
            $photoUrl = getUserPhotoDef($type, $size);
        }
        return $photoUrl;
    }
}

if (!function_exists('getCardPhoto')) {
    function getCardPhoto($photo,$type,$size) {
        if ($photo) {
            $photoUrl = defImagesDir($photo);
        } else {
            $photoUrl = getUserPhotoDef($type, $size);
        }
        return $photoUrl;
    }
}


if (!function_exists('getUserPhotoDef')) {
    function getUserPhotoDef($type, $size) {
        $photoUrl = null;
        if ($type == 'profile') {
            if ($size == 's') {
                $photoUrl = defPortalAssets('img/profile/user.png');
            } elseif ($size == 'm') {
                $photoUrl = defPortalAssets('img/profile/profile-300-3d.jpg');
            } elseif ($size == 'm-w') {
                $photoUrl = defPortalAssets('img/profile/profile-520-630-3d.jpg');
            }
        } elseif ($type == 'cover') {
            if ($size == 's') {
                $photoUrl = defPortalAssets('img/profile/user.png');
            } elseif ($size == 'm') {
                $photoUrl = defPortalAssets('img/profile/cover-900.jpg');
            }


        } elseif ($type == 'banner') {
            $photoUrl = defPortalAssets('img/profile/user_banner.webp');
        }
        return $photoUrl;
    }
}


if (!function_exists('cropperErrMass')) {
    function cropperErrMass($str, $val, $img) {
        $err = $str;
        return $err;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
