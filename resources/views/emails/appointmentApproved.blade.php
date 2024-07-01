<!DOCTYPE html>
<html>
<head>
    <title>Appointment Approved</title>
</head>
<body>
    <h1>Your appointment has been approved</h1>
    <p>Dear Mr./Mrs. {{ $appointment->user->lastname }} ,</p>
    <p>Your appointment on SMILETECH with reference number <b>{{ $appointment->reference_number }}</b> has been approved.</p>
    <p>Appointment Date: <b>{{ (new DateTime($appointment->date))->format('F j, Y') }}</b></p>
    <p>Thank you!</p>
</body>
</html>
