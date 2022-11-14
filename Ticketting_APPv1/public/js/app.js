
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
















