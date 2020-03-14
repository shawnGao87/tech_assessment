<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * The below user class is defined in the project's root directory like so:
myproject/profile/classes/user.php
 */

/**
 * Class user
 */
class user {
    /**
     * @var int user id
     */
    protected $id;
    /**
     * @var string user first name
     */
    public $firstname;
    /**
     * @var string user last name
     */
    public $lastname;
    /**
     * @var string user email
     */
    protected $email;
    /**
     * @var string user favorite color
     */
    protected $favoritecolor;
    /**
     * @var string user's birth date
     */
    protected $birthdate;
    /**
     * @var array array of user's hobbies (string)
     */
    public $hobbies;
    /**
     * @var string user password
     */
    private $password;

    /**
     * user constructor.
     * @param int $userid user ID
     */
    public function __construct($userid) {
        $this->id = $userid;
        // connect to DB and get $user as an associative array
        $this->firstname = $user['firstname'];
        $this->lastname = $user['lastname'];
        $this->email = $user['email'];
        $this->favoritecolor = $user['favoritecolor'];
        $this->birthdate = $user['birthdate'];
        $this->hobbies = explode(',', $user['hobbies']); // assuming hobbies are stored as comma-seperated string in DB
        $this->password = $user['password'];
    }

    /**
     * Calculate user's age
     * @return string
     * @throws \coding_exception
     */
    public function calculate_age() {

        // TODO: Assuming $birthdate is stored in unix time, use PHP DateTime()
        // to return the user's age in years.

        $dateobj = new DateTime();
        $bdatetime = $dateobj->setTimestamp($this->birthdate);
        $today = new DateTime();
        $diff = $bdatetime->diff($today, true);
        if(!$diff) {
            throw new \coding_exception('Invalid Date');
        }
        return $diff->y;
    }

    /**
     * Get an array of user's hobbies
     * @return array
     */
    public function get_hobbies() {
        return $this->hobbies;
    }
    /**
     * TODO: Using the properties that have already been defined for this
     class, write a list of methods that could be useful in a read only profile
     page.
     */
    /**
     * Get user's password
     * @return string
     */
    public function get_password() {
        return $this->password;
    }

    /**
     * Get user's email
     * @return string
     */
    public function get_email() {
        return $this->email;
    }

    /**
     * Get user's favorite color
     * @return string
     */
    public function get_favcolor() {
        return $this->favoritecolor;
    }

}


