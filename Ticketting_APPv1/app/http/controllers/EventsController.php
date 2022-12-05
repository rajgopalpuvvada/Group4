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


class EventsController extends SP
{  
    public $page;

    public function __construct()
    {
        $this->page = new Page();

        AuthMiddleware::AuthView();
    } 

    public function fetch_events(Request $request)
    {
        
    }
}