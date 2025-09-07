<div class="page-pretitle">
    <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">@lang('messages.navbar.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('alumnis.index') }}">@lang('messages.alumnis.page_title')</a></li>
        @if (request()->is('*work-histories*'))
            <li class="breadcrumb-item {{ request()->is('*work-histories') ? 'active' : '' }}">
                <a href="{{ route('alumnis.work-histories.show', ['alumni' => $alumni->id]) }}">@lang('messages.alumnis.work_histories')</a>
            </li>
            @if (request()->is('*create'))
                <li class="breadcrumb-item {{ request()->is('*create') ? 'active' : '' }}" aria-current="page">
                    <a href="#">@lang('messages.alumnis.create')</a>
                </li>
            @elseif (request()->is('*edit'))
                <li class="breadcrumb-item {{ request()->is('*edit') ? 'active' : '' }}" aria-current="page">
                    <a href="#">@lang('messages.alumnis.edit')</a>
                </li>
            @endif
        @endif
    </ol>
</div>
