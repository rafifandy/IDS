<head>
    <title>Barcode</title>

    <style>
        .text-center{
            text-align: center;
        }
        td{
            padding: 7px;
        }
        @page { margin: 0px; }
        body { margin: 0px; }
    </style>
</head>
<body>
@php
    $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
    $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
@endphp
<?php
    $no=1;
?>
<table>
    
    <tr>
    @foreach(range(0,$panjang) as $key)
    @if($x++ <= $panjang)
        <td style="text-align: center; border: 0px solid black" width="111" height="44">
        </td>
    @if ($no++ % 5 == 0)
    </tr>
    <tr>
    @endif
    @else
    @foreach($barang as $data)
    @for ($i=0;$i < $jml;$i++)
        <td style="text-align: center; border: 0px solid black" width="111" height="44" display:block>
            <img width="120" src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode($data->id_barang, $generatorPNG::TYPE_CODE_128)) }}"><br>
            <!-- {!! $generator->getBarcode($data->id_barang, $generator::TYPE_CODE_128) !!} -->
            {{ $data->id_barang }}<br>
            {{ $data->nama }}
        </td>

        

    @if ($no++ % 5 == 0)
    </tr>
    <tr>
    @endif
    @endfor
    @endforeach
    @endif
    @endforeach
    </tr>
</table>
</body>
</html>