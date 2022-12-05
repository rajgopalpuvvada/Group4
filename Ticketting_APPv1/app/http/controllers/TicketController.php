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
use App\models\TicketModel;
use App\services\MailerService; 
use App\http\utils\EventUtil;
use App\http\utils\ClientUtil;
use App\http\utils\TicketUtil;
use \Com\Tecnick\Barcode\Barcode;

class TicketController extends SP
{  
    public $page;
    public $unique_tid;

    public function __construct()
    {
        $this->page = new Page();

        AuthMiddleware::AuthView();
    } 

    public function create_tickets(Request $request) {
        $post = json_decode($request->get->data, true);

        $data['first_name'] = $post['first_name'];
        $data['last_name'] = $post['last_name'];
        $data['client_id'] = $post['client_id'];
        $data['event_id'] = $post['event_id'];
        $data['SelectedEventName'] = $post['SelectedEventName'];
        $data['MaximumTickets'] = $post['MaximumTickets'];
        $data['ticketCharges'] = $post['ticketCharges'];
        $data['payment_method'] = $post['payment_method']; 

        $qr_code = $this->QrCodeGenerate();

        $data['ticket_qr_code'] = ($qr_code) ? $qr_code : null;

        $clients_util = new ClientUtil(ClientModel::$table);
        $client = $clients_util->query_by_condition([
            'id =' => $data['client_id']
        ])[0];

        $events_util = new EventUtil(EventModel::$table);
        $event = $events_util->query_by_condition([
            'id =' => $data['event_id']
        ])[0];
        
        try {
            $ticket_util = new TicketUtil(TicketModel::$table);

            $ticket = $this->ticket_html_build($data, $client, $event);
            
            $mailTicket = new MailerService(
                "TICKET FOR EVENT: " . $event['eventName'],
                $ticket,
                $client['contact_email'],
                env("MAIL_SOURCE_ADDRESS"),
                env("MAIL_SOURCE_ADDRESS_PASSWORD"),
                "Your Event Ticket",
                null,
                "Ticketting Tool, Events",
                null
            );   

            $mailTicket->php_mailer();

            if ($ticket || $mailTicket) {

                $info['ticketId'] = strtoupper("TID" . $this->unique_tid);
                $info['client_id'] = $data['client_id'];
                $info['event_id'] = $data['event_id'];
                $info['MaximumTickets'] = $data['MaximumTickets'];
                $info['ticketCharges'] = $data['ticketCharges'];
                $info['payment_method'] = $data['payment_method'];

                if ($ticket_util->save($info)) {
                    $this->serve_json(['success' => true, 'mail' => $mailTicket, 'response' => $ticket, 'message' => "You successfully sold a ticket!"]);
                }
                else {
                    $this->serve_json(['error' => true, 'message' => "Oops, the system experienced an error while trying to save the transaction!"]);
                } 
            }
            else {
                $this->serve_json(['error' => true, 'message' => "Oops, the system experienced an error while trying to save the transaction!"]);
            }
        } catch (\Throwable $th) { 
            $this->serve_json(['error' => true, 'message' => "Oops, the system experienced an error while trying to save the transaction!"]);
        }
    }

    public function QrCodeGenerate() {
        // Instantiate the library class
        $barcode = new Barcode();
        $dir = "./public/storage/qr-code/";
        
        // Directory to store barcode
        if (! is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        // data string to encode
        $this->unique_tid = strtoupper(uniqid());

        $source = 'Ticket ID: ' . 'TID' . $this->unique_tid;
        
        // ser properties
        $qrcodeObj = $barcode->getBarcodeObj('QRCODE,H', $source, - 16, - 16, 'black', array(
            - 2,
            - 2,
            - 2,
            - 2
        ))->setBackgroundColor('#f5f5f5');
        
        // generate qrcode
        $imageData = $qrcodeObj->getPngData(); 

        //store in the directory
        if (file_exists($dir . $this->unique_tid . '.png')) {
            unlink($dir . $this->unique_tid . '.png'); 
        } 

        file_put_contents($dir . $this->unique_tid . '.png', $imageData);
        
        //Output image to the browser
        return $dir . $this->unique_tid . '.png';
    }

    public function ticket_html_build($data, $client, $event) {
        return '
                <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
                <link rel="stylesheet" type="text/css" href="https://printjs-4de6.kxcdn.com/print.min.css">
                <link rel="stylesheet" type="text/css" href="./public/css/event-ticket.css">
                <div class="contenido" id="ticket-html">
                    <div class="ticket">
                        <div class="hqr">
                            <div class="column left-one"></div>
                                <div class="column center">
                                    <div id="qrcode">
                                        <center>
                                            <img src="'.$data['ticket_qr_code'].'" width="200px" height="200px">
                                        </center>
                                    </div>
                                </div>
                                <div class="column right-one"></div>
                            </div>
                        </div>
                        <div class="details">
                            <div class="tinfo">
                                Attendee
                            </div>
                            <div class="tdata name">
                                ' . ucfirst($data['first_name']) . ' ' . ucfirst($data['last_name']) . '
                            </div> 
                            <div class="masinfo">
                                <div class="left">
                                    <div class="tinfo">
                                        ticket
                                    </div>
                                    <div class="tdata nesp">
                                        '.ucfirst($event['eventCategory']).'
                                    </div>  
                                </div>
                                <div class="right">
                                    <div class="tinfo">
                                        event
                                    </div>
                                    <div class="tdata nesp">
                                        '.ucfirst($event['eventName']).'
                                    </div> 
                                </div> 
                            </div> 
                            <div class="masinfo">
                                <div class="left">
                                    <div class="tinfo">
                                        Ticket Amount
                                    </div>
                                    <div class="tdata nesp">
                                        ' . '$' . ucfirst($data['ticketCharges']).'
                                    </div>
                                </div>
                                <div class="right">
                                    <div class="tinfo">
                                        Payment Method
                                    </div>
                                    <div class="tdata nesp">
                                        '.ucfirst($data['payment_method']).'
                                    </div> 
                                </div> 
                            </div>
                            <div class="masinfo">
                                <div class="left">
                                    <div class="tinfo">
                                        date
                                    </div>
                                    <div class="tdata nesp">
                                        '.ucfirst($event['dateOfEvent']).'
                                    </div>  
                                </div>
                                <div class="right">
                                    <div class="tinfo">
                                        location
                                    </div>
                                    <div class="tdata nesp">
                                        '.ucfirst($event['EventVenueAddress']).'
                                    </div> 
                                </div> 
                            </div> 
                            <div style="margin-top: 10px; margin-bottom: 10px;">
                                <center>
                                    <small>
                                        Ticket ID: ' . 'TID' . ucfirst($this->unique_tid) . '
                                    </small>
                                </center>
                            </div>
                            <div class="link hidden-print-btn">
                                <a style="display: none; padding-bottom: 5rem" href="#" class="ticket-print-btn">Print</a>
                            </div>
                        </div>
                    </div>
                </div>';
    }

    public function fetch_tickets(Request $request)
    {
        try {
            $post =  json_decode($request->get->data, true);

            $eventName = $post['eventName'];
            $eventType = $post['eventType'];
            $eventVenue = $post['eventVenue']; 
            $ticket_creation_date = $post['ticket_creation_date'];
            $username = $post['username'];
            $email = $post['email'];
            $contact_phone = $post['contact_phone'];
            $client_creation_date = $post['client_creation_date'];
            $date_of_attending = $post['date_of_attending'];

            $ticket_creation_date = isset($ticket_creation_date) 
            ? new DateTime('' . str_replace("/", "-", isset($ticket_creation_date) 
            ? $ticket_creation_date
            : '') . '') 
            : NULL; 

            $ticket_creation_date = $ticket_creation_date->format('Y-m-d');

            $client_creation_date = isset($client_creation_date) 
            ? new DateTime('' . str_replace("/", "-", isset($client_creation_date) 
            ? $client_creation_date
            : '') . '') 
            : NULL; 

            $dateOfAttending = isset($date_of_attending) 
            ? new DateTime('' . str_replace("/", "-", isset($date_of_attending) 
            ? $date_of_attending
            : NULL) . NULL) 
            : NULL; 

            $date_of_attending = $dateOfAttending->format('Y-m-d');
            
            $serve = new TicketUtil(TicketModel::$table);

            $filters = array();

            $tickets_fetch_response = $serve->fetchAllTickets($filters);
            
            $tickets_array = array();
            foreach ($tickets_fetch_response as $TicketKey => $ticket) {
                $created_at = new DateTime($ticket['created_at']);
                $created_at = $created_at->format('Y-m-d');

                $dateOfEvent = new DateTime($ticket['dateOfEvent']);
                $dateOfEvent = $dateOfEvent->format('Y-m-d');
                
                if (!empty($ticket_creation_date) || !empty($date_of_attending)) {
                    if ($created_at == $ticket_creation_date) {
                        array_push($tickets_array, $ticket); 
                    } 
                    else if ($dateOfEvent == $date_of_attending) {
                        array_push($tickets_array, $ticket); 
                    }
                }
                else {
                    array_push($tickets_array, $ticket); 
                }
            } 

            if ($tickets_array) {
                $this->serve_json(['success' => true, 'data' => $tickets_array]);
            } 
        } catch (\Throwable $th) {
            $this->serve_json(['error' => true, 'message' => "Oops, An Unexpected error!"]); 
        }
    }
}