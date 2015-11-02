<?php
namespace AppBundle\Exception;

class FileException extends \Exception
{
    const
	    FILE_EXTENSION_DENIED = 100; // Не допустимое расширение файла.
}
