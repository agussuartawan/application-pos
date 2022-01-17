@extends('layouts.main') 
@section('title', 'Log Aktivitas')
@section('content')
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
                        <h3>{{ __('List Aktivitas')}}</h3>
                    </div>
                    <div class="card-body">
                        <table id="activity_log_table" class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th>{{ __('Aktivitas')}}</th>
                                    <th>{{ __('Waktu')}}</th>
                                    <th>{{ __('Aksi')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($activityLog as $log)
                                    <tr>
                                        <td>{!! $log->description !!}</td>
                                        <td>{{ $log->created_at->diffForHumans() }}</td>
                                        <td>Lihat</td>
                                    </tr>
                                @endforeach
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
    <script src="{{ asset('js/masters/product.js') }}"></script>
    @endpush
@endsection
