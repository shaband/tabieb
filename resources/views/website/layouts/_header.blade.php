<!-- START Page Header -->
<header id="main-header">
    <div id="header-wrap">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light px-0">
                <div class="d-flex align-items-center">
                    <a id="navbar-toggler-lnk" href="javascript:void(0)" class="btn text-secondary"
                       onclick="mobOpenMainMenu()">
                        <span></span>
                        <span></span>
                        <span></span>
                    </a>
                    <a class="navbar-brand" href="{!! url('/') !!}"><img src="{!! asset('design/images/logo.png') !!}"
                                                                         alt="Tabaieb Logo"></a>
                </div>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <a id="navbar-close-lnk" onclick="mobCloseMainMenu()"><i class="fas fa-times-circle"></i></a>
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="{!! url('/') !!}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="appointments.html">my appointments</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.html">about tabaieb</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.html">contact us</a>
                        </li>
                    </ul>
                </div>

                <div class="extra-links">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="search.html"><i class="fas fa-search"></i> search</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="z_index-rtl.html"><i class="fas fa-globe"></i> ar</a>
                        </li>
                        <li class="nav-item">
                            <a class="login-btn nav-link" href="javascript:void(0)">{!! __("Login") !!}</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>

</header>
<!-- END Page Header -->


<div class="modals-container">
    <!-- START Login Modal -->
    <div class="modal fade reg-modal" tabindex="-1" id="loginModal" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="reg-modal-col reg-modal-col-1">
                            <div class="modal-close">
                                <a href="javascript:void(0)" class="text-light" data-dismiss="modal"
                                   aria-label="Close"><i class="far fa-times-circle"></i></a>
                            </div>
                            <div class="heading-blk mb-3" data-aos="fade-down">
                                <h5 class="heading-tit-wz-after font-weight-bold">hi, <span class="text-secondary">login now</span><br><img
                                        src="{!! asset('design/images/heading-after.png') !!}"></h5>
                            </div>
                            <div class="nav nav-pills text-capitalize justify-content-center mb-3" id="v-pills-tab"
                                 role="tablist" aria-orientation="vertical">
                                <a class="nav-link active" id="v-pills-doctor-tab" data-toggle="pill"
                                   href="#v-pills-doctor" role="tab" aria-controls="v-pills-doctor"
                                   aria-selected="true">doctor</a>
                                <a class="nav-link" id="v-pills-patient-tab" data-toggle="pill"
                                   href="#v-pills-patient" role="tab" aria-controls="v-pills-patient"
                                   aria-selected="false">patient</a>
                            </div>
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-doctor" role="tabpanel"
                                     aria-labelledby="v-pills-doctor-tab">
                                    <form action="" class="basic-form form-label-inline form-secondaryLight">
                                        <div class="form-group">
                                            <label for="">email address:</label>
                                            <input type="email" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">password:</label>
                                            <input type="password" class="form-control">
                                        </div>
                                        <div>
                                            <a href="reset-pass.html"
                                               class="text-secondary text-capitalize mb-3 d-block">forget your
                                                password?</a>
                                        </div>
                                        <div class="mb-1 text-center">
                                            <button class="btn btn-thirdly text-capitalize">login</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="v-pills-patient" role="tabpanel"
                                     aria-labelledby="v-pills-patient-tab">
                                    <form action="" class="basic-form form-label-inline form-secondaryLight">
                                        <div class="form-group">
                                            <label for="">email address:</label>
                                            <input type="email" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">password:</label>
                                            <input type="password" class="form-control">
                                        </div>
                                        <div>
                                            <a href="reset-pass.html"
                                               class="text-secondary text-capitalize mb-3 d-block">forget your
                                                password?</a>
                                        </div>
                                        <div class="mb-1 text-center">
                                            <button class="btn btn-thirdly text-capitalize">login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="mb-3 text-center font-weight-bold">
                                Don't have an account? <a href="javascript:void(0)" id="register-btn"
                                                          class="text-secondary text-capitalize">sign up</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="reg-modal-col reg-modal-col-2 bg-secondary">
                            <img src="images/logo-white.png">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Login Modal -->
    <!-- START Register Modal -->
    <div class="modal fade reg-modal" tabindex="-1" id="registerModal" role="dialog">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="reg-modal-col reg-modal-col-1">
                            <div class="modal-close">
                                <a href="javascript:void(0)" class="text-light" data-dismiss="modal"
                                   aria-label="Close"><i class="far fa-times-circle"></i></a>
                            </div>
                            <div class="heading-blk mb-3" data-aos="fade-down">
                                <h5 class="heading-tit-wz-after font-weight-bold">hi, <span class="text-secondary">let's create an account</span><br><img
                                        src="images/heading-after.png"></h5>
                            </div>
                            <form action="" class="basic-form form-label-inline form-secondaryLight">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">first name:</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">last name:</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">email address:</label>
                                    <input type="email" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">phone number:</label>
                                    <input type="number" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">password:</label>
                                    <input type="password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">confirm password:</label>
                                    <input type="password" class="form-control">
                                </div>
                                <div class="mb-1 text-center">
                                    <button class="btn btn-thirdly text-capitalize">create account</button>
                                </div>
                                <div class="mb-3 text-center font-weight-bold">
                                    Already have an account? <a href="javascript:void(0)"
                                                                class="login-btn text-secondary text-capitalize">login</a>
                                </div>
                            </form>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="reg-modal-col reg-modal-col-2 bg-secondary">
                            <img src="{!! asset('design/images/logo-white.png') !!}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Register Modal -->
</div>
