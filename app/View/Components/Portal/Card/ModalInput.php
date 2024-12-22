<?php

namespace App\View\Components\Portal\Card;

use App\AppPlugin\PortalCard\Models\PortalCard;
use App\AppPlugin\PortalCard\Models\PortalCardData;
use App\AppPlugin\PortalCard\Models\PortalCardInput;
use App\AppPlugin\PortalCard\Models\PortalCardInputTranslation;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalInput extends Component {

    public $modalId;
    public $cardId;
    public $fieldId;
    public $inputData;
    public $type;
    public $cardData;
    public $editId;
    public $formName;
    public $form;

    public function __construct(
        $modalId, $cardId, $fieldId,
        $inputData = null,
        $editId = null,
        $type = 'add',
        $cardData = array(),
        $formName = null,
        $form = [],

    ) {
        $this->modalId = $modalId;
        $this->cardId = $cardId;
        $this->fieldId = $fieldId;
        $this->editId = $editId;
        $this->type = $type;
        if ($this->type == 'add') {
            $this->inputData = PortalCardInput::query()->where('id', $fieldId)->firstOrFail();
            $this->cardData = $cardData;
            $this->formName = 'SaveDataForm';
        } elseif ($this->type == 'edit') {
            $this->inputData = PortalCardInput::query()->where('id', $fieldId)->firstOrFail();
            $this->cardData = PortalCardData::query()->where('id', $this->editId)->firstOrFail();
            $this->formName = 'EditDataForm';
        }


        $card = PortalCard::query()->where('id', $this->cardId)->firstOrFail();
        $suggestions = PortalCardInputTranslation::query()->where('input_id', $fieldId)
            ->where('locale', $card->lang)->get();

        $form = self::checkFormData($this->inputData);
        $form['suggestions'] = $suggestions;
        $this->form = $form;

    }




#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function checkFormData($row) {
        $form['css'] = 'input_dir_en lang_en';
        $form['t_value'] = __('portal/cards.fr_data_value_url');
        $form['t_label'] = __('portal/cards.fr_data_label');
        $form['req'] = ' required ';
        $form['req_label'] = ' required ';
        $form['formType'] = 'text';


        if ($row->type == 'email') {
            $form['t_value'] = __('portal/cards.fr_data_value_email');
            $form['formType'] = 'email';
            $form['req'] = ' required   pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"  data-parsley-error-message="' . $row->err_ar . '"';
        } elseif ($row->type == 'url') {
            $form['formType'] = 'url';
            $form['req'] = self::checkPatternUrl($row);
        } elseif ($row->type == 'number') {
//            if ($row->input_id == 'Phone' or $row->input_id == 'WhatsApp') {
//                $form['formType'] = 'phone';
//            } else {
//                $form['formType'] = 'number';
//            }
            $form['formType'] = 'phone';
            $form['req'] = self::checkPatternNumber($row);
            $form['t_value'] = self::checkValueName($row);
        } elseif ($row->type == 'text') {
            $form['css'] = '';
            $form['t_value'] = self::checkValueName($row);
            $form['req'] = self::checkPatternText($row);
        }

        return $form;
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function checkPatternText($row) {
        if ($row->input_id == 'Address') {
            $req = 'required data-parsley-length="[2, 50]" ';
        } elseif ($row->input_id == 'City') {
            $req = 'required data-parsley-length="[1, 50]" ';
        } elseif ($row->input_id == 'Country') {
            $req = 'required data-parsley-length="[2, 50]" ';
        } elseif ($row->input_id == 'xxxxxxxxxxxxxxxxxxx') {
            $req = ' required   pattern="xxxxxxxxxxxxxxxx" ';
        } elseif ($row->input_id == 'xxxxxxxxxxxxxxxxxxx') {
            $req = ' required   pattern="xxxxxxxxxxxxxxxx" ';
        } elseif ($row->input_id == 'xxxxxxxxxxxxxxxxxxx') {
            $req = ' required   pattern="xxxxxxxxxxxxxxxx" ';
        } elseif ($row->input_id == 'xxxxxxxxxxxxxxxxxxx') {
            $req = ' required   pattern="xxxxxxxxxxxxxxxx" ';
            $req = ' required   pattern="xxxxxxxxxxxxxxxx" ';
        } else {
            $req = 'required data-parsley-length="[6, 50]" ';
        }
        return $req;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function checkValueName($row) {
        if ($row->input_id == 'PostalCodexxxxx') {
            $name = '';
        } elseif ($row->input_id == 'WhatsApp') {
            $name = ' رقم الوتس اب ';
        } else {
            $name = $row->name;
        }
        return $name;
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function checkPatternNumber($row) {
        if ($row->input_id == 'PostalCode') {
            $req = ' required   pattern="/^[a-zA-Z0-9\s\-]{4,10}$/" data-parsley-error-message="' . self::checkErrlang($row) . '"';
        } elseif ($row->input_id == 'Phone') {
            $req = ' required  pattern="^\+?\d{7,20}$" data-parsley-error-message="' . self::checkErrlang($row) . '"';
        } elseif ($row->input_id == 'WhatsApp') {
            $req = ' required  pattern="^\+?\d{7,20}$" data-parsley-error-message="' . self::checkErrlang($row) . '"';
        } elseif ($row->input_id == 'Viber') {
            $req = ' required  pattern="^\+?\d{7,20}$" data-parsley-error-message="' . self::checkErrlang($row) . '"';
        } else {
            $req = ' required   pattern="\d+" data-parsley-error-message="' . __('portal/cards.mass_err_url') . '"';
        }
        return $req;
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function checkPatternUrl($row) {
        if ($row->input_id == 'Facebook') {
            $req = ' required   pattern="^https?:\/\/(www\.)?facebook\.com\/[a-zA-Z0-9.]+\/?$" data-parsley-error-message="' . self::checkErrlang($row) . '"';
        } elseif ($row->input_id == 'Twitter') {
            $req = ' required   pattern="^https?:\/\/(www\.)?x\.com\/[a-zA-Z0-9_]+\/?$" data-parsley-error-message="' . $row->err_ . self::checkErrlang($row) . '"';
        } elseif ($row->input_id == 'LinkedIn') {
            $req = ' required   pattern="^https?:\/\/(www\.)?linkedin\.com\/(in|company)\/[a-zA-Z0-9_-]+\/?$" data-parsley-error-message="' . $row->err_ . self::checkErrlang($row) . '"';
        } elseif ($row->input_id == 'Instagram') {
            $req = ' required   pattern="^https?:\/\/(www\.)?instagram\.com\/[a-zA-Z0-9_.]+\/?$" data-parsley-error-message="' . $row->err_ . self::checkErrlang($row) . '"';
        } elseif ($row->input_id == 'YouTube') {
            $req = ' required   pattern="^https:\/\/(www\.)?youtube\.com\/@([a-zA-Z0-9_]+)\/?$" data-parsley-error-message="' . $row->err_ . self::checkErrlang($row) . '"';
        } elseif ($row->input_id == 'Pinterest') {
            $req = ' required   pattern="^https:\/\/www\.pinterest\.com\/[a-zA-Z0-9_\/-]+\/?$" data-parsley-error-message="' . $row->err_ . self::checkErrlang($row) . '"';
        } elseif ($row->input_id == 'Snapchat') {
            $req = ' required   pattern="^https:\/\/(www\.)?snapchat\.com\/add\/[a-zA-Z0-9._]+\/?$" data-parsley-error-message="' . $row->err_ . self::checkErrlang($row) . '"';
        } elseif ($row->input_id == 'TikTok') {
            $req = ' required   pattern="^https:\/\/(www\.)?tiktok\.com\/@?[a-zA-Z0-9._-]+\/?$" data-parsley-error-message="' . $row->err_ . self::checkErrlang($row) . '"';
        } elseif ($row->input_id == 'Flickr') {
            $req = ' required   pattern="^https:\/\/(www\.)?flickr\.com\/.*$" data-parsley-error-message="' . $row->err_ . self::checkErrlang($row) . '"';
        } elseif ($row->input_id == 'Behance') {
            $req = ' required   pattern="^https:\/\/www\.behance\.net\/[a-zA-Z0-9_-]+\/?$" data-parsley-error-message="' . $row->err_ . self::checkErrlang($row) . '"';
        } elseif ($row->input_id == 'Reddit') {
            $req = ' required   pattern="^https:\/\/www\.reddit\.com\/user\/[a-zA-Z0-9_-]+\/?$" data-parsley-error-message="' . $row->err_ . self::checkErrlang($row) . '"';
        } elseif ($row->input_id == 'Vimeo') {
            $req = ' required   pattern="^https:\/\/(www\.)?vimeo\.com\/[a-zA-Z0-9_-]+\/?$" data-parsley-error-message="' . $row->err_ . self::checkErrlang($row) . '"';
        } elseif ($row->input_id == 'Quora') {
            $req = ' required   pattern="^https:\/\/www\.quora\.com\/profile\/[a-zA-Z0-9_-]+\/?$" data-parsley-error-message="' . $row->err_ . self::checkErrlang($row) . '"';
        } elseif ($row->input_id == 'Tumblr') {
            $req = ' required   pattern="^https:\/\/(www\.)?[a-zA-Z0-9_-]+\.tumblr\.com\/?$" data-parsley-error-message="' . $row->err_ . self::checkErrlang($row) . '"';
        } elseif ($row->input_id == 'Twitch') {
            $req = ' required   pattern="^https:\/\/(www\.)?twitch\.tv\/[a-zA-Z0-9_-]+\/?$" data-parsley-error-message="' . $row->err_ . self::checkErrlang($row) . '"';
        } elseif ($row->input_id == 'Medium') {
            $req = ' required   pattern="^https:\/\/(www\.)?medium\.com\/@[a-zA-Z0-9_-]+\/?$" data-parsley-error-message="' . $row->err_ . self::checkErrlang($row) . '"';
        } elseif ($row->input_id == 'Dribbble') {
            $req = ' required   pattern="^https:\/\/(www\.)?dribbble\.com\/[a-zA-Z0-9_-]+\/?$" data-parsley-error-message="' . $row->err_ . self::checkErrlang($row) . '"';
        } elseif ($row->input_id == 'GoogleMap') {
            $req = ' required   pattern="^https:\/\/maps\.app\.goo\.gl\/[A-Za-z0-9]+$" data-parsley-error-message="' . $row->err_ . self::checkErrlang($row) . '"';
        } elseif ($row->input_id == 'Telegram') {
            $req = ' required   pattern="^https:\/\/t\.me\/[a-zA-Z0-9_]{5,32}$" data-parsley-error-message="' . $row->err_ . self::checkErrlang($row) . '"';
        } elseif ($row->input_id == 'Messenger') {
            $req = ' required   pattern="^https:\/\/m\.me\/[a-zA-Z0-9._-]+$" data-parsley-error-message="' . $row->err_ . self::checkErrlang($row) . '"';
        } elseif ($row->input_id == 'SnapchatChat') {
            $req = ' required   pattern="^https:\/\/www\.snapchat\.com\/add\/[a-zA-Z0-9._-]+$" data-parsley-error-message="' . $row->err_ . self::checkErrlang($row) . '"';
        } elseif ($row->input_id == 'MicrosoftTeams') {
            $req = ' required   pattern="^https:\/\/(www\.)?teams\.microsoft\.com\/[a-zA-Z0-9_\/?-]+$" data-parsley-error-message="' . $row->err_ . self::checkErrlang($row) . '"';
        } elseif ($row->input_id == 'Discord') {
            $req = ' required   pattern="^https:\/\/discord\.com\/users\/\d{17,19}$" data-parsley-error-message="' . $row->err_ . self::checkErrlang($row) . '"';
        } elseif ($row->input_id == 'GoogleChat') {
            $req = ' required   pattern="^https:\/\/chat\.google\.com\/[a-zA-Z0-9_\/-]+$" data-parsley-error-message="' . $row->err_ . self::checkErrlang($row) . '"';
        } elseif ($row->input_id == 'Slack') {
            $req = ' required   pattern="^https:\/\/[a-zA-Z0-9_-]+\.slack\.com\/?$" data-parsley-error-message="' . $row->err_ . self::checkErrlang($row) . '"';
        } elseif ($row->input_id == 'Signal') {
            $req = ' required   pattern="^https:\/\/signal\.me\/#p\/\d{10,15}$" data-parsley-error-message="' . $row->err_ . self::checkErrlang($row) . '"';
        } elseif ($row->input_id == 'xxxxxxxxxxxxxx') {
            $req = ' required   pattern="xxxxxxxxxxxxxxx" data-parsley-error-message="' . $row->err_ . self::checkErrlang($row) . '"';
        } elseif ($row->input_id == 'xxxxxxxxxxxxxx') {
            $req = ' required   pattern="xxxxxxxxxxxxxxx" data-parsley-error-message="' . $row->err_ . self::checkErrlang($row) . '"';
        } elseif ($row->input_id == 'xxxxxxxxxxxxxx') {
            $req = ' required   pattern="xxxxxxxxxxxxxxx" data-parsley-error-message="' . $row->err_ . self::checkErrlang($row) . '"';
        } elseif ($row->input_id == 'xxxxxxxxxxxxxx') {
            $req = ' required   pattern="xxxxxxxxxxxxxxx" data-parsley-error-message="' . $row->err_ . self::checkErrlang($row) . '"';
        } elseif ($row->input_id == 'xxxxxxxxxxxxxx') {
            $req = ' required   pattern="xxxxxxxxxxxxxxx" data-parsley-error-message="' . $row->err_ . self::checkErrlang($row) . '"';
        } elseif ($row->input_id == 'xxxxxxxxxxxxxx') {
            $req = ' required   pattern="xxxxxxxxxxxxxxx" data-parsley-error-message="' . $row->err_ . self::checkErrlang($row) . '"';
        } elseif ($row->input_id == 'xxxxxxxxxxxxxx') {
            $req = ' required   pattern="xxxxxxxxxxxxxxx" data-parsley-error-message="' . $row->err_ . self::checkErrlang($row) . '"';

        } else {
            $req = ' required   pattern="/^(https?|ftp):\/\/[^\s/$.?#].[^\s]*$/" data-parsley-error-message="' . __('portal/cards.mass_err_url') . '"';
        }

        return $req;


    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function checkErrlang($row) {
        if (thisCurrentLocale() == 'ar') {
            $err = $row->err_ar;
        } else {
            $err = $row->err_en;
        }
        return $err;
    }


    public function render(): View|Closure|string {

        return view('components.portal.card.modal-input');
    }
}
