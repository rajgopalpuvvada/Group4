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
                        <div class="card-header font-weight-bold">Client Information</div> 
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="" class="pt-3">First Name</label>
                                    <input disabled type="text" name="firstname" id="firstName" class="form-control  firstName" placeholder="Enter first name" aria-label="firstName" required="required">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="" class="pt-3">Last Name</label>
                                    <input disabled type="text" name="lastname" id="lastName" class="form-control  lastName" placeholder="Enter last name" aria-label="lastName" required="required">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">  
                                    <input type="hidden" name="clientId" id="clientId" class="form-control clientId" aria-label="">
                                </div>
                            </div> 
                        </div>  
                    </div> 
                    <div class="contact-information">
                        <div class="card-header font-weight-bold">Event Information</div>  
                        <div class="row"> 
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="" class="pt-3">Event Name</label> 
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text btn create-ticket-select-event-modal-btn" id="basic-addon1" data-toggle="modal" data-target="#EventsModalId">Choose Event</span>
                                            
                                            <!-- Modal -->
                                            <div class="modal fade EventsModal" id="EventsModalId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                <div style="max-width: 1000px;" class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title font-weight-bold">Events List</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="modal-select-events-filters-form" id="modal-select-events-filters-form">    
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="form-group disable_off">
                                                                            <label for="" class="pt-3">Event Name</label>
                                                                            <input type="text" id="eventName" class="form-control eventName" placeholder="Enter event name" aria-label="Event name">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="form-group disable_off">
                                                                            <label for="" class="pt-3">Event Type</label>
                                                                            <input type="text" id="eventType" class="form-control eventType" placeholder="Enter event type" aria-label="Event type">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="form-group disable_off">
                                                                            <label for="" class="pt-3">Event Venue</label>
                                                                            <input type="text" id="eventVenue" class="form-control eventVenue" placeholder="Enter event venue" aria-label="Event venue">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="form-group disable_off">
                                                                            <label for="" class="pt-3">Event Creation Date</label>
                                                                            <input type="date" id="event-creation-date" class="form-control event-creation-date" value="<?= date('Y-m-d') ?>" aria-label="Event creation date">
                                                                        </div>
                                                                    </div> 
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group disable_off">
                                                                            <label for="" class="pt-3">Date of attending</label>
                                                                            <input type="date" id="date-of-attending" class="form-control date-of-attending" value="<?= date('Y-m-d') ?>" aria-label="Date of attending">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div> 
                                                            <div class="filters-table-divider">
                                                                <hr></hr>
                                                            </div>
                                                            <div class="table-container">
                                                                <div class="table-responsive w-100">
                                                                    <table class="table select-events-table w-100">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Event Name</th>
                                                                                <th>Event Type</th> 
                                                                                <th>No of Participants</th> 
                                                                                <th>Attending Date</th>
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
                                                                            </tr>
                                                                        </tbody>
                                                                        <div class="data-loading-icon-status">

                                                                        </div>
                                                                    </table> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary btn-sm w-25 close-events-modal" data-dismiss="modal">Close</button> 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                        <input type="text" class="form-control SelectedEventName" name="SelectedEventName" id="" disabled placeholder="Please select an event" aria-describedby="helpId"  required="required">  
                                    </div>
                                    <small>Click on choose event to select an event!</small>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="" class="pt-3">Maximum Number of Tickets </label>
                                        <input type="number" id="MaximumTickets" class="form-control MaximumTickets" placeholder="Enter number of tickets" aria-label="" value="1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="" class="pt-3">Total Ticket Cost</label> 
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text currency-symbol" id="basic-addon1">$</span>
                                        </div>
                                        <input type="text" disabled id="ticketCharges" class="form-control ticketCharges" aria-label="ticket charges" aria-describedby="basic-addon1" value="0">
                                        <input type="hidden" disabled id="ticketCharge" class="form-control ticketCharge" aria-label="ticket charge" aria-describedby="basic-addon1" value="0">
                                    </div>
                                </div>
                            </div> 
                        </div> 
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group disable_off">
                                    <label for="" class="pt-3">Payment Method</label> 
                                    <select class="form-control payment_method" name="payment_method" id="payment_method">
                                        <option>Cash</option>
                                        <option>Master Card</option>
                                        <option>Paypal</option>
                                        <option>Cheque</option>
                                    </select> 
                                </div>
                            </div>  
                        </div>  
                    </div>  
                    <div class="col-12 submit-btn">
                        <div class="form-group">
                            <button disabled type="button" id="createTicketsubmitBtn" class="btn btn-primary create-ticket-submit-btn w-25">Create Ticket</button>
                        </div> 
                    </div>  
                </div>
            </form>
        </div>
    </div> 
    <!-- Content Row --> 
</div>

