<?php
namespace Src\Services;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Src\Models\EmsikaOutbox;

class EmsikaSmsGateway
{
    protected $payload;
    protected $smses;

    public function generateSMSPayload()
    {
        $this->smses = EmsikaOutbox::whereNull('sent_at')->where('status',3)->get();
        foreach($this->smses as $sms){
            $payload[]=[
                'phone'=>$sms->mobile,
                'message'=>$sms->msg,
            ];
        }
        $this->payload['messages'] = $payload;
        $this->payload['source_address']=env('EMSIKA_SOURCE_ADDRESS');
        $this->payload['external_reference']=md5(date("YmdHis"));
    }

    public function sendSms(): void
    {
        $response = Http::withHeaders(
            [
                'username' => env('EMSIKA_USERNAME'),
                'password' => env('EMSIKA_PASSWORD'),
                'Content-Type' => 'application/json',
            ]
        )->timeout(env('EMSIKA_default_timeout'))
            ->post(env('EMSIKA_URL'), $this->payload);

        if ($response['status_code'] == 300) {
            $this->smses->each(function ($sms) {
                $sms->status = 1;
                $sms->sent_at = Carbon::now();
                $sms->save();
            });
        }

    }

    public function run()
    {
        $this->generateSMSPayload();
        $this->sendSms();
    }
}