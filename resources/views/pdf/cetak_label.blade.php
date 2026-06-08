<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Label TnJ 108</title>
    <style>
        @page { margin: 15mm 10mm; } 
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
        table { width: 100%; border-collapse: collapse; table-layout: fixed; }
        td { 
            width: 20%; 
            height: 33mm; 
            border: 1px dashed #ccc;
            text-align: center; 
            vertical-align: middle; 
            padding: 2px; 
            overflow: hidden; 
        }
        .harga { font-weight: bold; font-size: 16px; margin-top: 5px; color: #000; }
        .nama { font-size: 11px; line-height: 1.2; }
        .kode { font-size: 8px; color: #555; margin-top: 3px; }
    </style>
</head>
<body>
    <table>
        <tr>
        @foreach($data_cetak as $index => $item)
            @if($index > 0 && $index % 5 == 0)
                </tr><tr>
            @endif
            
            <td>
                @if($item)
                    <div class="nama">{{ $item->nama }}</div>
                    <div class="harga">Rp {{ number_format($item->harga, 0, ',', '.') }}</div>
                    <div class="kode">ID: {{ $item->id_barang }}</div>
                @endif
            </td>
        @endforeach
        
        @while((count($data_cetak) % 5) != 0)
            <td></td>
            @php $data_cetak[] = null; @endphp
        @endwhile
        </tr>
    </table>
</body>
</html>