<?php
beforeEach(function () {
    $this->member = \App\Models\Membership::create([
        'full_name'=>'Private Name','nik'=>'1234567890123456','birth_place'=>'City','birth_date'=>'2000-01-01','gender'=>'male','whatsapp'=>'0812345678','email'=>'private@example.com','address'=>'Private Address','province'=>'Province','city'=>'City','last_education'=>'sma',
        'motivation_reason'=>'Test','mvpn_knowledge'=>'Test','contribution'=>'Test','interest_issue'=>'Test','vision_youth'=>'Test','interest_fields'=>['teknologi_inovasi']
    ]);
});

it('requires admin authentication for payment management', function () {
    $this->post('/admin/memberships/1/payment', ['action'=>'paid'])->assertRedirect('/admin/login');
});
it('requires admin authentication to download transfer proofs', function () {
    $this->get('/admin/memberships/1/proof/0')->assertRedirect('/admin/login');
});
it('does not publish inactive or private memberships', function () {
    $this->get('/')->assertOk()->assertSee('Gerakan ini terbuka untuk Anda.')->assertDontSee('Private Name')->assertDontSee('private@example.com');
});

it('activates only reviewed payments and keeps activation idempotent', function () {
    $this->member->update(['status'=>'accepted']);
    $payment=\App\Models\MembershipPayment::create(['membership_id'=>$this->member->id,'amount'=>100000,'instructions'=>'Bank test','due_at'=>now()->addDay()]);
    $url='/admin/memberships/'.$this->member->id.'/payment';
    $this->withSession(['admin'=>true])->post($url,['action'=>'paid','note'=>'matched'])->assertStatus(422);
    $payment->update(['status'=>'review']);
    $this->post($url,['action'=>'paid','note'=>'matched'])->assertRedirect();
    $number=$this->member->fresh()->member_number;
    expect($number)->not->toBeNull();
    $this->post($url,['action'=>'paid','note'=>'matched'])->assertRedirect();
    expect($this->member->fresh()->member_number)->toBe($number);
    expect($this->member->fresh()->membership_state)->toBe('active');
});
