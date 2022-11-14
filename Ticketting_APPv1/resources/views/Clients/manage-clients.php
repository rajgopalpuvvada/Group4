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
                            <label for="" class="pt-3">Event Name</label>
                            <input type="text" id="eventName" class="form-control eventName" placeholder="Enter event name" aria-label="Event name">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="pt-3">Event Type</label>
                            <input type="text" id="eventType" class="form-control eventType" placeholder="Enter event type" aria-label="Event type">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="pt-3">Event Venue</label>
                            <input type="text" id="eventVenue" class="form-control eventVenue" placeholder="Enter event venue" aria-label="Event venue">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="pt-3">Event Creation Date</label>
                            <input type="date" id="event-creation-date" class="form-control event-creation-date" value="<?= date('Y-m-d') ?>" aria-label="Event creation date">
                        </div>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="" class="pt-3">Date of attending</label>
                            <input type="date" id="date-of-attending" class="form-control date-of-attending" aria-label="Date of attending">
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
    <!-- Content Row --> 
</div>