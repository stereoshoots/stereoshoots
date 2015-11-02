<?php
namespace AppBundle\Exception;

class FollowException extends \Exception
{
    const
	    ACCESS_DENIED = 100, // User is not authorized
	    USER_TO_FOLLOW_NOT_FOUND = 101; // User to follow not found
}
