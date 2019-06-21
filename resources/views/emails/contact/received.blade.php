@extends('emails.layouts.app')

@section('preview')
Enquiry request from {{ $contact['first_name'] . ' ' . $contact['last_name'] }}
@endsection

@section('content')
<table border="0" cellpadding="0" cellspacing="0" role="presentation">
    <tbody>
        <tr>
            <td class="pc-fb-font"
                style="padding: 0 20px; text-align: left; font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 700; line-height: 1.42; letter-spacing: -0.4px; color: #151515;"
                valign="top">Name:</td>
            <td class="pc-fb-font"
                style="padding: 0 20px; text-align: left; font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 1.42; letter-spacing: -0.4px; color: #151515;"
                valign="top">{{ $contact['first_name'] . ' ' . $contact['last_name'] }}</td>
        </tr>
        <tr>
            <td class="pc-fb-font"
                style="padding: 0 20px; text-align: left; font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 700; line-height: 1.42; letter-spacing: -0.4px; color: #151515;"
                valign="top">Email:</td>
            <td class="pc-fb-font"
                style="padding: 0 20px; text-align: left; font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 1.42; letter-spacing: -0.4px; color: #151515;"
                valign="top">{{ $contact['email'] }}</td>
        </tr>
        <tr>
            <td class="pc-fb-font"
                style="padding: 0 20px; text-align: left; font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 700; line-height: 1.42; letter-spacing: -0.4px; color: #151515;"
                valign="top">Subject:</td>
            <td class="pc-fb-font"
                style="padding: 0 20px; text-align: left; font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 1.42; letter-spacing: -0.4px; color: #151515;"
                valign="top">{{ $contact['subject'] }}</td>
        </tr>
        <tr>
            <td height="30"></td>
        </tr>
        <tr>
            <td class="pc-fb-font"
                style="padding: 0 20px; text-align: left; font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 700; line-height: 1.42; letter-spacing: -0.4px; color: #151515;"
                valign="top">Message:</td>
        </tr>
        <tr>
            <td colspan="2" class="pc-fb-font"
                style="padding: 0 20px; text-align: left; font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 1.42; letter-spacing: -0.4px; color: #151515;"
                valign="top">{{ $contact['message'] }}</td>
        </tr>
    </tbody>
</table>
@endsection
