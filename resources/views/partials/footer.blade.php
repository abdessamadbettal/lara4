@php
    use App\Settings\GeneralSettings;
    use App\Settings\SocialSettings;
    use App\Settings\HeroSettings;
    use App\Settings\FooterSettings;

    $generalSettings = app(GeneralSettings::class)->getFormattedSettings();
    $socialSettings = app(SocialSettings::class)->getFormattedSettings();
    $heroSettings = app(HeroSettings::class)->getFormattedSettings();
    $footerSettings = app(FooterSettings::class)->getFormattedSettings();

    $logoUrl = $generalSettings['site_logo_dark']; // or 'site_logo_light' based on your requirement
    $socials = $socialSettings['socials'];
    $heroImage = $heroSettings['image'];
    $copyRight = $footerSettings['copy_right'];
@endphp

<div style="margin:0px auto;max-width:520px;">
    <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
        <tbody>
            <tr>
                <td style="direction:ltr;font-size:0px;padding:0px;text-align:center;">
                    <div class="mj-column-per-100 mj-outlook-group-fix"
                        style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                        <table border="0" cellpadding="0" cellspacing="0" role="presentation"
                            style="vertical-align:top;" width="100%">
                            <tr>
                                <td style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                    <p style="border-top:solid 1px #f4f4f4;font-size:1px;margin:0px auto;width:100%;">
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                    <div
                                        style="font-family:Alata;font-size:14px;font-weight:400;line-height:24px;text-align:center;color:#333333;">
                                        <a class="footer-link" href="{{ config('app.frontend_url') . '/aboutus' }}"
                                            style="text-decoration: none; color: #000;">@lang('mail.about_us')</a> &nbsp; | &nbsp;
                                        <a class="footer-link" href="{{ config('app.frontend_url') . '/privacy' }}"
                                            style="text-decoration: none; color: #000;">@lang('mail.privacy')</a> &nbsp; | &nbsp;
                                        <a class="footer-link" href="{{ config('app.frontend_url') . '/contact' }}"
                                            style="text-decoration: none; color: #000;">@lang('mail.contact_us')</a> &nbsp; | &nbsp;
                                        <a class="footer-link" href="{{ config('app.frontend_url') . '/terms' }}"
                                            style="text-decoration: none; color: #000;">@lang('mail.terms_conditions')</a> &nbsp; |
                                        &nbsp;
                                        <a class="footer-link" href="{{ config('app.frontend_url') . '/login' }}"
                                            style="text-decoration: none; color: #000;">@lang('mail.log_in')</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                    @foreach ($socials as $social)
                                        @if ($social['active'])
                                            <table align="center" border="0" cellpadding="0" cellspacing="0"
                                                role="presentation" style="float:none;display:inline-table;">
                                                <tr>
                                                    <td style="padding:4px;">
                                                        <table border="0" cellpadding="0" cellspacing="0"
                                                            role="presentation" style="border-radius:3px;width:24px;">
                                                            <tr>
                                                                <td
                                                                    style="font-size:0;height:24px;vertical-align:middle;width:24px;">
                                                                    <a href="{{ $social['url'] }}" target="_blank"
                                                                        style="color: #ea4a40; text-decoration: none;">
                                                                        <img alt="{{ $social['name'] }}-logo"
                                                                            height="24"
                                                                            src="{{ $social['icon_url'] }}"
                                                                            style="border-radius:3px;display:block;"
                                                                            width="24">
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                    <div
                                        style="font-family:Alata;font-size:14px;font-weight:400;line-height:24px;text-align:center;color:#333333;">
                                        {{ $copyRight }}
                                        </div>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation"
                                        style="border-collapse:collapse;border-spacing:0px;">
                                        <tbody>
                                            <tr>
                                                <td style="width:150px;">
                                                    <img alt="image description" height="auto"
                                                        src="{{ $logoUrl }}"
                                                        style="border:0;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:14px;"
                                                        width="50">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div style="margin:0px auto;max-width:520px;">
    <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
        <tbody>
            <tr>
                <td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;">
                    <div class="mj-column-per-100 mj-outlook-group-fix"
                        style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                        <table border="0" cellpadding="0" cellspacing="0" role="presentation"
                            style="vertical-align:top;" width="100%">
                            <tr>
                                <td style="font-size:0px;word-break:break-word;">
                                    <div style="height:1px;"> &nbsp; </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
