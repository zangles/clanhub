<head>
    <title>{{config('app.name')}}</title>
    <!-- as of IE9 cannot parse css files with more that 4K classes separating in two files -->
    <!--[if IE 9]>
    <link href="css/application-ie9-part2.css" rel="stylesheet">
    <![endif]-->
    <link rel="shortcut icon" href="img/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="ClanHub - Un lugar para tu gremio">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <script>
        /* yeah we need this empty stylesheet here. It's cool chrome & chromium fix
        chrome fix https://code.google.com/p/chromium/issues/detail?id=167083
        https://code.google.com/p/chromium/issues/detail?id=332189
        */
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-36759672-9"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js" integrity="sha512-lC8vSUSlXWqh7A/F+EUS3l77bdlj+rGMN4NB5XFAHnTR3jQtg4ibZccWpuSSIdPoPUlUxtnGktLyrWcDhG8RvA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'UA-36759672-9');
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.css" integrity="sha512-zKvhCkM8b3JMULax/MlTkNk4gQwMbY8CqpDQC74/n7H6UK3HOZA/mO/fvjhVlh0V/E6PCrp4U6Lw6pnueS9HCQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite('resources/css/application.min.css')
    @vite('resources/css/datepicker.css')
    @vite('resources/css/myBootstrap.css')
    <style>
        .js-sidebar-content {
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        .sidebar-abajo {
            margin-top: auto;
        }

        .btnInputGroupAppend {
            background-color: rgba(0, 0, 0, 0.24);
            color: rgba(244, 244, 245, 0.7)
        }
        .btnInputGroupPrepend {
            background-color: rgba(0, 0, 0, 0.24);
            color: rgba(244, 244, 245, 0.7)
        }
        input.parsley-error {
            border: 1px solid #7a7f9a; !important;
        }
        .invalid-feedback{
            color: #7a7f9a; !important;
            font-weight: bold;
        }
    </style>
</head>
