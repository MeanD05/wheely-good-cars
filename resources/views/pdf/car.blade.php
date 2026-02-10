<!doctype html>
<html lang="nl">
<head>
  <meta charset="utf-8">
  <title>Voertuigoverzicht</title>
  <style>
    @page { margin: 20px; }

    body {
      font-family: DejaVu Sans, sans-serif;
      font-size: 11px;
      color: #111;
    }

    .brandbar {
      border-bottom: 2px solid #111;
      padding-bottom: 10px;
      margin-bottom: 12px;
    }

    .brand {
      font-size: 12px;
      letter-spacing: 2px;
      text-transform: uppercase;
      color: #444;
      margin: 0 0 6px;
    }

    .title {
      font-size: 20px;
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
      padding: 8px 10px;
      text-align: right;
      width: 155px;
    }

    .badge .label {
      font-size: 10px;
      color: #666;
      text-transform: uppercase;
      letter-spacing: 1px;
      margin: 0 0 4px;
    }

    .badge .price {
      font-size: 16px;
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
      padding: 10px;
      margin: 8px 0;
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
      padding: 6px 0;
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
      padding: 6px;
      box-sizing: border-box;
    }

    .card-inner {
      border: 1px solid #e6e6e6;
      padding: 10px;
      height: 64px;
    }

    .card-label {
      font-size: 10px;
      color: #666;
      text-transform: uppercase;
      letter-spacing: 1px;
      margin: 0 0 6px;
    }

    .card-value {
      font-size: 13px;
      font-weight: 700;
      margin: 0;
    }

    .foot {
      margin-top: 12px;
      padding-top: 10px;
      border-top: 1px solid #e6e6e6;
      color: #666;
      font-size: 9.5px;
    }

    .foot strong { color: #111; }

    .muted { color: #666; }

    .terms {
      font-size: 9.5px;
      color: #555;
      line-height: 1.4;
    }

    .terms ul {
      margin: 4px 0 0 14px;
      padding: 0;
    }

    .terms li {
      margin: 3px 0;
    }
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
        <div class="spec"><span class="k">Status</span><span class="v">{{ $car->sold_at ? 'Verkocht' : 'Beschikbaar' }}</span></div>
      </div>
    </div>
  </div>

  <div class="section">
    <p class="section-title">Aanbieder</p>

    <div class="cols">
      <div class="col">
        <div class="spec"><span class="k">Naam</span><span class="v">{{ $user->name ?? '-' }}</span></div>
        <div class="spec"><span class="k">E-mail</span><span class="v">{{ $user->email ?? '-' }}</span></div>
        <div class="spec"><span class="k">Telefoon</span><span class="v">{{ $user->phone_number ?? '-' }}</span></div>
      </div>
      <div class="col">
        <div class="spec"><span class="k">Referentie</span><span class="v">{{ $car->license_plate ?? '-' }}</span></div>
        <div class="spec"><span class="k">Document</span><span class="v">{{ $car->id ?? '-' }}</span></div>
      </div>
    </div>
  </div>

  <div class="section">
    <p class="section-title">Voorwaarden en disclaimer</p>
    <div class="terms">
      <p class="muted">Deze voertuigkaart is informatief en niet bindend.</p>
      <ul>
        <li>Prijzen en beschikbaarheid zijn onder voorbehoud van bevestiging door de aanbieder.</li>
        <li>Kilometerstand en specificaties zijn overgenomen uit invoer en kunnen afwijken.</li>
        <li>Typefouten en omissies voorbehouden.</li>
        <li>Inspectie en proefrit worden aanbevolen voor aankoop.</li>
        <li>De uiteindelijke verkoopinformatie wordt vastgelegd in het koopcontract.</li>
      </ul>
    </div>
  </div>

  <div class="foot">
    Opgesteld voor <strong>{{ $user->name ?? $user->email }}</strong>.
    Dit overzicht is automatisch gegenereerd en kan afwijken van de uiteindelijke verkoopinformatie.
  </div>

</body>
</html>
