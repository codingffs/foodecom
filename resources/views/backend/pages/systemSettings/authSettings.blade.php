@extends('backend.layouts.master')

@section('title')
    {{ localize('Auth Settings') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@section('contents')
    <section class="tt-section pt-4">
        <div class="container">
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card tt-page-header">
                        <div class="card-body d-lg-flex align-items-center justify-content-lg-between">
                            <div class="tt-page-title">
                                <h2 class="h5 mb-lg-0">{{ localize('Auth Settings') }}</h2>
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

                        <!--login settings-->
                        <div class="card mb-4" id="section-1">
                            <div class="card-body">
                                <h5 class="mb-4">{{ localize('Login & Registration') }}</h5>

                                <div class="mb-3">
                                    <label for="registration_with"
                                        class="form-label">{{ localize('Customer Registration') }}</label>
                                    <input type="hidden" name="types[]" value="registration_with">
                                    <select id="registration_with" class="form-control text-uppercase select2"
                                        name="registration_with" data-toggle="select2">
                                        <option value="email"
                                            {{ getSetting('registration_with') == 'email' ? 'selected' : '' }}>
                                            {{ localize('Email Required') }}</option>
                                        <option value="email_and_phone"
                                            {{ getSetting('registration_with') == 'email_and_phone' ? 'selected' : '' }}>
                                            {{ localize('Email & Phone Both Required') }}</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="registration_verification_with"
                                        class="form-label">{{ localize('Registration Verification') }}</label>
                                    <input type="hidden" name="types[]" value="registration_verification_with">
                                    <select id="registration_verification_with" class="form-control text-uppercase select2"
                                        name="registration_verification_with" data-toggle="select2">
                                        <option value="disable"
                                            {{ getSetting('registration_verification_with') == 'disable' ? 'selected' : '' }}>
                                            {{ localize('Disable') }}</option>
                                        <option value="email"
                                            {{ getSetting('registration_verification_with') == 'email' ? 'selected' : '' }}>
                                            {{ localize('Email Verification') }}</option>
                                        <option value="phone"
                                            {{ getSetting('registration_verification_with') == 'phone' ? 'selected' : '' }}>
                                            {{ localize('OTP Verification') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!--login settings-->

                        <!--recaptcha settings-->
                        <div class="card mb-4" id="section-2">
                            <div class="card-body">
                                <h5 class="mb-4">{{ localize('Google Recaptcha V3') }}</h5>


                                <div class="mb-3">
                                    <label for="RECAPTCHAV3_SITEKEY"
                                        class="form-label">{{ localize('Recaptcha Site Key') }}</label>
                                    <input type="hidden" name="types[]" value="RECAPTCHAV3_SITEKEY">
                                    <input type="text" id="RECAPTCHAV3_SITEKEY" name="RECAPTCHAV3_SITEKEY"
                                        class="form-control" value="{{ env('RECAPTCHAV3_SITEKEY') }}">
                                </div>


                                <div class="mb-3">
                                    <label for="RECAPTCHAV3_SECRET"
                                        class="form-label">{{ localize('Recaptcha Secret Key') }}</label>
                                    <input type="hidden" name="types[]" value="RECAPTCHAV3_SECRET">
                                    <input type="text" id="RECAPTCHAV3_SECRET" name="RECAPTCHAV3_SECRET"
                                        class="form-control" value="{{ env('RECAPTCHAV3_SECRET') }}">
                                </div>


                                <div class="mb-3">
                                    <label for="enable_recaptcha"
                                        class="form-label">{{ localize('Enable Recaptcha') }}</label>
                                    <input type="hidden" name="types[]" value="enable_recaptcha">
                                    <select id="enable_recaptcha" class="form-control text-uppercase select2"
                                        name="enable_recaptcha" data-toggle="select2">
                                        <option value="1" {{ getSetting('enable_recaptcha') == 1 ? 'selected' : '' }}>
                                            {{ localize('Enable') }}</option>
                                        <option value="0" {{ getSetting('enable_recaptcha') == 0 ? 'selected' : '' }}>
                                            {{ localize('Disable') }}</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <!--recaptcha settings-->

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
