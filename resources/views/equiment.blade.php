<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Equipment Details</title>
  <!-- <link rel="stylesheet" href="style.css" /> -->
  <style>
    body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  background: #f8f9fa;
}

header {
  background: #007bff;
  color: white;
  padding: 1rem;
  text-align: center;
}

main {
  padding: 2rem;
}

.equipment-info, .maintenance, .documents {
  background: white;
  padding: 1rem;
  margin-bottom: 1rem;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

footer {
  text-align: center;
  padding: 1rem;
  background: #e9ecef;
}

  </style>
</head>
<body>
  <header>
    <h1>Equipment Details</h1>
  </header>

  <main>
    <section class="equipment-info">
      <h2>Compressor Unit - Model X100</h2>
      <p><strong>Serial Number:</strong> EQ-123456</p>
      <p><strong>Location:</strong> Building A, Floor 2</p>
      <p><strong>Installed On:</strong> 2022-07-12</p>
      <p><strong>Status:</strong> ✅ Working</p>
    </section>

    <section class="maintenance">
      <h3>Maintenance History</h3>
      <ul>
        <li>2025-04-15: Routine check by John D.</li>
        <li>2025-01-20: Filter replaced</li>
      </ul>
    </section>

    <section class="documents">
      <h3>Manuals & Docs</h3>
      <a href="#">Download User Manual (PDF)</a>
    </section>
  </main>

  <footer>
    <p>© 2025 Equipment Tracker</p>
  </footer>
</body>
</html>
