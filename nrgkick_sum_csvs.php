<?php

# with the help of ChatGPT...

$dir = "."; // Directory containing the CSV files
$monthlyTotals = [];
$totalEnergyWh = 0;

// Process each CSV file
foreach (glob("$dir/*.csv") as $file) {
    // Open the file
    $handle = fopen($file, "r");
    if ($handle !== false) {
        // Read the header row to skip it
        $header = fgetcsv($handle, 0, ";");
        $header = fgetcsv($handle, 0, ";");
        $header = fgetcsv($handle, 0, ";");
        $header = fgetcsv($handle, 0, ";");

        // Process each data row
        while (($data = fgetcsv($handle, 0, ";")) !== false) {
            // Skip rows that do not have the required number of columns
            if (count($data) < 3 || empty($data[0]) || empty($data[2])) {
                continue;
            }

            // Extract the month from the Ladestart column (first column, DD.MM.YYYY format)
            $startDate = $data[0];
            $month = substr($startDate, 3, 2); // Extract MM from DD.MM.YYYY
            $year = substr($startDate, 6, 4); // Extract YYYY
            $monthKey = $year . $month; // Create YYYYMM key

            // Extract the Energie[Wh] value (third column) and add to the total
            $energyWh = (float)str_replace(",", ".", $data[2]); // Convert to a float
            $totalEnergyWh += $energyWh; // Add to the grand total

            if (!isset($monthlyTotals[$monthKey])) {
                $monthlyTotals[$monthKey] = 0;
            }
            $monthlyTotals[$monthKey] += $energyWh;
        }
        fclose($handle);
    }
}

// Calculate the total and average
$totalEnergyKWh = $totalEnergyWh / 1000; // Convert total to kWh
$numberOfMonths = count($monthlyTotals);
$averageEnergyKWh = $numberOfMonths > 0 ? $totalEnergyKWh / $numberOfMonths : 0;

// Print the monthly totals in kWh
echo "Monthly Totals (kWh):\n";
foreach ($monthlyTotals as $month => $totalWh) {
    $kwh = $totalWh / 1000; // Convert Wh to kWh
    echo "$month: $kwh kWh\n";
}

// Print total and average
echo "\nOverall Totals:\n";
echo "Total Energy: $totalEnergyKWh kWh\n";
echo "Monthly Average: $averageEnergyKWh kWh\n";

