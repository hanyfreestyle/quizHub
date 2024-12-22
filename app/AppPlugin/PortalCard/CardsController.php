<?php

namespace App\AppPlugin\PortalCard;

use App\AppPlugin\PortalCard\Models\PortalCard;
use App\AppPlugin\PortalCard\Models\PortalCardData;
use App\AppPlugin\PortalCard\Models\PortalCardInput;
use App\AppPlugin\PortalCard\Models\PortalCardInputTranslation;
use App\AppPlugin\PortalCard\Models\PortalCardTemplate;
use App\AppPlugin\PortalCard\Traits\TemplateConfigTraits;
use App\AppPlugin\UsersApp\Traits\FormInputRegexTraits;
use App\AppPlugin\UsersApp\Traits\UsersAppConfigTraits;
use App\Http\Controllers\PortalMainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CardsController extends PortalMainController {

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

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function getDataInput(Request $request) {
        $cardId = $request->cardId;
        $tempId = $request->tempId;
        $cardDataId = $request->cardDataId;
        $inputData = PortalCardInput::query()->where('id', $tempId)->firstOrFail();

        $card = PortalCard::query()->where('id', $cardId)->firstOrFail();

        $suggestions = PortalCardInputTranslation::query()->where('input_id', $tempId)
            ->where('locale', $card->lang)->get();

        $cardData = new PortalCardData();

        if (intval($cardDataId) > 0) {
            $cardData = PortalCardData::query()->where('id', $cardDataId)->firstOrFail();
        }

        $data = [
            'cardId' => $cardId,
            'tempId' => $tempId,
            'cardDataId' => $cardDataId,
            'suggestions' => $suggestions,
        ];

        $form = self::checkFormData($inputData);

        return response()->json([
            'success' => true,
            'html' => view('portal.cards.modal.modal-render', compact('data', 'inputData', 'form', 'cardData'))->render()
        ]);
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function cardsList() {

        self::LoadUserProfile();
        $page['title'] = __('portal/cards.app_menu_list');
        $userId = $this->authUser->id;
        $cards = PortalCard::query()->where('user_id', $userId)
            ->with('template')
            ->get();
//       dd($cards->first()->template->color);
        return view('portal.cards.list')->with([
            'page' => $page,
            'cards' => $cards,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function cardUpdateStatus(Request $request) {
        $card = PortalCard::query()->where('uuid', $request->card_id)->firstOrFail();
        if (!$card) {
            return response()->json(['success' => false, 'message' => 'User not found']);
        }
        $card->is_active = $request->is_active;
        $card->save();
        return response()->json([
            'success' => true,
            'is_active' => $card->is_active
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function cardAdd() {
        self::LoadUserProfile();
        $page['title'] = __('portal/cards.app_menu_add');
        return view('portal.cards.form_add')->with([
            'page' => $page,
            'card' => new PortalCard(),
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function cardCreate(Request $request) {
        self::LoadUserProfile();
        $userId = $this->authUser->id;
        $uuid = Str::uuid()->toString();
        $slug = self::createUrlSlug($userId);

        $validated = $request->validate([
            'card_name' => 'required|string|max:50',
            'lang' => 'required',
            'first_name' => 'required|string|max:50',
            'last_name' => 'nullable|string|max:50',
            'prefix' => 'nullable|string|max:10',
            'middle_name' => 'nullable|string|max:50',
            'preferred_name' => 'nullable|string|max:50',
        ]);

        $saveNewCard = new PortalCard();
        $saveNewCard->user_id = $userId;
        $saveNewCard->uuid = $uuid;
        $saveNewCard->slug = $slug;
        $saveNewCard->card_name = $request->input('card_name');
        $saveNewCard->lang = $request->input('lang');
        $saveNewCard->first_name = $request->input('first_name');
        $saveNewCard->last_name = $request->input('last_name');
        $saveNewCard->prefix = $request->input('prefix');
        $saveNewCard->middle_name = $request->input('middle_name');
        $saveNewCard->preferred_name = $request->input('preferred_name');
        $saveNewCard->save();

        $defConfig = self::defTemplateConfig();
        $defConfig = json_encode($defConfig);

        $addDefTemplate = new PortalCardTemplate();
        $addDefTemplate->uuid = Str::uuid()->toString();
        $addDefTemplate->card_id = $saveNewCard->id;
        $addDefTemplate->layout_id = 1;
        $addDefTemplate->config = $defConfig;
        $addDefTemplate->save();

        $saveNewCard->layout_id = 1;
        $saveNewCard->template_id = $addDefTemplate->id;
        $saveNewCard->save();

        return redirect()->route('portal.cards.cardEdit', $saveNewCard->uuid);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function cardEdit($uuid) {

        self::LoadUserProfile();
        $card = PortalCard::query()->with('card_data')->where('uuid', $uuid)->firstOrFail();
        $page['title'] = __('portal/cards.app_menu_edit') . " ( " . $card->card_name . " )";
        $pageView = "edit";
        $selRoute = "cardEdit";

        $qrCode = QrCode::size(300)->format('svg')->generate('https://profilehub.me/c/' . $card->slug);

//        return response($qrCode)
//            ->header('Content-Type', 'image/svg+xml')
//            ->header('Content-Disposition', 'attachment; filename="qrcode.svg"');

        return view('portal.cards.form_edit')->with([
            'page' => $page,
            'card' => $card,
            'pageView' => $pageView,
            'selRoute' => $selRoute,
            'qrCode' => $qrCode,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function cardEditLinks($uuid) {

        self::LoadUserProfile();
        $card = PortalCard::query()->with('card_data')->where('uuid', $uuid)->firstOrFail();
        $page['title'] = __('portal/cards.app_menu_edit') . " ( " . $card->card_name . " )";
        $pageView = "edit";
        $selRoute = "cardEditLinks";

        $groupedData = $card->card_data->groupBy('input_id')->map(function ($group) {
            return $group->count();
        });


//        dd($this->CashCardInputVipTemplate);

//        $vipInputs = Por

        return view('portal.cards.form_edit_links')->with([
            'page' => $page,
            'card' => $card,
            'groupedData' => $groupedData,
            'pageView' => $pageView,
            'selRoute' => $selRoute,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function cardEditSort($uuid) {

        self::LoadUserProfile();
        $card = PortalCard::query()->with('card_data')->where('uuid', $uuid)->firstOrFail();
        $page['title'] = __('portal/cards.app_menu_edit') . " ( " . $card->card_name . " )";


        $pageView = "sort";
        $selRoute = "cardEditSort";

        return view('portal.cards.form_edit_sort')->with([
            'page' => $page,
            'card' => $card,

            'pageView' => $pageView,
            'selRoute' => $selRoute,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function cardEditPhotoProfile($uuid) {
        $card = PortalCard::query()->with('card_data')->where('uuid', $uuid)->firstOrFail();
        $page['title'] = __('portal/cards.app_menu_edit') . " ( " . $card->card_name . " )";

        self::LoadUserProfile();
        $page['card'] = __('portal/cards.photo_profile_t');
        $page['card_p'] = __('portal/cards.photo_profile_p');
        $page['aspectRatio'] = 1;
        $page['imageType'] = 'profile';
        $page['rang'] = '400|2000';

        return view('portal.cards.updatePhoto')->with([
            'page' => $page,
            'card' => $card,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function cardEditPhotoCover($uuid) {
        $card = PortalCard::query()->with('card_data')->where('uuid', $uuid)->firstOrFail();
        $page['title'] = __('portal/cards.app_menu_edit') . " ( " . $card->card_name . " )";

        self::LoadUserProfile();
        $page['card'] = __('portal/cards.photo_cover_t');
        $page['card_p'] = __('portal/cards.photo_cover_p');
        $page['aspectRatio'] = 2;
        $page['imageType'] = 'cover';
        $page['rang'] = '400|2000';

        return view('portal.cards.updatePhoto')->with([
            'page' => $page,
            'card' => $card,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function photoUpload(Request $request) {
        $uuid = $request->input('updateId');
        $card = PortalCard::query()->with('card_data')->where('uuid', $uuid)->firstOrFail();
        $image = $request->file('image');
        $imageType = $request->input('imageType');

        if (!$image || !$image->isValid()) {
            return response()->json(['success' => false, 'message' => 'تم رفع ملف غير صالح.']);
        }

        $originalImage = Image::make($image);

        if ($imageType == 'profile') {
            $size = ['size' => 'm', 'width' => 500, 'height' => 500];
            $dbName = 'profile_photo';
        } elseif ($imageType == 'cover') {
            $size = ['size' => 'm', 'width' => 800, 'height' => 400];
            $dbName = 'cover_photo';
        } else {
            abort(404);
        }

        $filename = 'card_' . time() . '.webp';
        $path = public_path('images/card/' . $filename);
        $savePath = 'images/card/' . $filename;
        $resizedImage = $originalImage->fit($size['width'], $size['height']);
        $resizedImage->encode('webp', 80);
        $resizedImage->save($path);

        // تحقق من أن الصورة تم حفظها بنجاح
        if (!File::exists($path)) {
            return response()->json(['success' => false, 'message' => 'فشل في حفظ الصورة.']);
        }


        if (File::exists($card->$dbName)) {
            File::delete($card->$dbName);
        }
        $card->$dbName = $savePath;
        $card->save();

        return response()->json(['success' => true]);
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function cardUpdate(Request $request) {
//        dd($request->all());
        $updateCard = PortalCard::query()->with('card_data')->where('uuid', $request->uuid)->firstOrFail();
        $validated = $request->validate([
            'card_name' => 'required|string|max:50',
//            'color' => 'required|string|size:7|regex:/^#[a-fA-F0-9]{6}$/',
            'first_name' => 'required|string|max:50',
            'last_name' => 'nullable|string|max:50',
            'prefix' => 'nullable|string|max:10',
            'middle_name' => 'nullable|string|max:50',
            'preferred_name' => 'nullable|string|max:50',
            'job_title' => 'nullable|string|max:100',
            'department' => 'nullable|string|max:100',
            'company_name' => 'nullable|string|max:100',
            'bio' => 'nullable|string|max:300',
        ]);

        $updateCard->card_name = $validated['card_name'];
        $updateCard->first_name = $validated['first_name'];
        $updateCard->last_name = $validated['last_name'];
        $updateCard->prefix = $validated['prefix'];
        $updateCard->middle_name = $validated['middle_name'];
        $updateCard->preferred_name = $validated['preferred_name'];
        $updateCard->job_title = $validated['job_title'];
        $updateCard->department = $validated['department'];
        $updateCard->company_name = $validated['company_name'];
        $updateCard->bio = $validated['bio'];
        $updateCard->save();
        return redirect()->back()->with('EditDone', '');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function saveCardData(Request $request) {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'value' => 'required|string|max:255',
            'card_id' => 'required|integer',
            'input_id' => 'required|integer',
            'cat_id' => 'required|integer',
            'input_key' => 'required|string',
        ]);

        $maxPosition = PortalCardData::where('card_id', $validated['card_id'])->max('position');

        $cardData = new PortalCardData();
        $cardData->card_id = $validated['card_id'];
        $cardData->input_id = $validated['input_id'];
        $cardData->cat_id = $validated['cat_id'];
        $cardData->input_key = $validated['input_key'];
        $cardData->label = $validated['label'];
        $cardData->value = $validated['value'];
        $cardData->position = $maxPosition + 1;
        $cardData->save();

        $count = PortalCardData::where('input_id', $validated['input_id'])->where('card_id', $validated['card_id'])->count();
        return response()->json([
            'success' => true,
            'data' => [
                'field_id' => $validated['input_id'],
                'count' => $count,
                'card_id' => $validated['cat_id']
            ]
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function editCardData(Request $request) {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'value' => 'required|string|max:255',
            'card_id' => 'required|integer',
            'edit_id' => 'required|integer',
            'input_id' => 'required|integer',
            'cat_id' => 'required|integer',
            'input_key' => 'required|string',
        ]);
        $editData = PortalCardData::query()->where('id', $validated['edit_id'])->where('card_id', $validated['card_id'])->firstOrFail();
        $editData->label = $validated['label'];
        $editData->value = $validated['value'];
        $editData->save();
        return response()->json([
            'success' => true,
            'data' => [
                'field_id' => $validated['input_id'],
                'card_id' => $validated['cat_id']
            ]
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function getCardPreview(Request $request) {
        $cardId = $request->input('card_id');
        $card = PortalCard::query()->with('card_data')->where('id', $cardId)->firstOrFail();
        return response()->json([
            'success' => true,
            'html' => view('portal.cards.modal.card_preview', compact('card'))->render()
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function updateJobTitle(Request $request) {
        $request->validate([
            'field_name' => 'required|string',
            'field_value' => 'required|string|min:4|max:50',
        ]);
        $card = PortalCard::query()->where('uuid', $request->card_id)->firstOrFail();
        if (!$card) {
            return response()->json(['success' => false, 'message' => 'User not found']);
        }

        $fieldName = $request->field_name;
        $card->$fieldName = $request->field_value;
        $card->save();
        return response()->json(['success' => true, 'message' => 'Field updated successfully']);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function createUrlSlug($userId) {
        $timestamp = time();
        $slug = strtolower(Str::random(4) . dechex($timestamp * $userId) . Str::random(5));
        while (PortalCard::where('slug', $slug)->exists()) {
            $timestamp = time();
            $slug = strtolower(Str::random(4) . dechex($timestamp * $userId) . Str::random(5));
        }
        return $slug;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function dataSort(Request $request) {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'integer',
        ]);
        foreach ($request->order as $position => $cardDataId) {
            $cardData = PortalCardData::find($cardDataId);
            if ($cardData) {
                $cardData->position = $position + 1;
                $cardData->save();
            }
        }
        return response()->json(['success' => true, 'message' => 'تم تحديث الترتيب بنجاح']);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function deleteItem(Request $request) {
        $item = PortalCard::query()->where('uuid', $request->card_id)->firstOrFail();
        if (!$item) {
            return response()->json(['success' => false, 'message' => 'Item not found']);
        }
        $item->delete();
        return response()->json(['success' => true]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function deleteCardData(Request $request) {
        $item = PortalCardData::query()->where('id', $request->thisId)->firstOrFail();
        if (!$item) {
            return response()->json(['success' => false, 'message' => 'Item not found']);
        }
        $item->delete();
        return response()->json(['success' => true]);
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function getQrCodePopUp(Request $request) {
        $cardId = $request->cardId;
        $card = PortalCard::query()->where('uuid', $cardId)->firstOrFail();
        $qrCode = QrCode::size(300)->format('svg')->generate('https://profilehub.me/c/' . $card->slug);
        return response()->json([
            'success' => true,
            'html' => view('portal.cards.modal.modal-render-qr-code', compact('card', 'qrCode'))->render()
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function getQrCodeDownload(Request $request) {
        $cardId = $request->uuid;
        $card = PortalCard::query()->where('uuid', $cardId)->firstOrFail();

        $qrCode = QrCode::size(300)->format('svg')->generate('https://profilehub.me/c/' . $card->slug);
        return response($qrCode)
            ->header('Content-Type', 'image/svg+xml')
            ->header('Content-Disposition', 'attachment; filename="qrcode.svg"');


    }
}
