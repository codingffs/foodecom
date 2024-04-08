@extends('backend.layouts.master')


@section('title')
    {{ localize('Add New blog') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection


@section('contents')
    <section class="tt-section pt-4">
        <div class="container">
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card tt-page-header">
                        <div class="card-body d-lg-flex align-items-center justify-content-lg-between">
                            <div class="tt-page-title">
                                <h2 class="h5 mb-lg-0">{{ localize('Add Blog') }}</h2>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-4 g-4">

                <!--left sidebar-->
                <div class="col-xl-9 order-2 order-md-2 order-lg-2 order-xl-1">
                    <form action="{{ route('admin.blogs.store') }}" method="POST" class="pb-650">
                        @csrf
                        <!--basic information start-->
                        <div class="card mb-4" id="section-1">
                            <div class="card-body">
                                <h5 class="mb-4">{{ localize('Basic Information') }}</h5>

                                <div class="mb-4">
                                    <label for="category_id" class="form-label">{{ localize('Themes') }} <span
                                            class="text-danger">*</span> </label>
                                    <select class="form-control select2" name="theme_ids[]"
                                        data-placeholder="{{ localize('Select themes') }}" data-toggle="select2" multiple
                                        required>
                                        @foreach ($themes as $theme)
                                            <option value="{{ $theme->id }}" {{ in_array($theme->id, active_themes_array()) ? 'selected':'' }}>
                                                {{ $theme->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="mb-4">
                                    <label for="name" class="form-label">{{ localize('Blog Title') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="title" id="title"
                                        placeholder="{{ localize('Type blog title') }}" class="form-control" required>
                                </div>

                                <div class="mb-4">
                                    <label for="category_id" class="form-label">{{ localize('Category') }} <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control select2" name="category_id" data-toggle="select2" required>
                                        <option value="">{{ localize('Select a category') }}</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">{{ localize('Tags') }}</label>
                                    <select class="form-control select2" name="tag_ids[]" data-toggle="select2" multiple
                                        data-placeholder="{{ localize('Select tags..') }}">
                                        @foreach ($tags as $tag)
                                            <option value="{{ $tag->id }}">
                                                {{ $tag->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="mb-4">
                                    <label for="video_link" class="form-label">{{ localize('Youtube Video Link') }}</label>
                                    <input type="url" name="video_link" id="video_link"
                                        placeholder="https://www.youtube.com/watch?v=d_lz4kZ3YKI" class="form-control">
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">{{ localize('Short Description') }}</label>
                                    <textarea class="form-control" name="short_description" id="short_description" rows="4"
                                        placeholder="{{ localize('Type your short description') }}"></textarea>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">{{ localize('Description') }}</label>
                                    <textarea class="form-control editor" name="description" id="description" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                        <!--basic information end-->

                        <!-- image and gallery start-->
                        <div class="card mb-4" id="section-2">
                            <div class="card-body">
                                <h5 class="mb-4">{{ localize('Images') }}</h5>
                                <div class="mb-4">
                                    <label class="form-label">{{ localize('Thumbnail Image') }} (600x400)</label>
                                    <div class="tt-image-drop rounded">
                                        <span class="fw-semibold">{{ localize('Choose Blog Thumbnail') }}</span>
                                        <!-- choose media -->
                                        <div class="tt-product-thumb show-selected-files mt-3">
                                            <div class="avatar avatar-xl cursor-pointer choose-media"
                                                data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom"
                                                onclick="showMediaManager(this)" data-selection="single">
                                                <input type="hidden" name="image">
                                                <div class="no-avatar rounded-circle">
                                                    <span><i data-feather="plus"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- choose media -->
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">{{ localize('Blog Details Image') }}
                                        (1200x700)</label>
                                    <div class="tt-image-drop rounded">
                                        <span class="fw-semibold">{{ localize('Choose Blog Details Image') }}</span>
                                        <!-- choose media -->
                                        <div class="tt-product-thumb show-selected-files mt-3">
                                            <div class="avatar avatar-xl cursor-pointer choose-media"
                                                data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom"
                                                onclick="showMediaManager(this)" data-selection="single">
                                                <input type="hidden" name="banner">
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
                        <!-- image and gallery end-->

                        <!-- submit button -->
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-4">
                                    <button class="btn btn-primary" type="submit">
                                        <i data-feather="save" class="me-1"></i> {{ localize('Save Blog') }}
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
