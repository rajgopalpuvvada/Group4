<div class="manage-all-clients fluid close-route">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4 container">
        <h1 class="h3 mb-0 text-gray-800">Manage Clients</h1> 
    </div>

    <hr></hr>
    
    <!-- Content Row --> 
    <div class="manage-clients-content">
        
        <div class="table-default-filters">
            <form class="manage-clients-filters-form">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="pt-3">First Name</label>
                            <input type="text" id="first_name" class="form-control first_name" placeholder="Enter first name" aria-label="">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="pt-3">Last name</label>
                            <input type="text" id="last_name" class="form-control last_name" placeholder="Enter last name" aria-label="">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="pt-3">Contact Email</label>
                            <input type="text" id="contact_email" class="form-control contact_email" placeholder="Enter contact email" aria-label="">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="pt-3">Organization</label>
                            <input type="text" id="organization" class="form-control organization" placeholder="Enter organization name" aria-label="">
                        </div>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="" class="pt-3">Org. Contact Email</label>
                            <input type="text" id="org_contact_email" class="form-control org_contact_email" aria-label="">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="" class="pt-3">Client Registration Date</label>
                            <input type="date" id="date_created_at" class="form-control date_created_at" value="<?= date('Y-m-d') ?>" aria-label="">
                        </div>
                    </div>
                </div>
            </form> 
        </div>
        <div class="filters-table-divider">
            <hr></hr>
        </div>
        <div class="table-container">
            <div class="table-responsive">
                <table class="table manage-clients-table">
                    <thead>
                        <tr>
                            <th>column</th>
                            <th>column</th>
                            <th>column</th>
                            <th>column</th>
                            <th>column</th>
                            <th>column</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody> 
                        <tr> 
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>  
</div>