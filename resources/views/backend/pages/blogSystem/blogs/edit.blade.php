@extends('backend.layouts.master')


@section('title')
    {{ localize('Update Blog') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
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
                                        <h2 class="h5 mb-0">{{ localize('Update Blog') }} 
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
                    <form action="{{ route('admin.blogs.update') }}" method="POST" class="pb-650">
                        @csrf
                        <input type="hidden" name="id" value="{{ $blog->id }}">
                        <input type="hidden" name="lang_key" value="{{ $lang_key }}">
                        <!--basic information start-->
                        <div class="card mb-4" id="section-1">
                            <div class="card-body">
                                <h5 class="mb-4">{{ localize('Basic Information') }}</h5>


                                <div class="mb-4">
                                    <label for="category_id" class="form-label">{{ localize('Themes') }} <span
                                            class="text-danger">*</span> </label>

                                    @php
                                        $blogThemes = $blog->themes()->pluck('theme_id');
                                    @endphp

                                    <select class="form-control select2" name="theme_ids[]"
                                        data-placeholder="{{ localize('Select themes') }}" data-toggle="select2" multiple
                                        required>
                                        @foreach ($themes as $theme)
                                            <option value="{{ $theme->id }}"
                                                {{ $blogThemes->contains($theme->id) ? 'selected' : '' }}>
                                                {{ $theme->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="mb-4">
                                    <label for="name" class="form-label">{{ localize('Blog Title') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="title" id="title"
                                        placeholder="{{ localize('Type blog title') }}" class="form-control" required
                                        value="{{ $blog->collectLocalization('title', $lang_key) }}">
                                </div>


                                @if (env('DEFAULT_LANGUAGE') == $lang_key)
                                    <div class="mb-4">
                                        <label for="slug" class="form-label">{{ localize('Blog Slug') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="slug" id="slug"
                                            placeholder="{{ localize('Type blog slug') }}" class="form-control" required
                                            value="{{ $blog->slug }}">
                                    </div>

                                    <div class="mb-4">
                                        <label for="category_id" class="form-label">{{ localize('Category') }} <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control select2" name="category_id" data-toggle="select2"
                                            required>
                                            <option value="">{{ localize('Select a category') }}</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $blog->blog_category_id == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">{{ localize('Tags') }}</label>

                                        @php
                                            $blogTags = $blog->tags()->pluck('tag_id');
                                        @endphp

                                        <select class="form-control select2" name="tag_ids[]" data-toggle="select2" multiple
                                            data-placeholder="{{ localize('Select tags..') }}">
                                            @foreach ($tags as $tag)
                                                <option value="{{ $tag->id }}"
                                                    {{ $blogTags->contains($tag->id) ? 'selected' : '' }}>
                                                    {{ $tag->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="mb-4">
                                        <label for="video_link"
                                            class="form-label">{{ localize('Youtube Video Link') }}</label>
                                        <input type="url" name="video_link" id="video_link"
                                            placeholder="https://www.youtube.com/watch?v=d_lz4kZ3YKI" class="form-control"
                                            value="{{ $blog->video_link }}">
                                    </div>
                                @endif

                                <div class="mb-4">
                                    <label class="form-label">{{ localize('Short Description') }}</label>
                                    <textarea class="form-control" name="short_description" id="short_description" rows="4"
                                        placeholder="{{ localize('Type your short description') }}">{{ $blog->collectLocalization('short_description', $lang_key) }}</textarea>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">{{ localize('Description') }}</label>
                                    <textarea class="form-control editor" name="description" id="description" rows="4">{{ $blog->collectLocalization('description', $lang_key) }}</textarea>
                                </div>
                            </div>
                        </div>
                        <!--basic information end-->

                        @if (env('DEFAULT_LANGUAGE') == $lang_key)
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
                                                    <input type="hidden" name="image"
                                                        value="{{ $blog->thumbnail_image }}">
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
                                                    <input type="hidden" name="banner" value="{{ $blog->banner }}">
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
                        @endif
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
