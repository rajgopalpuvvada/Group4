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


class ClientsController extends SP
{  
    public $page;

    public function __construct()
    {
        $this->page = new Page();

        AuthMiddleware::AuthView();
    } 

    public function fetch_clients(Request $request)
    {
        try {
            $post =  json_decode($request->get->data, true);

            $first_name = $post['first_name'];
            $last_name = $post['last_name'];
            $contact_email = $post['contact_email']; 
            $organization = $post['organization'];
            $org_contact_email = $post['org_contact_email'];
            $date_created_at = $post['date_created_at']; 

            $date_created_at = isset($date_created_at) 
            ? new DateTime('' . str_replace("/", "-", isset($date_created_at) 
            ? $date_created_at
            : '') . '') 
            : NULL; 

            $date_created_at = $date_created_at->format('Y-m-d');
            
            $serve = new Serve(ClientModel::$table);

            $filters = array(); 

            $response = $serve->query_by_condition($filters); 

            $clients_array = array();

            foreach ($response as $UKey => $Clients) {
                $dateofevent = new DateTime($Clients['created_at']);
                $dateofevent = $dateofevent->format('Y-m-d');
                
                $date_of_attending = (isset($date_of_attending)) 
                    ?   $date_of_attending 
                    :   date("Y-m-d");

                if ($dateofevent >= $date_of_attending) {
                    array_push($clients_array, $Clients);
                }
            }

            $this->serve_json(['success' => true, 'data' => $clients_array]);
        } catch (\Throwable $th) {
            $this->serve_json(['error' => true, 'message' => "Oops, An Unexpected error!"]); 
        }
    }
}