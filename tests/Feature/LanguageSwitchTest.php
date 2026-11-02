<?php

it('returns old Korean and Mandarin sessions to Indonesian and removes their menu links', function (string $locale) {
    $this->withSession(['locale' => $locale])
        ->get('/')
        ->assertOk()
        ->assertSessionHas('locale', 'id')
        ->assertDontSee('/lang/zh', false)
        ->assertDontSee('/lang/ko', false)
        ->assertSee('/lang/id', false)
        ->assertSee('/lang/en', false)
        ->assertSee('/lang/fr', false)
        ->assertSee('/lang/es', false);

    expect(app()->getLocale())->toBe('id');
})->with(['ko', 'zh']);

it('keeps the current language when a removed language is requested directly', function (string $locale) {
    $this->withSession(['locale' => 'fr'])
        ->from('/')
        ->get('/lang/'.$locale)
        ->assertRedirect('/')
        ->assertSessionHas('locale', 'fr');
})->with(['ko', 'zh']);

it('still switches to each supported language', function (string $locale) {
    $this->withSession(['locale' => 'id'])
        ->from('/')
        ->get('/lang/'.$locale)
        ->assertRedirect('/')
        ->assertSessionHas('locale', $locale);
})->with(['id', 'en', 'fr', 'es']);
