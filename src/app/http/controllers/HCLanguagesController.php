<?php namespace interactivesolutions\honeycomblanguages\http\controllers;

use interactivesolutions\honeycombcore\http\controllers\HCBaseController;
use interactivesolutions\honeycomblanguages\models\Languages;
use interactivesolutions\honeycomblanguages\validators\HCLanguagesValidator;

class HCLanguagesController extends HCBaseController
{

    /**
     * Returning configured admin view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminView()
    {
        $config = [
            'title'       => trans('HCLanguages::languages.page_title'),
            'listURL'     => route('admin.api.languages'),
            'newFormUrl'  => route('admin.api.form-manager', ['languages-new']),
            'editFormUrl' => route('admin.api.form-manager', ['languages-edit']),
            'imagesUrl'   => route('resource.get', ['/']),
            'headers'     => $this->getAdminListHeader(),
        ];

        if ($this->user()->can('interactivesolutions_honeycomb_languages_languages_create'))
            $config['actions'][] = 'new';

        if ($this->user()->can('interactivesolutions_honeycomb_languages_languages_update'))
        {
            $config['actions'][] = 'update';
            $config['actions'][] = 'restore';
        }

        if ($this->user()->can('interactivesolutions_honeycomb_languages_languages_delete'))
            $config['actions'][] = 'delete';

        if ($this->user()->can('interactivesolutions_honeycomb_languages_languages_search'))
            $config['actions'][] = 'search';

        return view('HCCoreUI::admin.content.list', ['config' => $config]);
    }

    /**
     * Creating Admin List Header based on Main Table
     *
     * @return array
     */
    public function getAdminListHeader()
    {
        return [
            'language_family'     => [
    "type"  => "text",
    "label" => trans('HCLanguages::languages.language_family'),
],
'language'     => [
    "type"  => "text",
    "label" => trans('HCLanguages::languages.language'),
],
'native_name'     => [
    "type"  => "text",
    "label" => trans('HCLanguages::languages.native_name'),
],
'iso_639_1'     => [
    "type"  => "text",
    "label" => trans('HCLanguages::languages.iso_639_1'),
],
'iso_639_2'     => [
    "type"  => "text",
    "label" => trans('HCLanguages::languages.iso_639_2'),
],

        ];
    }

    /**
    * Create item
    *
    * @param null $data
    * @return mixed
    */
    protected function __create($data = null)
    {
        if(is_null($data))
            $data = $this->getInputData();

        $record = Languages::create(array_get($data, 'record'));

        return $this->getSingleRecord($record->id);
    }

    /**
    * Updates existing item based on ID
    *
    * @param $id
    * @return mixed
    */
    protected function __update($id)
    {
        $record = Languages::findOrFail($id);

        $data = $this->getInputData();

        $record->update(array_get($data, 'record'));

        return $this->getSingleRecord($record->id);
    }

    /**
    * Delete records table
    *
    * @param $list
    * @return mixed|void
    */
    protected function __delete(array $list)
    {
        Languages::destroy($list);
    }

    /**
    * Delete records table
    *
    * @param $list
    * @return mixed|void
    */
    protected function __forceDelete(array $list)
    {
        Languages::onlyTrashed()->whereIn('id', $list)->forceDelete();
    }

    /**
    * Restore multiple records
    *
    * @param $list
    * @return mixed|void
    */
    protected function __restore(array $list)
    {
        Languages::whereIn('id', $list)->restore();
    }

    /**
    * @return mixed
    */
    public function listData()
    {
        $with = [];
        $select = Languages::getFillableFields();

        $list = Languages::with($with)->select($select)
        // add filters
        ->where(function ($query) use ($select) {
            $query = $this->getRequestParameters($query, $select);
        });

        // enabling check for deleted
        $list = $this->checkForDeleted($list);

        // add search items
        $list = $this->listSearch($list);

        // ordering data
        $list = $this->orderData($list, $select);

        return $list->paginate($this->recordsPerPage)->toArray();
    }

    /**
    * List search elements

    * @param $list
    * @return mixed
    */
    protected function listSearch($list)
    {
        if(request()->has('q'))
        {
            $parameter = request()->input('q');

            $list = $list->where(function ($query) use ($parameter)
            {
                $query->where('language_family', 'LIKE', '%' . $parameter . '%')
->orWhere('language', 'LIKE', '%' . $parameter . '%')
->orWhere('native_name', 'LIKE', '%' . $parameter . '%')
->orWhere('iso_639_1', 'LIKE', '%' . $parameter . '%')
->orWhere('iso_639_2', 'LIKE', '%' . $parameter . '%')
;
            });
        }

        return $list;
    }

    /**
     * Getting user data on POST call
     *
     * @return mixed
     */
    protected function getInputData()
    {
        (new HCLanguagesValidator())->validateForm();

        $_data = request()->all();

        array_set($data, 'record.language_family', array_get($_data, 'language_family'));
array_set($data, 'record.language', array_get($_data, 'language'));
array_set($data, 'record.native_name', array_get($_data, 'native_name'));
array_set($data, 'record.iso_639_1', array_get($_data, 'iso_639_1'));
array_set($data, 'record.iso_639_2', array_get($_data, 'iso_639_2'));

        return $data;
    }

    /**
     * Getting single record
     *
     * @param $id
     * @return mixed
     */
    public function getSingleRecord($id)
    {
        $with = [];

        $select = Languages::getFillableFields();

        $record = Languages::with($with)
            ->select($select)
            ->where('id', $id)
            ->firstOrFail();

        return $record;
    }
}
