@extends('backend.layouts.master')

@section('title')
    {{ localize('General Settings') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@section('contents')
    <section class="tt-section pt-4">
        <div class="container">
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card tt-page-header">
                        <div class="card-body d-lg-flex align-items-center justify-content-lg-between">
                            <div class="tt-page-title">
                                <h2 class="h5 mb-lg-0">{{ localize('General Settings') }}</h2>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <!--left sidebar-->
                <div class="col-xl-9 order-2 order-md-2 order-lg-2 order-xl-1">
                    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data"
                        class="pb-650">
                        @csrf

                        <!--general settings-->
                        <div class="card mb-4" id="section-1">
                            <div class="card-body">
                                <h5 class="mb-4">{{ localize('General Informations') }}</h5>

                                <div class="mb-3">
                                    <label for="system_title" class="form-label">{{ localize('System Title') }}</label>
                                    <input type="hidden" name="types[]" value="system_title">
                                    <input type="text" id="system_title" name="system_title" class="form-control"
                                        value="{{ getSetting('system_title') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="title_separator"
                                        class="form-label">{{ localize('Browser Tab Title Separator') }}</label>
                                    <input type="hidden" name="types[]" value="title_separator">
                                    <input type="text" id="title_separator" name="title_separator" class="form-control"
                                        value="{{ getSetting('title_separator') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="site_address" class="form-label">{{ localize('Address') }}</label>
                                    <input type="hidden" name="types[]" value="site_address">
                                    <input type="text" id="site_address" name="site_address" class="form-control"
                                        value="{{ getSetting('site_address') }}">
                                </div>
                            </div>
                        </div>
                        <!--general settings-->



                        <!--logo settings-->
                        <div class="card mb-4" id="section-3">
                            <div class="card-body">
                                <h5 class="mb-4">{{ localize('Dashboard Logo & Favicon') }}</h5>
                                <div class="mb-3">
                                    <label for="admin_panel_logo"
                                        class="form-label">{{ localize('Dashboard Logo') }}</label>
                                    <input type="hidden" name="types[]" value="admin_panel_logo">
                                    <div class="tt-image-drop rounded">
                                        <span class="fw-semibold">{{ localize('Choose Dashboard Logo') }}</span>
                                        <!-- choose media -->
                                        <div class="tt-product-thumb show-selected-files mt-3">
                                            <div class="avatar avatar-xl cursor-pointer choose-media"
                                                data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom"
                                                onclick="showMediaManager(this)" data-selection="single">
                                                <input type="hidden" name="admin_panel_logo"
                                                    value="{{ getSetting('admin_panel_logo') }}">
                                                <div class="no-avatar rounded-circle">
                                                    <span><i data-feather="plus"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- choose media -->
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="favicon" class="form-label">{{ localize('Favicon') }}</label>
                                    <input type="hidden" name="types[]" value="favicon">
                                    <div class="tt-image-drop rounded">
                                        <span class="fw-semibold">{{ localize('Choose Favicon') }}</span>
                                        <!-- choose media -->
                                        <div class="tt-product-thumb show-selected-files mt-3">
                                            <div class="avatar avatar-xl cursor-pointer choose-media"
                                                data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom"
                                                onclick="showMediaManager(this)" data-selection="single">
                                                <input type="hidden" name="favicon" value="{{ getSetting('favicon') }}">
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
                        <!--logo settings-->

                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">
                                <i data-feather="save" class="me-1"></i> {{ localize('Save Configuration') }}
                            </button>
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
