<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Next Invoice</title>
    <style>
        body{
            font-family: "Courier New", Courier, "Lucida Sans Typewriter", "Lucida Typewriter", monospace !important;
            letter-spacing: -0.3px;
        }
        .invoice-wrapper{ width: 700px; margin: auto; }
        .nav-sidebar .nav-header:not(:first-of-type){ padding: 1.7rem 0rem .5rem; }
        .logo{ font-size: 50px; }
        .sidebar-collapse .brand-link .brand-image{ margin-top: -33px; }
        .content-wrapper{ margin: auto !important; }
        .billing-company-image { width: 50px; }
        .billing_name { text-transform: uppercase; }
        .billing_address { text-transform: capitalize; }
        .table{ width: 100%; border-collapse: collapse; }
        th{ text-align: left; padding: 10px; }
        td{ padding: 10px; vertical-align: top; }
        .row{ display: block; clear: both; }
        .text-right{ text-align: right; }
        .table-hover thead tr{ background: darkgrey; }
        .table-hover tbody tr:nth-child(even){ background:lightcyan }
        address{ font-style: normal; }
    </style>
</head>
<body>
    <div class="row invoice-wrapper">
        <div class="col-md-12">
            <div class="row">
                <div class="col-12">
                    <table class="table">
                        <tr>
                            <td>
                                <h4>
                                    <span class="">Next CRM</span>
                                </h4>
                            </td>
                            <td class="text-right">
                                <strong>{{ today()->format('D d M Y') }}</strong>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <br><br>
            <div class="row invoice-info">
                <table class="table">
                    <tr>
                        <td>
                            <div class="text-left">
                                From
                                <address>
                                    <strong>Next CRM</strong><br>
                                    427/428 G4, M.A Johar Town Rd,<br>
                                    Block G4 Phase 2 Johar Town, Lahore, Punjab 54000<br>
                                    Email: nextcrm@nxb.com.pk<br>
                                    Phone: +1234567890
                                </address>
                            </div>
                        </td>
                        <td>
                            <div class="text-right">
                                To
                                <address>
                                    <strong class="billing_name">{{ $name }}</strong><br>
                                    Phone: {{ $phone }}<br>
                                    Email: {{ $email }}
                                </address>
                            </div>
                        </td>

                    </tr>
                </table>
                <div>
                    --------------------------------------------------------------------------
                </div>
                <!-- /.col -->
            </div>
            <br><br>
            <div class="row">
                <div class="col-16 table-responsive">
                    <table class="table table-condensed table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Service</th>
                                <th>Description</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>{{ $service }}</td>
                                <td> {{ $descreption }}</td>
                                <td class=""><strong>{{ $price }}</strong>/-</td>
                            </tr>

                            <tr style="color: green;">
                                <td colspan="3" class="text-right">Sub Total</td>
                                <td class=""><strong>{{ $price }}</strong>/-</td>
                            </tr>

                            <tr style="color: orange;">
                                <td colspan="3" class="text-right">Tax 18%</td>
                                <td class=""><strong>{{ $price * 0.18  }}</strong>/-</td>
                            </tr>

                            <tr style="color: red;">
                                <td colspan="3" class="text-right">Total Payable</td>
                                <td class=""><strong>{{ $price + ($price * 0.18) }}</strong>/-</td>
                            </tr>

                        </tbody>


                    </table>
                </div>
                <!-- /.col -->
            </div>
            <br><br><br>
            <div>
                <small><small>NOTE: This is system generate invoice no need of signature</small></small>
            </div>
        </div>
    </div>
</body>
</html>
