# Zulejka & Peti

Wedding website for 14 August 2027.

## Pages

- `index.html` — Home
- `program.html` — The big day and program
- `rsvp.html` — Guest replies
- `accommodation.html` — Stay and travel information
- `contact.html` — Questions and messages

The program times, venue, and accommodation recommendations are placeholders until those details are confirmed.

## Forms and hosting

The RSVP and contact forms post to `php/form-process.php`, which sends submissions by email. The forms require a PHP-capable host with mail delivery enabled; static hosting such as GitHub Pages will not run this endpoint. Before publishing, verify the recipient configured in `php/form-process.php` and test mail delivery on the production host.
