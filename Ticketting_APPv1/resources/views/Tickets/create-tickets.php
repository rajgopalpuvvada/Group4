<div class="create-tickets fluid close-route">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4 container">
        <h1 class="h3 mb-0 text-gray-800">Create Tickets</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm manage-tickets">
            <i class="fas fa-download fa-sm text-white-50"></i> 
            Manage Tickets
        </a>
    </div>

    <hr></hr>
    
    <!-- Content Row --> 
    <div class="create-tickets-form">
        <div class="container">
            <form class="create-ticket-form border border-info rounded">
                <div class="container"> 
                    <div class="contact-information">
                        <div class="card-header font-weight-bold">Contact Information</div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="" class="pt-3">Event Organizer Contact <small>If applicable</small> </label>
                                    <input type="text" name="username" id="username" class="form-control" placeholder="Enter Organizers Contact" aria-label="">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="" class="pt-3">Event Organizer Address <small>If applicable</small> </label>
                                    <input type="text" name="organizerAddresss" id="organizerAddresss" class="form-control" placeholder="Enter Organizers Address" aria-label="">
                                </div>
                            </div>
                        </div> 
                    </div> 
                    <div class="event-information">
                        <div class="card-header font-weight-bold">Event Information</div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group"> 
                                    <div class="form-group"> 
                                        <label for="" class="pt-3">Event Name</label>
                                        <select class="form-control" name="eventName" id="eventName">
                                            <option>Event 1</option>
                                            <option>Event 2</option>
                                            <option>Event 3</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="" class="pt-3">Ticket Charges</label>
                                    <input type="text" id="ticketCharges" class="form-control" placeholder="Enter ticket charges" aria-label="" required="required">
                                </div>
                            </div>
                        </div> 
                    </div>
                    <div class="col-12 submit-btn">
                        <div class="form-group">
                            <button type="button" id="createTicketsubmitBtn" class="btn btn-primary create-ticket-submit-btn w-25">Create Ticket</button>
                        </div> 
                    </div>  
                </div>
            </form>
        </div>
    </div> 
    <!-- Content Row --> 
</div>

