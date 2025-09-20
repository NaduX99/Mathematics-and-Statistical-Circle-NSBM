<?php
include '../assets/php/extract.php'; 
include '../assets/php/auth.php';
$page_title = 'Dashboard';
  $active = 'dashboard';
// Your published Google Sheet CSV link
$csvUrl = "https://docs.google.com/spreadsheets/d/e/2PACX-1vQLwkBrPWa3Lm4vx4S8O6tosdN3UMJ9IuLs7kJQv5IiFXD5PzEG4p-vEAcYpYMPXHyK7KooafbltjiT/pub?output=csv";
// Fetch CSV content
$data = file_get_contents($csvUrl);
$rows = array_map("str_getcsv", explode("\n", $data));
// Separate header and body
$headers = array_shift($rows);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../assets/php/admin_head.php'; ?>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>📊 Analytics Dashboard - Mathematics & Statistics Circle</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
    
    
    /* Mathematical background pattern */
   
    
    .container {
      max-width: 1200px;
      margin: 0 auto;
      position: relative;
      z-index: 1;
    }
    
    .header {
      text-align: center;
      margin-bottom: 40px;
      color: white;
    }
    
    .header h1 {
      font-size: 2.5rem;
      font-weight: 700;
      margin-bottom: 10px;
      text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
      background: linear-gradient(45deg, #00ff809c, #32cd329c);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }
    
    .header p {
      font-size: 1.1rem;
      opacity: 0.9;
      color: #cccccc;
    }
    
    .dashboard-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
      margin-bottom: 40px;
    }
    
    .chart-card {
      background: rgba(40, 40, 40, 0.9);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      padding: 30px;
      box-shadow: 
        0 8px 32px rgba(0, 255, 127, 0.1),
        0 0 0 1px rgba(0, 255, 127, 0.2);
      border: 1px solid rgba(0, 255, 127, 0.3);
      transition: all 0.3s ease;
    }
    
    .chart-card:hover {
      transform: translateY(-5px);
      box-shadow: 
        0 12px 40px rgba(0, 255, 127, 0.2),
        0 0 0 1px rgba(0, 255, 127, 0.4);
      border-color: rgba(0, 255, 127, 0.5);
    }
    
    .chart-title {
      font-size: 1.3rem;
      font-weight: 600;
      margin-bottom: 20px;
      color: #00ff7f;
      text-align: center;
    }
    
    .chart-container {
      position: relative;
      height: 300px;
    }
    
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
      margin-bottom: 40px;
    }
    
    .stat-card {
      background: rgba(40, 40, 40, 0.8);
      backdrop-filter: blur(10px);
      border-radius: 15px;
      padding: 25px;
      text-align: center;
      box-shadow: 
        0 8px 32px rgba(0, 255, 127, 0.1),
        0 0 0 1px rgba(0, 255, 127, 0.2);
      border: 1px solid rgba(0, 255, 127, 0.3);
      transition: all 0.3s ease;
    }
    
    .stat-card:hover {
      transform: scale(1.05);
      background: rgba(40, 40, 40, 0.95);
      box-shadow: 
        0 12px 40px rgba(0, 255, 127, 0.2),
        0 0 0 1px rgba(0, 255, 127, 0.4);
    }
    
    .stat-number {
      font-size: 2.5rem;
      font-weight: 700;
      color: #00ff7f;
      margin-bottom: 10px;
      text-shadow: 0 0 10px rgba(0, 255, 127, 0.3);
    }
    
    .stat-label {
      font-size: 1rem;
      color: #cccccc;
      font-weight: 500;
    }
    
    .data-table-card {
      background: rgba(40, 40, 40, 0.9);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      padding: 30px;
      box-shadow: 
        0 8px 32px rgba(0, 255, 127, 0.1),
        0 0 0 1px rgba(0, 255, 127, 0.2);
      border: 1px solid rgba(0, 255, 127, 0.3);
      overflow: hidden;
    }
    
    .table-title {
      font-size: 1.5rem;
      font-weight: 600;
      margin-bottom: 20px;
      color: #00ff7f;
      text-align: center;
    }
    
    .table-wrapper {
      overflow-x: auto;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }
    
    table {
      width: 100%;
      border-collapse: collapse;
      background: rgba(30, 30, 30, 0.9);
    }
    
    th {
      background: linear-gradient(135deg, #00ff7f, #32cd32);
      color: #000000;
      padding: 15px 12px;
      text-align: left;
      font-weight: 600;
      border: none;
      position: sticky;
      top: 0;
      z-index: 10;
    }
    
    td {
      padding: 12px;
      border-bottom: 1px solid rgba(0, 255, 127, 0.2);
      transition: background-color 0.2s ease;
      color: #ffffff;
    }
    
    tr:hover td {
      background-color: rgba(0, 255, 127, 0.1);
    }
    
    tr:nth-child(even) {
      background-color: rgba(255, 255, 255, 0.05);
    }
    
    .chart-controls {
      text-align: center;
      margin-bottom: 20px;
    }
    
    .chart-controls select {
      padding: 10px 15px;
      border-radius: 8px;
      border: 2px solid #00ff8095;
      background: rgba(40, 40, 40, 0.9);
      color: #ffffff;
      font-size: 1rem;
      cursor: pointer;
      transition: all 0.3s ease;
    }
    
    .chart-controls select:hover {
      border-color: #32cd32;
      box-shadow: 0 0 15px rgba(0, 255, 127, 0.3);
    }
    
    .chart-controls select option {
      background: #2a2a2a;
      color: #ffffff;
    }
    
    .loading {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 200px;
      color: #00ff7f;
      font-size: 1.2rem;
    }
    
    .spinner {
      border: 3px solid rgba(255, 255, 255, 0.3);
      border-top: 3px solid #00ff7f;
      border-radius: 50%;
      width: 30px;
      height: 30px;
      animation: spin 1s linear infinite;
      margin-right: 15px;
    }
    
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
    
    .export-btn {
      background: linear-gradient(135deg, #00ff7f, #32cd32);
      color: #000000;
      border: none;
      padding: 12px 25px;
      border-radius: 10px;
      cursor: pointer;
      font-size: 1rem;
      font-weight: 600;
      transition: all 0.3s ease;
      margin: 10px;
      box-shadow: 0 4px 15px rgba(0, 255, 127, 0.3);
    }
    
    .export-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(0, 255, 127, 0.4);
      background: linear-gradient(135deg, #32cd32, #00ff7f);
    }
    
    /* Mathematical symbols decoration */
    .math-symbol {
      position: absolute;
      font-size: 2rem;
      color: rgba(0, 255, 127, 0.1);
      pointer-events: none;
      font-family: 'Times New Roman', serif;
    }
    
    .math-symbol:nth-child(1) { top: 10%; left: 5%; }
    .math-symbol:nth-child(2) { top: 20%; right: 10%; }
    .math-symbol:nth-child(3) { bottom: 30%; left: 8%; }
    .math-symbol:nth-child(4) { bottom: 10%; right: 5%; }
    
    @media (max-width: 768px) {
      .dashboard-grid {
        grid-template-columns: 1fr;
      }
      
      .header h1 {
        font-size: 2rem;
      }
      
      .stats-grid {
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
      }
      
      .chart-card {
        padding: 20px;
      }
      
      .math-symbol {
        font-size: 1.5rem;
      }
    }
    
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    @media print {
      /* Page setup */
      @page {
        size: A4 portrait;   /* Portrait for most pages */
        margin: 15mm;
  }

  body {
    background: white !important;
    color: black !important;
    display: block !important;
    overflow: visible !important;
    font-size: 12pt;
  }

  /* Hide buttons and UI elements */
  .export-btn, .no-print {
    display: none !important;
  }

  /* Cards (charts, stats, etc.) */
  .chart-card, .data-table-card {
    box-shadow: none !important;
    border: 1px solid #ddd !important;
    background: white !important;
    width: 100% !important;
    max-width: 100% !important;
    height: auto !important;
    max-height: none !important;
    page-break-inside: avoid;   /* don’t split cards mid-page */
    margin-bottom: 15px;
  }

  /* Ensure charts scale */
  svg, canvas {
    max-width: 100% !important;
    height: auto !important;
  }

  /* Text & titles */
  .header h1, .chart-title, .table-title, .stat-number {
    color: #333 !important;
  }

  /* Data tables */
  table {
    width: 100% !important;
    border-collapse: collapse !important;
    page-break-inside: auto;
    font-size: 11pt;
    word-break: break-word;
  }

  table th, table td {
    padding: 4px 6px;
    border: 1px solid #ddd;
  }

  table tr {
    page-break-inside: avoid;
    page-break-after: auto;
  }

  /* If a table is too wide → rotate that page */
  .wide-table {
    page: widePage;
  }

  @page widePage {
    size: A4 landscape;  /* Landscape for wide tables */
    margin: 10mm;
  }

  /* Manual page breaks */
  .page-break {
    page-break-before: always;
  }
}

    /* Modern Link Styles */
a {
    color: #00ff7f;
    text-decoration: none;
    position: relative;
    transition: all 0.3s ease;
    font-family:"Gill Sans", sans-serif;
}

a:hover {
    color: #8916e7ff;
}




  </style>
</head>
<body class="admin-shell">
    <?php include '../assets/php/admin_header.php'; ?>
  <!-- Mathematical symbols decoration -->
  <div class="math-symbol">∑</div>
  <div class="math-symbol">∫</div>
  <div class="math-symbol">π</div>
  <div class="math-symbol">∞</div>
  
  <div class="container">
    
    
    <!-- Statistics Overview -->
    <div class="stats-grid">
      <div class="stat-card">
        <div class="stat-number" id="totalResponses">-</div>
        <div class="stat-label">Total Responses</div>
      </div>
      <div class="stat-card">
        <div class="stat-number" id="totalQuestions">-</div>
        <div class="stat-label">Questions Asked</div>
      </div>
      <div class="stat-card">
        <div class="stat-number" id="completionRate">-</div>
        <div class="stat-label">Completion Rate</div>
      </div>
      <div class="stat-card">
        <div class="stat-number" id="avgLength">-</div>
        <div class="stat-label">Avg Response Length</div>
      </div>
      <div class="stat-card">
        <div class="stat-number" id="totalResponses">View Excel</div>
        <div class="stat-label"><a href="https://docs.google.com/spreadsheets/d/1OvhqD0aKNetPC-9nkBrJMLCdOqlK4HnXiWCT3NYd888/edit?resourcekey=&gid=1346886952#gid=1346886952">Click it</a></div>
      </div>
    </div>
    
    <!-- Charts Grid -->
    <div class="dashboard-grid">
      <div class="chart-card">
        <div class="chart-title">📈 Response Distribution</div>
        <div class="chart-controls">
          <select id="columnSelector1">
            <?php for($i = 1; $i < count($headers); $i++): ?>
              <option value="<?= $i ?>"><?= htmlspecialchars($headers[$i]) ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <div class="chart-container">
          <canvas id="barChart"></canvas>
        </div>
      </div>
      <div class="chart-card">
        <div class="chart-title">🥧 Response Breakdown</div>
        <div class="chart-controls">
          <select id="columnSelector2">
            <?php for($i = 1; $i < count($headers); $i++): ?>
              <option value="<?= $i ?>"><?= htmlspecialchars($headers[$i]) ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <div class="chart-container">
          <canvas id="pieChart"></canvas>
        </div>
      </div>
    </div>
    
    <!-- Additional Charts -->
    <div class="dashboard-grid">
      <div class="chart-card">
        <div class="chart-title">📊 Responses Over Time</div>
        <div class="chart-container">
          <canvas id="timeChart"></canvas>
        </div>
      </div>
      <div class="chart-card">
        <div class="chart-title">🎯 Top Responses</div>
        <div class="chart-container">
          <canvas id="horizontalChart"></canvas>
        </div>
      </div>
    </div>
    
    <!-- Export Controls -->
    <div style="text-align: center; margin: 30px 0;">
      <button class="export-btn" onclick="exportData('csv')">📄 Export CSV</button>
      <button class="export-btn" onclick="exportData('json')">📋 Export JSON</button>
      <button class="export-btn" onclick="printCharts()">🖨️ Print Report</button>
    </div>
    
    <!-- Data Table -->
    <div class="data-table-card">
      <h2 class="table-title">📋 Complete Response Data</h2>
      <div class="table-wrapper">
        <table id="responseTable">
          <thead>
            <tr>
              <?php foreach ($headers as $h): ?>
                <th><?= htmlspecialchars($h) ?></th>
              <?php endforeach; ?>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($rows as $rowIndex => $row): ?>
              <?php if (count($row) > 1): ?>
              <tr>
                <?php foreach ($row as $cell): ?>
                  <td><?= htmlspecialchars($cell) ?></td>
                <?php endforeach; ?>
              </tr>
              <?php endif; ?>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // Pass PHP data to JS
  const rawRows = <?php echo json_encode($rows); ?>;
  const headers = <?php echo json_encode($headers); ?>;
  
  // Filter out empty rows
  const rows = rawRows.filter(row => row.length > 1 && row.some(cell => cell.trim()));
  
  // Global chart instances
  let barChart, pieChart, timeChart, horizontalChart;
  
  // Updated color palettes for green theme
  const colors = [
    '#00ff7f', '#32cd32', '#90ee90', '#98fb98', '#3cb371',
    '#2e8b57', '#00fa9a', '#00ffff', '#40e0d0', '#48d1cc',
    '#20b2aa', '#008b8b', '#7fffd4', '#66cdaa', '#adff2f'
  ];
  
  // Update statistics
  function updateStats() {
    document.getElementById('totalResponses').textContent = rows.length;
    document.getElementById('totalQuestions').textContent = headers.length;
    
    const completedRows = rows.filter(row => 
      row.filter(cell => cell && cell.trim()).length === headers.length
    );
    const completionRate = Math.round((completedRows.length / rows.length) * 100);
    document.getElementById('completionRate').textContent = completionRate + '%';
    
    const avgLength = Math.round(
      rows.reduce((sum, row) => sum + row.join(' ').length, 0) / rows.length
    );
    document.getElementById('avgLength').textContent = avgLength + ' chars';
  }
  
  // Create charts with updated styling
  function createBarChart(columnIndex = 1) {
    const ctx = document.getElementById('barChart').getContext('2d');
    
    if (barChart) barChart.destroy();
    
    let counts = {};
    rows.forEach(row => {
      if (row.length > columnIndex && row[columnIndex]) {
        let answer = row[columnIndex].trim();
        if (answer) {
          counts[answer] = (counts[answer] || 0) + 1;
        }
      }
    });
    
    const sortedEntries = Object.entries(counts)
      .sort(([,a], [,b]) => b - a)
      .slice(0, 10); // Top 10 responses
    
    barChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: sortedEntries.map(([label]) => 
          label.length > 20 ? label.substring(0, 20) + '...' : label
        ),
        datasets: [{
          label: headers[columnIndex] || 'Responses',
          data: sortedEntries.map(([, count]) => count),
          backgroundColor: colors.slice(0, sortedEntries.length),
          borderColor: colors.slice(0, sortedEntries.length),
          borderWidth: 2,
          borderRadius: 8,
          borderSkipped: false,
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: { 
            display: false 
          },
          tooltip: {
            backgroundColor: 'rgba(0,0,0,0.9)',
            titleColor: '#00ff7f',
            bodyColor: 'white',
            borderColor: '#00ff7f',
            borderWidth: 1
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            grid: { color: 'rgba(0, 255, 127, 0.2)' },
            ticks: { color: '#cccccc' }
          },
          x: {
            grid: { display: false },
            ticks: { 
              color: '#cccccc',
              maxRotation: 45,
              minRotation: 0
            }
          }
        }
      }
    });
  }
  
  function createPieChart(columnIndex = 1) {
    const ctx = document.getElementById('pieChart').getContext('2d');
    
    if (pieChart) pieChart.destroy();
    
    let counts = {};
    rows.forEach(row => {
      if (row.length > columnIndex && row[columnIndex]) {
        let answer = row[columnIndex].trim();
        if (answer) {
          counts[answer] = (counts[answer] || 0) + 1;
        }
      }
    });
    
    const sortedEntries = Object.entries(counts)
      .sort(([,a], [,b]) => b - a)
      .slice(0, 8); // Top 8 for better visibility
    
    pieChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: sortedEntries.map(([label]) => 
          label.length > 15 ? label.substring(0, 15) + '...' : label
        ),
        datasets: [{
          data: sortedEntries.map(([, count]) => count),
          backgroundColor: colors.slice(0, sortedEntries.length),
          borderColor: 'rgba(40, 40, 40, 0.9)',
          borderWidth: 3,
          hoverOffset: 10
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: 'bottom',
            labels: {
              padding: 20,
              usePointStyle: true,
              font: { size: 12 },
              color: '#cccccc'
            }
          },
          tooltip: {
            backgroundColor: 'rgba(0,0,0,0.9)',
            titleColor: '#00ff7f',
            bodyColor: 'white'
          }
        }
      }
    });
  }
  
  function createTimeChart() {
    const ctx = document.getElementById('timeChart').getContext('2d');
    
    if (timeChart) timeChart.destroy();
    
    // Group responses by date (assuming first column is timestamp)
    let dailyCounts = {};
    rows.forEach(row => {
      if (row[0]) {
        let date = new Date(row[0]).toDateString();
        dailyCounts[date] = (dailyCounts[date] || 0) + 1;
      }
    });
    
    const sortedDates = Object.keys(dailyCounts).sort((a, b) => new Date(a) - new Date(b));
    
    timeChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: sortedDates.map(date => 
          new Date(date).toLocaleDateString('en-US', { month: 'short', day: 'numeric' })
        ),
        datasets: [{
          label: 'Daily Responses',
          data: sortedDates.map(date => dailyCounts[date]),
          borderColor: '#00ff7f',
          backgroundColor: 'rgba(0, 255, 127, 0.2)',
          borderWidth: 3,
          fill: true,
          tension: 0.4,
          pointBackgroundColor: '#00ff7f',
          pointBorderColor: 'rgba(40, 40, 40, 0.9)',
          pointBorderWidth: 2,
          pointRadius: 6,
          pointHoverRadius: 8
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: { 
            display: false 
          },
          tooltip: {
            backgroundColor: 'rgba(0,0,0,0.9)',
            titleColor: '#00ff8094',
            bodyColor: 'white'
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            grid: { color: 'rgba(0, 255, 127, 0.2)' },
            ticks: { color: '#cccccc' }
          },
          x: {
            grid: { display: false },
            ticks: { color: '#cccccc' }
          }
        }
      }
    });
  }
  
  function createHorizontalChart() {
    const ctx = document.getElementById('horizontalChart').getContext('2d');
    
    if (horizontalChart) horizontalChart.destroy();
    
    // Use second column for horizontal chart
    let counts = {};
    rows.forEach(row => {
      if (row.length > 1 && row[1]) {
        let answer = row[1].trim();
        if (answer) {
          counts[answer] = (counts[answer] || 0) + 1;
        }
      }
    });
    
    const sortedEntries = Object.entries(counts)
      .sort(([,a], [,b]) => b - a)
      .slice(0, 6); // Top 6 for horizontal display
    
    horizontalChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: sortedEntries.map(([label]) => 
          label.length > 25 ? label.substring(0, 25) + '...' : label
        ),
        datasets: [{
          label: 'Count',
          data: sortedEntries.map(([, count]) => count),
          backgroundColor: colors.slice(0, sortedEntries.length),
          borderColor: colors.slice(0, sortedEntries.length),
          borderWidth: 2,
          borderRadius: 6,
        }]
      },
      options: {
        indexAxis: 'y',
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: { display: false },
          tooltip: {
            backgroundColor: 'rgba(0,0,0,0.9)',
            titleColor: '#00ff809d',
            bodyColor: 'white'
          }
        },
        scales: {
          x: {
            beginAtZero: true,
            grid: { color: 'rgba(0, 255, 127, 0.2)' },
            ticks: { color: '#cccccc' }
          },
          y: {
            grid: { display: false },
            ticks: { color: '#cccccc' }
          }
        }
      }
    });
  }
  
  // Export functionality
  function exportData(format) {
    if (format === 'csv') {
      let csvContent = headers.join(',') + '\n';
      rows.forEach(row => {
        csvContent += row.map(cell => `"${cell}"`).join(',') + '\n';
      });
      downloadFile(csvContent, 'form_responses.csv', 'text/csv');
    } else if (format === 'json') {
      const jsonData = rows.map(row => {
        let obj = {};
        headers.forEach((header, i) => {
          obj[header] = row[i] || '';
        });
        return obj;
      });
      downloadFile(JSON.stringify(jsonData, null, 2), 'form_responses.json', 'application/json');
    }
  }
  
  function downloadFile(content, filename, mimeType) {
    const blob = new Blob([content], { type: mimeType });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = filename;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
  }
  
  function printCharts() {
    window.print();
  }
  
  // Event listeners
  document.getElementById('columnSelector1').addEventListener('change', (e) => {
    createBarChart(parseInt(e.target.value));
  });
  
  document.getElementById('columnSelector2').addEventListener('change', (e) => {
    createPieChart(parseInt(e.target.value));
  });
  
  // Initialize dashboard
  document.addEventListener('DOMContentLoaded', () => {
    updateStats();
    createBarChart(1);
    createPieChart(1);
    createTimeChart();
    createHorizontalChart();
    
    // Add loading animation
    setTimeout(() => {
      document.querySelectorAll('.stat-card').forEach((card, index) => {
        card.style.animation = `fadeInUp 0.6s ease ${index * 0.1}s both`;
      });
    }, 100);
  });
</script>
</body>
</html>
