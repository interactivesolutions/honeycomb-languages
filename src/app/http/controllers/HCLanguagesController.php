<?php namespace interactivesolutions\honeycomblanguages\app\http\controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Session;
use InteractiveSolutions\HoneycombCore\Errors\Facades\HCLog;
use InteractiveSolutions\HoneycombCore\Http\Controllers\HCBaseController;
use interactivesolutions\honeycomblanguages\app\models\HCLanguages;

class HCLanguagesController extends HCBaseController
{

    /**
     * List of available keys for strict update
     *
     * @var array
     */
    protected $strictUpdateKeys = ['content', 'front_end', 'back_end'];

    /**
     * Returning configured admin view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminIndex()
    {
        $config = [
            'title' => trans('HCLanguages::languages.page_title'),
            'listURL' => route('admin.api.languages'),
            'newFormUrl' => route('admin.api.form-manager', ['languages-new']),
            'editFormUrl' => route('admin.api.form-manager', ['languages-edit']),
            'imagesUrl' => route('resource.get', ['/']),
            'headers' => $this->getAdminListHeader(),
        ];

        $config['actions'][] = 'search';

        return hcview('HCCoreUI::admin.content.list', ['config' => $config]);
    }

    /**
     * Creating Admin List Header based on Main Table
     *
     * @return array
     */
    public function getAdminListHeader()
    {
        return [
            'language_family' => [
                "type" => "text",
                "label" => trans('HCLanguages::languages.language_family'),
            ],
            'language' => [
                "type" => "text",
                "label" => trans('HCLanguages::languages.language'),
            ],
            'native_name' => [
                "type" => "text",
                "label" => trans('HCLanguages::languages.native_name'),
            ],
            'iso_639_1' => [
                "type" => "text",
                "label" => trans('HCLanguages::languages.iso_639_1'),
            ],
            'iso_639_2' => [
                "type" => "text",
                "label" => trans('HCLanguages::languages.iso_639_2'),
            ],
            'front_end' => [
                "type" => "checkbox",
                "label" => trans('HCLanguages::languages.front_end'),
                "url" => route('admin.api.languages.update.strict', 'id'),
            ],
            'back_end' => [
                "type" => "checkbox",
                "label" => trans('HCLanguages::languages.back_end'),
                "url" => route('admin.api.languages.update.strict', 'id'),
            ],
            'content' => [
                "type" => "checkbox",
                "label" => trans('HCLanguages::languages.content'),
                "url" => route('admin.api.languages.update.strict', 'id'),
            ],

        ];
    }

    /**
     * Updates existing specific items based on ID
     *
     * @param string $id
     * @return mixed
     */
    protected function __apiUpdateStrict(string $id)
    {
        HCLanguages::where('id', $id)->update($this->getStrictRequestParameters());

        return $this->apiShow($id);
    }

    /**
     * Creating data query
     *
     * @param array $select
     * @return mixed
     */
    protected function createQuery(array $select = null)
    {
        $with = [];

        if ($select == null) {
            $select = HCLanguages::getFillableFields();
        }

        $list = HCLanguages::with($with)->select($select)
            // add filters
            ->where(function($query) use ($select) {
                $query = $this->getRequestParameters($query, $select);
            });

        // enabling check for deleted
        $list = $this->checkForDeleted($list);

        // add search items
        $list = $this->search($list);

        // ordering data
        $list = $this->orderData($list, $select);

        return $list;
    }

    /**
     * List search elements
     * @param Builder $query
     * @param string $phrase
     * @return Builder
     */
    protected function searchQuery(Builder $query, string $phrase)
    {
        return $query->where(function(Builder $query) use ($phrase) {
            $query->where('language_family', 'LIKE', '%' . $phrase . '%')
                ->orWhere('language', 'LIKE', '%' . $phrase . '%')
                ->orWhere('native_name', 'LIKE', '%' . $phrase . '%')
                ->orWhere('iso_639_1', 'LIKE', '%' . $phrase . '%')
                ->orWhere('iso_639_2', 'LIKE', '%' . $phrase . '%')
                ->orWhere('front_end', 'LIKE', '%' . $phrase . '%')
                ->orWhere('back_end', 'LIKE', '%' . $phrase . '%')
                ->orWhere('content', 'LIKE', '%' . $phrase . '%');
        });
    }

    /**
     * Getting single record
     *
     * @param $id
     * @return mixed
     */

    public function apiShow(string $id)
    {
        $with = [];

        $select = HCLanguages::getFillableFields();

        $record = HCLanguages::with($with)
            ->select($select)
            ->where('id', $id)
            ->firstOrFail();

        return $record;
    }

    public function changeLanguage(string $location, string $lang)
    {
        switch ($location) {
            case 'front-end' :

                if (in_array($lang, getHCFrontEndLanguages())) {
                    session('front-end', $lang);
                    session('content', $lang);
                } else {
                    return HCLog::error('L-001', trans('HCTranslations::core.language_not_found'));
                }

                break;

            case 'back-end' :

                if (in_array($lang, getHCBackEndLanguages())) {
                    Session::set('back-end', $lang);
                } else {
                    return HCLog::error('L-002', trans('HCTranslations::core.language_not_found'));
                }

                break;

            case 'content' :

                if (in_array($lang, getHCContentLanguages())) {
                    Session::set('content', $lang);
                } else {
                    return HCLog::error('L-003', trans('HCTranslations::core.language_not_found'));
                }

                break;
        }
    }
}
