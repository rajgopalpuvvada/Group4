
class App {
    constructor() {
        this.route = undefined;
        this.method = undefined;
        this.action = undefined;
        this.urlParams = undefined; 

        this.events_filters_form = document.querySelector('.manage-events-filters-form');
    }

    alert_popup(type, title) {
        swal({
          type: type,
          title: title,
          showCloseButton: true,
          showCancelButton: false,
          focusConfirm: true,
          confirmButtonText: 'OK'
        });
    } 

    changeurl(url, title) {
        var new_url = '/' + url;
        window.history.pushState('data', title, new_url);
        
    }

    setUpDashboard() {
        const accordionSidebar = document.getElementById('accordionSidebar'); 

        if (document.body.contains(accordionSidebar)) {
            accordionSidebar.addEventListener('click', event => {
                const target = event.target; 
                if (target.hasAttribute('route-path')) {  
                    
                    const route_path = target.getAttribute("route-path"); 
                    
                    sessionStorage.setItem("route", route_path);

                    const route_path_element = document.querySelector(`.${route_path}`) 
                        ?   document.querySelector(`.${route_path}`)
                        :   document.getElementById(route_path); 

                    const fluids = document.querySelectorAll('.fluid'); 
                
                    fluids.forEach(fluid => {
                        if (document.body.contains(fluid)) {
                            if (!fluid.classList.contains('close-route')) {
                                fluid.classList.add("close-route"); 
                            }
                        }
                    }); 
        
                    if (document.body.contains(route_path_element)) {
                        if (route_path_element.classList.contains("close-route")) { 
                            route_path_element.classList.remove("close-route");
                            
                            if (sessionStorage.getItem('route') == 'manage-all-users') {
                                this.manage_users();
                            }
                            else if (sessionStorage.getItem('route') == 'manage-all-events' || 
                                sessionStorage.getItem('route') == 'create-tickets') {
                                this.manage_events();
                            }
                            else if (sessionStorage.getItem('route') == 'manage-all-clients') {
                                this.manage_clients();
                            }
                            else if (sessionStorage.getItem('route') == 'manage-all-tickets') {
                                this.manage_tickets();
                            }
                        }  
                    } 
                }
            });
        }

        if (sessionStorage.getItem('route')) {
            const sessioned_route_path = document.getElementById(`${sessionStorage.getItem('route')}`); 
            if (document.body.contains(sessioned_route_path)) {
                sessioned_route_path.click(); 
            } 
        }

        this.BtnSettings();
    }

    BtnSettings() {
        const Btns = document.querySelectorAll('.btn');
        
        Btns.forEach(btn => {
            btn.addEventListener('click', event => {
                const target = event.target;

                target.innerHTML = "Please wait...";
            });
        });
    }

    DelDomElementsRecursively(element) {  
        var child = element.lastElementChild; 
        while (child) {
            element.removeChild(child);
            child = element.lastElementChild;
        }
    } 

    verify_inputs_contains_value(inputs = []) {
        
        const elements = []
            
        inputs.forEach(input => {
            if (document.body.contains(input)) {
                if (input.hasAttribute('required')) { 
                    if (input.value.length == 0) {
                        elements.push(input)
                    }
                }
            }
        }); 

        if (elements.length > 0) { 
            return false;
        }
        
        return true
    }

    clear_input_values(inputs) {
        inputs.forEach(element => {
            element.value = '';
        });
    }

    createEvent() {
        const createEventBtn = document.getElementById('createEventSubmitBtn');
        if (document.body.contains(createEventBtn)) {
            createEventBtn.addEventListener('click', event => {
                event.preventDefault();

                const createEventForm = document.querySelector('.create-event-form');
                const inputs = createEventForm.querySelectorAll('.form-control'); 

                if (this.verify_inputs_contains_value(inputs) == true) { 
                    this.method = "POST";
                    this.action = "/events/create";

                    let data = {
                        eventName: createEventForm.querySelector('.eventName').value,
                        eventType: createEventForm.querySelector('.eventType').value,
                        eventCategory: createEventForm.querySelector('.eventCategory').value,
                        noOfParticipants: createEventForm.querySelector('.noOfParticipants').value,
                        maximumTickets: createEventForm.querySelector('.MaximumTickets').value,
                        ticket_charges: createEventForm.querySelector('.ticket-charges').value,
                        eventVenue: createEventForm.querySelector('.EventVenue').value,
                        EventVenueAddress: createEventForm.querySelector('.EventVenueAddress').value,
                        dateOfEvent: createEventForm.querySelector('.dateOfEvent').value,
                        endOfEventDate: createEventForm.querySelector('.endOfEventDate').value,
                        PocFirstName: createEventForm.querySelector('.firstName').value,
                        PocLastName: createEventForm.querySelector('.lastName').value,
                        primaryContactNumber: createEventForm.querySelector('.primaryContactNumber').value,
                        secondaryContactNumber: createEventForm.querySelector('.secondaryContactNumber').value,
                        personalContactEmail: createEventForm.querySelector('.personalContactEmail').value,
                        organizationName: createEventForm.querySelector('.organizationName').value,
                        organizationContactEmail: createEventForm.querySelector('.organizationContactEmail').value,
                        themeOfEvent: createEventForm.querySelector('.themeOfEvent').value,
                        additionalEventCaption: createEventForm.querySelector('.additionalEventCaption').value
                    }; 

                    this.urlParams = `data=${JSON.stringify(data)}`;

                    const response = this.server_request(this.method, this.action, this.urlParams);
                    this.handle_server_response_promise(response);
                }
                else {
                    createEventBtn.innerHTML = "Create Event";
                }
            });
        }
    }

    handle_create_event_request_response(response) {
        const createEventBtn = document.getElementById('createEventSubmitBtn');
        var response = JSON.parse(response);

        if (response.success) {
            this.alert_popup("success", response.message); 

            const createEventForm = document.querySelector('.create-event-form');
            const inputs = createEventForm.querySelectorAll('.form-control'); 
            this.clear_input_values(inputs);
        }
        else {
            this.alert_popup("error", response.message);
        } 

        createEventBtn.innerHTML = "Create Event";
    }

    create_clients() {
        const create_client_btn = document.getElementById('createClientsubmitBtn');

        if (document.body.contains(create_client_btn)) { 
            create_client_btn.addEventListener('click', event => {
                event.preventDefault();
    
                const create_clients_form = document.querySelector('.clients_registration_form');
                const inputs = create_clients_form.querySelectorAll('.form-control');
    
                if (this.verify_inputs_contains_value(inputs) == true) { 
                    this.method = "POST";
                    this.action = "/clients/create";
                    const data = {
                        first_name: create_clients_form.querySelector('.firstName').value,
                        last_name: create_clients_form.querySelector('.lastName').value,
                        contact_phone: create_clients_form.querySelector('.ContactNumber').value,
                        contact_email: create_clients_form.querySelector('.personalContactEmail').value,
                        organization_name: create_clients_form.querySelector('.organizationName').value,
                        organization_email_address: create_clients_form.querySelector('.organizationContactEmail').value,
                        personal_home_address: '',
                        authentication_mode: create_clients_form.querySelector('.authentication_mode').value,
                    }
                    this.urlParams = `data=${JSON.stringify(data)}`;
    
                    const response = this.server_request(this.method, this.action, this.urlParams);
                    this.handle_server_response_promise(response);
                }
                else {
                    this.alert_popup("error", "Please fill in all the fields!");
                }
            });
        }
        
    }

    handle_create_client_request_response(response) {
        const create_client_btn = document.getElementById('createClientsubmitBtn');
        var response = JSON.parse(response);

        if (response.success) {
            this.alert_popup("success", response.message); 

            const create_clients_form = document.querySelector('.create-client-form');
            const inputs = create_clients_form.querySelectorAll('.form-control');
            this.clear_input_values(inputs);
        }
        else {
            this.alert_popup("error", response.message);
        } 

        create_client_btn.innerHTML = "Create Client";
    }

    create_system_users() {
        const create_user_btn = document.getElementById('createUsersubmitBtn');

        if (document.body.contains(create_user_btn)) { 
            create_user_btn.addEventListener('click', event => {
                event.preventDefault();

                const create_users_form = document.querySelector('.create-user-form');
                const inputs = create_users_form.querySelectorAll('.form-control');

                if (this.verify_inputs_contains_value(inputs) == true) { 
                    this.method = "POST";
                    this.action = "/users/create";
                    const data = {
                        username: create_users_form.querySelector('.username').value,
                        contact_phone: create_users_form.querySelector('.ContactNumber').value,
                        contact_email: create_users_form.querySelector('.personalContactEmail').value,
                        password: create_users_form.querySelector('.password').value,
                        authentication_mode: create_users_form.querySelector('.authentication_mode').value, 
                    }
                    this.urlParams = `data=${JSON.stringify(data)}`;

                    const response = this.server_request(this.method, this.action, this.urlParams);
                    this.handle_server_response_promise(response);
                }
                else {
                    this.alert_popup("error", "Please fill in all the fields!");
                }
            });
        }
    }

    handle_create_system_users_request_response(response) {
        const create_user_btn = document.getElementById('createUsersubmitBtn');
        var response = JSON.parse(response);

        if (response.success) {
            this.alert_popup("success", response.message); 

            const create_users_form = document.querySelector('.create-user-form');
            const inputs = create_users_form.querySelectorAll('.form-control');
            this.clear_input_values(inputs);
        }
        else {
            this.alert_popup("error", response.message);
        } 

        create_user_btn.innerHTML = "Create User";
    }

    set_authenticaion_settings() {
        const createauthubmitBtn = document.getElementById('createauthubmitBtn');

        if (document.body.contains(createauthubmitBtn)) { 
            createauthubmitBtn.addEventListener('click', event => {
                event.preventDefault();

                const authentication_settings_form = document.querySelector('.authentication-settings-form');
                const inputs = authentication_settings_form.querySelectorAll('.form-control');

                if (this.verify_inputs_contains_value(inputs) == true) { 
                    this.method = "POST";
                    this.action = "/auth/authentication-settings";
                    const data = {
                        job_reg_number: authentication_settings_form.querySelector('.job-registration-number').value, 
                    }
                    this.urlParams = `data=${JSON.stringify(data)}`;

                    const response = this.server_request(this.method, this.action, this.urlParams);
                    this.handle_server_response_promise(response);
                }
                else {
                    this.alert_popup("error", "Please fill in all the fields!");
                }
            });
        }
    }
    
    handle_set_authentication_settings_request_response(response) {
        const createauthubmitBtn = document.getElementById('createauthubmitBtn');
        var response = JSON.parse(response);

        if (response.success) {
            this.alert_popup("success", response.message); 

            const authentication_settings_form = document.querySelector('.authentication-settings-form');
            const inputs = authentication_settings_form.querySelectorAll('.form-control');
            this.clear_input_values(inputs);
        }
        else {
            this.alert_popup("error", response.message);
        } 

        createauthubmitBtn.innerHTML = "Create Job Reg Number";
    } 

    manage_users() {
        const manage_users_filter_form = document.querySelector('.manage-users-filters-form');
        
        const input_fields = manage_users_filter_form.querySelectorAll('.form-control');
 
        input_fields.forEach(input_field => {
            input_field.addEventListener('change', () => {
                // console.log(`input with id, ${input.id}, changed its value`);
                this.manage_users();
            });
        });

        this.method = "POST";
        this.action = "/users/get-users";
        
        const data = {
            jobRegNo: manage_users_filter_form.querySelector('.jobRegNo').value,
            username: manage_users_filter_form.querySelector('.username').value,
            email: manage_users_filter_form.querySelector('.email').value, 
            contact_phone: manage_users_filter_form.querySelector('.contact-phone').value,
            user_creation_date: manage_users_filter_form.querySelector('.user-creation-date').value, 
        } 
        
        this.urlParams = `data=${JSON.stringify(data)}`;

        const response = this.server_request(this.method, this.action, this.urlParams);
        this.handle_server_response_promise(response);
    }

    handle_fetch_users_request_response(response) { 
        if (response) {
            var response = JSON.parse(response);
            console.log(response) 

            const manage_users_content_area = document.querySelector('.manage-users-content'); 

            var manage_users_table = $('.manage-users-table').DataTable({
                data: response.data,
                columns: [
                    { data: 'jobRegNo', title: 'Job Reg No.' },
                    { data: 'username', title: 'Username' },
                    { data: 'email', title: 'Email Address' },
                    { data: 'whoami', title: 'Authentication Mode' },
                    { data: 'created_at', title: 'Created at' },
                    { 
                        data: null, 
                        title: 'Action', 
                        render: function(data, type, full) {
                            // console.log(data)
                            return `<div class="btn-group">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu">
                                            <button type="button" class="btn btn-secondary btn-sm dropdown-item delete-user" id="${data.id}">Delete</button>
                                            <button type="button" class="btn btn-secondary btn-sm dropdown-item update-user" id="${data.id}">Update</button>
                                            <button type="button" class="btn btn-secondary btn-sm dropdown-item block-user" id="${data.id}">Block</button>
                                        </div>
                                    </div>`;
                        } 
                    }, 
                ],
                order: [[1, 'desc']],
                destroy: true,
            });
        }  
    }

    delete_user() {  
        // code...
    }

    //function to write actual data of a table row
    rowDataGet (id) {
        console.log(id);
    }

    manage_events() {  
        const create_ticket_select_event_modal_btn = document.querySelector('.create-ticket-select-event-modal-btn');

        create_ticket_select_event_modal_btn.addEventListener('click', event => {
            event.preventDefault(); 

            const EventsModal = document.querySelector('.EventsModal');  
            this.events_filters_form = EventsModal.querySelector('.modal-select-events-filters-form'); 

            this.manage_events();
        });   
        
        const input_fields = this.events_filters_form.querySelectorAll('.form-control');
 
        input_fields.forEach(input_field => {
            input_field.addEventListener('change', () => { 
                this.manage_events();
            });
        });

        this.method = "POST";
        this.action = "/events/get-events";
        
        const data = { 
            eventName: this.events_filters_form.querySelector('.eventName').value,
            eventType: this.events_filters_form.querySelector('.eventType').value,
            eventVenue: this.events_filters_form.querySelector('.eventVenue').value, 
            event_creation_date: this.events_filters_form.querySelector('.event-creation-date').value,
            date_of_attending: this.events_filters_form.querySelector('.date-of-attending').value, 
        } 
        
        this.urlParams = `data=${JSON.stringify(data)}`;

        const response = this.server_request(this.method, this.action, this.urlParams);
        this.handle_server_response_promise(response);
    }

    handle_fetch_events_request_response(response) { 
        if (response) {
            var response = JSON.parse(response);
            // console.log(response) 
            var events_table = undefined; 
            var columns = undefined;

            if (sessionStorage.getItem('route') == 'manage-all-events') {
                events_table = 'manage-events-table';
                columns = [
                    { data: 'eventName', title: 'Event Name' },
                    { data: 'eventType', title: 'Event Type' },
                    { data: 'eventCategory', title: 'Categpry' },
                    { data: 'noOfParticipants', title: 'No of Participants' },
                    { data: 'maximumTickets', title: 'Ticket Count' },
                    { data: 'ticket_charges', title: 'Total T.Amount' },
                    { data: 'eventVenue', title: 'Event Venue' },
                    { data: 'EventVenueAddress', title: 'Event Venue Address' },
                    { data: 'dateOfEvent', title: 'Date of Events' },
                    { data: 'endOfEventDate', title: 'End of Event Date' },
                    { data: 'PocFirstName', title: 'First Name' },
                    { data: 'PocLastName', title: 'Last Name' },
                    { data: 'primaryContactNumber', title: 'Primary Contact Number' },
                    { data: 'secondaryContactNumber', title: 'Secondary Contact Number' },
                    { data: 'personalContactEmail', title: 'Personal Contact Number' },
                    { data: 'organizationName', title: 'Org. Name' },
                    { data: 'organizationContactEmail', title: 'Org. Contact Email' },
                    { data: 'themeOfEvent', title: 'Theme of Event.' },
                    { data: 'additionalEventCaption', title: 'About Event' },
                    { 
                        data: null, 
                        title: 'Action',  
                        render: function(data, type, full) {
                            // console.log(data)
                            return `<div class="btn-group">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu">
                                            <button type="button" class="btn btn-secondary btn-sm dropdown-item delete-event" id="${data.id}">Delete</button>
                                            <button type="button" class="btn btn-secondary btn-sm dropdown-item update-event" id="${data.id}">Update</button>
                                            <button type="button" class="btn btn-secondary btn-sm dropdown-item block-event" id="${data.id}">Block</button>
                                        </div>
                                    </div>`;
                        } 
                    }, 
                ]
            }
            else {
                events_table = 'select-events-table';
                columns = [
                    { data: 'eventName', title: 'Event Name' },
                    { data: 'eventType', title: 'Event Type' }, 
                    { data: 'noOfParticipants', title: 'No of Participants' },
                    { data: 'dateOfEvent', title: 'Attending Date' },
                    { 
                        data: null, 
                        title: 'Action',  
                        render: function(data, type, full) {
                            // console.log(data)
                            return `<div class="btn-group">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu">
                                            <button type="button" class="btn btn-secondary btn-sm dropdown-item font-weight-bold select-event" id="${data.id}">Select</button> 
                                        </div>
                                    </div>`;
                        } 
                    }, 
                ]
            }

            $(`.${events_table}`).DataTable({
                data: response.data,
                initComplete: function(settings, data) { 
                    (new App()).select_event(settings.oInit.data);
                },
                columns: columns,
                order: [[3, 'asc']],
                destroy: true,
            });
        }  
    }

    manage_clients() {
        const manage_clients_filter_form = document.querySelector('.manage-clients-filters-form');
        
        const input_fields = manage_clients_filter_form.querySelectorAll('.form-control');
 
        input_fields.forEach(input_field => {
            input_field.addEventListener('change', () => { 
                this.manage_events();
            });
        });

        this.method = "POST";
        this.action = "/clients/get-clients";
        
        const data = { 
            first_name: manage_clients_filter_form.querySelector('.first_name').value,
            last_name: manage_clients_filter_form.querySelector('.last_name').value,
            contact_email: manage_clients_filter_form.querySelector('.contact_email').value, 
            organization: manage_clients_filter_form.querySelector('.organization').value,
            org_contact_email: manage_clients_filter_form.querySelector('.org_contact_email').value,
            date_created_at: manage_clients_filter_form.querySelector('.date_created_at').value
        } 
        
        this.urlParams = `data=${JSON.stringify(data)}`;

        const response = this.server_request(this.method, this.action, this.urlParams);
        this.handle_server_response_promise(response);
    }

    handle_fetch_clients_request_response(response) { 
        if (response) {
            var response = JSON.parse(response); 

            $('.manage-clients-table').DataTable({
                data: response.data,
                initComplete: function(settings, data) {   
                    (new App()).clients_management(settings.oInit.data);
                },
                columns: [
                    { data: 'first_name', title: 'First Name' },
                    { data: 'last_name', title: 'Last Name' },
                    { data: 'contact_phone', title: 'Contact Phone' },
                    { data: 'contact_email', title: 'Personal Email Address' },
                    { data: 'organization_name', title: 'Organization Name' },
                    { data: 'organization_email_address', title: 'Organization Contact Email' }, 
                    { 
                        data: null, 
                        title: 'Action',
                        render: function(data, type, full) {
                            // console.log(data) 

                            if (data) {
                                return `<div class="btn-group">
                                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu">
                                                <button type="button" class="btn btn-secondary btn-sm dropdown-item create-ticket-btn" id="${data.id}" route="create-tickets-nav">Create Ticket</button>
                                                <button type="button" class="btn btn-secondary btn-sm dropdown-item delete-client" id="${data.id}">Delete</button>
                                                <button type="button" class="btn btn-secondary btn-sm dropdown-item update-client" id="${data.id}" data-toggle="modal" data-target="#updateClientModal${data.id}">Update</button> 
                                            </div>
                                        </div>
                                        <!-- Modal -->
                                        <div class="modal fade pb-5 update-client-modal-${data.id}" data-backdrop="false" id="updateClientModal${data.id}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Update Client</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Content Row --> 
                                                        <div class="update-clients-form">
                                                            <div class="container">
                                                                <form class="update-client-form border border-info rounded pb-5 update_clients_registration_form">
                                                                    <div class="container"> 
                                                                        <div class="contact-information">
                                                                            <div class="card-header font-weight-bold">Personal Information</div>
                                                                            <div class="row">
                                                                                <div class="col">
                                                                                    <div class="form-group">
                                                                                        <label for="" class="pt-3">First Name</label>
                                                                                        <input type="text" name="firstname" id="firstName" class="form-control firstName" placeholder="Enter first name" value="${data.first_name}" aria-label="firstName" required="required">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col">
                                                                                    <div class="form-group">
                                                                                        <label for="" class="pt-3">Last Name</label>
                                                                                        <input type="text" name="lastname" id="lastName" class="form-control lastName" placeholder="Enter last name" value="${data.last_name}" aria-label="lastName" required="required">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-6">
                                                                                    <div class="form-group">
                                                                                        <label for="" class="pt-3">Contact Number</label>
                                                                                        <input type="text" id="ContactNumber" class="form-control ContactNumber" placeholder="Enter contact number" value="${data.contact_phone}" aria-label="ContactNumber" required="required">
                                                                                    </div>
                                                                                </div> 
                                                                                <div class="col-6">
                                                                                    <div class="form-group">
                                                                                        <label for="" class="pt-3">Personal Contact Email</label>
                                                                                        <input type="text" id="personalContactEmail" class="form-control personalContactEmail" placeholder="Enter personal contact email" value="${data.contact_email}" aria-label="personalContactEmail" required="required">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col">
                                                                                    <div class="form-group">
                                                                                        <label for="" class="pt-3">Organization <small>(If applicable)</small></label>
                                                                                        <input type="text" id="organizationName" class="form-control organizationName" placeholder="Enter organization name" value="${data.organization_name}" aria-label="organizationName">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col">
                                                                                    <div class="form-group">
                                                                                        <label for="" class="pt-3">Organization Contact Email <small>(If applicable)</small></label>
                                                                                        <input type="text" id="organizationContactEmail" class="form-control organizationContactEmail" placeholder="Enter organization contact email" value="${data.organization_email_address}" aria-label="organizationContactEmail">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                                    <div class="form-group">
                                                                                        <label for="" class="pt-3">Grant Authentication Type</label>
                                                                                        <select class="form-control authentication_mode" name="authentication_mode" id="authentication_mode" value="${data.authentication_mode}">
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
                                                                                <button type="button" id="updateClientsubmitBtn" data-id="${data.id}" class="btn btn-primary float-right update-client-submit-btn w-25">Update Client</button>
                                                                            </div> 
                                                                        </div>  
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div> 
                                                        <!-- Content Row -->
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>`; 
                            }
                        }  
                        
                    }, 
                ],
                order: [[5, 'asc']], 
                destroy: true,
            });  
        }   
    }   

    clients_management(data = []) {
        const manage_clients_table_area = document.querySelector('.manage-clients-content');
        const accordionSidebar = document.getElementById('accordionSidebar'); 

        manage_clients_table_area.addEventListener('click', event => {
            event.preventDefault();  
            if (event.target.classList.contains('delete-client')) {
                const row_id = event.target.id;  
                this.method = "POST";
                this.action = "/clients/delete-client";
                this.urlParams = `rowId=${row_id}`; 
                const response = this.server_request(this.method, this.action, this.urlParams);
                this.handle_server_response_promise(response); 
            } else if (event.target.classList.contains('update-client')) { 
                this.method = "POST";
                this.action = "/clients/update-client"; 
                const row_id = event.target.id; 

                const update_clients_form = document.querySelector(`.update-client-modal-${row_id}`);
                const inputs = update_clients_form.querySelectorAll('.form-control');
                const updateClientsubmitBtn = update_clients_form.querySelector('.update-client-submit-btn');

                updateClientsubmitBtn.addEventListener('click', event => { 
                    event.preventDefault();

                    updateClientsubmitBtn.innerHTML = "Please wait...";
                    const row_id = event.target.getAttribute('data-id');  

                    if (this.verify_inputs_contains_value(inputs) == true) {  
                        const data = {
                            row_id: row_id,
                            first_name: update_clients_form.querySelector('.firstName').value,
                            last_name: update_clients_form.querySelector('.lastName').value,
                            contact_phone: update_clients_form.querySelector('.ContactNumber').value,
                            contact_email: update_clients_form.querySelector('.personalContactEmail').value,
                            organization_name: update_clients_form.querySelector('.organizationName').value,
                            organization_email_address: update_clients_form.querySelector('.organizationContactEmail').value,
                            personal_home_address: '',
                            authentication_mode: update_clients_form.querySelector('.authentication_mode').value,
                        }
    
                        this.urlParams = `data=${JSON.stringify(data)}`;
        
                        const response = this.server_request(this.method, this.action, this.urlParams);
                        this.handle_server_response_promise(response);
                    }
                    else {
                        this.alert_popup("error", "Please fill in all the fields!");
                    } 
                }); 
            } else if (event.target.classList.contains('create-ticket-btn')) {  
                const clicked_element = event.target;
                const row_id = clicked_element.id;  
                var clicked_row_data = undefined;
                
                data.forEach(row => {
                    if (row.id == row_id) {
                        clicked_row_data = row;
                    }
                });

                if (clicked_row_data) { 
                    const route = clicked_element.getAttribute('route');   

                    const route_path_element = accordionSidebar.querySelector(`.${route}`); 
                    const create_ticket_form = document.querySelector('.create-ticket-form');
                    const fields = create_ticket_form.querySelectorAll('.form-control');

                    clicked_element.innerHTML = "Please wait...";

                    fields.forEach(element => {
                        if (!element.parentElement.classList.contains("disable_off")) {
                            element.disabled = true;
                        } 
                    });

                    create_ticket_form.querySelector('.firstName').value = clicked_row_data.first_name;
                    create_ticket_form.querySelector('.lastName').value = clicked_row_data.last_name;
                    create_ticket_form.querySelector('.clientId').value = row_id;

                    route_path_element.click();
                } 

                clicked_element.innerHTML = "Create ticket"; 
            } 
        }); 
    } 

    select_event(events_obj = []) {
        const EventsModal = document.querySelector('.EventsModal');  
        const events_table_area = EventsModal.querySelector('.select-events-table');
        const create_ticket_select_event_modal_btn = document.querySelector('.create-ticket-select-event-modal-btn');

        events_table_area.addEventListener('click', event => {
            event.preventDefault();
            const target = event.target; 
            const target_id = target.id; 

            var event_selected = undefined; 
            events_obj.forEach(row => {
                if (row.id == target_id) {
                    event_selected = row;
                }
            });

            if (event_selected) {
                EventsModal.querySelector('.close-events-modal').click();
                // console.log(event_selected);
                const create_ticket_form = document.querySelector('.create-ticket-form'); 
                const ticketCharge = create_ticket_form.querySelector('.ticketCharge'); 
                ticketCharge.value = event_selected.ticket_charges

                const NoOfTicketsField = create_ticket_form.querySelector('.MaximumTickets');
                const create_ticket_submit_btn = create_ticket_form.querySelector('.create-ticket-submit-btn');
                NoOfTicketsField.disabled = false;
                create_ticket_submit_btn.disabled = false;

                
                var gross_ticket_amount = parseInt((NoOfTicketsField.value.length > 0) 
                        ? NoOfTicketsField.value 
                        : 1
                    ) * parseInt((event_selected.ticket_charges) 
                        ? event_selected.ticket_charges 
                        : ticketCharge.value,
                    );  

                NoOfTicketsField.addEventListener('change', event => { 
                    gross_ticket_amount = parseInt((NoOfTicketsField.value.length > 0) 
                            ? NoOfTicketsField.value 
                            : 1
                        ) * parseInt((event_selected.ticket_charges) 
                            ? event_selected.ticket_charges 
                            : ticketCharge.value
                        ); 
                    
                    if (NoOfTicketsField.value.length == 0) {
                        NoOfTicketsField.value = 1;
                    }

                    create_ticket_form.querySelector('.ticketCharges').value = gross_ticket_amount; 
                }) ;

                create_ticket_form.querySelector('.ticketCharges').value = gross_ticket_amount;

                const SelectedEventName = create_ticket_form.querySelector('.SelectedEventName');
                SelectedEventName.value = event_selected.eventName;
                SelectedEventName.id = event_selected.id;
                create_ticket_select_event_modal_btn.innerHTML = "Choose Event";  
            }
        });
    }

    create_ticket_func() {
        const create_ticket_form = document.querySelector('.create-ticket-form');
        const create_ticket_submit_btn = create_ticket_form.querySelector('.create-ticket-submit-btn');
            
        create_ticket_submit_btn.addEventListener('click', event => {
            event.preventDefault(); 
            
            this.method = "POST";
            this.action = "/tickets/create-ticket";
            
            const data = { 
                first_name: create_ticket_form.querySelector('.firstName').value,
                last_name: create_ticket_form.querySelector('.lastName').value,
                client_id: create_ticket_form.querySelector('.clientId').value, 
                event_id: create_ticket_form.querySelector('.SelectedEventName').id, 
                SelectedEventName: create_ticket_form.querySelector('.SelectedEventName').value,
                MaximumTickets: create_ticket_form.querySelector('.MaximumTickets').value,
                ticketCharges: create_ticket_form.querySelector('.ticketCharges').value,
                payment_method: create_ticket_form.querySelector('.payment_method').value,
            } 
            
            this.urlParams = `data=${JSON.stringify(data)}`;

            const response = this.server_request(this.method, this.action, this.urlParams);
            this.handle_server_response_promise(response);
        });
    }

    handle_create_ticket_func_request_response(response) {
        var response = JSON.parse(response);
        const create_ticket_form = document.querySelector('.create-ticket-form');
        const create_ticket_submit_btn = create_ticket_form.querySelector('.create-ticket-submit-btn');

        if (response.success) {  
            const accordionSidebar = document.getElementById('accordionSidebar'); 
            const ticket_layout_container = document.querySelector('.tickets-layout-container')
            const ticket_layout_div = document.querySelector('.ticket-layout-div');

            // console.log(response.response);
            ticket_layout_div.innerHTML = response.response;

            const route = accordionSidebar.querySelector('.ticket-layout-nav');

            route.click();
            
            setTimeout(() => {  
                const ticket_print_btn = ticket_layout_div.querySelector('.ticket-print-btn');
                ticket_print_btn.style.display = 'block';

                ticket_print_btn.addEventListener('click', e => {
                    e.preventDefault();

                    printJS({
                        printable: 'ticket-html', 
                        type: 'html',
                        style: `
                            @import url("https://fonts.googleapis.com/css?family=Roboto:300,400");  
                            .contenido {
                                margin: 30px auto;
                                max-height: 930px;
                                max-width: 300px;
                                overflow: hidden;
                                box-shadow: 0 0 10px rgb(202, 202, 204); 
                                border-radius: 2px; 
                            }
                            .contenido .details {
                                padding-left: 5px;
                                width: 100%;
                                background:white;
                                border-top: 1px dashed #c3c3c3; 
                            }
                            .contenido .tinfo {
                                font-size: 0.5em;
                                font-weight: 300;
                                color: #c3c3c3;
                                font-family: "Roboto", sans-serif;
                                text-transform: uppercase;
                                letter-spacing: 1px;
                                margin: 7px 0;
                            }
                        
                            .contenido .tdata {
                                font-size: 0.7em;
                                font-weight: 400;
                                font-family: "Roboto", sans-serif;
                                letter-spacing: 0.5px;
                                margin:7px 0;
                                width: 100%;
                            }
                        
                            .contenido .name {
                                font-size: 1.0em;
                                font-weight: 300;
                            }
                        
                            .contenido .link {
                                text-align: center;
                                margin-top:10px;
                            }
                        
                            .contenido a {
                                text-decoration: none;
                                color:#55C9E6;  
                                font-weight: 400;
                                font-family: "Roboto", sans-serif;
                                letter-spacing: 0.7px;
                                font-size: 0.7em;
                            }
                            .contenido .hqr{
                                display: table;
                                width: 100%;
                                table-layout: fixed;
                                margin: 0px auto;
                            }
                            .contenido .left-one{
                                background-repeat: no-repeat;
                                background-image: radial-gradient(circle at 0 96% , rgba(0,0,0,0) .2em, gray .3em, white .1em);
                            }
                            .contenido .right-one{
                                background-repeat: no-repeat;
                                background-image: radial-gradient(circle at 100% 96% , rgba(0,0,0,0) .2em, gray .3em, white .1em);
                            }
                            .contenido .column
                            {
                                display: table-cell;
                                padding: 37px 0px;
                            }
                            .contenido .center{
                                background:white;
                            }
                        
                            .contenido #qrcode img{
                                height:70px;
                                width:70px;
                                margin: 0 auto;
                            }
                            .contenido .masinfo{
                                display:block;
                            }
                            .contenido .left,.right{
                                width:49%;
                                display:inline-table;
                            }
                        
                            .contenido .nesp{
                                letter-spacing: 0px;
                            }
                        `
                    });
                }) 
            }, 3000); 

            this.alert_popup("success", response.message); 
        }
        else {
            this.alert_popup("error", response.message);
        } 

        create_ticket_submit_btn.innerHTML = "Create Ticket";
    }

    handle_client_management_request_response (response) { 
        var response = JSON.parse(response); 

        if (response.success) {
            this.manage_clients();
            this.alert_popup("success", response.message); 
        }
        else {
            this.alert_popup("error", response.message);
        }  
    } 

    manage_tickets() {
        const manage_tickets_filter_form = document.querySelector('.manage-tickets-filters-form');
        
        const input_fields = manage_tickets_filter_form.querySelectorAll('.form-control');
 
        input_fields.forEach(input_field => {
            input_field.addEventListener('change', () => { 
                this.manage_tickets();
            });
        });

        this.method = "POST";
        this.action = "/tickets/get-tickets";
        
        const data = { 
            eventName: manage_tickets_filter_form.querySelector('.eventName').value,
            eventType: manage_tickets_filter_form.querySelector('.eventType').value,
            eventVenue: manage_tickets_filter_form.querySelector('.eventVenue').value, 
            ticket_creation_date: manage_tickets_filter_form.querySelector('.ticket-creation-date').value,
            username: manage_tickets_filter_form.querySelector('.username').value,
            email: manage_tickets_filter_form.querySelector('.email').value,
            contact_phone: manage_tickets_filter_form.querySelector('.contact-phone').value,
            client_creation_date: manage_tickets_filter_form.querySelector('.client-creation-date').value,
            date_of_attending: manage_tickets_filter_form.querySelector('.date-of-attending').value,
        } 
        
        this.urlParams = `data=${JSON.stringify(data)}`;

        const response = this.server_request(this.method, this.action, this.urlParams);
        this.handle_server_response_promise(response);
    }

    handle_manage_tickets_request_response(response) {
        if (response !== undefined) {
            var response = JSON.parse(response);

            console.log(response);
            $('.manage-tickets-table').DataTable({
                data: response.data,
                columns: [
                    { data: 'ticketId', title: 'Ticket ID' },
                    { data: 'eventName', title: 'Event' },
                    { data: 'eventCategory', title: 'Category' },
                    { data: 'MaximumTickets', title: 'Max. No. Tickets' },
                    { data: 'ticket_charges', title: 'Amount Per Ticket' },
                    { data: 'ticketCharges', title: 'Ticket Gross Amount' },
                    { data: 'payment_method', title: 'Payment Method' },
                    { data: 'eventVenue', title: 'Venue' },
                    { data: 'EventVenueAddress', title: 'Venue Address' },
                    { data: 'dateOfEvent', title: 'Date of Event' },
                    { data: 'endOfEventDate', title: 'End Date' },
                    { data: 'PocFirstName', title: 'Organizer First Name' },
                    { data: 'PocLastName', title: 'Organizer Last Name' },
                    { data: 'primaryContactNumber', title: 'Organizer`s Contact' },
                    { data: 'personalContactEmail', title: 'Organizer`s Email Address' },
                    { 
                        data: null, 
                        title: 'Action', 
                        render: function(data, type, full) {
                            // console.log(data)
                            return `<div class="btn-group">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu">
                                            <button type="button" class="btn btn-secondary btn-sm dropdown-item delete-ticket" id="${data.id}">Delete</button>
                                            <button type="button" class="btn btn-secondary btn-sm dropdown-item update-ticket" id="${data.id}">Update</button>
                                            <button type="button" class="btn btn-secondary btn-sm dropdown-item suspend-ticket" id="${data.id}">Suspend</button>
                                        </div>
                                    </div>`;
                        } 
                    }, 
                ],
                order: [[1, 'desc']],
                destroy: true,
            });
        }
    }

    /**
    * server requests are done by this script.
    * 
    * @param :method - request method to be applied
    *        :action - action url to be used to perform the request
    *        :urlParams - url parameters to be passed 
    * @return promise
    */
    async server_request(method, action, urlParams = null) {
        let server_response_promise = await new Promise(resolve => {
            let xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    const server_response = {
                        responseText: (this.responseText) 
                            ? this.responseText
                            : undefined,
                        responseURL: (this.responseURL) 
                            ? this.responseURL
                            : undefined
                    }
                    
                    resolve(server_response); 
                }
            }
            xhttp.open(method, action, true); 
            if (urlParams instanceof FormData) { 
                xhttp.setRequestHeader("Content-type", "multipart/form-data; boundary=----webko2354645675756"); //"application/x-www-form-urlencoded"
            }
            else {
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            } 
            xhttp.setRequestHeader("Accept-Language", "*"); 
            xhttp.send(urlParams);
        }); 

        return server_response_promise;
    }

    handle_server_response_promise(response) {
        response.then(response => { 
            this.handle_server_responses(response);
        });
    }
  
    handle_server_responses(response) {   
        this.responseText = response.responseText;
        this.responseURL = response.responseURL;  

        if (this.responseURL.includes("/events/create")) {
            this.handle_create_event_request_response(this.responseText);
        }
        else if (this.responseURL.includes("/clients/create")) {
            this.handle_create_client_request_response(this.responseText);
        }
        else if (this.responseURL.includes("/users/create")) {
            this.handle_create_system_users_request_response(this.responseText);
        }
        else if (this.responseURL.includes("/auth/authentication-settings")) {
            this.handle_set_authentication_settings_request_response(this.responseText);
        }
        else if (this.responseURL.includes("/users/get-users")) {
            this.handle_fetch_users_request_response(this.responseText);
        }
        else if (this.responseURL.includes("/events/get-events")) {
            this.handle_fetch_events_request_response(this.responseText);
        }
        else if (this.responseURL.includes("/clients/get-clients")) {
            this.handle_fetch_clients_request_response(this.responseText);
        }
        else if (this.responseURL.includes("/clients/delete-client")) {
            this.handle_delete_client_request_response(this.responseText);
        }
        else if (this.responseURL.includes("/clients/update-client")) {
            this.handle_client_management_request_response(this.responseText);
        }
        else if (this.responseURL.includes("/tickets/create-ticket")) {
            this.handle_create_ticket_func_request_response(this.responseText);
        }
        else if (this.responseURL.includes("/tickets/get-tickets")) {
            this.handle_manage_tickets_request_response(this.responseText);
        }
        else {
            console.log(`Dummy Response on ${this.responseURL}: ${this.responseText}`);
        } 
    } 
}

document.addEventListener('DOMContentLoaded', () => {
    const app = new App();

    app.setUpDashboard();
    app.createEvent();
    app.create_clients();
    app.create_system_users();
    app.set_authenticaion_settings();
    app.create_ticket_func();

    if (sessionStorage.getItem('route') == 'ticket-layout-area') {
        const accordionSidebar = document.getElementById('accordionSidebar'); 
        const manage_clients_route = accordionSidebar.querySelector('.manage-clients-route');

        manage_clients_route.click();
    }

    if ((sessionStorage.getItem('route') == 'authentication-settings') 
        && parseInt((document.getElementById('authentication-settings').getAttribute("auth")) !== 1)) {
        const accordionSidebar = document.getElementById('accordionSidebar'); 
        const manage_clients_route = accordionSidebar.querySelector('.manage-clients-route');

        manage_clients_route.click();
    }
});
















