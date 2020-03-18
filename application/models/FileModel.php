<?PHP 

class FileModel extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}

	public function getFiles() {
		return $this->db->get('files')->result_array();
	}

	public function removeFile($id) {
		$this->db->where('id',$id)->delete('files');
		return true;	
	}

	public function saveFile($fileName) {
		$this->db->insert('files',array('file_name'=>$fileName));
		return true;	
	}

	public function getImageDetails($id) {
		return $this->db->where('id',$id)->get('files')->result_array()[0];	
	}

	public function saveEditedFile($fileName,$id) {
		$this->db->where('id',$id)->update('files',array('file_name'=>$fileName));
		return true;	
	}
}

?>