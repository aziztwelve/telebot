@extends('backend.layouts.app')

@section('content')

<div class="container">
    @if (Session::has('status'))
        <div class="alert alert-info">
            <span>{{ Session::get('status') }}</span>
        </div>
    @endif
    <form action="{{ route('admin.setting.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="">Url callback for Telegram</label>
            <div class="input-group">
                <div class="input-group-btn">

                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Actior <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="" onclick="document.getElementById('url_callback_bot').value = '{{ url('') }}'"> Insert url</a></li>
                        <li><a href="" onclick="event.preventDefault(); document.getElementById('setwebhook').submit();"> Send url</a></li>
                        <li><a href="" onclick="event.preventDefault(); document.getElementById('getwebhookinfo').submit();" > Get info</a></li>
                    </ul>
                </div>
                <input type="url" class="form-control" id="url_callback_bot" name="url_callback_bot" value="{{ $url_callback_bot ?? '' }}">

            </div>
        </div>
        <button class="btn btn-primary" type="submit">Save</button>
    </form>

    <form id="setwebhook" action="{{ route('admin.setting.setwebhook') }}" method="post" style="display: none">
        @csrf
        <input type="hidden" name="url" value="{{ $url_callback_bot ?? '' }}">
    </form>
    <form id="getwebhookinfo" action="{{ route('admin.setting.getwebhookinfo') }}" method="post" style="display: none">
        @csrf
    </form>
</div>
@endsection

