<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>

        <style>
            *{
                font-family: 'Helvetica', sans-serif;
            }

            table{
                width: 100%;
            }
        </style>
    </head>
    <body>
        <table>

            <!-- Header -->
            <tr>
                <td>
                    <table>
                        <tr>
                            <td>
                                <img src="{{ asset('assets/img/logo.png') }}" alt="Kibarer Property">
                            </td>

                            <td>
                                <h4>Contact:</h4>
                                <h3>Kibarer Property</h3>
                                <p>
                                    Jalan Petitenget n.9 Seminyak,<br>
                                    Badung, Bali - Indonesia<br>
                                    +62 361 474 12 12 , +62 361 805 0000<br>
                                    alban@kibarer.com
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <!-- Title -->
            <tr>
                <td>
                    <h1>{{ $property->language->title }}</h1>
                </td>
            </tr>

            <!-- Body -->
            <tr>
                <td>
                    <table>
                        <tr>
                            <?php for($i = 0; $i < 2; $i++): ?>
                            <td width="33.33%">
                                <img src="http://loremflickr.com/320/240?t={{ microtime() }}" alt="">
                            </td>
                            @endfor
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td>
                    <table>
                        <tr>
                            <td>
                                <div class="gallery"></div>
                            </td>
                            <td class="details">
                                <table>
                                    <tr>
                                        <td>
                                            <h4>Property Detail:</h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table>
                                                <tr>
                                                    <td>
                                                        <ul>
                                                            <li>Location</li>
                                                            <li>Code</li>
                                                            <li>Bedroom</li>
                                                            <li>Bathroom</li>
                                                            <li>Land Size</li>
                                                            <li>Building Size</li>
                                                            <li>Price</li>
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        <ul>
                                                            <li>{{ $property->location }}</li>
                                                            <li>{{ $property->code }}</li>
                                                            <li>{{ $property->bedroom }}</li>
                                                            <li>{{ $property->bathroom }}</li>
                                                            <li>{{ $property->land_size }}</li>
                                                            <li>{{ $property->building_size }}</li>
                                                            <li>{{ $property->price }}</li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h4>Distances</h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h4>Additional Facilites</h4>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>
