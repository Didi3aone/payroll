<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @ Class Model Dropdown
 * @ Update 22-06-2019
 */
class Dropdown_model extends CI_Model {

	/**
	 * (F) _getListRouter
	 * 
	 * @return Array
	 */
	public function _getListHotspot()
	{
		$conds = array();
		$this->db->select('hash_id, name');
		$this->db->from('tbl_router');
		$this->db->where('is_active', 1);
		$res = $this->db->get();

		#$this->db->last_query();exit();
		if ( $res->num_rows() > 0 ) 
		{
			foreach ($res->result_array() as $value) 
			{
				$conds[$value['hash_id']] = $value["name"];
			}
		}
		return $conds;
	}

	/**
	 * (F) _getListTypePaket
	 * @return Array $conds
	 */
	public function _getListTypePaket()
	{
		$conds = array();
		$this->db->select('code,name');
		$this->db->from('tbl_type_paket');
		$this->db->where('is_active',1);
		$res = $this->db->get();

		if( $res->num_rows() > 0)
		{
			$conds[''] = '-- Choose --';
			foreach ($res->result_array() as $value)
			{
				$conds[$value['code']] = $value["name"];
			}
		}
		return $conds;
	}

}

/* End of file Dropdown_model.php */
/* Location: ./application/models/Dropdown_model.php */