<!-- Custom fonts for this template-->
<link href="{{ asset('js/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
      crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
      rel="stylesheet">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<!-- Custom styles for this template-->
<link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
<link href="{{ asset('css/bootstrap-datetimepicker.css') }}" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
<style>
    @media screen and (min-width: 1058px) {
        body {
            padding-left: 17px;
            width: calc(100vw - 17px);
        }
    }
    .hidden {
        display: none;
    }
    .loader {
        position: fixed;
        z-index: 99;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: transparent;
        opacity: 0.5;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .loader > img {
        width: 100px;
    }

    .loader.hidden {
        animation: fadeOut 1s;
        animation-fill-mode: forwards;
    }

    @keyframes fadeOut {
        100% {
            opacity: 0;
            visibility: hidden;
        }
    }

    .thumb {
        height: 100px;
        border: 1px solid black;
        margin: 10px;
    }
</style>
