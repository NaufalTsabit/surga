<?php

class UserAuth {

	public static function cek_authorize($ci_object) {
		$default_admin = array('admin/dashboard', 'admin/user', 'admin/departemen', 'admin/pengaturan');
		if ($ci_object->session->userdata('data_petugas')) $data_petugas = $ci_object->session->userdata('data_petugas');
		else if ($ci_object->session->userdata('petugas_stat')) $data_petugas = $ci_object->session->userdata('petugas_stat');
		else if ($ci_object->session->userdata('petugas_admin')) {
			$data_petugas = $ci_object->session->userdata('petugas_admin');
			foreach ($default_admin as $key => $value) {
				$pos = strpos($ci_object->uri->uri_string(), $value);
				if ($pos !== false) return true;
			}
		}
		if (!isset($data_petugas) || !$data_petugas) {
			redirect('logout');
		}
		foreach ($data_petugas['list_app'] as $key => $value) {
			$pos = strpos($ci_object->uri->uri_string(), $value['url_app']);
			if ($pos !== false) return true;
		}
		redirect('logout');
		exit();
	}
}

?>