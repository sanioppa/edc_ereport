<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model
{
    
    /**
     * This function used to check the login credentials of the user
     * @param string $email : This is email of the user
     * @param string $password : This is encrypted password of the user
     */
    function loginMe($username, $password)
    {
        $this->db->select('BaseTbl.id_user, BaseTbl.password, BaseTbl.name, BaseTbl.username, BaseTbl.level, BaseTbl.outlet, BaseTbl.foto');
        //$this->db->join('tbl_outlet as Outlet','Outlet.kode_outlet = BaseTbl.outlet');
        $this->db->from('tbl_users as BaseTbl');
        //$this->db->join('pegawai as Peg','Peg.nip = BaseTbl.nip');
        $this->db->where('BaseTbl.username', $username);
        //$this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();
        
        $user = $query->result();
        
        if(!empty($user)){
            if(verifyHashedPassword($password, $user[0]->password)){
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }

    /**
     * This function used to check email exists or not
     * @param {string} $email : This is users email id
     * @return {boolean} $result : TRUE/FALSE
     */
    function checkUsernameExist($username)
    {
        $this->db->select('userId');
        $this->db->where('username', $username);
        //$this->db->where('isDeleted', 0);
        $query = $this->db->get('tbl_users');

        if ($query->num_rows() > 0){
            return true;
        } else {
            return false;
        }
    }


    /**
     * This function used to insert reset password data
     * @param {array} $data : This is reset password data
     * @return {boolean} $result : TRUE/FALSE
     */
    function resetPasswordUser($data)
    {
        $result = $this->db->insert('tbl_reset_password', $data);

        if($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * This function is used to get customer information by email-id for forget password email
     * @param string $email : Email id of customer
     * @return object $result : Information of customer
     */
    function getCustomerInfoByUsername($username)
    {
        $this->db->select('id_user, username, name');
        $this->db->from('tbl_users');
        //$this->db->where('isDeleted', 0);
        $this->db->where('username', $username);
        $query = $this->db->get();

        return $query->result();
    }

    /**
     * This function used to check correct activation deatails for forget password.
     * @param string $email : Email id of user
     * @param string $activation_id : This is activation string
     */
    function checkActivationDetails($username, $activation_id)
    {
        $this->db->select('id');
        $this->db->from('tbl_reset_password');
        $this->db->where('username', $username);
        $this->db->where('activation_id', $activation_id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    // This function used to create new password by reset link
    function createPasswordUser($username, $password)
    {
        $this->db->where('username', $username);
        //$this->db->where('isDeleted', 0);
        $this->db->update('tbl_users', array('password'=>getHashedPassword($password)));
        $this->db->delete('tbl_reset_password', array('username'=>$username));
    }
}

?>
