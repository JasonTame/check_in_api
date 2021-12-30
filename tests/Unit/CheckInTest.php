<?php

use Carbon\Carbon;

use Illuminate\Database\QueryException;

use App\Models\CheckIn;
use App\Models\User;

use function Pest\Faker\faker;
use function Pest\Laravel\assertDatabaseHas;
use function PHPUnit\Framework\assertEquals;

beforeEach(function () {
    $this->checkIn = CheckIn::factory()
        ->for(User::factory())
        ->create();
});

it('will not allow saving without a name and a user ID', function () {
    $this->expectException(QueryException::class);
    $checkIn = new CheckIn();

    $checkIn->save();
})->throws(QueryException::class);

it('will save with a name and a user ID', function () {
    $user = User::factory()->create();

    $checkIn = new CheckIn([
        'name' => faker()->name,
        'user_id' => $user->id
    ]);

    $checkIn->save();

    assertDatabaseHas('check_ins', ['id' => $checkIn->id, 'name' => $checkIn->name]);
});

it('can have an image', function () {
    $imageUrl = "https://via.placeholder.com/150";;
    $this->checkIn->image = $imageUrl;
    $this->checkIn->save();

    assertDatabaseHas('check_ins', ['image' => $imageUrl]);
});

it('can have a birthday', function () {
    $birthday = Carbon::create(1991, 10, 8);

    $this->checkIn->birthday = $birthday;
    $this->checkIn->save();

    assertDatabaseHas('check_ins', ['birthday' => $birthday]);
});

it('can have notes', function () {
    $notes = faker()->paragraph();

    $this->checkIn->notes = $notes;
    $this->checkIn->save();

    assertDatabaseHas('check_ins', ['notes' => $notes]);
});

it('creates a checkin reminder when created', function () {
    $checkIn = CheckIn::factory()
        ->for(User::factory())
        ->create();

    assertDatabaseHas('reminders', ['check_in_id' => $checkIn->id]);
    assertEquals($checkIn->id, $checkIn->reminder->check_in_id);
});
