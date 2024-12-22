<?php

namespace App\AppPlugin\PortalCard;

use App\AppPlugin\PortalCard\Models\PortalCard;
use App\AppPlugin\PortalCard\Models\PortalCardTemplate;
use App\AppPlugin\PortalCard\Request\TemplateUpdateRequest;
use App\AppPlugin\PortalCard\Traits\TemplateConfigTraits;
use App\AppPlugin\UsersApp\Traits\FormInputRegexTraits;
use App\AppPlugin\UsersApp\Traits\UsersAppConfigTraits;
use App\Helpers\AdminHelper;
use App\Http\Controllers\PortalMainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CardTemplateController extends PortalMainController {

    use UsersAppConfigTraits;
    use FormInputRegexTraits;
    use TemplateConfigTraits;

    public function __construct() {
        parent::__construct();
        $this->middleware('auth:customer');

        $this->config = self::LoadConfig();
        View::share('config', $this->config);

        $this->templateList = self::TemplateListArr();
        View::share('templateList', $this->templateList);

        $formInput = self::loadFormInput();
        $this->formInput = collect($formInput);
        View::share('formInput', $this->formInput);

    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function cardEditTemplate($uuid) {
        self::LoadUserProfile();
        $card = PortalCard::query()
            ->with('template')
            ->with('all_templates')
            ->with('card_data')
            ->where('uuid', $uuid)->firstOrFail();
        $page['title'] = __('portal/cards.app_menu_edit') . " ( " . $card->card_name . " )";
        $selRoute = "cardEditTemplate";

//        dd($card);

        foreach ($this->templateList as $template) {
            $templateSettings = PortalCardTemplate::where('card_id', $card->id)
                ->where('layout_id', $template->layout_id)
                ->first();

            if ($templateSettings) {
                $template->status = 'Edit';
                $template->uuid = $templateSettings->uuid; // تخزين الـ uuid للإعدادات
            } else {
                $template->status = 'Create';
                $template->uuid = null;
            }
        }

        return view('portal.cards.template.list')->with([
            'page' => $page,
            'card' => $card,
            'selRoute' => $selRoute,
        ]);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function editTemplateSettings($uuid) {
        self::LoadUserProfile();

        $template = PortalCardTemplate::query()->where('uuid', $uuid)->firstOrFail();
        $card = PortalCard::query()->with('card_data')->where('id', $template->card_id)->firstOrFail();
        $page['title'] = __('portal/cards.app_menu_edit') . " ( " . $card->card_name . " )";
        $selRoute = "cardEditTemplate";
        $formData = json_decode($template->config, true);

        if ($template) {
            return view('portal.cards.template.form_edit')->with([
                'selRoute' => $selRoute,
                'card' => $card,
                'page' => $page,
                'template' => $template,
                'formData' => $formData,
            ]);

        } else {
            return redirect()
                ->route('portal.cards.cardEditTemplate', $card->uuid)
                ->with('err', __('portal/card_template.mass_no_temp'));
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function saveTemplateSettings(TemplateUpdateRequest $request, $uuid) {

        $templateSettings = PortalCardTemplate::query()->where('uuid', $uuid)->firstOrFail();
        $card = PortalCard::query()->where('id', $templateSettings->card_id)->firstOrFail();


        $settings = [];
        foreach (self::defTemplateConfig() as $key => $value) {
            if ($request->has($key)) {
                $settings[$key] = $request->input($key);
            }
        }
        $jsonSettings = json_encode($settings);
        $templateSettings->color = $request->input('color');
        $templateSettings->config = $jsonSettings;
        $templateSettings->save();

        return redirect()->back()->with('EditDone', '');
//        return redirect()->route('portal.cards.cardEditTemplate',$card->uuid);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function createTemplateSettings(Request $request) {
        $layout_id = $request->layout_id;
        $uuid = $request->uuid;

        $userCard = PortalCard::query()->where('uuid', $uuid)->firstOrFail();
        $userTemplate = PortalCardTemplate::query()
            ->where('layout_id', $layout_id)
            ->where('card_id', $userCard->id)
            ->count();

        if ($userTemplate == 0) {
            $defConfig = self::defTemplateConfig();
            $defConfig = json_encode($defConfig);
            $addDefTemplate = new PortalCardTemplate();
            $addDefTemplate->uuid = Str::uuid()->toString();
            $addDefTemplate->card_id = $userCard->id;
            $addDefTemplate->layout_id = $layout_id;
            $addDefTemplate->config = $defConfig;
            $addDefTemplate->save();
            return redirect()
                ->route('portal.cards.editTemplateSettings', $addDefTemplate->uuid)
                ->with('err_s', 'تم إنشاء إعدادات القالب بنجاح.');
        } else {
            return redirect()
                ->route('portal.cards.cardEditTemplate', $userCard->uuid)
                ->with('err', 'لا يوجد كارد للمستخدم.');
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function defSetTemplateCard(Request $request) {
        $userTemplate = PortalCardTemplate::query()
            ->where('uuid', $request->uuid)
            ->firstOrFail();
        $userCard = PortalCard::query()->where('id', $userTemplate->card_id)->firstOrFail();
        $userCard->layout_id = $userTemplate->layout_id;
        $userCard->template_id = $userTemplate->id;
        $userCard->save();
        return redirect()->back();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function editTemplatePhoto(Request $request) {
        self::LoadUserProfile();
        $template = PortalCardTemplate::query()
            ->where('uuid', $request->uuid)
            ->firstOrFail();

        $card = PortalCard::query()->with('card_data')->where('id', $template->card_id)->firstOrFail();
        $page['title'] = __('portal/cards.app_menu_edit') . " ( " . $card->card_name . " )";

        $key = $request->key;
        $templatePhoto = $this->templateList->where('layout_id', $template->layout_id)->first()->photos->$key ?? null;

        $page['card'] = $templatePhoto->cardH;
        $page['card_p'] = $templatePhoto->CardText;
        $page['aspectRatio'] = $templatePhoto->aspectRatio;
        $page['imageType'] = $templatePhoto->key;
        $page['dbName'] = $templatePhoto->key;
        $page['rang'] = $templatePhoto->rang;

        return view('portal.cards.template.updatePhoto')->with([
            'selRoute' => "cardEditTemplate",
            'page' => $page,
            'card' => $card,
            'template' => $template,
        ]);

    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function templatePhotoUpload(Request $request) {


        $image = $request->file('image');
        $imageType = $request->input('imageType');

        $template = PortalCardTemplate::query()
            ->where('uuid', $request->updateId)
            ->firstOrFail();


        if (!$image || !$image->isValid()) {
            return response()->json(['success' => false, 'message' => 'تم رفع ملف غير صالح.']);
        }

        $originalImage = Image::make($image);

        if ($imageType == 'profile') {
            $templatePhoto = $this->templateList->where('layout_id', $template->layout_id)->first()->photos->profile ?? null;
            $size = ['width' => $templatePhoto->width, 'height' => $templatePhoto->height];
            $dbName = 'profile';
        } elseif ($imageType == 'cover') {
            $templatePhoto = $this->templateList->where('layout_id', $template->layout_id)->first()->photos->cover ?? null;
            $size = ['width' => $templatePhoto->width, 'height' => $templatePhoto->height];
            $dbName = 'cover';
        } else {
            abort(404);
        }

        $filename = time() . '_' . rand(1000, 9000) . '.webp';
        $folderDir = 'images/card/' . date('Ym') . '/';
        AdminHelper::createDirecrotory($folderDir);
        $path = public_path($folderDir . $filename);
        $savePath = $folderDir . $filename;
        $resizedImage = $originalImage->fit($size['width'], $size['height']);
        $resizedImage->encode('webp', 80);
        $resizedImage->save($path);

        // تحقق من أن الصورة تم حفظها بنجاح
        if (!File::exists($path)) {
            return response()->json(['success' => false, 'message' => 'فشل في حفظ الصورة.']);
        }


        if (File::exists($template->$dbName)) {
            File::delete($template->$dbName);
        }
        $template->$dbName = $savePath;
        $template->save();

        return response()->json(['success' => true]);
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function deleteTemplatePhoto(Request $request) {
        self::LoadUserProfile();
        $template = PortalCardTemplate::query()
            ->where('uuid', $request->uuid)
            ->firstOrFail();
        $dbName = $request->key;
        if (File::exists($template->$dbName)) {
            File::delete($template->$dbName);
        }
        $template->$dbName = null;
        $template->save();
        return redirect()->back();
    }

}
