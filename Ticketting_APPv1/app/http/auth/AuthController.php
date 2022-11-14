<?php

use SelfPhp\Request;

use SelfPhp\SP;
use SelfPhp\Page;
use SelfPhp\Auth;
use SelfPhp\Serve;
use App\http\middleware\AuthMiddleware;
use App\models\AuthModel;
use App\models\SettingsModel;
use App\services\MailerService;
use App\http\utils\AppUtils;

class AuthController extends SP
{
    public $page;

    public function __construct()
    {
        $this->page = new Page();
    }

    public function login()
    {
        $this->page->View("resources/auth", "login");
    }

    public function signup()
    {
        $this->page->View("resources/auth", "register");
    }

    public function login_user(Request $request)
    {
        
        $serve = new Serve(AuthModel::$table);

        $data['email'] = $request->get->email;
        $data['password'] = $request->get->password;

        $user = $serve->get_user_on_condition(['email' => $data['email'], 'password' => $data['password']]);

        if (!empty($user)) {
            if ($user['email'] == $data['email']) {
                // ready for password verification 
                if (password_verify($data['password'], $user['password'])) {
                    Auth::start_session([
                        'user_id' => $user['id'], 
                        'username' => $user['username'], 
                        'email' => $user['email']
                    ]);
                    $this->page->navigate_to("dashboard", ["success" => "Login Success!"]);
                } else {
                    $this->page->navigate_to("login", ["error" => "Please check your username and password and try again!"]);
                }
            } else {
                $this->page->navigate_to("login", ["error" => "Please check your username and password and try again!"]);
            }
        } else {
            $this->page->navigate_to("login", ["error" => "No account associated with the email found!"]);
        }  
    
    }

    public function signup_user(Request $request)
    {
        $serve = new Serve(AuthModel::$table);

        if (isset($request->get->data)) {
            $post = json_decode($request->get->data, true);
            $data['jobRegNo'] = NULL;
            $data['username'] = (isset($request->get->username)
                ? $request->get->username
                : $post['username']
            );
            $data['email'] = (isset($request->get->email)
                ? $request->get->email
                : $post['contact_email']
            );
            $data['contact'] = (isset($request->get->tel)
                ? $request->get->tel
                : $post['contact_phone']
            );
            $data['password'] = Auth::hash_pass((isset($request->get->password)
                ? $request->get->password
                : $post['password']
            ));
            $data['whoami'] = (isset($request->get->authentication_mode)
                ? $request->get->authentication_mode
                : $post['authentication_mode']
            ); 
        }
        else {
            $data['jobRegNo'] = $request->get->jobRegNo;
            $data['username'] = $request->get->username;
            $data['email'] = $request->get->email;
            $data['contact'] = $request->get->tel;
            $data['password'] = Auth::hash_pass($request->get->password);  
     
            if (empty($data['jobRegNo'])) {
                $this->page->go_back("register", ["error" => "Oops, Please fill in all the fields!"]);
                exit();
            }
    
        }

        $response = $serve->query_by_condition([
            'jobRegNo =' => $data['jobRegNo']
        ]);

        if (count($response) == 0) {
            $this->page->go_back("register", [
                "error" => "Oops Registration error. Please check your registration number, should be active!"
            ]);
            exit();
        }
 
        $data['created_at'] = date("Y-m-d H:i:s");
        $data['updated_at'] = date("Y-m-d H:i:s");

        $exists = $serve->user_exists_on_condition(['email' => $data['email'], 'username' => $data['username']]);

        foreach ($data as $key => $value) {
            if (empty($value)) {
                unset($exists);
                if (isset($request->get->data)) {
                    $this->serve_json(['error' => true, 'message' => "Please fill in all the fields!"]);
                } 
                else {
                    $this->page->navigate_to("register", ["error" => "Please fill in all the fields!"]);
                }
            }
        }

        if ($exists == true) {
            if (isset($request->get->data)) {
                $this->serve_json(['error' => true, 'message' => "User is already registered. Register using a different email!"]);
            }
            else {
                $this->page->navigate_to("register", ["error" => "User is already registered. Register using a different email!"]);
            }
        } else {
            if (isset($request->get->data)) {
                if ($serve->save($data) == true) {
                    $this->serve_json(['success' => true, 'message' => "Registration success!"]);
                } else {
                    $this->serve_json(['error' => true, 'message' => "Server Error!"]); 
                }
            }
            else {
                if ($serve->save($data) == true) {
                    $this->page->navigate_to("login", ["success" => "Registration success!"]);
                } else {
                    $this->page->go_back("register", ["error" => "Server Error!"]);
                }
            }
        }
    }

    public function logout()
    {
        if (Auth::auth() == true) {
            if (Auth::boot_out() == true) {
                $this->page->go_back("login?#booted out");
            } else {
                $this->page->navigate_to("dashboard", ["error" => "System error when trying to log you out.!"]);
            }
        } else {
            $this->page->navigate_to("login?#booted out", ["error" => "Login required!"]);
        }
    }

    public function settings(Request $request) {
        $request = json_decode($request->get->data, true);

        $serve = new Serve(SettingsModel::$table);

        $response = $serve->query_by_condition([
            'job_reg_numbers =' => $request['job_reg_number']
        ]);

        $data['job_reg_numbers'] = $request['job_reg_number'];
        $data['created_at'] = date("Y-m-d H:i:s");
        $data['updated_at'] = date("Y-m-d H:i:s");

        if (count($response) == 0) {
            if ($serve->save($data) == true) {
                $this->serve_json(['success' => true, 'message' => "Registration success!"]);
            } else {
                $this->serve_json(['error' => true, 'message' => "Oops, An Unexpected error!"]); 
            }
        }
    }
}
