<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class admin_login_model extends MY_Model {

	protected $table = 'users';

	public function validate_login($username,$password) {
		$query = $this->db->where(['role_id' => '1', 'username' => $username, 'password' => md5($password)]);
		$account = $this->db->get($this->table)->row();
		if($account!=NULL) {
			return $account->id;
		}
		return NULL;
	}

	public function validate_login_with_username($username) {
		$query = $this->db->where(['role_id' => '1', 'username' => $username]);
		$account = $this->db->get($this->table)->row();
		if($account!=NULL) {
			return $account->id;
		}
		return NULL;
	}
}

