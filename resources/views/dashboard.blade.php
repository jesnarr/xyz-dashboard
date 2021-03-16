<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Full stack</title>

        <link rel="stylesheet" href="/css/all.css">
        <link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
       
        <script>
            (function (){
                window.Laravel = {
                    csrfToken: '{{ csrf_token()}}'
                };
            })();

        </script>
     
    </head>
    <body>
        <div id="app">
   
     
            <mainapp></mainapp>
     
        </div>
    </body>
    <script src="{{mix('js/app.js')}}"></script>
</html>
