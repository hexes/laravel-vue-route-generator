#!/usr/bin/env node
const { execSync } = require('child_process');
const fs = require('fs');
const path = require('path');

// Define the paths
const servicesDir = path.join(process.cwd(), 'resources/js/services');
const commandFilePath = path.join(process.cwd(), 'app/Console/Commands/GenerateRoutesFile.php');

// Create necessary directories
if (!fs.existsSync(servicesDir)) {
  fs.mkdirSync(servicesDir, { recursive: true });
}

// Copy the files
execSync(`cp ${path.resolve(__dirname, 'examples/services/routeService.js')} ${servicesDir}/routeService.js`);
execSync(`mkdir -p ${path.dirname(commandFilePath)} && cp ${path.resolve(__dirname, 'src/Laravel/Console/Commands/GenerateRoutesFile.php')} ${commandFilePath}`);