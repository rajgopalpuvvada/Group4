<?php
use SelfPhp\Request;
use SelfPhp\SP;
use SelfPhp\Page;
use SelfPhp\Auth;
use SelfPhp\Serve;
use App\http\middleware\AuthMiddleware;
use App\models\DashboardModel; 
use App\models\ClientModel;
use App\models\EventModel;
use App\services\MailerService; 
use App\http\utils\EventUtil;
use App\http\utils\ClientUtil;


class DashboardController extends SP
{  
    public $page;

    public function __construct()
    {
        $this->page = new Page();

        AuthMiddleware::AuthView();
    }

    public function index()
    {
        $this->page->View("resources/views", "dashboard");
    }

    public function create_events(Request $request) {
        $post = json_decode($request->get->data, true);

        $data['eventName'] = $post['eventName'];
        $data['eventType'] = $post['eventType'];
        $data['eventCategory'] = $post['eventCategory'];
        $data['noOfParticipants'] = $post['noOfParticipants'];
        $data['dateOfEvent'] = $post['dateOfEvent'];
        $data['endOfEventDate'] = $post['endOfEventDate'];
        $data['firstName'] = $post['firstName'];
        $data['lastName'] = $post['lastName'];
        $data['primaryContactNumber'] = $post['primaryContactNumber'];
        $data['secondaryContactNumber'] = $post['secondaryContactNumber'];
        $data['personalContactEmail'] = $post['personalContactEmail'];
        $data['organizationName'] = $post['organizationName'];
        $data['organizationContactEmail'] = $post['organizationContactEmail'];
        $data['themeOfEvent'] = $post['themeOfEvent'];
        $data['additionalEventCaption'] = $post['additionalEventCaption']; 

        $EventUtil = new EventUtil(DashboardModel::$table);

        $response = $EventUtil->query_by_condition([
            'eventName =' => $data['eventName']
        ]);    
        
        if (count($response) == 0) {
            $serve = $EventUtil->save($data);
            if ($serve == true) {
                $this->serve_json(['success' => true, 'response' => $data, 'message' => "Successfully created and event, to create tickets, go to create page!"]);
            }
            else {
                $this->serve_json(['error' => true, 'response' => $data, 'message' => "Unsuccessfully saved an event, retry again!"]);
            }
        }
        else {
            $this->serve_json(['error' => true, 'response' => $data, 'message' => "Event already exists!"]);
        } 
    }

    public function create_clients(Request $request) {
        $post = json_decode($request->get->data, true);

        $data['first_name'] = $post['first_name'];
        $data['last_name'] = $post['last_name'];
        $data['contact_phone'] = $post['contact_phone'];
        $data['contact_email'] = $post['contact_email'];
        $data['organization_name'] = $post['organization_name'];
        $data['organization_email_address'] = $post['organization_email_address'];
        $data['address'] = $post['personal_home_address'];
        $data['authentication_mode'] = $post['authentication_mode'];

        $Client = new ClientUtil(ClientModel::$table);

        $response = $Client->query_by_condition([
            'contact_email =' => $data['contact_email']
        ]);

        if (count($response) == 0) {
            $serve = $Client->save($data);
            if ($serve == true) {
                $this->serve_json(['success' => true, 'response' => $data, 'message' => "Successfully registered a Client. To create tickets, go to create page!"]);
            }
            else {
                $this->serve_json(['error' => true, 'response' => $data, 'message' => "Unsuccessfully saved a Client Detail, retry again!"]);
            }
        }
        else {
            $this->serve_json(['error' => true, 'response' => $data, 'message' => "Client already exists!"]);
        }
    }

    public function fetch_events(Request $request)
    {
        try {
            $post =  json_decode($request->get->data, true);

            $eventName = $post['eventName'];
            $eventType = $post['eventType'];
            $eventVenue = $post['eventVenue']; 
            $event_creation_date = $post['event_creation_date'];
            $date_of_attending = $post['date_of_attending'];


            $EventCreationDate = isset($event_creation_date) 
            ? new DateTime('' . str_replace("/", "-", isset($event_creation_date) 
            ? $event_creation_date
            : '') . '') 
            : NULL; 

            $event_creation_date = $EventCreationDate->format('Y-m-d');

            $dateOfAttending = isset($date_of_attending) 
            ? new DateTime('' . str_replace("/", "-", isset($date_of_attending) 
            ? $date_of_attending
            : '') . '') 
            : NULL; 

            $date_of_attending = $dateOfAttending->format('Y-m-d');
            
            $serve = new Serve(EventModel::$table);

            $filters = array();

            // if (!empty($eventName)) {
            //     if (count($filters) == 0) {
            //         array_push($filters, 'eventName =' . $eventName);
            //     }
            //     else {
            //         array_push($filters, "or eventName =" . $eventName);
            //     }
            // }

            // if (!empty($eventType)) {
            //     if (count($filters) == 0) {
            //         array_push($filters, 'eventType =' . $eventType);
            //     }
            //     else {
            //         array_push($filters, "or eventType =" . $eventType);
            //     }
            // }

            // // if (!empty($eventVenue)) {
            // //     if (count($filters) == 0) {
            // //         array_push($filters, 'email =' . $eventVenue);
            // //     }
            // //     else {
            // //         array_push($filters, "or email =" . $eventVenue);
            // //     }
            // // }

            // if (!empty($event_creation_date)) {
            //     if (count($filters) == 0) {
            //         array_push($filters, 'created_at =' . $event_creation_date);
            //     }
            //     else {
            //         array_push($filters, "or created_at =" . $event_creation_date);
            //     }
            // }

            $response = $serve->query_by_condition($filters); 

            $events_array = array();

            foreach ($response as $UKey => $Events) {
                $dateofevent = new DateTime($Events['dateOfEvent']);
                $dateofevent = $dateofevent->format('Y-m-d');
                
                $date_of_attending = (isset($date_of_attending)) 
                    ?   $date_of_attending 
                    :   date("Y-m-d");

                if ($dateofevent >= $date_of_attending) {
                    array_push($events_array, $Events);
                }
            }

            $this->serve_json(['success' => true, 'data' => $events_array]);
        } catch (\Throwable $th) {
            $this->serve_json(['error' => true, 'message' => "Oops, An Unexpected error!"]); 
        }
    }
}
