<div class="manage-all-events fluid close-route">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4 container">
        <h1 class="h3 mb-0 text-gray-800">Manage Events</h1> 
    </div>

    <hr></hr>
    
    <!-- Content Row --> 
    <div class="manage-events-content"> 
        <div class="table-default-filters">
            <form class="manage-events-filters-form">
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
                            <input type="date" id="date-of-attending" class="form-control date-of-attending" value="<?= date('Y-m-d') ?>" aria-label="Date of attending">
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
                <table class="table manage-events-table">
                    <thead>
                        <tr>
                            <th>Event Name</th>
                            <th>Event Type</th>
                            <th>Categpry</th>
                            <th>No of Participants</th>
                            <th>Date of Events</th>
                            <th>End of Event Date</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Primary Contact Number</th>
                            <th>Secondary Contact Number</th>
                            <th>Personal Contact Number</th>
                            <th>Org. Name</th>
                            <th>Theme of Event</th>
                            <th>Org. Contact Email</th>
                            <th>About Event</th>
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
                            <td></td>
                            <td></td>
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