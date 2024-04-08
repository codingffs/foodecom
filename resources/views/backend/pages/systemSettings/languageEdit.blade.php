@extends('backend.layouts.master')

@section('title')
    {{ localize('Update Language') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@section('contents')
    <section class="tt-section pt-4">
        <div class="container">
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card tt-page-header">
                        <div class="card-body d-lg-flex align-items-center justify-content-lg-between">
                            <div class="tt-page-title">
                                <h2 class="h5 mb-lg-0">{{ localize('Update Language') }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-4 g-4">

                <!--left sidebar-->
                <div class="col-xl-9 order-2 order-md-2 order-lg-2 order-xl-1">
                    <form action="{{ route('admin.languages.update') }}" method="POST" id="section-1" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $language->id }}">
                        <!--language info start-->
                        <div class="card mb-4" id="section-2">
                            <div class="card-body">
                                <h5 class="mb-4">{{ localize('Basic Information') }}</h5>

                                <div class="mb-4">
                                    <label for="name" class="form-label">{{ localize('Language Name') }}</label>
                                    <input type="text" name="name" id="name"
                                        placeholder="{{ localize('Type language name') }}" class="form-control" required
                                        value="{{ $language->name }}">
                                </div>


                                <div class="mb-4">
                                    <label for="code" class="form-label">{{ localize('ISO 639-1 Code') }}</label>
                                    <input type="text" name="code" value="{{ $language->code }}" id="code"
                                        placeholder="{{ localize('en/bn') }}" class="form-control" required
                                        {{ $language->id == 1 ? 'disabled' : '' }}>
                                </div>

                                <div class="mb-4">
                                    <label for="code" class="form-label">{{ localize('Upload Font (optional)') }}</label>
                                    <input type="file" name="font" id="font" class="form-control" accept=".ttf">
                                </div>

                                @error('font')
                                    {{$message}}    
                                @enderror


                                <div class="mb-4">
                                    <label for="symbol" class="form-label">{{ localize('Flag') }}</label>
                                    <select id="flag" class="form-control country-flag-select" name="flag"
                                        data-toggle="select2">
                                        @foreach (\File::files(base_path('public/backend/assets/img/flags')) as $path)
                                            <option value="{{ pathinfo($path)['filename'] }}" <?php if ($language->flag == pathinfo($path)['filename']) {
                                                echo 'selected';
                                            } ?>
                                                data-flag="{{ staticAsset('backend/assets/img/flags/' . pathinfo($path)['filename'] . '.png') }}">
                                                {{ strtoupper(pathinfo($path)['filename']) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label for="symbol" class="form-label">{{ localize('RTL') }}</label>
                                    <select id="is_rtl" class="form-control select2" name="is_rtl"
                                        data-toggle="select2">
                                        <option value="0" @if ($language->is_rtl == 0) selected @endif>
                                            {{ localize('Disable') }}
                                        </option>
                                        <option value="1" @if ($language->is_rtl == 1) selected @endif>
                                            {{ localize('Active') }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!--language info end-->

                        <!-- submit button -->
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-4">
                                    <button class="btn btn-primary" type="submit">
                                        <i data-feather="save" class="me-1"></i> {{ localize('Save Changes') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- submit button end -->

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
