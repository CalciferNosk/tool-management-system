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
    public function validateUser($email)
    {
        try {
            $query = $this->db->get_where($this->user, array('email' => $email));
            return $query->row();
        } catch (Exception $e) {
            log_message('error', 'Error fetching user: ' . $e->getMessage());
            return null;
        }
    }
    public function getAllTools()
    {
        try {
            $this->db->select('tms_tool.*, tms_tool_category.CategoryName');
            $this->db->from('tms_tool');
            $this->db->join('tms_tool_category', 'tms_tool.CategoryId = tms_tool_category.id', 'left');
            $this->db->where('tms_tool.DeletedTag', 0);
            $query = $this->db->get();
            return $query->result();
        } catch (Exception $e) {
            log_message('error', 'Error fetching tools: ' . $e->getMessage());
            return null;
        }
    }

    public function getAllBorrowedTools()
    {

        try {
            $this->db->select('tms_tools_borrow.*, tms_tool.ToolName');
            $this->db->from('tms_tools_borrow');
            $this->db->join('tms_tool', 'tms_tools_borrow.ToolId = tms_tool.id', 'left');
            if ($_SESSION['role'] != 1) {
                $this->db->where('tms_tools_borrow.BorrowedBy', $_SESSION['username']);
            }
            $query = $this->db->get();
            return $query->result();
        } catch (Exception $e) {
            log_message('error', 'Error fetching tools: ' . $e->getMessage());
            return [];
        }
    }

    public function getToolCount()
    {
        $get_count = "SELECT ToolName,count(ToolName) as count FROM tms.tms_tool group by `group`;";
        $res = $this->db->query($get_count)->result();
        return $res;
    }

    public function getTopFive()
    {
        $get_top = "SELECT 
                        tb.ToolBarCode,count(tb.ToolBarCode) as `count_top`,t.ToolName
                    FROM 
                        tms.tms_tools_borrow tb
                    LEFT JOIN 
                        tms_tool t on tb.ToolBarCode = t.BarcodeId
                    group by 
                        ToolBarCode order by count(ToolBarCode) desc limit 5;  ";
                            $res = $this->db->query($get_top)->result();
        return  $res;
    }

    public function getGroups(){
        $group  ="SELECT * FROM tms.tms_group";
        $res = $this->db->query($group)->result();
        return $res;    
    }
    public function borrowTool($toolid, $barCode)
    {

        try {
            $data = [
                'Username' => $_SESSION['username'],
                'ToolId' => $toolid,
                'ToolBarCode' => $barCode,
                'BorrowedDate' => date('Y-m-d'),
                'BorrowedBy' => $_SESSION['username']
            ];

            $result = $this->db->insert('tms_tools_borrow', $data);

            if ($result) {
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

    public function returnTools($request_id, $barCode, $toolid)
    {
        $data_today = date('Y-m-d H:i:s');
        $user =  $_SESSION['username'];
        $update = "UPDATE `tms`.`tms_tools_borrow` SET `ReturnedBy` = '{$user}', `ReturnedDate` = '{$data_today}' , StatusId = 6
    WHERE id = {$request_id} AND ToolId = {$toolid} AND ToolBarCode = {$barCode}";
        $res = $this->db->query($update);

        if ($res) {
            $update_tool = "UPDATE `tms`.`tms_tool` SET `isBorrowed` = '0' WHERE (`id` = '{$request_id}')";
            $res_tool = $this->db->query($update_tool);
        }
        return $res_tool;
    }

    public function approveTools($request_id, $barCode, $toolid)
    {

        $update_status = "UPDATE `tms`.`tms_tools_borrow` SET `StatusId` = '2'   WHERE id = {$request_id} AND ToolId = {$toolid} AND ToolBarCode = {$barCode}";
        $res = $this->db->query($update_status);

        return $res;
    }

    public function approvedReturns($request_id, $barCode, $toolid)
    {

        $update_status = "UPDATE `tms`.`tms_tools_borrow` SET `StatusId` = '4'   WHERE id = {$request_id} AND ToolId = {$toolid} AND ToolBarCode = {$barCode}";
        $res = $this->db->query($update_status);

        if ($res) {
            $update_tool = "UPDATE `tms`.`tms_tool` SET `isBorrowed` = '0' WHERE `id` = '{$request_id}' AND BarcodeId = {$barCode}";
            $res_tool = $this->db->query($update_tool);
            // var_dump($update_tool );
        }

        return $res_tool;
    }
}
