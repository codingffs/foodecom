@extends('backend.layouts.master')

@section('title')
    {{ localize('Add New Page') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@section('contents')
    <section class="tt-section pt-4">
        <div class="container">
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card tt-page-header">
                        <div class="card-body d-lg-flex align-items-center justify-content-lg-between">
                            <div class="tt-page-title">
                                <h2 class="h5 mb-lg-0">{{ localize('Add New Page') }}</h2>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-4 g-4">

                <!--left sidebar-->
                <div class="col-xl-9 order-2 order-md-2 order-lg-2 order-xl-1">
                    <form action="{{ route('admin.pages.store') }}" method="POST" class="pb-650">
                        @csrf
                        <!--basic information start-->
                        <div class="card mb-4" id="section-1">
                            <div class="card-body">
                                <h5 class="mb-4">{{ localize('Basic Information') }}</h5>

                                <div class="mb-4">
                                    <label for="title" class="form-label">{{ localize('Page Title') }}</label>
                                    <input class="form-control" type="text" id="title"
                                        placeholder="{{ localize('Type page title') }}" name="title" required>
                                </div>

                                <div class="mb-4">
                                    <label for="content" class="form-label">{{ localize('Page Description') }}</label>
                                    <textarea class="form-control editor" id="content" name="content"></textarea>
                                </div>
                            </div>
                        </div>
                        <!--basic information end-->

                        <!-- submit button -->
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-4">
                                    <button class="btn btn-primary" type="submit">
                                        <i data-feather="save" class="me-1"></i> {{ localize('Save Page') }}
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
