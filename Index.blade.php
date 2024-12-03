@extends('layouts.admin')
@section('page-title')
    {{__('Lead')}}

@endsection
@section('title')
    {{__('Lead')}}           
@endsection
@section('breadcrumb')

    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Home')}}</a></li>
    
    <li class="breadcrumb-item">{{__('Lead')}}</li>
@endsection
@section('action-btn')
    <a href="{{ route('lead.grid') }}" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="tooltip" title="{{ __('Grid View') }}">
        <i class="ti ti-layout-grid text-white"></i>
    </a>
    
    @can('Create Lead')
        <a href="#" data-url="{{ route('lead.create',['lead',0]) }}" data-size="lg" data-ajax-popup="true" data-bs-toggle="tooltip" data-title="{{__('Create New Lead')}}" title="{{__('Create')}}" class="btn btn-sm btn-primary btn-icon m-1">
            <i class="ti ti-plus"></i>
        </a>
    @endcan
@endsection                  
@section('filter')
    <!-- Filter dropdown for lead selection -->   
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="filter_lead">{{ __('Select Lead') }}</label>
                <select id="filter_lead" class="form-control">
                    <option value="">{{ __('Select Lead') }}</option>
                    @foreach($leads as $lead)
                        <option value="{{ $lead->id }}">{{ $lead->name }}</option>
                    @endforeach
                </select>
            </div>              
        <div class="col-md-4">
            <div class="form-group">
                <label for="createdStartDateFilter">{{ __('Created Start Date') }}</label>
                <input type="date" class="form-control" id="createdStartDateFilter">
            </div>
        </div>    
        <div class="col-md-4">
            <div class="form-group">
                <label for="createdEndDateFilter">{{ __('Created End Date') }}</label>
                <input type="date" class="form-control" id="createdEndDateFilter">
            </div>              
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="statusFilter">{{ __('Status') }}</label>
                <select class="form-control" id="statusFilter">
                <option value="">{{ __('All') }}</option>
                    <option value="">{{ __('New') }}</option>
                    <option value="">{{ __('Assigned') }}</option>
                    <option value="">{{ __('Process') }}</option>
                    <option value="">{{ __('Pending') }}</option>
                    

                    <!-- Add more status options as needed --> 
                </select>                
            </div>
        </div>    
        <div class="col-md-6">
            <button id="filter_button" class="btn btn-primary">{{ __('Filter') }}</button>
        </div>
    </div>                
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="card">
                    <div class="card-body table-border-style">
                        <div class="table-responsive overflow_hidden">
                            <table id="datatable" class="table datatable align-items-center">
                                <thead class="thead-light">
                                    <tr>                       
                                        <th scope="col" class="sort" data-sort="Name">{{__('Name')}}</th> 
                                        <th scope="col" class="sort" data-sort="Account">{{__('Account')}}</th> 
                                        <th scope="col" class="sort" data-sort="Email">{{__('Email')}}</th>
                                        <th scope="col" class="
                                        sort" data-sort="Phone">{{__('Phone')}}</th>
                                        <th scope="col" class="sort" data-sort="Website">{{__('Website')}}</th>
                                        <th scope="col" class="sort" data-sort="Assigned User">{{__('Assigned User')}}</th>
                                        @if(Gate::check('Show Lead') || Gate::check('Edit Lead') || Gate::check('Delete Lead'))
                                            <th scope="col" class="text-end">{{__('Action')}}</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($leads as $lead)
                                    
                                        <tr data-lead-id="{{ $lead->id }}" data-account-id="{{ $lead->account_id }}">
                                            <td>
                                                <a href="#" data-size="md" data-url="{{ route('lead.show',$lead->id) }}" data-ajax-popup="true" data-title="{{__('Lead Details')}}" class="action-item text-primary">
                                                    {{ ucfirst($lead->name) }}
                                                </a>
                                            </td>
                                            <td>
                                    <span class="budget">{{ ucfirst(!empty($lead->accounts)?$lead->accounts->name:'--')}}</span>
                                </td>
                                            <td class="budget">
                                                {{ $lead->email }}
                                            </td>
                                            <td>
                                                <span class="budget"> {{ $lead->phone}} </span>
                                            </td>
                                            <td>
                                                <span class="budget">{{ $lead->website }}</span>
                                            </td>
                                            <td>
                                                <span class="col-sm-12"><span class="text-sm">{{ ucfirst(!empty($lead->assign_user)?$lead->assign_user->name:'-')}}</span></span>
                                            </td>
                                            @if(Gate::check('Show Lead') || Gate::check('Edit Lead') || Gate::check('Delete Lead'))
                                                <td class="text-end">
                                                    @can('Show Lead')
                                                        <div class="action-btn bg-warning ms-2">
                                                            <a href="#" data-size="md" data-url="{{ route('lead.show',$lead->id) }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Details')}}" data-title="{{__('Lead Details')}}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                                <i class="ti ti-eye"></i>
                                                            </a>
                                                        </div>
                                                    @endcan
                                                    @can('Edit Lead')
                                                        <div class="action-btn bg-info ms-2">
                                                            <a href="{{ route('lead.edit',$lead->id) }}" data-size="md" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white " data-bs-toggle="tooltip" data-title="{{__('Lead Edit')}}" title="{{__('Edit')}}"><i class="ti ti-edit"></i></a>
                                                        </div>
                                                    @endcan
                                                    @can('Delete Lead')
                                                        <div class="action-btn bg-danger ms-2">
                                                            {!! Form::open(['method' => 'DELETE', 'route' => ['lead.destroy', $lead->id]]) !!}
                                                                <a href="#!" class="mx-3 btn btn-sm align-items-center text-white show_confirm" data-bs-toggle="tooltip" title='Delete'>
                                                                    <i class="ti ti-trash"></i>
                                                                </a> 
                                                            {!! Form::close() !!}
                                                        </div>
                                                    @endcan
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>             
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script-page')
    <script>

        $(document).ready(function() {
            // Handle click event of the filter button
            $('#filter_button').click(function() {
                var selectedLeadId = $('#filter_lead').val();
                var startDate = $('#createdStartDateFilter').val();
                var endDate = $('#createdEndDateFilter').val();

                var status = $('#statusFilter').val();




                // Perform filtering based on the selected lead
                filterLeads(selectedLeadId, startDate, endDate, status);
            });
                
               
            // Function to filter leads based on the selected lead
            function filterLeads(leadId, startDate, endDate, status) {
                // Show all rows initially
                $('#datatable tbody tr').show();
                
                // If a lead is selected
                if (leadId) {
                    // Hide rows that do not match the selected lead
                    $('#datatable tbody tr').each(function() {
                        var rowLeadId = $(this).data('lead-id')
                        ;
                        if (rowLeadId != leadId) {

                            $(this).hide();
                        }
                    });        
                }


                // Filter by start date
                if (startDate) {
                    $('#datatable tbody tr').each(function() {
                        var rowStartDate = $(this).data('created-start-date');
                        if (rowStartDate < startDate) {
                            $(this).hide();
                        }
                    });
                }
                // Filter by end date
                if (endDate) {
                    $('#datatable tbody tr').each(function() {
                        var rowEndDate = $(this).data('created-end-date');
                        if (rowEndDate > endDate) {
                            $(this).hide();
                        }
                    });    


                }          
                // Filter by status
                if (status) {
                    $('#datatable tbody tr').each(function() {
                        var rowStatus = $(this).data('status');
                        if (rowStatus != status) {
                            $(this).hide();
                        }
                    });
                }         
            }
        });            
         
    </script>
@endpush      
                  

               






