<!DOCTYPE html>
<html>
<head>
    <title>Appointment Cancelled</title>
</head>
<body>
    <h1>Your appointment has been approved</h1>
    <p>Dear Mr./Mrs. {{ $appointment->user->lastname }} ,</p>
    <p>Your appointment on SMILETECH with reference number <b>{{ $appointment->reference_number }}</b> has been cancelled.</p>
    <p>Appointment Date: <b>{{ (new DateTime($appointment->date))->format('F j, Y') }}</b></p>
    <p>We apologize for any inconvenience this may have caused.</p>
</body>
</html>
