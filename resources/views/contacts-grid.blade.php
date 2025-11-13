@extends('layouts.master')
@section('title') @lang('translation.User_Grid') @endsection

    @section('content')
    @component('components.breadcrumb')
    @slot('li_1') Contacts @endslot
    @slot('title') User Grid @endslot
    @endcomponent

            <div class="row">
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a class="text-muted dropdown-toggle font-size-16" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                    <i class="bx bx-dots-horizontal-rounded"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Edit</a>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Remove</a>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div>
                                    <img src="{{ URL::asset('assets/images/users/avatar-2.jpg') }}" alt="" class="avatar-md rounded-circle img-thumbnail">
                                </div>
                                <div class="flex-1 ms-3">
                                    <h5 class="font-size-16 mb-1"><a href="#" class="text-dark">Phyllis Gatlin</a></h5>
                                    <p class="text-muted mb-0">Full Stack Developer</p>
                                </div>
                            </div>
                            <p class="mt-3 text-muted">Curabitur non magna lobortis est tempus gravida ornare libero sed diam sed fringilla est.</p>

                            <div class="pt-1">
                                <button type="button" class="btn btn-soft-primary btn-sm text-truncate"><i class="bx bx-user me-1"></i> Contact</button>
                                <button type="button" class="btn btn-primary btn-sm text-truncate ms-2"><i class="bx bx-message-square-dots me-1"></i> Profile</button>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a class="text-muted dropdown-toggle font-size-16" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                    <i class="bx bx-dots-horizontal-rounded"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Edit</a>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Remove</a>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div>
                                    <img src="{{ URL::asset('assets/images/users/avatar-1.jpg') }}" alt="" class="avatar-md rounded-circle img-thumbnail">
                                </div>
                                <div class="flex-1 ms-3">
                                    <h5 class="font-size-16 mb-1"><a href="#" class="text-dark">James Nix</a></h5>
                                    <p class="text-muted mb-0">Full Stack Developer</p>
                                </div>
                            </div>
                            <p class="mt-3 text-muted">Curabitur non magna lobortis est tempus gravida ornare libero sed diam sed fringilla est.</p>

                            <div class="pt-1">
                                <button type="button" class="btn btn-soft-primary btn-sm text-truncate"><i class="bx bx-user me-1"></i> Contact</button>
                                <button type="button" class="btn btn-primary btn-sm text-truncate ms-2"><i class="bx bx-message-square-dots me-1"></i> Profile</button>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a class="text-muted dropdown-toggle font-size-16" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                    <i class="bx bx-dots-horizontal-rounded"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Edit</a>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Remove</a>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div>
                                    <img src="{{ URL::asset('assets/images/users/avatar-3.jpg') }}" alt="" class="avatar-md rounded-circle img-thumbnail">
                                </div>
                                <div class="flex-1 ms-3">
                                    <h5 class="font-size-16 mb-1"><a href="#" class="text-dark">Darlene Smith</a></h5>
                                    <p class="text-muted mb-0">UI/UX Designer</p>
                                </div>
                            </div>
                            <p class="mt-3 text-muted">Curabitur non magna lobortis est tempus gravida ornare libero sed diam sed fringilla est.</p>

                            <div class="pt-1">
                                <button type="button" class="btn btn-soft-primary btn-sm text-truncate"><i class="bx bx-user me-1"></i> Contact</button>
                                <button type="button" class="btn btn-primary btn-sm text-truncate ms-2"><i class="bx bx-message-square-dots me-1"></i> Profile</button>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a class="text-muted dropdown-toggle font-size-16" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                    <i class="bx bx-dots-horizontal-rounded"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Edit</a>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Remove</a>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="avatar-md">
                                    <div class="avatar-title bg-primary-subtle text-primary h1 m-0 rounded-circle">
                                        <i class="bx bxs-user-circle"></i>
                                    </div>
                                </div>
                                <div class="flex-1 ms-3">
                                    <h5 class="font-size-16 mb-1"><a href="#" class="text-dark">William Swift</a></h5>
                                    <p class="text-muted mb-0">Backend Developer</p>
                                </div>
                            </div>
                            <p class="mt-3 text-muted">Curabitur non magna lobortis est tempus gravida ornare libero sed diam sed fringilla est.</p>

                            <div class="pt-1">
                                <button type="button" class="btn btn-soft-primary btn-sm text-truncate"><i class="bx bx-user me-1"></i> Contact</button>
                                <button type="button" class="btn btn-primary btn-sm text-truncate ms-2"><i class="bx bx-message-square-dots me-1"></i> Profile</button>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->

                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a class="text-muted dropdown-toggle font-size-16" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                    <i class="bx bx-dots-horizontal-rounded"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Edit</a>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Remove</a>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="avatar-md">
                                    <div class="avatar-title bg-primary-subtle text-primary h1 m-0 rounded-circle">
                                        <i class="bx bxs-user-circle"></i>
                                    </div>
                                </div>
                                <div class="flex-1 ms-3">
                                    <h5 class="font-size-16 mb-1"><a href="#" class="text-dark">Kevin West</a></h5>
                                    <p class="text-muted mb-0">Full Stack Developer</p>
                                </div>
                            </div>

                            <p class="mt-3 text-muted">Curabitur non magna lobortis est tempus gravida ornare libero sed diam sed fringilla est.</p>

                            <div class="pt-1">
                                <button type="button" class="btn btn-soft-primary btn-sm text-truncate"><i class="bx bx-user me-1"></i> Contact</button>
                                <button type="button" class="btn btn-primary btn-sm text-truncate ms-2"><i class="bx bx-message-square-dots me-1"></i> Profile</button>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a class="text-muted dropdown-toggle font-size-16" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                    <i class="bx bx-dots-horizontal-rounded"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Edit</a>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Remove</a>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div>
                                    <img src="{{ URL::asset('assets/images/users/avatar-6.jpg') }}" alt="" class="avatar-md rounded-circle img-thumbnail">
                                </div>
                                <div class="flex-1 ms-3">
                                    <h5 class="font-size-16 mb-1"><a href="#" class="text-dark">Tommy Hayes</a></h5>
                                    <p class="text-muted mb-0">Backend Developer</p>
                                </div>
                            </div>
                            <p class="mt-3 text-muted">Curabitur non magna lobortis est tempus gravida ornare libero sed diam sed fringilla est.</p>

                            <div class="pt-1">
                                <button type="button" class="btn btn-soft-primary btn-sm text-truncate"><i class="bx bx-user me-1"></i> Contact</button>
                                <button type="button" class="btn btn-primary btn-sm text-truncate ms-2"><i class="bx bx-message-square-dots me-1"></i> Profile</button>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a class="text-muted dropdown-toggle font-size-16" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                    <i class="bx bx-dots-horizontal-rounded"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Edit</a>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Remove</a>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div>
                                    <img src="{{ URL::asset('assets/images/users/avatar-8.jpg') }}" alt="" class="avatar-md rounded-circle img-thumbnail">
                                </div>
                                <div class="flex-1 ms-3">
                                    <h5 class="font-size-16 mb-1"><a href="#" class="text-dark">Diana Owens</a></h5>
                                    <p class="text-muted mb-0">UI/UX Designer</p>
                                </div>
                            </div>
                            <p class="mt-3 text-muted">Curabitur non magna lobortis est tempus gravida ornare libero sed diam sed fringilla est.</p>

                            <div class="pt-1">
                                <button type="button" class="btn btn-soft-primary btn-sm text-truncate"><i class="bx bx-user me-1"></i> Contact</button>
                                <button type="button" class="btn btn-primary btn-sm text-truncate ms-2"><i class="bx bx-message-square-dots me-1"></i> Profile</button>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a class="text-muted dropdown-toggle font-size-16" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                    <i class="bx bx-dots-horizontal-rounded"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Edit</a>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Remove</a>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div>
                                    <img src="{{ URL::asset('assets/images/users/avatar-9.jpg') }}" alt="" class="avatar-md rounded-circle img-thumbnail">
                                </div>
                                <div class="flex-1 ms-3">
                                    <h5 class="font-size-16 mb-1"><a href="#" class="text-dark">Paul Sanchez</a></h5>
                                    <p class="text-muted mb-0">Full Stack Developer</p>
                                </div>
                            </div>
                            <p class="mt-3 text-muted">Curabitur non magna lobortis est tempus gravida ornare libero sed diam sed fringilla est.</p>

                            <div class="pt-1">
                                <button type="button" class="btn btn-soft-primary btn-sm text-truncate"><i class="bx bx-user me-1"></i> Contact</button>
                                <button type="button" class="btn btn-primary btn-sm text-truncate ms-2"><i class="bx bx-message-square-dots me-1"></i> Profile</button>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a class="text-muted dropdown-toggle font-size-16" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                    <i class="bx bx-dots-horizontal-rounded"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Edit</a>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Remove</a>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div>
                                    <img src="{{ URL::asset('assets/images/users/avatar-5.jpg') }}" alt="" class="avatar-md rounded-circle img-thumbnail">
                                </div>
                                <div class="flex-1 ms-3">
                                    <h5 class="font-size-16 mb-1"><a href="#" class="text-dark">Paul Sanchez</a></h5>
                                    <p class="text-muted mb-0">Full Stack Developer</p>
                                </div>
                            </div>
                            <p class="mt-3 text-muted">Curabitur non magna lobortis est tempus gravida ornare libero sed diam sed fringilla est.</p>

                            <div class="pt-1">
                                <button type="button" class="btn btn-soft-primary btn-sm text-truncate"><i class="bx bx-user me-1"></i> Contact</button>
                                <button type="button" class="btn btn-primary btn-sm text-truncate ms-2"><i class="bx bx-message-square-dots me-1"></i> Profile</button>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a class="text-muted dropdown-toggle font-size-16" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                    <i class="bx bx-dots-horizontal-rounded"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Edit</a>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Remove</a>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div>
                                    <img src="{{ URL::asset('assets/images/users/avatar-7.jpg') }}" alt="" class="avatar-md rounded-circle img-thumbnail">
                                </div>
                                <div class="flex-1 ms-3">
                                    <h5 class="font-size-16 mb-1"><a href="#" class="text-dark">Paul Sanchez</a></h5>
                                    <p class="text-muted mb-0">Full Stack Developer</p>
                                </div>
                            </div>
                            <p class="mt-3 text-muted">Curabitur non magna lobortis est tempus gravida ornare libero sed diam sed fringilla est.</p>

                            <div class="pt-1">
                                <button type="button" class="btn btn-soft-primary btn-sm text-truncate"><i class="bx bx-user me-1"></i> Contact</button>
                                <button type="button" class="btn btn-primary btn-sm text-truncate ms-2"><i class="bx bx-message-square-dots me-1"></i> Profile</button>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a class="text-muted dropdown-toggle font-size-16" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                    <i class="bx bx-dots-horizontal-rounded"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Edit</a>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Remove</a>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="avatar-md">
                                    <div class="avatar-title bg-primary-subtle text-primary h1 m-0 rounded-circle">
                                        <i class="bx bxs-user-circle"></i>
                                    </div>
                                </div>
                                <div class="flex-1 ms-3">
                                    <h5 class="font-size-16 mb-1"><a href="#" class="text-dark">Paul Sanchez</a></h5>
                                    <p class="text-muted mb-0">Full Stack Developer</p>
                                </div>
                            </div>
                            <p class="mt-3 text-muted">Curabitur non magna lobortis est tempus gravida ornare libero sed diam sed fringilla est.</p>

                            <div class="pt-1">
                                <button type="button" class="btn btn-soft-primary btn-sm text-truncate"><i class="bx bx-user me-1"></i> Contact</button>
                                <button type="button" class="btn btn-primary btn-sm text-truncate ms-2"><i class="bx bx-message-square-dots me-1"></i> Profile</button>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a class="text-muted dropdown-toggle font-size-16" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                    <i class="bx bx-dots-horizontal-rounded"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Edit</a>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Remove</a>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div>
                                    <img src="{{ URL::asset('assets/images/users/avatar-3.jpg') }}" alt="" class="avatar-md rounded-circle img-thumbnail">
                                </div>
                                <div class="flex-1 ms-3">
                                    <h5 class="font-size-16 mb-1"><a href="#" class="text-dark">Paul Sanchez</a></h5>
                                    <p class="text-muted mb-0">Full Stack Developer</p>
                                </div>
                            </div>
                            <p class="mt-3 text-muted">Curabitur non magna lobortis est tempus gravida ornare libero sed diam sed fringilla est.</p>

                            <div class="pt-1">
                                <button type="button" class="btn btn-soft-primary btn-sm text-truncate"><i class="bx bx-user me-1"></i> Contact</button>
                                <button type="button" class="btn btn-primary btn-sm text-truncate ms-2"><i class="bx bx-message-square-dots me-1"></i> Profile</button>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->

            </div>

            <div class="row mt-3">
                <div class="col-xl-12">
                    <div class="text-center mb-3">
                        <a href="javascript:void(0);" class="text-primary"><i class="mdi mdi-loading mdi-spin font-size-20 align-middle me-2"></i> Load more </a>
                    </div>
                </div>
            </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
