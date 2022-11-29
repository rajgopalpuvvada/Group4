
class App {
    constructor() {
        this.route = undefined;
        this.method = undefined;
        this.action = undefined;
        this.urlParams = undefined;
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
                            else if (sessionStorage.getItem('route') == 'manage-all-events') {
                                this.manage_events();
                            }
                            else if (sessionStorage.getItem('route') == 'manage-all-clients') {
                                this.manage_clients();
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
                        eventName: document.getElementById('eventName').value,
                        eventType: document.getElementById('eventType').value,
                        eventCategory: document.getElementById('eventCategory').value,
                        noOfParticipants: document.getElementById('noOfParticipants').value,
                        dateOfEvent: document.getElementById('dateOfEvent').value,
                        endOfEventDate: document.getElementById('endOfEventDate').value,
                        firstName: document.getElementById('firstName').value,
                        lastName: document.getElementById('lastName').value,
                        primaryContactNumber: document.getElementById('primaryContactNumber').value,
                        secondaryContactNumber: document.getElementById('secondaryContactNumber').value,
                        personalContactEmail: document.getElementById('personalContactEmail').value,
                        organizationName: document.getElementById('organizationName').value,
                        organizationContactEmail: document.getElementById('organizationContactEmail').value,
                        themeOfEvent: document.getElementById('themeOfEvent').value,
                        additionalEventCaption: document.getElementById('additionalEventCaption').value
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
                                            <button type="button" class="btn btn-secondary btn-sm dropdown-item delete-user-${data.id}" id="delete-user-${data.id}">Delete</button>
                                            <button type="button" class="btn btn-secondary btn-sm dropdown-item update-user-${data.id}" id="update-user-${data.id}">Update</button>
                                            <button type="button" class="btn btn-secondary btn-sm dropdown-item block-user-${data.id}" id="block-user-${data.id}">Block</button>
                                        </div>
                                    </div>`
                        } 
                    }, 
                ],
                order: [[1, 'desc']],
                destroy: true,
            });
        }  
    }

    //function to write actual data of a table row
    rowDataGet (id) {
        console.log(id);
    }

    manage_events() {
        const manage_events_filter_form = document.querySelector('.manage-events-filters-form');
        
        const input_fields = manage_events_filter_form.querySelectorAll('.form-control');
 
        input_fields.forEach(input_field => {
            input_field.addEventListener('change', () => { 
                this.manage_events();
            });
        });

        this.method = "POST";
        this.action = "/events/get-events";
        
        const data = { 
            eventName: manage_events_filter_form.querySelector('.eventName').value,
            eventType: manage_events_filter_form.querySelector('.eventType').value,
            eventVenue: manage_events_filter_form.querySelector('.eventVenue').value, 
            event_creation_date: manage_events_filter_form.querySelector('.event-creation-date').value,
            date_of_attending: manage_events_filter_form.querySelector('.date-of-attending').value, 
        } 
        
        this.urlParams = `data=${JSON.stringify(data)}`;

        const response = this.server_request(this.method, this.action, this.urlParams);
        this.handle_server_response_promise(response);
    }

    handle_fetch_events_request_response(response) { 
        if (response) {
            var response = JSON.parse(response);
            console.log(response) 

            const manage_events_content_area = document.querySelector('.manage-events-content'); 

            $('.manage-events-table').DataTable({
                data: response.data,
                columns: [
                    { data: 'eventName', title: 'Event Name' },
                    { data: 'eventType', title: 'Event Type' },
                    { data: 'eventCategory', title: 'Categpry' },
                    { data: 'noOfParticipants', title: 'No of Participants' },
                    { data: 'dateOfEvent', title: 'Date of Events' },
                    { data: 'endOfEventDate', title: 'End of Event Date' },
                    { data: 'firstName', title: 'First Name' },
                    { data: 'lastName', title: 'Last Name' },
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
                        "defaultContent": 
                        ` 
                        <div class="btn-group">
                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                            </button>
                            <div class="dropdown-menu">
                                <button type="button" class="btn btn-secondary btn-sm dropdown-item delete-event">Delete</button>
                                <button type="button" class="btn btn-secondary btn-sm dropdown-item update-event">Update</button>
                                <button type="button" class="btn btn-secondary btn-sm dropdown-item block-event">Block</button>
                            </div>
                        </div>`
                    }, 
                ],
                order: [[5, 'asc']],
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
            console.log(response) 

            const manage_clients_content_area = document.querySelector('.manage-clients-content'); 

            $('.manage-clients-table').DataTable({
                data: response.data,
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
                        "defaultContent": 
                        ` 
                        <div class="btn-group">
                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                            </button>
                            <div class="dropdown-menu">
                                <button type="button" class="btn btn-secondary btn-sm dropdown-item create-ticket">Create Ticket</button>
                                <button type="button" class="btn btn-secondary btn-sm dropdown-item delete-client">Delete</button>
                                <button type="button" class="btn btn-secondary btn-sm dropdown-item update-client">Update</button> 
                            </div>
                        </div>`
                    }, 
                ],
                order: [[5, 'asc']],
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
    app.set_authenticaion_settings()
});
















