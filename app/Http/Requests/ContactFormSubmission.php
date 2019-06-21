<?php
/**
 * Validate contact form request.
 *
 * PHP Version 7
 *
 * @category  Requests
 * @package   DevItUp-API
 * @author    Tom Alderson <tom.alderson@devitup.co.uk>
 * @copyright 2019 DevItUp
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   GIT: $Id$ *
 * @link      http://www.devitup.co.uk
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * A request that validates the supplied data.
 *
 * @category Mailables
 * @package  DevItUp-API
 * @author   Tom Alderson <tom.alderson@devitup.co.uk>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link     http://www.devitup.co.uk
 */
class ContactFormSubmission extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'contact'               => 'required|array',
            'contact.first_name'    => 'required|string',
            'contact.last_name'     => 'required|string',
            'contact.email'         => 'required|email',
            'contact.subject'       => 'required|string',
            'contact.message'       => 'nullable|string'
        ];
    }
}
