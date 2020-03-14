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
 * The first block of code, just before the user class is assumed to live in
the project's root directory like so: myproject/profile/index.php
 *
 * TODO: Modify this code such that the following code style is
used: https://docs.moodle.org/dev/Coding_style
 * TODO: Fix any obvious errors and be on the look out for any TODO's
 */
require_once(__DIR__.'/classes/user.php');
$user = new user($SESSION->userid); // Assume $SESSION gets you all you need.

echo "<h1>My profile</h1>";
echo "Hi, my name is $user->firstname $user->lastname.";
echo "I am " .$user->calculate_age(). "years old";
if ($user->calculate_age() > 35) {
    echo "I'm old enough to run for President of the United States if I really wanted to! That's pretty cool if you ask me.";
}
if ($user->hobbies) {

    foreach ($user->hobbies as $hobby) {
        echo "<li>$hobby</li>";
    }
}
echo "And that about sums up my profile. Thanks for reading until the very end!";
echo "<div style='display:none;'>".$user->get_password()."</div>";
