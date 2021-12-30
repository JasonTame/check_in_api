<?php

use Carbon\Carbon;

use Illuminate\Database\QueryException;

use App\Models\CheckIn;
use App\Models\User;

use function Pest\Faker\faker;
use function Pest\Laravel\assertDatabaseHas;

beforeEach(function () {
    $this->checkin = CheckIn::factory()
        ->for(User::factory())
        ->create();
});

it('will not allow saving without a name and a user ID', function () {
    $this->expectException(QueryException::class);
    $checkin = new CheckIn();

    $checkin->save();
})->throws(QueryException::class);

it('will save with a name and a user ID', function () {
    $user = User::factory()->create();

    $checkin = new CheckIn([
        'name' => faker()->name,
        'user_id' => $user->id
    ]);

    $checkin->save();

    assertDatabaseHas('check_ins', ['id' => $checkin->id, 'name' => $checkin->name]);
});

it('can have an image', function () {
    $imageUrl = "https://via.placeholder.com/150";;
    $this->checkin->image = $imageUrl;
    $this->checkin->save();

    assertDatabaseHas('check_ins', ['image' => $imageUrl]);
});

it('can have a birthday', function () {
    $birthday = Carbon::create(1991, 10, 8);

    $this->checkin->birthday = $birthday;
    $this->checkin->save();

    assertDatabaseHas('check_ins', ['birthday' => $birthday]);
});

it('can have notes', function () {
    $notes = faker()->paragraph();

    $this->checkin->notes = $notes;
    $this->checkin->save();

    assertDatabaseHas('check_ins', ['notes' => $notes]);
});
