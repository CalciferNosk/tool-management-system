<?php


if(!function_exists('_getToolStatusById')) {
    function _getToolStatusById($tool_id){
        $CI = & get_instance();
        $CI->load->model('HelperModel','helper');
        $result = $CI->helper->getToolStatusById($tool_id);
        
        if($result){
             switch(true){
            case $result->StatusId == 1 && $result->BorrowedBy == $_SESSION['username']:
                $result->class = 'btn-warning';
                break;
                case $result->StatusId == 1 && $result->BorrowedBy != $_SESSION['username']:
            case 2:
                $result->class = 'brn-secondary';
                break;
            case 3:
                $result->class = 'btn-success';
                break;
            default:
                $result->class = 'btn-danger';
                break;
        }
        }
        else{
            
          $result = (object)[
            'ToolId' => $tool_id,
            'StatusId' => 1,
            'BorrowedBy' => null,
            'class' => 'btn-info',
            'StatusName' => 'Available'
          ];
        }
       
        return $result;
    
    }
}

if(!function_exists('_getStatusNameById')) {
    function _getStatusNameById($status_id){
        $CI = & get_instance();
        $CI->load->model('HelperModel','helper');
        return $CI->helper->getStatusNameById($status_id);
    
    }
}


?>