@extends('layouts.sidebar')
@section('title', 'Customer Support')


@section('contents')

 <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Customer Support</h4>
                        </div>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="email-left-box px-0 mb-3">
                                    <div class="p-0">
                                        <a href="email-compose.html" class="btn btn-primary btn-block">Compose</a>
                                    </div>
                                    <div class="mail-list mt-4">
                                        <a href="email-inbox.html" class="list-group-item active"><i
                                            class="fa fa-inbox font-18 align-middle mr-2"></i> Inbox</a>
                                    </div>
                                    
                                </div>
                                <div class="email-right-box ml-0 ml-sm-4 ml-sm-0">
                                    <div role="toolbar" class="toolbar ml-1 ml-sm-0">
                                        <div class="btn-group mb-1">
                                            <h3>MESSAGES</h3>
										</div>
                                        <div class="btn-group mb-1">
                                            
                                        </div>
                                        <div class="btn-group mb-1">
                                            
                                        </div>
                                    </div>
                                    <div class="email-list mt-3">
                                        <div class="message">
                                            <div>
                                                <div class="d-flex message-single">
                                                    <div class="pl-1 align-self-center">
														<div class="custom-control custom-checkbox">
															<input type="checkbox" class="custom-control-input" id="checkbox2">
															<label class="custom-control-label" for="checkbox2"></label>
														</div>
													</div>
                                                    <div class="ml-2">
                                                        <button class="border-0 bg-transparent align-middle p-0"><i
                                                                class="fa fa-star" aria-hidden="true"></i></button>
                                                    </div>
                                                </div>
                                                <a href="email-read.html" class="col-mail col-mail-2">
                                                    <div class="subject">Ingredia Nutrisha, A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture</div>
                                                    <div class="date">11:49 am</div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- panel -->
                                    <div class="row mt-4">
                                        <div class="col-12 pl-3">
                                            <nav>
												<ul class="pagination pagination-gutter pagination-primary pagination-sm no-bg">
													<li class="page-item page-indicator"><a class="page-link" href="javascript:void()"><i class="la la-angle-left"></i></a></li>
													<li class="page-item active"><a class="page-link" href="javascript:void()">1</a></li>
													<li class="page-item"><a class="page-link" href="javascript:void()">2</a></li>
													<li class="page-item"><a class="page-link" href="javascript:void()">3</a></li>
													<li class="page-item"><a class="page-link" href="javascript:void()">4</a></li>
													<li class="page-item page-indicator"><a class="page-link" href="javascript:void()"><i class="la la-angle-right"></i></a></li>
												</ul>
											</nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


@endsection


