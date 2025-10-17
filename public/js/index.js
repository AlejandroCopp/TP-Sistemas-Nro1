/**
 * @file index.js
 * @description Main entry point for the frontend application.
 * It initializes the main components.
 */
import { createSearchEngine } from './searchEngine.js';

/**
 * Main application function.
 * This function is executed when the DOM is fully loaded.
 */
async function main() {
    // Render the main search engine component.
    // The search engine now handles its own data fetching and filtering.
    createSearchEngine('#search-engine-container');
}

// Run the main application function when the document is ready.
document.addEventListener('DOMContentLoaded', main);
