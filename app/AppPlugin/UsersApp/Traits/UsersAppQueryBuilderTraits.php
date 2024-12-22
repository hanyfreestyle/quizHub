<?php

namespace App\AppPlugin\UsersApp\Traits;

use App\AppCore\Menu\AdminMenu;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

trait UsersAppQueryBuilderTraits {
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function PageIndexQuery($config, $session, $pageViewIndex) {
        $table = $config['DbTable'];
//        $tableLang = $config['DbSchoolTrans'];
//        $tableLangForeign = $config['DbSchoolForeign'];
//        $locale = dataTableDefLang();
//        if ($locale == 'ar') {
//            $localeChange = 'en';
//        } else {
//            $localeChange = 'ar';
//        }

        if ($pageViewIndex == 'Archived') {
            $data = DB::table("$table")->whereNull('deleted_at')->where('is_archived', true);
        } elseif ($pageViewIndex == 'SoftDelete') {
            $data = DB::table("$table")->whereNotNull('deleted_at');
        } elseif ($pageViewIndex == 'Export') {
            $data = DB::table("$table")->whereNull('deleted_at');
        } else {
            $data = DB::table("$table")->whereNull('deleted_at')->where('is_archived', false);
        }

//        self::PageQueryFilter($data, $session, $table, $tableLang);

//        $data->join("$tableLang  as defLang", function ($join) use ($table, $tableLang, $tableLangForeign, $locale) {
//            $join->on("$table.id", '=', "defLang.$tableLangForeign")
//                ->where("defLang.locale", '=', $locale);
//        });


        if ($pageViewIndex == 'Export') {

        }


        $data->select(
            "$table.id as id",
            "$table.name as name",
            "$table.uuid as uuid",
            "$table.created_at as created_at",
            "$table.phone as phone",
            "$table.email as email",
            "$table.is_active as is_active",
            "$table.deleted_at as deleted_at",
        );

        if ($pageViewIndex == 'Export') {
            $data->addSelect(
                DB::raw("$table.uuid as uuid"),
                DB::raw("$table.whatsapp as whatsapp"),
            );
        }

        return $data;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function PageViewColumns($data, $pageViewIndex) {
        return DataTables::query($data)
            ->addIndexColumn()
            ->editColumn('id', function ($row) {
                return returnTableId($this->agent, $row);
            })
            ->editColumn('created_at', function ($row) use ($pageViewIndex) {
                return [
                    'display' => Carbon::parse($row->created_at)->format('Y-m-d'),
                    'timestamp' => Carbon::parse($row->created_at)->timestamp
                ];
            })
            ->editColumn('isActive', function ($row) use ($pageViewIndex) {
                if ($pageViewIndex == 'SoftDelete' or $pageViewIndex == 'Archived') {
                    return is_active($row->is_active);
                } else {
                    return is_activeUpdate($row->is_active, $this, $row);
                }
            })
            ->editColumn('passwordEdit', function ($row) {
                return returnTableBut(route($this->PrefixRoute . ".passwordEdit", $row->uuid), __('admin/form.button_edit'), "dark", "fas fa-lock");
            })
            ->editColumn('Edit', function ($row) {
                return returnTableBut(route($this->PrefixRoute . ".edit", $row->uuid), __('admin/form.button_edit'), "i", "fas fa-pencil-alt");
            })
            ->editColumn('isArchived', function ($row) {
                return returnTableBut(route($this->PrefixRoute . ".archivedUpdate", $row->uuid), __('admin/form.button_edit'), "p", "fas fa-archive");
            })
            ->editColumn('Delete', function ($row) {
                return view('datatable.but')->with(['btype' => 'Delete', 'row' => $row])->render();
            })
            ->editColumn('deleted_at', function ($row) use ($pageViewIndex) {
                if ($pageViewIndex == 'SoftDelete') {
                    return [
                        'display' => Carbon::parse($row->deleted_at)->format('Y-m-d'),
                        'timestamp' => Carbon::parse($row->deleted_at)->timestamp
                    ];
                }
            })
            ->addColumn('Restore', function ($row) use ($pageViewIndex) {
                if ($pageViewIndex == 'SoftDelete') {
                    return view('datatable.but')->with(['btype' => 'Restore', 'row' => $row])->render();
                }
            })
            ->addColumn('ForceDelete', function ($row) use ($pageViewIndex) {
                if ($pageViewIndex == 'SoftDelete') {
                    return view('datatable.but')->with(['btype' => 'ForceDelete', 'row' => $row])->render();
                }
            })
            ->rawColumns(['Edit', "Delete", 'isActive', 'passwordEdit', 'isArchived', 'photo', 'ForceDelete', 'Restore']);
    }


}
