<!doctype html>
<html lang="nl">
<head>
  <meta charset="utf-8">
  <title>Voertuigoverzicht</title>
  <style>
    @page { margin: 28px; }

    body {
      font-family: DejaVu Sans, sans-serif;
      font-size: 12px;
      color: #111;
    }

    .brandbar {
      border-bottom: 2px solid #111;
      padding-bottom: 14px;
      margin-bottom: 18px;
    }

    .brand {
      font-size: 12px;
      letter-spacing: 2px;
      text-transform: uppercase;
      color: #444;
      margin: 0 0 6px;
    }

    .title {
      font-size: 22px;
      font-weight: 700;
      margin: 0;
    }

    .subline {
      margin: 6px 0 0;
      color: #666;
      font-size: 11px;
    }

    .badge {
      float: right;
      border: 1px solid #111;
      padding: 10px 12px;
      text-align: right;
      width: 170px;
    }

    .badge .label {
      font-size: 10px;
      color: #666;
      text-transform: uppercase;
      letter-spacing: 1px;
      margin: 0 0 4px;
    }

    .badge .price {
      font-size: 18px;
      font-weight: 700;
      margin: 0;
    }

    .badge .status {
      margin: 6px 0 0;
      font-size: 11px;
      color: #666;
    }

    .clear { clear: both; }

    .section {
      border: 1px solid #e6e6e6;
      padding: 14px;
      margin: 12px 0;
    }

    .section-title {
      font-size: 11px;
      text-transform: uppercase;
      letter-spacing: 1px;
      color: #444;
      margin: 0 0 10px;
      font-weight: 700;
    }

    .cols {
      font-size: 0;
    }

    .col {
      display: inline-block;
      vertical-align: top;
      width: 50%;
      font-size: 12px;
    }

    .spec {
      padding: 8px 0;
      border-bottom: 1px solid #f0f0f0;
    }

    .spec:last-child {
      border-bottom: none;
    }

    .k {
      display: inline-block;
      width: 45%;
      color: #666;
    }

    .v {
      display: inline-block;
      width: 55%;
      font-weight: 600;
      color: #111;
    }

    .highlights {
      font-size: 0;
      margin-top: 6px;
    }

    .card {
      display: inline-block;
      vertical-align: top;
      width: 33.3333%;
      font-size: 12px;
      padding: 10px;
      box-sizing: border-box;
    }

    .card-inner {
      border: 1px solid #e6e6e6;
      padding: 12px;
      height: 78px;
    }

    .card-label {
      font-size: 10px;
      color: #666;
      text-transform: uppercase;
      letter-spacing: 1px;
      margin: 0 0 6px;
    }

    .card-value {
      font-size: 14px;
      font-weight: 700;
      margin: 0;
    }

    .foot {
      margin-top: 18px;
      padding-top: 12px;
      border-top: 1px solid #e6e6e6;
      color: #666;
      font-size: 10px;
    }

    .foot strong { color: #111; }

    .muted { color: #666; }
  </style>
</head>
<body>

  <div class="brandbar">
    <div class="badge">
      <p class="label">Vraagprijs</p>
      <p class="price">
        {{ $car->price ? '€ ' . number_format($car->price, 2, ',', '.') : '-' }}
      </p>
    </div>

    <p class="brand">Wheely Good Cars</p>
    <h1 class="title">{{ $car->make }} {{ $car->model }}</h1>
    <p class="subline">
      Kenteken: <strong>{{ $car->license_plate ?? '-' }}</strong>
      <span class="muted"> | </span>
      Datum: <strong>{{ now()->format('d-m-Y') }}</strong>
    </p>
    <div class="clear"></div>
  </div>

  <div class="section">
    <p class="section-title">Highlights</p>

    <div class="highlights">
      <div class="card">
        <div class="card-inner">
          <p class="card-label">Bouwjaar</p>
          <p class="card-value">{{ $car->production_year ?? '-' }}</p>
        </div>
      </div>
      <div class="card">
        <div class="card-inner">
          <p class="card-label">Kilometerstand</p>
          <p class="card-value">
            {{ $car->mileage ? number_format($car->mileage, 0, ',', '.') . ' km' : '-' }}
          </p>
        </div>
      </div>
      <div class="card">
        <div class="card-inner">
          <p class="card-label">Kleur</p>
          <p class="card-value">{{ $car->color ?? '-' }}</p>
        </div>
      </div>
    </div>
  </div>

  <div class="section">
    <p class="section-title">Specificaties</p>

    <div class="cols">
      <div class="col">
        <div class="spec"><span class="k">Merk</span><span class="v">{{ $car->make ?? '-' }}</span></div>
        <div class="spec"><span class="k">Model</span><span class="v">{{ $car->model ?? '-' }}</span></div>
        <div class="spec"><span class="k">Bouwjaar</span><span class="v">{{ $car->production_year ?? '-' }}</span></div>
        <div class="spec"><span class="k">Kleur</span><span class="v">{{ $car->color ?? '-' }}</span></div>
      </div>

      <div class="col">
        <div class="spec"><span class="k">Zitplaatsen</span><span class="v">{{ $car->seats ?? '-' }}</span></div>
        <div class="spec"><span class="k">Deuren</span><span class="v">{{ $car->doors ?? '-' }}</span></div>
        <div class="spec"><span class="k">Gewicht</span><span class="v">{{ $car->weight ? number_format($car->weight, 0, ',', '.') . ' kg' : '-' }}</span></div>
      </div>
    </div>
  </div>

  <div class="foot">
    Opgesteld voor <strong>{{ $user->name ?? $user->email }}</strong>.
    Dit overzicht is automatisch gegenereerd en kan afwijken van de uiteindelijke verkoopinformatie.
  </div>

</body>
</html>
