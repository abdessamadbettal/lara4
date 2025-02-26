@php
    use App\Settings\GeneralSettings;

    $GeneralSettings = app(GeneralSettings::class)->getFormattedSettings();
    $email = $GeneralSettings['site_email'];
@endphp

@extends('layouts.app')

@section('title', 'The ' . config('app.name') . ' Team')

@section('content')

<x-hero :image="$projectImage" />
<div style="margin:0px auto;max-width:520px;">
    <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
      <tbody>
        <tr>
          <td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;">
            <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
              <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                <tr>
                  <td align="left" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                    <div style="font-family:Alata;font-size:18px;font-weight:400;line-height:24px;text-align:left;color:#000000;">
                      <h1 style="margin: 0; font-size: 32px; line-height: 40px;">@lang('mail.greeting_confirmed', ['name' => $user->name])</h1>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td align="left" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                    <div style="font-family:Alata;font-size:18px;font-weight:400;line-height:24px;text-align:left;color:#000000;">
                      <p>@lang('mail.reservation_details')</p>
                      <ul>
                        <li>@lang('mail.hotel', ['hotel' => $reservation->hotel])</li>
                        <li>@lang('mail.start_date', ['start_date' => $reservation->start_date])</li>
                        <li>@lang('mail.end_date', ['end_date' => $reservation->end_date])</li>
                        <li>@lang('mail.adults', ['adults' => $reservation->adults])</li>
                        <li>@lang('mail.children', ['children' => $reservation->children])</li>
                        <li>@lang('mail.total_guests', ['guests' => $reservation->guests])</li>
                        <li>@lang('mail.total_price', ['total_price' => $reservation->total_price])</li>
                        <li>@lang('mail.reference', ['reference' => $reservation->reference])</li>
                      </ul>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td align="left" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                    <div style="font-family:Alata;font-size:18px;font-weight:400;line-height:24px;text-align:left;color:#000000;">
                      @lang('mail.click_link')
                    </div>
                  </td>
                </tr>
                <x-button url="{{config('app.frontend_url') . '/reservations'}}" text="{{ __('mail.view_reservation') }}" />
                <tr>
                  <td align="left" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                    <div style="font-family:Alata;font-size:14px;font-weight:400;line-height:24px;text-align:left;color:#333333;">
                      @lang('mail.help', ['email' => $email])
                    </div>
                  </td>
                </tr>
              </table>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
@endsection
