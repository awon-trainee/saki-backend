<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Your Barcode</title>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.6/dist/barcodes/JsBarcode.code128.min.js"></script>
</head>
<body style="display: flex; width: 100dvw; height: 100dvh; align-items: center; justify-items: center; margin: 0">
<svg id="barcode" style=""/>
<script>
    JsBarcode("#barcode", "{{$text}}", {
        width: 1
    })

    const barcode = document.getElementById('barcode');
    // clear all styles
    barcode.style.transform = 'none';
    barcode.width.baseVal.valueAsString = '100%';
    barcode.height.baseVal.valueAsString = '100%';
</script>
</body>
</html>