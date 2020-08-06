@extends('layouts.backend')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-alt bg-light px-6 push font-w300">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>
    <!-- Page Content -->
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-6 col-md-3 col-xl-2 col-lg-3">
                <a class="block block-rounded block-bordered block-link-shadow text-center" href="javascript:void(0)"
                   data-toggle="click-ripple">
                    <div class="block-content text-muted">
                        <p class="my-2">
                            <i class="text-primary fa fa-archive fa-2x text-muted"></i>
                        </p>
                        <p class="font-w300">Products</p>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3 col-xl-2 col-lg-3">
                <a class="block block-rounded block-bordered block-link-shadow text-center" href="javascript:void(0)"
                   data-toggle="click-ripple">
                    <div class="block-content text-muted">
                        <p class="my-2">
                            <i class="text-primary fa fa-terminal fa-2x text-muted"></i>
                        </p>
                        <p class="font-w300">Change requests</p>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3 col-xl-2 col-lg-3">
                <a class="block block-rounded block-bordered block-link-shadow text-center" href="javascript:void(0)"
                   data-toggle="click-ripple">
                    <div class="block-content text-muted">
                        <p class="my-2">
                            <i class="text-primary fa fa-thumbs-up fa-2x text-muted"></i>
                        </p>
                        <p class="font-w300">Approved requests</p>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3 col-xl-2 col-lg-3">
                <a class="block block-rounded block-bordered block-link-shadow text-center" href="javascript:void(0)"
                   data-toggle="click-ripple">
                    <div class="block-content text-muted">
                        <p class="my-2">
                            <i class="text-primary fa fa-user-tie fa-2x text-muted"></i>
                        </p>
                        <p class="font-w300">Customers</p>
                    </div>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 invisible" data-toggle="appear">
                <div class="block block-bordered">
                    <div class="block-content">
                        <div class="px-sm-3 pt-sm-3 clearfix" style="min-height: 213px;">
                            <i class="fa fa-chart-line fa-2x text-gray-light float-right"></i>
                            <p class="display-4 text-primary font-w300 mb-2">
                                15 <span class="font-size-h5 font-w300 text-muted">contracten</span>
                            </p>
                            <div class="pt-3">
                                <p class="text-muted font-w300 text-muted">
                                    You've approved <strong class="text-primary">3</strong> changes and deployed <strong
                                        class="text-primary">7</strong> changes today!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Wallet -->

            <!-- Various Stats -->
            <div class="col-lg-6" data-toggle="appear">
                <!-- Weekly Orders -->
                <div class="block block-bordered mb-lg-2">
                    <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                        <div class="ml-3">
                            <p class="font-size-h2 font-w300 text-primary mb-0">
                                160
                            </p>
                            <a class="link-fx font-size-sm font-w300 text-muted text-uppercase mb-0"
                               href="javascript:void(0)">
                                approved requests
                            </a>
                        </div>
                    </div>
                </div>
                <!-- END Weekly Orders -->

                <!-- Weekly Visits -->
                <div class="block block-bordered mb-lg-2">
                    <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                        <div class="ml-3">
                            <p class="font-size-h2 font-w300 text-primary mb-0">
                                3.670
                            </p>
                            <a class="link-fx font-size-sm font-w300 text-muted text-uppercase mb-0"
                               href="javascript:void(0)">
                                bugs fixed
                            </a>
                        </div>
                    </div>
                </div>
                <!-- END Weekly Visits -->
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-12 col-xl-12 col-lg-12">
                <div class="block block-rounded invisible" data-toggle="appear">
                    <div class="block-header block-header-default">
                        <h3 class="block-title font-w300">Latest requests</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option"
                                    data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                            <button type="button" class="btn-block-option">
                                <i class="si si-wrench"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="table-responsive">
                            <table class="table table-striped table-borderless table-vcenter mb-0 font-w300">
                                <thead class="thead-light font-w300">
                                <tr>
                                    <th style="width: 100px;">ID</th>
                                    <th>Lorum ipsum</th>
                                    <th>Lorum ipsum</th>
                                    <th>Lorum ipsum</th>
                                    <th>Lorum ipsum</th>
                                    <th>Lorum ipsum</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <a class="font-w600" href="javascript:void(0)">1254</a>
                                    </td>
                                    <td>
                                        <strong>Roy</strong>
                                    </td>
                                    <td>
                                        <strong>Obrien</strong>
                                    </td>
                                    <td>
                                        <span class="text-muted font-italic">today</span>
                                    </td>
                                    <td>
                                        <span class="text-muted font-italic">today</span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-light" href="javascript:void(0)">
                                            <i class="fa fa-wrench text-danger mr-1"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a class="font-w600" href="javascript:void(0)">1254</a>
                                    </td>
                                    <td>
                                        <strong>Roy</strong>
                                    </td>
                                    <td>
                                        <strong>Obrien</strong>
                                    </td>
                                    <td>
                                        <span class="text-muted font-italic">today</span>
                                    </td>
                                    <td>
                                        <span class="text-muted font-italic">today</span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-light" href="javascript:void(0)">
                                            <i class="fa fa-wrench text-danger mr-1"></i>
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Page Content -->
@endsection
@section('js_after')

@endsection
