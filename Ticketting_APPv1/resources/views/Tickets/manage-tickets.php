<div class="manage-all-tickets fluid close-route">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4 container">
        <h1 class="h3 mb-0 text-gray-800">Manage Tickets</h1> 
    </div>

    <hr></hr>
    
    <!-- Content Row --> 
    <div class="manage-tickets-content">
        
        <div class="table-default-filters">
            <form class="manage-tickets-filters-form">
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
                            <label for="" class="pt-3">Ticket Creation Date</label>
                            <input type="date" id="ticket-creation-date" class="form-control ticket-creation-date" value="<?= date('Y-m-d') ?>" aria-label="Ticket creation date">
                        </div>
                    </div> 
                </div> 
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="pt-3">Client Name</label>
                            <input type="text" id="username" class="form-control username" placeholder="Enter user name" aria-label="User name">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="pt-3">Client Email</label>
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
                            <input type="date" id="client-creation-date" class="form-control client-creation-date" value="<?= date('Y-m-d') ?>" aria-label="client creation date">
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
                <table class="table manage-tickets-table">
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