<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
        }

        .page-break {
            page-break-after: always !important;
        }

        @page {
            margin: 0.5cm 0.5cm 0.8cm 0.5cm;
        }

        body {
            font-family: 'Gothic A1', serif !important;
            font-size: 10pt !important;
        }

        .fa-1ix {
            font-size: 1.5em !important;
        }

        .btn-icon {
            padding: 5px;
            justify-content: center !important;
            overflow: hidden;
            border-radius: 100%;
            flex-shrink: 0;
            height: 30px;
            width: 30px;
            /*
            height: calc( (0.875rem * 1) + (0.875rem * 2) + (2px) ) !important;
            width: calc( (0.875rem * 1) + (0.875rem * 2) + (2px) ) !important;
            */
        }

        .btn-icon .feather {
            margin-top: 0 !important;
        }

        .btn-icon.btn-xl {
            height: calc( (1.125rem * 1) + (1.25rem * 2) + (2px) ) !important;
            width: calc( (1.125rem * 1) + (1.25rem * 2) + (2px) ) !important;
            border-radius: 100%;
        }

        .btn-icon.btn-lg, .btn-group-lg > .btn-icon.btn {
            height: calc( (1rem * 1) + (1.125rem * 2) + (2px) ) !important;
            width: calc( (1rem * 1) + (1.125rem * 2) + (2px) ) !important;
        }
        .btn-icon.btn-sm, .btn-group-sm > .btn-icon.btn {
            height: calc( (0.75rem * 1) + (0.5rem * 2) + (2px) ) !important;
            width: calc( (0.75rem * 1) + (0.5rem * 2) + (2px) ) !important;
        }

        .btn-icon.btn-xs {
            height: calc( (0.7rem * 1) + (0.25rem * 2) + (2px) ) !important;
            width: calc( (0.7rem * 1) + (0.25rem * 2) + (2px) ) !important;
            border-radius: 100%;
        }

        .btn-facebook {
            color: #fff !important;
            background-color: #3b5998 !important;
            border-color: #3b5998 !important;
        }

        .btn-linkedin {
            color: #fff !important;
            background-color: #0073b1 !important;
            border-color: #0073b1 !important;
        }

        .btn-youtube {
            color: #fff !important;
            background-color: #ff0000 !important;
            border-color: #ff0000 !important;
        }

        .btn-instagram {
            color: #fff !important;
            background-color: #702357 !important;
            border-color: #702357 !important;
        }

        .btn-web {
            color: #fff !important;
            background-color: #488e48 !important;
            border-color: #488e48 !important;
        }

        .btn-twitter {
            color: #fff !important;
            background-color: #1da1f2 !important;
            border-color: #1da1f2 !important;
        }

        .btn-verde-azul {
            color: #fff !important;
            background-color: #167225 !important;
            border-color: #167225 !important;
        }

        .mx-1 {
            margin-right: 0.25rem !important;
            margin-left: 0.25rem !important;
        }

        p{
            text-align: justify;
        }

        .subtitulo, .titulo {
            letter-spacing: 1px;
        }

        .subtitulo {
            font-family: Anton !important;
            font-size: 12pt !important;
            color: {{ ($sitio->usar_color_hv != null ? $sitio->usar_color_hv : '#29792b') }} !important;
        }

        .titulo {
            font-family: Anton !important;
            font-size: 14pt !important;
            color: {{ ($sitio->usar_color_hv != null ? $sitio->usar_color_hv : '#29792b') }} !important;
        }

        .divisor {
            color: #1D9738 !important;
            width: 70% !important;
            border: 0;
            height: 3px !important;
            background: #1D9738 !important;
            margin-top: 0 !important;
            margin-bottom: 5px !important;
        }

        /* Style the side navigation */
        .sidenav {
            background-color: #efefef !important;
        }

        .main-pic {
            width: 80%;
            height: 150px;
            margin: 30px auto;
        }

        .main-pic img {
            width: 80%;
            height: 150px;
            border-radius: 50%;
        }

        .mx-100 {
            margin-left: 100px;
            margin-right: 100px;
        }

        .acortar-texto {
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
        }

        main {
            width: 100%;

            padding: 0rem;
            border-radius: 0rem;
            border: none;
            background-color: none;
            margin-left: 0 !important;
            margin-right: 0 !important;
            /*padding-bottom: 2rem !important;*/
        }
        body {
            margin-top: 0 !important;
            background-color: transparent !important;
        }
        .section-descarga {
            display: none;
        }
        .acortar-texto {
            display: inline-block !important;
            overflow: visible !important;
        }
        #salto-email {
            display: block;
        }

        .espacio-imagen {
            padding-top: 2rem !important;
        }

        #logo{
            margin:0 21px;
        }

    </style>
</head>
<body>
    <div style="opacity:0.7;">
        <img src="{{ asset('footer-img/fb-logo-redondo.png') }}" width="15px"> @proservis.empleos  <img src="{{ asset('footer-img/twitter-logo-redondo.png') }}" width="15px"> @proservisempleo  <img src="{{ asset('footer-img/instagram-logo-redondo.png') }}" width="15px"> @proservis.empleos  <img src="{{ asset('footer-img/linkedin-logo-redondo.png') }}" width="15px"> @proservis  <img src="{{ asset('footer-img/youtube-logo-redondo.png') }}" width="15px"> @proservis  <img src="{{ asset('footer-img/Basket_Proservis.png') }}" width="15px"> www.proservis.com.co <img src="{{ asset('footer-img/logo_proservis.png') }}" id="logo" width="80px">
    </div>
</body>
</html>