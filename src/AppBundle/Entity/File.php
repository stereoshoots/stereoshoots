<?php
namespace AppBundle\Entity;

class File
{
    public static $extensions = array('jpeg', 'png');
    
    public static function getAvatarUploadPath($id) {
	return __DIR__.'/../../../web/uploads/avatars/'.$id.'/';
    }
    
    public static function getImageUploadPath($id, $date) {
	return __DIR__.'/../../../web/uploads/photos/'.$id.'/'.$date.'/';
    }
}