<?php

namespace App\Http\Controllers\web;

use App\AppPlugin\PortalCard\Models\PortalCard;

use App\AppPlugin\PortalCard\Traits\TemplateConfigTraits;
use App\AppPlugin\Quiz\Models\AppQuizQuestion;
use App\Http\Controllers\WebMainController;
use Illuminate\Support\Facades\View;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Response;
use JeroenDesloovere\VCard\VCard;


class PagesViewController extends WebMainController {
    use TemplateConfigTraits;

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function quizView() {

//        $questions = AppQuizQuestion::query()->with('answers')->get();

        $questions = AppQuizQuestion::query()->take('2')->with(['answers' => function($query) {
            $query->inRandomOrder();
        }])->get();

        return view('quiz.index')->with([
            'questions' => $questions,
        ]);
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function index() {

        $meta = parent::getMeatByCatId('home');
        parent::printSeoMeta($meta, 'web.index');

        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'HomePage';
        $pageView['page'] = 'web.index';

        return view('web.index')->with([
            'pageView' => $pageView,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function cardView($slug) {
        $card = PortalCard::query()
            ->with('card_data')
            ->with('template')
            ->where('slug', $slug)->firstOrFail();
        $lang = $card->lang;
        LaravelLocalization::setLocale($lang);

        $getThemConfig = json_decode($card->template->config, true);
        $layout_id = $card->template->layout_id;

        $themVar = [
            'mode' => getDarkMode($getThemConfig['mode']),
            'desk' => getDeskView($getThemConfig['desk']),
            'mobile' => getMobileView($getThemConfig['mobile']),
            'iRadius' => getIconRadius($getThemConfig['iRadius']),
            'iBorder' => getIconBorder($getThemConfig['iBorder']),
            'iName' => getIconName(issetArr($getThemConfig, 'iName', 1)),
            'iColor' => issetArr($getThemConfig, 'iColor', 1),
        ];

        $this->themVar = $themVar;
        View::share('themVar', $this->themVar);

        return view('card.index')->with([
            'card' => $card,
            'layout_id' => $layout_id,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function downloadVcf($slug) {
        $card = PortalCard::query()
            ->with('card_data')
            ->with('template')
            ->with('user')
            ->where('slug', $slug)->firstOrFail();
        $lang = $card->lang;
        LaravelLocalization::setLocale($lang);


        $vcard = new VCard();

        $fullName = $card->first_name . ' ' . $card->last_name;
        $vcard->addName($fullName);

        if ($card->company_name) {
            $vcard->addCompany($card->company_name);
        }
        if ($card->job_title) {
            $vcard->addJobtitle($card->job_title);
        }


        $vcard->addEmail($card->user->email);
//        $vcard->addRole('Data Protection Officer');
        $vcard->addPhoneNumber($card->user->phone, 'PREF;WORK');
        $vcard->addPhoneNumber($card->user->phone, 'WORK');
//        $vcard->addAddress(null, null, 'street', 'worktown', null, 'workpostcode', 'Belgium');
//        $vcard->addLabel('street, worktown, workpostcode Belgium');
        $web = route('web.card.cardView', $card->slug);
        $vcard->addURL($web);

        if ($card->template->profile) {
            $vcard->addPhoto(url($card->template->profile));
        }

//        return $vcard->getOutput();

        $headers = $vcard->getHeaders(true);
        $fileName = "{$card->slug}.vcf";
        $headers['Content-Disposition'] = 'attachment; filename="' . $fileName . '"';

        return Response::make(
            $vcard->getOutput(),
            200,
            $headers
//            $vcard->getHeaders(true)
        );
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function downloadVcfCCC($slug) {
        $card = PortalCard::query()
            ->with('card_data')
            ->with('template')
            ->with('user')
            ->where('slug', $slug)->firstOrFail();
        $lang = $card->lang;
        LaravelLocalization::setLocale($lang);


        $fullName = $card->first_name . ' ' . $card->first_name;
        // إنشاء محتوى ملف VCF
        $vcfContent = "BEGIN:VCARD\n";
        $vcfContent .= "VERSION:3.0\n";
        $vcfContent .= "FN:{$fullName}\n";
//        $vcfContent .= "TEL:TYPE=CELL:{$card->user->phone}\n";
//        $vcfContent .= "TEL:TYPE=CELL:012215632555\n";
        $vcfContent .= "EMAIL:{$card->user->email}\n";
        $vcfContent .= "TITLE:{$card->job_title}\n";
        $vcfContent .= "END:VCARD\n";

        // إعداد استجابة لتحميل الملف
//        $headers = [
//            'Content-Type' => 'text/vcard',
//            'Content-Disposition' => 'attachment; filename="contact.vcf"',
//        ];
//        return Response::make($vcfContent, 200, $headers);

        return Response::streamDownload(function () use ($vcfContent) {
            echo $vcfContent;
        }, 'contact.vcf', [
            'Content-Type' => 'text/vcard; charset=utf-8',
            'Content-Disposition' => 'inline; filename="contact.vcf"',
        ]);

    }

}
