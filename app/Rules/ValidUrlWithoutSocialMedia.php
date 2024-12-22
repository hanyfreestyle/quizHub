<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class ValidUrlWithoutSocialMedia implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        // التحقق من أن القيمة هي URL صالح
        if (!filter_var($value, FILTER_VALIDATE_URL)) {
            $fail('The :attribute is not a valid URL.');
            return;
        }

        // قائمة بكلمات تشير إلى مواقع التواصل الاجتماعي
        $socialMediaDomains = ['facebook.com', 'instagram.com', 'twitter.com', 'linkedin.com', 'tiktok.com', 'snapchat.com'];

        // التحقق من عدم تضمين URL لأي من مواقع التواصل الاجتماعي
        foreach ($socialMediaDomains as $domain) {
            if (stripos($value, $domain) !== false) {
                $fail('The :attribute must not contain URLs from social media sites.');
                return;
            }
        }
    }
}
