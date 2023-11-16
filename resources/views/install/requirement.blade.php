@extends('install.layouts.master')

@section('template_title')
    Server Requirements
@endsection

@section('title')
    Server Requirements
@endsection

@section('container')

    @foreach ($requirements['requirements'] as $type => $requirement)
        <ul class="list">
            <li class="list__item list__title {{ $phpSupportInfo['supported'] ? 'success' : 'error' }}">
                <strong>{{ ucfirst($type) }}</strong>
                @if ($type == 'php')
                    <strong>
                        <small>
                            (version {{ $phpSupportInfo['minimum'] }} required)
                        </small>
                    </strong>
                    <span class="float-right">
                        <strong>
                            {{ $phpSupportInfo['current'] }}
                        </strong>
                        <i class="fa fa-fw fa-{{ $phpSupportInfo['supported'] ? 'check-circle-o' : 'exclamation-circle' }} row-icon"
                            aria-hidden="true"></i>
                    </span>
                @endif
            </li>
            @foreach ($requirements['requirements'][$type] as $extention => $enabled)
                <li class="list__item {{ $enabled ? 'success' : 'error' }}">
                    {{ $extention }}
                    <i class="fa fa-fw fa-{{ $enabled ? 'check-circle-o' : 'exclamation-circle' }} row-icon"
                        aria-hidden="true"></i>
                </li>
            @endforeach
        </ul>
    @endforeach

    @if (!isset($requirements['errors']) && $phpSupportInfo['supported'])
        <div class="buttons">
            <a class="button" href="{{ route('install.permissions') }}">
                Check Permissions
            </a>
        </div>
    @else
        <div class="buttons">
            <a class="button cursor-none" href="#">
                Check Permissions
            </a>
        </div>
    @endif

@endsection
