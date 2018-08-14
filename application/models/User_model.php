<?php

Class User_model extends CI_Model{


        function login($data){

            $result = $this->db->get_where('users',array('email'=>$data['email'],'password'=>md5($data['password'])))->row_array();
                if(!empty($result)){
                    $token = genRandomString(10);
                    $date = date('Y-m-d H:i:s');
                    $new_date = date("Y-m-d H:i:s", strtotime('+4 hours', strtotime($date)));
                    $insertData = array(
                                        'user_id'=>$result['id'],
                                        'token'=>$token,
                                        'expires_in'=>$new_date,
                                        'added_on'=>date('Y-m-d H:i:s')
                                    );
                    $this->db->insert('users_has_token',$insertData);
                    $response = array('success'=>true,'msg'=>'Login SuccessFully','result'=>$token);

                }else{
                    $response = array('success'=>false,'msg'=>'Invalid Credentials','result'=>'');
                }

                return $response;

        }


}