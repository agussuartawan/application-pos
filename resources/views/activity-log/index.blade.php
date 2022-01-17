@extends('layouts.main') 
@section('title', 'Log Aktivitas')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    @endpush
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-users bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Log Aktivitas')}}</h5>
                            <span>{{ __('Melihat log aktivitas')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Log Aktivitas')}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card p-3">
                    <div class="card-header">
                        <h3>{{ __('Log Aktivitas')}}</h3>
                    </div>
                    <div class="card-body">
                        <table id="activity_log_table" class="table table-bordered">
                            <thead class="text-center">
                                <tr>
                                    <th>{{ __('Aktivitas')}}</th>
                                    <th width="20%">{{ __('Waktu')}}</th>
                                    <th width="10%">{{ __('Aksi')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- push external js -->
    @push('script')
    <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <!--server side users table script-->
    <script src="{{ asset('js/activity-log.js') }}"></script>
    @endpush
@endsection
