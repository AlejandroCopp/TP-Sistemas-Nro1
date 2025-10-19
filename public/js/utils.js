/**
 * @file utils.js
 * @description This module provides shared utility functions for the frontend application.
 */

/**
 * Sanitizes a string by converting special characters to their HTML entities.
 * This helps prevent XSS attacks by ensuring that user-provided strings are
 * displayed as plain text in the HTML.
 * @param {any} str The input to sanitize. It will be converted to a string.
 * @returns {string} The sanitized string.
 */
export function sanitize(str) {
    return String(str)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}
