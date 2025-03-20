<?php 
class HelperModel extends CI_Model
{
    protected $user = 'tms_user';
    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Load database
        // Load necessary libraries, helpers, or models if needed
    }

    public function getToolStatusById($tool_id){
        
        $sql ="SELECT 
                a.*,
                s.StatusName
            FROM
                tms.tms_tools_borrow a 
            LEFT JOIN 
                tms_status s on s.id = a.StatusId
            WHERE
                a.ToolId = {$tool_id};";
        $query = $this->db->query($sql);
        return $query->num_rows() > 0 ? $query->row() : null;

    }

    public function getStatusNameById($status_id){
        
        $sql ="SELECT StatusName FROM tms.tms_status WHERE id = {$status_id}";
        $query = $this->db->query($sql);
        return $query->row()->StatusName;
    }

}
?>
