<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"></script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Document</title>
    <style>
        body {
            text-align: center;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        .header {
            font-size: 2.5em;
            font-weight: 1000;

            color: #006400;
            text-align: center;
            border-bottom: 2px solid #006400;
            margin-bottom: 20px;
        }

        .email {
            text-align: justify;
            width: 60%;
        }



        .dear {
            font-size: 1em;
            font-weight: 1000;
            margin-bottom: 15px;
        }

        .sentence_1,
        .sentence_2 {
            font-size: 1em;
        }

        .sentence_1,
        
        .contact1,
        .contact2,
        .footer {
            margin-bottom: 15px;
        }
        .sentence_2 {
            margin-bottom: 25px;
        }
        .phone,
        .name {
            font-weight: 1000;
        }
        .footer{
            margin-bottom: 40px;
        }
        .sincer{
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="header">
            Youth Savers Club Application
        </div>

        <div class="email">
            <div class="dear">
                Dear Youth,
            </div>
            <div class="sentence_1">

                {{$body['sentence_1']}}
            </div>
            <div class="sentence_2">
                {{$body['sentence_2']}} <span class="phone">{{$body['phone_no']}}</span>
            </div>

            <div class="contact1">
                <span class="name">
                    Jenny P. Suaffield
                </span> <br> OIC - Youth Coordinator <br> 0997-860-3718
            </div>
            <div class="contact2">
                <span class="name">Oshin Kenny C. Macahilos</span><br> OIC - Youth Coordinator <br> 0935-289-5982
            </div>
            <div class="footer">
                Thank you.
            </div>
            <div class="sincer">
                Sincerely, <br> Oro Integrated Cooperative
            </div>
            <div style="border-bottom: 2px solid #006400;"></div>
        </div>

    </div>
</body>

</html>