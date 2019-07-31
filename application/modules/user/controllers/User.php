<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package User
 * @license http://it-underground.web.id/licenses/MIT  MIT License
 * @author [didi triawan] <[<diditriawan13@gmail.com>]>
 * @link https://it-underground.web.id
 * @since [< payroll version 1.1 > juli-2019]
 */
class User extends MY_Controller {
    //sesuaikan kondisi path
    private $_view_folder = 'user/';

    public function __construct(){
        parent::__construct();
        // CEK LOGIN USER
        $this->_check_auth();
    }

    /**
	 * function index 
     * @author : didi
	 * @return void 
	 */
    public function index()
    {
        // Header
        $header = array(
            'title_tab' => 'User',
            'breadcrumb' => 'User',
            'breadcrumb_child' => 'User Administrator'
		);
		
		//get data user dari database
		$data_user = $this->Global_model->set_model('tbl_users','tu','id')->mode(array(
			'type' => GET_ALL_DATA,
			'select' => 'tur.name as role_name, tu.fullname, tu.email, tu.hash_id, tu.id, tu.status_login',
			'joined' => array(
				'tbl_users_role tur' => array(
					'tur.id' => 'tu.role_id'
				) 
            ),
            'conditions' => array(
                'tu.is_active' => ACTIVE
            )
		));

        // Body
        $data = array(
            'title_table' 		=> 'List User',
			'url_create' 		=> site_url('user/create'),
			'url_edit' 			=> site_url('user/edit/'),
			'datas'				=> $data_user
        );

		// Footer
		// cara pemanggilan file javascript seperti ini 
		// jika lebih dari 1 tgl , aja 
		// nanti di view akan otomatis terpenggil file yang sudah di definisikan 
		// disini
        $footer = array(
            'plugin_js' => 'assets/js/pages/user.js',
        );

        // Load views
        $this->_render_page_backend(
			$this->_view_folder."index", 
			$header, 
			$data, 
			$footer
		);
    }

    /**
	 * function create
	 * @return void 
	 */
    public function create()
    {
        // Header
        $header = array(
            'title_tab' => 'User',
            'breadcrumb' => 'User',
            'breadcrumb_child' => 'User Administrator'
		);

        // Body
        //passing parameter ke view
        $data = array(
            'title_form' => 'Form Create User',
            'url_back'   => site_url('user')
        );

        // Footer
		// cara pemanggilan file javascript seperti ini 
		// jika lebih dari 1 tgl , aja 
		// nanti di view akan otomatis terpenggil file yang sudah di definisikan 
		// disini
        $footer = array(
            'plugin_js' => 'assets/js/pages/user.js'
        );

        // Load views
        $this->_render_page_backend(
            $this->_view_folder."create",
            $header,
            $data,
            $footer
        );
    }

    /**
	 * function edit
	 * @return void 
	 */
    public function edit( $hash_id = null )
    {
        // Header
        $header = array(
            'title_tab' => 'Panel Admin',
            'breadcrumb' => 'Panel Admin',
            'breadcrumb_child' => 'Admin Management'
        );

        //get data user dari database
		$data_user = $this->Global_model->set_model('tbl_users','tu','id')->mode(array(
			'type' => SINGLE_ROW,
			'select' => 'tur.name as role, tur.id as role_id, tu.*',
			'joined' => array(
				'tbl_users_role tur' => array(
					'tur.id' => 'tu.role_id'
				) 
            ),
            'conditions' => array(
                'tu.hash_id' => $hash_id
            )
        ));
        
        //passing parameter ke view
        $data = array(
            'user'          => $data_user,
            'title_form'    => 'Form Edit User',
            'url_back'      => site_url('user')
        );

        //footer
        $footer = array(
            'plugin_js' => 'assets/js/pages/user.js'
        );

        // Load views
        $this->_render_page_backend(
            $this->_view_folder."create",
            $header,
            $data,
            $footer
        );
    }

    /**
	 * function process_form
     * @author : didi
	 * @return void 
	 */
    public function process_form()
    {
        //initial
        $message['is_error']       = true;
        $message['error_message']  = "";

        //decode parameter post
        $post_data  = $this->input->post();
        $id         = (isset($post_data['id'])) ? $post_data['id'] : "";
       
        // print_r($post_data);die;
        $check_name = $this->Global_model->set_model('tbl_users','tu','id')->mode(array(
            'type' => SINGLE_ROW,
            'conditions' => array(
                'tu.username' => $post_data['username']
            )
        ));

        $check_email = $this->Global_model->set_model('tbl_users','tu','id')->mode(array(
            'type' => SINGLE_ROW,
            'conditions' => array(
                'tu.email' => $post_data['email']
            )
        ));

        if( !empty($check_name) && empty($id) ) {
            $message['is_error']    = true;
            $message['error_msg']   = "Username already exists.";
            $this->output->set_content_type('application/json')->set_output(json_encode(
                $message
            ));
        } else if( !empty($check_email) && empty($id) ) {
            $message['is_error']    = true;
            $message['error_msg']   = "Email already exists.";
            $this->output->set_content_type('application/json')->set_output(json_encode(
                $message
            ));
        //end check
        } else {
            //begin transaction
            $this->db->trans_begin();

            //prepare save data
            $_save_data = array(
                'hash_id'   => generate_hash(($post_data['username'])) ,
                'fullname'  => isset($post_data['fullname']) ?  sql_injection($post_data['fullname'], "string") : "",
                'email'     => isset($post_data['email']) ?  sql_injection($post_data['email'], "string") : "",
                'username'  => isset($post_data['username']) ?  sql_injection($post_data['username'],"string") : "",
                'role_id'   => isset($post_data['role_id']) ?  sql_injection($post_data['role_id'],"numeric") : "",
            );

            $filename = $post_data['username']."-".uniqid().time();
            if(isset($_FILES['photo']) ){
                $upload_file = $this->upload_file(
                    "photo", 
                    $filename, 
                    false,
                    "assets/uploads/images/user",
                    $id
                );
            }

            if(!empty($upload_file)) {
                $_save_data['photo'] = $upload_file['uploaded_path'];
            }     

            //check id if null then insert
            if( $id == "" ) {
                //debug
                // print_array(
                // $post_data
                // );die;

                //isert other information
                $password = isset($post_data['password']) ?  $post_data['password'] : "";

                $_save_data['password'] = password_hash(
                    $password, PASSWORD_DEFAULT
                );

                $_save_data['created_at'] = NOW;
                $_save_data['created_by'] = set_session('username_login');
            
                //save to db.
                $result = $this->Global_model->set_model('tbl_users')->mode(array(
                    'type' => INSERTS,
                    'datas' => $_save_data
                ));

                //insert activity 
                $this->user_activity(
                    set_session('username_login'), 
                    "USER ADMIN", 
                    ACTIVITY_INSERT_DATA ." (".$post_data['username'].")"
                );

                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    $message['error_msg'] = 'database operation failed.';
                } else {
                    $this->db->trans_commit();
                    $message['is_error'] = false;
                    //success.
                    $message['notif_title']     = "Good!!!";
                    $message['notif_message']   = "New Admin has been added.";
                    $message['redirect']        = site_url("user");
                }
            } else {
                //debug
                // print_r(
                // $post_data
                // );die;
                $password = isset($post_data['password']) ?  $post_data['password'] : "";

                $_save_data['password'] = password_hash(
                    $password, PASSWORD_DEFAULT
                );

                //isert other information
                $_save_data['updated_at'] = NOW;
                $_save_data['updated_by'] = set_session('username_login');
            
                //save to db.
                $result = $this->Global_model->set_model('tbl_users')->mode(array(
                    'type' => UPDATES,
                    'datas' => $_save_data,
                    'conditions' => array(
                        'id' => $id
                    )
                ));

                // ini tambahan opsional
                // aktivitas user di masukin ke dalam table 
                //insert activity 
                $this->user_activity(
                    set_session('username_login'), 
                    "USER ADMIN", 
                    ACTIVITY_UPDATE_DATA ." (".$post_data['username'].")"
                );
                

                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    $message['error_msg'] = 'database operation failed.';

                } else {
                    $this->db->trans_commit();

                    $message['is_error'] = false;
                    //success.
                    //growler.
                    $message['notif_title']     = "Good!!!";
                    $message['notif_message']   = "Success updated admin";
                    $message['redirect']        = site_url("user");
                }
            }
        }
        
        //set output json
        $this->output->set_content_type('application/json')->set_output(json_encode(
            $message
        ));       
    }

    /**
     * delete
     * @author didi
     */
    public function delete()
    {
        $message['is_error']  = true;
        $message['error_msg'] = "";

        //get parameter hash_id
        $post_data  = $this->input->post();
        // print_r($post_data);die;
        if(!empty($post_data['id'])) {
            // print_r(set_session('id'));die;
            $get_data_user = $this->Global_model->set_model('tbl_users')->mode(array(
                'type' => SINGLE_ROW,
                'conditions' => array(
                    'id' => $post_data['id']
                )
            ));
            //check user logged
            if( set_session('id') == $post_data['id'] ) {
                $message['is_error']  = true;
                $message['error_msg'] = "Cannot delete the user who is currently logged in on the system";
                
                $this->output->set_content_type('application/json')->set_output(json_encode(
                    $message
                ));   
            } elseif( $get_data_user['status_login'] === "LOGIN") {
                $message['is_error']  = true;
                $message['error_msg'] = "Cannot delete the user who is currently logged";
                
                $this->output->set_content_type('application/json')->set_output(json_encode(
                    $message
                ));  
            } else {
                //update field status to 1 = CONNECTED
                $update_status = $this->Global_model->set_model('tbl_users')->mode(array(
                    'type' => DELETE_DATA,
                    'datas' => array(
                        'is_active' => NOTACTIVE
                    ),
                    'conditions' => array(
                        'id' => $post_data['id']
                    ),
                    'is_permanent' => false
                ));
    
                //insert activity 
                $this->user_activity(
                    set_session('username_login'), 
                    "USER ADMIN", 
                    ACTIVITY_DELETE_DATA ." (".$get_data_user['username'].")"
                );
                
                $message['is_error']  = false;
                $message['success_msg'] = "Success deleted user";
            }

        } else {
            $message['is_error']  = true;
            $message['error_msg'] = "Invalid ID.";
        }

        $this->output->set_content_type('application/json')->set_output(json_encode(
            $message
        ));
    }
}
/* End of file Router.php */