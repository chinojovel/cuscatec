@extends('layouts.master')
@section('title') @lang('translation.User_Profile') @endsection

    @section('content')
    @component('components.breadcrumb')
    @slot('li_1') Contacts @endslot
    @slot('title') User Profile @endslot
    @endcomponent

        <div class="row mb-4">
            <div class="col-xl-8">
                <div class="card mb-0">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#about" role="tab">
                                <i class="bx bx-user-circle font-size-20"></i>
                                <span class="d-none d-sm-block">About</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tasks" role="tab">
                                <i class="bx bx-clipboard font-size-20"></i>
                                <span class="d-none d-sm-block">Tasks</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#messages" role="tab">
                                <i class="bx bx-mail-send font-size-20"></i>
                                <span class="d-none d-sm-block">Messages</span>
                            </a>
                        </li>
                    </ul>
                    <!-- Tab content -->
                    <div class="tab-content p-4">
                        <div class="tab-pane active" id="about" role="tabpanel">
                            <div>
                                <div>
                                    <h5 class="font-size-16 mb-4">Experience</h5>

                                    <ul class="activity-feed mb-0 ps-2">
                                        <li class="feed-item">
                                            <div class="feed-item-list">
                                                <p class="text-muted mb-1">2019 - 2020</p>
                                                <h5 class="font-size-15">UI/UX Designer</h5>
                                                <p>Abc Company</p>
                                                <p class="text-muted">To achieve this, it would be necessary to have uniform grammar, pronunciation and more common words. If several languages coalesce, the grammar of the resulting language is more simple and regular than that of the individual</p>
                                            </div>
                                        </li>
                                        <li class="feed-item">
                                            <div class="feed-item-list">
                                                <p class="text-muted mb-1">2017 - 2019</p>
                                                <h5 class="font-size-15">Graphic Designer</h5>
                                                <p>xyz Company</p>
                                                <p class="text-muted">It will be as simple as occidental in fact, it will be Occidental. To an English person, it will seem like simplified English, as a skeptical Cambridge friend of mine told me what Occidental </p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div>
                                    <h5 class="font-size-16 mb-4">Projects</h5>

                                    <div class="table-responsive">
                                        <table class="table table-nowrap table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Projects</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col" style="width: 120px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">01</th>
                                                    <td><a href="#" class="text-dark">Brand Logo Design</a></td>
                                                    <td>
                                                        18 Jun, 2020
                                                    </td>
                                                    <td>
                                                        <span class="badge text-primary bg-primary-subtle font-size-12">Open</span>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <a class="text-muted dropdown-toggle font-size-18 px-2" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </a>

                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="#">Action</a>
                                                                <a class="dropdown-item" href="#">Another action</a>
                                                                <a class="dropdown-item" href="#">Something else here</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">02</th>
                                                    <td><a href="#" class="text-dark">Minible Admin</a></td>
                                                    <td>
                                                        06 Jun, 2020
                                                    </td>
                                                    <td>
                                                        <span class="badge text-primary bg-primary-subtle font-size-12">Open</span>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <a class="text-muted dropdown-toggle font-size-18 px-2" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </a>

                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="#">Action</a>
                                                                <a class="dropdown-item" href="#">Another action</a>
                                                                <a class="dropdown-item" href="#">Something else here</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">03</th>
                                                    <td><a href="#" class="text-dark">Chat app Design</a></td>
                                                    <td>
                                                        28 May, 2020
                                                    </td>
                                                    <td>
                                                        <span class="badge text-success bg-success-subtle font-size-12">Complete</span>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <a class="text-muted dropdown-toggle font-size-18 px-2" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </a>

                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="#">Action</a>
                                                                <a class="dropdown-item" href="#">Another action</a>
                                                                <a class="dropdown-item" href="#">Something else here</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">04</th>
                                                    <td><a href="#" class="text-dark">Minible Landing</a></td>
                                                    <td>
                                                        13 May, 2020
                                                    </td>
                                                    <td>
                                                        <span class="badge text-success bg-success-subtle font-size-12">Complete</span>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <a class="text-muted dropdown-toggle font-size-18 px-2" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </a>

                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="#">Action</a>
                                                                <a class="dropdown-item" href="#">Another action</a>
                                                                <a class="dropdown-item" href="#">Something else here</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">05</th>
                                                    <td><a href="#" class="text-dark">Authentication Pages</a></td>
                                                    <td>
                                                        06 May, 2020
                                                    </td>
                                                    <td>
                                                        <span class="badge text-success bg-success-subtle font-size-12">Complete</span>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <a class="text-muted dropdown-toggle font-size-18 px-2" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </a>

                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="#">Action</a>
                                                                <a class="dropdown-item" href="#">Another action</a>
                                                                <a class="dropdown-item" href="#">Something else here</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tasks" role="tabpanel">
                            <div>
                                <h5 class="font-size-16 mb-3">Active</h5>

                                <div class="table-responsive">
                                    <table class="table table-nowrap table-centered">
                                        <tbody>
                                            <tr>
                                                <td style="width: 60px;">
                                                    <div class="form-check font-size-16 text-center">
                                                        <input type="checkbox" class="form-check-input" id="tasks-activeCheck2">
                                                        <label class="form-check-label" for="tasks-activeCheck2"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#" class="fw-bold text-dark">Ecommerce Product Detail</a>
                                                </td>

                                                <td>
                                                    <p class="ml-4 text-muted mb-0">
                                                        <i class="mdi mdi-comment-outline align-middle text-muted font-size-16 me-1"></i> 3
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="ml-4 mb-0">Product Design</p>
                                                </td>

                                                <td>27 May, 2020</td>
                                                <td style="width: 160px;"><span class="badge text-primary bg-primary-subtle font-size-12">Active</span></td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check font-size-16 text-center">
                                                        <input type="checkbox" class="form-check-input" id="tasks-activeCheck1">
                                                        <label class="form-check-label" for="tasks-activeCheck1"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#" class="fw-bold text-dark">Ecommerce Product</a>
                                                </td>

                                                <td>
                                                    <p class="ml-4 text-muted mb-0">
                                                        <i class="mdi mdi-comment-outline align-middle text-muted font-size-16 me-1"></i> 7
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="ml-4 mb-0">Web Development</p>
                                                </td>

                                                <td>26 May, 2020</td>
                                                <td><span class="badge text-primary bg-primary-subtle font-size-12">Active</span></td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <h5 class="font-size-16 my-3">Upcoming</h5>

                                <div class="table-responsive">
                                    <table class="table table-nowrap table-centered">
                                        <tbody>
                                            <tr>
                                                <td style="width: 60px;">
                                                    <div class="form-check font-size-16 text-center">
                                                        <input type="checkbox" class="form-check-input" id="tasks-upcomingCheck3">
                                                        <label class="form-check-label" for="tasks-upcomingCheck3"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#" class="fw-bold text-dark">Chat app Page</a>
                                                </td>

                                                <td>
                                                    <p class="ml-4 text-muted mb-0">
                                                        <i class="mdi mdi-comment-outline align-middle text-muted font-size-16 me-1"></i> 2
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="ml-4 mb-0">Web Development</p>
                                                </td>

                                                <td>-</td>
                                                <td style="width: 160px;"><span class="badge text-secondary  bg-secondary-subtle font-size-12">Waiting</span></td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check font-size-16 text-center">
                                                        <input type="checkbox" class="form-check-input" id="tasks-upcomingCheck2">
                                                        <label class="form-check-label" for="tasks-upcomingCheck2"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#" class="fw-bold text-dark">Email Pages</a>
                                                </td>

                                                <td>
                                                    <p class="ml-4 text-muted mb-0">
                                                        <i class="mdi mdi-comment-outline align-middle text-muted font-size-16 me-1"></i> 1
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="ml-4 mb-0">Illustration</p>
                                                </td>

                                                <td>04 June, 2020</td>
                                                <td><span class="badge text-primary bg-primary-subtle font-size-12">Approved</span></td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check font-size-16 text-center">
                                                        <input type="checkbox" class="form-check-input" id="tasks-upcomingCheck1">
                                                        <label class="form-check-label" for="tasks-upcomingCheck1"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#" class="fw-bold text-dark">Contacts Profile Page</a>
                                                </td>
                                                <td>
                                                    <p class="ml-4 text-muted mb-0">
                                                        <i class="mdi mdi-comment-outline align-middle text-muted font-size-16 me-1"></i> 6
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="ml-4 mb-0">Product Design</p>
                                                </td>

                                                <td>-</td>
                                                <td><span class="badge text-secondary  bg-secondary-subtle font-size-12">Waiting</span></td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <h5 class="font-size-16 my-3">Complete</h5>

                                <div class="table-responsive">
                                    <table class="table table-nowrap table-centered">
                                        <tbody>
                                            <tr>
                                                <td style="width: 60px;">
                                                    <div class="form-check font-size-16 text-center">
                                                        <input type="checkbox" class="form-check-input" id="tasks-completeCheck3">
                                                        <label class="form-check-label" for="tasks-completeCheck3"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#" class="fw-bold text-dark">UI Elements</a>
                                                </td>

                                                <td>
                                                    <p class="ml-4 text-muted mb-0">
                                                        <i class="mdi mdi-comment-outline align-middle text-muted font-size-16 me-1"></i> 6
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="ml-4 mb-0">Product Design</p>
                                                </td>

                                                <td>27 May, 2020</td>
                                                <td style="width: 160px;"><span class="badge text-success  bg-success-subtle font-size-12">Complete</span></td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check font-size-16 text-center">
                                                        <input type="checkbox" class="form-check-input" id="tasks-completeCheck2">
                                                        <label class="form-check-label" for="tasks-completeCheck2"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#" class="fw-bold text-dark">Authentication Pages</a>
                                                </td>

                                                <td>
                                                    <p class="ml-4 text-muted mb-0">
                                                        <i class="mdi mdi-comment-outline align-middle text-muted font-size-16 me-1"></i> 2
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="ml-4 mb-0">Illustration</p>
                                                </td>

                                                <td>27 May, 2020</td>
                                                <td><span class="badge text-success bg-success-subtle font-size-12">Complete</span></td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check font-size-16 text-center">
                                                        <input type="checkbox" class="form-check-input" id="tasks-completeCheck1">
                                                        <label class="form-check-label" for="tasks-completeCheck1"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#" class="fw-bold text-dark">Admin Layout</a>
                                                </td>

                                                <td>
                                                    <p class="ml-4 text-muted mb-0">
                                                        <i class="mdi mdi-comment-outline align-middle text-muted font-size-16 me-1"></i> 3
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="ml-4 mb-0">Product Design</p>
                                                </td>

                                                <td>26 May, 2020</td>
                                                <td><span class="badge text-success bg-success-subtle font-size-12">Complete</span></td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="messages" role="tabpanel">
                            <div>
                                <div data-simplebar style="max-height: 430px;">
                                    <div class="d-flex align-items-start border-bottom py-4">
                                        <div class="flex-shrink-0 me-2">
                                            <img class="rounded-circle avatar-sm" src="{{ URL::asset('assets/images/users/avatar-3.jpg') }}" alt="avatar-3 images">
                                        </div>

                                        <div class="flex-grow-1">
                                            <h5 class="font-size-15 mb-1">Marion Walker <small class="text-muted float-end">1 hr ago</small></h5>
                                            <p class="text-muted">If several languages coalesce, the grammar of the resulting .</p>

                                            <a href="javascript: void(0);" class="text-muted font-13 d-inline-block"><i
                                                class="mdi mdi-reply"></i> Reply</a>

                                            <div class="d-flex align-items-start mt-4">
                                                <div class="flex-shrink-0 me-2">
                                                    <img class="rounded-circle avatar-sm" src="{{ URL::asset('assets/images/users/avatar-4.jpg') }}" alt="avatar-4 images">
                                                </div>

                                                <div class="flex-grow-1">
                                                    <h5 class="font-size-15 mb-1">Shanon Marvin <small class="text-muted float-end">1 hr ago</small></h5>
                                                    <p class="text-muted">It will be as simple as in fact, it will be Occidental. To it will seem like simplified .</p>


                                                    <a href="javascript: void(0);" class="text-muted font-13 d-inline-block">
                                                        <i class="mdi mdi-reply"></i> Reply
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-start border-bottom py-4">
                                        <div class="flex-shrink-0 me-2">
                                            <img class="rounded-circle avatar-sm" src="{{ URL::asset('assets/images/users/avatar-5.jpg') }}" alt="avatar-5 images">
                                        </div>

                                        <div class="flex-grow-1">
                                            <h5 class="font-size-15 mb-1">Janice Morgan <small class="text-muted float-end">2 hrs ago</small></h5>
                                            <p class="text-muted">To achieve this, it would be necessary to have uniform pronunciation.</p>

                                            <a href="javascript: void(0);" class="text-muted font-13 d-inline-block"><i
                                                class="mdi mdi-reply"></i> Reply</a>

                                        </div>
                                    </div>

                                    <div class="d-flex align-items-start border-bottom py-4">
                                        <div class="flex-shrink-0 me-2">
                                            <img class="rounded-circle avatar-sm" src="{{ URL::asset('assets/images/users/avatar-7.jpg') }}" alt="avatar-7 images">
                                        </div>

                                        <div class="flex-grow-1">
                                            <h5 class="font-size-15 mb-1">Patrick Petty <small class="text-muted float-end">3 hrs ago</small></h5>
                                            <p class="text-muted">Sed ut perspiciatis unde omnis iste natus error sit </p>

                                            <a href="javascript: void(0);" class="text-muted font-13 d-inline-block"><i
                                                class="mdi mdi-reply"></i> Reply</a>

                                        </div>
                                    </div>
                                </div>

                                <div class="border rounded mt-4">
                                    <form action="#">
                                        <div class="px-2 py-1 bg-light">

                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-sm btn-link text-dark text-decoration-none"><i class="bx bx-link"></i></button>
                                                <button type="button" class="btn btn-sm btn-link text-dark text-decoration-none"><i class="bx bx-smile"></i></button>
                                                <button type="button" class="btn btn-sm btn-link text-dark text-decoration-none"><i class="bx bx-at"></i></button>
                                                </div>
                                        </div>
                                        <textarea rows="3" class="form-control border-0 resize-none" placeholder="Your Message..."></textarea>

                                    </form>
                                </div> <!-- end .border-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card overflow-hidden">
                    <div class="profile-user"></div>
                    <div class="card-body">
                        <div class="profile-content text-center">
                            <div class="profile-user-img">
                                <img src="{{ (isset(Auth::user()->avatar) && Auth::user()->avatar != '') ? asset(Auth::user()->avatar) : asset('/assets/images/users/avatar-1.jpg') }}" alt="" class="avatar-lg rounded-circle img-thumbnail">
                            </div>

                            <div class="mt-4">
                                <button type="button" class="btn btn-primary btn-sm"data-bs-toggle="modal" data-bs-target="#profile-edit"><i class="mdi mdi-pencil me-1"></i>Edit Profile</button>
                            </div>

                            <h5 class="mt-3 mb-1">{{ Auth::user()->name }}</h5>
                            <p class="text-muted">UI/UX Designer</p>

                            <p class="text-muted mb-1">
                                Hi I'm Marcus,has been the industry's standard dummy text To an English person,
                                it will seem like simplified English, as a skeptical Cambridge.</p>

                        </div>

                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Team Members</h5>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap">
                                <tbody>
                                    <tr>
                                        <td style="width: 50px;"><img src="{{ URL::asset('assets/images/users/avatar-2.jpg') }}" class="rounded-circle avatar-sm" alt=""></td>
                                        <td><h5 class="font-size-14 m-0"><a href="javascript: void(0);" class="text-dark">Daniel Canales</a></h5></td>
                                        <td>
                                            <div>
                                                <a href="javascript: void(0);" class="badge bg-primary-subtle text-primary font-size-11">Frontend</a>
                                                <a href="javascript: void(0);" class="badge bg-primary-subtle text-primary font-size-11">UI</a>
                                            </div>
                                        </td>
                                        <td>
                                            <i class="mdi mdi-circle-medium font-size-18 text-success align-middle me-1"></i> Online
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ URL::asset('assets/images/users/avatar-1.jpg') }}" class="rounded-circle avatar-sm" alt=""></td>
                                        <td><h5 class="font-size-14 m-0"><a href="javascript: void(0);" class="text-dark">Jennifer Walker</a></h5></td>
                                        <td>
                                            <div>
                                                <a href="javascript: void(0);" class="badge bg-primary-subtle text-primary font-size-11">UI / UX</a>
                                            </div>
                                        </td>
                                        <td>
                                            <i class="mdi mdi-circle-medium font-size-18 text-warning align-middle me-1"></i> Buzy
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="avatar-sm">
                                                <span class="avatar-title rounded-circle bg-primary text-white font-size-14">
                                                    C
                                                </span>
                                            </div>
                                        </td>
                                        <td><h5 class="font-size-14 m-0"><a href="javascript: void(0);" class="text-dark">Carl Mackay</a></h5></td>
                                        <td>
                                            <div>
                                                <a href="javascript: void(0);" class="badge bg-primary-subtle text-primary font-size-11">Backend</a>
                                            </div>
                                        </td>
                                        <td>
                                            <i class="mdi mdi-circle-medium font-size-18 text-success align-middle me-1"></i> Online
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ URL::asset('assets/images/users/avatar-4.jpg') }}" class="rounded-circle avatar-sm" alt=""></td>
                                        <td><h5 class="font-size-14 m-0"><a href="javascript: void(0);" class="text-dark">Janice Cole</a></h5></td>
                                        <td>
                                            <div>
                                                <a href="javascript: void(0);" class="badge bg-primary-subtle text-primary font-size-11">Frontend</a>
                                                <a href="javascript: void(0);" class="badge bg-primary-subtle text-primary font-size-11">UI</a>
                                            </div>
                                        </td>
                                        <td>
                                            <i class="mdi mdi-circle-medium font-size-18 text-success align-middle me-1"></i> Online
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="avatar-sm">
                                                <span class="avatar-title rounded-circle bg-primary text-white font-size-14">
                                                    T
                                                </span>
                                            </div>
                                        </td>
                                        <td><h5 class="font-size-14 m-0"><a href="javascript: void(0);" class="text-dark">Tony Brafford</a></h5></td>
                                        <td>
                                            <div>
                                                <a href="javascript: void(0);" class="badge bg-primary-subtle text-primary font-size-11">Backend</a>
                                            </div>
                                        </td>
                                        <td>
                                            <i class="mdi mdi-circle-medium font-size-18 text-secondary align-middle me-1"></i> Offline
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="profile-edit" tabindex="-1" aria-labelledby="exampleModalPopoversLabel" aria-modal="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalPopoversLabel">Update Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ URL('update-profile') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-4">
                                    <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" value="{{ucfirst(Auth::user()->name)}}" name="name" class="form-control" id="horizontal-firstname-input">
                                    </div>
                                </div><!-- end row -->

                                <div class="row mb-4">
                                    <label for="horizontal-email-input" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" name="email" value="{{ucfirst(Auth::user()->email)}}" class="form-control" id="horizontal-email-input">
                                    </div>
                                </div>


                                <div class="row mb-4">
                                    <label for="avatar" class="col-sm-3">Profile Picture</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input type="file" class="form-control @error('avatar') is-invalid @enderror" id="useravatar" name="avatar" autofocus>
                                            <label class="input-group-text" for="avatar">Upload</label>
                                        </div>
                                        <div class="text-start mt-2">
                                            <img src="{{ (isset(Auth::user()->avatar) && Auth::user()->avatar != '')  ? asset(Auth::user()->avatar) : asset('/assets/images/users/avatar-1.jpg') }}" alt="" class="rounded-circle avatar-lg">
                                        </div>
                                        <div class="text-danger" role="alert" id="avatarError" data-ajax-feedback="avatar"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="xx" id="updateprofile">Save changes</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection

