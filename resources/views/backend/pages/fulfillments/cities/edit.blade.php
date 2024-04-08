@extends('backend.layouts.master')

@section('title')
    {{ localize('Update City') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection


@section('contents')
    <section class="tt-section pt-4">
        <div class="container">
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card tt-page-header">
                        <div class="card-body d-lg-flex align-items-center justify-content-lg-between">
                            <div class="tt-page-title">
                                <h2 class="h5 mb-lg-0">{{ localize('Update City') }} </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-4 g-4">

                <!--left sidebar-->
                <div class="col-xl-9 order-2 order-md-2 order-lg-2 order-xl-1">
                    <form action="{{ route('admin.cities.update') }}" method="POST" class="pb-650">
                        @csrf
                        <input type="hidden" name="id" value="{{ $city->id }}">
                        <!--basic information start-->
                        <div class="card mb-4" id="section-1">
                            <div class="card-body">
                                <h5 class="mb-4">{{ localize('Basic Information') }}</h5>

                                <div class="mb-4">
                                    <label for="name" class="form-label">{{ localize('City Name') }}</label>
                                    <input class="form-control" type="text" id="name"
                                        placeholder="{{ localize('Type city name') }}" name="name" required
                                        value="{{ $city->name }}">
                                </div>

                                <div class="mb-4">
                                    <label for="state_id" class="form-label">{{ localize('State') }}</label>
                                    <select class="form-control select2" name="state_id" class="w-100"
                                        data-toggle="select2" required>
                                        <option value="">{{ localize('Select an State') }}</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}"
                                                {{ $city->state->id == $state->id ? 'selected' : '' }}>
                                                {{ $state->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                            </div>
                        </div>
                        <!--basic information end-->

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
