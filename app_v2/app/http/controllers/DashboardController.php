<?php
use SelfPhp\Request;
use SelfPhp\SP;
use SelfPhp\Page;
use SelfPhp\Auth;
use SelfPhp\Serve;
use App\http\middleware\AuthMiddleware;
use App\models\DashboardModel;  
use App\services\MailerService; 
use App\http\utils\EventUtil;

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
}
