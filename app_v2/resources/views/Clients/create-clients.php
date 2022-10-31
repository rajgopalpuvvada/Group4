<div class="create-clients fluid close-route">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4 container">
        <h1 class="h3 mb-0 text-gray-800">Create Clients</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm manage-clients">
            <i class="fas fa-download fa-sm text-white-50"></i> 
            Manage Clients
        </a>
    </div>

    <hr></hr>
    
    <!-- Content Row --> 
    <div class="create-clients-form">
        <div class="container">
            <form class="create-client-form border border-info rounded">
                <div class="container"> 
                    <div class="contact-information">
                        <div class="card-header font-weight-bold">Personal Information</div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="" class="pt-3">First Name</label>
                                    <input type="text" name="firstname" id="firstName" class="form-control" placeholder="Enter first name" aria-label="First name">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="" class="pt-3">Last Name</label>
                                    <input type="text" name="lastname" id="lastName" class="form-control" placeholder="Enter last name" aria-label="First name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="" class="pt-3">Contact Number</label>
                                    <input type="text" id="ContactNumber" class="form-control" placeholder="Enter contact number" aria-label="First name">
                                </div>
                            </div> 
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="" class="pt-3">Personal Contact Email</label>
                                    <input type="text" id="personalContactEmail" class="form-control" placeholder="Enter personal contact email" aria-label="First name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="" class="pt-3">Organization <small>(If applicable)</small></label>
                                    <input type="text" id="organizationName" class="form-control" placeholder="Enter organization name" aria-label="First name">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="" class="pt-3">Organization Contact Email <small>(If applicable)</small></label>
                                    <input type="text" id="organizationContactEmail" class="form-control" placeholder="Enter organization contact email" aria-label="First name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="" class="pt-3">Grant Authentication Type</label>  
                                    <select class="form-control" name="" id="">
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
                            <button type="button" id="createClientsubmitBtn" class="btn btn-primary create-client-submit-btn w-25">Create Client</button>
                        </div> 
                    </div>  
                </div>
            </form>
        </div>
    </div> 
    <!-- Content Row --> 
</div>
