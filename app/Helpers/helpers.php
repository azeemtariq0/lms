<?php

if (!function_exists('formatDate')) {
    /**
     * Format a given date to a specific format.
     *
     * @param  string  $date
     * @param  string  $format
     * @return string
     */
    function formatDate($date, $format = 'Y-m-d')
    {
        return \Carbon\Carbon::parse($date)->format($format);
    }
}

function htmlBtn($url,$id,$color='info',$icon='edit'){

        $btn = "<a href='".route($url,$id)."' title='".($icon=='edit' ? 'Edit' : 'View')."'  class='btn btn-".$color." btn-sm'><i class='fa fa-".$icon."'></i></a>";
        return $btn;
    }
function htmDeleteBtn($url,$id){
            $btn= "<form method ='DELETE' 'id = delete-form' 'route = ".($url.'/'.$id)." style='display:inline'>";
            $btn.= "<button class='btn btn-danger btn-sm' title='Delete'  type='submit' onclick='rowDetele(event,this)' ><i class='fa fa-trash'></i></button>";
            $btn.= '</form>';
            return  $btn;
    }



if (!function_exists('hasPermission')) {
    function hasPermission($permission)
    {
        // Get the current user's permissions from the permission table
        $permissions = json_decode(auth()->user()->permissions->first()->permission, true);

        // Split permission string (e.g., 'user.add')
        $parts = explode('.', $permission);

        // Check if the permission exists in the JSON and is set to 1 (granted)
        return isset($permissions[$parts[0]][$parts[1]]) && $permissions[$parts[0]][$parts[1]] === 1;
    }
}


function stdDate($mySqlDate){
  return !empty($mySqlDate) ? date('d/m/Y',strtotime($mySqlDate)) : "";
}