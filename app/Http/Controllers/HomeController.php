<?php
/**
 * This file will describe all of the endpoints controlled by the HomeController.
 *
 * PHP Version 7
 *
 * @category  HomeController
 * @package   DevItUp-API
 * @author    Tom Alderson <tom.alderson@devitup.co.uk>
 * @copyright 2019 DevItUp
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   GIT: $Id$ *
 * @link      http://www.devitup.co.uk
 */

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Http\Requests\ContactFormSubmission;
use Illuminate\Support\Facades\Mail;

use App\Contact;
use App\Mail\ContactRequestSubmitted;
use Exception;

/**
 * This file will describe all of the endpoints controlled by the HomeController.
 *
 * @category Controllers
 * @package  DevItUp-API
 * @author   Tom Alderson <tom.alderson@devitup.co.uk>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link     http://www.devitup.co.uk
 */
class HomeController extends Controller
{
    /**
     * Create a contact record in the database, send an email and return the
     * correct response.
     *
     * @param Request $request will be a POST HTTP Request.
     *
     * @return void
     */
    public function contact(ContactFormSubmission $request)
    {
        throw new Exception("Error Processing Request - Sentry Test", 1);

        $contact = new Contact($request->input('contact'));
        $contact->save();

        $mail = Mail::send(new ContactRequestSubmitted($contact));

        if ($contact) {
            return response()->json(
                [
                    'message' => 'Success'
                ]
            );
        } else {
            return response()->json(
                [
                    'message' => 'Failure'
                ]
            );
        }
    }
}
