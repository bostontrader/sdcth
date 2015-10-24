<?php

namespace App\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;

require_once 'simple_html_dom.php';

/**
 * App\Controller\UsersController Test Case
 *
 * In these tests I generally want to test that:
 *
 * 1. A controller method exists...
 *
 * 2. Said method returns ResponseOK.
 *
 * 3. Said method does or does not redirect.  If it redirects, then where to?
 *
 * 4. A bare minimum of html structure required to reasonably verify correct operation
 *    and to facilitate TDD.  For example, the add method should return a form with certain fields.
 *
 * 5. Verify that the db has changed as expected, if applicable.
 *
 * I do not want to test:
 *
 * 1. Whether or not Auth prevents/allows access to a method.
 *
 * 2. How the method responds to badly formed requests, such as trying to submit a DELETE to the add method.
 *
 * 3. Any html structure, formatting, css, scripts, tags, krakens, or whatever, beyond the bare minimum
 *    listed above.
 *
 * These items should be tested elsewhere.
 *
 */

class DMIntegrationTestCase extends IntegrationTestCase {

    // Hack the session to make it look as if we're properly logged in.
    protected function fakeLogin() {
        // Set session data
        $this->session(
            [
                'Auth' => [
                    'User' => [
                        'id' => 1,
                        'username' => 'testing',
                    ]
                ]
            ]
        );
    }
}