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
                                    <input type="text" id="eventName" class="form-control" placeholder="Enter event name" aria-label="First name" required="required">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="" class="pt-3">Event Type</label>
                                    <input type="text" id="eventType" class="form-control" placeholder="Enter event type" aria-label="First name" required="required">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-7">
                                <div class="form-group">
                                    <label for="" class="pt-3">Event Category</label>
                                    <input type="text" id="eventCategory" class="form-control" placeholder="Enter event category" aria-label="First name" required="required">
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="" class="pt-3">No. of Participants Required </label>
                                    <input type="number" id="noOfParticipants" class="form-control" placeholder="Enter number of participants required" aria-label="First name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="" class="pt-3">Start Date</label>
                                    <input type="datetime-local" id="dateOfEvent" class="form-control" aria-label="First name" required="required">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="" class="pt-3">End Date</label>
                                    <input type="datetime-local" id="endOfEventDate" class="form-control" aria-label="First name" required="required">
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
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="" class="pt-3">Primary Contact Number</label>
                                    <input type="text" id="primaryContactNumber" class="form-control" placeholder="Enter primary contact number" aria-label="First name">
                                </div>
                            </div> 
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="" class="pt-3">Secondary Contact Number</label>
                                    <input type="text" id="secondaryContactNumber" class="form-control" placeholder="Enter secondary contact number" aria-label="First name">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="" class="pt-3">Personal Contact Email</label>
                                    <input type="text" id="personalContactEmail" class="form-control" placeholder="Enter personal contact email" aria-label="First name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="" class="pt-3">Organization (If applicable)</label>
                                    <input type="text" id="organizationName" class="form-control" placeholder="Enter organization name" aria-label="First name">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="" class="pt-3">Organization Contact Email</label>
                                    <input type="text" id="organizationContactEmail" class="form-control" placeholder="Enter organization contact email" aria-label="First name">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="contact-information">
                        <div class="card-header font-weight-bold">Theme</div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="" class="pt-3">Theme of Event</label>
                                <textarea class="form-control" name="" id="themeOfEvent" rows="2" placeholder="Enter theme of event" required="required"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="" class="pt-3">Additional Event Caption</label>
                                <textarea class="form-control" name="" id="additionalEventCaption" rows="4" placeholder="Enter additional information for the event"></textarea>
                            </div>
                        </div>
                        <div class="col-12 submit-btn">
                            <div class="form-group">
                                <button type="button" id="createEventSubmitBtn" class="btn btn-primary create-event-submit-btn w-25">Create Event </button>
                            </div> 
                        </div>
                    </div>  
                </div>
            </form>
        </div>
    </div> 
    <!-- Content Row --> 
</div>