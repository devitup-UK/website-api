<?php
/**
 * Describes the Contact model from the 'contacts' table on the database.
 *
 * PHP Version 7
 *
 * @category  Models
 * @package   DevItUp-API
 * @author    Tom Alderson <tom.alderson@devitup.co.uk>
 * @copyright 2019 DevItUp
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   GIT: $Id$ *
 * @link      http://www.devitup.co.uk
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * The Contact Model
 *
 * @category Models
 * @package  DevItUp-API
 * @author   Tom Alderson <tom.alderson@devitup.co.uk>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link     http://www.devitup.co.uk
 */
class Contact extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'subject',
        'message'
    ];

    /**
     * Return the users full name using their first and last name combined.
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->first_name . $this->last_name != null ? (" " . $this->last_name) : '';
    }
}
