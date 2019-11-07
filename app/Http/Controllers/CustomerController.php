<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\validation;
use Illuminate\Support\Facades\Mail;

use App\Customer;
use Session;
// use Socialite;
use Laravel\Socialite\Facades\Socialite;

// use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('registration/login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('registration/index');
    }

    public function home(Request $request)
    {
        // $this->$request->validate([
        //     'username' => 'required',
        //     'password' => 'required',
        // ]);
        // if ( empty($request->session()->get('user_id')) )
        // {
            // Session is not expire
            $name = $request->username;
            $pass = $request->password;
            $encrypt_pass =  base64_encode($pass);
            
            $name = strtolower($name); // convert upercase to lowercase 

            $username = array ();
            $email = array ();
            
            // check email format code
            if(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",$name))
            { 
                $username = Customer::where('username',$name)->where('password',$encrypt_pass)->get();
            }else{
                $email = Customer::where('email_address',$name)->where('password',$encrypt_pass)->get();
            }
            // end email format code     

            if ( count($username) > 0 || count($email) > 0 )
            {
                // putting data into session
                $request->session()->put('user_id',$name); // storing id into session
                return response()->json([
                    'success' => 'Go to welcome page login'
                ]); 
            }
            else
            {
                return response()->json([
                    'error' => 'Error: Invalid credentials .'
                ]);
            }
        // }
        // else
        // {
        //     // Session is expired
        //     $request->session()->flush();
        //     return response()->json([
        //         'error' => 'deleted all session'
        //     ]);
        // }    
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer = new customer();
        // Simple user registration
        // -------------------------------------------------------------------------
        // Simple user code
        //--------------------------------------------------------------------------
        // $this->$request->validate([
        //     'username' => 'required',
        //     'fname' => 'required',
        //     'lname' => 'required',
        //     'email' => 'required',
        //     'password' => 'required',
        // ]);

        $username = $request->username;
        $fname = $request->fname;
        $lname = $request->lname;
        $email_addr = $request->email;
        $password = $request->password;
        $veri_key = md5(time().$username); // email key 
        
        $case_insensitive_username = strtolower($username); // convert all capital letters to lower letters
        $case_insensitive_email_addr = strtolower($email_addr); // convert all capital letters to lower letters

        $encrypt_pass = base64_encode($password); # encrypting password

        $use = Customer::where('username',$username)->get();
        $ema = Customer::where('email_address',$email_addr)->get();
        if ( count($use) > 0 )
        {
            return response()->json([
                'error' => 'Username already exist.'
            ]);
        } 
        else if ( count($ema) > 0)
        {
            return response()->json([
                'error' => 'Email already exist.'
            ]);
        }
        else
        {
            // Store user data to database
            $customer = new customer();

            $customer->username = $username;
            $customer->first_name = $fname;
            $customer->last_name = $lname;
            $customer->email_address = $email_addr;
            $customer->password = $encrypt_pass;
            $customer->verification_key = $veri_key;
            $customer->verified_email = "0";
            $customer->block = "0";
            $customer->active = "1";
            $customer->save();
            // end of store user data to databse

            // Send Email code
            Mail::to($email_addr)->send(new validation($customer) );
            // end  email code

            return response()->json([
                'success' => 'Confirm your email address.'
            ]);
        }
        // -------------------------------------------------------------------------
        // end Simple user code
        //--------------------------------------------------------------------------
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }

    /**
     * List of all customers
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function ListCustomer(string $username, string $key)
    {
        //
        $customers = Customer::where('username',$username)->where('verification_key',$key)->first();
       
        if (!empty($customers) > 0)
        {
            $customers->verified_email = '1';
            $customers->save();
            return redirect('signin');
            // return ($customers);
        }
        else
        {
            return ('Error 404');
        }
        // return ($customers);
    }

    /**
     * Confirm username/emailaddress for forget password
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function ForgetPassword(Request $request)
    {   
        // $name = $request->user;
        $inpute_date = $request->input('user');
        
        $customer = new customer();
        // $email = array ();
        
        // check email format code
        // if(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",$name))        
        // {
        //     // user login with his username 
        //     $customer = Customer::where('username',$name)->first();
        //     if (!empty($customer))
        //     {
        //         Mail::to($customer->email_address)->send(new validation($customer) );

        //         return response()->json([
        //             'success' => 'A verification email has been sent to your email address.'
        //         ]);
        //     }
        //     else
        //     {
        //         return response()->json([
        //             'success' => 'incorrect credational'
        //         ]);
        //     }
            
        // }else{
            // user login with his email address
            $customer = Customer::where('email_address',$inpute_date)->first();
            if (!empty($customer))
            {
                Mail::to($customer->email_address)->send(new validation($customer) );
            
                return response()->json([
                    'success' => 'A verification email has been sent to your email address.'
                ]);
            }
            else
            {
                return response()->json([
                    'success' => 'incorrect credational'
                ]);
            }
        // }
    }

    /**
     * reset password 
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function ResetPassword(string $username, string $key)
    {
        return view ('registration/Forgetpassword/reset_password',['username'=>$username,'key'=>$key]);
    }

    public function UpdatePassword(string $username, string $key, string $pass)
    {
        $customers = Customer::where('username',$username)->where('verification_key',$key)->first();
       
        if (!empty($customers) > 0)
        {
            $encrypt_pass = base64_encode($pass); # encrypting password

            $customers->password = $encrypt_pass;
            $customers->save();
            return response()->json([
                'success' => 'A verification email has been sent to your email address.'
            ]);
        }
        else
        {
            return response()->json([
                'success' => 'incorrect credational.'
            ]);
        }
    }


    /**
     * Redirect the user to the google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($service)
    {
        return Socialite::driver($service)->redirect();
    }

    /**
     * Obtain the user information from google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(Request $request, $service)
    {
        $user = Socialite::driver($service)->stateless()->user();

        // $customer = new Customer();
        // Check if email already exist in db then go to welcom page
        $find_email = Customer::where('email_address',$user->getEmail())->first(); // Its not an array
        if ( !empty($find_email) )
        {
            if ($find_email->block == "1")
            {
                echo "Error: Current user has been blocked.";
            }
            else
            {
                if ( !empty($find_email->facebook_id) )
                {
                    $request->session()->put('user_id',$find_email->facebook_id); // storing id into session
                }
                else
                {
                    $request->session()->put('user_id',$find_email->gmail_id); // storing id into session
                }
                // $request->session()->put('user_id',$find_email->email_address); // storing id into session
                // echo "Welcome Page.";
                return redirect ('/');
            }
        }        
        else
        {
            // create new user
            $facebook_id = '';
            $gmail_id = '';
            if ($service == 'facebook')
            {
                // For facebook user
                $facebook_id = $user->getId();
            }
            else
            {
                // For Google User
                $gmail_id = $user->getId();
            }
            // store google user in db
            // $customer->first_name = $user->getName();
            // $customer->email_address = $user->getEmail();
            // $customer->token = $user->token;
            // $customer->token_expiry_date = $user->expiresIn;
            // $customer->verified_email = "1"; // verified email status
            // $customer->block = "0";
            // $customer->active = "1";
            // $customer->save();

            // return view ('registration/add_username',[
            //             'user_email_addr'=>$user->getEmail(),
            // ]);
            
            // echo session()->put('user_id', $user->getId() ); // storing id into session
            return view ('registration/add_username',[
                        'facebook_id'=>$facebook_id,
                        'gmail_id'=>$gmail_id,
                        'user_name'=>$user->getName(),
                        'user_email_addr'=>$user->getEmail(),
                        'user_token'=>$user->token,
                        'user_expire'=>$user->expiresIn
            ]);
        }
    }

    public function AddUsername (Request $request)
    {
        $customer = new customer();
        $username = $request->input('username');

        $user_facebook_id = $request->input('facebook');
        $user_google_id = $request->input('google');
        $user_fname = $request->input('fname');
        $user_email = $request->input('email');
        $user_token = $request->input('token');
        $user_expire = $request->input('expire');

        // if ( !empty($username) and !empty($user_fname) and !empty($user_email) and !empty($user_token) and !empty($user_expire) )
        if ( !empty($username) )        
        {
            // $email_found = Customer::where("email_address",$user_email)->first();
            if ( !empty($user_facebook_id) )
            {
                // Facebook user
                $customer->facebook_id = $user_facebook_id;
                $customer->username = $username;
                $customer->first_name = $user_fname;
                $customer->email_address = $user_email;
                $customer->token = $user_token;
                $customer->token_expiry_date = $user_expire;
                $customer->save();
                // Go to welcome page
                // $request->session()->put('user_id', $user->getId()); // storing id into session
                return response()->json([
                    'success' => 'Go to welcome page.'
                ]);
            }
            else
            {
                $customer->gmail_id = $user_google_id;
                $customer->username = $username;
                $customer->first_name = $user_fname;
                $customer->email_address = $user_email;
                $customer->token = $user_token;
                $customer->token_expiry_date = $user_expire;
                $customer->save();
                // Go to welcome page
                $request->session()->put('user_id', $user_google_id); // storing id into session
                return response()->json([
                    'success' => 'Go to welcome page.'
                ]);
            }
        }
        else
        {
            return response()->json([
                'error' => 'Invalid creditional.'
            ]);
        }   
    }

    /**
     * Clear all session and redirect to login
     *
     * @return \Illuminate\Http\Response
     */
    public function Logout(Request $request)
    {
        $request->session()->flush();
        return redirect ('/signup');
        // return ('Hello logout');
    }
    

}
