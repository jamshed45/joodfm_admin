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

                            <input type="hidden" name="site_general_setting-all" value="1" />

                            {{-- <div class="mb-3" bis_skin_checked="1">
                                <label class="form-label" for="site_title">Site Title</label>
                                <div bis_skin_checked="1">
                                    <input type="text" class="form-control" name="site_title" id="site_title" value="{{ old('site_title', $settings['site_title'] ?? '') }}" required>
                                </div>
                            </div> --}}

                            <div class="mb-3" bis_skin_checked="1">
                                <label class="form-label" for="email">Email</label>
                                <div bis_skin_checked="1">
                                    <input type="text" class="form-control" name="email" id="email" value="{{ old('email', $settings['email'] ?? '') }}" required>
                                </div>
                            </div>

                            <div class="mb-3" bis_skin_checked="1">
                                <label class="form-label" for="phone">Phone</label>
                                <div bis_skin_checked="1">
                                    <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone', $settings['phone'] ?? '') }}" required>
                                </div>
                            </div>

                            <div class="mb-3" bis_skin_checked="1">
                                <label class="form-label" for="whatsapp">Whatsapp No</label>
                                <div bis_skin_checked="1">
                                    <input type="text" class="form-control" name="whatsapp" id="whatsapp" value="{{ old('whatsapp', $settings['whatsapp'] ?? '') }}" required>

                                </div>
                            </div>

                            <div class="mb-3" bis_skin_checked="1">
                                <label class="form-label" for="whatsapp_link">Whatsapp Link</label>
                                <div bis_skin_checked="1">
                                    <input type="text" class="form-control" name="whatsapp_link" id="whatsapp_link" value="{{ old('whatsapp_link', $settings['whatsapp_link'] ?? '') }}" required>

                                </div>
                            </div>

                            {{-- <div class="mb-3" bis_skin_checked="1">
                                <label class="form-label" for="address">Address</label>
                                <div bis_skin_checked="1">
                                    <textarea type="text" class="form-control" name="address" id="address" required>{{ old('address', $settings['address'] ?? '') }}</textarea>

                                </div>
                            </div> --}}



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
