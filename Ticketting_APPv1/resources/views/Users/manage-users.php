<div class="manage-all-users fluid close-route">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4 container">
        <h1 class="h3 mb-0 text-gray-800">Manage Users</h1> 
    </div>

    <hr></hr>
    
    <!-- Content Row --> 
    <div class="manage-users-content"> 
        <div class="table-default-filters">
            <form class="manage-users-filters-form">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="pt-3">User Name</label>
                            <input type="text" id="username" class="form-control username" placeholder="Enter user name" aria-label="User name">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="pt-3">User Email</label>
                            <input type="text" id="email" class="form-control email" placeholder="Enter email" aria-label="email">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="pt-3">Contact Phone</label>
                            <input type="text" id="contact-phone" class="form-control contact-phone" placeholder="Enter contact phone" aria-label="Contact phone">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="pt-3">User Creation Date</label>
                            <input type="date" id="user-creation-date" class="form-control user-creation-date" value="<?= date('Y-m-d') ?>" aria-label="User creation date">
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
                <table class="table manage-users-table">
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
    <!-- Content Row --> 
</div>