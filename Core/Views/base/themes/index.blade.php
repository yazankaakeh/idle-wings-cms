@extends('core::base.layouts.master')
@section('title')
    {{ translate('Themes') }}
@endsection
@section('custom_css')
@endsection
@section('main_content')
    <div class="align-items-center border-bottom2 d-flex flex-wrap gap-10 justify-content-between mb-4 pb-3">
        <h4><i class="icofont-ui-theme"></i>{{ translate('Themes') }}</h4>
        <div class="d-flex align-items-center gap-10 flex-wrap">
            <a
                href="https://documentation.cmslooks.themelooks.us/blog/how-to-make-custom-theme-for-cmslooks">{{ translate('Theme Creating Guide') }}</a>
            <a href="{{ route('core.themes.create') }}" class="btn long">{{ translate('Install Theme') }}</a>
        </div>
    </div>
    <div class="app-items theme-items">
        <div>
            @if (count($errors) > 0)
                <div>
                    <ul class="p-0">
                        @foreach ($errors->all() as $error)
                            <p class="alert alert-danger">{{ $error }}</p>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="row">
            @foreach ($themes as $theme)
                <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 mb-30">
                    <div class="app-item">
                        <div class="app-icon">
                            <img src="{{ asset('/themes' . '/' . $theme['location'] . '/banner.png') }}"
                                alt="{{ $theme['name'] }}" />
                        </div>
                        <div class="app-details">
                            <h4 class="app-name">{{ $theme['name'] }}</h4>
                        </div>
                        <div class="app-footer">
                            <div class="app-author">
                                {{ translate('By:') }}
                                <a href="{{ $theme['url'] }}" target="_blank">{{ $theme['author'] }}</a>
                            </div>
                            <div class="app-version">{{ translate('Version:') }} {{ $theme['version'] }}</div>
                            <div class="app-description" title="{{ $theme['name'] }}">
                                {{ $theme['description'] }}
                            </div>
                            <div class="app-actions">
                                @if ($theme['is_activated'] == 1)
                                    <button class="btn sm btn-success btn-trigger-change-status"
                                        data-theme="{{ $theme['id'] }}">
                                        <i class="icofont-ui-check"></i> {{ translate('Activated') }}
                                    </button>
                                @else
                                    <button class="btn sm btn-info btn-trigger-change-status activate-theme"
                                        data-theme="{{ json_encode($theme) }}">
                                        {{ translate('Activate') }}
                                    </button>
                                @endif
                                @if ($theme['location'] != 'default')
                                    <button class="btn sm btn-danger delete-theme ml-3"
                                        data-theme="{{ route('core.themes.delete', $theme['id']) }}">
                                        {{ translate('Delete') }}
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!--Active Modal-->
    <div id="active-modal" class="delete-modal modal fade show" aria-modal="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title h6">{{ translate('activate Confirmation') }}</h4>
                </div>
                <div class="modal-body text-center">
                    <p class="mt-1">{{ translate('Are you sure to active this theme') }}?</p>
                    <form method="POST" action="{{ route('core.themes.active') }}">
                        @csrf
                        <input type="hidden" id="active-theme-id" name="id">
                        <button type="button" class="btn long mt-2 btn-danger"
                            data-dismiss="modal">{{ translate('cancel') }}</button>
                        <button type="submit" class="btn long mt-2">{{ translate('Activate') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--End Active  Modal-->

    <!-- Delete Modal-->
    <div id="delete-modal" class="delete-modal modal fade show" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title h6">{{ translate('Delete Confirmation') }}</h4>
                </div>
                <div class="modal-body text-center">
                    <p class="mt-1">{{ translate('Are you sure to delete this Theme') }}?</p>
                    <form method="POST" action="" id="delete-form">
                        @csrf
                        @method('delete')
                        <input type="hidden" id="theme-id" name="theme-id">
                        <button type="button" class="btn long mt-2 btn-danger"
                            data-dismiss="modal">{{ translate('Cancel') }}</button>
                        <button type="submit" class="btn long mt-2">{{ translate('Delete') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Modal-->

    <!-- Purchase Key Modal-->
    <div id="verify-purchase-modal" class="verify-purchase-modal modal fade show" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title h6">{{ translate('Active Confirmation') }}</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('core.theme.purchase.verify') }}">
                        @csrf
                        <input type="hidden" id="theme-location" name="theme-location">
                        <input type="hidden" id="license_api" name="license_api">
                        <label for="purchase_key" class="black bold font-14 mb-1">{{ translate('Purchase Key') }}</label>
                        <input type="text" id="purchase_key" name="purchase_key" class="form-control mb-2"
                            placeholder="{{ translate('Give Purchase Key To Activate This Theme') }}">
                        <button type="button" class="btn long mt-2 btn-danger"
                            data-dismiss="modal">{{ translate('Cancel') }}</button>
                        <button type="submit" class="btn long mt-2">{{ translate('Activate') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Purchase Key Modal-->
@endsection
@section('custom_scripts')
    <script>
        /**
         * Activate theme
         * */
        $('.activate-theme').on('click', function(e) {
            "use strict";
            e.preventDefault();
            let theme = $(this).data('theme');
            if (theme.license && !theme.is_verified) {
                $("#theme-location").val(theme.location);
                $("#license_api").val(theme.license_api);
                $('#verify-purchase-modal').modal('show');
            } else {
                $("#active-theme-id").val(theme.id);
                $('#active-modal').modal('show');
            }
        });

        /**
         * Delete Theme
         * */
        $('.delete-theme').on('click', function(e) {
            e.preventDefault();
            let theme_url = $(this).data('theme');
            $("#delete-form").attr('action', theme_url);
            $('#delete-modal').modal('show');
        });
    </script>
@endsection
