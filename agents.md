## 2026-06-19 â€” Gallery compatibility shim

- Added `wkode_get_vehicle_gallery_images()` in `functions.php` to read gallery URLs from `_boom_gallery_urls` and fall back to the existing ACF gallery field output.
- Updated `single-motos-novas.php` and `single-motos-seminovas.php` to use the shared helper.
- Commit title: `feat: add remote gallery compatibility shim`

## 2026-06-19 — Plugin lcw-api-sync: initial implementation

Created the full `lcw-api-sync` WordPress plugin with the following files:

- `lcw-api-sync.php` — Main plugin file: WP plugin header, activation/deactivation hooks to schedule/clear WP-Cron, `lcw_6hours` cron interval filter, and requires all class files.
- `includes/class-lcw-logger.php` — Static logger: `log()`, `error()`, and `flush()` methods. Flush saves log entries (capped at 200 lines), sync counters, and last-sync timestamp to `wp_options`.
- `includes/class-lcw-api-client.php` — HTTP client that calls the BoomSistemas API with custom `Username`/`Password` headers, validates the response, and returns the `data` array.
- `includes/class-lcw-image-handler.php` — Filters out `semfoto.png` gallery items, sorts by `veiculo_galeria_ordem`, and returns an array of `url_imagem` strings.
- `includes/class-lcw-taxonomy-manager.php` — `assign()` normalises (ucwords/strtolower), finds or creates a term, and assigns it to a post. `run_cleanup()` sets `_boom_term_active` meta on all terms based on sync-run usage.
- `includes/class-lcw-sync-engine.php` — Full 5-step sync state machine: fetch ? process each vehicle (create/update/skip) ? draft removed vehicles ? taxonomy cleanup ? finalise/log.
- `admin/class-lcw-admin-page.php` — WP Admin settings page under Settings > LCW API Sync with API credentials, sync interval selector, manual sync button, status counters, and scrollable log viewer.

Commit title: `feat: add lcw-api-sync plugin — initial full implementation`

## 2026-06-19 — Plugin lcw-api-sync: fix BOM, API logging, error handling

- **Fixed:** All 7 PHP files were written with a UTF-8 BOM by PowerShell, causing 21 unexpected characters on activation and headers already sent errors (which broke the manual sync redirect). All files rewritten without BOM using UTF8Encoding(false).
- **Fixed:** dmin/class-lcw-admin-page.php — added check_admin_referer('lcw_manual_sync') nonce verification to the manual sync handler. Added JS fallback redirect if headers are already sent. Error notice is now shown inline on the settings page (not on a separate error page).
- **Improved:** includes/class-lcw-api-client.php — added detailed logging: logs whether credentials are configured (with char count, not values), logs HTTP response code, logs API body on failure, adds hint if 400 error suggests missing credentials.
- **Improved:** includes/class-lcw-sync-engine.php — exception logs now include file and line number. Create log line includes post type and vehicle description.

Commit title: `fix: remove UTF-8 BOM, improve API logging and manual sync error handling`
