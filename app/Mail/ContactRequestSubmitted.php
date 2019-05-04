<?php
/**
 * Send out contact request to enquiries address.
 *
 * PHP Version 7
 *
 * @category  Mailables
 * @package   DevItUp-API
 * @author    Tom Alderson <tom.alderson@devitup.co.uk>
 * @copyright 2019 DevItUp
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   GIT: $Id$ *
 * @link      http://www.devitup.co.uk
 */
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Contact;

/**
 * A mailable that implements the queuing functionality to ensure that each email
 * request is stored within a queue to be sent at a later time.
 *
 * @category Mailables
 * @package  DevItUp-API
 * @author   Tom Alderson <tom.alderson@devitup.co.uk>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link     http://www.devitup.co.uk
 */
class ContactRequestSubmitted extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $contact;

    /**
     * Create a new message instance.
     *
     * @param Contact $contact An instance of the Contact model used to get the
     *                         enquiry information.
     *
     * @return void
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to(
            [
                'address'   => env('MAIL_ENQUIRIES_ADDRESS'),
                'name'      => 'DevItUp Team'
            ]
        )->from(
            [
                'address' => $this->contact->email_address,
                'name'  => $this->contact->getFullName()
            ]
        )->view('emails.contact.received', ['contact' => $this->contact->toArray()]);
    }
}
