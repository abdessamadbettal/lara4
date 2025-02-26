@php
    use App\Settings\GeneralSettings;
    use App\Settings\SocialSettings;

    $generalSettings = app(GeneralSettings::class)->getFormattedSettings();
    $socialSettings = app(SocialSettings::class)->getFormattedSettings();

    $logoUrl = $generalSettings['site_logo_dark']; // or 'site_logo_light' based on your requirement
    $socials = $socialSettings['socials'];
@endphp

<div style="margin:0px auto;max-width:600px;">
    <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
        <tbody>
            <tr>
                <td style="direction:ltr;font-size:0px;padding:20px 0;padding-bottom:0px;text-align:center;">
                    <div class="mj-column-per-50 mj-outlook-group-fix"
                        style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:middle;width:100%;">
                        <table border="0" cellpadding="0" cellspacing="0" role="presentation"
                            style="vertical-align:middle;" width="100%">
                            <tr>
                                <td align="left" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation"
                                        style="border-collapse:collapse;border-spacing:0px;">
                                        <tbody>
                                            <tr>
                                                <td style="width:150px;">
                                                    <img alt="image description" height="auto" src="{{ $logoUrl }}"
                                                        style="border:0;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:14px;"
                                                        width="150">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="mj-column-per-50 mj-outlook-group-fix"
                        style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:middle;width:100%;">
                        <table border="0" cellpadding="0" cellspacing="0" role="presentation"
                            style="vertical-align:middle;" width="100%">
                            <tr>
                                <td align="right" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                    @foreach ($socials as $social)
                                        @if ($social['active'])
                                            <table align="right" border="0" cellpadding="0" cellspacing="0"
                                                role="presentation" style="float:none;display:inline-table;">
                                                <tr>
                                                    <td style="padding:4px;">
                                                        <table border="0" cellpadding="0" cellspacing="0"
                                                            role="presentation" style="border-radius:3px;width:18px;">
                                                            <tr>
                                                                <td style="font-size:0;height:18px;vertical-align:middle;width:18px;">
                                                                    <a href="{{ $social['url'] }}" target="_blank"
                                                                        style="color: #ea4a40; text-decoration: none;">
                                                                        <img alt="{{ $social['name'] }}-logo" height="18"
                                                                            src="{{ $social['icon_url'] }}"
                                                                            style="border-radius:3px;display:block;"
                                                                            width="18">
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
                        </table>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
