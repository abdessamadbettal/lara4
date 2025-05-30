<!-- resources/views/components/hero.blade.php -->
@props(['image' => null])

@php
    use App\Settings\HeroSettings;

    $heroSettings = app(HeroSettings::class)->getFormattedSettings();
    $defaultHeroImage = $heroSettings['image'];
    $heroImage = $image ?? $defaultHeroImage;
@endphp

<div style="margin:0px auto;max-width:600px;">
    <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
        <tbody>
            <tr>
                <td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;">
                    <div class="mj-column-per-100 mj-outlook-group-fix"
                        style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                        <table border="0" cellpadding="0" cellspacing="0" role="presentation"
                            style="vertical-align:top;" width="100%">
                            <tr>
                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation"
                                        style="border-collapse:collapse;border-spacing:0px;">
                                        <tbody>
                                            <tr>
                                                <td style="width:550px;">
                                                    <img alt="welcome image" height="auto" src="{{ $heroImage }}"
                                                        style="border:0;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:14px;"
                                                        width="550">
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
