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
use \Com\Tecnick\Barcode\Barcode;

class TicketController extends SP
{  
    public $page;

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
        ]);

        $events_util = new EventUtil(EventModel::$table);
        $event = $events_util->query_by_condition([
            'id =' => $data['event_id']
        ]);

        $ticket = $this->ticket_html_build($data, $client[0], $event[0]);

        if ($ticket) {
            $this->serve_json(['success' => true, 'response' => $ticket, 'message' => "You successfully sold a ticket!"]);
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
        $unique_tid = strtoupper(uniqid());

        $source = 'Ticket ID: ' . 'TID' . $unique_tid;
        
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
        if (file_exists($dir . $unique_tid . '.png')) {
            unlink($dir . $unique_tid . '.png'); 
        } 

        file_put_contents($dir . $unique_tid . '.png', $imageData);
        
        //Output image to the browser
        return $dir . $unique_tid . '.png';
    }

    public function ticket_html_build($data, $client, $event) {
        return '
                <style>
                    @import url("https://fonts.googleapis.com/css?family=Roboto:300,400");
                    .contenido .float-left {
                        float:left;
                        width:300px;  
                    }
                    .contenido body {
                        background: url("https://unsplash.it/800/1200/?random");
                        background-size:cover;
                        background-color: gray;
                    }
                    .contenido .contenido {
                        margin: 30px auto;
                        max-height: 530px;
                        max-width: 500px;
                        overflow: hidden;
                        box-shadow: 0 0 10px rgb(202, 202, 204); 
                        border-radius: 2px;
                        border: 2px;
                    }
                    .contenido .details {
                        padding: 40px;
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
                        margin:7px 0;
                    }
                
                    .contenido .tdata {
                        font-size: 0.7em;
                        font-weight: 400;
                        font-family: "Roboto", sans-serif;
                        letter-spacing: 0.5px;
                        margin: 2px 0;
                    }
                
                    .contenido .name {
                        font-size: 1em;
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
                </style>
                <div class="contenido">
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
                            <div class="link">
                                <a style="padding-bottom: 5rem" href="#">Print</a>
                            </div>
                        </div>
                    </div>
                </div>';
    }

    public function fetch_tickets(Request $request)
    {
    }
}