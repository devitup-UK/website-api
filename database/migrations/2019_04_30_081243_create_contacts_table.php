<?php
/**
 * A migration used to create the 'Contact' table that will store all of our contact message details.
 *
 * PHP Version 7
 *
 * @category  Migrations
 * @package   DevItUp-API
 * @author    Tom Alderson <tom.alderson@devitup.co.uk>
 * @copyright 2019 DevItUp
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   GIT: $Id$ *
 * @link      http://www.devitup.co.uk
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * This class will build a set of SQL statements for us.
 *
 * @category Migrations
 * @package  DevItUp-API
 * @author   Tom Alderson <tom.alderson@devitup.co.uk>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link     http://www.devitup.co.uk
 */
class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'contacts',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('first_name');
                $table->string('last_name');
                $table->string('email');
                $table->string('subject');
                $table->text('message');
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
