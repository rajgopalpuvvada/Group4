<div class="create-events fluid close-route">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4 container">
        <h1 class="h3 mb-0 text-gray-800">Create Events</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm manage-events">
            <i class="fas fa-download fa-sm text-white-50"></i> 
            Manage Events
        </a>
    </div>

    <hr></hr>
    
    <!-- Content Row --> 
    <div class="create-events-form">
        <div class="container">
            <form class="create-event-form border border-info rounded">
                <div class="container">
                    <div class="event-information">
                        <div class="card-header font-weight-bold">Event Information</div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="" class="pt-3">Event Name</label>
                                    <input type="text" id="eventName" class="form-control eventName" placeholder="Enter event name" aria-label="" required="required">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="" class="pt-3">Event Type</label>
                                    <input type="text" id="eventType" class="form-control eventType" placeholder="Enter event type" aria-label="" required="required">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="" class="pt-3">Start Date</label>
                                    <input type="datetime-local" id="dateOfEvent" class="form-control dateOfEvent" aria-label="" required="required">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="" class="pt-3">End Date</label>
                                    <input type="datetime-local" id="endOfEventDate" class="form-control endOfEventDate" aria-label="" required="required">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="" class="pt-3">Event Category</label>
                                    <input type="text" id="eventCategory" class="form-control eventCategory" placeholder="Enter event category" aria-label="" required="required">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="" class="pt-3">No. of Participants Required </label>
                                    <input type="number" id="noOfParticipants" class="form-control noOfParticipants" placeholder="Enter number of participants required" aria-label="">
                                </div>
                            </div>  
                        </div> 
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="" class="pt-3">Maximum Number of Tickets </label>
                                    <input type="number" id="MaximumTickets" class="form-control MaximumTickets" placeholder="Enter number of tickets" aria-label="" required="required">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="" class="pt-3">Ticket Charges (Per Ticket) </label>
                                    <input type="number" id="ticket-charges" class="form-control ticket-charges" placeholder="Enter ticket charges, per ticket" aria-label="" required="required">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="" class="pt-3">Event Venue </label>
                                    <input type="text" id="EventVenue" class="form-control EventVenue" placeholder="Enter event venue" aria-label="" required="required">
                                </div>
                            </div> 
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="" class="pt-3">Event Venue </label>
                                    <input type="text" id="EventVenueAddress" class="form-control EventVenueAddress" placeholder="Enter event venue address" aria-label="" required="required">
                                </div>
                            </div> 
                        </div>
                    </div>
                    <div class="contact-information">
                        <div class="card-header font-weight-bold">Point of Contact</div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="" class="pt-3">First Name</label>
                                    <input type="text" name="firstname" id="firstName" class="form-control firstName" placeholder="Enter first name" aria-label="">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="" class="pt-3">Last Name</label>
                                    <input type="text" name="lastname" id="lastName" class="form-control lastName" placeholder="Enter last name" aria-label="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="" class="pt-3">Primary Contact Number</label>
                                    <input type="text" id="primaryContactNumber" class="form-control primaryContactNumber" placeholder="Enter primary contact number" aria-label="">
                                </div>
                            </div> 
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="" class="pt-3">Secondary Contact Number</label>
                                    <input type="text" id="secondaryContactNumber" class="form-control secondaryContactNumber" placeholder="Enter secondary contact number" aria-label="">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="" class="pt-3">Personal Contact Email</label>
                                    <input type="text" id="personalContactEmail" class="form-control personalContactEmail" placeholder="Enter personal contact email" aria-label="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="" class="pt-3">Organization (If applicable)</label>
                                    <input type="text" id="organizationName" class="form-control organizationName" placeholder="Enter organization name" aria-label="">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="" class="pt-3">Organization Contact Email</label>
                                    <input type="text" id="organizationContactEmail" class="form-control organizationContactEmail" placeholder="Enter organization contact email" aria-label="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="contact-information">
                        <div class="card-header font-weight-bold">Theme</div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="" class="pt-3">Theme of Event</label>
                                <textarea class="form-control themeOfEvent" name="" id="themeOfEvent" rows="2" placeholder="Enter theme of event" required="required"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="" class="pt-3">Additional Event Caption</label>
                                <textarea class="form-control additionalEventCaption" name="" id="additionalEventCaption" rows="4" placeholder="Enter additional information for the event"></textarea>
                            </div>
                        </div>
                        <div class="col-12 submit-btn">
                            <div class="form-group">
                                <button type="button" id="createEventSubmitBtn" class="btn btn-primary create-event-submit-btn w-25 createEventSubmitBtn waiter-btn">Create Event </button>
                            </div> 
                        </div>
                    </div>  
                </div>
            </form>
        </div>
    </div> 
    <!-- Content Row --> 
</div>