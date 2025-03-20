<?php 
class MainModel extends CI_Model
{
    protected $user = 'tms_user';
    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Load database
        // Load necessary libraries, helpers, or models if needed
    }

    // Example method to fetch data from a database table
  public function validateUser($email) {
    try {
        $query = $this->db->get_where($this->user, array('email' => $email));
        return $query->row();
    } catch (Exception $e) {
        log_message('error', 'Error fetching user: ' . $e->getMessage());
        return null;
    }
  }
  public function getAllTools() {
    try {
        $this->db->select('tms_tool.*, tms_tool_category.CategoryName');
        $this->db->from('tms_tool');
        $this->db->join('tms_tool_category', 'tms_tool.CategoryId = tms_tool_category.id', 'left');
        $query = $this->db->get();
        return $query->result();
    } catch (Exception $e) {
        log_message('error', 'Error fetching tools: ' . $e->getMessage());
        return null;
    }
  }

  public function getAllBorrowedTools(){
    
    try {
        $this->db->select('tms_tools_borrow.*, tms_tool.ToolName');
        $this->db->from('tms_tools_borrow');
        $this->db->join('tms_tool', 'tms_tools_borrow.ToolId = tms_tool.id', 'left');
        if($_SESSION['role'] != 1){
            $this->db->where('tms_tools_borrow.BorrowedBy', $_SESSION['username']);
        }
        $query = $this->db->get();
        return $query->result();
    } catch (Exception $e) {
        log_message('error', 'Error fetching tools: ' . $e->getMessage());
        return [];
    }
  }
  public function borrowTool($toolid, $barCode){

    try {
        $data = [
            'Username' => $_SESSION['username'],
            'ToolId' => $toolid,
            'ToolBarCode' => $barCode,
            'BorrowedDate' => date('Y-m-d'),
            'BorrowedBy' => $_SESSION['username']
        ];

       $result = $this->db->insert('tms_tools_borrow', $data);

       if($result){
        $this->db->set('isBorrowed', 1);
        $this->db->where('id', $toolid);
        $this->db->where('BarcodeId', $barCode);
        $update = $this->db->update('tms_tool');
       }

        return $update;
    } catch (Exception $e) {
        log_message('error', 'Error updating tool: ' . $e->getMessage());
        return 0;
    }   
  }
}

?>