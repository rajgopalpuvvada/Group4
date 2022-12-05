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
use GuzzleHttp\Client;

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

    public function update_clients(Request $request) {   
        $post = json_decode($request->get->data, true);

        $row_id = $post['row_id'];
        $data['first_name'] = $post['first_name'];
        $data['last_name'] = $post['last_name'];
        $data['contact_phone'] = $post['contact_phone'];
        $data['contact_email'] = $post['contact_email'];
        $data['organization_name'] = $post['organization_name'];
        $data['organization_email_address'] = $post['organization_email_address'];
        $data['address'] = $post['personal_home_address'];
        $data['authentication_mode'] = $post['authentication_mode'];

        $client_util = new ClientUtil(ClientModel::$table);

        if (count($data) > 0) {
            $serve_response = $client_util->update_on_condition($data, [
                'id =' => $row_id
            ]);

            if ($serve_response == true) {
                $this->serve_json(['success' => true, 'response' => $serve_response, 'message' => "Successfully updated Client details. To create tickets, go to create page!"]);
            }
            else {
                $this->serve_json(['error' => true, 'response' => $serve_response, 'message' => "Unsuccessfully Updated Client Detail, retry again!"]);
            }
        }
        else {
            $this->serve_json(['error' => true, 'response' => $serve_response, 'message' => "Most of the fields cannot be empty.!"]);
        }
    }

    public function delete_clients(Request $request) {
        try{
            $rowId = $request->get->rowId;
            $client_util = new ClientUtil(ClientModel::$table);
            
            $delete_query = $client_util->TrashBasedOnId($rowId);

            $this->serve_json(['success' => true, 'data' => $rowId, 'message' => 'Client deletion success!']);
        }
        catch (\Throwable $th) {
            $this->serve_json(['error' => true, 'message' => "Oops, An Unexpected error!"]); 
        }
    }
}