@extends('layouts.master')
@section('title')
    Social Media Setting
@endsection
@section('css')
@endsection
@section('body')

    <body data-sidebar="dark">
    @endsection
    @section('content')
        @component('components.breadcrumb')
            @slot('page_title')
                Social Media Setting
            @endslot
            @slot('subtitle')
                <a href="{{ route('settings.index') }}">Setting</a>
            @endslot
        @endcomponent


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Social Media Setting</h4>
                        <p class="card-title-desc"></p>
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('settings.update', ['setting' => $settingId ?? 1]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="social_media_setting" value="1" />

                            {{-- <div class="mb-3" bis_skin_checked="1">
                                <label class="form-label" for="facebook_url">Facebook</label>
                                <div bis_skin_checked="1">
                                    <input type="url" class="form-control" name="facebook_url" id="facebook_url"
                                        value="{{ old('facebook_url', $settings['facebook_url'] ?? '') }}">
                                </div>
                            </div> --}}

                            <div class="mb-3" bis_skin_checked="1">
                                <label class="form-label" for="x_url">Twitter/X</label>
                                <div bis_skin_checked="1">
                                    <input type="url" class="form-control" name="x_url" id="x_url"
                                        value="{{ old('x_url', $settings['x_url'] ?? '') }}">
                                </div>
                            </div>

                            <div class="mb-3" bis_skin_checked="1">
                                <label class="form-label" for="linkedin_url">Linkedin</label>
                                <div bis_skin_checked="1">
                                    <input type="url" class="form-control" name="linkedin_url" id="linkedin_url"
                                        value="{{ old('linkedin_url', $settings['linkedin_url'] ?? '') }}">
                                </div>
                            </div>

                            {{-- <div class="mb-3" bis_skin_checked="1">
                                <label class="form-label" for="linkedin_url">Youtube</label>
                                <div bis_skin_checked="1">
                                    <input type="url" class="form-control" name="youtube_url" id="youtube_url"
                                        value="{{ old('youtube_url', $settings['youtube_url'] ?? '') }}">
                                </div>
                            </div> --}}

                            <div class="mb-3" bis_skin_checked="1">
                                <label class="form-label" for="instagram_url">Instagram</label>
                                <div bis_skin_checked="1">
                                    <input type="url" class="form-control" name="instagram_url" id="instagram_url"
                                        value="{{ old('instagram_url', $settings['instagram_url'] ?? '') }}">
                                </div>
                            </div>

                            <div class="mb-3" bis_skin_checked="1">
                                <label class="form-label" for="instagram_url">Whatsapp</label>
                                <div bis_skin_checked="1">
                                    <input type="url" class="form-control" name="whatsapp_url" id="whatsapp_url"
                                        value="{{ old('whatsapp_url', $settings['whatsapp_url'] ?? '') }}">
                                </div>
                            </div>

                            <div class="col-12" bis_skin_checked="1">
                                <button class="btn btn-primary" type="submit">Save Setting</button>
                            </div>


                        </form>




                    </div>
                </div>

            </div> <!-- end col -->
        </div> <!-- end row -->
    @endsection
    @section('scripts')
        <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    @endsection
