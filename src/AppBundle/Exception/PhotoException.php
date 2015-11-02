<?php
namespace AppBundle\Exception;

class PhotoException extends \Exception
{
    const
	    PHOTO_NOT_FOUND = 100,
	    PHOTO_IS_NOT_YOURS = 101,
	    PHOTO_ALREADY_PROCESSED = 102;
}
