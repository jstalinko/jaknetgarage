<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    {{-- <title>JaknetGarage</title> --}}
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@6.9.96/css/materialdesignicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    @php
      $settings = json_decode(file_get_contents(storage_path('app/settings.json')) , true);
    @endphp
    <link rel="icon" href="{{ url('storage/'.$settings['icon']) }}">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <style type="text/css">
    .poppins-black,.poppins-bold,.poppins-extrabold,.poppins-extralight,.poppins-light,.poppins-medium,.poppins-regular,.poppins-semibold,.poppins-thin{font-family:Poppins,sans-serif;font-style:normal}.poppins-thin{font-weight:100}.poppins-extralight{font-weight:200}.poppins-light{font-weight:300}.poppins-regular{font-weight:400}.poppins-medium{font-weight:500}.poppins-semibold{font-weight:600}.poppins-bold{font-weight:700}.poppins-extrabold{font-weight:800}.poppins-black{font-weight:900}.poppins-black-italic,.poppins-bold-italic,.poppins-extrabold-italic,.poppins-extralight-italic,.poppins-light-italic,.poppins-medium-italic,.poppins-regular-italic,.poppins-semibold-italic,.poppins-thin-italic{font-family:Poppins,sans-serif;font-style:italic}.poppins-thin-italic{font-weight:100}.poppins-extralight-italic{font-weight:200}.poppins-light-italic{font-weight:300}.poppins-regular-italic{font-weight:400}.poppins-medium-italic{font-weight:500}.poppins-semibold-italic{font-weight:600}.poppins-bold-italic{font-weight:700}.poppins-extrabold-italic{font-weight:800}.poppins-black-italic{font-weight:900}
    </style>
    @inertiaHead
  </head>
  <body>
    @inertia
  </body>
</html>