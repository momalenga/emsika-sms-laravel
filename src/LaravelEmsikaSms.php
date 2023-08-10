<?php

namespace Shengamo\LaravelEmsikaSms;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Shengamo\LaravelEmsikaSms\Src\Models\EmsikaOutbox;

class LaravelEmsikaSms
{
    protected $payload;
    protected $smses;

    public function run()
    {
        $this->generateSMSPayload();
        $this->sendSms();
    }

    public function generateSMSPayload()
    {
        $this->smses = EmsikaOutbox::whereNull('sent_at')->where('status','Unsent')->get();
        foreach($this->smses as $sms){
            $payload[]=[
                'phone'=>$sms->mobile,
                'message'=>$sms->message,
            ];
        }

        $this->payload['messages'] = $payload;
        $this->payload['source_address'] = config('emsikasms.source_address');
        $this->payload['external_reference']=md5(date("YmdHis"));
    }

    public function sendSms(): void
    {
        $response = Http::withHeaders(
            [
                'username' => config('emsikasms.username'),
                'password' => config('emsikasms.password'),
                'Content-Type' => 'application/json',
            ]
        )->timeout(config('emsikasms.timeout'))
            ->post(config('emsikasms.url'), $this->payload);

        if ($response['status_code'] == 300) {
            $this->smses->each(function ($sms) {
                $sms->status = 'Sent';
                $sms->sent_at = Carbon::now();
                $sms->save();
            });
        }
    }

}