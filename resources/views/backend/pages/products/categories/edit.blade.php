@extends('backend.layouts.master')

@section('title')
    {{ localize('Update Category') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection


@section('contents')
    <section class="tt-section pt-4">
        <div class="container">
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card tt-page-header">
                        <div class="card-body">
                            <div class="row g-3 align-items-center">
                                <div class="col-auto flex-grow-1">
                                    <div class="tt-page-title">
                                        <h2 class="h5 mb-0">{{ localize('Update Category') }}
                                            </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-4 g-4">

                <!--left sidebar-->
                <div class="col-xl-9 order-2 order-md-2 order-lg-2 order-xl-1">
                    <form action="{{ route('admin.categories.update') }}" method="POST" class="pb-650">
                        @csrf
                        <input type="hidden" name="id" value="{{ $category->id }}">
                        <input type="hidden" name="lang_key" value="{{ $lang_key }}">
                        <!--basic information start-->
                        <div class="card mb-4" id="section-1">
                            <div class="card-body">
                                <h5 class="mb-4">{{ localize('Basic Information') }}</h5>


                                <div class="mb-4 hidden">
                                    @php
                                        $checkThemes = $category->themes()->pluck('theme_id');
                                    @endphp
                                    <label class="form-label">{{ localize('Themes') }} <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-control select2" name="theme_ids[]"
                                        data-placeholder="{{ localize('Select themes') }}" data-toggle="select2" multiple
                                        required>
                                        @foreach ($themes as $theme)
                                            <option value="{{ $theme->id }}"
                                                {{ $checkThemes->contains($theme->id) ? 'selected' : '' }}>
                                                {{ $theme->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="mb-4">
                                    <label for="name" class="form-label">{{ localize('Category Name') }}</label>
                                    <input class="form-control" type="text" id="name"
                                        placeholder="{{ localize('Type your category name') }}" name="name" required
                                        value="{{ $category->collectLocalization('name') }}">
                                </div>


                                <div class="mb-4">
                                    <label for="description"
                                        class="form-label">{{ localize('Category Description') }}</label>
                                    <input class="form-control" type="text" id="description"
                                        placeholder="{{ localize('Type your category description') }}" name="description"
                                        value="{{ $category->collectLocalization('description') }}">
                                </div>



                                @if (env('DEFAULT_LANGUAGE') == $lang_key)
                                    <div class="mb-4">
                                        <label for="parent_id" class="form-label">{{ localize('Base Category') }}</label>
                                        <select class="form-control select2" name="parent_id" class="w-100"
                                            data-toggle="select2">
                                            <option value="0" {{ $category->parent_id == 0 ? 'selected' : '' }}>᎗
                                            </option>
                                            @foreach ($categories as $acategory)
                                                <option value="{{ $acategory->id }}"
                                                    {{ $acategory->id == $category->parent_id ? 'selected' : '' }}>
                                                    {{ $acategory->name }}
                                                </option>
                                                @foreach ($acategory->childrenCategories()->orderBy('sorting_order_level', 'desc')->where('id', '!=', $category->id)->get() as $childCategory)
                                                    @include(
                                                        'backend.pages.products.categories.subCategory',
                                                        [
                                                            'subCategory' => $childCategory,
                                                        ]
                                                    )
                                                @endforeach
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-4">

                                        @php
                                            $categoryBrands = $category->brands()->pluck('brand_id');
                                        @endphp

                                        <label class="form-label">{{ localize('Brands') }}</label>
                                        <select class="form-control select2" name="brand_ids[]" class="w-100"
                                            data-toggle="select2" data-placeholder="{{ localize('Select brands') }}"
                                            multiple>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}"
                                                    {{ $categoryBrands->contains($brand->id) ? 'selected' : '' }}>
                                                    {{ $brand->collectLocalization('name') }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-4">
                                        <label for="sorting_order_level"
                                            class="form-label">{{ localize('Sorting Priority Number') }}</label>
                                        <input class="form-control" type="number" id="sorting_order_level"
                                            placeholder="{{ localize('Type sorting priority number') }}"
                                            name="sorting_order_level" value="{{ $category->sorting_order_level }}">
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!--basic information end-->

                        <!--product image and gallery start-->
                        <div class="card mb-4" id="section-2">
                            <div class="card-body">
                                <h5 class="mb-4">{{ localize('Images') }}</h5>
                                <div class="mb-4">
                                    <label class="form-label">{{ localize('Thumbnail') }}</label>
                                    <div class="tt-image-drop rounded">
                                        <span class="fw-semibold">{{ localize('Choose Category Thumbnail') }}</span>
                                        <!-- choose media -->
                                        <div class="tt-product-thumb show-selected-files mt-3">
                                            <div class="avatar avatar-xl cursor-pointer choose-media"
                                                data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom"
                                                onclick="showMediaManager(this)" data-selection="single">
                                                <input type="hidden" name="image"
                                                    value="{{ $category->collectLocalization('thumbnail_image', $lang_key) }}">
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
