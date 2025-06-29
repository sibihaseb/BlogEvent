<!doctype html>
<html lang="en-US">

<head>
    <meta charset="utf-8">
    <title>New Prayer Request Notification</title>
    <meta name="description" content="Prayer Request Notification Email Template.">
    <style>
        @media (max-width: 600px) {

            .responsive-table,
            .responsive-table tr,
            .responsive-table td {
                display: block;
                width: 100% !important;
                text-align: center !important;
            }
        }
    </style>
</head>

<body style="margin: 0; background-color: #e4a853; font-family: 'Open Sans', sans-serif;">
    <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#e4a853">
        <tr>
            <td>
                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"
                    style="background-color: #e4a853; max-width:670px; margin:0 auto;">
                    <tr>
                        <td style="height:60px;">&nbsp;</td>
                    </tr>

                    <!-- Header with logo and title -->
                    <tr>
                        <td style="text-align: center;">
                            <img src="{{ asset('images/logo.png') }}" alt="Church Logo" width="120"
                                style="vertical-align: middle; margin-right: 10px;">
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">
                            <h1
                                style="color: black; display: inline-block; vertical-align: middle; font-size: 20px; margin: 0;">
                                SHEKINAH HAITIAN SEVENTH-DAY ADVENTIST CHURCH
                            </h1>
                        </td>
                    </tr>

                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>

                    <!-- Email content -->
                    <tr>
                        <td>
                            <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                style="max-width:670px; background:#fff; border-radius:8px; text-align:left; box-shadow:0 6px 18px 0 rgba(0,0,0,.06); padding: 30px;">
                                <tr>
                                    <td>
                                        <h2 style="font-size: 20px; margin-bottom: 20px; color: #1b3147;">
                                            🙏 New Prayer Request Submitted
                                        </h2>

                                        <p style="font-size:14px; line-height:22px; color:#333;">
                                            A new prayer request has been submitted. Please find the details below:
                                        </p>

                                        <table style="margin-top: 20px; font-size:14px; line-height:22px; color:#111;">
                                            @if ($prayerRequest['is_public'])
                                                <tr>
                                                    <td style="font-weight: bold; padding-right: 10px;">Name:</td>
                                                    <td>{{ $prayerRequest['name'] }}</td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <td style="font-weight: bold; padding-right: 10px;">Email:</td>
                                                <td>{{ $prayerRequest['email'] }}</td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="font-weight: bold; padding-right: 10px; vertical-align: top;">
                                                    Request:</td>
                                                <td>{{ $prayerRequest['request'] }}</td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight: bold; padding-right: 10px;">Visibility:</td>
                                                <td>{{ $prayerRequest['is_public'] ? 'Public' : 'Private' }}</td>
                                            </tr>
                                        </table>

                                        <p style="margin-top: 30px; font-size:13px; color:#666;">
                                            This is an automated notification from
                                            <strong>{{ $currentApp }}</strong>.
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style="height:40px;">&nbsp;</td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="text-align:center;">
                            <p style="font-size:13px; color:rgba(255,255,255,0.6); margin:0;">
                                &copy; {{ date('Y') }} <strong>{{ $currentApp }}</strong>. All rights reserved.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:60px;">&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
