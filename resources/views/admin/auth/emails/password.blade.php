Hello {{ $user->name }},
<br><br>
Please Click on the following link to reset your password:<br>
<a href="{{ $link = url('admin/password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
<br><br><br><br>
Regards,<br>
Lodha Corporation.

