@props(['url', 'text', 'bgColor' => '#ea4a40', 'textColor' => '#ffffff'])

<tr>
    <td align="left" vertical-align="middle" style="font-size:0px;padding:10px 25px;word-break:break-word;">
        <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:separate;line-height:100%;">
            <tr>
                <td align="center" bgcolor="{{ $bgColor }}" role="presentation"
                    style="border:none;border-radius:3px;cursor:auto;mso-padding-alt:10px 25px;background:{{ $bgColor }};"
                    valign="middle">
                    <a href="{{ $url }}"
                        style="display: inline-block; background: {{ $bgColor }}; color: {{ $textColor }}; font-family: Alata; font-size: 14px; font-weight: bold; line-height: 30px; margin: 0; text-decoration: none; text-transform: uppercase; padding: 10px 25px; mso-padding-alt: 0px; border-radius: 3px;"
                        target="_blank">{{ $text }}</a>
                </td>
            </tr>
        </table>
    </td>
</tr>
