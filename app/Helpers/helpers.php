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
