<?php
/**
 * ${CLASS_NAME}
 *
 * Created 6/8/16 11:41 AM
 * Description of this file here....
 *
 * @author Nate Nolting <naten@paulbunyan.net>
 * @package Tests\Unit\App\Http\Middleware
 * @subpackage Subpackage
 */

namespace Tests\Unit\App\Http\Middleware;

use App\Http\Middleware\LolTeamSignUpMiddleware;
use App\Http\Requests\LolTeamSignUpRequest;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Request;
use Pbc\Bandolier\Type\Numbers;

class LolTeamSignUpMiddlewareTest extends \TestCase
{
    use DatabaseTransactions;

    protected $teamInputs;

    /**
     *
     */
    public function setUp()
    {
        parent::setUp();

        $faker = \Faker\Factory::create();

        // create a dummy tournament for this team to sign up for
        $tournamentName = implode('-', $faker->words());
        factory(\App\Models\Championship\Tournament::class)->create(['name' => $tournamentName]);

        // dummy team inputs
        $this->teamInputs = [
            'email' => $faker->email,
            'name' => $faker->name,
            'team-captain-lol-summoner-name' => $faker->userName,
            'team-captain-phone' => $faker->phoneNumber,
            'team-captain-lol-summoner-name' => $faker->userName,
            'tournament' => $tournamentName,
            'team-name' => implode(' ', $faker->words()),
        ];

        for ($i = 1; $i <= 2; $i++) {
            $this->teamInputs['teammate-' . Numbers::toWord($i) . '-lol-summoner-name'] = $faker->userName;
            $this->teamInputs['teammate-' . Numbers::toWord($i) . '-email-address'] = $faker->email;
        }
    }

    /**
     *
     */
    public function tearDown()
    {
        parent::tearDown();
        $this->teamInputs = [];
        exec('php artisan migrate:refresh');
    }

    /**
     * If validation fails check that an error array was returned
     * @test
     */
    public function it_returns_a_json_array_of_errors_when_validation_fails()
    {
        $request = new Request();
        $params = [];
        $request->replace($params);
        $middleware = new LolTeamSignUpMiddleware();

        $handle = $middleware->handle($request, function () {
            return 'I ran the closure';
        });
        // check return
        $this->assertJson($handle->getContent());
        $response = json_decode($handle->getContent());
        $this->assertObjectHasAttribute('error', $response);
        $this->assertTrue(is_array($response->error));
    }

    /**
     * If validation fails check that an tournament error was returned
     * @test
     */
    public function it_returns_a_json_array_of_errors_when_tournament_not_found()
    {
        $faker = \Faker\Factory::create();
        $request = new Request();
        $request->replace($this->teamInputs);
        $middleware = new LolTeamSignUpMiddleware();

        // this will set off the wrong tournament issue
        $middleware->setTournament(implode('-', $faker->words(4)));
        $handle = $middleware->handle($request, function () {
            return 'I ran the closure';
        });
        // check return
        $this->assertJson($handle->getContent());
        $response = json_decode($handle->getContent());
        $this->assertObjectHasAttribute('error', $response);
        $this->assertTrue(is_array($response->error));
        $this->assertTrue(in_array('Could not find tournament "' . $middleware->getTournament() . '"', $response->error));
    }

    /**
     * If successful check for call back return
     * @test
     */
    public function it_returns_callback_when_successful()
    {
        $request = new Request();
        $request->replace($this->teamInputs);
        $middleware = new LolTeamSignUpMiddleware();

        $handle = $middleware->handle($request, function () {
            return 'I ran the closure';
        });
        $this->assertSame($handle, 'I ran the closure');

    }

    /**
     * If successful check for call back return
     * @test
     */
    public function it_sets_new_row_to_db_when_successful()
    {
        $request = new Request();
        $request->replace($this->teamInputs);
        $middleware = new LolTeamSignUpMiddleware();
        $request->replace($this->teamInputs);
        $middleware->handle($request, function () {
            return 'I ran the closure';
        });

        // get the captain
        $getTeam = \App\Models\Championship\Team::where(
            'name',
            $this->teamInputs['team-name']
        )->first();

        $getTournament = \App\Models\Championship\Tournament::where(
            'name',
            $this->teamInputs['tournament']
        )->first();
        
        $getCaptain = \App\Models\Championship\Player::where('email', $this->teamInputs['email'])->first();

        $this->assertSame($getTeam->tournament_id, $getTournament->id);
        $this->assertSame($this->teamInputs['team-name'], $getTeam->name);
        $this->assertSame($getTeam->captain, $getCaptain->id);

        // check captain
        $this->assertSame($this->teamInputs['email'], $getCaptain->email);
        $this->assertSame($this->teamInputs['team-captain-lol-summoner-name'], $getCaptain->username);
        $this->assertSame($this->teamInputs['name'], $getCaptain->name);
        $this->assertSame($this->teamInputs['team-captain-phone'], $getCaptain->phone);
        $this->assertSame($getTeam->id, $getCaptain->team_id);

        // check other players
        for ($i = 1; $i <= 2; $i++) {
            $getPlayer = \App\Models\Championship\Player::where(
                'email',
                $this->teamInputs['teammate-' . Numbers::toWord($i) . '-email-address']
            )->first();

            $this->assertSame($this->teamInputs['teammate-' . Numbers::toWord($i) . '-email-address'], $getPlayer->email);
            $this->assertSame($this->teamInputs['teammate-' . Numbers::toWord($i) . '-lol-summoner-name'], $getPlayer->username);
            $this->assertSame($getTeam->id, $getPlayer->team_id);
        }
    }

    /**
     * If validation fails check for required validation messages
     * @test
     */
    public function it_returns_a_array_of_errors_messages_when_validation_fails()
    {
        $request = new Request();
        $rules = new LolTeamSignUpRequest();
        $params = [];
        $request->replace($params);
        $middleware = new LolTeamSignUpMiddleware();

        $handle = $middleware->handle($request, function () {
            return 'I ran the closure';
        });

        $response = json_decode($handle->getContent());
        // check messages
        foreach ($rules->messages() as $key => $message) {
            if (strpos($key, 'required') !== false) {
                $this->assertTrue(in_array($message, $response->error));
            }
        }
    }

    /**
     * If bad email was passed in request then check for bad email message
     * @test
     */
    public function it_returns_an_error_if_bad_email_is_passed()
    {
        $request = new Request();
        $rules = new LolTeamSignUpRequest();
        $params = $this->teamInputs;
        $params['email'] = 123456;
        for ($i = 1; $i <= 2; $i++) {
            $params['teammate-'.Numbers::toWord($i).'-email-address'] = 123456;
        }
        $request->replace($params);
        $middleware = new LolTeamSignUpMiddleware();

        $handle = $middleware->handle($request, function () {
            return 'I ran the closure';
        });

        $response = json_decode($handle->getContent());

        // check messages
        $this->assertTrue(in_array($rules->messages()['email.email'], $response->error));
        for ($i = 1; $i <= 2; $i++) {
            $this->assertTrue(in_array($rules->messages()['teammate-'.Numbers::toWord($i).'-email-address.email'], $response->error));

        }
    }

    /**
     * Check return from getTournament
     * @test
     */
    public function it_returns_name_of_tournament()
    {
        $faker = \Faker\Factory::create();
        $middleware = new LolTeamSignUpMiddleware();
        $tournament = implode(' ', $faker->words());
        $middleware->setTournament($tournament);
        $this->assertSame($tournament, $middleware->getTournament());
    }
}
