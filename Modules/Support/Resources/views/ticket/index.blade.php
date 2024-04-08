@extends('support::layouts.master')

@section('title')
    {{ localize('Tickets') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@section('contents')
    <section class="tt-section pt-4">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12">
                    <div class="tt-page-header">
                        <div class="d-lg-flex align-items-center justify-content-lg-between">
                            <div class="tt-page-title mb-3 mb-lg-0">
                                <h1 class="h4 mb-lg-1">{{ localize('Tickets') }}</h1>
                                <ol class="breadcrumb breadcrumb-angle text-muted">
                                    <li class="breadcrumb-item"><a
                                            href="#">{{ localize('Dashboard') }}</a>
                                    </li>
                                    <li class="breadcrumb-item">{{ localize('Tickets') }}</li>
                                </ol>
                            </div>
                            <div class="tt-action">
                              @if(auth()->user()->user_type == 'customer')
                                <a href="{{ route('support.ticket.create') }}" class="btn btn-sm btn-primary"><i
                                        data-feather="plus"></i> {{ localize('Create Ticket') }}</a>
                              @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-between mb-5">
                <div class="{{auth()->user()->user_type == 'customer' ? 'col-xl-12 col-md-12' : 'col-xl-8 col-md-8'}}">
                  <div class="card">
                    <div class="card-body p-0">
                      <div class="list-group list-group-flush">
                        @foreach ($tickets as $ticket)
                            
                        <a href="{{route('support.reply.index', $ticket->id)}}" target="_blank" class="list-group-item list-group-item-action py-3">
                          <div class="d-flex">
                            <div class="avatar avatar-md me-2 flex-shrink-0">
                                <img class="rounded-circle" src="{{ uploadedAsset($ticket->createdBy->avatar) }}" alt="avatar" onerror="this.onerror=null;this.src='{{ staticAsset('/backend/assets/img/avatar/1.jpg') }}';">
                            </div>
                            <div class="flex-1">
                              <h6 class="mb-1">{{$ticket->title}}  #{{$ticket->id}}
                                <span
                                  class="fs-ms fw-medium rounded-pill badge shadow-sm" style="background-color:{{$ticket->priority->color}}">{{$ticket->priority->name}}</span></h6>
                              <ul class="list-inline mb-0">
                                <li class="list-inline-item">
                                  <span class="text-muted"><i data-feather="folder" class="icon-14 me-1"></i>{{localize('Category')}}:{{$ticket->category->name}}
                                    </span>
                                </li>
                                <li class="list-inline-item">
                                  <span class="text-muted"><i data-feather="user" class="icon-14 me-1"></i>{{localize('Assigned')}}: {{$ticket->category->staff->name}}</span>
                                </li>
                                <li class="list-inline-item">
                                  <span class="text-muted"><i data-feather="calendar" class="icon-14 me-1"></i>{{localize('Date')}}: {{date('d-M-y h:i:s A', strtotime($ticket->created_at))}}</span>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </a>
                        @endforeach
                        
        
                      </div>
                    </div>
                    <div class="card-footer">
                      <div class="d-flex align-items-center justify-content-between">
                        <span>{{ $tickets->firstItem() ?? 0 }}-{{ $tickets->lastItem() ?? 0 }}
                            {{ localize('of') }}
                            {{ $tickets->total() }} {{ localize('results') }}</span>
                            <nav>
                                {{ $tickets->appends(request()->input())->onEachSide(0)->links() }}
                            </nav>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


        </div>
    </section>
@endsection


