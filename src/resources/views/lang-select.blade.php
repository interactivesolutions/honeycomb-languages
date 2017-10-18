<li class="dropdown">

    {{--@if(in_array(app()->getLocale(), array_pluck($languages, 'id')))--}}

    {{--@foreach($languages as $language)--}}
    {{--@if($language['id'] == app()->getLocale())--}}
    {{--<a title="{{$language['label']}}" class="dropdown-toggle" data-toggle="dropdown" href="#">--}}
    {{--<img style="padding-right:3px " src="{{ route('resource.get', $language['resource_id']) }}"--}}
    {{--alt="{{ trans('languages::codes.' . $language['id'])}}" width="20"/>--}}
    {{--<i class="fa fa-angle-down"></i>--}}
    {{--</a>--}}
    {{--@endif--}}
    {{--@endforeach--}}

    {{--@else--}}
    {{--<a class="dropdown-toggle" data-toggle="dropdown" href="#">--}}
    {{--{{ trans('languages::languages.select_lang') }}--}}
    {{--<i class="fa fa-angle-down"></i>--}}
    {{--</a>--}}
    {{--@endif--}}

    {{--<ul class="dropdown-menu dropdown-user">--}}
    {{--@foreach($languages as $language)--}}
    {{--<li class="languageSelector @if($language['id'] == app()->getLocale()) active @endif">--}}
    {{--<a title="{{$language['label']}}"--}}
    {{--href="{{ route('api.settings.languages.change', ['backend', $language['id']]) }}">--}}
    {{--<img src="{{ route('resource.get', $language['resource_id']) }}" alt="" width="20"/>--}}
    {{--{{ trans('languages::codes.' . $language['id'])}}--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--@endforeach--}}
    {{--</ul>--}}

</li>