@extends('backend.layouts.master')

@section('title')
    {{ localize('Website Homepage Configuration') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@section('contents')
    <section class="tt-section pt-4">
        <div class="container">
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card tt-page-header">
                        <div class="card-body d-lg-flex align-items-center justify-content-lg-between">
                            <div class="tt-page-title">
                                <h2 class="h5 mb-lg-0">{{ localize('Update Slider') }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-4 g-4">
                <!--left sidebar-->
                <div class="col-xl-9 order-2 order-md-2 order-lg-2 order-xl-1">

                    <form action="{{ route('admin.appearance.homepage.updateHero') }}" method="POST"
                        enctype="multipart/form-data" id="section-1">
                        @csrf
                        <input type="hidden" name="id" value="{{ $id }}">
                        @php
                            $slider = null;
                            if (!empty($sliders)) {
                                foreach ($sliders as $key => $thisSlider) {
                                    if ($thisSlider->id == $id) {
                                        $slider = $thisSlider;
                                    }
                                }
                            }
                        @endphp
                        <!--slider info start-->
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="mb-4">
                                    <label for="sub_title" class="form-label">{{ localize('Sub Title') }}</label>
                                    <input type="text" name="sub_title" id="sub_title"
                                        placeholder="{{ localize('Type sub title') }}" class="form-control"
                                        value="{{ $slider->sub_title }}" required>
                                </div>


                                <div class="mb-4">
                                    <label for="title" class="form-label">{{ localize('Title') }}</label>
                                    <input type="text" name="title" id="title"
                                        placeholder="{{ localize('Type title') }}" class="form-control"
                                        value="{{ $slider->title }}" required>
                                </div>

                                <div class="mb-4">
                                    <label for="text" class="form-label">{{ localize('Text') }}</label>
                                    <input type="text" name="text" id="text"
                                        placeholder="{{ localize('Type text') }}" class="form-control"
                                        value="{{ $slider->text }}" required>
                                </div>

                                <div class="mb-4">
                                    <label for="link" class="form-label">{{ localize('Link') }}</label>
                                    <input type="url" name="link" id="link"
                                        placeholder="{{ env('APP_URL') }}/example" class="form-control"
                                        value="{{ $slider->link }}">
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">{{ localize('Slider Image') }}</label>
                                    <div class="tt-image-drop rounded">
                                        <span class="fw-semibold">{{ localize('Choose Slider Image') }}</span>
                                        <!-- choose media -->
                                        <div class="tt-product-thumb show-selected-files mt-3">
                                            <div class="avatar avatar-xl cursor-pointer choose-media"
                                                data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom"
                                                onclick="showMediaManager(this)" data-selection="single">
                                                <input type="hidden" name="image" value="{{ $slider->image }}">
                                                <div class="no-avatar rounded-circle">
                                                    <span><i data-feather="plus"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- choose media -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--slider info end-->


                        <div class="row">
                            <div class="col-12">
                                <div class="mb-4">
                                    <button class="btn btn-primary" type="submit">
                                        <i data-feather="save" class="me-1"></i> {{ localize('Save Changes') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
@endsection

@section('scripts')
    <script>
        "use strict";

        // runs when the document is ready --> for media files
        $(document).ready(function() {
            getChosenFilesCount();
            showSelectedFilePreviewOnLoad();
        });
    </script>
@endsection
