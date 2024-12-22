<?php

namespace App\Http\Traits;

use App\Helpers\AdminHelper;
use App\Helpers\photoUpload\PuzzleUploadProcess;
use App\Http\Requests\admin\MorePhotosEditRequest;
use App\Http\Requests\admin\MorePhotosRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

trait CrudTraits {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function archivedUpdate($id) {
        if (IsConfig($this->config,'UUID')) {
            $id = checkUuid($id);
            $rowData = $this->model->where('uuid', $id)->firstOrFail();
        } else {
            $rowData = $this->model->where('id', $id)->firstOrFail();
        }

        if ($rowData->is_archived) {
            $rowData->is_archived = false;
            $rowData->is_active = true;
            $rowData->save();
        } else {
            $rowData->is_archived = true;
            $rowData->is_active = false;
            $rowData->save();
        }
        return back()->with('archived', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function activeUpdate($id) {
        if (IsConfig($this->config,'UUID')) {
            $id = checkUuid($id);
            $rowData = $this->model->where('uuid', $id)->firstOrFail();
        } else {
            $rowData = $this->model->where('id', $id)->firstOrFail();
        }
        if ($rowData->is_active) {
            $rowData->is_active = false;
            $rowData->save();
        } else {
            $rowData->is_active = true;
            $rowData->save();
        }
        return back()->with('archived', "");
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function destroy($id) {
        $deleteRow = $this->model->where('id', $id)->firstOrFail();
        $deleteRow->delete();
        self::ClearCash();
        return back()->with('confirmDelete', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function destroyEdit($id) {
        $deleteRow = $this->model->where('id', $id)->firstOrFail();
        $deleteRow->delete();
        self::ClearCash();
        return redirect()->route($this->PrefixRoute . '.index')->with('confirmDelete', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function Restore($id) {
        $restore = $this->model->onlyTrashed()->where('id', $id)->firstOrFail();
        $restore->restore();
        self::ClearCash();
        return back()->with('restore', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ForceDelete($id) {
        $deleteRow = $this->model->onlyTrashed()->where('id', $id)->firstOrFail();
        $deleteRow = AdminHelper::DeleteAllPhotos($deleteRow);
        $deleteRow->forceDelete();
        self::ClearCash();
        return back()->with('confirmDelete', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function emptyPhoto($id) {
        $rowData = $this->model->where('id', $id)->firstOrFail();
        $rowData = AdminHelper::DeleteAllPhotos($rowData, true);
        $rowData->save();
        self::ClearCash();
        return back();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function emptyIcon($id) {
        $rowData = $this->model->where('id', $id)->firstOrFail();
        if (File::exists($rowData->icon)) {
            File::delete($rowData->icon);
        }
        $rowData->icon = null;
        $rowData->save();
        self::ClearCash();
        return back();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function config() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        if ($this->configView) {
            return view($this->configView, compact('pageData'));
        } else {
            return view("admin.mainView.config", compact('pageData'));
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    function DataTableDefLang() {
        if (count(config('app.web_lang')) > 1) {
            $lang = LaravelLocalization::getCurrentLocale();
        } else {
            $lang = config('app.def_dataTableLang');
        }
        return $lang;
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function DeleteLang($id) {
        $dbName = $this->translationdb;
        $deleteRow = $this->translation->where('id', $id)->firstOrFail();
        $countLang = $this->translation->where($dbName, $deleteRow->$dbName)->count();
        if ($countLang > 1) {
            $deleteRow->delete();
        } else {
            abort(404);
        }
        self::ClearCash();
        return redirect(route($this->PrefixRoute . '.edit', $deleteRow->$dbName))->with('confirmDelete', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ClearCash() {

    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function morePhotos_list(Request $request) {
        if (!IsConfig($this->config, 'TableMorePhotos')) {
            abort(403);
        }
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $id = $request->route()->parameter('id');
        $Model = $this->model->where('id', $id)->firstOrFail();
        $ListPhotos = $this->modelPhoto->where($this->modelPhotoColumn, $id)->orderBy('position')->get();
        return view('admin.mainView.more-photos.add')->with([
            'pageData' => $pageData,
            'ListPhotos' => $ListPhotos,
            'Model' => $Model,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function morePhotos_saveSort(Request $request) {
        $positions = $request->positions;
        foreach ($positions as $position) {
            $id = $position[0];
            $newPosition = $position[1];
            $saveData = $this->modelPhoto->findOrFail($id);
            $saveData->position = $newPosition;
            $saveData->save();
        }
        return response()->json(['success' => $positions]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function morePhotos_add(MorePhotosRequest $request) {
        $saveImgData = new PuzzleUploadProcess();
        $saveImgData->setCountOfUpload('2');
        $saveImgData->setUploadDirIs($this->UploadDirIs . '/' . $request->input('model_id'));
        $saveImgData->setnewFileName($request->input('name'));
        $saveImgData->UploadMultiple($request);
        $modelPhotoColumn = $this->modelPhotoColumn;

        foreach ($saveImgData->sendSaveData as $newPhoto) {
            $saveData = $this->modelPhoto->findOrNew('0');
            $saveData->$modelPhotoColumn = $request->model_id;
            if (isset($newPhoto['photo']['file_name'])) {
                $saveData->photo = $newPhoto['photo']['file_name'];
            }
            if (isset($newPhoto['photo_thum_1']['file_name'])) {
                $saveData->photo_thum_1 = $newPhoto['photo_thum_1']['file_name'];
            }
            $saveData->save();
        }
        self::ClearCash();
        return back()->with('Add.Done', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function morePhotos_delete($id) {
        $deleteRow = $this->modelPhoto->findOrFail($id);
        $deleteRow = AdminHelper::DeleteAllPhotos($deleteRow);
        $deleteRow->delete();
        self::ClearCash();
        return back()->with('confirmDelete', "");
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function morePhotos_deleteAll($postid) {
        $model = $this->model->findOrFail($postid);
        $ForeignId = $this->config['DbPostForeignId'];
        $allPhotos = $this->modelPhoto->where($ForeignId, $postid)->get();
        foreach ($allPhotos as $photo) {
            $deleteRow = $this->modelPhoto->findOrFail($photo->id);
            $deleteRow = AdminHelper::DeleteAllPhotos($deleteRow);
            $deleteRow->delete();
        }
        self::ClearCash();
        return back()->with('confirmDelete', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function morePhotos_edit($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $rowData = $this->modelPhoto::where('id', $id)->with('modelName')->firstOrFail();
        return view('admin.mainView.more-photos.edit')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function morePhotos_update(MorePhotosEditRequest $request, $id) {
        $saveData = $this->modelPhoto::findOrNew($id);
        $saveImgData = new PuzzleUploadProcess();
        $saveImgData->setCountOfUpload('2');
        $saveImgData->setUploadDirIs($this->UploadDirIs . "/" . $request->input('model_id'));
        $saveImgData->setnewFileName($request->input('name'));
        $saveImgData->UploadOne($request);
        $saveData = AdminHelper::saveAndDeletePhoto($saveData, $saveImgData);
        $saveData->save();

        foreach (config('app.web_lang') as $key => $lang) {
            $saveTranslation = $this->photoTranslation::where("photo_id", $saveData->id)->where('locale', $key)->firstOrNew();
            $saveTranslation->photo_id = $saveData->id;
            $saveTranslation->locale = $key;
            $saveTranslation->des = $request->input($key . '.des');
            $saveTranslation->save();
        }

        self::ClearCash();
        return redirect()->back()->with('Edit.Done', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function morePhotos_editAll($postId) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $thisModel = $this->model::findOrFail($postId);
        $rowData = $this->modelPhoto::where($this->modelPhotoColumn, '=', $postId)->with('translations')->orderBy('position')->get();
        return view('admin.mainView.more-photos.edit-all')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'thisModel' => $thisModel,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function morePhotos_updateAll(Request $request, $id) {
        foreach ($request->input('id') as $id) {
            $UpdatePhoto = $this->modelPhoto::findOrFail($id);
            $UpdatePhoto->print_photo = $request->input('print_photo_' . $id) ?? 2;
            $UpdatePhoto->save();

            foreach (config('app.web_lang') as $key => $lang) {
                $saveTranslation = $this->photoTranslation::where('photo_id', $UpdatePhoto->id)->where('locale', $key)->firstOrNew();
                $saveTranslation->photo_id = $UpdatePhoto->id;
                $saveTranslation->locale = $key;
                $saveTranslation->des = $request->input('des_' . $key . '_' . $id);
                $saveTranslation->save();
            }
        }
        self::ClearCash();
        return redirect()->back()->with('Edit.Done', "");
    }

}
