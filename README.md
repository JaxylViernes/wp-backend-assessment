# WordPress Jobs Assessment

A child theme (`jobs-child`) of Twenty Twenty-One that adds a "Jobs" custom post type, built without plugins.

## Features
- Custom post type "Jobs" (add, edit, delete in admin)
- Custom fields: Job Title, Salary, Location (saved with nonce and capability checks, sanitised on save, escaped on output)
- Archive page listing all jobs at `/jobs/`
- Single job page showing all fields

## Setup
1. Copy `twentytwentyone` and `jobs-child` into `wp-content/themes/`.
2. Activate **Jobs Child** under Appearance → Themes.
3. Go to Settings → Permalinks and click Save Changes (flushes rewrite rules).
4. Add jobs under Jobs → Add New Job.

## Files
- `jobs-child/functions.php`: post type, meta box and saving
- `jobs-child/archive-jobs.php`: archive template
- `jobs-child/single-jobs.php`: single job template