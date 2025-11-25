@extends('layouts.master')
@section('title') Site Setting @endsection
@section('css')

@endsection
@section('body') <body data-sidebar="dark"> @endsection
    @section('content')
    @component('components.breadcrumb')
    @slot('page_title') Site Setting @endslot
    @slot('subtitle') <a href="{{ route('settings.index') }}">Setting</a> @endslot
    @endcomponent


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Site Setting</h4>
                    <p class="card-title-desc"></p>
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('settings.update', ['setting' => $settingId ?? 1]) }}"  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                            <input type="hidden" name="site_general_setting" value="1" />

                            <div class="mb-3" bis_skin_checked="1">
                                <label class="form-label" for="site_title">Site Title</label>
                                <div bis_skin_checked="1">
                                    <input type="text" class="form-control" name="site_title" id="site_title" value="{{ old('site_title', $settings['site_title'] ?? '') }}" required>
                                </div>
                            </div>

                            <div class="mb-3" bis_skin_checked="1">
                                <label class="form-label" for="admin_email">Email</label>
                                <div bis_skin_checked="1">
                                    <input type="text" class="form-control" name="admin_email" id="admin_email" value="{{ old('admin_email', $settings['admin_email'] ?? '') }}" required>
                                </div>
                            </div>

                            <div class="mb-3" bis_skin_checked="1">
                                <label class="form-label" for="site_logo">⁠Logo ( Desktop )</label>
                                @if(isset($settings['site_logo_desktop']) && $settings['site_logo_desktop'] !='')
                                    <br>
                                    <img src="{{ asset( $settings['site_logo_desktop']) }}" width="150" alt="Site Desktop Logo" class="img-thumbnail mt-2" style="max-width: 150px;">
                                    <br><br>
                                @endif

                                <div bis_skin_checked="1">
                                    <input type="file" class="form-control" name="site_logo_desktop" id="site_logo_desktop" value="{{ old('site_logo', $settings['site_logo'] ?? '') }}" >
                                </div>
                            </div>

                            <div class="mb-3" bis_skin_checked="1">
                                <label class="form-label" for="site_logo">⁠Logo ( Mobile )</label>
                                @if(isset($settings['site_logo_mobile']) && $settings['site_logo_mobile'] !='')
                                    <br>
                                    <img src="{{ asset( $settings['site_logo_mobile']) }}"  width="150" alt="Site Mobile Logo" class="img-thumbnail mt-2" style="max-width: 150px;">
                                    <br><br>
                                @endif

                                <div bis_skin_checked="1">
                                    <input type="file" class="form-control" name="site_logo_mobile" id="site_logo_mobile" value="{{ old('site_logo_mobile', $settings['site_logo_mobile'] ?? '') }}" >
                                </div>
                            </div>




                            <div class="mb-3" bis_skin_checked="1">
                                <label class="form-label" for="site_logo">Favicon</label>
                                @if(isset($settings['site_favicon']) && $settings['site_favicon'] !='' )
                                    <br>
                                    <img src="{{ asset( $settings['site_favicon']) }}" alt="Site Logo" class="img-thumbnail mt-2" style="max-width: 75px;">
                                    <br><br>
                                @endif

                                <div bis_skin_checked="1">
                                    <input type="file" class="form-control" name="site_favicon" id="site_favicon" value="{{ old('site_favicon', $settings['site_favicon'] ?? '') }}" >
                                </div>
                            </div>

                            <div class="mb-3" bis_skin_checked="1">
                                <label  class="form-label" for="record_per_page">⁠Record Per Page</label>
                                <input type="number" name="record_per_page" id="record_per_page" class="form-control" value="{{ old('record_per_page', $settings['record_per_page'] ?? '') }}" required>
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



    <script src="{{URL::asset('assets/js/app.js')}}"></script>

    @endsection
