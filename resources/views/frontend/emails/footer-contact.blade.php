<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>{{ __('staticText.new_contact_message') }}</title>
</head>

<body style="font-family: sans-serif; background-color: #f9fafb; padding: 40px;">
    <div style="max-width: 600px; margin: auto; background-color: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
        <h2 style="color: #1a202c; margin-bottom: 20px;">{{ __('staticText.footer_form_subject') }}</h2>

        <p><strong>{{ __('staticText.name') }}:</strong> {{ $contact->name }}</p>
        <p><strong>{{ __('staticText.surname') }}:</strong> {{ $contact->surname }}</p>
        <p><strong>{{ __('staticText.email') }}:</strong> {{ $contact->email }}</p>
        <p><strong>{{ __('staticText.subject') }}:</strong> {{ $contact->subject }}</p>

        <div style="margin-top: 20px;">
            <p><strong>{{ __('staticText.message') }}:</strong></p>
            <p style="white-space: pre-wrap;">{{ $contact->message }}</p>
        </div>

        <hr style="margin: 30px 0; border: none; border-top: 1px solid #e2e8f0;">

        <p style="font-size: 14px; color: #718096;"><em>{{ __('staticText.lang') }}:</em> {{ $contact->lang }}</p>
    </div>
</body>

</html>
