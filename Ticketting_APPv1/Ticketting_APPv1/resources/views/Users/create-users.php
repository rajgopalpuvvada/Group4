<div class="create-users fluid close-route">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4 container">
        <h1 class="h3 mb-0 text-gray-800">Create Users</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm manage-users">
            <i class="fas fa-download fa-sm text-white-50"></i> 
            Manage Users
        </a>
    </div>

    <hr></hr>
    
    <!-- Content Row --> 
    <div class="create-users-form">
        <div class="container">
            <form class="create-user-form border border-info rounded">
                <div class="container"> 
                    <div class="contact-information">
                        <div class="card-header font-weight-bold">Personal Information</div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="" class="pt-3">Username</label>
                                    <input type="text" name="username" id="username" class="form-control username" placeholder="Enter username" aria-label="User name">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="" class="pt-3">Contact Number</label>
                                    <input type="text" id="ContactNumber" class="form-control ContactNumber" placeholder="Enter contact number" aria-label="">
                                </div>
                            </div> 
                        </div>
                        <div class="row"> 
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="" class="pt-3">Personal Contact Email</label>
                                    <input type="text" id="personalContactEmail" class="form-control personalContactEmail" placeholder="Enter personal contact email" aria-label="">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="" class="pt-3">Password</label>
                                    <input type="password" id="password" class="form-control password" placeholder="Enter auth password" aria-label="">
                                </div>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="" class="pt-3">Grant Authentication Type</label>  
                                    <select class="form-control authentication_mode" name="authentication_mode" id="authentication_mode">
                                        <option value="1">Super Administrator</option>
                                        <option value="2">Major Administrator</option>
                                        <option value="3">Minor Administrator</option>
                                        <option value="4">Client</option>
                                    </select> 
                                </div>
                            </div> 
                        </div>
                    </div> 
                    <div class="col-12 submit-btn">
                        <div class="form-group">
                            <button type="button" id="createUsersubmitBtn" class="btn btn-primary create-user-submit-btn w-25">Create User </button>
                        </div> 
                    </div>  
                </div>
            </form>
        </div>
    </div> 
    <!-- Content Row --> 
</div>
